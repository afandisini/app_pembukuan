<?php $this->load->view("admin/part/head_lap") ?>
<div id="laporan" class="p-4">
<?php 
    $b=$jml->row_array();
?>

<h4 class="text-center">LAPORAN PENJUALAN TAHUN <?php echo $b['tahun'];?></h4>
 
<table class="table table-sm table-bordered text-sm">
<?php 
    $urut=0;
    $nomor=0;
    $group='-';
    foreach($data->result_array()as $d){
    $nomor++;
    $urut++;
    if($group=='-' || $group!=$d['bulan']){
        $bulan=$d['bulan'];
        $query=$this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%M %Y') AS bulan,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) AS total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE_FORMAT(jual_tanggal,'%M %Y')='$bulan'");
        $t=$query->row_array();
        $tots=$t['total'];
        if($group!='-')
        echo "</table><br>";
        echo "<table class='table table-sm table-bordered text-sm'>";
        echo "<tr class='bg-info'><td colspan='8'><b>Bulan: $bulan</b></td> <td class='text-right'><b>Total:</b></td><td class='text-right'><b>".'Rp '.number_format($tots)."</b></td></tr>";
echo "<tr class='bg-light'>
    <td width='3%' align='center'>No</td>
    <td width='8%' align='center'>No Faktur</td>
    <td width='10%' align='center'>Tanggal</td>
    <td width='10%' align='center'>Kode Barang</td>
    <td width='30%' align='center'>Nama Barang</td>
    <td width='7%' align='center'>Satuan</td>
    <td width='7%' align='center'>Harga Jual</td>
    <td width='5%' align='center'>Qty</td>
    <td width='7%' align='center'>Diskon</td>
    <td width='10%' align='center'>Subtotal</td>
    
    </tr>";
$nomor=1;
    }
    $group=$d['bulan'];
        if($urut==500){
        $nomor=0;
            echo "<div class='pagebreak'> </div>";
            //echo "<center><h2>KALENDER EVENTS PER TAHUN</h2></center>";
            }
        ?>
        <tr>
                <td style="text-align:center;vertical-align:top;text-align:center;"><?php echo $nomor; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['jual_nofak']; ?></td>
                <td style="vertical-align:top;text-align:center;"><?php echo $d['jual_tanggal']; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['d_jual_barang_id']; ?></td>
                <td style="vertical-align:top;padding-left:5px;">
                <?php echo $d['d_jual_barang_nama']; ?>
            
                <?php if($d['varian'] > 0){?>
                    <br>
                    <b>Varian :</b> 
                    <?php 
                        $bv = $this->db->get_where('tbl_barang_varian',['id' => $d['varian']])->row();
                        if($bv){
                            echo $bv->sn.' / '.$bv->warna.' / '.$bv->spesifikasi; 
                        }
                    }
                ?>
                </td> 
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['d_jual_barang_satuan']; ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo 'Rp '.number_format($d['d_jual_barang_harjul']); ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:center;"><?php echo $d['d_jual_qty']; ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo 'Rp '.number_format($d['d_jual_diskon']); ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo 'Rp '.number_format($d['d_jual_total']); ?></td> 
        </tr>
        

        <?php
        }
        ?>
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