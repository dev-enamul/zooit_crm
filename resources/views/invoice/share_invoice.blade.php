<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding: 20px;
        }

        .page-title-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        button {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: white;
            border: none;
            background-color: #007bff;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        button:hover, a:hover {
            background-color: #0056b3;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }

        .company_info, .bill_to, .invoice_info, .invoice_reason, .invoice_footer, .bank_info {
            margin-top: 20px;
        }

        .company_info p, .bill_to p, .invoice_info p, .invoice_footer p, .bank_info p {
            margin: 0;
            padding: 0;
        }

        h1, h5, h6 {
            margin: 0;
        }

        h5.text-primary, p.text-primary {
            color: #007bff;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
        }
        .invoice_header{
            display: flex;
            justify-content: space-between;
        }
        .table_inrow{
            margin: 0px; 
        }

        @media print {
            @page {
                margin: 0.50in;
            }
            body {
                margin: 0;
                padding: 0;
            }

            .main-content {
                padding: 0.50in;
            }

            button, a {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="page-title-box">
            <button id="printButton">Print</button> 
        </div>

        <div class="card">
            <div class="invoice_header">
                <div>
                    <div class="company_info">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="Logo" height="40">
                        <p>24/ A1-, A-2, Bosila Rd, Mohammadpur, Dhaka</p>
                        <p>1711432284</p>
                        <p>info@thezoomit.com</p>
                    </div>
    
                    <div class="bill_to">
                        <h5 class="text-primary">BILL TO</h5>
                        <p>{{@$invoice->user->name}}</p>
                        <p>{{@$invoice->user->phone}}</p>
                        <p>{{@$invoice->user->email}}</p>
                        <p>{{@$invoice->user->userAddress->address}}</p>
                    </div>
                </div>

                <div> 
                    <div class="invoice_info">
                        <h1 class="text-primary">INVOICE</h1>
                        <h5 class="text-primary" style="margin-top: 20px">INVOICE# {{$invoice->id}}</h5>
                        <p><b>Issue Date:</b> {{get_date($invoice->invoice_date)}}</p>
                        <p><b>Due Date:</b> {{get_date($invoice->due_date)}}</p>
                    </div>
    
                    <div class="invoice_reason">
                        <h5 class="text-primary">FOR</h5>
                        <p style="margin: 0px;">{{$invoice->title}}</p>
                    </div>
                </div> 
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$invoice->description}}</td>
                        <td>{{get_price($invoice->amount)}}</td>
                    </tr>
                    <tr>
                        <td>
                            @if ($invoice->tax_amount>0)
                                <p class="table_inrow">Vat & Tax</p>
                            @endif
                            
                            @if ($invoice->discount_amount>0)
                                <p class="table_inrow">Discount</p>
                            @endif 
                        </td>
                        <td>
                            @if ($invoice->tax_amount>0)
                                <p class="table_inrow">$100</p>
                            @endif 

                            @if ($invoice->discount_amount>0)
                                <p class="table_inrow">-{{get_price($invoice->discount_amount)}}</p>
                            @endif  
                        </td>
                    </tr> 
                    <tr>
                        <td><b>GRAND TOTAL</b></td>
                        <td><b>{{get_price($invoice->total_amount)}}</b></td>
                    </tr>
                </tbody>
            </table>

            <div class="invoice_footer">
                <p><b>Please pay the bill before the Due Date.</b></p>
                <p>Grand Total is exclusive of VAT & Tax.</p>
                <p>If you have any questions, contact <b>Shiblee Mozumder | +8801711432284 |</b></p>
                <a href="mailto:example@gmail.com">thezoomit@gmail.com</a>
            </div>

            <div class="bank_info">
                <h5>Bank Details</h5>
                <img src="https://tds-images.thedailystar.net/sites/default/files/styles/big_202/public/feature/images/united_commercial_bank.jpg" alt="Bank Logo" width="70">
                <p><b>Account Name:</b> ZOOM IT</p>
                <p><b>Account Number:</b> 1782112000003115</p>
                <p><b>Bank:</b> UCB Bank Ati Bazar Branch</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('printButton').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>
</html>
