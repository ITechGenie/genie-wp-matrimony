<?php
$this->set('action', 'edit') ;
$modelObj = $this->get('model');

function changeDateformat($dob)
{
	$dob = explode(" ",$dob);
	$dob[0] = explode("/",$dob[0]);
	$dob[0] = $dob[0][1]."/".date('F', mktime(0, 0, 0, $dob[0][0], 10))."/".$dob[0][2];
	return " ".join(" ",$dob);
}

?>
<form name="gwpm-profile-form" action="<?php echo "#";//$this->getActionURL(); ?>"
	method="post" >
<table class='gwpm-table' style="width:38%!important; float:left">
		<tbody>
			<tr>
		        <td valign="top"><h4>User filters for quick search</h4></td>
      		</tr>
			<tr style="display:none">
		        <td valign="top">Account ID:</td>
		        <td valign="top"><input name="userId" id="userId" value="" /></td>
      		</tr>
			<tr>
	        	<td valign="top">Gender:<?php $this->getSelectItem(getGenderOptions(), 'gwpm_gender',$_POST['gwpm_gender'] ) ; 	?></td>
			</tr>

			<tr style="display:none">
				<td valign="top">Name:</td>
				<td valign="top"><input name="username" id="username" value="" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Father's Name:</td>
				<td valign="top"><input name="fathername" id="fathername" value="" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Mother's Name:</td>
				<td valign="top"><input name="mothername" id="mothername" value="" /></td>
			</tr>
			<tr>
	        	<td valign="top">Age Range:<input id="gwpm_age" style="color: #f6931f; font-weight: bold; width: 200px;background-color: #E4DEC7;" disabled="disabled" /><br /><span style="color: #f6931f; font-weight: bold;" ></span>
					<input id="gwpm_age_from" name="gwpm_age_from" class="gwpm_hidden_fields" />
  					<input id="gwpm_age_to" name="gwpm_age_to" class="gwpm_hidden_fields" />
  					<div id="slider-range" style="width: 13em; margin-top: 15px;margin-left: 90px;"></div></td>
			</tr>
			<tr style="display:none">
	        	<td valign="top">Born Before:</td>
	       		<td valign="top"><input name="gwpm_" id="gwpm_dob"
						class="gwpm-datepicker" /></td>
      		</tr>
      		<tr style="display:none">
				<td valign="top">Resident Address:</td>
				<td valign="top"><textarea name="gwpm_resident_address" id="gwpm_resident_address" /></textarea></td>
			</tr>
			<tr style="display:none">
	        	<td valign="top">Expectation:</td>
	       		<td valign="top"><?php $this->getSelectItem(getExpectationOptions(), 'gwpm_expectation' ) ; 	?></td>
      		</tr>
			<tr style="display:none">
				<td valign="top">Hobbies &amp; Activites:</td>
				<td valign="top"><input name="gwpm_hobbies_activites" id="gwpm_hobbies_activites" value="" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">About You:</td>
				<td valign="top"><input name="description" id="description" value="" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Height (CMS):</td>
				<td valign="top"><input name="gwpm_physical[height]" id="gwpm_physical[height]" value="" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Weight (KGS):</td>
				<td valign="top"><input name="gwpm_physical[weight]" id="gwpm_physical[weight]" value="" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Color Complexion:</td>
				<td valign="top"><input name="gwpm_physical[color_complexion]" id="gwpm_physical[color_complexion]" value="" /></td>
			</tr>
			<tr style="display:none">
	        	<td valign="top">Body Type:</td>
	       		<td valign="top"><?php $this->getSelectItem(getPhysicalType(), "gwpm_physical[body_type]" ) ; 	?></td>
      		</tr>
			<tr style="display:none">
				<td valign="top">Star Sign (Nakshatram):</td>
				<td valign="top">
					<?php $this->getSelectItem(getStarSignOptions(), 'gwpm_starsign' ) ; 	?>
				</td>
			</tr>
			<tr style="display:none">
				<td valign="top">Zodiac Sign (Raasi):</td>
				<td valign="top">
					<?php $this->getSelectItem(getZodiacOptions(), 'gwpm_zodiac' ) ; 	?>
				</td>
			</tr>
			<tr style="display:none">
				<td valign="top">Sevvai Dosham:</td>
				<td valign="top">
					<?php $this->getSelectItem(getYesNoOptions(), 'gwpm_sevvai_dosham' ) ; 	?>
				</td>
			</tr>
			<tr style="display:none">
				<td valign="top">Religion:</td>
				<td valign="top"><input name="gwpm_religion" id="gwpm_religion" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Qualification:</td>
				<td valign="top"><?php $this->getSelectItem(getQualificationOptions(), 'gwpm_education[qualification]') ; ?></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Specialization / Major:</td>
				<td valign="top"><input name="gwpm_education[specialization]" id="gwpm_education[specialization]" /></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Employment Status:</td>
				<td valign="top"><?php $this->getSelectItem(getEmploymentStatusOptions(), 'gwpm_education[status]') ; 	?></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Workplace Address:</td>
				<td valign="top"><textarea name="gwpm_workplace_address" id="gwpm_workplace_address" /></textarea></td>
			</tr>
			<tr style="display:none">
				<td valign="top">Designation:</td>
				<td valign="top"><input name="gwpm_work[designation]" id="gwpm_work[designation]" /></td>
			</tr>
			<tr style="display:none">
						<td valign="top">Native Place:</td>
						<td valign="top"><input name="gwpm_native_place" id="gwpm_native_place" /></td>
			</tr>
            <tr style="display:none">
						<td valign="top">Siblings:</td>
						<td valign="top"><input name="gwpm_siblings" id="gwpm_siblings" /></td>
            </tr>
            <tr style="display:none">
						<td valign="top">Family Contact No:</td>
						<td valign="top"><input name="gwpm_contact_no" id="gwpm_contact_no" /></td>
            </tr>
            <tr style="display:none">
						<td valign="top">Mosal:</td>
						<td valign="top"><input name="gwpm_mosal" id="gwpm_mosal" /></td>
            </tr>
			<tr style="display:none">
				<td valign="top">Caste:</td>
				<td valign="top"><input name="gwpm_caste" id="gwpm_caste" /></td>
			</tr>
            <tr style="display:none">
						<td valign="top">Family Address:</td>
						<td valign="top"><textarea name="gwpm_family_address" id="gwpm_family_address" maxLength="200" ></textarea></td>
            </tr>
            <tr style="display:none">
						<td valign="top">Other Information:</td>
						<td valign="top"><input name="gwpm_other_info" id="gwpm_other_info" /></td>
            </tr>
            <tr style="display:none">
						<td valign="top">Date & Time of Birth:</td>
						<td valign="top"><input name="gwpm_dob" id="gwpm_dob" /></td>
            </tr>
            <tr style="display:none">
						<td valign="top">Place of Birth:</td>
						<td valign="top"><input name="gwpm_pob" id="gwpm_pob" /></td>
            </tr>
            <tr style="display:none">
						<td valign="top">Gotra:</td>
						<td valign="top"><input name="gwpm_gotra" id="gwpm_gotra" /></td>
            </tr>
			<tr >
				<td valign="top">Marital Status:<?php $this->getSelectItem(getMaritalOptions(), 'gwpm_martial_status' ,$_POST['gwpm_martial_status']) ; 	?></td>
			</tr>
            <tr style="display:none">
						<td valign="top">Horoscope Dosha:</td>
						<td valign="top"><?php $this->getSelectItem(getHoroscopeDoshaOptions(), 'gwpm_horoscope_dosha'); ?></td>
            </tr>
            <tr style="display:none">
						<td valign="top">City:</td>
			</tr>
			<tr style="display:none">
						<td valign="top"><input name="gwpm_address[city]" id="gwpm_address[city]" /></td>
            </tr>
            <tr style="display:none">
				<td valign="top">State:</td>
				<td valign="top">
					<?php $this->getSelectItem(getStateOptions(), 'gwpm_address[state]' ) ; 	?>
				</td>
			</tr>
            <tr style="display:none">
						<td valign="top">Do You Believe in Horoscope matching:</td>
						<td valign="top"><?php $this->getSelectItem(getYesNoOptions(), 'gwpm_horoscope_matching') ; 	?></td>
            </tr>
			<tr>
			  	<td style="width:30%!important;">
				   <input type="button" id="search" value="Search" class="gwpm-button" name="search" style="width:100px" >
				   <input type="button" id="clear" value="Clear" class="gwpm-button" name="cancel"  style="width:100px" >
			   </td>
           </tr>
           <tr>
           		<td valign="top">Total number of searched candidates: <p id="number"></p></td>
           </tr>
			<?php
					if ( is_user_logged_in() ) {
					} else { ?>
		           <tr>
		           	<td>
		           		<a style="background-color: white;padding: 10px;width: 200px;display: block;border: 1px solid #ccc;text-align: center;font-weight:bold" href="http://poonakapol.org/register/" target="_blank" rel="Register Matrimony">
		           			Free Registration
	           			</a>
	           		</td>
		           </tr>
			<?php } ?>
			<?php
				$totalDynamicFields = $modelObj['gwpm_dynamic_field_count'] ;
				$dyna_field_item = $modelObj['dyna_field_item'] ;
				$keys = array_keys($dyna_field_item)  ;

				foreach ($keys as $vkey) {
					?>
						<tr >
							<td valign="top"><?php echo $dyna_field_item[$vkey]['label']  ?>:</td>
							<td valign="top">
								<?php
									 if($dyna_field_item[$vkey]['type'] == 'text') {
										gwpm_echo ('<input name="' . $vkey . '" id="' . $vkey . '" />' );
									 } else if($dyna_field_item[$vkey]['type'] == 'select') {
									 	$this->getSelectItem(getDynamicFieldOptions($dyna_field_item[$vkey]['value']), $vkey) ;
									 } else if($dyna_field_item[$vkey]['type'] == 'yes_no') {
									 	$this->getSelectItem(getYesNoOptions(), $vkey) ;
									 }
								?>
							</td>
						</tr>
					<?php
				}
			?>
			<tr style="display:none">
				<td valign="top">With Profile Photo:</td>
				<td valign="top"><input type="checkbox" name="gwpm_has_photo" value="1"/></td>
			</tr>
		</tbody>
