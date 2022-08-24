<?php
    $query=$this->db->query("SELECT * FROM tbl_user WHERE user_id");
?>
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'admin/dasbor'?>" title="Kembali ke Dasbor" role="button"><?php if($menu == 'dasbor'){ echo '<i class="fal fa-tachometer-alt mr-1"></i>';}?><?php if($menu == 'kategori'){ echo '<i class="fal fa-network-wired mr-1"></i>';}?><?php if($menu == 'cetak'){ echo '<i class="fal fa-print mr-1"></i>';}?><?php if($menu == 'cetakfaktur'){ echo '<i class="fal fa-print mr-1"></i>';}?><?php if($menu == 'rekanan'){ echo '<i class="fal fa-user-plus mr-1"></i>';}?><?php if($menu == 'inputdata'){ echo '<i class="fal fa-sign-in-alt mr-1"></i>';}?><?php if($menu == 'piutang'){ echo '<i class="fal fa-file-invoice mr-1"></i>';}?><?php if($menu == 'jurnal'){ echo '<i class="fal fa-table mr-1"></i>';}?><?php if($menu == 'rekap'){ echo '<i class="fal fa-chart-line mr-1"></i>';}?><?php if($menu == 'cetaknota'){ echo '<i class="fal fa-print mr-1"></i>';}?><?php if($menu == 'barang'){ echo '<i class="fal fa-boxes mr-1"></i>';}?><?php if($menu == 'penggunaan'){ echo '<i class="fal fa-user-clock mr-1"></i>';}?><?php if($menu == 'pengguna'){ echo '<i class="fal fa-user-unlock mr-1"></i>';}?><?php if($menu == 'pengaturan'){ echo '<i class="fal fa-cog mr-1"></i>';}?><?php echo isset($nmpage) ? $nmpage : '<i class="fal fa-print mr-1"></i> Cetak Faktur'; ?></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span class="nav-link">
              <?php $user = $this->db->get_where('tbl_user',['user_id' => $this->session->userdata('idadmin')])->row();?> 
              <?php if (!empty($user->user_foto)) { ?>
                <img class="rounded-circle mr-1" 
                style="width:35px;margin-top:-5px;"
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
          <a class="nav-link" data-toggle="modal" title="Keluar Aplikasi" data-target=".bd-example-modal-sm" href="#" role="button">
            <i class="fal fa-power-off text-danger text-sm"></i>
          </a>
        </li>
      </ul>
    </nav>
      <aside class="main-sidebar sidebar-dark-success text-sm">
      <?php $h=$this->session->userdata('akses'); ?>
      <?php $u=$this->session->userdata('user'); ?>
      <?php if($h=='1'){ ?>
        <a href="<?php echo base_url().'admin/dasbor'?>" class="brand-link">
          <?php $peng = $this->m_pengaturan->tampil_pengaturan();?>
          <?php $x=$peng->row_array(); ?>
          <?php foreach ($peng->result_array() as $i):
              $pid=$i['pengaturan_id'];
              $pnm=$i['pengaturan_nama'];
              $palt=$i['pengaturan_alt'];
              $php=$i['pengaturan_hp'];
              $plogo=$i['pengaturan_logo'];
          ?>
          <?php if (!empty($plogo)) { ?>
            <img class="brand-image img-circle mr-1" src="<?php echo base_url().'uploads/pengaturan/'.$plogo;?>" alt="<?php echo $pnm;?>" title="<?php echo $pnm;?>">
          <?php } else { ?>
            <img class="brand-image img-circle mr-1" src="<?php echo base_url().'uploads/flashretail.webp';?>" alt="<?php echo $pnm;?>" title="<?php echo $pnm;?>">
          <?php } ?>
          <span class="brand-text h1logo text-sm"><?php echo $pnm;?></span>
          <?php endforeach; ?>
        </a>
        <div class="sidebar">
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column m-0" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item <?php if($menu == 'inputdata'){ echo 'menu-open';}?><?php if($menu == 'piutang'){ echo 'menu-open';}?><?php if($menu == 'jurnal'){ echo 'menu-open';}?><?php if($menu == 'rekap'){ echo 'menu-open';}?><?php if($menu == 'cetaknota'){ echo 'menu-open';}?>">
                <a href="#" class="nav-link <?php if($menu == 'inputdata'){ echo 'active';}?><?php if($menu == 'piutang'){ echo 'active';}?><?php if($menu == 'jurnal'){ echo 'active';}?><?php if($menu == 'rekap'){ echo 'active';}?>">
                  <i class="fal fa-book mr-1"></i>
                  <p>PEMBUKUAN <i class="right fal fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-header">INPUT</li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/inputdata'?>" class="nav-link <?php if($menu == 'inputdata'){ echo 'active';}?>">
                      <i class="fal fa-sign-in-alt mr-1"></i>
                        <p>Input Data</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/piutang'?>" class="nav-link <?php if($menu == 'piutang'){ echo 'active';}?>">
                        <i class="fal fa-file-invoice mr-1"></i>
                        <p>Piutang</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/jurnal'?>" class="nav-link <?php if($menu == 'jurnal'){ echo 'active';}?>">
                      <i class="fal fa-table mr-1"></i>
                        <p>Jurnal</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/rekap'?>" class="nav-link <?php if($menu == 'rekap'){ echo 'active';}?>">
                      <i class="fal fa-chart-line mr-1"></i>
                        <p>Rekapitulasi</p>
                      </a>
                    </li>
                  </ul>
              </li>
              <div class="dropdown-divider"></div>
              <li class="nav-item <?php if($menu == 'barang'){ echo 'menu-open';}?><?php if($menu == 'penggunaan'){ echo 'menu-open';}?>">
                <a href="#" class="nav-link <?php if($menu == 'barang'){ echo 'active';}?><?php if($menu == 'penggunaan'){ echo 'active';}?>">
                    <i class="far fa-box-check mr-1"></i>
                  <p>BARANG <i class="right fal fa-angle-left"></i>
                  </p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-header">INPUT</li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/barang'?>" class="nav-link <?php if($menu == 'barang'){ echo 'active';}?>">
                      <i class="fal fa-boxes mr-1"></i>
                        <p>Barang</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/penggunaan'?>" class="nav-link <?php if($menu == 'penggunaan'){ echo 'active';}?>">
                      <i class="fal fa-shipping-fast mr-1"></i>
                        <p>Pemakaian</p>
                      </a>
                    </li>
                  </ul>
              </li>
              <div class="dropdown-divider"></div>
              <li class="nav-item">
                <a href="<?php echo base_url().'admin/cetaknota'?>" class="nav-link <?php if($menu == 'cetaknota'){ echo 'active';}?>">
                  <i class="fal fa-file-alt mr-1"></i>
                  <p>NOTA</p>
                </a>
              </li>
              <div class="dropdown-divider"></div>
              <!-- EDIT-->
              <li class="nav-item <?php if($menu == 'pengaturan'){ echo 'menu-open';}?><?php if($menu == 'pengguna'){ echo 'menu-open';}?><?php if($menu == 'rekanan'){ echo 'menu-open';}?>">
                <a href="#" class="nav-link <?php if($menu == 'pengaturan'){ echo 'active';}?><?php if($menu == 'pengguna'){ echo 'active';}?><?php if($menu == 'rekanan'){ echo 'active';}?>">
                  <i class="fal fa-cog mr-1"></i>
                    <p>PENGATURAN <i class="right fal fa-angle-left"></i></p>
                </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-header">APLIKASI</li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/pengguna'?>" class="nav-link <?php if($menu == 'pengguna'){ echo 'active';}?>">
                      <i class="fal fa-user-unlock mr-1"></i>
                        <p>Pengguna</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/rekanan'?>" class="nav-link <?php if($menu == 'rekanan'){ echo 'active';}?>">
                      <i class="fal fa-user-plus mr-1"></i>
                        <p>Rekanan</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url().'admin/pengaturan'?>" class="nav-link <?php if($menu == 'pengaturan'){ echo 'active';}?>">
                      <i class="fal fa-cog mr-1"></i>
                        <p>Profil</p>
                      </a>
                    </li>
                  </ul>
              </li>
              <!--Pengaturan-->
              <div class="dropdown-divider"></div>
            </ul>
          </nav>
        </div>
      <?php } ?>
    </aside>

    <!-- MODAL -->
    <div class="modal fade bd-example-modal-sm" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content card-outline card-danger bg-light">
          <div class="modal-header border-0">
                <h5 class="card-title"><span class="fal fa-power-off mr-1 text-danger"></span>Perhatian!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
            Hai <span class="font-weight-bold"><?php echo $this->session->userdata('nama');?></span>, Apakah Anda ingin Keluar dari Aplikasi ini?
          </div>
          <div class="modal-footer border-0">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
              <a class="btn btn-danger btn-sm" href="<?php echo base_url().'administrator/logout'?>">Keluar</a>
            </div>
          </div>       
        </div>
      </div>
    </div>
   
   <div class="content-wrapper">
    <section class="content-body <?php if($menu == 'dasbor'){ echo 'pt-2';}else{ echo 'pt-4';?><?php } ?> mr-3">
      <div class="container-fluid">
      <?php if($menu == 'dasbor'){?>
          <div class="row d-flex justify-content-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                  <div class="text-muted font-weight-light text-sm">
                    <?php  
                          $tanggal= mktime(date("m"),date("d"),date("Y"));
                          date_default_timezone_set('Asia/Makassar');
                          $a = date ("H");
                          if (($a>=6) && ($a<=11)){
                          echo "<i class='fal fa-cloud-sun mr-1'></i>Selamat Pagi";
                          }
                          else if(($a>11) && ($a<=14))
                          {
                          echo "<i class='fal fa-sun mr-1'></i>Selamat Siang";}
                          else if (($a>14) && ($a<=18)){
                          echo "<i class='fal fa-sun mr-1'></i>Selamat Sore";}
                          else { echo "<i class='fal fa-moon mr-1'></i>Selamat Malam";}
                        ?>, <i class="fal fa-clock"></i> <?php echo date('H:i:s') ;?>, <i class="fal fa-calendar-alt mr-1"></i><?php echo date('d/m/Y') ;?>
                    </div>
                  </li>
              </ol>
          </div>
      <?php } ?>
      </div>
    </section>