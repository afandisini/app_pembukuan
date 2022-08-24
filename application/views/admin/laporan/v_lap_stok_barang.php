<?php $this->load->view("admin/part/head_lap") ?>
<div id="laporan" class="p-4">
<h4 class="text-center">LAPORAN STOK BARANG PERKATEGORI</h4>
 
<table class="table table-sm table-bordered text-sm">
<?php 
    $urut=0;
    $nomor=0;
    $group='-';
    foreach($data->result_array()as $d){
    $nomor++;
    $urut++;
    if($group=='-' || $group!=$d['kategori_nama']){
        $kat=$d['kategori_nama'];
        $query=$this->db->query("SELECT kategori_id,kategori_nama,barang_nama,SUM(barang_stok) AS tot_stok FROM tbl_kategori JOIN tbl_barang ON kategori_id=barang_kategori_id WHERE kategori_nama='$kat'");
        $t=$query->row_array();
        $tots=$t['tot_stok'];
        if($group!='-')
        echo "</table><br>";
        echo "<table class='table table-sm table-bordered text-sm'>";
        echo "<tr><td colspan='2'><b>Kategori: $kat</b></td> <td style='text-align:center;'><b>Total Stok: $tots </b></td></tr>";
echo "<tr class='bg-light'>
    <td width='4%' align='center'>No</td>
    <td width='60%' align='center'>Nama Barang</td>
    <td width='30%' align='center'>Stok</td>
    
    </tr>";
$nomor=1;
    }
    $group=$d['kategori_nama'];
        if($urut==500){
        $nomor=0;
            echo "<div class='pagebreak'> </div>";
            //echo "<h2 class="text-center">KALENDER EVENTS PER TAHUN</h2>";
            }
        ?>
        <tr>
                <td style="text-align:center;vertical-align:top;text-align:center;"><?php echo $nomor; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['barang_nama']; ?></td>
                <td style="vertical-align:top;text-align:center;"><?php echo $d['barang_stok']; ?></td>  
        </tr>
        

        <?php
        }
        ?>
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