</table>
<?php
	function get_query_string_values($link) {
		$queryStrings = array ();
		$vars = explode('?', $link);
		$counter = 0;
		foreach ($vars as $var) {
			if ($counter != 0) {
				$qStrs = explode('&', $vars[$counter]);
				foreach ($qStrs as $qStr) {
					$pairs = explode('=', $qStr);
					if ($pairs[0] == '_wpnonce') {
						if (!check_admin_referer('gwpm')) {
							die("Invalid server request");
						}
					}
					$queryStrings[$pairs[0]] = $pairs[1];
				}
			}
			$counter++;
		}
		return $queryStrings;
	}

$controllerName = 'GwpmSearchController';
$modelName = 'GwpmSearchModel';
$action  = 'update';
$controllerURL = GWPM_APPLICATION_URL . DS . 'controllers' . DS . $controllerName . '.php';
$modelURL = GWPM_APPLICATION_URL . DS . 'models' . DS . $modelName . '.php';
require_once ($controllerURL);
require_once ($modelURL);
$queryVariables = get_query_string_values($_SERVER['REQUEST_URI']);
$dispatch = new $controllerName ('search', 'update', $queryVariables, $modelName);

 if ((int) method_exists($controllerName, $action)) {
	 call_user_func_array(array ($dispatch, $action ), $queryVariables);
 } else {
	 throw new GwpmCommonException("Method " . $action . ' not found in class ' . $controllerName);
 }
