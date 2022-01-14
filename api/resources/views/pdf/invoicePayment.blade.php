<!DOCTYPE html>
<html>
<head>
    <title>Invoice </title>
    <style>
        .card {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
        }
        .leftcolumn {
            float: left;
            width: 75%;
        }
        .title {
            font-style: normal;
            font-weight: 500;
            font-size: 17px;
            line-height: 32px;
            text-align: left;
            color: #333333;
        }
        .titleOne {
            font-style: normal;
            font-weight: 300;
            font-size: 22px;
            line-height: 32px;
            text-align: right;
            color: #02A9EA;
        }
        .titleOther {
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 32px;
            text-align: left;
            color: #333333;
        }
        .img {
            width: 25%;
            height: auto;
        }
        .hr {
            border: none;
            height: 2px;
            /* Set the hr color */
            color: #d3d3d3;
            /* old IE */
            background-color: #d3d3d3;
            /* Modern Browsers */
        }
        .hr-one {
            border: none;
            height: 2px;
            /* Set the hr color */
            color: #d3d3d3;
            /* old IE */
            background-color: #d3d3d3;
            /* Modern Browsers */
            margin-top: 40px;
        }
        .footer {

            margin-top: 40px;
        }
        .text-center {
            text-align: center;
            padding: 8px;
        }
        .text-first {
            font-size: 14px;
            text-align: right;
        }
        .text-right {
            text-align: right;
            padding: 4px;
            position: relative;
        }
        .text.left {
            text-align: left;
        }
        .divider {
            border: 0px solid #828282;
        }
        .terbilang {
            background-color: #f0ecec;
            text-align: left;
        }
        .sum-text {
            background-color: #f0ecec;
            text-align: left;
        }
        .sum {
            padding-right: 150px;
            margin-right: 150px;
        }
        table {
            width: 100%;
        }
        .margin {
            margin-top: -39px;
        }
        .text-right>.image-container {
            width: 162px;
            height: 105px;
            position: absolute;
            top: -20;
            right: 0;
            overflow: hidden;
            opacity: 0.2;
        }
        .text-right>.image-container>img {
            width: 140px;
            height: 140px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="leftcolumn">
        <div class="card">
            <img src="{{ public_path('images/' . $company->image)}}" alt="Company" class="img">
            <p class="margin"><b>CENTRAL CAHAYA ABADI</b>
                <br>No Telp : 0822-8491-2014</br>
            </p>
        </div>
    </div>
    <table>
        <tbody>
            <tr>
                <td rowspan="4">
                </td>
                <td class="titleOne" colspan="2" style="width: 40%;">
                    KWITANSI
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td rowspan="4">
                </td>
                <td class="text-first" colspan="2" style="width: 40%;">
                    No.Kwitansi
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td rowspan="4">
                </td>
                <td class="text-first" colspan="2" style="width: 40%;">
                    <b> {{$order->paymentNumber}}</b>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td rowspan="4">
                </td>
                <td class="text-first" colspan="2" style="width: 40%;">
                    No.Invoice
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td rowspan="4">
                </td>
                <td class="text-first" colspan="2" style="width: 40%;">
                    <b> {{$order->invoice->invoiceNumber}}</b>
                </td>
            </tr>
        </tbody>
    </table>
    <hr class="hr">
    <table class="table-order">
        <tbody>
            <tr>
                <td>Sudah Terima Dari</td>
                <td>{{$order->invoice->partner->name }}
                    <hr class="hr">
                </td>
            <tr>
                <td>Terbilang</td>
                <td class="terbilang"> <span id="mountNumber">{{$terbilang}}Rupiah </span>
                    <hr class="hr">
                </td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td>{{$order->note}}
                    <hr class="hr">
                </td>
            </tr>
        </tbody>
    </table>
    <hr class="hr-one">
    <table class="footer">
        <tbody>
            <td class="text-left">
                Jumlah
            </td>
            <td class="sum">
                <b class="sum-text">
                    Rp{{number_format((int) $order->totalPay,0,',','.')}}</b>
            </td>
            <td class="text-right">
                <div class="image-container">
                    <img src="{{ public_path('images/' . $company->image)}}" alt="Company">
                </div>
                {{date('d-m-Y', strtotime($order->createdAt))}}
                <br>
                <b>Centra Cahaya Abadi</b>
            </td>
            </tr>
        </tbody>
        <table>
</body>
</html>