<?
error_reporting(E_ALL);
 ini_set("display_errors", 1);
 ?>
<html>
<head>
  <!-- testing testing -->
	<meta name="viewport" content="initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css">
	<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> -->
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
</head>
<body>
	<div data-role="page" id="lights">
		<div data-role="panel" id="menu">
			<ul data-role="listview">
				<li><a href="#">Home</a></li>
				<li><a href="http://hockeyfrissa.no-ip.biz/charts.php">Chart</a></li>

			</ul>
		</div><!-- /panel -->
		<div data-role="header">
			<a href="#menu" class="ui-btn ui-icon-bars ui-btn-icon-notext ui-corner-all">No text</a>
			<h1>HOME</h1>
		</div>
		<div role="main" class="ui-content">
			<div id="temp-wrapper" style="font-size:18px;text-align: center"></div>
			<div id="switch-wrapper"></div>

		</div>
		<div data-role="footer"></div>
	</div>



<a href="javascript:void(0)" class="btnoff-group" data-group="2,3,4">Fönster bottenvåning Av</a>


<script>



$(".btnon-group").click(function(){
	var that = this;
	$.post("group-on.php?" + $(that).attr("data-group"),function(data){
		$("#status").html("Response : " + data)
	})
})

$(".btnoff-group").click(function(){
	var that = this;
	$.post("group-off.php?" + $(that).attr("data-group"),function(data){
		$("#status").html("Response : " + data)
	})
})


	$(document).ready(function(){
		$.get("get-status.php",function(data){
				var szSwitch = "";
				var szTemp = ""

				szSwitch += '<ul data-role="listview" data-inset="true" id="switch-list">'
				szSwitch += '<li data-role="list-divider">Lights <span style="float:right" id="status"></span></li>'
				$.each(data,function(){
					if (this.type == "sensor" && this.id == '167') {
						szTemp = this.temp + " - " + this.humidity + " - " + this.updated

					}
					if (this.type == "switch") {
					szSwitch += '<li class="ui-field-contain">'
					szSwitch += '<label for="flip-select-'+this.id+'">'+this.name+':</label>'
					szSwitch += '<select class="flip-it" name="flip-select-'+this.id+'" data-role="flipswitch" data-id="'+this.id+'">'
					szSwitch += '<option'+(this.state=="OFF"?' selected':'')+'>off</option>'
					szSwitch += '<option'+(this.state=="ON"?' selected':'')+'>on</option></select></li>'
					}
					})
				szSwitch += '<li data-role="list-divider">Groups</li>'
				szSwitch += '<li class="ui-field-contain"><a href="javascript:void(0)" class="btnon-group" data-group="2,3,4">Fönster bottenvåning</a></li>';
				szSwitch += '</ul>'
				$("#temp-wrapper").append(szTemp)
				$("#switch-wrapper").append(szSwitch)

				$('[data-role="listview"]').listview();
				//$(szSwitch).appendTo("#switch-wrapper").trigger("create");
				$('.flip-it').slider();

				$('.flip-it').change(function(event) {
					$.post($(this).val()+".php?" + $(this).attr("data-id"),function(data){
						$("#status").html(data)
					});
				})
			})
		})
</script>

</body>
</html>
