<?php $this->load->view("admin/part/head_lap") ?>
<?php 
    //$a=$print->row_array();
    $x=$peng->row_array();
    //$d=$varian->row_array();
?>
    <style>
        .h3 {
            font-family: inherit;
            margin-bottom: 0;
            padding: 0;
            font-weight: 500;
            color: inherit;
        }
        .bd-callout {
            padding: 1.25rem;
            margin-bottom: 1.25rem;
            border: 1px solid #eee;
            border-left-width: 0.35rem;
        }
        @page {
            size: A4;
            margin: 1.5cm;
            }

            @media print {
            .page {
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
    </style>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <p class="text-center"></p>
            <div id="laporan" class="m-4 p-4">
                <table class="table table-borderless">
                    <tbody>
                    <?php foreach ($peng->result_array() as $i):
                        $pnm=$i['pengaturan_nama'];
                        $php=$i['pengaturan_hp'];
                        $palt=$i['pengaturan_alt'];
                        $plogo=$i['pengaturan_logo'];
                    ?>
                        <tr>
                            <td rowspan="3" class="p-0 m-0" style="width:10%;"><img class="img-responsive" src="<?php echo base_url().'uploads/pengaturan/'.$plogo;?>" width="100%"/></td>
                        </tr>
                        <tr>
                            <td class="text-left" style="width:60%;">
                                <span class="h3"><?= $pnm;?></span><br>
                                <i class="fal fa-map-marker-alt mr-2"></i><?= $palt;?><br><i class="fal fa-mobile-android mr-2"></i><?= $php;?>
                            </td>
                            <td class="text-left" style="width:30%;">
                                <ul class="fa-ul">Kepada:
                                    <li><i class="fal fa-user-hard-hat mr-2"></i><?= $a['nama'];?></li>
                                    <li><i class="fal fa-mobile-android mr-2"></i>(+62)<?= $a['hp'];?></li>
                                    <li><i class="fal fa-building mr-2"></i></i><?= $a['alamat'];?></li>
                                </ul>
                            </td>                            
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <div class="table-responsive-sm">
                    <table class="table table-borderless">
                        <tr class="text-right text-sm">
                            <td colspan="6">Tgl Faktur: <?=tgl_indo($a['tgl_cetak']);?></td> 
                        </tr>
                    </table>
                    <table class="table table-bordered table-sm">
                        <thead> <tr>
                                <th scope="col" style="width:2%;">#!</th>
                                <th scope="col" style="width:6%;">No.Faktur</th>
                                <th scope="col" style="width:15%;">Nama</th>
                                <th scope="col" style="width:31%;">Keterangan</th>
                                <th scope="col" style="width:23%;">Kegiatan</th>
                                <th scope="col" style="width:23%;">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?php $no=1; echo $no++;?></th>
                                <td><?= $a['no_nota'];?></td>
                                <td><?= $a['nama'];?></td>
                                <td><?= $a['cetaknota_ket'];?></td>
                                <td><?= $a['keg_nama'];?></td>
                                <td><?php $nom=$a['nominal'];$nom2=$a['nominal2'];$totnom=$nom+$nom2; echo  'Rp ' .number_format($totnom); ?></td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="col-6 col-sm-6 float-right mt-3 form-group">
                                        <label for="exampleFormControlTextarea1">Pernyataan/Perjanjian</label>
                                        <div class="bd-callout text-sm">
                                            <p><?= $a['catatan'];?><br><code class="highlighter-rouge ml-2"><?= '-' .$pnm. '-';?></code></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                            
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td>
                                <div class="pb-2"><br>Pihak 1</div>
                            </td>
                            <td class="text-right">
                                <?php $peng = $this->m_pengaturan->tampil_pengaturan();?><?php foreach ($peng->result_array() as $i) : $kota=$i['pengaturan_kota'];?><?php echo $kota;?>, <?php endforeach; ?><?php echo tgl_indo(date('Y-m-d'));?><br>Pihak ke 2
                            <td>
                            
                        </tr>
                        <tr>
                            <td><img class="img-fluid pt-2 mt-2" width="100px" src="<?php echo base_url().'uploads/cetaknota/materai.jpg';?>"><td>
                            <td><td>
                            
                        </tr>
                        <tfoot>
                            <tr>
                                <td><div class="pt-2">(<?= $a['nama'];?>)</div></td>
                                <td><div class="pt-2 text-right">(<?php echo $this->session->userdata('nama');?>)<td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
    <?php $this->load->view("admin/part/fool") ?>