<?php

  $login_url = wp_login_url($_SERVER['REQUEST_URI']);
  $signup_url = get_option('siteurl') . '/wp-login.php?action=register';

?>
<p><?php //printf(__('You\'re unauthorized to view this page. Why don\'t you %s and try again. ', ''), '<a href="'. $login_url . '">' . __('Login', '') . '</a>'); ?>
<?php if(get_option('users_can_register')) {
?>
<?php //_e('If you do not have account, Please', ''); ?> <!--a href="<?php echo $signup_url; ?>"><?php _e('register for an Account.', ''); ?></a-->
<?php } ?>
<?php
global $gwpm_setup_model ;
//gwpm_echo("<br/>If you have already registered, Click <a href='" .
	//get_option( 'siteurl' ) . "/wp-admin/profile.php'>Here</a> to update your Biodata.") ;// or click <a href='" .
	//get_option('siteurl') . '/?page_id=' . $gwpm_setup_model->getMatrimonialId() .  '&page=subscribe' . "'>Here</a> to get approval from Admin") ;
?>
<a href="/register"><h4 class='gwpm-content-title' >Create Biodata / Register new candidate <br/>નવા ઉમેદવાર ના બાયોડેટા અહીં ભરો</h4></a>
New candidate has to create their biodata & photograph by clicking on above link.</a>
<br/>
<a href="<?php echo get_option('siteurl') . '/?page_id=' . $gwpm_setup_model->getMatrimonialId() .  '&page=search&action=view' ?>"><h4 class='gwpm-content-title' >View All Candidate's biodata (Login is not required to view all candidates)<br>રજીસ્ટર થયેલા ઉમેદવારો ના બાયોડેટા</h4></a>
<br/>
You can view all candidates' biodata by clicking on above link. After registration, candidate has to visit and view other candidates and contact by themsleves.<br/>
Technical committee members will help for any registrations related problems.<br/>
Poonakapol.com / poonakapol.org or Poona Kapol Mitra Mandal has not verified and is not responsible for any false data.</a>.
<br/>

<h4><a href="/login?redirect_to=http%3A%2F%2Fwww.poonakapol.org/matrimony/">Edit Biodata (For registerd users only) <br>બાયોડેટા ની વિગત બદલવા માટે</a></h4>

<br/>For edit biodata, click on above link. For that username/password is required. <br/>
This username / password was sent to you by email to your registered email ID, at the time of registration

<h4>Terms & Condition</h4>

1. Poonakapol.com / poonakapol.org or Poona Kapol Mitra Mandal has not verified candidate data and Mandal is not responsible for any false data.<br/>
2. If any candidate will get engaged, it is candidate's responsibility to inform to technical committee members. <br/>
3. To delete the biodata website, Candidate has to send email to poonakapolmatrimonial@gmail.com from registered email id only.<br/>
4. Candidate's biodata is open to all on the website. Anybody can view the candidate's biodata. <br/>
5. By submitting / updating biodata on website, candidate is agreed to provide full access of his/her personal information to the viewer.<br/>
6. Candidate's Biodata will be activated by Administrator within 4 to 5 days and you will be notified by email. <br/>
7. Any offencive content / information / photograph should not be updated / uploaded by any candidate. <br/>
8. If it is found, legal action will be taken and will be considered as broken of cyber lows.<br/>
<?php

function getUserPrImageURL($userId, $imageName, $gender = null) {
		if(!isset($imageName)) {
			if($gender == "Male")
				return GWPM_PUBLIC_IMG_URL . URL_S . 'male.jpg' ;
			elseif($gender == "Female")
				return GWPM_PUBLIC_IMG_URL . URL_S . 'female.jpg' ;
			else
				return GWPM_PUBLIC_IMG_URL . URL_S . 'gwpm_icon.png' ;
		} else {
			// added time to the image url to get image from url without using the cache - helpful while updating the image
			return GWPM_GALLERY_URL . URL_S . $userId . URL_S . $imageName . '?' . gettimeofday(true);
		}
	}
$profileModel = new GwpmProfileModel();



?>
<br /><br />
<h4>Here are some sample candidates.</h4>
<table class='gwpm-table'>
		<tbody>
			<tr style="border-bottom: 1px solid #dddddd;">
				<td style="border-right: 1px solid #dddddd;">
				<?php $modelObj = $profileModel->getUserObj(265); ?>
					<div class="gwpm_profile_pic_holder" >
						<img class="gwpm-thumb-image" alt="profile-picture" src="<?php
							echo getUserPrImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['thumb_name'] ); ?>" /></br>
					</div>
					<b>Gender:</b> <?php echo $modelObj->gwpm_gender[0]==1?"Male":"Female";?> <br/>
					<b>Birth Date:</b> <?php echo gwpm_echo($modelObj->gwpm_dob);?> <br/>
					<b>Gotra:</b> <?php gwpm_echo ( $modelObj->gwpm_gotra); ?>
				</td>
				<td  style="border-right: 1px solid #dddddd;">
				<?php $modelObj = $profileModel->getUserObj(1456); ?>
					<div class="gwpm_profile_pic_holder" >
					<img class="gwpm-thumb-image" alt="profile-picture" src="<?php
									echo getUserPrImageURL ($modelObj->userId , $modelObj->gwpm_profile_photo['thumb_name'] ); ?>" /></br>
					</div>
					<b>Gender:</b> <?php echo $modelObj->gwpm_gender[0]==1?"Male":"Female";?> <br/>
					<b>Birth Date:</b> <?php echo gwpm_echo($modelObj->gwpm_dob);?> <br/>
					<b>Gotra:</b> <?php gwpm_echo ( $modelObj->gwpm_gotra); ?>
				</td>
			</tr>
		</tbody>
</table>
<br /><br /><br />