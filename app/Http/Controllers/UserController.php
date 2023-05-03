<?php

namespace App\Http\Controllers;

use App\Exports\VisitorExport;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // User Dashboard

    public function index()
    {
        return view('user.home');
    }

    // User Password Change

    public function changePassword()
    {
        return view('user.change-password');
    }

    // User Profile Page

    public function profile()
    {
        try {
            //code...
            $users = User::where('id', Auth::user()->id)->get()->first();
            // dd($user);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('user.profile', ['users' => $users]);
    }

    // User Profile Save

    public function profilesave(Request $request)
    {
        try {
            // dd($request->all());
            $picture = "";
            $imageNameArr = [];

            $this->validate($request, [
                // 'company_name'     => 'required',
                'company_phone' => 'required|digits:10',
                'address' => 'required',
                'postcode' => 'required',
                'country' => 'required',
                'state' => 'required',
                // 'pic'              => 'required',
            ]);

            if ($request->company_logo == null) {
                return redirect()->back()->with("error", "The Company Logo field is required...!!! Logo Size requirement: 200 x 80 px");
            }

            if ($request->hasFile('company_logo')) {
                $picture = array();
                $imageNameArr = [];
                foreach ($request->company_logo as $file) {
                    // you can also use the original name
                    $image = $file->getClientOriginalName();
                    $imageNameArr[] = $image;
                    // Upload file to public path in images directory
                    $fileName = $file->move(date('d-m-Y') . '-Visitor', $image);
                    // Database operation
                    $array[] = $fileName;
                    $picture = implode(",", $array); //Image separated by comma
                }
            }

            User::where('id', $request->user_id)->update([
                // 'company_name'      => $request->company_name,
                'company_phone' => $request->company_phone,
                'address' => $request->address,
                'postcode' => $request->postcode,
                'country' => $request->country,
                'state' => $request->state,
                'company_logo' => $picture,
                'approve' => $request->approve,
                'admin_name' => $request->admin_name,
            ]);

            return redirect()->back()->with("usersuccess", "Your Company Profile Has Been Updated Successfully");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // User Password Store

    public function changePasswordSave(Request $request)
    {
        try {
            $this->validate($request, [
                'current_password' => 'required',
                'new_password' => 'required',
            ]);
            // dd($request->all());
            if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error", "You have not entered the correct password. Try again now.");
            }
            if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with("error", "Your new password must be different from your current password. Please change your password now.");
            }
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => ['required|min:6'],
                #'confirm_password' => ['same:new_password'],
            ]);
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new_password'));
            $user->save();
            return redirect()->back()->with("success", "Your password has been successfully changed.");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong..!");
        }
    }

    // Visitor Registration

    public function VisitiorRegistration()
    {
        try {
            $guest = Visitor::where('is_deleted', '0')->where('companyCode', Auth::user()->company_name)->orderBy('created_at', 'DESC')->get();
            // dd($guest);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('user.list', ['guest' => $guest]);
    }

    // PopUp Visitor Registration
    public function popUpVisitiorRegistration(Request $request)
    {
        $guests = Visitor::where('visitorID', $request->visitorID)->first();
        return Response::json($guests);
    }

    // Visitor All Visitor Registration

    public function exportAllVisitorRegistration(Request $request)
    {
        // dd($request->all());
        try {
            $export_data =  Visitor::select("created_at", "visitorID", "name", "email", "phone", "host", "purpose", "pic", "address")->where('companyCode', Auth::user()->company_name)->where('is_deleted', '0')->get();
            if (count($export_data) == 0) {
                return redirect()->back()->with("status", "No data available !");
            }
            $t = time();
            return Excel::download(new VisitorExport, '(' . date("d-m-Y", $t) . ')-Visitor-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // Export All Visitor Visitor Registration Filter

    public function datefilterVisitor(Request $request)
    {
        try {
            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            $check = Visitor::whereBetween('created_at', [$request->start_date, $request->end_date])
                ->where('companyCode', Auth::user()->company_name)
                ->where('is_deleted', '0')
                ->count();
            // dd($check);

            if ($check == 0) {
                return redirect()->back()->with("status", "No data available !");
            }

            return Excel::download(new VisitorExport, '(' . $request->start_date . ')-(' . $request->end_date . ') Visitor-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // QR Code Generate

    public function QRCode()
    {
        try {
            $guest = Visitor::orderBy('created_at', 'DESC')->get();
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong !");
        }
        return view('user.qrcode', ['guest' => $guest]);
    }

    public function thankYou()
    {
        return view('pages.thankYou');
    }
}
