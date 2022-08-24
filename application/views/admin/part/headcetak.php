<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Software Penjualan">
    <meta name="author" content="Afan Hermawan">
    <meta name="robots" content="noimageindex, nofollow, nosnippet">
    <title>Flash Retail - <?php echo isset($nmpage) ? $nmpage : 'Cetak Nota Penjualan'; ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="icon" href="<?php echo base_url().'favicon.ico'?>" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/fontawesome-free/css/all.min.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/dist/css/adminlte.min.css'?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/dist/css/mod.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/select2/css/select2.min.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'?>">
    <link rel="icon" href="<?php echo base_url().'favicon.ico'?>" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/adminlte/plugins/daterangepicker/daterangepicker.css'?>">
    
    <?php $this->load->view("admin/part/app") ?>
</head>
<body  onload="jam()" class="hold-transition sidebar-collapse layout-navbar-fixed">