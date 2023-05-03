<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AppMailer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'admin_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company_phone' => ['required', 'numeric', 'digits:10', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        $image = \QrCode::size(350)->errorCorrection('H')
            ->generate('http://127.0.0.1:8000/resgvisitor/' . $data['company_name']);

        //  dd($image);

        $output_file = 'img-' . time() . '.svg';
        Storage::disk('qr-code')->put($output_file, $image);

        // $path = public_path('qr-code/'.time().'.png');

        // $image = \QrCode::format('png')
        //                  ->merge(public_path('assets/img/logo/logo.png'), 0.5, true)
        //                  ->size(500)
        //                  ->errorCorrection('H')
        //                  ->generate('http://127.0.0.1:8000/resgvisitor/' . $data['company_name'], $path);

        // return response($image)->header('Content-type','image/png');

        // dd($path, $image);
        // dd($output_file, $image);

        $data = User::create([
            'admin_name' => $data['admin_name'],
            'company_name' => $data['company_name'],
            'email' => $data['email'],
            'company_phone' => $data['company_phone'],
            'is_admin' => 2,
            'role' => 2,
            'password' => Hash::make($data['password']),
            // 'qrCode'    => $image,
            'qrCode' => $output_file,
        ]);

        $data->save();

        return redirect()->back()->with("status", "Your request has been sent successfully to our team. One of oue executive will connect soon. ");
    }

    public function register(Request $request, AppMailer $mailer)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        // dd($request->all());
        $get = \App\Models\User::where('email',$request->email)->where('company_name',$request->company_name)->latest()->first();

        // CRM Lead Call
        // dd($get);
        $this->insert_leads($get);

        // dd("result");

        // $mailer->sendVisitorRegistrationInformation($get);

        // $mailer->sendVisitorRegistrationInformationLeads($get);

        // Visitor Registration qr code.
        // Visitor Registration qr code.//

        // QrCode::size(300)->generate("http://127.0.0.1:8000/resgvisitor/"."$request->company_name", public_path("qr-code/$request->company_name"));

        // return redirect()->back()->with("status", "Your request has been sent successfully to our team. One of oue executive will connect soon. ");
        // return view('emails.visitorSinup',['user' => Auth::user(),'users' => $get]);



        $urlanchor = '<a href="/" style="color:#000;text-decoration: underline;"><strong>Click here To Log in</strong></a>';
        return redirect()->route('sign-up-thank')->with("status", "Thanks for Sign Up, $urlanchor");
    }

    public function insert_leads($get) {

        $vms ="Visitor Management System";

        $post = [

            'refresh_token'	=> '1000.5e477ba826c1b2d679ebb6bf604afdf1.8a9b60160d8101c7d6acf4e880bcbce4',
            // 'access_token'  => '1000.0824c00bfe2e74b42fedc5b18b238c8b.c08fb9437cc3390480e00f6ea3f15c0c',
            'client_id'		=> '1000.72M4LTKEFTXUBUPVIW7NR0ILL4SS5P',
            'client_secret'	=> '73aa4d57e99e2768e7ff7ce4e3623754a50507a746',
            // 'grant_type'	=> 'authorization_code',
            'grant_type'	=> 'refresh_token',
            // 'scope'         => 'ZohoCRM.modules.ALL',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://accounts.zoho.in/oauth/v2/token");

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


        $response = curl_exec($ch);

        $response = json_decode($response);

        // dd($response);

        if ($response != null)
        {
            $access_token = $response->access_token;
            $vms    =   array("Visitor Management System");
        $post_data = [


            'data' => [
                [
                    "Last_Name"	        => $get->admin_name,
                    "Email"		        => $get->email,
                    "Phone"	            => $get->company_phone,
                    "Company"	        => $get->company_name,
                    // "Which_Service"     => "Visitor Management System\n",
                    // "Which_Service"     => $vms[0],
                    "Which_Service"     => $vms,
                ]
            ],

            'trigger' => [

                "approval",
                "workflow",
                "blueprint"

            ]

        ];

        // dd($post_data);


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.zohoapis.in/crm/v2/Leads");

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Zoho-oauthtoken ' . $access_token,
            'Content-Type: application/x-www-form-urlencoded')

            );


        $data_inserted = curl_exec($ch);
        $data_inserted = json_decode($data_inserted);
        dd($data_inserted);

        return $data_inserted->data[0]->code;

        } else {

            echo "Server Error Could Not Process Your Request";
        }

    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function guard()
    {
        return Auth::guard();
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
        // return redirect()->back()->with("status", "User is created.");
    }

    public function registered(Request $request, $user)
    {
        //
    }
}
