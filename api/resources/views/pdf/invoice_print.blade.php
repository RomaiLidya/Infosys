<!DOCTYPE html>
<html>
<head>
    <title>Nota {{$order->invoiceNumber}}</title>
    <style>
         @font-face {
            font-family: 'Tahoma';
            src: url(<?php echo $path ?>) format("truetype");
        }
    </style>
    <style>
        html, body {
            display: block;
            font-size:12px;
            font-family: 'Tahoma';
            line-height: 11px;
            margin-left: 10px;
        }
        table {
            width: 100%;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .border-left {
            border-left: 1px dotted #000;
        }
        .border-right {
            border-right: 1px dotted #000;
        }
        .border-bottom {
            border-bottom: 1px solid #000;
        }
        .border-top {
            border-top: 1px solid #000;
        }
        td {
            padding: 2px 4px 1px 4px;
        }
        th {
            padding: 1px 4px 1px 4px;
        }
        .table-barang td {
            padding: 1px 4px 1px 4px;
        }
        .table-barang th {
            padding: 1px 4px 1px 4px;
        }
        .page-break{
            page-break-inside: avoid !important;
            display: none;
        }
    </style>
</head>
<body>

<?php
$totalLoop = ceil(count($order->invoiceItems) / 15);
$totalItem = count($order->invoiceItems);
$data = $order->invoiceItems;
$loopItem = 15;
$indexRow = 0;
$idx = 0;
$last = false;
while ($idx < $totalLoop):
    $idx++;

    if ($totalItem <= 15 && $totalLoop === $idx) {
        $loopItem = 15;

    } else if ($totalItem > 15 && $totalItem <= 18 && $idx < $totalLoop) {
    $loopItem = 18;

} else if ($totalItem > 18 && $idx < $totalLoop) {
    $loopItem = 18;

} else if ($totalItem > 18 && $idx === $totalLoop) {
    $loopItem = 15;

} else {
    $loopItem = 15;
}

?>                          <table cellPadding=0 cellSpacing=0>
                                <tbody>
                                    <tr>
                                        <td style="width:28%;">{{$company->name}}</td>
                                        <td class="text-center" style="font-size:16px;vertical-align:top;padding:0px;width:27%;"><u><b>NOTA TITIPAN BARANG</b></u></td>
                                        <td colspan="3" class="text-right">Tanggal : {{date('d/m/Y', strtotime($order->createdAt))}}</td>
                                    </tr>

                                    <tr>
                                        <td rowspan="2" style="vertical-align: top;">No Telp : {{$company->phoneNumber}}</td>
                                        <td colspan="4">Kepada  : {{ucfirst($order->partner->name)}}</p></td>

                                    </tr>

                                    <tr>
                                        <td colspan="3">Alamat : {{$order->partner->address}} <?php echo $Kabupaten !== null ? "," . $Kabupaten->name : "" ?>  <?php echo $Provinsi !== null ? "," . $Provinsi->name : "" ?></td>

                                    </tr>

                                    <tr>
                                        <td>No Faktur : {{$order->invoiceNumber}}</td>
                                        <td>Jt.Tempo : {{date('d/m/Y', strtotime($order->dueDate))}}</td>
                                        <td>Sales : {{$order->Sales->firstName}}</td>
                                        <td>Rute : {{$order->partner->zone->name}}</td>
                                        <td class="text-right">Hal: {{$idx}}/{{$totalLoop}}</td>
                                    </tr>
                                </tbody>
                                </table>


				                <table class="table-barang" cellPadding=0 cellSpacing=0>
				                    <thead>
				                        <tr>
				                            <td class="text-center border-right border-left border-bottom border-top" style="width:5%;">No.</td>
				                            <td class="text-center border-right border-bottom border-top" style="width: 52%">Nama Barang</td>
				                            <td class="text-center border-right border-bottom border-top" style="width: 8%;">Quantity</td>
				                            <td class="text-center border-right border-bottom border-top" style="width: 10%;">Harga</td>
				                            <td class="text-center border-right border-bottom border-top" style="width: 10%;">Diskon</td>
				                            <td class="text-center border-right border-bottom border-top" style="width: 15%;">Jumlah</td>
				                        </tr>
				                    </thead>
				                    <tbody>

				                    @for($i=0; $i < $loopItem; $i++)
                                    <?php

$type = '';
if (isset($data[$indexRow])) {
    switch ($data[$indexRow]['typeUnit']) {
        case 'Batang':
            $type = 'Btg';
            break;
        case 'Lembar':
            $type = 'Lbr';
            break;
        case 'Keping':
            $type = 'Kpg';
            break;
        case 'Pasang':
            $type = 'Psg';
            break;
        case 'Bungkus':
            $type = 'Bks';
            break;
        case 'Paket':
            $type = 'Pkt';
            break;
        case 'Kotak':
            $type = 'Ktk';
            break;
        case 'Kaleng':
            $type = 'Klg';
            break;
        default:
            $type = $data[$indexRow]['typeUnit'];
            break;

    }
}

?>
                                        <?php if (($i + 1) === $loopItem): ?>
                                        <tr>
                                            <td class="text-center border-right border-left border-bottom">{!! isset($data[$indexRow])? $indexRow+1 : '&nbsp;' !!}</td>
                                            <td class="border-right border-bottom">{{isset($data[$indexRow])? $data[$indexRow]['product']['productName'] :''}}</td>
                                            <td class="text-right border-right border-bottom">{{isset($data[$indexRow])?$data[$indexRow]['totalItem']:''}} {{isset($data[$indexRow])?$type:''}}</td>
                                            <td class="text-right border-right border-bottom">{{isset($data[$indexRow]) ? 'Rp' . number_format($data[$indexRow]['price'],0,',','.'):''}}</td>
                                            <td class="text-right border-right border-bottom">{{isset($data[$indexRow]) ? 'Rp' . number_format($data[$indexRow]['discount'],0,',','.'):''}}</td>
                                            <td class="text-right border-right border-bottom">{{isset($data[$indexRow])? 'Rp' . number_format($data[$indexRow]['totalPrice'],0,',','.'):''}}</td>
                                        </tr>

                                    <?php else: ?>
                                    <tr>
                                        <td class="text-center border-right border-left">{!! isset($data[$indexRow])? $indexRow+1 : '&nbsp;' !!}</td>
                                        <td class="border-right">{{isset($data[$indexRow])? $data[$indexRow]['product']['productName'] :''}}</td>
                                        <td class="text-right border-right">{{isset($data[$indexRow])?$data[$indexRow]['totalItem']:''}} {{isset($data[$indexRow])?$type:''}}</td>
                                        <td class="text-right border-right">{{isset($data[$indexRow])? 'Rp' . number_format($data[$indexRow]['price'],0,',','.'):''}}</td>
                                        <td class="text-right border-right">{{isset($data[$indexRow])? 'Rp' . number_format($data[$indexRow]['discount'],0,',','.'):''}}</td>
                                        <td class="text-right border-right">{{isset($data[$indexRow])? 'Rp' . number_format($data[$indexRow]['totalPrice'],0,',','.'):''}}</td>
                                    </tr>
                                <?php endif?>

                                <?php $indexRow++;?>
                            @endfor

                            <?php if ($idx < $totalLoop): ?>
                                <tr>
                                    <td colspan="6">Lanjut Ke Halaman : {{ $idx + 1}}</td>
                                </tr>

                            <?php endif?>

                            <?php if ($idx == $totalLoop): ?>
                                <tr>
                                    <td colspan="5" style="font-size: 10px !important;">MOHON DICEK KEMBALI SEBELUM DI TANDATANGANI KEKURANGAN SESUDAHNYA TIDAK MENJADI TANGGUNG JAWAB KAMI.</td>
                                    <td class="text-right border-bottom border-right border-left" style="vertical-align: top;">Rp{{number_format($order->totalPrice,0,',','.')}}</td>
                                </tr>

                            <?php endif?>
                         </tbody>
                    </table>

                    <?php if ($idx == $totalLoop): ?>
                    <table>
                        <tr>
                            <td class="text-center">Diterima Oleh</td>
                            <td></td>
                            <td class="text-center">Supir</td>
                            <td></td>
                            <td class="text-center">Diperiksa Oleh</td>
                        </tr>

                        <tr>
                           <td></td>
                           <td>&nbsp;</td>
                           <td></td>
                           <td>&nbsp;</td>
                           <td></td>
                        </tr>

                        <tr>
                            <td class="text-center">____________</td>
                           <td>&nbsp;</td>
                            <td class="text-center">____________</td>
                           <td>&nbsp;</td>
                            <td class="text-center">____________</td>
                        </tr>

                    </table>
                    <span style="float: left;">Di Cetak Oleh : {{$admin}}</span>
                    <span style="float: right;">Ref SO : {{$order->SalesOrder->orderNumber}}</span>

                    <?php endif?>
                    <!-- <span style="float: right;">Alamat : {{$company->address}},{{$Provinsi !== null ? $Provinsi->name : ''}}, {{$Kabupaten !== null ? $Kabupaten->name : ''}}, {{$Kecamatan !== null ? $Kecamatan->name : ''}} - {{$company->postalCode}}</span> -->
                    <?php if ($totalLoop > 1): ?>
                        <div style="page-break-after: always;"></div>
                        <?php endif;?>
    <?php
endwhile;
?>

</body>
</html>
