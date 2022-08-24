<?php $this->load->view("admin/part/head") ?>
    <div id="laporan" class="p-4">
        <h4 class="text-center">LAPORAN DATA BARANG</h4>
        <table class="table table-sm table-bordered" id="mydata">
        <?php 
            $urut=0;
            $nomor=0;
            $group='-';
            foreach($data->result_array()as $d){
            $nomor++;
            $urut++;
            if($group=='-' || $group!=$d['kategori_nama']){
                $kat=$d['kategori_nama'];
                
                if($group!='-')
                echo "</table><br>";
                echo "<table class='table table-sm table-bordered'>";
                echo "<tr><td colspan='6'><b>Kategori: $kat</b></td> </tr>";
        echo "<tr class='bg-light'>
            <td width='4%' align='center'>No</td>
            <td width='10%' align='center'>Kode Barang</td>
            <td width='40%' align='center'>Nama Barang</td>
            <td width='10%' align='center'>Satuan</td>
            <td width='20%' align='center'>Harga Jual</td>
            <td width='30%' align='center'>Stok</td>
            
            </tr>";
        $nomor=1;
            }
            $group=$d['kategori_nama'];
                if($urut==500){
                $nomor=0;
                    echo "";

                    }
                ?>
                <tr class="text-sm">
                        <td style="text-align:center;vertical-align:center;text-align:center;"><?php echo $nomor; ?></td>
                        <td style="vertical-align:center;padding-left:5px;text-align:center;"><?php echo $d['barang_id']; ?></td>
                        <td style="vertical-align:center;padding-left:5px;"><?php echo $d['barang_nama']; ?></td>
                        <td style="vertical-align:center;text-align:center;"><?php echo $d['barang_satuan']; ?></td>
                        <td style="vertical-align:center;padding-right:5px;text-align:right;"><?php echo 'Rp '.number_format($d['barang_harjul']); ?></td>
                        <td style="vertical-align:center;text-align:center;text-align:center;"><?php echo $d['barang_stok']; ?></td>  
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
<script type="text/javascript">
   printDiv("laporan");
function printDiv(id){
        var printContents = document.getElementById(id).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
}
</script>
</div>
<?php $this->load->view("admin/part/head") ?>