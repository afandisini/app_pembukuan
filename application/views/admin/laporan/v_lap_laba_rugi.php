<?php $this->load->view("admin/part/head_lap") ?>
<div id="laporan" class="p-4">

<h4 class="text-center">LAPORAN LABA / RUGI </h4>
<?php 
    $b=$jml->row_array();
?>
<table class="table table-sm table-bordered text-sm">
<thead class="bg-light">
<tr>
<th colspan="11" style="text-align:left;">Bulan : <?php echo $b['bulan'];?></th>
</tr>
    <tr>
        <th style="width:50px;">No</th>
        <th>Tanggal</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Harga Pokok</th>
        <th>Harga Jual</th>
        <th>Keuntungan Per Unit</th>
        <th>Item Terjual</th>
        <th>Diskon</th>
        <th>Untung Bersih</th>
    </tr>
</thead>
<tbody>
<?php 
$no=0;
    foreach ($data->result_array() as $i) {
        $no++;
        $tgl=$i['jual_tanggal'];  
        $nabar=$i['d_jual_barang_nama'];
        $satuan=$i['d_jual_barang_satuan'];
        $harpok=$i['d_jual_barang_harpok'];
        $harjul=$i['d_jual_barang_harjul'];
        $untung_perunit=$i['keunt'];
        $qty=$i['d_jual_qty'];
        $diskon=$i['d_jual_diskon'];
        $untung_bersih=$i['untung_bersih'];
?>
    <tr>
        <td style="text-align:center;"><?php echo $no;?></td>
        <td style="text-align:center;"><?php echo $tgl;?></td>
        
        <td style="text-align:left;"><?php echo $nabar;?> 
            <?php if($i['varian'] > 0){?>
                <br>
                <b>Varian :</b> 
                <?php 
                    $bv = $this->db->get_where('tbl_barang_varian',['id' => $i['varian']])->row();
                    echo $bv->sn.' / '.$bv->warna.' / '.$bv->spesifikasi; 
                }
            ?>
        </td>
        <td style="text-align:left;"><?php echo $satuan;?></td>
        <td class="text-right"><?php echo 'Rp '.number_format($harpok);?></td>
        <td class="text-right"><?php echo 'Rp '.number_format($harjul);?></td>
        <td class="text-right"><?php echo 'Rp '.number_format($untung_perunit);?></td>
        <td style="text-align:center;"><?php echo $qty;?></td>
        <td class="text-right"><?php echo 'Rp '.number_format($diskon);?></td>
        <td class="text-right"><?php echo 'Rp '.number_format($untung_bersih);?></td>
    </tr>
<?php }?>
</tbody>
<tfoot>

    <tr>
        <td colspan="9" class="text-center bg-success"><b>Total Keuntungan</b></td>
        <td class="text-right bg-success"><b><?php echo 'Rp '.number_format($b['total']);?></b></td>
    </tr>
</tfoot>
</table>
<table class="table table-sm table-borderless">
    <tr>
        <td class="text-right pb-4"><?php $peng = $this->m_pengaturan->tampil_pengaturan();?><?php foreach ($peng->result_array() as $i) : $pkota=$i['pengaturan_kota'];?><?php echo $pkota;?><?php endforeach; ?>, <?php echo date('d-M-Y')?></td>
    </tr>  
    <tr>
        <td class="text-right pt-4">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
</table>
</div>
<?php $this->load->view("admin/part/foo_lap") ?>