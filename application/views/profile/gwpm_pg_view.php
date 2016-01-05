<?php
$modelObj = $this->get('model');

function changeDateformat($dob)
{
	$dob = explode(" ",$dob);
	$dob[0] = explode("/",$dob[0]);
	$dob[0] = $dob[0][1]."/".date('F', mktime(0, 0, 0, $dob[0][0], 10))."/".$dob[0][2];
	return " ".join(" ",$dob);
}
?>
<h2 class='gwpm-content-title'><?php gwpm_echo(gwpm_get_display_name($this->get('pid'))) ; ?>&nbsp;Profile Page
<?php if($this->get('pid')== ''){ ?>
                    <?php  if($modelObj->gwpm_full_name == '')
	{

	?>- <a class='edit-mode-link' href='<?php $this->get_gwpm_edit_link(); ?>'>Make Your Profile</a>
    <?php
	} else{

	 ?>- <a class='edit-mode-link' href='<?php $this->get_gwpm_edit_link(); ?>'>Edit Profile</a> </h2>
	 <?php $isSubscribed = get_option("gwpm_user_sub_" . get_current_user_id()) ;
                          if($isSubscribed != "true") {?>
                               <div id="subscribeDIV">
                                <form action="/matrimony" method="post">

                                 <label>Click on "Submit" button for Admin approval for displaying your profile on the site.
                                     Your profile will be activated by Administrator within 4 to 5 days and you will be notified by email.</label>
                                 <input type="input" name="doSubscribe" value="1" class="gwpm_hidden_fields"  />
                                 <input type="submit" id="submit" name="submit" value="SUBMIT" />
                                 </form>
                               </div>
                             <?php }else {echo "You have already requested for subscription. Please wait for the Admin to approve your     request." ;

		} ?>
	<?php } ?>
	<?php } ?>