$resultObj = $dispatch->get('model');
$resultCount = sizeof($resultObj);
?>
<table class='gwpm-search-result' style="width:60%!important; float:right">
	<tbody>
		<?php

			if ($resultCount > 0) {
				$counter = 1;
					?>
					<tr>
						<th valign="top">ID</th>
						<th valign="top">Image</th>
				        <th valign="top">Name <br>Email Id</th>
						<th valign="top">View Biodata</th>
		      		</tr>
		      		<?php
				foreach (array_reverse($resultObj) as $userObj) {
					  //$gravatarDetail = false;//get_avatar( $userObj->ID , 48 ) ;
					 //$gravatarDetail = $gravatarDetail ? $gravatarDetail : getGravatarImageForUser($userObj->ID, false );
					?>
					<tr class="row" data-age="<?php gwpm_echo ( $userObj->gwpm_dob ) ?>" data-marital-status="<?php gwpm_echo(  $userObj->gwpm_martial_status ) ?>" data-gender="<?php gwpm_echo( $userObj->gwpm_gender) ?>">
						<td valign="top"><?php echo $userObj-> ID ?></td>
						<td valign="top">
							<img width="90" height="90" class="avatar avatar-48 photo" data-src="<?php echo getGravatarImageSrc($userObj->ID, true )  ?>">
						</td>
				      <td valign="top"><?php gwpm_echo(  $userObj->gwpm_full_name ); ?><br/><?php gwpm_echo(  $userObj->user_email ); ?> <br/><?php gwpm_echo( changeDateformat($userObj->gwpm_dob) ); ?></td>
				      <td valign="top">
				        	<a href="<?php $this->get_gwpm_formated_url('page=profile&action=view&pid=' . $userObj-> ID) ?>"
				      target="_blank">View Biodata</a>
				      </td>
		      		</tr>
					<?php
				$counter++ ;
				}
			} else {
				echo "<h3>No Results found with the given criterias. Please try some other options.</h3>" ;
			}

		?>
	</tbody>
</table>
</form>
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
	      slide: function( event, ui ) {
	        jQuery( "#gwpm_age" ).val( ui.values[ 0 ] + " to " + ui.values[ 1 ] + " Yrs");
	        jQuery( "#gwpm_age_from" ).val(ui.values[ 0 ]) ;
	        jQuery( "#gwpm_age_to" ).val(ui.values[ 1 ]) ;
	      }
	    });

		var age_from=18;
		var age_to=70;
		<?php
			if( !$_POST['gwpm_age_from']=="")
			{
				echo "age_from=".$_POST['gwpm_age_from'].";";
			}
			if( !$_POST['gwpm_age_to']=="")
			{
				echo "age_to=".$_POST['gwpm_age_to'].";";
			}
		?>

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

		$("img").unveil();

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