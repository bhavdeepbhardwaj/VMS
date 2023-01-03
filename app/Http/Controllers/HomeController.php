<?php

namespace App\Http\Controllers;

use App\Mail\AppMailer;
use App\Models\Demo;
use App\Models\Guest;
use App\Models\Purpose;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Privacy Policy

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    // Demo Registration

    public function demovisitor()
    {
        try {
            $getdata = \App\Models\Demo::latest()->first();
            // dd($checkdata);

            if (isset($getdata) && $getdata) {
                $incid = $getdata->id + 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "DEMO ID-" . $num_padded;
                // dd($visitorID);

            } else {
                $incid = 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "DEMO ID-" . $num_padded;
                // dd($visitorID);
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.demovisitor', ['visitorID' => $visitorID]);
    }

    // Demo Registration Save

    public function demovisitorSave(Request $request)
    {
        // dd($request->all());
        try {
            // $picture = "";
            // $imageNameArr = [];
            $this->validate($request, [
                'name' => 'required',
                // 'email'                => 'required',
                // 'phone'                => 'required|regex:/^(?:\d{11})$/i',
                'phone' => 'required||min:10|max:11',
                // 'host'                 => 'required',
                'address' => 'required',
                'purpose' => 'required',
                'visitorID' => 'required',
                'pic' => 'required',
            ]);

            if ($request->pic == null) {
                return redirect()->back()->with("error", "The Image field is required...!!!");
            }
            $img = $request->pic;

            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';

            $file = $fileName;
            $data = base64_decode($img);
            file_put_contents('Demo/' . $fileName, $image_base64);

            $complRegis = new Demo();
            $complRegis->name = $request->name;
            $complRegis->email = $request->email;
            $complRegis->phone = $request->phone;
            $complRegis->host = $request->host;
            $complRegis->purpose = $request->purpose;
            $complRegis->address = $request->address;
            $complRegis->pic = $fileName;
            $complRegis->visitorID = $request->visitorID;

            $result = $complRegis->save();

            if ($result) {
                return redirect()->route('demo.sumbit')->with("success", "Thanks, you now you are check in $complRegis->created_at ");
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // Demo Sumbit Responce

    public function demoSubmitForm(Request $request)
    {
        try {
            // $getdata = Visitor::where('phone', $request->phone)->get();
            $getdata = Demo::latest()->first();
            // dd($getdata);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.demoSubmit', ['getdata' => $getdata]);
    }

    // User Registration

    public function uservisitor($data)
    {
        // dd($data);
        $checkCompany = \App\Models\User::where('company_name', $data)->get();
        $checkLogo = \App\Models\User::where('company_name', $data)->pluck('company_logo')->first();
        // dd($checkLogo);
        $companyArr = \App\Models\Purpose::where('companyName', $data)->pluck('name')->first();
        $explodecompany = explode(',', $companyArr);
        // dd($explodecompany);
        // dd($companyArr);
        // dd(count($checkCompany));

        try {
            $getdata = \App\Models\Visitor::where('companyCode', $data)->count();

            // if (isset($getdata) && $getdata) {
            if ($getdata > 0) {
                $incid = $getdata + 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID =  preg_replace('/\s+/', '', strtoupper($data)) . "ID-" . $num_padded;
                // dd($visitorID);

            } else {
                $incid = 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = preg_replace('/\s+/', '', strtoupper($data)) . "ID-" . $num_padded;
                // dd($visitorID);
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if (count($checkCompany) > 0) {

            return view('pages.Uvisitor', ['visitorID' => $visitorID, 'data' => $data, 'explodecompany' => $explodecompany, 'checkLogo' => $checkLogo]);
        } else {
            // dd('Back');
            return view('errors.419');
        }
    }

    // Visitor Registration Save

    public function UvisitorSave(Request $request, AppMailer $mailer)
    {
        // dd($request->all());
        try {
            $this->validate($request, [
                'name' => 'required',
                'email'                => 'required',
                'phone' => 'required|min:10|max:14',
                // 'host'                 => 'required',
                'address' => 'required',
                'purpose' => 'required',
                'visitorID' => 'required',
                'pic' => 'required',
                'companyLogo' => 'required',
            ]);

            if ($request->pic == null) {
                return redirect()->back()->with("error", "The Image field is required...!!!");
            }

            $img = $request->pic;

            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';

            $file = $fileName;
            $data = base64_decode($img);
            file_put_contents('Visitor/' . $fileName, $image_base64);

            $complRegis = new Visitor();
            $complRegis->name = $request->name;
            $complRegis->email = $request->email;
            $complRegis->phone = $request->phone;
            $complRegis->host = $request->host;
            $complRegis->purpose = $request->purpose;
            $complRegis->address = $request->address;
            $complRegis->pic = $fileName;
            $complRegis->visitorID = $request->visitorID;
            $complRegis->companyCode = $request->companyCode;
            $complRegis->companyLogo = $request->companyLogo;

            $result = $complRegis->save();

            // Host Notification
            $get = \App\Models\User::where('company_name', $request->companyCode)->pluck('email')->first();
            // dd($get);
            // $getinfo = \App\Models\Visitor::latest()->get();
            // dd($getinfo, $request->name, $request->host, $request->purpose);

            if ($request->host == null) {
                $host = 'NA';
            } else {
                $host = $request->host;
            }
            // $mailer->sendHostNotification($get, $request->name, $host, $request->purpose);

            if ($result) {
                return redirect()->route('user.sumbit')->with("success", "Thanks, you now you are check in $complRegis->created_at ");
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // Visitor Sumbit Responce

    public function UvisitorSubmit(Request $request)
    {
        try {
            // $getdata = Visitor::where('phone', $request->phone)->get();
            $getdata = Visitor::latest()->first();
            // dd($getdata);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.Usubmit', ['getdata' => $getdata]);
    }


    // Visitor Registration

    public function Visitor()
    {
        try {
            $getdata = \App\Models\Guest::latest()->first();
            // dd($checkdata);

            if (isset($getdata) && $getdata) {
                $incid = $getdata->id + 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "Globalsync ID-" . $num_padded;
                // dd($visitorID);

            } else {
                $incid = 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "Globalsync ID-" . $num_padded;
                // dd($visitorID);
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.visitor', ['visitorID' => $visitorID]);
    }

    // Visitor Registration Save

    public function VisitorSave(Request $request, AppMailer $mailer)
    {
        // dd($request->all());
        try {
            // $picture = "";
            // $imageNameArr = [];
            $this->validate($request, [
                'name' => 'required',
                // 'email'                => 'required',
                // 'phone'                => 'required|regex:/^(?:\d{11})$/i',
                'phone' => 'required||min:10|max:11',
                // 'host'                 => 'required',
                'address' => 'required',
                'purpose' => 'required',
                'visitorID' => 'required',
                'pic' => 'required',
                'signature' => 'required',
            ]);

            if ($request->pic == null) {
                return redirect()->back()->with("error", "The Image field is required...!!!");
            }
            $img = $request->pic;

            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);
            $fileName = uniqid() . '.png';

            $file = $fileName;
            $data = base64_decode($img);
            file_put_contents('Visitor/' . $fileName, $image_base64);

            $signature_img = $request->signature;

            $signature_image_parts = explode(";base64,", $img);
            $signature_image_type_aux = explode("image/", $signature_image_parts[0]);
            $image_type = $signature_image_type_aux[1];

            $signature_image_base64 = base64_decode($signature_image_parts[1]);
            $signature_fileName = uniqid() . '.png';

            $file = $signature_fileName;
            $data = base64_decode($signature_img);
            file_put_contents('Visitor/Signature/' . $signature_fileName, $signature_image_base64);

            $complRegis = new Guest();
            $complRegis->name = $request->name;
            $complRegis->email = $request->email;
            $complRegis->phone = $request->phone;
            $complRegis->host = $request->host;
            $complRegis->purpose = $request->purpose;
            $complRegis->address = $request->address;
            $complRegis->pic = $fileName;
            $complRegis->visitorID = $request->visitorID;
            $complRegis->signature = $signature_fileName;

            dd($complRegis);

            $result = $complRegis->save();

            if ($result) {
                // return redirect()->back()->with("success", "Product Complaint Registered...!");
                // return redirect()->back()->with("success", "Registered...!");
                return redirect()->route('submit')->with("success", "Thanks, you now you are check in $complRegis->created_at ");
                // return redirect('globalsyncvisitor/submit')->with("success", "Thanks, you now you are check in $complRegis->created_at ");
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // Visitor Sumbit Responce

    public function submitForm(Request $request)
    {
        try {
            // $getdata = Guest::where('phone', $request->phone)->get();
            $getdata = Guest::latest()->first();
            // dd($getdata);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.submit', ['getdata' => $getdata]);
    }

    public function popUpVisitorRegistration(Request $request)
    {
        // dd($request->all());
        $guests = Guest::where('visitorID', $request->visitorID)->first();
        // dd($guests);
        return Response::json($guests);
    }

    // Dashboard Report

    public function getAllMonths()
    {

        $month_array = array();
        $Visitor_vates = Guest::orderBy('created_at', 'ASC')->pluck('created_at');
        $Visitor_vates = json_decode($Visitor_vates);

        if (!empty($Visitor_vates)) {
            foreach ($Visitor_vates as $unformatted_date) {
                $date = new \DateTime($unformatted_date);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
            }
        }
        return $month_array;
    }

    public function getMonthlyPostCount($month)
    {
        $monthly_visitor_count = Guest::whereMonth('created_at', $month)->get()->count();
        return $monthly_visitor_count;
    }

    public function getMonthlyVisitorRegistrationData()
    {

        $monthly_visitor_count_array = array();
        $month_array = $this->getAllMonths();
        $month_name_array = array();
        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $monthly_visitor_count = $this->getMonthlyPostCount($month_no);
                array_push($monthly_visitor_count_array, $monthly_visitor_count);
                array_push($month_name_array, $month_name);
            }
        }

        $max_no = max($monthly_visitor_count_array);
        $max = round(($max_no + 300 / 20) / 10) * 10;
        $monthly_visitor_data_array = array(
            'months' => $month_name_array,
            'visitor_count_data' => $monthly_visitor_count_array,
            'max' => $max,
        );

        return $monthly_visitor_data_array;
    }

    // Thank You Page
    public function thankYou()
    {
        return view('pages.thankYou');
    }

    public function pagetest()
    {
        return view('emails.visitorSinup');
    }

    public function signUpthankyou()
    {
        return view('pages.sign-up-thanku');
    }
}
