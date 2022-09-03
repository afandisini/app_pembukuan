<?php $this->load->view("admin/part/head") ?>
    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>
    
    <!-- Page Content -->
        <section class="content">
            <div class="container-fluid">  
                <div class="row d-flex justify-content-end">
                    <?= alert_bs();?>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="card card-outline card-success">
                            <div class="card-header text-muted border-0">
                                <h3 class="card-title"><i class="fal fa-chart-line mr-2 text-warning"></i> <?php echo isset($head) ? $head : ''; ?></h3>  
                                <div class="card-tools">
                                    <a href="<?= base_url('admin/rekap/reset');?>" class="btn btn-danger btn-sm shadow-sm">
                                        <i class="fal fa-sync mr-2"></i> Reset
                                    </a>
                                </div>                                      
                            </div>
                            <div class="card-body">
                                <label>Pilih Kegiatan</label>
                                <!--<div class="input-group mb-4">
                                    <input class="form-control select2bs5" id="kegnama" type="text" placeholder="Cari Kegiatan">
                                </div>-->
                                <form method="get" action="">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-10">
                                            <select class="form-control select2bs4" name="keg_id" id="keg_id" required>
                                                <option value="">-- Pilih Kegiatan --</option>
                                                <?php foreach($kegiatan as $k){
                                                    echo "<option value='$k->keg_id'>$k->keg_nama</option>";
                                                 }?>
                                            </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="submit" class="btn btn-success btn-md btn-block">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                                <!--<a href="<?= $url;?>" target="_blank" class="btn btn-success btn-sm float-right m-2">
                                    <i class="fal fa-print mr-2"></i> Cetak
                                </a>-->
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12 text-sm">
                        <div class="card card-outline card-danger">
                            <div class="card-header text-muted border-0">  
                                <div class="card-tools">
                                    <h3 class="card-title"><i class="fal fa-file-search mr-2"></i> Hasil Pencarian (IDR)</h3>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-sm table-striped">
                                    <tbody>
                                        <tr>
                                            <td><i class="fal fa-money-check-alt mr-2"></i>PEMASUKAN</td>
                                            <td class="text-right font-weight-bold"><?php if(isset($masuk->msk)){ echo number_format($masuk->msk);  }else{ echo 0; }?></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fal fa-money-check mr-2"></i>PENGELUARAN</td>
                                            <td class="text-right font-weight-bold"><?php if(isset($keluar->klr)){ echo number_format($keluar->klr);  }else{ echo 0; }?></td>
                                        </tr>
                                        <tr>
                                            <td><i class="fal fa-credit-card-blank mr-2"></i>KAS</td>
                                            <td class="text-right font-weight-bold">
                                                <?php  if(isset($masuk->msk)){ $msk = $masuk->msk; }else{ $msk =0; }
                                                        if(isset($keluar->klr)){ $klr = $keluar->klr; }else{ $klr =0; }
                                                        $hsl = $msk-$klr; 
                                                    ?><span <?php if ($hsl < 0) {$p = 'class="text-danger"';}else{$p = '';}$output= $p; echo $p;?>><?php echo number_format($hsl);?></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--<div class="col-lg-3 col-sm-12 text-sm">
                        <div class="card card-outline card-danger">
                            <div class="card-header text-muted border-0">  
                                <div class="card-tools">
                                    <h3 class="card-title"><i class="fal fa-file-search mr-2"></i> Hasil Kegiatan (IDR)</h3>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-sm table-striped">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <i class="fal fa-money-check-alt mr-2"></i>BARANG
                                            </td>
                                            <td class="text-right font-weight-bold">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fal fa-money-check mr-2"></i>PIUTANG
                                            </td>
                                            <td class="text-right font-weight-bold">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fal fa-credit-card-blank mr-2"></i>PELUNASAN</td>
                                            <td class="text-right font-weight-bold">
                                                    
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>-->
                </div>
                
                <div class="col-lg-12 col-sm-12">
                        <div class="card card-outline card-warning">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                </h3> 
                                <div class="card-tools">
                                    <!--<a href="<?= $url;?>" target="_blank" class="btn btn-success btn-sm shadow-sm">
                                        <i class="fal fa-print mr-2"></i> Cetak
                                    </a>-->
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover table-striped" id="table_rekap">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Input</th>
                                                <th>Keterangan</th>
                                                <th>Nama Kegiatan</th>
                                                <th>Dari/Untuk</th>
                                                <th class="text-right">Debet</th>
                                                <th class="text-right">Kredit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=0; foreach($anama as $k){ $no++;?>
                                                <tr>
                                                    <td>
                                                        <?php if(isset($no)){ echo $no; }else{ echo ' '; } ?>
                                                    </td>
                                                    <td>
                                                        <?php if(isset($k->pembukuan_tgl)){ echo $k->pembukuan_tgl; }else{ echo ' '; } ?>
                                                    </td>
                                                    <td>
                                                        <?php if(isset($k->pembukuan_nama)){ echo $k->pembukuan_nama; }else{ echo ' '; } ?>
                                                    </td>
                                                    <td class="d-inline-block text-truncate" style="max-width: 200px;">
                                                        <?php if(isset($k->pembukuan_ket)){ echo $k->pembukuan_ket; }else{ echo ' '; } ?>
                                                    </td>
                                                    <td class="text-truncate" style="max-width: 200px;">
                                                        <?php if(isset($k->keg_nama)){ echo $k->keg_nama; }else{ echo '-'; } ?>
                                                    </td>
                                                    <td>
                                                        <?php if(isset($k->nama)){ echo $k->nama; }else{ echo '-'; } ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php if(isset($k->pembukuan_masuk)){ echo 'Rp ' .number_format($k->pembukuan_masuk); }else{ echo ' '; } ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php if(isset($k->pembukuan_keluar)){ echo 'Rp ' .number_format($k->pembukuan_keluar); }else{ echo ' '; } ?>
                                                    </td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total:</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th class="text-right"><?php if(isset($masuk->msk)){ echo 'Rp ' .number_format($masuk->msk); }else{ echo ''; } ?>
                                                </th>
                                                <th class="text-right"><?php if(isset($keluar->klr)){ echo 'Rp ' .number_format($keluar->klr);  }else{ echo ''; }?>
                                                </th>
                                            </tr>
                                            <tr class="text-right">
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>
                                                    <span class="mr-4">Kas:</span>
                                                    <?php 
                                                        if(isset($masuk->msk)){ $msk = $masuk->msk; }else{ $msk =0; }
                                                        if(isset($keluar->klr)){ $klr = $keluar->klr; }else{ $klr =0; }
                                                        $hsl = $msk-$klr; 
                                                    ?><span <?php if ($hsl < 0) {$p = 'class="text-danger"';}else{$p = '';}$output= $p; echo $p;?>><?php if(isset($hsl)){ echo 'Rp ' .number_format($hsl);}else{ echo ' '; }?></span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>    

    <?php $this->load->view("admin/part/foo") ?>
    <script type="text/javascript">
		//datatable
		$(function () {
		$('#table_rekap').DataTable({
			'responsive': true,
            'searching': false,
            'paging':   true,
            'ordering': true,
            'info':     true,
			language: {url: '<?= base_url('assets/id.json');?>'},
			dom: 'Bfrtip',
            lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                ],
			buttons: [
                    {extend: 'print', text:'<i class="fal fa-print text-white mr-2"></i> Cetak', className: 'btn btn-success btn-sm mb-3', pageSize: 'A4',footer: true},{extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span>Tampilkan</span>', className: 'btn btn-info btn-sm mb-3', footer: true}
                ]
			}).buttons().container().appendTo('#table_rekap_wrapper .col-ms-6:eq(0)');
		});
	</script>
    <script type="application/javascript">
		$('#reservationdate').datetimepicker({
                locale:'id',
				format: 'L'
			});//Date picker
			$('#reservationdatetime').datetimepicker({ icons: { time: 'fal fa-clock' } });//Date and time picker
			//Date range picker
			$('#reservation').daterangepicker({locale:'id'})
			//Date range picker with time picker
	</script>
    <script>
        $('.select2bs5').select2({
            theme: 'bootstrap4'
            });
    </script>
    <script>
        $(document).ready(function(){
            $('#kegnama').select2bs5({
                placeholder: '- Cari Kegiatan -',
                minimumInputLength: 1,
                ajax: {
                    url: "<?= base_url('admin/rekap/get_autocomplete');?>",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
    
</body>

</html>
