<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\ContactMail;
use App\Models\ContractDetail;
use Illuminate\Http\Request;
use App\Rules\Recaptcha;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => ['required', new Recaptcha]
        ]);
        $data = [
            'name' => $request->customer_name,
            'email' => $request->customer_email,
            'message' => $request->message
        ];
        ContractDetail::create($data);
        $mailable=new ContactMail($data);
        dispatch(new SendEmail($mailable));
        return back()->with('success', 'Your message has been sent!');
    }
}
