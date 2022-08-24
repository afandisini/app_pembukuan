<?php $this->load->view("admin/part/head_lap") ?>
<style>
    body {
    margin: 0;
    padding: 0;
    background-color: #FFF;
    font: 12pt "Arial";
    line-height: 1.5;
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.page {
    width: 21cm;
    min-height: 29.7cm;
    padding: 1cm;
    margin: 1cm auto;
    border: 1px #D3D3D3 solid;
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 256mm;
    outline: 2cm #FFEAEA solid;
}

@page {
    size: 5 in 8 in /* . Random dot? */;
}
@media print {
    html, body {
        width: 5 in; /* was 8.5in */
        height: 8 in; /* was 5.5in */
        display: block;
        font: 14pt "Consolas";
        line-height: 1.2;
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}

td,
th,
tr,
table {
    border-collapse: collapse;
}
    </style>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div id="laporan">
                <?php 
                    //$b=$data->row_array();
                    $x=$peng->row_array();
                    //$d=$varian->row_array();
                ?>
                <?php 
                    $pelanggan = $this->db->get_where('tbl_pelanggan',['id' => $b['pelanggan_id']])->row();
                    if(!empty($pelanggan)){
                        $nm = $pelanggan->nama;
                        $hp = $pelanggan->hp;
                    }else{
                        $nm = "";
                        $hp = "";
                    }
                ?>
                <?php
                    function penyebut($nilai) {
                        $nilai = abs($nilai);
                        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                        $temp = "";
                        if ($nilai < 12) {
                            $temp = " ". $huruf[$nilai];
                        } else if ($nilai <20) {
                            $temp = penyebut($nilai - 10). " belas";
                        } else if ($nilai < 100) {
                            $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                        } else if ($nilai < 200) {
                            $temp = " seratus" . penyebut($nilai - 100);
                        } else if ($nilai < 1000) {
                            $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                        } else if ($nilai < 2000) {
                            $temp = " seribu" . penyebut($nilai - 1000);
                        } else if ($nilai < 1000000) {
                            $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
                        } else if ($nilai < 1000000000) {
                            $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
                        } else if ($nilai < 1000000000000) {
                            $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
                        } else if ($nilai < 1000000000000000) {
                            $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
                        }     
                        return $temp;
                    }

                    function terbilang($nilai) {
                        if($nilai<0) {
                            $hasil = "minus ". trim(penyebut($nilai));
                        } else {
                            $hasil = trim(penyebut($nilai));
                        }     		
                        return $hasil;
                    }

                ?>
                <div class="ticket mt-4">
                    <!--<img src="./logo.png" alt="Logo">-->
                    <?php 
                        $no=0;
                        foreach ($peng->result_array() as $i) :
                            $no++;
                            $pid=$i['pengaturan_id'];
                            $pnm=$i['pengaturan_nama'];
                            $pfoo=$i['pengaturan_foo'];
                            $palt=$i['pengaturan_alt'];
                            $php=$i['pengaturan_hp'];
                    ?>
                    <div class="row">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td><span style="font-size: 3.5rem;font-weight: 300;line-height: 1.2;"><?php echo $pnm;?></span></br><?php echo $palt;?></br>Telp : <?php echo $php;?></td>
                                    <td colspan="4"></td>
                                    <td colspan="2">FAKTUR PENJUALAN TUNAI<br>No.Faktur : <?= $this->input->get('nofak');?><br>Kepada Yth</br><b><?= $nm;?></b></br>+62 <?= $hp;?><br>Di 
                                        <?php foreach ($peng->result_array() as $i):
                                            $pkota=$i['pengaturan_kota'];
                                        ?><?= $pkota;?><?php endforeach; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-sm-12">
                            <?php function tgl_indo($tanggal){
                                $bulan = array (1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');$pecahkan = explode('-', $tanggal); return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];}?>
                            <h6 class="text-right mr-2"><?php foreach ($faktur as $i):$tgl=$i['tgl_input'];?><?php $limit = 1; ?><?php $tgl++; ?><?php echo tgl_indo($tgl);?><?php if($tgl >= $limit) break; ?><?php endforeach; ?></h6>
                        </div>
                        <table class="table table-bordered ml-2 mr-2">
                            <tr class="bg-light">
                                <th class="description">!#</th>
                                <th class="description">Kode</th>
                                <th class="price">Produk</th>
                                <?php foreach ($faktur as $i) : ?>
                                <?php if($i['varian'] > 0){
                                    echo '<th class="price">SN/IMEI</th>';
                                    echo '<th class="price">Warna</th>';
                                    echo '<th class="price">Waranti</th>';
                                    }else{
                                        echo ' ';
                                    }
                                ?><?php endforeach; ?>
                                <th class="text-center">Qty</th>
                                <th class="price">Harga (Rp)</th>
                            </tr>
                            <tbody>
                                <tr>
                                <?php 
                                    $no=0;
                                    $totalbelanja = 0;
                                    $totaldiskon = 0;
                                        foreach ($faktur as $i) :
                                            $no++;
                                            $nofak=$i['d_jual_nofak'];
                                            $kobar=$i['d_jual_barang_id'];
                                            $nabar=$i['d_jual_barang_nama'];
                                            $satuan=$i['d_jual_barang_satuan'];
                                            $harjul=$i['d_jual_barang_harjul'];
                                            $qty=$i['d_jual_qty'];
                                            $diskon=$i['d_jual_diskon'];
                                            $total=$i['d_jual_total'];
                                ?>
                                    <td style="width:20px">
                                        <?php echo $no;?>
                                    </td>
                                    <td class="description">
                                        <?php echo $kobar;?>
                                    </td>
                                    <td class="description">
                                        <?php echo $nabar;?>
                                    </td>
                                    
                                        <?php if($i['varian'] > 0){?>
                                            <?php 
                                                $bv = $this->db->get_where('tbl_barang_varian',['id' => $i['varian']])->row();
                                                echo '<td>' .$bv->sn,'</td>'; 
                                            }else{
                                                echo '';
                                            }
                                        ?>
                                        <?php 
                                                if($i['varian'] > 0){
                                                    echo '<td>' .$bv->warna,'</td>'; 
                                                }else{
                                                    echo '';
                                                }
                                            ?>
                                        <?php 
                                                if($i['varian'] > 0){
                                                    echo '<td>' .$bv->spesifikasi,'</td>'; 
                                                }else{
                                                    echo '';
                                                }
                                            ?>
                                    <td class="quantity text-center"><?php echo $qty;?></td>
                                    <td class="price text-right"><?php echo 'Rp  '.number_format($total).',-';?></td>
                                </tr>
                                <?php $totalbelanja += $total; $totaldiskon += $diskon; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endforeach; ?>
                    <div class="row">
                        <div class="col-sm-3 pl-4">
                            KASIR<br><?php echo $this->session->userdata('nama');?>
                        </div>
                        <div class="col-sm-5 row align-items-end p-0">
                            <?= $pfoo;?>
                        </div>
                        <div class="col-sm-4 mt-1">
                            <span class="float-left">Sub Total:</span><span class="float-right"><?php echo 'Rp '.number_format($totalbelanja).',-';?></span><br>
                            <?php if (!empty($totaldiskon)) { ?>
                            <span class="float-left">Diskon:</span><span class="float-right"><?php echo 'Rp '.number_format($totaldiskon).',-';?></span><br>
                            <?php } else { ?><?php } ?>
                            <?php if (!empty($b['ppn'])) { ?>
                            <span class="float-left">PPN (<?php echo $b['ppn'];?>%):</span><span class="float-right"><?php echo 'Rp '.number_format($b['jual_total'] - $totalbelanja).',-';?></span><br>
                            <?php } else { ?><?php } ?>
                            <span class="font-weight-bold float-left">Jumlah Total:</span><span class="float-right"><?php echo 'Rp '.number_format($b['jual_total']).',-';?></span><br>
                            <hr>
                            <span class="float-left">Bayar:</span><span class="float-right"><?php echo 'Rp '.number_format($b['jual_jml_uang']).',-';?></span><br>
                            <span class="float-left">Kembalian:</span><span class="float-right"><?php echo 'Rp '.number_format($b['jual_kembalian']).',-';?></span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $this->load->view("admin/part/fool") ?>