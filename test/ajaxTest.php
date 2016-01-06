<form name="gwpm_qsearch_form" id="gwpm_qsearch_form" action="#" ><table><tbody>
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
		<tr> <td> Page No: <input name="gwpm_page_no" id="gwpm_page_no" value="1" /> </td></tr>
		<tr>
		<td style="width: 220px;"><input id="searchBtn" value="Search"
			class="gwpm-button" name="search" style="width: 100px; float: left"
			type="button"> <input id="clear" value="Clear" class="gwpm-button"
			name="cancel" style="width: 100px; float: right" type="button"></td>
	</tr>
	
</tbody> </table> </form>
<div id="gwpm_resultBox">

</div>

<script>

jQuery(document).ready(function(){

	jQuery("#searchBtn").click(function() {
		// var req_data = jQuery("#gwpm_qsearch_form").serializeArray();
		var req_data = jQuery("#gwpm_qsearch_form").serialize();
		var mtData = getAjaxRequestorObj ("open_search", req_data) ;	
		
		jQuery.post(MyAjax.ajaxurl, mtData, function(response) {
			var resObj = jQuery.parseJSON( response ) ;
			jQuery("#gwpm_resultBox").text(resObj) ;
		});
	}) ;

});
</script>
