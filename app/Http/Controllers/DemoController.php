<?php

namespace App\Http\Controllers;

use App\Exports\ExportDemo;
use App\Models\Demo;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;

class DemoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Demo Home

    public function demoHome()
    {
        try {
            $users = DB::table('users')->count();
            $visitor = DB::table('demos')->count();
            $guest = Demo::orderBy('created_at', 'DESC')->get();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('demo.home', ['users' => $users, 'visitor' => $visitor, 'guest' => $guest]);
    }

    // Demo Visitor Registration

    public function demoRegistration()
    {
        try {
            $demo = Demo::orderBy('created_at', 'DESC')->get();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('demo.index', ['demo' => $demo]);
    }

    // Demo POP UP Function
    public function popUpDemoRegistration(Request $request)
    {
        // dd($request->all());
        $demo = Demo::where('visitorID', $request->visitorID)->first();
        // dd($guests);
        return Response::json($demo);
    }

    // Export All Demo Visitor Registration

    public function exportAllDemoRegistration(Request $request)
    {
        // dd($request->all());
        try {
            $t = time();
            return Excel::download(new ExportDemo, '(' . date("d-m-Y",$t) . ')Demo-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // Export All Demo Visitor Registration Filter

    public function datefilterdemo(Request $request)
    {
        // dd($request->all());
        try {
            $this->validate($request, [
                'start_date'                  => 'required',
                'end_date'                    => 'required',
            ]);

            return Excel::download(new ExportDemo, 'Demo-Registration.xlsx');
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back()->with("error", "Something is wrong !");
    }

    // Demo Profile

    public function profile()
    {
        try {
            $users = User::where('id', Auth::user()->id)->first();
            // dd($users);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('demo.demoProfile', compact('users'));
    }

    // Demo Profile Update

    public function profilesave(Request $request)
    {
        try {
            // dd($request->all());
            $picture = "";
            $imageNameArr = [];

            $this->validate($request, [
                'last_name'        => 'required',
                'phone'            => 'required',
                'address'          => 'required',
                'gender'           => 'required',
                'postcode'         => 'required',
                'country'          => 'required',
                'state'            => 'required',
                // 'pic'              => 'required',
            ]);

            if ($request->hasFile('pic')) {
                $picture = array();
                $imageNameArr = [];
                foreach ($request->pic as $file) {
                    // you can also use the original name
                    $image = $file->getClientOriginalName();
                    $imageNameArr[] = $image;
                    // Upload file to public path in images directory
                    $fileName = $file->move(date('d-m-Y') . '-Demo-User', $image);
                    // Database operation
                    $array[] = $fileName;
                    $picture = implode(",", $array); //Image separated by comma
                }
            }

            User::where('id', $request->user_id)->update([
                'last_name'     => $request->last_name,
                "phone"         => $request->phone,
                "address"       => $request->address,
                "gender"        => $request->gender,
                "postcode"      => $request->postcode,
                "country"       => $request->country,
                "state"         => $request->state,
                "pic"           => $picture
            ]);

            return redirect()->back()->with("success", "Demo detail is updated !");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong !");
        }
    }

    // Demo Password Change

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
