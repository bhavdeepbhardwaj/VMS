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
    // public $fromAddress = 'sales@globalsync.com.au';
    // public $fromAddress = 'bhavdeepb.gee@gmail.com';
    public $fromAddress = 'developer@globalsync.com.au';
    public $fromName = 'GLOBALSYNC';
    public $to;
    public $subject;
    public $view;
    // public $bcc = 'bhavdeepb.gee@gmail.com';
    // public $bcc = 'developer@globalsync.com.au';
    public $data = [];

    public function __construct(Mailer $mailer)
    {
        //
        $this->mailer = $mailer;
    }

    // Visitor User Registration Information

    public function sendVisitorRegistrationInformation(User $users)
    {

        $this->to = $users->email;
        $this->subject = "VMS Signup Confirmation: Globalsync";
        $this->view = 'emails.visitorSinup';
        $this->data = compact('users');
        return $this->deliver();
    }

    // Visitor User Registration Information

    public function sendVisitorRegistrationInformationLeads(User $users)
    {

        // $this->to = ['apandey@globalsync.com.au'];
        $this->to = ['bhavdeepb.gee@gmail.com'];
        $this->subject = "VMS New LEAD";
        $this->view = 'emails.leads';
        $this->data = compact('users', 'users');
        return $this->deliver();
    }

    // Host Notification

    public function sendHostNotification($user, $vname, $vhost, $vpurpose)
    {

        $this->to = $user;
        // $this->to = ['bhavdeepb.gee@gmail.com'];
        $this->subject = "New Visitor Arrived";
        $this->view = 'emails.hostnotification';
        $this->data = compact('user', 'vname', 'vhost', 'vpurpose');
        return $this->deliver();
    }

    public function deliver()
    {
        // BCC ADD
        // $this->mailer->send($this->view, $this->data, function ($message) {
        //     $message->from($this->fromAddress, $this->fromName)
        //         ->to($this->to)->bcc($this->bcc)->subject($this->subject);
        // });

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
