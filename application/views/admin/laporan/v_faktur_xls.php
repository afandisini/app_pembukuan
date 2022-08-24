<?php $this->load->view("admin/part/head_lap") ?>
    <?php 
        //$b=$data->row_array();
        $x=$peng->row_array();
        //$d=$varian->row_array();
    ?>
        <?php 
            $pelanggan = $this->db->get_where('tbl_pelanggan',['id' => $b['pelanggan_id']])->row();
            if(!empty($pelanggan)){
                $nm = $pelanggan->nama;
                $alt = $pelanggan->alamat;
                $pelhp = $pelanggan->hp;
            }else{
                $nm = "";
            }
        ?>
        <?php 
            $no=0;
                foreach ($peng->result_array() as $i) :
                    $no++;
                    $pid=$i['pengaturan_id'];
                    $pnm=$i['pengaturan_nama'];
                    $pfoo=$i['pengaturan_foo'];
                    $palt=$i['pengaturan_alt'];
                    $php=$i['pengaturan_hp'];
                    $pkota=$i['pengaturan_kota'];
        ?>
            <table>
                <tr>
                    <td colspan="5"><h1><b><?php echo $pnm;?></b></h1></td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td colspan="3"><b>FAKTUR PENJUALAN TUNAI</b></td>
                </tr>
                <tr>
                    <td colspan="4"><?php echo $palt;?></td>
                    <td></td>
                    <td colspan="3">Kepada Yth</td>
                </tr>
                <tr>
                    <td colspan="4">Telp : <?php echo $php;?></td>
                    <td></td>
                    <td colspan="3"><b><?= $nm;?></b> / +62<?= $pelhp;?></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td></td>
                    <td colspan="3"><b>di </b><?php echo $pkota;?></td>
                </tr>
            </table>
        <?php endforeach; ?>
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="font-weight-bold">
                    <th class="description">No. Faktur</th>
                    <th class="price">Merk</th>
                    <th class="price">Waranti</th>
                    <th class="price">Warna</th>
                    <th class="price">Qty</th>
                    <th class="price">SN/IMEI</th>
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
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $x['pengaturan_nama'];?></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"><?= $x['pengaturan_foo'];?></td>
            </tr>
        </table>
<?php $this->load->view("admin/part/fool") ?>