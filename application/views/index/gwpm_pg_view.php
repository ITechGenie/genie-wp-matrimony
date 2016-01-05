<?php
	$modelObj = $this->get('model');
global $gwpm_setup_model ;
?>
<h1>
	<h2 class='gwpm-content-title' >Welcome</h2>
	<table class='gwpm-table'>
		<tbody>
			<tr>
				<td><a href="<?php echo get_option('siteurl') . '/?page_id=' . $gwpm_setup_model->getMatrimonialId() .  '&page=search&action=view' ?>"><h4 class='gwpm-content-title' >View All Candidate's biodata<br>રજીસ્ટર થયેલા ઉમેદવારો ના બાયોડેટા</h4></a>
<br/>
You can view all candidates' biodata by clicking on above link. After registration, candidate has to visit and view other candidates and contact by themsleves.<br/>
Technical committee members will help for any registrations related problems.<br/>
Poonakapol.com / poonakapol.org or Poona Kapol Mitra Mandal has not verified and is not responsible for any false data.</a>.
<br/>

<h4><a href="<?php $this->get_gwpm_formated_url('page=profile&action=view') ?>">View Biodata <br>બાયોડેટા ની વિગત બદલવા માટે</a></h4>
	
				</td></tr>
				<!--tr>
				<td>View the last <?php echo GWPM_CONVERSE_MAX_NOS ?> activity at <a href='<?php $this->get_gwpm_formated_url('page=activity&action=view') ?>' >Activity</a></td></tr>
				<tr>
				<td>View Interests, Messages from other users at <a href='<?php $this->get_gwpm_formated_url('page=messages&action=view') ?>' >Messages</a> (You have <?php echo $modelObj->unreadMessages; ?> unread notifications)</td></tr>
				<tr>
				<td>View your Gallery of photos at <a href='<?php $this->get_gwpm_formated_url('page=gallery&action=view') ?>' >Gallery</a></td></tr><tr>
				<td>View your Search other users at <a href='<?php $this->get_gwpm_formated_url('page=search&action=view') ?>' >Search</a></td></tr><tr>
				<?php

				if(DEVELOPMENT_ENVIRONMENT == false) {
					?>
					<td>View Developer Test Page <a href='<?php $this->get_gwpm_formated_url('page=admin') ?>'>Admin</a></td></tr><tr>
					<td>View Developer Test Page <a href='<?php $this->get_gwpm_formated_url('page=test') ?>'>Test Page</a></td></tr><tr>
					<?php
				}

				?>
			</tr -->
		</tbody>
	</table>
</h1>