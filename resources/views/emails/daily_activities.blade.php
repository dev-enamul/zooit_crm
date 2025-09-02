<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Activities</title>
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
        a.button {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            color: #ffffff;
            margin: 2px 0;
        }
        .followup-btn {
            background-color: #0d6efd;
        }
        .meeting-btn {
            background-color: #0d6efd;
        }
        .call-btn {
            background-color: #0d6efd;
            padding: 3px 6px;
            border-radius: 3px;
            color: #ffffff;
            text-decoration: none;
            margin-left: 5px;
        }
        .whatsapp-btn {
            background-color: #25D366;
            padding: 3px 6px;
            border-radius: 3px;
            color: #ffffff;
            text-decoration: none;
            margin-left: 2px;
        }
        .copy-btn {
            background-color: #6c757d;
            padding: 3px 6px;
            border-radius: 3px;
            color: #ffffff;
            text-decoration: none;
            margin-left: 2px;
        }
        p {
            color: #555555;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h3>Hello {{ $employee->name }},</h3>

        <p>Here is your schedule for {{ \Carbon\Carbon::parse($activities->first()->event_datetime)->format('d M Y') }}:</p>

        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Type</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $item)
                <tr>
                    <!-- Customer Name -->
                    <td>
                        <a href="{{ route('customer.profile', encrypt($item->customer_id)) }}" style="color:#0d6efd; text-decoration:none;">
                            {{ $item->customer_name }}
                        </a>
                    </td>

                    <!-- Type -->
                    <td>{{ $item->type }}</td>

                    <!-- Time -->
                    <td>{{ \Carbon\Carbon::parse($item->event_datetime)->format('H:i') }}</td>

                    <!-- Location -->
                    <td>{{ $item->location ?? '-' }}</td>

                    <!-- Phone with Icons -->
                    <td>
                        @if($item->phone_number)
                            {{ $item->phone_number }}
 
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $item->phone_number) }}" class="call-btn">
                                📞
                            </a>
 
                            <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $item->phone_number) }}" class="whatsapp-btn">
                                💬
                            </a>
 
                            <a href="#" onclick="navigator.clipboard.writeText('{{ $item->phone_number }}'); return false;" class="copy-btn">
                                📋
                            </a>
                        @else
                            -
                        @endif
                    </td>

                    <!-- Action Buttons -->
                    <td>
                        @if($item->type == 'Followup')
                            <a href="{{ route('followup.create',['customer' => $item->customer_id]) }}" class="button followup-btn">
                                FollowUp Now
                            </a>
                        @elseif($item->type == 'Meeting')
                            <a href="{{ route('meeting.complete', $item->meeting_id) }}" class="button meeting-btn">
                                Complete
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top:15px;">Have a productive day!</p>

        <hr style="margin-top:20px; margin-bottom:20px; border-color:#e0e0e0;">

        <p style="font-size:12px; color:#888888;">This is an automated email from {{ config('app.name', 'Your App Name') }}. Please do not reply to this email.</p>
    </div>
</body>
</html>
