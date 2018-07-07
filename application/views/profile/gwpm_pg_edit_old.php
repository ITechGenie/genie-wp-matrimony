<?php
$modelObj = $this->get('model');
if ( $modelObj != null) {
?>
<h2 class='gwpm-content-title'>Profile Page<?php if(!$this->isEditMode() && !$this->isUpdateMode()) 
{?> - <a class='edit-mode-link' href='<?php $this->get_gwpm_edit_link(); ?>'>Edit Profile</a><?php } 
	else { echo " <span class='gwpm-sec-info' > (Click section header to expand)</span>" ; } ?></h2>
<br />
<form name="gwpm-profile-form" action="<?php $this->getActionURL(); ?>"
	method="post" enctype="multipart/form-data">
	<div id="gwpm_accordion">
		<h3>
			<a href="#"><?php echo __('Basic Information', 'genie-wp-matrimony') ?></a>
		</h3>
		<div>
			<table class='gwpm-table'>
				<tbody>
					<tr class="gwpm_hidden_fields">
						<td valign="top"><?php _e('User ID', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="userId" id="userId"
							value="<?php echo $modelObj->userId ; ?>" maxLength="25" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('First Name', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="first_name" id="first_name"
							value="<?php gwpm_echo( $modelObj->first_name ); ?>" maxLength="25" /><span class="gwpm-mandatory">*</span></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Last Name', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="last_name" id="last_name"
							value="<?php gwpm_echo( $modelObj->last_name ); ?>" /><span class="gwpm-mandatory">*</span></td>
					</tr>
					<tr class="gwpm_hidden_fields">
						<td valign="top"><?php _e('Email ID', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="user_email" id="user_email"
							value="<?php gwpm_echo( $modelObj->user_email ) ; ?>" /><span class="gwpm-mandatory">*</span></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Contact No', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_contact_no" id="gwpm_contact_no"
							value="<?php gwpm_echo ( $modelObj->gwpm_contact_no ) ; ?>" maxLength="15" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Gender', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getGenderOptions(), 'gwpm_gender', ($modelObj->gwpm_gender)) ; 	?><span class="gwpm-mandatory">*</span>
						</td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Address Line', 'genie-wp-matrimony') ?> 1:</td>
						<td valign="top"><input name="gwpm_address[address1]" id="gwpm_address[address1]"
							value="<?php echo ( $modelObj->gwpm_address['address1'] ) ; ?>" maxLength="50" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Address Line', 'genie-wp-matrimony') ?> 2:</td>
						<td valign="top"><input name="gwpm_address[address2]" id="gwpm_address[address2]"
							value="<?php echo ( $modelObj->gwpm_address['address2'] ) ; ?>" maxLength="50" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('City', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_address[city]" id="gwpm_address[city]"
							value="<?php echo ( $modelObj->gwpm_address['city'] ) ; ?>" maxLength="25" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('State', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getStateOptions(), 'gwpm_address[state]', ($modelObj->gwpm_address['state'])) ; 	?>
						</td>
					</tr>
					<tr class="gwpm_hidden_fields">
						<td valign="top"><?php _e('Country', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_address[country]" id="gwpm_address[country]"
							value="India" /></td>
					</tr>
					<tr class="gwpm_hidden_fields">
						<td valign="top"><?php _e('Zip / Postal Code', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_address[pin]" id="gwpm_address[pin]"
							value="000000" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('About You', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<textarea name="description" id="description" maxLength="200" ><?php gwpm_echo( $modelObj->description ); ?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<h3>
			<a href="#"><?php echo __('Horoscope Information', 'genie-wp-matrimony'); ?></a>
		</h3>
		<div>
			<table class='gwpm-table'>
				<tbody>
					<tr>
						<td valign="top"><?php _e('Date of Birth', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_dob" id="gwpm_dob"
							class="gwpm-datepicker"
							value="<?php gwpm_echo ( $modelObj->gwpm_dob ); ?>" maxLength="25" />
							<span class="gwpm-mandatory">*</span></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Marital Status', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getMaritalOptions(), 'gwpm_martial_status', ($modelObj->gwpm_martial_status)) ; 	?>
							<span class="gwpm-mandatory">*</span>
						</td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Star Sign (Nakshatram)', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getStarSignOptions(), 'gwpm_starsign', ($modelObj->gwpm_starsign)) ; 	?>
							<span class="gwpm-mandatory">*</span>
						</td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Zodiac Sign (Raasi)', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getZodiacOptions(), 'gwpm_zodiac', ($modelObj->gwpm_zodiac)) ; 	?>
							<span class="gwpm-mandatory">*</span>
						</td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Sevvai Dosham', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getYesNoOptions(), 'gwpm_sevvai_dosham', ($modelObj->gwpm_sevvai_dosham)) ; 	?>
							<span class="gwpm-mandatory">*</span>
						</td>
					</tr>
					<tr>
				        	<td valign="top"><?php _e('Caste', 'genie-wp-matrimony') ?>:</td>
				       		<td valign="top">
				       			<input name="gwpm_caste" id="gwpm_caste"
								value="<?php gwpm_echo ( $modelObj->gwpm_caste ) ; ?>" /><span class="gwpm-mandatory">*</span> 
						</td>
			      		</tr>
			      		<tr>
				        	<td valign="top"><?php _e('Religion', 'genie-wp-matrimony') ?>:</td>
				       		<td valign="top">
				       			<input name="gwpm_religion" id="gwpm_religion"
								value="<?php gwpm_echo ( $modelObj->gwpm_religion ) ; ?>" /><span class="gwpm-mandatory">*</span> 
						</td>
			      		</tr>
				</tbody>
			</table>
		</div>
		<h3>
			<a href="#"><?php _e('Education & Work Information', 'genie-wp-matrimony') ?></a>
		</h3>
		<div>
			<table class='gwpm-table'>
				<tbody>
					<tr>
						<td valign="top"><?php _e('Qualification', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getQualificationOptions(), 'gwpm_education[qualification]', ($modelObj->gwpm_education['qualification'])) ; ?>
							<span class="gwpm-mandatory">*</span><br />
							<input class="gwpm_hidden_fields" name="gwpm_education[qualification_other]" id="gwpm_education_other"
								value="<?php 	if(isset($modelObj->gwpm_education['qualification_other'])) {
													gwpm_echo ( $modelObj->gwpm_education['qualification_other'] );		
												} else {
													echo "none" ;
												} ?>" />
						</td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Specialization / Major', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_education[specialization]" id="gwpm_education[specialization]"
							value="<?php gwpm_echo ( $modelObj->gwpm_education['specialization'] ); ?>" maxLength="50" />
							<span class="gwpm-mandatory">*</span></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Employement Status', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getEmploymentStatusOptions(), 'gwpm_education[status]', ($modelObj->gwpm_education['status'])) ; 	?>
							<span class="gwpm-mandatory">*</span>
						</td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Work Place Information', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_work[place]" id="gwpm_work[place]"
							value="<?php gwpm_echo ( $modelObj->gwpm_work['place'] ); ?>" maxLength="30" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Designation', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_work[designation]" id="gwpm_work[designation]"
							value="<?php gwpm_echo ( $modelObj->gwpm_work['designation'] ); ?>" maxLength="30" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Annual Income', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_work[income]" id="gwpm_work[income]"
							value="<?php gwpm_echo ( $modelObj->gwpm_work['income'] ); ?>" maxLength="30" /></td>
					</tr>
				</tbody>
			</table>
		</div>
		<h3>
			<a href="#"><?php _e('Physical Apprearance', 'genie-wp-matrimony') ?></a>
		</h3>
		<div>
			<table class='gwpm-table'>
				<tbody>
					<tr>
						<td valign="top"><?php _e('Height', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_physical[height]" id="gwpm_physical[height]"
							value="<?php gwpm_echo ( $modelObj->gwpm_physical['height'] ); ?>" maxLength="5" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Weight', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_physical[weight]" id="gwpm_physical[weight]"
							value="<?php gwpm_echo ( $modelObj->gwpm_physical['weight'] ); ?>" maxLength="5" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Color Complexion', 'genie-wp-matrimony') ?>:</td>
						<td valign="top"><input name="gwpm_physical[color_complexion]" id="gwpm_physical[color_complexion]"
							value="<?php gwpm_echo ( $modelObj->gwpm_physical['color_complexion'] ); ?>" maxLength="25" /></td>
					</tr>
					<tr>
						<td valign="top"><?php _e('Body Type', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
							<?php $this->getSelectItem(getPhysicalType(), "gwpm_physical[body_type]", ($modelObj->gwpm_physical['body_type'])) ; 	?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<?php 
			$dynaData = getDynamicFieldData() ;
			$totalDynamicFields = $dynaData['gwpm_dynamic_field_count'] ;
			$dyna_field_item = $dynaData['dyna_field_item'] ;
			
			if(isset($dyna_field_item) && sizeof($dyna_field_item) > 0) {
				?>
				<h3>
					<a href="#"><?php _e('Other Information', 'genie-wp-matrimony') ?></a> <?php _e("(Enter 'NA' if Not Applicable)", 'genie-wp-matrimony') ?>
				</h3>
				<div>
					<table class='gwpm-table'>
						<tbody>
							<?php   
							$keys = array_keys($dyna_field_item)  ;
							foreach ($keys as $vkey) {
								?>
									<tr>
										<td valign="top"><?php echo $dyna_field_item[$vkey]['label']  ?>:</td>
										<td valign="top">
											<?php
												 if($dyna_field_item[$vkey]['type'] == 'text') {
													gwpm_echo ('<input name="' . $vkey . '" id="' . $vkey . '" value="' . 
																$modelObj-> $vkey . '" />' );
												 } else if($dyna_field_item[$vkey]['type'] == 'select') {
												 	$this->getSelectItem(getDynamicFieldOptions($dyna_field_item[$vkey]['value']), $vkey, $modelObj-> $vkey) ;
												 } else if($dyna_field_item[$vkey]['type'] == 'yes_no') {
												 	$this->getSelectItem(getYesNoOptions(), $vkey, $modelObj-> $vkey) ;
												 }
											?>
										<span class="gwpm-mandatory">*</span></td>
									</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<?php
			}
			
		?>
		<h3>
			<a href="#"><?php _e('Profile Photo', 'genie-wp-matrimony') ?></a>
		</h3>
		<div>
			<table class='gwpm-table'>
				<tbody>
					<tr>
						<td valign="top"><?php _e('Profile Photo', 'genie-wp-matrimony') ?>:</td>
						<td valign="top">
						<input type="file" name="gwpm_profile_photo" id="gwpm_profile_photo" /> <br />
						<span class="gwpm-help" >Image maximum size <?php echo gwpmGetMaxFileUploadSize(); ?></span>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table class='gwpm-table'>
		<tbody>
			<tr>
				<td><input type="submit" value="Update" class="gwpm-button"
					name="update"></td>
				<td><input type="button" value="Cancel"
					onClick="javascript:window.history.back();" class="gwpm-button"
					name="cancel"></td>
			</tr>
			<tr><td colspan=2><span class="gwpm-mandatory">* - <?php _e('Mandatory Fields', 'genie-wp-matrimony') ?></span></td></tr>
		</tbody>
	</table>
</form>
<script type="text/javascript">
             
	 jQuery(document).ready(function() {
		//jQuery("#gwpm_dob").datepicker({ dateFormat: 'MM d, yy', changeMonth: true, changeYear: true, firstDay: 0, monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'], monthNamesShort: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'], dayNames: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'], dayNamesShort: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'], dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'], isRTL: false, minDate: '-100y', maxDate: '+5y', yearRange: '-100y:+5y' });
		var today = new Date();
		var year = today.getFullYear() - 18 ;
		var month = today.getMonth() ;
		jQuery("#gwpm_dob").datetimepicker({ ampm: true, maxDate: new Date(year, month, 1) });
		// jQuery("#gwpm_tmasvs_reg_date").datepicker({ dateFormat: 'MM d, yy', changeMonth: true, changeYear: true, firstDay: 0, monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'], monthNamesShort: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'], dayNames: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'], dayNamesShort: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'], dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'], isRTL: false, minDate: '-100y', maxDate: '+5y', yearRange: '-100y:+5y' });
		// jQuery("#gwpm_accordion").accordion({ autoHeight: false, collapsible: true, active: -1 });
		jQuery("select").change(function(obj){
			if(obj.currentTarget.id == "gwpm_education[qualification]" && obj.currentTarget.value == 7) {
				jQuery("#gwpm_education_other").removeClass("gwpm_hidden_fields"); 
				jQuery("#gwpm_education_other").val("") ; 
			} else {
				jQuery("#gwpm_education_other").addClass("gwpm_hidden_fields");
				jQuery("#gwpm_education_other").val("none") ; 
			}
		}) ;
	 });
			  
</script>
<?php   } else {
			include (GWPM_APPLICATION_URL . DS . 'views' . DS . 'gwpm_pg_login.php');
}
