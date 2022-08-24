<?php $this->load->view("admin/part/head_lap") ?>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div id="laporan">
            <?php 
                //$b=$data->row_array();
                $x=$peng->row_array();
                //$d=$varian->row_array();
            ?>
            <?php function tgl_indo($tanggal){
                $bulan = array (1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');$pecahkan = explode('-', $tanggal); return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];}
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
                            <h5 class="text-center font-weight-bold">SURAT JALAN</h5>
                            <h5 class="text-center font-weight-bold">NO. <?= $this->input->get('nofak');?> <?php $limit = 1; ?><?php foreach ($faktur as $i):$nofak=$i['d_jual_nofak'];$tgl=$i['tgl_input'];$a=1;?><?php endforeach; ?> / BRF / <?= tgl_default($tgl);?> / <?php echo ($nofak/$nofak);?> </h5>
                        <?php endforeach; ?>
                        <?php 
                            $pelanggan = $this->db->get_where('tbl_pelanggan',['id' => $b['pelanggan_id']])->row();
                            if(!empty($pelanggan)){
                                $nm = $pelanggan->nama;
                            }else{
                                $nm = "";
                            }
                        ?>
                        <div class="table-resposive-sm">
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <th class="quantity">Kepada : <?= $nm;?></th>
                                        <th class="description mr-4"></th>
                                    </tr>
                                    <tr class="font-weight-bold">
                                        <th class="quantity">Keterangan Sebagai Berikut : </th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="font-weight-bold bg-light">
                                        <th class="quantity">!#</th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no=0;
                                        $totalbelanja = 0;
                                        $totaldiskon = 0;
                                            foreach ($faktur as $i) :
                                                $no++;
                                                $nabar=$i['d_jual_barang_nama'];
                                                $satuan=$i['d_jual_barang_satuan'];
                                                $harjul=$i['d_jual_barang_harjul'];
                                                $qty=$i['d_jual_qty'];
                                                $diskon=$i['d_jual_diskon'];
                                                $total=$i['d_jual_total'];
                                    ?>
                                    <tr>
                                        <td style="width:20px">
                                            <?php echo $no;?>
                                        </td>
                                        <td class="description">
                                            <?php echo $i['d_jual_barang_id'];?>
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
                                    </tr>
                                    <?php $totalbelanja += $total; $totaldiskon += $diskon; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-center" style="font-size:14pt;">
                                <br>
                                <p>Diterima Oleh,</p>
                                <br>
                                <br>
                                <br>
                                <u><?= $nm;?></u>
                            </div>
                            <div class="col-sm-6 text-center" style="font-size:14pt;">
                                <br>
                                <p><?php $peng = $this->m_pengaturan->tampil_pengaturan();?><?php foreach ($peng->result_array() as $i) : $pkota=$i['pengaturan_kota'];?><?php echo $pkota;?><?php endforeach; ?>, <?php foreach ($faktur as $i):$tgl=$i['tgl_input'];?><?php $limit = 1; ?><?php $tgl++; ?><?php echo tgl_indo($tgl);?><?php if($tgl >= $limit) break; ?><?php endforeach; ?></p>
                                <br>
                                <br>
                                <br>
                                <u><?= $pnm;?></u>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
<?php $this->load->view("admin/part/fool") ?>