<div id="content" role="main" >
	<?php
		$counter = 0;
global $gwpm_setup_model;
		$errMessage = $this->get('error_messages');
		$success_message = $this->get('success_message');
		$warn_message = $this->get('warn_message');
		$user_message = $this->get('user_message');
		echo '<br />' ;
		if (isset ($user_message)) {
			echo "<h2>" . $user_message . "</h2>";
		}
		
		if (isset ($errMessage)) {
			$counter = sizeof($errMessage);
		}
		if ($counter == 0) {
			if (isset ($success_message)) {
				echo "<h2>" . $success_message . "</h2>";
			}
			$pageURL = $this->getPlainURL();
		} else {
			if (isset ($warn_message)) {
				echo "<h2>" . $warn_message . "</h2>";
			}
			foreach ($errMessage as $message) {
				echo '<h4>' . $message . '</h4>';
				$counter++;
			}
			$pageURL = $this->getBackURL();
		}
	?>
	<?php $isSubscribed = get_option("gwpm_user_sub_" . get_current_user_id()) ;
		if($isSubscribed != "true") {

if ($counter == 0) {?>
	<div id="subscribeDIV">
			<a href='/?page_id=6&page=profile&action=edit'><h3>View / Update your Profile</h3></a>
<a href='/?page_id=6&page=search&action=view'><h3>View all candidates</h3></a>
<br />
	
			<form action="/matrimony" method="post">  
			
			<label>Click on "Submit" button for Admin approval for displaying your Biodata on the site.
Your Biodata will be activated by Administrator within 4 to 5 days and you will be notified by email.</label>  
			<input type="input" name="doSubscribe" value="1" class="gwpm_hidden_fields"  />   
			<input type="submit" id="submitbtn" name="submitbtn" value="SUBMIT" />  
			</form> 
			</div>
			<?php } }else {?>
<br/>
<a href="<?php echo get_option('siteurl') . '/?page_id=' . $gwpm_setup_model->getMatrimonialId() .  '&page=search&action=view' ?>"><h4 class='gwpm-content-title' >View All Candidate's biodata<br>રજીસ્ટર થયેલા ઉમેદવારો ના બાયોડેટા</h4></a>
<br/>
<a href="<?php $this->get_gwpm_formated_url('page=profile&action=view') ?>"><h4 class='gwpm-content-title' >View Your Biodata </h4></a>
<br/>

You have already requested for subscription. Please wait for the Admin to approve your request.

		<?php } ?>
	<nav id="nav-single"><br />					
		<span class="nav-previous">
		<?php echo $pageURL; ?>
		</span> 
	</nav>
</div>