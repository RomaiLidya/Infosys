<!DOCTYPE html>
<html>
<head>
    <title>Komisi</title>
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
                <td rowspan="3">
                    <img src="{{$companyImage}}" width="40px" height="50px"/>
                    <p>
                        <h1>{{$company->name}}</h1>
                    </p>
                </td>
                <td class="title" colspan="2" style="width: 40%;">
                    Laporan Komisi
                </td>
            </tr>
            <tr>
                <td>ID Sales</td>
                <td class="text-right">{{$sales->id}}</td>
            </tr>

            <tr>
                <td>Tanggal Export</td>
                <td class="text-right">{{date('d/m/Y')}}</td>
            </tr>
          
           

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
            <td>Nama Sales</td>
            <td>: {{$sales->firstName}} {{$sales->lastName}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: {{$sales->email}}</td>
        </tr>
        <tr>
            <td>No. Hp/Telp</td>
            <td>: {{$sales->contactNumber}}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{$sales->address}}</td>
        </tr>
      
       
    </table>

    <table cellPadding=0 cellSpacing=0>
        <thead>
            <tr>
                <th class="th-color">Bulan</th>
                <th class="th-color">Tahun</th>
                <th class="th-color">Total Tertagih</th>
                <th class="th-color">Total Komisi</th>
            
            </tr>
        </thead>
        <tbody>
        @foreach ($commission as $index => $item)
            <tr>
                <td class="td-border">{{$item->month}}</td>
                <td class="text-center td-border">{{$item->year}}</td>
                <td class="text-right td-border">Rp{{number_format($item->totalBill,0,',','.')}}</td>
                <td class="text-right td-border">Rp{{number_format($item->totalCommission,0,',','.')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td class="text-right">{{date('d-m-Y')}}</td>
            </tr>
            <tr>
                <td class="text-right">
                </td>
            </tr>
            <tr>
                <td class="text-right">Finance Management</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
