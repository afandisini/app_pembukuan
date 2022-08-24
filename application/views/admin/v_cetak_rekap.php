<?php $this->load->view("admin/part/head_lap") ?>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <h3 class="text-center mt-3 mb-3">Rekapitulasi </h3>
            <p class="text-center"><?= $periode;?></p>
            <div id="laporan">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light">
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>
                                <?php if(isset($anama->anama)){ echo $anama->anama; }else{ echo ' '; } ?>
                            </td>
                            <td>
                            Rp <?php if(isset($amas->amas)){ echo number_format($amas->amas); }else{ echo '0'; } ?>
                            </td>
                            <td>
                            <?php if(isset($akel->akel)){ echo 'Rp ' .$akel->akel ; }else{ echo '0'; } ?>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="text-right">
                            <th colspan="1">Total:</th>
                            <td class="text-right">Rp
                                <?php if(isset($masuk->msk)){ echo number_format($masuk->msk); }else{ echo 0; } ?>
                            </td>
                            <td class="text-right">Rp
                                <?php if(isset($keluar->klr)){ echo number_format($keluar->klr); }else{ echo 0; }?>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">Estimasi Hasil</th>
                            <th class="text-right">Rp
                                <?php 
                                    if(isset($masuk->msk)){ $msk = $masuk->msk; }else{ $msk =0; }  
                                    //if(isset($jual->jt)){ $jl = $jual->jt; }else{ $jl = 0; }
                                    if(isset($keluar->klr)){ $klr = $keluar->klr; }else{ $klr =0; }
                                    echo number_format($msk-$klr); 
                                ?>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
    <?php $this->load->view("admin/part/fool") ?>