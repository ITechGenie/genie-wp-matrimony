<style>
#slider-range {
	margin-left: 0 !important;
}
</style>
<form name="gwpm_qsearch_form" id="gwpm_qsearch_form" action="#">
	<table>
		<tbody>
			<tr>
				<td>Gender:<select class="form-control" name="gwpm_gender"
					id="gwpm_gender"><option value="">Select</option>
						<option value="1">Male</option>
						<option value="2">Female</option>
				</select>
				</td>
			</tr>
			<tr>
				<td style="width: 20%;">Age Range:<input id="gwpm_age"
					style="color: #f6931f; font-weight: bold; width: 200px; background-color: #E4DEC7;"
					disabled="disabled" /><br /> <span
					style="color: #f6931f; font-weight: bold;"></span> <input
					id="gwpm_age_from" name="gwpm_age_from" class="gwpm_hidden_fields" />
					<input id="gwpm_age_to" name="gwpm_age_to"
					class="gwpm_hidden_fields" />
					<div id="slider-range"
						style="width: 13em; margin-top: 15px; margin-left: 90px;"></div>
				</td>
			</tr>
			<tr>
				<td>Marital Status:<select class="form-control"
					name="gwpm_martial_status" id="gwpm_martial_status"><option
							value="">Select</option>
						<option value="1">Single</option>
						<option value="2">Married</option>
						<option value="3">Divorsed</option>
						<option value="4">Gol Dhana Folk</option>
						<option value="5">Widow</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>Page No: <input name="gwpm_page_no" id="gwpm_page_no" value="1" />
				</td>
			</tr>
			<tr>
				<td style="width: 220px;"><input id="searchBtn" value="Search"
					class="gwpm-button" name="search" style="width: 100px; float: left"
					type="button"> <input id="clear" value="Clear" class="gwpm-button"
					name="cancel" style="width: 100px; float: right" type="button"></td>
			</tr>

		</tbody>
	</table>
</form>

<input
	id="first_page_id" type="button" value="First Page" />
<input
	id="prev_page_id" type="button" value="Previous Page" />
<input
	id="next_page_id" type="button" value="Next Page" />
<!--  <input id="last_page_id" type="button" value="Last Page" />  -->
<br />
<br />
<div id="gwpm_resultBox"></div>

<script>

function fetchResults() {
	var req_data = jQuery("#gwpm_qsearch_form").serialize();
	var mtData = getAjaxRequestorObj ("open_search", req_data) ;	

	jQuery("#gwpm_resultBox").html("Searching..") ;
	
	jQuery.post(MyAjax.ajaxurl, mtData, function(response) {
		// var resObj = jQuery.parseJSON( response ) ;
		jQuery("#gwpm_resultBox").text("") ;
		var resObj = jQuery.parseJSON( response ) ;
		var displayText = "" ;
		for ( myObj in resObj ) {
			displayText = displayText + "<tr><td>" + resObj[myObj].gwpm_id + "</td><td>" + resObj[myObj].display_name + " </td><td> " + resObj[myObj].user_email + " </td>" ;
			displayText = displayText + "<td><img src='" + resObj[myObj].gwpm_image_url + "' alt='profile_pic' /></td>" ;
			displayText = displayText + "<td><a target='_blank' href=?page=profile&action=view&pid=" + resObj[myObj].gwpm_id + ">View BioData</a></td></tr>" ; 
		}
		if (displayText == "") {
			displayText = "No Results Found !" ;
		} else {
			displayText = "<table><tr><th>ID</th><th>Image</th><th>Name</th><th>Information</th><th>Biodata</th></tr>" + displayText + "</table>" ;
		}
		jQuery("#gwpm_resultBox").html(displayText) ;
	});
}

function getPageNo () {
	return parseInt( jQuery("#gwpm_page_no").val() ) ;
}

jQuery(document).ready(function(){

	!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);

	
	var age_from=18;
	var age_to=70;
    jQuery( "#gwpm_age" ).val( age_from+" to "+age_to+" Yrs" );
    // jQuery( "#gwpm_age_from" ).val(age_from) ;
    // jQuery( "#gwpm_age_to" ).val(age_to) ;
	// jQuery("#slider-range").slider('values',[age_from,age_to]);
	
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
	
	jQuery("#gwpm_martial_status").change(function(){
		jQuery("#gwpm_page_no").val( 1 ) ;
	});

	jQuery("#gwpm_gender").change(function(){
		jQuery("#gwpm_page_no").val( 1 ) ;
	});
	
	jQuery("#next_page_id").click(function(){
		var page_no =  getPageNo()+ 1 ;
		jQuery("#gwpm_page_no").val( page_no ) ;
		fetchResults() ;
	});

	jQuery("#prev_page_id").click(function(){
		var page_no =  getPageNo() ;
		if (page_no > 1)
			jQuery("#gwpm_page_no").val( page_no - 1 ) ;
		fetchResults() ;
	}); 

	jQuery("#first_page_id").click(function(){
		var page_no =  getPageNo() ;
		jQuery("#gwpm_page_no").val( 1 ) ;
		fetchResults() ;
	});	
	
	jQuery("#searchBtn").click(function() {
		// var req_data = jQuery("#gwpm_qsearch_form").serializeArray();
		fetchResults() ;
	}) ;

});
</script>
