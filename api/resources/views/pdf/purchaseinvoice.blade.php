<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{$order->invoiceNumber}}</title>
    <style>
        .title {
            font-style: normal;
            font-weight: 500;
            font-size: 24px;
            line-height: 32px;
            text-align: right;
            color: #333333;
        }
        .text-center {
            text-align: center;
            padding: 8px;
        }
        .text-right {
            text-align: right;
            padding: 4px;
        }
        .divider {
            border: 3px solid #828282;
        }
        table {
            width: 100%;
        }
        .th-color {
            background-color: #4F4F4F;
            padding: 8px;
            color: #FFFFFF;
        }
        .td-border {
            border-bottom: 1px solid #EDF1F7;
            padding: 8px;
        }
        .table-company {
            margin-bottom: 20px;
        }
        .table-order {
            margin: 20px 0px 20px 0px;
        }
    </style>
</head>
<body>
    <table class="table-company">
        <tbody>
            <tr>
                <td rowspan="4" >
                <img src="{{$companyImage}}" width="40px" height="50px"/>
                    <p>
                        <h1>{{$company->name}}</h1>
                    </p>
                </td>
                <td class="title" colspan="2" style="width: 40%;">
                    Invoice Pembelian
                </td>
            </tr>
            <tr>
                <td>Tanggal Order</td>
                <td class="text-right">{{date('d/m/Y', strtotime($order->orderDate))}}</td>
            </tr>
            <tr>
                <td>Jatuh Tempo</td>
                <td class="text-right">{{date('d/m/Y', strtotime($order->dueDate))}}</td>
            </tr>
            <tr>
                <td>Invoice ID</td>
                <td class="text-right">{{$order->invoiceNumber}}</td>
            </tr>
            <!-- Company dan Barcode -->
            <tr>
                <td>{{$company->name}}</td>
                <td colspan="2" rowspan="5"></td>
            </tr>
            <tr>
                <td>{{$company->address}}</td>
            </tr>
            <tr>
                <td>Telp: {{$company->phoneNumber}}</td>
            </tr>
            <tr>
                <td>No. Hp {{$company->cellPhoneNumber}}</td>
            </tr>
            <tr>
                <td>Email: {{$company->email}}</td>
            </tr>
        </tbody>
    </table>

    <hr class="divider">

    <table class="table-order">
        <tr>
            <td>Pembelian dari</td>
            <td>: {{$order->partner->name}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{$order->partner->address}}</td>
        </tr>
        <tr>
            <td>No. Hp/Telp</td>
            <td>: {{$order->partner->cellPhoneNumber}}/{{$order->partner->phoneNumber}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: {{$order->partner->email}}</td>
        </tr>
    </table>

    <table cellPadding=0 cellSpacing=0>
        <thead>
            <tr>
                <th class="th-color">Nama Produk</th>
                <th class="th-color">Kuantitas</th>
                <th class="th-color">Satuan</th>
                <th class="th-color">Harga</th>
                <th class="th-color">Diskon</th>
                <th class="th-color">Total Harga</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($order->purchaseInvoiceItems as $index => $item)
            <tr>
                <td class="td-border">{{$item->product->productName}}</td>
                <td class="text-center td-border">{{$item->totalItem}}</td>
                <td class="text-center td-border">{{$item->typeUnit}}</td>
                <td class="text-right td-border">Rp{{number_format($item->price,0,',','.')}}</td>
                <td class="text-right td-border">Rp{{number_format($item->discount,0,',','.')}}</td>
                <td class="text-right td-border">Rp{{number_format($item->totalPrice,0,',','.')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table cellPadding=0 cellSpacing=0 style="margin-top: 20px;">
        <tr>
            <td class="text-right">Subtotal</td>
            <td class="text-right" style="width: 30%;">Rp{{number_format($order->totalPrice + $order->totalDiscount,0,',','.')}}</td>
        </tr>
        <tr>
            <td class="text-right">Diskon</td>
            <td class="text-right">Rp{{number_format($order->totalDiscount,0,',','.')}}</td>
        </tr>
        <tr>
            <td class="text-right">Lunas</td>
            <td class="text-right">Rp{{number_format($order->totalPay,0,',','.')}}</td>
        </tr>
        <tr>
            <td class="text-right">Jumlah Tertagih</td>
            <td class="text-right">Rp{{number_format($order->totalPrice,0,',','.')}}</td>
        </tr>
    </table>

    <table>
        <tbody>
            <tr>
                <td class="text-right">{{date('d-m-Y', strtotime($order->orderDate))}}</td>
            </tr>
            <tr>
                <td class="text-right">
                    <img src="{{$signature}}" width="108px" height="64px"/>
                </td>
            </tr>
            <tr>
                <td class="text-right">Finance Management</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
