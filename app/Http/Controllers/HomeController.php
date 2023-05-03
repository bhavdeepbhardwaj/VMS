<?php

namespace App\Http\Controllers;

use App\Mail\AppMailer;
use App\Models\Demo;
use App\Models\Guest;
use App\Models\Purpose;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class HomeController extends Controller
{
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

            if (isset($getdata) && $getdata) {
                $incid = $getdata->id + 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "DEMO ID-" . $num_padded;
            } else {
                $incid = 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "DEMO ID-" . $num_padded;
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.demovisitor', ['visitorID' => $visitorID]);
    }

    // Demo Registration Save

    public function demovisitorSave(Request $request)
    {
        try {
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

            $visitorRegis = new Demo();
            $visitorRegis->name = $request->name;
            $visitorRegis->email = $request->email;
            $visitorRegis->phone = $request->phone;
            $visitorRegis->host = $request->host;
            $visitorRegis->purpose = $request->purpose;
            $visitorRegis->address = $request->address;
            $visitorRegis->pic = $fileName;
            $visitorRegis->visitorID = $request->visitorID;

            $result = $visitorRegis->save();

            if ($result) {
                return redirect()->route('demo.sumbit')->with("success", "Thanks, you now you are check in $visitorRegis->created_at ");
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // Demo Sumbit Responce

    public function demoSubmitForm(Request $request)
    {
        try {
            $getdata = Demo::latest()->first();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.demoSubmit', ['getdata' => $getdata]);
    }

    // User Registration

    public function uservisitor($data)
    {
        $checkCompany = \App\Models\User::where('company_name', $data)->get();
        $checkLogo = \App\Models\User::where('company_name', $data)->pluck('company_logo')->first();
        $companyArr = \App\Models\Purpose::where('companyName', $data)->pluck('name')->first();
        $explodecompany = explode(',', $companyArr);

        try {
            $getdata = \App\Models\Visitor::where('companyCode', $data)->count();
            // dd($getdata);
            if ($getdata > 0) {
                $incid = $getdata + 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = preg_replace('/\s+/', '', strtoupper($data)) . "ID-" . $num_padded;
                // dd($incid);
            } else {
                $incid = 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = preg_replace('/\s+/', '', strtoupper($data)) . "ID-" . $num_padded;
                // dd($getdata);
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        if (count($checkCompany) > 0) {

            return view('pages.Uvisitor', ['visitorID' => $visitorID, 'data' => $data, 'explodecompany' => $explodecompany, 'checkLogo' => $checkLogo]);
        } else {
            return view('errors.419');
        }
    }

    // Visitor Registration Save

    public function UvisitorSave(Request $request, AppMailer $mailer)
    {
        try {
            // dd($request->all());
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required|min:10|max:14',
                // 'host'                 => 'required',
                'address' => 'required',
                'purpose' => 'required',
                'visitorID' => 'required',
                'pic' => 'required',
                // 'companyLogo' => 'required',
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

            $visitorRegis = new Visitor();
            $visitorRegis->name = $request->name;
            $visitorRegis->email = $request->email;
            $visitorRegis->phone = $request->phone;
            $visitorRegis->host = $request->host;
            $visitorRegis->purpose = $request->purpose;
            $visitorRegis->address = $request->address;
            $visitorRegis->pic = $fileName;
            $visitorRegis->visitorID = $request->visitorID;
            $visitorRegis->companyCode = $request->companyCode;
            $visitorRegis->companyLogo = $request->companyLogo;
            $visitorRegis->latitude = $request->latitude;
            $visitorRegis->longitude = $request->longitude;
            $visitorRegis->created_at = Carbon::now();
            // $visitorRegis->updated_at = Null;

            $visitorRegis->save();
            // dd($visitorRegis->id);

            // Host Notification
            $get = \App\Models\User::where('company_name', $request->companyCode)->select('email', 'admin_name')->first();
            $getinfo = \App\Models\Visitor::where('id', $visitorRegis->id)->first();

            // dd($get,$getinfo);

            if ($request->host == null) {
                $host = 'NA';
            } else {
                $host = $request->host;
            }
            // $mailer->sendHostNotification($get, $request->name, $host, $request->purpose);
            $checkin = date('jS \of F Y h:i A', strtotime($visitorRegis->created_at));
            return redirect()->route('user.sumbit', Crypt::encrypt($visitorRegis->visitorID))->with("success", "Thank You. Your check-in has been completed $checkin.");
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // Visitor Sumbit Responce

    public function UvisitorSubmit(Request $request, $visitorID)
    {
        try {
            // $getdata = Visitor::latest()->first();
            $visitorID = Crypt::decrypt($visitorID);
            $getdata = Visitor::where('visitorID', $visitorID)->first();
            // dd($getdata);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.Usubmit', ['getdata' => $getdata]);
    }
    // Check Out Visitor
    public function checkOutVisitior(Request $request, $id)
    {
        $checkout = Visitor::find($id);
        // dd($checkout->updated_at);

        if (!$checkout) {
            return response()->json([
                'error' => 'Unable to locate',
            ], 404);
        }
        $date = date('Y-m-d H:i:s', time());
        // dd($date);
        Visitor::where('id', $id)->update([
            'updated_at' => $date,
        ]);

        // $checkout->update([
        //     'updated_at' => $date,
        // ]);

        return response()->json('checkout updated');
        // return Response::json($checkout);
    }

    // Visitor Registration

    public function Visitor()
    {
        try {
            $getdata = \App\Models\Guest::latest()->first();

            if (isset($getdata) && $getdata) {
                $incid = $getdata->id + 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "Globalsync ID-" . $num_padded;
            } else {
                $incid = 1;
                $num_padded = sprintf("%03d", $incid);
                $visitorID = "Globalsync ID-" . $num_padded;
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.visitor', ['visitorID' => $visitorID]);
    }

    // Visitor Registration Save

    public function VisitorSave(Request $request, AppMailer $mailer)
    {
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

            $visitorRegis = new Guest();
            $visitorRegis->name = $request->name;
            $visitorRegis->email = $request->email;
            $visitorRegis->phone = $request->phone;
            $visitorRegis->host = $request->host;
            $visitorRegis->purpose = $request->purpose;
            $visitorRegis->address = $request->address;
            $visitorRegis->pic = $fileName;
            $visitorRegis->visitorID = $request->visitorID;
            $visitorRegis->signature = $signature_fileName;

            dd($visitorRegis);

            $result = $visitorRegis->save();

            if ($result) {
                return redirect()->route('submit')->with("success", "Thanks, you now you are check in $visitorRegis->created_at ");
            }
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with("error", "Something is wrong...!");
        }
    }

    // Visitor Sumbit Responce

    public function submitForm(Request $request)
    {
        try {
            $getdata = Guest::latest()->first();
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('pages.submit', ['getdata' => $getdata]);
    }

    public function popUpVisitorRegistration(Request $request)
    {
        $guests = Guest::where('visitorID', $request->visitorID)->first();
        return Response::json($guests);
    }

    // Dashboard Report

    public function getAllMonths()
    {

        $month_array = array();
        // $Visitor_vates = Visitor::where('companyCode', Auth::user()->company_name)->orderBy('created_at', 'ASC')->pluck('created_at');
        $Visitor_vates = Visitor::where('is_deleted', '0')->orderBy('created_at', 'ASC')->pluck('created_at');
        // dd($Visitor_vates);
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
        // $monthly_visitor_count = Visitor::where('companyCode', Auth::user()->company_name)->whereMonth('created_at', $month)->get()->count();
        $monthly_visitor_count = Visitor::where('is_deleted', '0')->whereMonth('created_at', $month)->get()->count();
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
