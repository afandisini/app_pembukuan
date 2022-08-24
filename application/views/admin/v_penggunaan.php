<?php $this->load->view("admin/part/head") ?>
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
      <ul class="navbar-nav">
        <li class="nav-item">
            <span class="nav-link" role="button">
                <i class="fal fa-user-hard-hat mr-2"></i><?php echo isset($nmpage) ? $nmpage : ' '; ?>
            </span>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span class="nav-link">
              <?php $user = $this->db->get_where('tbl_user',['user_id' => $this->session->userdata('idadmin')])->row();?> 
              <?php if (!empty($user->user_foto)) { ?>
                <img class="rounded-circle mr-1"
                src="<?php echo base_url().'uploads/users/'.$user->user_foto;?>" alt="<?php echo $this->session->userdata('nama');?>" title="<?php echo $this->session->userdata('nama');?>">
              <?php } else { ?>
                <i class='fal fa-user-circle fa-lg mr-1'></i>
              <?php } ?>
              <span class="text-uppercase">
                <?php echo $this->session->userdata('nama');?> 
              </span>
            </span>
        </li>
        <li class="nav-item">
          <a class="nav-link" title="Kembali Ke Dasbor" href="<?php echo base_url().'admin/dasbor'?>" role="button">
            <i class="fal shadow-sm fa-times-square fa-lg"></i>
          </a>
        </li>
      </ul>
    </nav>
    <div class="content-wrapper">
        <section class="content-body pt-4 mr-3">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center"><?= alert_bs();?></div>
                <div class="row">
                    <div class="col-5 col-sm-5">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="card-tools btn-group shadow-sm">
                                    <a href="<?php echo base_url().'admin/penggunaan/reset'?>" title="Reset Keranjang" class="btn btn-danger btn-sm"><i class="fal fa-sync mr-2"></i>Reset</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                    <div class="col-12">
                                        <label class="text-muted font-weight-light ml-2"><i class="fal fa-barcode-read mr-2"></i></i>Nama Barang</label>
                                        <div class="input-group pl-2 pr-2">
                                            <input type="text" class="form-control form-control-navbar antichap" name="kode_brg" id="kode_brg" type="search" placeholder="Cari Kode Barang / SN/IMEI atau Nama Barang">
                                            <div class="input-group-append">
                                                <a href="#" data-toggle="modal" data-target="#largeModal" title="Cari Produk"  class="btn btn-navbar"><i class="fal fa-search text-muted"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <div class="table-responsive-sm pt-4">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">!#</th>
                                                <th scope="col">BARANG</th>
                                                <th scope="col">HARGA</th>
                                                <th scope="col">QTY</th>
                                                <th scope="col">SUBTOT</th>
                                                <th scope="col">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;  $total= 0; $disc= 0; ?>
                                            <?php $no=1; foreach ($keranjang as $items): ?>
                                            <?php echo form_hidden($i.'[id]', $items['barang_id']); ?>    
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?=$items['name'];?></td>
                                                <td><span class="text-muted"><?php echo 'Rp.' .number_format($items['amount']);?></span> <span class="text-muted"><?php echo number_format($items['disc']);?> (Diskon)
                                                    <?php if($items['varian'] > 0){?>
                                                             | <?php 
                                                                $bv = $this->db->get_where('tbl_barang_varian',['id' => $items['varian']])->row();
                                                                echo $bv->sn.' | '.$bv->warna. ' | ' ; 
                                                            }
                                                          ?></span>                                                    
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted"><?php echo number_format($items['qty']);?></span>
                                                </td>
                                                <td>
                                                    <?php echo 'Rp.' .number_format(($items['amount'] * $items['qty']) - $items['disc']);?>
                                                </td>
                                                <td>
                                                    <span class="mr-4"><a href="<?php echo base_url().'admin/penggunaan/remove/'.$items['id'];?>" class="btn btn-outline-danger btn-xs"><i class="fal fa-trash-alt mr-2"></i> Hapus</a></span>
                                                </td>
                                            </tr>
                                            <?php $i++; $total += ($items['amount'] * $items['qty']) - $items['disc']; ?><?php endforeach; ?>
                                        </tbody>
                                        <tfoot><tr><th colspan="6"></th></tr></tfoot>
                                    </table>
                                </div>
                                <div class="card-outline card-secondary bg-warsoft pt-2">
                                    <form action="<?php echo base_url().'admin/penggunaan/simpan_penggunaan'?>" method="post">
                                        <input type="hidden" value="0" id="ppn" name="ppn">
                                        <div class="row pl-3 pr-3 ">
                                            <div class="col-sm-6">
                                                
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Total Nilai Barang</label>
                                                <input type="hidden" id="totalbelanja" name="totalbelanja" value="<?php echo $total;?>" class="form-control" readonly>
                                                <div class="input-group mb-3">
                                                    <input type="text" id="totalBayar" name="totalBayar" value="<?php echo 'Rp ' .number_format( $total), ',-';?>" class="form-control" readonly>
                                                    <input type="hidden" id="total" name="total" value="<?php echo $total;?>" class="form-control" readonly>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success btn-sm" type="submit" id="button-addon2">Gunakan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pr-3 pl-3">
                                            <div class="col-sm-6">
                                                    <input type="hidden" name="jml_uang" class="form-control" value="<?php echo $total;?>" required>
                                                    <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control" required>
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <input type="hidden" id="kembalian2" name="kembalian2" class="form-control form-control-navbar" value="<?php echo $total;?>" readonly>
                                                <input type="hidden" id="kembalian" name="kembalian" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 col-sm-7">
                        <div class="card">
                            <div class="card-body p-0">
                                <form  class="form" action="<?php echo base_url().'admin/penggunaan/add_to_cart'?>" method="post">
                                    <div id="detail_barang" class="table-responsive-sm mt-3"></div>
                                </form>
                                <div class="table-responsive-sm">
                                    <table class="table table-hover table-sm w-100" id="penggunaan">
                                        <thead>
                                            <tr>
                                                <th style="width:50px;">No</th>
                                                <th>Tgl</th>
                                                <th>Barang</th>
                                                <th>Kegiatan</th>
                                                <th>Jual</th>
                                                <th>Qty</th>
                                                <th>Satuan</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>Stok: <span class="text-xs text-danger">(sortir)</span></th>
                                                <th></th>
                                                <th>Total: </th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th colspan="8"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0 text-sm">
                        <h6 class="modal-title" id="tmb_custLabel">Cari Produk</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times-circle"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="table-responsive-sm">
                            <table class="table table-hover table-sm w-100" id="table-query">
                                <thead>
                                    <tr>
                                        <th style="width:5px">#</th>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Kegiatan</th>
                                        <!--<th>Satuan</th>-->
                                        <th>Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view("admin/part/foo") ?>
        <script type="text/javascript">
             $(function(){
                $('.antichap').bind('input', function() {
                var c = this.selectionStart,
                    r = /[^a-z0-9 .]/gi,
                    v = $(this).val();
                if(r.test(v)) {
                    $(this).val(v.replace(r, ''));
                    c--;
                }
                this.setSelectionRange(c, c);
                });
            });
        </script>
        <script type="text/javascript">
            $(function(){
                $('#jml_uang').on("input",function(){
                    var total=$('#total').val();
                    var jumuang=$('#jml_uang').val();
                    var hsl=jumuang.replace(/[^\d]/g,"");
                    $('#jml_uang2').val(hsl);
                    $('#kembalian2').val('Rp '+number_format(hsl-total)+',-');
                    $('#kembalian').val(hsl-total);
                });
                
                $('#ppn').on("input",function(){
                    var total=$('#totalbelanja').val();
                    var ppn=$('#ppn').val();

                    var total =  total.replace(/\D/g, '');
                    var totalPajak = parseInt(total*(ppn/100));
                    var hsl = parseInt(total) + totalPajak;
                    console.log(hsl);
                    $('#totalBayar').val('Rp'+number_format(hsl)+',');
                    $('#jml_uang2').val(hsl);
                    $('#total').val(hsl);
                });
            });
        </script>
        <script type="text/javascript">
            $(function(){
                $('.jml_uang').priceFormat({
                        prefix: '',
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ','
                });
                $('#jml_uang2').priceFormat({
                        prefix: '',
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ''
                });
                $('#kembalian').priceFormat({
                        prefix: '',
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ','
                });
                $('.harjul').priceFormat({
                        prefix: '',
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ','
                });
            });
        </script>
        <script>
            $('#table-query tbody').on('click', '.ubah', function(){
                var kobar = {kode_brg:$(this).attr('data-id')};
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url().'admin/penggunaan/get_barang';?>",
                    data: kobar,
                    success:function(html){
                        $('#largeModal').modal('hide');
                        $('#detail_barang').html(html);
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#kode_brg").focus();
                    $("#kode_brg").on("input",function(){
                        var kobar = {kode_brg:$(this).val()};
                        $.ajax({
                        type: "POST",
                        url : "<?php echo base_url().'admin/penggunaan/get_barang';?>",
                        data: kobar,
                        success: function(msg){
                            $('#detail_barang').html(msg);
                            }
                    });
                }); 
                $("#kode_brg").keypress(function(e){
                    if(e.which==13){
                        $("#jumlah").focus();
                    }
                });
            });
        </script>
        <script>
            var tabel = null;
            $(document).ready(function() {
                tabel = $('#table-query').DataTable({
                    "processing": true,
                    "responsive":true,
                    "serverSide": true,
                    "ordering": true, // Set true agar bisa di sorting
                    language: {url: '<?= base_url('assets/id.json');?>'},
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [ 10, 25, 50, 999999 ],
                        [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                    ],
                    buttons: [
                        {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-outline-success btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}, footer: true}
                    ],
                    "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                    "ajax":
                    {
                        <?php if(!empty($this->input->get('sortir') == 'limit')){?>
                        "url": "<?= base_url('admin/barang/data?sortir=limit');?>",
                        <?php }else if(!empty($this->input->get('sortir') == 'varian')){?>
                        "url": "<?= base_url('admin/barang/data?sortir=varian');?>",
                        <?php }else if(!empty($this->input->get('sortir') == 'satuan')){?>
                        "url": "<?= base_url('admin/barang/data?sortir=satuan');?>",
                        <?php }else{?>
                        "url": "<?= base_url('admin/barang/data');?>",
                        <?php }?>
                        "type": "POST"
                    },
                    "deferRender": true,
                    "columns": [
                        {"data": 'barang_id',"sortable": false, 
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }  
                        },
                        {"data": "barang_id"},  // Tampilkan kategori
                        {"className" : "text-nowrap",
                          "data": "barang_nama"},
                        {"data": "keg_nama",
                            "render": 
                                function( data, type, row, meta ) {
                                    return `<span class="d-inline-block text-truncate" style="max-width:250px;">
                                    ${row.keg_nama}</span>`;
                                }
                        },  
                        //{ "data": "kategori_nama"}, 
                        //{ "data": "barang_satuan"}, 
                        {"data": "barang_harjul", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp ' ) }, 
                        {"className" : "text-center",
                          "data": "barang_stok"}, 
                        {"data": "barang_satuan"}, 
                        {"data": "barang_id",
                            "render": 
                            function( data, type, row, meta ) {
                                if(row.barang_stok > 0){
                                    return ` <button class="btn btn-success btn-xs ubah" data-id="${row.barang_id}" 
                                                title="Pilih"><i class="fal fa-shopping-cart mr-1"></i> Pilih
                                            </button>`;
                                }else{
                                    return ` <button class="btn btn-danger btn-xs disabled" 
                                                title="Pilih"><i class="fal fa-ban mr-1"></i> Habis
                                            </button>`;
                                }
                            }
                        },
                    ],
                }).buttons().container().appendTo('#table-query_wrapper .col-ms-6:eq(0)');
            });
        </script>
        <script>
            var tabel = null;
            $(document).ready(function() {
                tabel = $('#penggunaan').DataTable({
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api();
            
                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };
            
                        // Total over all pages
                        stok = api
                            .column(5)
                            .data()
                            .reduce(function (x, y) {
                                return intVal(x) + intVal(y);
                            }, 0);
                        total = api
                            .column(7)
                            .data()
                            .reduce(function (x, y) {
                                return intVal(x) + intVal(y);
                            }, 0);
            
                        // Update footer
                        var numFormat = $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' ).display;
                        $( api.column( 5 ).footer() ).html(stok);
                        $( api.column( 7 ).footer() ).html(numFormat(total));
                    },
                    "processing": true,
                    "responsive":true,
                    "serverSide": true,
                    "ordering": true, // Set true agar bisa di sorting
                    language: {url: '<?= base_url('assets/id.json');?>'},
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [ 10, 25, 50, 999999 ],
                        [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                    ],
                    buttons: [
                        {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-info btn-sm', footer: true}
                    ],
                    "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                    "ajax":
                    {
                        "url": "<?= base_url('admin/penggunaan/data');?>",
                        "type": "POST"
                    },
                    "deferRender": true,
                    "columns": [
                        {"data": 'd_jual_id',"sortable": false, 
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1 + '.';
                            }  
                        },
                        {"class": "text-left", "data": "jual_tanggal", 
                            render: function (value) {
                                if (value === null) return "";
                                return moment(value).format('YYYY-MM-DD');}
                        },
                        {"data": "d_jual_barang_nama" },
                        {"data": "keg_nama",
                            "render": 
                                function( data, type, row, meta ) {
                                    return `<span class="d-inline-block text-truncate" style="max-width:150px;">
                                    ${row.keg_nama}</span>`;
                                }
                        },
                        {"data": "d_jual_barang_harjul", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                        {"data": "d_jual_qty" },
                        {"data": "d_jual_barang_satuan"},
                        {"data": "d_jual_total", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                    ],
                }).buttons().container().appendTo('#inputdata_wrapper .col-ms-6:eq(0)');
            });
        </script>
</body>
</html>
