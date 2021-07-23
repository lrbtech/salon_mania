
<!DOCTYPE html>
<html>

<head>
	<title>Salon Mania</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta name="_token" content="{{ csrf_token() }}"/>
	<style type="text/css">
		#div_signcontract {
			width: 99%;
		}

		.popupHeader {
			margin: 10px;
		}

		.ui-bar-b {
			border: 1px solid #719e2a;
			background: #719e2a;
			color: #fff;
			font-weight: 700;
			text-shadow: 0 1px 0 #719e2a;
			background-image: -webkit-gradient(linear, left top, left bottom, from(#9cd641), to(#719e2a));
			background-image: -webkit-linear-gradient(#9cd641, #719e2a);
			background-image: -moz-linear-gradient(#9cd641, #719e2a);
			background-image: -ms-linear-gradient(#9cd641, #719e2a);
			background-image: -o-linear-gradient(#9cd641, #719e2a);
			background-image: linear-gradient(#9cd641, #719e2a);
		}

		.ui-btn-up-b {
			border: 1px solid #ffffff;
			background: #fbfbfb !important;
			font-weight: 700;
			color: #8cc138 !important;
			text-shadow: 0 0px 0 #ffffff;
			/* background-image: -webkit-gradient(linear,left top,left bottom,from(#5f9cc5),to(#396b9e)); */
			/* background-image: -webkit-linear-gradient(#ffffff,#ffffff); */
			background-image: -moz-linear-gradient(#ffffff, #fbfbfb);
			background-image: -ms-linear-gradient(#ffffff, #fbfbfb);
			background-image: -o-linear-gradient(#ffffff, #fbfbfb);
			/* background-image: linear-gradient(#5f9cc5,#396b9e); */
		}

		.ui-btn-hover-b {
			border: 1px solid #ffffff;
			background: #fbfbfb !important;
			font-weight: 700;
			color: #5b9104 !important;
			text-shadow: 0 0px 0 #ffffff;
			/* background-image: -webkit-gradient(linear,left top,left bottom,from(#5f9cc5),to(#396b9e)); */
			/* background-image: -webkit-linear-gradient(#ffffff,#ffffff); */
			background-image: -moz-linear-gradient(#ffffff, #fbfbfb);
			background-image: -ms-linear-gradient(#ffffff, #fbfbfb);
			background-image: -o-linear-gradient(#ffffff, #fbfbfb);
			/* background-image: linear-gradient(#5f9cc5,#396b9e); */
		}

		.ui-btn-up-c {
			border: 1px solid #ffffff;
			background: #fbfbfb !important;
			font-weight: 700;
			color: #8cc138 !important;
			text-shadow: 0 0px 0 #ffffff;
			/* background-image: -webkit-gradient(linear,left top,left bottom,from(#5f9cc5),to(#396b9e)); */
			/* background-image: -webkit-linear-gradient(#ffffff,#ffffff); */
			background-image: -moz-linear-gradient(#ffffff, #fbfbfb);
			background-image: -ms-linear-gradient(#ffffff, #fbfbfb);
			background-image: -o-linear-gradient(#ffffff, #fbfbfb);
			/* background-image: linear-gradient(#5f9cc5,#396b9e); */
			text-decoration: none;
		}

		.hidden_now {
			display: none !important;
		}
	</style>
	<script type="text/javascript">
		var isSign = false;
		var leftMButtonDown = false;

		jQuery(function () {
			//Initialize sign pad
			init_Sign_Canvas();
		});

		function fun_submit() {
			if (isSign) {
				var canvas = $("#canvas").get(0);
				var imgData = canvas.toDataURL();
				jQuery('#page').find('p').remove();
				jQuery('#page').find('img').remove();
				// jQuery('#page').append(jQuery('<p>Your Sign:</p>'));
				// jQuery('#page').append($('<img/>').attr('src', imgData));
				Save({{$salon->salon_id}},imgData);
				closePopUp();
			} else {
				alert('Please sign');
			}
		}
function Save(id,id1){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
  $.ajax({
    url : '/update-login',
    type: "POST",
    data:{ id: id, data: id1 },
    dataType: "JSON",
    success: function(data)
    {
      alert('Successfully Update');
      window.location.href="/salon-create-password/{{$salon->id}}"
    }
  });
}
		function closePopUp() {
			jQuery('#divPopUpSignContract').popup('close');
			jQuery('#divPopUpSignContract').popup('close');
		}

		function init_Sign_Canvas() {
			isSign = false;
			leftMButtonDown = false;

			//Set Canvas width
			var sizedWindowWidth = $(window).width();
			if (sizedWindowWidth > 700)
				sizedWindowWidth = $(window).width() / 2;
			else if (sizedWindowWidth > 400)
				sizedWindowWidth = sizedWindowWidth - 100;
			else
				sizedWindowWidth = sizedWindowWidth - 50;

			$("#canvas").width(sizedWindowWidth);
			$("#canvas").height(200);
			$("#canvas").css("border", "1px solid #000");

			var canvas = $("#canvas").get(0);

			canvasContext = canvas.getContext('2d');

			if (canvasContext) {
				canvasContext.canvas.width = sizedWindowWidth;
				canvasContext.canvas.height = 200;

				canvasContext.fillStyle = "#fff";
				canvasContext.fillRect(0, 0, sizedWindowWidth, 200);

				canvasContext.moveTo(50, 150);
				canvasContext.lineTo(sizedWindowWidth - 50, 150);
				canvasContext.stroke();

				canvasContext.fillStyle = "#000";
				canvasContext.font = "20px Arial";
				canvasContext.fillText("x", 40, 155);
			}
			// Bind Mouse events
			$(canvas).on('mousedown', function (e) {
				if (e.which === 1) {
					leftMButtonDown = true;
					canvasContext.fillStyle = "#000";
					var x = e.pageX - $(e.target).offset().left;
					var y = e.pageY - $(e.target).offset().top;
					canvasContext.moveTo(x, y);
				}
				e.preventDefault();
				return false;
			});

			$(canvas).on('mouseup', function (e) {
				if (leftMButtonDown && e.which === 1) {
					leftMButtonDown = false;
					isSign = true;
				}
				e.preventDefault();
				return false;
			});

			// draw a line from the last point to this one
			$(canvas).on('mousemove', function (e) {
				if (leftMButtonDown == true) {
					canvasContext.fillStyle = "#000";
					var x = e.pageX - $(e.target).offset().left;
					var y = e.pageY - $(e.target).offset().top;
					canvasContext.lineTo(x, y);
					canvasContext.stroke();
				}
				e.preventDefault();
				return false;
			});

			//bind touch events
			$(canvas).on('touchstart', function (e) {
				leftMButtonDown = true;
				canvasContext.fillStyle = "#000";
				var t = e.originalEvent.touches[0];
				var x = t.pageX - $(e.target).offset().left;
				var y = t.pageY - $(e.target).offset().top;
				canvasContext.moveTo(x, y);

				e.preventDefault();
				return false;
			});

			$(canvas).on('touchmove', function (e) {
				canvasContext.fillStyle = "#000";
				var t = e.originalEvent.touches[0];
				var x = t.pageX - $(e.target).offset().left;
				var y = t.pageY - $(e.target).offset().top;
				canvasContext.lineTo(x, y);
				canvasContext.stroke();

				e.preventDefault();
				return false;
			});

			$(canvas).on('touchend', function (e) {
				if (leftMButtonDown) {
					leftMButtonDown = false;
					isSign = true;
				}

			});
		}

		function show_after() {
			if ($("input[name=terms_and_condition]").is(":checked")) { 
                $('#before').addClass('hidden_now');
				$('#show_after').removeClass('hidden_now');
				$('#divPopUpSignContract').css('width', '100%');
            } else { 
                alert("Choose Terms and Conditions"); 
            }
		}
$(document).ready(function(){
  $('#popupTrigger').trigger('click');
});
		function refresh_pad() {
			$('#before').removeClass('hidden_now');
			$('#show_after').addClass('hidden_now');
			$('#divPopUpSignContract').css('width', '70%');
			init_Sign_Canvas();
			$('#popupTrigger').click();
		}

	</script>
</head>

<body>
	<div data-role="page">

		<div id="page" data-role="content">
			<a href="#divPopUpSignContract" data-rel="popup" data-position-to="window" data-role="button"
				data-inline="true" style="display: none;" id="popupTrigger"></a>
			<!-- <a href="javascript:void(null)" data-rel="popup" data-position-to="window" data-role="button"
				data-inline="true" onclick="refresh_pad()">Open Sign Pad</a> -->
		</div>
		<div data-role="popup" id="divPopUpSignContract" style="width: 70%;left: 14%">
			<div data-role="header" data-theme="b">
				<!-- <a data-role="button" data-rel="back" data-transition="slide" class="ui-btn-right"
					onclick="closePopUp()"> Close </a> -->
				<p class="popupHeader">Terms and Conditions</p>
			</div>
			<div class="ui-content popUpHeight">
				<div id="before">

					<table style="display: block;
  height: 300px;
  overflow-y: scroll;" class="table table-bordered">
						<tbody>
							<tr>
								<td>
									<?php echo html_entity_decode($terms->terms_and_condition); ?>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="row">
						<!-- <div class="col-md-2">
							<input id="btnSubmitSign" type="button" data-inline="true" data-mini="true" data-theme="b"
								value="Cancel" onclick="closePopUp()" />
						</div> -->
						<div class="col-md-10" style="margin-top: -13px;">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" name="terms_and_condition" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">I have read and agree to the full
									set of
									terms and conditions</label>
							</div>

						</div>
						<div class="col-md-2">
							<input style="float: right;" id="btnClearSign" type="button" data-inline="true"	data-mini="true" data-theme="b" value="Next" onclick="show_after()" />
						</div>

					</div>
				</div>
				<div id="show_after" class="hidden_now">
					<div id="div_signcontract">
						<canvas id="canvas">Canvas is not supported</canvas>
						<div>
							<input id="btnSubmitSign" type="button" data-inline="true" data-mini="true" data-theme="b"
								value="Submit Sign" onclick="fun_submit()" />
							<input class="float-right" id="btnClearSign" type="button" data-inline="true"
								data-mini="true" data-theme="b" value="Clear" onclick="init_Sign_Canvas()" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>