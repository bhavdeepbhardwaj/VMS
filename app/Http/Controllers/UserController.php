<?php

namespace App\Http\Controllers;

use App\Exports\VisitorExport;
use App\Mail\AppMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visitor;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            // $user = User::get()->first();
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
                'company_name'     => 'required',
                'company_phone'    => 'required|digits:10',
                'address'          => 'required',
                'postcode'         => 'required',
                'country'          => 'required',
                'state'            => 'required',
                // 'pic'              => 'required',
            ]);

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
                'company_name'      => $request->company_name,
                'company_phone'     => $request->company_phone,
                'address'           => $request->address,
                'postcode'          => $request->postcode,
                'country'           => $request->country,
                'state'             => $request->state,
                'company_logo'      => $picture,
            ]);

            return redirect()->back()->with("usersuccess", "Company Profile Updated Successfully!");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // User Password Store

    public function changePasswordSave(Request $request)
    {
        try {
            $this->validate($request, [
                'current_password'        => 'required',
                'new_password'            => 'required',
            ]);
            // dd($request->all());
            if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error", "Your current password does not match with the password you provided. Please try again.");
            }
            if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
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
            return redirect()->back()->with("success", "Password changed successfully!");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong..!");
        }
    }

    // Visitor Registration

    public function VisitiorRegistration()
    {
        try {
            // $getdata = Guest::where('visitorID', $request->visitorID)->get()->first();
            // dd($getdata);
            $guest = Visitor::orderBy('created_at', 'DESC')->get();
            // dd($guest);

        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('user.list', ['guest' => $guest]);
    }



    public function popUpVisitiorRegistration(Request $request)
    {
        // dd($request->all());
        $guests = Visitor::where('visitorID', $request->visitorID)->first();

        // dd($guests);
        return Response::json($guests);
    }

    // Visitor All Visitor Registration

    public function exportAllVisitorRegistration(Request $request)
    {
        // dd($request->all());
        try {
            $t = time();
            return Excel::download(new VisitorExport, '(' . date("d-m-Y", $t) . ')Visitor-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // Export All Visitor Visitor Registration Filter

    public function datefilterVisitor(Request $request)
    {
        // dd($request->all());
        try {
            $this->validate($request, [
                'start_date'                  => 'required',
                'end_date'                    => 'required',
            ]);

            return Excel::download(new VisitorExport, '(' . $request->start_date . ')-(' . $request->end_date . ') Visitor-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }
}
