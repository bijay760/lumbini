<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactMail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|email|max:255',
            'message' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ], [
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
            'g-recaptcha-response.captcha' => 'Failed reCAPTCHA verification.'
        ]);
        $data = [
            'name' => $request->customer_name,
            'email' => $request->customer_email,
            'message' => $request->message
        ];
        $mailable=new ContactMail($data);

        dispatch(new SendContactMail($mailable));
        return back()->with('success', 'Your message has been sent!');


    }
}
