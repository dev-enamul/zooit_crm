<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 800px;
            margin: auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        h3 {
            color: #333333;
        }
        p {
            color: #555555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 8px 10px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: #ffffff !important;
            margin: 4px 0;
        }
        .invoice-btn {
            background-color: #0d6efd;
        }
        .panel {
            background-color: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            margin-top: 15px;
            font-size: 14px;
            color: #444;
        }
        .footer {
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
            text-align: center;
        }
        .footer img {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h3>{{ $custom_subject }}</h3>

        <p>{!! nl2br(e($intro_message)) !!}</p>

        @if($invoices->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Due Date</th>
                    <th>Amount Due</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->due_date->format('d M, Y') }}</td>
                    <td>${{ number_format($invoice->due_amount, 2) }}</td>
                     <td>
                        <p>
                            <a href="{{ route('invoice.share', customEncrypt($invoice->id)) }}" class="button invoice-btn">
                                View Invoice #{{ $invoice->id }}
                            </a>
                        </p>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td><strong>Total Due</strong></td>
                    <td><strong>{{ get_price($invoices->sum('due_amount')) }}</strong></td> 
                    <td></td>
                </tr>
            </tbody>
        </table>

        {{-- <div class="panel">We’re committed to serving you with care, quality, and excellence. ✨ ✨ </div> --}}

        @endif 
        <p style="margin-top:15px; line-height:1.5; font-family: Arial, sans-serif; font-size:14px;">
        Best Regards,<br>
        <strong>{{ auth()->user()->name ?? 'Your Name' }}</strong><br>
        {{ auth()->user()->designation ?? 'CEO' }}<br>
        {{ config('app.name')  }}<br>
        {{-- Web: <a href="#" style="color:#0d6efd; text-decoration:none;">www.thezoomit.com</a><br> --}}
        Phone: <a href="tel:+880 1711432284" style="color:#0d6efd; text-decoration:none;">880 1711432284, </a> <a href="tel:+880 1977222457" style="color:#0d6efd; text-decoration:none;">880 1977222457</a><br>
        Email: <a href="mailto:thezoomit@gmail.com" style="color:#0d6efd; text-decoration:none;">thezoomit@gmail.com, </a> <a href="mailto:info@thezoomit.com" style="color:#0d6efd; text-decoration:none;">info@thezoomit.com</a>
    </p> 
        <hr style="margin-top:20px; margin-bottom:20px; border-color:#e0e0e0;">   
        <div class="footer">
            <img src="https://crm.zoomdigital.net/assets/images/logo-dark.png" alt="{{ config('app.name') }} Logo" width="100"><br>
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
            <em>Thank you for being a valued part of our journey. Together, we grow!</em>
        </div> 
    </div>
</body>
</html>
