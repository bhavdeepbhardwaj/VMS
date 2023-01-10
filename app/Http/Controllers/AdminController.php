<?php

namespace App\Http\Controllers;

use App\Exports\ExportVisitor;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\AppMailer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guest;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;

use DateTime;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    // Admin Dashboard

    public function adminHome()
    {
        try {
            $users = DB::table('users')->count();
            $visitor = DB::table('visitors')->count();
            $guest = Guest::orderBy('created_at', 'DESC')->get();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.adminHome', ['users' => $users, 'visitor' => $visitor, 'guest' => $guest]);
    }

    // Visitor Registration

    public function visitorRegistration()
    {
        try {
            // $getdata = Guest::where('visitorID', $request->visitorID)->get()->first();
            // dd($getdata);
            $guest = Visitor::orderBy('created_at', 'DESC')->get();
            // dd($guest);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.visitor', ['guest' => $guest]);
    }

    // Demo Visitor Registration test

    public function visitordemoRegistration()
    {
        try {
            // $getdata = Guest::where('visitorID', $request->visitorID)->get()->first();
            // dd($getdata);
            $guest = Guest::orderBy('created_at', 'DESC')->get();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.demo', ['guest' => $guest]);
    }

    public function popUpVisitorRegistration(Request $request)
    {
        // dd($request->all());
        $guests = Visitor::where('visitorID', $request->visitorID)->first();
        // dd($guests);
        return Response::json($guests);
    }

    // Export All Visitor Registration

    public function exportAllvisitorRegistration(Request $request)
    {
        // dd($request->all());
        try {
            $t = time();
            return Excel::download(new ExportVisitor, '(' . date("d-m-Y",$t) . ') Visitor-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // Export All Visitor Registration Filter

    public function datefiltervisitor(Request $request)
    {
        // dd($request->all());
        try {
            $this->validate($request, [
                'start_date'                  => 'required',
                'end_date'                    => 'required',
            ]);

            return Excel::download(new ExportVisitor, '(' . $request->start_date . ')-(' . $request->end_date . ') Visitor-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // All User

    public function user()
    {
        try {
            $user = User::all();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.user', ['user' => $user]);
    }

    // Export User list

    public function exportAllUsers()
    {
        try {
            return Excel::download(new UsersExport, 'Customers-Collection.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // Admin Profile

    public function profile()
    {
        try {
            $users = User::where('id', Auth::user()->id)->first();
            // dd($users);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.adminProfile', compact('users'));
    }

    // Admin Profile Update

    public function adminProfilesave(Request $request)
    {
        try {
            // dd($request->all());
            $picture = "";
            $imageNameArr = [];

            $this->validate($request, [
                // 'last_name'        => 'required',
                'company_phone'    => 'required',
                'company_name'     => 'required',
                'address'          => 'required',
                'postcode'         => 'required',
                'country'          => 'required',
                'state'            => 'required',
                // 'company_logo'              => 'required',
            ]);

            if ($request->hasFile('company_logo')) {
                $picture = array();
                $imageNameArr = [];
                foreach ($request->company_logo as $file) {
                    // you can also use the original name
                    $image = $file->getClientOriginalName();
                    $imageNameArr[] = $image;
                    // Upload file to public path in images directory
                    $fileName = $file->move(date('d-m-Y') . '-Admin-User', $image);
                    // Database operation
                    $array[] = $fileName;
                    $picture = implode(",", $array); //Image separated by comma
                }
            }

            User::where('id', $request->user_id)->update([
                'last_name'     => $request->last_name,
                "company_phone" => $request->company_phone,
                "address"       => $request->address,
                "postcode"      => $request->postcode,
                "country"       => $request->country,
                "state"         => $request->state,
                "company_logo"  => $picture
            ]);

            return redirect()->back()->with("success", "Admin detail is updated !");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong !");
        }
    }

    // Admin Password Change

    public function changePasswordSave(Request $request)
    {
        try {
            $this->validate($request, [
                'current_password'        => 'required',
                'new_password'            => 'required',
            ]);

            if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
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
            return redirect()->back()->with("changePassword", "Password changed successfully !");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong !");
        }
    }
}
