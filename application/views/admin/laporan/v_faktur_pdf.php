
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cetak Faktur</title>
        <style>
            * {
                font-family: 'sans-serif';
            }
            td,
            th,
            tr,
            table {
                width:100% !important;
                font-size:10pt !important;
                border-collapse: collapse;
            }

            td.description,
            th.description {
                text-align: left;
                width: 275px;
                max-width: 200px;
            }
            td.no,
            th.no {
                width: 40px;
                max-width: 40px;
                text-align: center;
                word-break: break-all;
            }
            td.quantity,
            th.quantity {
                width: 50px;
                max-width: 50px;
                text-align: center;
                word-break: break-all;
            }
            td.price,
            th.price {
                width: 150px;
                max-width: 150px;
                word-break: break-all;
            }
            .centered {
                text-align: center;
                align-content: center;
            }
            .ticket {
                max-width: 400px;
            }
            img {
                max-width: inherit;
                width: inherit;
            }
            @media print {
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body class="hold-transition sidebar-collapse" style="-webkit-print-color-adjust: exact !important;">
        <?php 
            //$b=$data->row_array();
            $x = $peng->row_array();
            //$d=$varian->row_array();
            $pelanggan = $this->db->get_where('tbl_pelanggan',['id' => $b['pelanggan_id']])->row();
            if(!empty($pelanggan)){
                $nm = $pelanggan->nama;
            }else{
                $nm = "";
            }
        ?>
        <table>
            <tr>
                <td><h1 style="font-size:20pt !important"><b><?= $x['pengaturan_nama'];?></b></h1></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><b>FAKTUR PENJUALAN TUNAI</b></td>
            </tr>
            <tr>
                <td><?= $x['pengaturan_alt'];?></td>
                <td>Kepada Yth</td>
            </tr>
            <tr>
                <td>Telp : <?= $x['pengaturan_hp'];?></td>
                <td><b><?= $nm;?></b></td>
            </tr>
            <tr>
                <td></td>
                <td><b>DI</b></td>
            </tr>
            <tr>
                <td>Tgl : <?= tgl_indo_time($b['jual_tanggal']);?></td>
                <td><b><?= $pelanggan->alamat ?? '-';?></b></td>
            </tr>
            <tr>
                <td><br></td>
                <td><br></td>
            </tr>
        </table>
        <table border="1" style="border-collapse: collapse;" width="100%">
            <thead>
                <tr class="font-weight-bold">
                    <th style="width:30px !important">No</th>
                    <th style="width:150px !important">NAMA BARANG</th>
                    <th style="width:80px !important">WARNA</th>
                    <th style="width:100px !important">Keterangan </th>
                    <th style="width:130px !important">Harga (Rp)</th>
                    <th style="width:30px !important">Qty</th>
                    <th style="width:130px !important">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $no=1;
                    $totalbelanja = 0;
                    $totaldiskon = 0;
                    $qt = 0;
                        foreach ($faktur as $i) :
                            $nabar=$i['d_jual_barang_nama'];
                            $satuan=$i['d_jual_barang_satuan'];
                            $harjul=$i['d_jual_barang_harjul'];
                            $qty=$i['d_jual_qty'];
                            $diskon=$i['d_jual_diskon'];
                            $total=$i['d_jual_total'];
                ?>
                <tr>
                    <td class="description">
                        <?php echo $no;?>
                    </td>
                    <td>
                        <?php echo $nabar;?>
                    </td>
                    <td>
                        <?php 
                            if($i['varian'] > 0){
                                echo $bv->warna; 
                            }else{
                                echo '-';
                            }
                        ?>
                    </td>
                    <td class="quantity"><?php echo $satuan;?></td>
                    <td class="price mr-4"><?php echo ' '.number_format($total);?></td>
                    <td class="quantity"><?php echo $qty;?></td>
                    <td class="price mr-4"><?php echo ' '.number_format($total * $qty);?></td>
                </tr>
                <?php $totalbelanja += $total* $qty; $totaldiskon += $diskon; $qt += $qty; $no++; endforeach; ?>
                <tr>
                    <th colspan="5">Sub Total</th>
                    <th><?= number_format($qt);?></th>
                    <th><?= number_format($totalbelanja);?></th>
                </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <td><br><br></td>
                <td><br><br></td>
            </tr>
            <tr>
                <td><?= $x['pengaturan_nama'];?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>- Barang yang sudah dibeli tidak bisa dikembalikan</td>
            </tr>
            <tr>
                <td></td>
                <td>- Harap membawa nota ini saat melakukan klaim</td>
            </tr>
        </table>
    </body>
</html>