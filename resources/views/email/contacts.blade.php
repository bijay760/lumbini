@extends('email.layouts.master')

@section('title', 'New Contract Form Submission')

@section('content')
    <style type="text/css">
        .content-block {
            padding: 15px 0;
            font-family: Arial, sans-serif;
            color: #333333;
        }
        .details-table {
            border: 1px solid #e0e0e0;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .details-table td {
            padding: 10px;
            border: 1px solid #e0e0e0;
            vertical-align: top;
        }
        .label {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 0;
        }
        h1 {
            color: #2d3748;
            font-size: 24px;
        }
        h2 {
            color: #4a5568;
            font-size: 20px;
            margin-top: 20px;
        }
    </style>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="content-block">
                <h1>New Contract Form Submission</h1>
                <p>A visitor has submitted contract details on your website.</p>
            </td>
        </tr>

        <tr>
            <td class="content-block">
                <h2>Submission Details:</h2>
                <table class="details-table" width="100%" cellpadding="5" cellspacing="0">
                    <tr>
                        <td width="25%" class="label"><strong>Name:</strong></td>
                        <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td class="label"><strong>Email:</strong></td>
                        <td><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
                    </tr>
                    <tr>
                        <td class="label"><strong>Message:</strong></td>
                        <td>{{ $data['message'] }}</td>
                    </tr>
                    <tr>
                        <td class="label"><strong>Submitted At:</strong></td>
                        <td>{{ now()->format('F j, Y \a\t g:i a') }}</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td class="content-block">
                <p>This is an automated notification. Please respond to the inquiry within 24 hours.</p>
            </td>
        </tr>
    </table>
@endsection
