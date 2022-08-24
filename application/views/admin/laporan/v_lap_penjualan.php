<?php $this->load->view("admin/part/head_lap") ?>
<div id="laporan" class="p-4">
<h4 class="text-center">LAPORAN PENJUALAN BARANG</h4>
 
<table class="table table-sm table-bordered text-sm">
<thead class="bg-light">
    <tr>
        <th style="width:50px;">No</th>
        <th>No Faktur</th>
        <th>Tanggal</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Harga Jual</th>
        <th>Qty</th>
        <th>Diskon</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>
<?php 
$no=0;
    foreach ($data->result_array() as $i) {
        $no++;
        $nofak=$i['jual_nofak'];
        $tgl=$i['jual_tanggal'];
        $barang_id=$i['d_jual_barang_id'];
        $barang_nama=$i['d_jual_barang_nama'];
        $barang_satuan=$i['d_jual_barang_satuan'];
        $barang_harjul=$i['d_jual_barang_harjul'];
        $barang_qty=$i['d_jual_qty'];
        $barang_diskon=$i['d_jual_diskon'];
        $barang_total=$i['d_jual_total'];
?>
    <tr>
        <td style="text-align:center;"><?php echo $no;?></td>
        <td style="padding-left:5px;"><?php echo $nofak;?></td>
        <td style="text-align:center;"><?php echo $tgl;?></td>
        <td style="text-align:center;"><?php echo $barang_id;?></td>
        <td style="text-align:left;"><?php echo $barang_nama;?> 
            <?php if($i['varian'] > 0){?>
                <br>
                <b>Varian :</b> 
                <?php 
                    $bv = $this->db->get_where('tbl_barang_varian',['id' => $i['varian']])->row();
                    if( $bv){
                        echo $bv->sn.' / '.$bv->warna.' / '.$bv->spesifikasi; 
                    }
                }
            ?>
        </td>
        <td style="text-align:left;"><?php echo $barang_satuan;?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($barang_harjul);?></td>
        <td style="text-align:center;"><?php echo $barang_qty;?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($barang_diskon);?></td>
        <td style="text-align:right;"><?php echo 'Rp '.number_format($barang_total);?></td>
    </tr>
<?php }?>
</tbody>
<tfoot>
<?php 
    $b=$jml->row_array();
?>
    <tr>
    <td colspan="9" class="text-right bg-light"><b>Total</b></td>
        <td class="text-right bg-success"><b><?php echo 'Rp '.number_format($b['total']);?></b></td>
    </tr>
</tfoot>
</table>
<table class="table table-sm table-borderless">
    <tr>
        <td class="text-right pb-4"><?php $peng = $this->m_pengaturan->tampil_pengaturan();?><?php foreach ($peng->result_array() as $i) : $pkota=$i['pengaturan_kota'] ?? '';?><?php echo $pkota;?><?php endforeach; ?>, <?php echo date('d-M-Y')?></td>
    </tr>  
    <tr>
        <td class="text-right pt-4">( <?php echo $this->session->userdata('nama');?> )</td>
    </tr>
</table>
</div>
<?php $this->load->view("admin/part/foo_lap") ?>