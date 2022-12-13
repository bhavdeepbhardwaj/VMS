<?php

namespace App\Mail;

use App\Models\Certificate;
use App\Models\ComplaintRegistration;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Warranty_extend;
use App\Models\Warranty_registration;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AppMailer
{

    public $mailer;
    public $fromAddress = 'sales@globalsync.com.au';
    // public $fromAddress = 'noreply@gee.com.au';
    public $fromName = 'GLOBALSYNC TEAM';
    public $to;
    public $subject;
    public $view;
    public $data = [];

    public function __construct(Mailer $mailer)
    {
        //
        $this->mailer = $mailer;
    }

    // Visitor User Registration Information

    public function sendVisitorRegistrationInformation($user, User $users)
    {
        $this->to =  $users->email;
        $this->subject = "VMS Signup Confirmation: Globalsync";
        $this->view = 'emails.visitorSinup';
        $this->data = compact('user', 'users');
        return $this->deliver();
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->fromAddress, $this->fromName)
                ->to($this->to)->subject($this->subject);
        });
    }

    // public function build()
    // {
    //     return $this->view('view.name');
    // }
}
