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
                            <h4 class="text-center font-weight-bold"><?php echo $pnm;?></h4>
                            <p class="text-center"><?php echo $palt;?>
                            <br><?php echo $php;?></p>
                        <?php endforeach; ?>
                        <div class="table-resposive-sm">
                            <span class="float-left">Kasir: <?php echo $this->session->userdata('nama');?></span><span class="float-right"><?php echo date('d M Y')?></span>
                            <table class="table table-sm">
                                <thead>
                                    <tr class="font-weight-bold">
                                        <th class="quantity">Tanggal</th>
                                        <th class="description">No. Faktur</th>
                                        <th class="price">Merk</th>
                                        <th class="price">Type</th>
                                        <th class="price">Warna</th>
                                        <th class="price">Qty</th>
                                        <th class="price">Emei / SN</th>
                                        <th class="price">Harga</th>
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
                                        <td class="description">
                                            <?php echo $i['tgl_input'];?>
                                        </td>
                                        <td class="description">
                                            <?php echo $i['d_jual_barang_id'];?>
                                        </td>
                                        <td class="description">
                                            <?php echo $nabar;?>
                                        </td>
                                        <td>
                                            <?php if($i['varian'] > 0){?>
                                                <?php 
                                                    $bv = $this->db->get_where('tbl_barang_varian',['id' => $i['varian']])->row();
                                                    echo $bv->spesifikasi; 
                                                }else{
                                                    echo '-';
                                                }
                                            ?>
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
                                        <td class="quantity"><?php echo $qty;?></td>
                                        <td>
                                            <?php 
                                                if($i['varian'] > 0){
                                                    echo $bv->sn; 
                                                }else{
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                        <td class="price mr-4"><?php echo ' '.number_format($total);?></td>
                                    </tr>
                                    <?php $totalbelanja += $total; $totaldiskon += $diskon; endforeach; ?>
                                </tbody>
                            </table>
                            <hr>
                            <div class="row">
                                <div class="col-6"></div>   
                                <div class="col-6">   
                                    <div class="row">   
                                        <div class="col-6">
                                            Total Belanja:<br>
                                            Diskon:<br>
                                            PPN (%):<br>
                                            Total:<br>
                                            Bayar:<br>
                                            Kembali:<br>
                                        </div>                          
                                        <div class="col-6">
                                            <?php echo 'Rp '.number_format($totalbelanja).',-';?><br>
                                            <?php echo 'Rp '.number_format($totaldiskon);?><br/>
                                            <?php echo $b['ppn'];?>%<br/>
                                            <?php echo 'Rp '.number_format($b['jual_total']).',-';?><br>
                                            <?php echo 'Rp '.number_format($b['jual_jml_uang']).',-';?><br>
                                            <?php echo 'Rp '.number_format($b['jual_kembalian']).',-';?><br>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                                
                        </div>
                        <p class="text-center mt-4"><?php echo $pfoo;?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $this->load->view("admin/part/fool") ?>