<table class='gwpm-table'>
		<tbody>
			<tr>
				<td>

					<div class="gwpm_profile_pic_holder" >
					<a class="gwpm_profile_link" href="<?php echo $this->getUserImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['name'] ); ?>"
									target="_blank" title="Click to see the original image">
									<img class="gwpm-thumb-image" alt="profile-picture" src="<?php
									echo $this->getUserImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['thumb_name'] ); ?>" /></a></br>
					<span class="gwpm-help" >Click to see the original image</span>
					</div>
				</td>
				<td style="border-bottom: none;">
					<table>
					<?php if($modelObj->user_login == '') {
					 ?>
					   <?php } else { ?>
					   <!--
					   <tr>
					        <td valign="top"><small class="skip-container">User Name:</small></td>
					        <td valign="top"><small class="skip-container"><?php echo $modelObj->user_login ; ?></small></td>
			      		</tr>
			      		-->
			      		<tr>
			      			<td>Profile Id</td>
			      			<td><?php echo $this->get('pid') ?></td>
			      		</tr>
						<?php } ?>

						<?php if($modelObj->gwpm_full_name == '')  {?>
						<?php } else { ?><tr>
							<td valign="top">Full Name:</td>
							<td valign="top"><?php gwpm_echo( $modelObj->gwpm_full_name ); ?> </td>
						</tr>
						<?php } ?>
						<tr>
							<td valign="top"><a href="?print=true" id="print" class="button">Print</a></td>
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
					<h3> Basic Information </h3>
				</td>
			</tr>

		    <?php if($modelObj->gwpm_resident_address == '') {
		    ?>
			<?php } else {?><tr>
				<td style="width:200px" valign="top">Resident Address:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_resident_address ); ?></td>
			</tr>
			<?php } ?>
			<tr>

			</tr>
		 	<?php if($modelObj->gwpm_hobbies_activities == '') {
			?>
			<?php } else { ?><tr>
				<td valign="top">Hobbies & Activites:</td>
				<td valign="top"><?php echo ( $modelObj->gwpm_hobbies_activities ); ?></td>
			</tr>
			<?php } ?>
      		<!--tr>
				<td valign="top">Address Line 1:</td>
				<td valign="top"><?php echo ( $modelObj->gwpm_address['address1'] ) ; ?></td>
			</tr-->
			<!--tr>
				<td valign="top">Address Line 2:</td>
				<td valign="top"> <?php echo ( $modelObj->gwpm_address['address2'] ) ; ?></td>
			</tr-->
			<!--tr>
				<td valign="top">City:</td>
				<td valign="top"> <?php echo ( $modelObj->gwpm_address['city'] ) ; ?></td>
			</tr-->

			<?php if($modelObj->gwpm_expectation == '') { ?>
			<?php } else {?><tr>
	        	<td valign="top">Expectation:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getExpectationOptions($modelObj->gwpm_expectation)) ; 	?>
				</td>
      		</tr>
			<?php } ?>

			<?php if($modelObj->description == '') { ?>
      		<?php } else { ?><tr>
	        	<td valign="top">About You:</td>
	       		<td valign="top"><?php gwpm_echo( $modelObj->description ); ?></td>
      		</tr>
			<?php } ?>


			<tr>
				<td colspan="2">
					<h3> Physical Apprearance </h3>
				</td>
			</tr>
			<?php if($modelObj->gwpm_physical['height'] == '') { ?>
      		<?php } else {?><tr>
				<td valign="top">Height:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_physical['height'] ) ?></td>
			</tr>
			<?php }?>

			<?php if($modelObj->gwpm_physical ['weight'] == '') { ?>
      		<?php } else {?><tr>
				<td valign="top">Weight:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_physical ['weight'] ) ?></td>
			</tr>
			<?php  }?>

			<?php if($modelObj->gwpm_physical ['color_complexion'] == '') { ?>
      		<?php } else {?><tr>
				<td valign="top">Color Complexion:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_physical ['color_complexion'] ) ?></td>
			</tr>
			<?php }?>

			<?php if($modelObj->gwpm_physical ['body_type'] == '') { ?>
			<?php } else {?><tr>
				<td valign="top">Body Type:</td>
				<td valign="top">
					<?php gwpm_echo( getPhysicalType($modelObj->gwpm_physical ['body_type'] )) ?>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="2">
					<h3> Education & Work Information </h3>
				</td>
			</tr>
			<?php if($modelObj->gwpm_education['qualification'] == '') { ?>
			<?php } else {?><tr>
				<td valign="top">Qualification Degree:</td>
				<td valign="top">
					<?php
						gwpm_echo (getQualificationOptions($modelObj->gwpm_education['qualification'])) ;
					  	if(isset($modelObj->gwpm_education['qualification_other']) && $modelObj->gwpm_education['qualification_other'] != 'none') {
					  		gwpm_echo (' (' . $modelObj->gwpm_education['qualification_other'] . ')');
					  	}
					?>
				</td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_education['specialization'] == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Qualification Details:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_education['specialization'] ); ?></td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_education['status'] == '') { ?>
			<?php } else {?><tr>
				<td valign="top">Employement Status:</td>
				<td valign="top"> <?php gwpm_echo ( getEmploymentStatusOptions( $modelObj->gwpm_education['status']) ) ; ?> </td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_work['place'] == '') { ?>
			<?php } else {?><tr>
				<td valign="top">Work Place Information:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_work['place'] ); ?> </td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_workplace_address == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Workplace Address:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_workplace_address ); ?></td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_work['designation'] == '') { ?>
			<?php } else {?><tr>
				<td valign="top">Designation:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_work['designation'] ); ?> </td>
			</tr>
			<?php } ?>


			<!--tr>
				<td valign="top">Annual Income (INR):</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_work['income'] ); ?> </td>
			</tr-->

			<tr>
				<td colspan="2">
					<h3> Family Information </h3>
				</td>
			</tr>
			<?php if($modelObj->gwpm_native_place == '') { ?>
			<?php } else {?><tr>
				<td valign="top">Native place:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_native_place ); ?> </td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_father_name == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Father's Name:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_father_name ); ?> </td>
			</tr>
			<?php }?>

			<?php if($modelObj->gwpm_father_occupation == '') {?>
			<?php } else {?><tr>
				<td valign="top">Father's Occupation:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_father_occupation ); ?> </td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_mother_name == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Mother's Name:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_mother_name ); ?> </td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_mother_occupation == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Mother's Occupation:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_mother_occupation ); ?> </td>
			</tr>
			<?php }?>

			<?php if($modelObj->gwpm_siblings == '') {?>
			<?php } else { ?><tr>
				<td valign="top">Siblings:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_siblings ); ?> </td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_contact_no == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Family Contact:</td>
				<td valign="top"> <?php gwpm_echo ( $modelObj->gwpm_contact_no ) ; ?>
					<small class="skip-container">[Please mention poonakapol.com while calling]</small>
				</td>
			</tr>
			<?php }?>

			<?php if($modelObj->gwpm_mosal == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Mosal:</td>
				<td valign="top"><?php echo ( $modelObj->gwpm_mosal ); ?></td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_caste == '') { ?>
			<?php } else {?><tr>
	        	<td valign="top">Caste:</td>
	       		<td valign="top">
	       			<?php gwpm_echo ( $modelObj->gwpm_caste ); 	?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This Website Is Only For Kapol Members
				</td>
      		</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_family_address == '') { ?>
			<?php } else { ?><tr>
				<td valign="top">Family Address:</td>
				<td valign="top"><?php gwpm_echo( $modelObj->gwpm_family_address ); ?></td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_other_info == '') { ?>
	        <?php } else {?><tr>
				<td valign="top">Other information:</td>
				<td valign="top"><?php echo ( $modelObj->gwpm_other_info ); ?></td>
			</tr>
			<?php } ?>
      		<tr>
				<td colspan="2">
					<h3> Horoscope Information </h3>
				</td>
			</tr>
			<?php if($modelObj->gwpm_dob == '') { ?>
			<?php } else { ?><tr>
	        	<td valign="top">Date &amp; Time of Birth:</td>
	       		<td valign="top"><?php gwpm_echo ( changeDateformat($modelObj->gwpm_dob[0]) ); ?></td>
      		</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_pob == '') { ?>
			<?php } else { ?><tr>
			   	<td valign="top">Place of Birth:</td>
				<td valign="top"><?php gwpm_echo ( $modelObj->gwpm_pob ); ?></td>
		    </tr>
			<?php } ?>

			<?php if($modelObj->gwpm_gotra == '') { ?>
			<?php } else { ?><tr>
			   	<td valign="top">Gotra:</td>
				<td valign="top"><?php gwpm_echo ( $modelObj->gwpm_gotra); ?></td>
			</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_martial_status == '') { ?>
      		<?php } else { ?><tr>
	        	<td valign="top">Marital Status:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getMaritalOptions($modelObj->gwpm_martial_status) ) ; 	?>
				</td>
      		</tr>
			<?php } ?>


      		<!--tr>
	        	<td valign="top">Star Sign (Nakshatram):</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getStarSignOptions($modelObj->gwpm_starsign)) ; 	?>
				</td>
      		</tr-->
      		<!--tr>
	        	<td valign="top">Zodiac Sign (Raasi):</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getZodiacOptions($modelObj->gwpm_zodiac)) ; 	?>
				</td>
      		</tr-->
      		<!--tr>
	        	<td valign="top">Sevvai Dosham:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getYesNoOptions($modelObj->gwpm_sevvai_dosham)) ; 	?>
				</td>
      		</tr-->

      		<?php if($modelObj->gwpm_horoscope_dosha == '') { ?>
			<?php } else { ?><tr>
	        	<td valign="top">Horoscope Dosha:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getHoroscopeDoshaOptions($modelObj->gwpm_horoscope_dosha)) ; 	?>
				</td>
      		</tr>
			<?php } ?>

			<?php if($modelObj->gwpm_horoscope_matching == '') { ?>
			<?php } else { ?><tr>
	        	<td valign="top">Do You Believe in Horoscope matching:</td>
	       		<td valign="top">
	       			<?php gwpm_echo (getYesNoOptions($modelObj->gwpm_horoscope_matching)) ; 	?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Check <a href="http://www.drikpanchang.com/jyotisha/horoscope-match/horoscope-match.html" target="_new">www.drikpanchang.com</a> for more details.
				</td>
      		</tr>
			<?php } ?>
      		<!--tr>
	        	<td valign="top">Religion:</td>
	       		<td valign="top">
	       			<?php gwpm_echo ( $modelObj->gwpm_religion ); 	?>
				</td>
      		</tr-->
      	</tbody>
</table>
    		<?php
		if ( is_user_logged_in() ) {
		} else { ?>
			<p>
         		<a style="background-color: white;padding: 10px;width: 600px;display: block;border: 1px solid #ccc;text-align: center;font-weight:bold;text-transform:none" href="http://poonakapol.org/register/" target="_blank" rel="Register Matrimony">
         			New User? Register for free on poonakapol.com
        			</a>
			</p>
	<?php } ?>
<script>
	jQuery(document).ready(function($) {
		if (window.location.href.indexOf('print')>0) {
			$(".main-nav,#footer,.entry-title,.gwpm-menu,h3,.breadcrumb-list,.gwpm-help,.skip-container,#print").hide();
			$("#content-full").css("margin",0);
			$("td").css("padding",0);
			$("table").css("border",0);
			$("a[href='http://www.drikpanchang.com/jyotisha/horoscope-match/horoscope-match.html']").parent().hide();
			window.print();
		} else {
			$('#print').attr('href', window.location.href + '&print=true');
		}
	});
</script>