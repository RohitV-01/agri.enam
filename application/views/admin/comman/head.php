<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>
	<?php if(isset($title)){ 
		echo 'eNAM Admin|'.$title;
	}else {
		echo 'eNAM Admin';
	}
	?>	
</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/admin/bootstrap/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/admin/dist/css/AdminLTE.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/admin/dist/css/skins/_all-skins.min.css" />

<!--<link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>assest/admin/css/sb-admin.css"/>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/admin/css/admin-custom-style.css"/>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.1.min.js" integrity="sha256-UnTx9ZAnD7Sme94jD2ZnrR4P3Lgn5i8GsnZ1t6V3x00=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assest/admin/ckeditor/sample.js" ></script>
</head>
