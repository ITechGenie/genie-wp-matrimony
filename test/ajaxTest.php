<?php 
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit ();
}
?>
form name="gwpm_qsearch_form" id="gwpm_qsearch_form" action="#" ><table><tbody>
	<tr>
		<td>Gender:<select class="form-control" name="gwpm_gender"
			id="gwpm_gender"><option value="">Select</option>
				<option value="1">Male</option>
				<option value="2">Female</option>
		</select>
		</td> </tr>
		<tr> <td style="width: 20%;">Age Range: From: <input
			id="gwpm_age_from" name="gwpm_age_from"  value="18"> &nbsp; &nbsp; TO: <input
			id="gwpm_age_to" name="gwpm_age_to"   value="26">
			<div id="slider-range"
				style="width: 13em; margin-top: 15px; margin-left: 90px;"></div></td> </tr>
		<tr>
		<td>Marital Status:<select class="form-control"
			name="gwpm_martial_status" id="gwpm_martial_status"><option value="">Select</option>
				<option value="1">Single</option>
				<option value="2">Married</option>
				<option value="3">Divorsed</option>
				<option value="4">Gol Dhana Folk</option>
				<option value="5">Widow</option>
		</select>
		</td> </tr>
		<tr> <td> Page No: <input name="gwpm_page_no" id="gwpm_page_no" value="1"  /> </td></tr>
		<tr>
		<td style="width: 220px;"><input id="searchBtn" value="Search"
			class="gwpm-button" name="search" style="width: 100px; float: left"
			type="button"> <input id="clear" value="Clear" class="gwpm-button"
			name="cancel" style="width: 100px; float: right" type="button"></td>
	</tr>
	
</tbody> </table> </form>

<input id="first_page_id" type="button" value="First Page" />
<input id="prev_page_id" type="button" value="Previous Page" />
<input id="next_page_id" type="button" value="Next Page" />
<!--  <input id="last_page_id" type="button" value="Last Page" />  -->
 
<div id="gwpm_resultBox"></div>

<script>

function fetchResults() {
	var req_data = jQuery("#gwpm_qsearch_form").serialize();
	var mtData = getAjaxRequestorObj ("search", req_data) ;	
	
	jQuery.post(MyAjax.ajaxurl, mtData, function(response) {
		// var resObj = jQuery.parseJSON( response ) ;
		jQuery("#gwpm_resultBox").text("") ;
		var resObj = jQuery.parseJSON( response ) ;
		var displayText = "" ;
		for ( myObj in resObj ) {
			displayText = displayText + "<tr><td>" + resObj[myObj].gwpm_id + "</td><td>" + resObj[myObj].display_name + " </td><td> " + resObj[myObj].user_email + " </td>" ;
		//	displayText = displayText + "<td><img src='" + resObj[myObj].gwpm_image_url + "' alt='profile_pic' /></td>" ;
			displayText = displayText + "<td><a target='_blank' href=?page=profile&action=view&pid=" + resObj[myObj].gwpm_id + ">View BioData</a></td></tr>" ; 
		}
		if (displayText == "") {
			displayText = "No Results Found !" ;
		} else {
			displayText = "<table>" + displayText + "</table>" ;
		}
		jQuery("#gwpm_resultBox").html(displayText) ;
	});
}

function getPageNo () {
	return parseInt( jQuery("#gwpm_page_no").val() ) ;
}

jQuery(document).ready(function(){

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
