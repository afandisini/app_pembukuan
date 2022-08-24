<!DOCTYPE html>
<html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Software Penjualan">
		<meta name="author" content="Afan Hermawan">
		<?php $peng = $this->m_pengaturan->tampil_pengaturan();?><?php $x=$peng->row_array(); ?><?php foreach ($peng->result_array() as $i):$pnm=$i['pengaturan_nama'];?><?php if (!empty($pnm)) { ?><title><?= $pnm;?> - <?php echo isset($nmpage) ? $nmpage : 'Cetak Nota'; ?></title><?php } else {?><title>Flash Retail - <?php echo isset($nmpage) ? $nmpage : 'Cetak Nota'; ?></title><?php }?><?php endforeach; ?>

		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<link rel="icon" href="<?php echo base_url().'favicon.ico'?>" type="image/x-icon">
		<link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/fontawesome-free/css/all.min.css'?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/dist/css/adminlte.min.css'?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/dist/css/mod.css'?>">
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body class="hold-transition login-page" style="background-image: url('assets/images/bg_flashretail.png');background-position: center;background-repeat: no-repeat;">
			<div class="login-box ">
			<?= alert_bs();?>
			</div>
			<?php $x=$peng->row_array(); ?><?php foreach ($peng->result_array() as $i) : $pnm=$i['pengaturan_nama'];$plogo=$i['pengaturan_logo'];?><h3 class="h1logo bg-danger pr-3 pl-3 pt-2 pb-2 m-0 rounded-top shadow-sm"><?php echo $pnm;?></h3>
			<div class="card-group shadow-sm">
				<div class="card-mod d-none d-md-block">
				<?php if (!empty($plogo)) { ?>
					<img class="card-img" src="<?php echo base_url().'uploads/pengaturan/'.$plogo;?>" height="260px" alt="<?php echo $pnm;?>" title="<?php echo $pnm;?>">
				<?php } else { ?>
					<img class="card-img" src="<?php echo base_url().'uploads/flashretail.webp';?>" height="260px" alt="<?php echo $pnm;?>" title="<?php echo $pnm;?>">
				<?php } ?>
				</div><?php endforeach; ?>
				<div class="card-mod">
					<div class="card-body">
					<p class="login-box-msg"><?php echo isset($nmpage) ? $nmpage : ''; ?></a><br>Masukan ID Pengguna Anda</p>
					
						<form action="<?php echo base_url().'administrator/cekuser'?>" method="post">
							<div class="input-group mb-3">
							<input type="text" class="form-control bg-warsoft" type="text" name="username" placeholder="ID Login" title="Masukan ID Masuk Anda" required>
							<div class="input-group-append">
								<div class="input-group-text">
									<i class="fal fa-user-circle"></i>
								</div>
							</div>
							</div>
							<div class="input-group mb-3">
							<input type="password" class="form-control bg-warsoft" name="password" title="Masukan Kata Sandi Anda" placeholder="Kata Sandi" required>
							<div class="input-group-append">
								<div class="input-group-text">
									<i class="fal fa-lock"></i>
								</div>
							</div>
							</div>
							<div class="row">
								<div class="col-4">
									<div class="icheck-danger">
									<input type="checkbox" id="remember" checked>
									<label for="remember">
										Ingatkan
									</label>
									</div>
								</div>
								<div class="col-4">
								</div>
								<div class="col-4">
									<button type="submit" class="btn btn-success btn-flat btn-sm">Masuk</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url().'assets/adminlte/plugins/jquery/jquery.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'?>"></script>
		<script src="<?php echo base_url().'assets/adminlte/dist/js/adminlte.min.js'?>"></script>
		<script>
			//angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
			$(document).ready(function(){setTimeout(function(){$(".alert-danger").slideUp('slow');}, 2000);});
			//angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
			setTimeout(function(){$(".alert-danger").slideUp('slow');}, 5000);
			$(document).ready(function(){setTimeout(function(){$(".alert-success").slideUp('slow');}, 2000);});
			setTimeout(function(){$(".alert-success").slideUp('slow');}, 5000);
			$(document).ready(function(){setTimeout(function(){$(".alert-warning").slideUp('slow');}, 2000);});
			setTimeout(function(){$(".alert-warning").slideUp('slow');}, 5000);
			$(document).ready(function(){setTimeout(function(){$(".alert-info").slideUp('slow');}, 2000);});
			setTimeout(function(){$(".alert-info").slideUp('slow');}, 5000);
			$(document).ready(function(){setTimeout(function(){$(".alert-error").slideUp('slow');}, 2000);});
			setTimeout(function(){$(".alert-error").slideUp('slow');}, 5000);
		</script>
		<script>
			var $title = $("a,input,p,label,textarea[title],img,.btn-group,button,.select2-selection,label,.input-group-text"); 
			$.each($title, function(index, value) {
				$(this).tooltip({
					show: {
						effect: "swing",
						delay: 350
					},
					hide: {
						effect: "swing",
						delay: 350
				}
				});  
			});
		</script>
	</body>
</html>