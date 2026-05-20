<!DOCTYPE html>
<html>
<?php print_r($head); 

$theme_color = $this->session->userdata('theme');
		if($theme_color){
		    $theme_color;
		}else{
		    $theme_color = 'green-theme';
		}
?>
 <body id="enamHome" class="default-theme font-A <?php echo $page_id; ?> <?php echo $theme_color; ?>"> 
  
<?php date_default_timezone_set("America/New_York"); 
$date = date("Y-m-d");
?>
<input type="hidden" id="global_previous_date" value="<?php echo date('d-m-Y', strtotime($date .' -1 day'));?>" />
<input type="hidden" id="global_current_date" value="<?php echo date('d-m-Y', strtotime($date));?>" />

<?php if(isset($header)){ print_r($header); } ?>
<?php if(isset($navigation)){ print_r($navigation);} ?>
<input type="hidden" id="base_url" value="<?php echo base_url();?>" />
<?php if(isset($main_contant)){print_r($main_contant);} ?>
<?php if(isset($footer)){ print_r($footer);} ?>

<div id="state_click" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content mandis-list-pop">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body text-center">
<img alt="" style="width:500px;" src="<?php echo base_url();?>/assest/images/new-theme/map.jpg" />
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=UA-128172535-1"></script>
<script type="text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128172535-1');

  
</script>


<script type="text/javascript">
     if ($('#language_selector').val() == 12) 
     {
      //alert("okay");
       $('.font-A .quick-link-list li a').css("font-size", "8.5px");
     }
</script>

<script type="text/javascript">
     if ($('#language_selector').val() == 13) 
     {
      //alert("okay");
       $('.font-A .quick-link-list li a').css("font-size", "11px");
     }
</script>

<script type="text/javascript">
     if ($('#language_selector').val() == 1) 
     {
       $('.content-section .sub-nav-menu-img .reg_hide').hide();
     }

     if ($('#language_selector').val() == 2) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }

        if ($('#language_selector').val() == 3) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 4) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }

        if ($('#language_selector').val() == 5) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 6) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 7) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 8) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 9) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 12) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 13) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
        if ($('#language_selector').val() == 14) 
     {
       $('.content-section .sub-nav-menu-img .multi_hide').hide();
     }
       

</script>


<script type="text/javascript">
     if ($('#language_selector').val() == 2) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       //$('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 3) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       //$('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 4) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       //$('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 5) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       //$('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 6) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       //$('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 7) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       //$('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 8) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       //$('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 9) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       //$('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 12) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       //$('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>
<script type="text/javascript">
     if ($('#language_selector').val() == 13) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       //$('.content-section .sub-nav-menu-img .kan_hide').hide();
       $('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>

<script type="text/javascript">
     if ($('#language_selector').val() == 14) 
     {
      //alert("okay");
       $('.content-section .sub-nav-menu-img .eng_hide').hide();
       $('.content-section .sub-nav-menu-img .hindi_hide').hide();
       $('.content-section .sub-nav-menu-img .guj_hide').hide();
       $('.content-section .sub-nav-menu-img .tel_hide').hide();
       $('.content-section .sub-nav-menu-img .mar_hide').hide();
       $('.content-section .sub-nav-menu-img .ben_hide').hide();
       $('.content-section .sub-nav-menu-img .tam_hide').hide();
       $('.content-section .sub-nav-menu-img .odia_hide').hide();
       $('.content-section .sub-nav-menu-img .pun_hide').hide();
       $('.content-section .sub-nav-menu-img .mal_hide').hide();
       $('.content-section .sub-nav-menu-img .kan_hide').hide();
       //$('.content-section .sub-nav-menu-img .dogri_hide').hide();

     }
</script>


</body>
</html>