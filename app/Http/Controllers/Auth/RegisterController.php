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
        $image = \QrCode::size(200)->errorCorrection('H')
            ->generate('http://127.0.0.1:8000/resgvisitor/' . $data['company_name']);

        //  dd($image);

        $output_file = 'img-' . time() . '.svg';
        Storage::disk('qr-code')->put($output_file, $image);

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

        $get = \App\Models\User::latest()->first();

        // $mailer->sendVisitorRegistrationInformation(Auth::user(), $get);

        // $mailer->sendVisitorRegistrationInformationLeads($get);

        // Visitor Registration qr code.

        // QrCode::size(300)->generate("http://127.0.0.1:8000/resgvisitor/"."$request->company_name", public_path("qr-code/$request->company_name"));

        // return redirect()->back()->with("status", "Your request has been sent successfully to our team. One of oue executive will connect soon. ");
        // return view('emails.visitorSinup',['user' => Auth::user(),'users' => $get]);
        return redirect()->route('sign-up-thank')->with("status", "Your request has been sent successfully to our team. One of oue executive will connect soon. ");
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
