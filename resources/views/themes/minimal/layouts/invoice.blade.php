<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>{{config('basic.site_title')}}</title>

    <link rel="shortcut icon" href="{{getFile(config('location.logoIcon.path').'favicon.png') }}" type="image/x-icon">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <meta name="theme-color" content="#fafafa">
    <style type="text/css">
        body {
            font-size: 14px;
            line-height: 1.3;
            background: #fff;
            font-family:  'Montserrat', sans-serif !important;
        }

        #full-print-form-layout {
            display: block;
            overflow: hidden;
            width: 100%;
            margin: 0 auto;
            padding: 0 !important;
            background: #fff;
            margin-top: 50px;
        }
        .subheader-right-copy-type ul li {
            display: block;
            float: left;
            border: 1px dotted #000;
            padding: 10px;
            margin: 0;
        }

        .subheader-right-copy-type ul li:nth-child(2n) {
            border-left: 0;
            border-right: 0;
        }

        .form-details input {
            border: none;
            border-bottom: 2px dotted #000;
        }


        ul.list-box li {
            display: block;
            width: 30px;
            height: 35px;
            border: 1px solid #000;
            font-size: 20px;
            line-height: 33px;
            padding: 2px;
            float: left;
            margin-right: 2px;
        }
        table{
            width:100%;
            border-collapse:collapse;
            text-align:center;
            border:1px solid #535353;
            font-size:12px;
        }
        th{background:#EEE;width:auto; text-align:center; padding:5px 0;border:1px solid #535353;}
        td{width:auto; text-align:center; padding:5px 0;border:1px solid #535353;}
        tr:nth-child(even) {background: #EEE;}
        .other-pages {
            page-break-before: always;
        }

        .site-title-left{
            width: 300px;float: left;text-align: center;
        }
        .site-title-right{
            width: 300px;float: right;text-align: center;
        }
        .pt-0{
            padding-top: 0;
        }
        .form-sub-header{
            display: block;overflow: hidden;margin-top: 50px;margin-bottom:0px;width: 100%;text-align: center
        }
        .mt-0{
            margin-top: 0;
        }
        .mb-0{
            margin-bottom: 0;
        }
        .mb-30{
            margin-bottom: 30px;
        }

        .font-weight-bold{
            font-weight: bold;
        }
        .text-center{
            text-align: center;
        }
        .sender-info{
            text-align: center;color: #21446f; font-size: 18px;
        }
        .w-100{
            width: 100%;
        }
        .w-50{
            width: 50%;
        }
        .valign-top{
            valign:top;
        }
        @media print {
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>

<!-- Add your site or application content here -->
<section id="full-print-form-layout" class="tr6-form whtr-form" >

    <div class="">
        <div class="site-title-left">
            <small>{{config('basic.site_title')}}<br></small>
        </div>
        <div class="site-title-right">
            <small><b>{{Request::getHost()}}</b></small>
        </div>

    </div><!-- end form-header -->

    <div class="form-inputs pt-0" id="certDeduct">
        <div class="page6 ">
            <div class="form-sub-header">
                <h2 class="sub-title mb-0">{{config('basic.site_title')}}<br><br></h2>
                <p class="mt-0 mb-30" ><small>{{@$contact['address']}}
                        <br>{{trans('Email')}}: {{@$contact['email']}}
                        <br>{{trans('Phone')}}: {{@$contact['phone']}}</small></p>
            </div>


            <h3 class="sub-title mb-0 text-center">{{trans('Payment Receipt')}}<br><br></h3>

            <table  class="w-100" >
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Transaction')}}</td>
                    <td class="font-weight-bold">{{@$invoice['Transaction']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50">{{trans('Status')}}</td>
                    <td class="font-weight-bold">{{@$invoice['Status']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50" >{{trans('Transaction Date')}}</td>
                    <td>{{@$invoice['TransactionDate']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50" >{{trans('Service')}}</td>
                    <td>{{@$invoice['Service']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50" >{{trans('Service Provider')}}</td>
                    <td>{{@$invoice['ServiceProvider']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50" >{{trans('Send Amount')}}</td>
                    <td>{{@$invoice['SendAmount']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50" >{{trans('Fees')}}</td>
                    <td>{{@$invoice['Fees']}}</td>
                </tr>
                @if(!empty($invoice['discountYes']))
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Discount')}}</td>
                    <td>{{@$invoice['Discount']}} </td>
                </tr>
                @endif
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Total Send Amount')}}</td>
                    <td class="font-weight-bold">{{@$invoice['TotalSendAmount']}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Recipient Amount')}}</td>
                    <td class="font-weight-bold">{{@$invoice['RecipientAmount']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50" >{{trans('Rate')}}</td>
                    <td>{{@$invoice['Rate']}}</td>
                </tr>
                <tr class="valign-top">
                    <td width="100%" colspan="2" class="sender-info">{{trans('Sender Information')}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Name')}}</td>
                    <td>{{@$invoice['Sender']['Name']}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Phone')}}</td>
                    <td>{{@$invoice['Sender']['Phone']}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Address')}}</td>
                    <td>{{@$invoice['Sender']['Address']}}</td>
                </tr>

                <tr class="valign-top">
                    <td class="w-50" >{{trans('Funding Source')}}</td>
                    <td>{{@$invoice['FundingSource']}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Sending Purpose')}}</td>
                    <td>{{@$invoice['SendingPurpose']}}</td>
                </tr>
                <tr class="valign-top">
                    <td width="100%" colspan="2" class="sender-info" >{{trans('Recipient Information')}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans("Family / Friend's Name")}}</td>
                    <td>{{@$invoice['Recipient']['Name']}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Email')}}</td>
                    <td>{{@$invoice['Recipient']['Email']}}</td>
                </tr>
                <tr class="valign-top">
                    <td class="w-50" >{{trans('Phone')}}</td>
                    <td>{{@$invoice['Recipient']['Phone']}}</td>
                </tr>
            </table>
        </div>
    </div><!-- form-inputs -->
</section>

</body>

</html>
