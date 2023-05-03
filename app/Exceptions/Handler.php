<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

            try {
                $exception_msg_arr = [
                    'err_msg' => $e->getMessage(),
                    'err_code' => $e->getCode(),
                    'err_file' => $e->getFile(),
                    'err_line' => $e->getLine(),
                    'err_url' => env('APP_URL') . \Request::getRequestUri(),
                ];

                $to_name = 'Bhavdeep Bharadwaj';
                $to_email = 'bbharadwaj@gee.com.au';
                // dd($exception_msg_arr['err_msg']);
                $data = [
                    'message_error' => @$exception_msg_arr['err_msg'],
                    'code' => @$exception_msg_arr['err_code'],
                    'file' => @$exception_msg_arr['err_file'],
                    'line' => @$exception_msg_arr['err_line'],
                    'user_id' => Auth::user()->id,
                    'name' => Auth::user()->name,
                    'err_url' => env('APP_URL'),
                    'err_route' => @$exception_msg_arr['err_url'],
                ];

                // dd($data);
                if (str_contains($data['message_error'], 'file_put_contents') == false) {

                    Mail::send('emails.exceptionerror', $data, function ($message) use ($to_name, $to_email) {
                        $message->to($to_email)
                            ->subject('Immediate Action Required');
                    });
                }

            } catch (\Exception$e) {

            }
            dd($exception_msg_arr);
        });
    }
}
