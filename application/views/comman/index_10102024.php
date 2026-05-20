<!-- Matomo -->
<!-- Matomo -->
<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//enam.gov.in/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '8']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->

<script type="text/javascript">
  var _paq = window._paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//enam.gov.in/matomo/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '7']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->

<html xmlns="https://www.w3.org/1999/xhtml">
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
//alert("works");
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

</body>
</html>
