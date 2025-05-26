@extends('email.layouts.master')

@section('title', 'Welcome to Postdrop!')

@section('content')
    <p>👋 Welcome to Postdrop. A simple tool to help developers with HTML email.</p>
    <p>✨ Use this template and call it a day.</p>
    <p>⬇️ Add your own content then copy to your codebase or ESP.</p>
    <p>📬 Send test emails to yourself after signing up.</p>

    <table class="btn btn-primary" role="presentation" width="100%">
        <tr>
            <td align="center">
                <table role="presentation">
                    <tr>
                        <td bgcolor="#ec0867" style="border-radius: 5px;">
                            <a href="{{ url('/signup') }}" target="_blank" style="background-color: #ec0867; color: #fff; padding: 12px 25px; border-radius: 5px; text-decoration: none;">Sign Up For Postdrop</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p>💃 That's it. Enjoy this free template.</p>
@endsection
