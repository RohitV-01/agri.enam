<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/bootstrap.min.css" />
    	<link media="print" rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/print.css" />
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assest/css/print-style.css" />
	</head>
	<body>
		<?php foreach ($commodity as $comm) {
		    if($comm['comm_image'] != ''){
		      $path = base_url().'assest/images/commodity-pro/'.$comm['comm_image'];
              $type = pathinfo($path, PATHINFO_EXTENSION);
              $data = read_file(base_url().'assest/images/commodity-pro/'.$comm['comm_image']);
              $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
			 // echo '<img style="width:" src="'.$base64.'">';
		    }
		    else{
		    $base64 = 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjYzOTc2MzgwRUQ4NzExRTg5QzY5OUI5QUY0REQyODlGIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjYzOTc2MzgxRUQ4NzExRTg5QzY5OUI5QUY0REQyODlGIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NjM5NzYzN0VFRDg3MTFFODlDNjk5QjlBRjRERDI4OUYiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NjM5NzYzN0ZFRDg3MTFFODlDNjk5QjlBRjRERDI4OUYiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwMDAwMDBAMDg8QDw4MExMUFBMTHBsbGxwfHx8fHx8fHx8fAQcHBw0MDRgQEBgaFREVGh8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx8fHx//wAARCABkAGQDAREAAhEBAxEB/8QAfwABAAIDAQEAAAAAAAAAAAAAAAIGAwQFAQgBAQEBAQEAAAAAAAAAAAAAAAABAgQDEAABAwICBgoCAgMAAAAAAAABAAIDEQQSBSExUdEUBkFxkTKSshNTczQiUmEWocFCEQEBAAICAwADAQAAAAAAAAAAARECEgMhMRNBUWEi/9oADAMBAAIRAxEAPwD6pQEBAQEBAUyCoICAgICAgICAgKDXvrtlpayTu04B+I2k6gs2s77cZlhyjMONtBIaCVpwygaqjeplnq7OUy3luV6CoICAgICAgICCEzyyJ7xpLWlwHUKrNS3EcKS/hzixfbNHp3Y/NkZOhxb0ArEct7J2a4/KFhcRZRY1nBNzcHG2AaCG6hi2InXtOvXz7ruWNwbi0inIwmRtS0dC1HVptymWdbaEBAQEBAQFm0eVUzR44BwIIqDoIWbaKxNkd7aXjJbcGSIPBa5veaK9ITDh26NtdsxO7ye+vc1ncQWQ4qeo79QB3R0q2Lt07bb39LFBEyGJkTBRjAGt6gp5duskmE6rWaPaq5BaBAQEBSjic2XM8OXsETyz1JA1xaaGlCaVHUsvLutkVLjLv35PG7eo5eVOMu/fk8bt6HKnGXfvyeN29DlTjLv35PG7ehypxl378njdvQ5U4y79+Txu3ocqsHKd1cyXEkckr3sDHODXEkVq3aq9+ja2rQtR0CoICApRX+cfoQ/KPKViPHv9KijkdKHJpJsoffxuJdG4h0VP+W6yrh6zrzrlgu7IQW9pMHlxuWF+GmqhpRGdtcSNjM8kfY2sU/qeoXUbM2nccRUBLGt+vEez5L6eURZg2UuL8JdFTUHGmvrTBev/ADkzXJRYW0EplxvlNHspTCaVSw368Ru8n/bl+N3mapfTfR7W0LcdIqCAgKUV/nH6EPyjylYjx7/TkZa2CPLn3DQ19z6oD2lzWFsbdOs9BOuiry0xjLYZm7obGG5xNMpunuliboBY4aRTYmWueJn+ti5blkt9lwjlYLOBjpSCRoAOIN7ehVbjM/TGy/yy/be2wD4n3QMgfM4Ycbe7TYhym2Yy2NxZuisrW4kb6UlsWyAuH4uY8OFUi62eI0c4vGXWXxvDwXuuJXYQdIbqbo6lLWOzbMZ+T/ty/G7zNUvpej2toW46RUEBAUor/OP0IflHlKxHj3+lRoEcggUCAgUCKtFnluVX2VRSCFvGmM0a12BznM0LWHTNZdWHlJj2X0zHjC9rHBzTrBDmrN9M9E8rYFuOkVBAQFKObndlDd27GS1DWvxDCaaaELMjO+s29uL/AF+x2v7RuWuLz+Op/X7Ha/tG5OJ8dUmcu2L3hoc8VNKlw3JxPjq9m5bso5CwueadII3JxPjqh/X7Ha/tG5OJ8dU48ktoniSOSVj291zXUI/wnFZ1SOhkuXQW073xlxc5pBLjXWQf9LNnhrXSSuytRsVBAQEEXsa4UcKjYVkY+Fg/QKZocNB+gU5VXDmfces/BiDMRw0HRXQvREMd3WpxdiDvNt4HNBwDSAV53a5V7wsH6BXNRNkTGd1oCvmia0CAgICAgIIyRh4oa0/g0WRh4KDYe0qZocFBsPaUzRljibGKNrTYTVUTVBUEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBB//2Q==';
		    }?>
		    <div class="row">
		    <div class="col-md-4 pull-left">
		    	<img style="width:100px;margin-left:-15px;" src="<?php echo $base64; ?>" />
		    </div>
		    <div class="col-md-8" style="margin-left:120px;"><b><?php echo $comm['comm_name']; ?></b></div>
		    </div>
		    <hr />
			<div style="margin-left:-30px;" class="col-md-12"><?php echo $comm['comm_desc'];?></div>
		<?php } ?>
	</body>
</html>