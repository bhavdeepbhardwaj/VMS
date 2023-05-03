<?php

namespace App\Http\Controllers;

use App\Exports\ExportVisitor;
use App\Exports\UsersExport;
use App\Models\Guest;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
            $users = DB::table('users')->where('is_deleted', '0')->where('role', '2')->count();
            $visitor = DB::table('visitors')->where('is_deleted', '0')->count();
            $guest = Guest::where('is_deleted', '0')->orderBy('created_at', 'DESC')->get();
            // dd($users);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.adminHome', ['users' => $users, 'visitor' => $visitor, 'guest' => $guest]);
    }

    // Visitor Registration

    public function visitorRegistration(Request $request)
    {
        // dd($request->all(), $request->companyVisitor, $request->start_date, $request->end_date);
        try {
            // $_ENV['test'] = 'Bhavdeep Bharadwaj';
            // dd(env('test'));
            // $checkCompany = \App\Models\User::where('is_deleted', '0')->unique('company_name')->get();
            if (isset($request->companyVisitor) && $request->companyVisitor) {
                $checkCompany = \App\Models\User::where('is_deleted', '0')->select('company_name')->groupBy('company_name')->get();
                // dd($checkCompany);
                // $guest = Visitor::where('is_deleted', '0')->where('companyCode', $request->companyVisitor)->orderBy('created_at', 'DESC')->get();
                $startDate = isset($request->start_date) ? $request->start_date : "";
                $endDate = isset($request->end_date) ? $request->end_date : "";

                // dd($startDate == '' && $endDate != '');

                if ($startDate == '' && $endDate != '') {
                    return redirect()->back()->with("error", "Something is wrong...!");
                }
                // dd($startDate != '' && $endDate == '');
                $guest = Visitor::where('is_deleted', '0')->where('companyCode', $request->companyVisitor)
                    ->where(function ($query) use ($startDate, $endDate) {
                        if ($startDate != '' && $endDate != '') {
                            $from = date($startDate);
                            $to = date($endDate);
                            $query->whereDate('created_at', '>=', $from);
                            $query->whereDate('created_at', '<=', $to);
                            // whereBetween('created_at', [$from, $to])

                        } else if ($startDate != '' && $endDate == '') {
                            $from = date($startDate);
                            $to = date($startDate);
                            $query->whereDate('created_at', '>=', $from);
                            $query->whereDate('created_at', '<=', $to);
                            // $query->whereBetween('created_at', [$from, $to])
                        }
                    })
                    ->orderBy('created_at', 'DESC')->get();
            } else {

                $checkCompany = \App\Models\User::where('is_deleted', '0')->select('company_name')->groupBy('company_name')->get();

                // dd($checkCompany);
                $guest = Visitor::where('is_deleted', '0')->orderBy('created_at', 'DESC')->get();
                // dd($guest->latitude);
                // $lat = $guest->latitude;
                // $lon = $request->longitude;

                // $data = DB::table("visitors")
                //     ->select(
                //         "visitors.id",
                //         DB::raw("6371 * acos(cos(radians(" . $lat . "))
                // * cos(radians(visitors.lat))
                // * cos(radians(visitors.lon) - radians(" . $lon . "))
                // + sin(radians(" . $lat . "))
                // * sin(radians(visitors.lat))) AS distance")
                //     )
                //     ->groupBy("visitors.id")
                //     ->get();

                // dd($data);
                // dd($guest);
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        // dd($guest);
        $companyselect = isset($request->companyVisitor) ? $request->companyVisitor : "";
        return view('admin.visitor', ['guest' => $guest, 'checkCompany' => $checkCompany, 'companyselect' => $companyselect]);
    }

    //  Visitor Registration Export Filter

    public function exportVisitor(Request $request)
    {
        // dd($request->all());
        try {
            $startDate = isset($request->start_date) ? $request->start_date : "";
            $endDate = isset($request->end_date) ? $request->end_date : "";
            if (isset($request->companyVisitor) && $request->companyVisitor) {
                $companyCode = $request->companyVisitor;
                $checkCompany = \App\Models\User::where('is_deleted', '0')->select('company_name')->groupBy('company_name')->get();
                // dd($checkCompany);
                // $guest = Visitor::where('is_deleted', '0')->where('companyCode', $request->companyVisitor)->orderBy('created_at', 'DESC')->get();

                // dd($startDate == '' && $endDate != '');

                if ($startDate == '' && $endDate != '') {
                    return redirect()->back()->with("error", "Something is wrong...endDate!");
                }
                // dd($startDate != '' && $endDate == '');
                $guest = Visitor::where('is_deleted', '0')->where('companyCode', $request->companyVisitor)
                    ->where(function ($query) use ($startDate, $endDate) {
                        if ($startDate != '' && $endDate != '') {
                            $from = date($startDate);
                            $to = date($endDate);
                            $query->whereDate('created_at', '>=', $from);
                            $query->whereDate('created_at', '<=', $to);
                            // whereBetween('created_at', [$from, $to])
                            //    dd($guest);

                        } else if ($startDate != '' && $endDate == '') {
                            $from = date($startDate);
                            $to = date($startDate);
                            $query->whereDate('created_at', '>=', $from);
                            $query->whereDate('created_at', '<=', $to);
                            // $query->whereBetween('created_at', [$from, $to])
                        }
                        //    dd($guest);
                    })
                    ->orderBy('created_at', 'DESC')->get();
                // dd($guest);
                $t = time();
                // $exportvisitor = new ExportVisitor;
                $passarray = [
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'companyCode' => $request->companyVisitor,
                ];
                return Excel::download(new ExportVisitor($companyCode, $startDate, $endDate), '(' . date("d-m-Y", $t) . ') Visitor-Registration.xlsx');
            } else {
                // dd("all data");
                $checkCompany = \App\Models\User::where('is_deleted', '0')->select('company_name')->groupBy('company_name')->get();
                // dd($checkCompany);
                $guest = Visitor::where('is_deleted', '0')->orderBy('created_at', 'DESC')->get();
                // dd($guest);
                if ($startDate == '' && $endDate != '') {
                    return redirect()->back()->with("error", "Something is wrong...endDate!");
                }
                $t = time();
                return Excel::download(new ExportVisitor('all', $startDate, $endDate), '(' . date("d-m-Y", $t) . ') All-Visitor-Registration.xlsx');
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    // Demo Visitor Registration test

    public function visitordemoRegistration()
    {
        try {
            $guest = Guest::where('is_deleted', '0')->orderBy('created_at', 'DESC')->get();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.demo', ['guest' => $guest]);
    }

    public function popUpVisitorRegistration(Request $request)
    {
        $guests = Visitor::where('visitorID', $request->visitorID)->first();
        // dd($guests);
        return Response::json($guests);
    }

    // All User

    public function user()
    {
        try {
            $user = User::where('is_deleted', '0')->where('role', '2')->orderBy('created_at', 'ASC')->get();
            // dd($user);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('admin.user', ['user' => $user])->with('i');
    }

    // User Popup

    public function popUpUserRegistration(Request $request)
    {
        $guests = User::where('company_phone', $request->company_phone)->first();
        // dd($guests);
        return Response::json($guests);
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
            $picture = "";
            $imageNameArr = [];

            $this->validate($request, [
                // 'last_name'        => 'required',
                'company_phone' => 'required',
                // 'company_name' => 'required',
                'address' => 'required',
                'postcode' => 'required',
                'country' => 'required',
                'state' => 'required',
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
                'last_name' => $request->last_name,
                "company_phone" => $request->company_phone,
                "address" => $request->address,
                "postcode" => $request->postcode,
                "country" => $request->country,
                "state" => $request->state,
                "company_logo" => $picture,
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
                'current_password' => 'required',
                'new_password' => 'required',
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
