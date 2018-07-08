<?php
$modelObj = $this->get('model');
if ($modelObj != null) {
	?>
<h2 class='gwpm-content-title'>
<?php gwpm_echo(gwpm_get_display_name($this->get('pid'))) ; ?>
	&nbsp;Profile Page
	<?php if(!$this->isEditMode() && !$this->isUpdateMode() && $this->isOwnPage())
	{
		?>
	- <a class='edit-mode-link'
		href='<?php $this->get_gwpm_edit_link(); ?>'><?php _e('Edit Profile', 'genie-wp-matrimony') ?></a>
		<?php
	} else if (is_user_logged_in()) {
		?>
	- <a class='edit-mode-link'
		href='<?php $this->get_gwpm_formated_url('page=messages&action=update&type=int'); ?>'>Send
		Interest</a>
		<?php
	}	?>
</h2>
<br />
<table class='gwpm-table'>
	<tbody>
		<tr>
			<td>
				<div class="gwpm_profile_pic_holder">
					<a class="gwpm_profile_link"
						href="<?php echo $this->getUserImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['name'] ); ?>"
						target="_blank" title="Click to see the original image"> <img
						class="gwpm_profile_pic" alt="profile-picture"
						src="<?php 
									echo $this->getUserImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['thumb_name'] ); ?>" />
					</a></br> <span class="gwpm-help">Click to see the original image</span>
				</div>
			</td>
				<td style="border-bottom: none;">
					<table>
						<tr>
					        <td valign="top"><?php _e('User ID', 'genie-wp-matrimony') ?>:</td>
					        <td valign="top"><?php echo GWPM_USER_PREFIX . $modelObj->userId ; ?></td>
			      		</tr>
						<tr>
							<td valign="top"><?php _e('Name', 'genie-wp-matrimony') ?>:</td>
							<td valign="top"><?php gwpm_echo( $modelObj->first_name ); ?> <?php gwpm_echo( $modelObj->last_name ); ?></td>
						</tr>
						<tr>
				        	<td valign="top"><?php _e('Date of Birth', 'genie-wp-matrimony') ?>:</td>
				       		<td valign="top"><?php gwpm_echo ( $modelObj->gwpm_dob ); ?></td>
			      		</tr>
			      		<tr>
							<td valign="top"><?php _e('Contact', 'genie-wp-matrimony') ?>:</td>
							<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_contact_no ) ; ?> </td>
						</tr>
						<tr>
				        	<td valign="top"><?php _e('Gender', 'genie-wp-matrimony') ?>:</td>
				       		<td valign="top"><?php gwpm_echo (getGenderOptions($modelObj->gwpm_gender )); ?></td>
			      		</tr>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<table class='gwpm-table'>
		<tbody>
			<tr>
				<td colspan="2">  
					<h3> <?php _e('Basic Information', 'genie-wp-matrimony') ?> </h3>
				</td>
			</tr>
			<tr>
		        <td valign="top"><?php _e('Email ID', 'genie-wp-matrimony') ?>:</td>
		        <td valign="top">   <?php echo ( $modelObj->user_email ) ; ?></td>
      		</tr>
      		<tr>
				<td valign="top"><?php _e('Address Line', 'genie-wp-matrimony') ?> 1:</td>
				<td valign="top"><?php echo ( $modelObj->gwpm_address['address1'] ) ; ?></td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Address Line', 'genie-wp-matrimony') ?> 2:</td>
				<td valign="top"> <?php echo ( $modelObj->gwpm_address['address2'] ) ; ?></td>
			</tr>
			<tr>
				<td valign="top"><?php _e('City', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> <?php echo ( $modelObj->gwpm_address['city'] ) ; ?></td>
			</tr>
			<tr>
				<td valign="top"><?php _e('State', 'genie-wp-matrimony') ?>:</td>
				<td valign="top">
					<?php echo (getStateOptions( $modelObj->gwpm_address['state'])) ; 	?>
				</td>
			</tr>
			<tr class="gwpm_hidden_fields">
				<td valign="top"><?php _e('Country', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> India </td>
			</tr>
			<tr class="gwpm_hidden_fields">
				<td valign="top"><?php _e('Zip / Postal Code', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> 000000 </td>
			</tr>
      		<tr>
	        	<td valign="top"><?php _e('About You', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top"><?php gwpm_echo( $modelObj->description ); ?></td>
      		</tr>
      		<tr>
				<td colspan="2">  
					<h3> <?php _e('Horoscope Information', 'genie-wp-matrimony') ?> </h3>
				</td>
			</tr>
			<tr>
	        	<td valign="top"><?php _e('Date of Birth', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top"><?php gwpm_echo ( $modelObj->gwpm_dob ); ?></td>
      		</tr>
      		<tr >
	        	<td valign="top"><?php _e('Marital Status', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getMaritalOptions($modelObj->gwpm_martial_status) ) ; 	?> 
				</td>
      		</tr>
      		<tr>
	        	<td valign="top"><?php _e('Star Sign (Nakshatram)', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getStarSignOptions($modelObj->gwpm_starsign)) ; 	?> 
				</td>
      		</tr>
      		<tr>
	        	<td valign="top"><?php _e('Zodiac Sign (Raasi)', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getZodiacOptions($modelObj->gwpm_zodiac)) ; 	?> 
				</td>
      		</tr>
      		<tr>
	        	<td valign="top"><?php _e('Sevvai Dosham', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getYesNoOptions($modelObj->gwpm_sevvai_dosham)) ; 	?> 
				</td>
      		</tr>
      		<tr>
	        	<td valign="top"><?php _e('Caste', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top">
	       			<?php gwpm_echo ( $modelObj->gwpm_caste ); 	?> 
				</td>
      		</tr>
      		<tr>
	        	<td valign="top"><?php _e('Religion', 'genie-wp-matrimony') ?>:</td>
	       		<td valign="top">
	       			<?php gwpm_echo ( $modelObj->gwpm_religion ); 	?> 
				</td>
      		</tr>
      		<tr>
				<td colspan="2">  
					<h3> <?php _e('Education & Work Information', 'genie-wp-matrimony') ?> </h3>
				</td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Qualification', 'genie-wp-matrimony') ?>:</td>
				<td valign="top">
					<?php 
						gwpm_echo (getQualificationOptions($modelObj->gwpm_education['qualification'])) ; 	
					  	if(isset($modelObj->gwpm_education['qualification_other']) && $modelObj->gwpm_education['qualification_other'] != 'none') {
					  		gwpm_echo (' (' . $modelObj->gwpm_education['qualification_other'] . ')'); 
					  	}
					?>
				</td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Specialization', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_education['specialization'] ); ?></td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Employement Status', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> <?php gwpm_echo ( getEmploymentStatusOptions( $modelObj->gwpm_education['status']) ) ; ?> </td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Work Place Information', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_work['place'] ); ?> </td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Designation', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_work['designation'] ); ?> </td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Annual Income (INR)', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_work['income'] ); ?> </td>
			</tr>
      		<tr>
				<td colspan="2">  
					<h3> <?php _e('Physical Apprearance', 'genie-wp-matrimony') ?> </h3>
				</td>
			</tr>
      		<tr>
				<td valign="top"><?php _e('Height (CMS)', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_physical['height'] ) ?></td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Weight (KGS)', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_physical ['weight'] ) ?></td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Color Complexion', 'genie-wp-matrimony') ?>:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_physical ['color_complexion'] ) ?></td>
			</tr>
			<tr>
				<td valign="top"><?php _e('Body Type', 'genie-wp-matrimony') ?>:</td>
				<td valign="top">
					<?php gwpm_echo( getPhysicalType($modelObj->gwpm_physical ['body_type'] )) ?>
				</td>
			</tr>
			<?php 
			
			$dynaData = getDynamicFieldData() ;
			$totalDynamicFields = $dynaData['gwpm_dynamic_field_count'] ;
			$dyna_field_item = $dynaData['dyna_field_item'] ;
			
			if(isset($dyna_field_item) && sizeof($dyna_field_item) > 0) {
				?>
				<tr>
					<td colspan="2">  
						<h3> <?php _e('Other Informations', 'genie-wp-matrimony') ?> </h3>
					</td>
				</tr>
				<?php   
				$keys = array_keys($dyna_field_item)  ;
				foreach ($keys as $vkey) {
					?>
						<tr>
							<td valign="top"><?php echo $dyna_field_item[$vkey]['label']  ?>:</td>
							<td valign="top">
								<?php
									$_type = $dyna_field_item[$vkey]['type'] ;
									 if($_type == 'text') {
										gwpm_echo( $modelObj-> $vkey ) ;
									 } else if($_type == 'yes_no' ) {
									 	gwpm_echo (getYesNoOptions($modelObj->$vkey)) ;
									 } else if ($_type == 'select'){
									 	gwpm_echo( $dyna_field_item[$vkey]['value'][$modelObj-> $vkey] ) ;
									 }
								?>
							</td>
						</tr>
					<?php
				}
			}
			?>
	</tbody>
</table>
<?php } else {
	include (GWPM_APPLICATION_URL . DS . 'views' . DS . 'gwpm_pg_login.php');
}
