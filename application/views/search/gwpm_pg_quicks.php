

<tbody>
	<tr>
		<td>Gender:<select class="form-control" name="gwpm_gender"
			id="gwpm_gender"><option value="">Select</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
		</select></td>
		<td>Age Range:<input id="gwpm_age"
			style="color: #f6931f; font-weight: bold; width: 200px; background-color: #E4DEC7;"
			disabled="disabled"><br> <span
			style="color: #f6931f; font-weight: bold;"></span> <input
			id="gwpm_age_from" name="gwpm_age_from" class="gwpm_hidden_fields"> <input
			id="gwpm_age_to" name="gwpm_age_to" class="gwpm_hidden_fields">
			<div id="slider-range"
				style="width: 13em; margin-top: 15px; margin-left: 90px;"></div>
		</td>
		<td>Marital Status:<select class="form-control"
			name="gwpm_martial_status" id="gwpm_martial_status"><option value="">Select</option>
				<option value="1">Single</option>
				<option value="2">Married</option>
				<option value="3">Divorsed</option>
				<option value="4">Gol Dhana Folk</option>
				<option value="5">Widow</option>
		</select></td>
		<td style="width: 220px;"><input id="search" value="Search"
			class="gwpm-button" name="search" style="width: 100px; float: left"
			type="button"> <input id="clear" value="Clear" class="gwpm-button"
			name="cancel" style="width: 100px; float: right" type="button">
		</td>
	</tr>
</tbody>

<script type="text/javascript">
jQuery(document).ready(function($) {
		// jQuery UI Touch Punch
		!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);

		var today = new Date();
		var year = today.getFullYear() - 18 ;
		var month = today.getMonth() ;
		jQuery("#gwpm_dob").datetimepicker({ ampm: true, maxDate: new Date(year, month, 1) });
		jQuery( "#slider-range" ).slider({
	      range: true,
	      min: 18,
	      max: 70,
	      values: [ 18, 70 ],
	      orientation: '',
	      slide: function( event, ui ) {
	        jQuery( "#gwpm_age" ).val( ui.values[ 0 ] + " to " + ui.values[ 1 ] + " Yrs");
	        jQuery( "#gwpm_age_from" ).val(ui.values[ 0 ]) ;
	        jQuery( "#gwpm_age_to" ).val(ui.values[ 1 ]) ;
	      }
	    });

		var age_from=18;
		var age_to=70;
	    jQuery( "#gwpm_age" ).val( age_from+" to "+age_to+" Yrs" );
	    jQuery( "#gwpm_age_from" ).val(age_from) ;
	    jQuery( "#gwpm_age_to" ).val(age_to) ;
		jQuery("#slider-range").slider('values',[age_from,age_to]);
});
</script>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		  $.fn.unveil = function(threshold, callback) {

		    var $w = $(window),
		        th = threshold || 0,
		        retina = window.devicePixelRatio > 1,
		        attrib = retina? "data-src-retina" : "data-src",
		        images = this,
		        loaded;

		    this.one("unveil", function() {
		      var source = this.getAttribute(attrib);
		      source = source || this.getAttribute("data-src");
		      if (source) {
		        this.setAttribute("src", source);
		        if (typeof callback === "function") callback.call(this);
		      }
		    });

		    function unveil() {
		      var inview = images.filter(function() {
		        var $e = $(this);
		        if ($e.is(":hidden")) return;

		        var wt = $w.scrollTop(),
		            wb = wt + $w.height(),
		            et = $e.offset().top,
		            eb = et + $e.height();

		        return eb >= wt - th && et <= wb + th;
		      });

		      loaded = inview.trigger("unveil");
		      images = images.not(loaded);
		    }

		    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);

		    unveil();

		    return this;

		  };

		$(".unveil").unveil();

		$("#search").on("click", function () {
				var gender = $("#gwpm_gender").val();
				var marital = $("#gwpm_martial_status").val();
				var minAge = $("#slider-range").slider("values")[0];
				var maxAge = $("#slider-range").slider("values")[1];

				function isInAge ($elem) {
					var age = $elem.attr("data-age");
					var value = true;
					if (age.length > 8) {
						var curAge = (new Date()).getYear() - (new Date(age)).getYear();
						if (isNaN(curAge)) return value;
						if (curAge < minAge || maxAge < curAge) {
							value = false;
						}
					}
					return value;
				}

				$(".row").each(function () {
					var $elem = $(this);
					if (gender.length) {
						if ($elem.attr("data-gender").length && $elem.attr("data-gender") === gender) {
							$elem.attr("data-hide", false);
						}
						else{
							$elem.attr("data-hide", true);
						}
					}
					else{
						$elem.attr("data-hide", false);
					}
				});

				$(".row").each(function () {
					var $elem = $(this);
					if (marital.length && ($elem.attr("data-hide") === false || $elem.attr("data-hide") === "false")) {
						if ($elem.attr("data-marital-status").length && $elem.attr("data-marital-status") === marital) {
							$elem.attr("data-hide", false);
						} else {
							$elem.attr("data-hide", true);
						}
					}
				});

				$(".row").each(function () {
					var $elem = $(this);

					if ($elem.attr("data-hide") === false || $elem.attr("data-hide") === "false") {
						if (isInAge($elem)) {
							$elem.attr("data-hide", false);
						} else {
							$elem.attr("data-hide", true);
						}
					}
				});
				toggleRows ();

		});

		function toggleRows () {
			$(".row").each(function () {
				if ($(this).attr("data-hide") === true) {
					$(this).hide();
				} else if ($(this).attr("data-hide") === "true") {
					$(this).hide();
				} else {
					$(this).show();
				}
			});
			$("#number").text($(".row:visible").length);
		}

		$("#clear").on("click", function () {
			$(".row").show();
			$("#number").text($(".row:visible").length);
			$("#gwpm_gender").val("");
			$("#gwpm_martial_status").val("");
			var age_from=18;
			var age_to=70;
		    $( "#gwpm_age" ).val( age_from+" to "+age_to+" Yrs" );
		    $( "#gwpm_age_from" ).val(age_from) ;
		    $( "#gwpm_age_to" ).val(age_to) ;
			$("#slider-range").slider('values',[age_from,age_to]);
		});
});
</script>

<?php