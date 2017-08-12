<?php
if (!function_exists('is_admin')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit ();
}

function gwpm_admin_dasboard_page_sub_users() {
	$user_type = 'subscribers' ;
	include (GWPM_APPLICATION_URL . DS . 'views' . DS . 'admin' . DS . 'gwpm_ctrl_dashboard_view.php');
}

function gwpm_admin_dasboard_page_all_users() {
	$user_type = 'matrimony' ;
	include (GWPM_APPLICATION_URL . DS . 'views' . DS . 'admin' . DS . 'gwpm_ctrl_dashboard_view.php');
}

?>
<div id="gwpm_admin_dashboard" class="wrap">
	<?php
		screen_icon('options-general'); 
		echo "<h2>" . __( 'Admin Dashboard', 'genie-wp-matrimony' ) . "</h2>" ;
	?>
<div id="poststuff" class="metabox-holder">
		<div id="post-body" class="has-sidebar">
			<div id="post-body-content" class="has-sidebar-content">
				<?php do_meta_boxes('gpwmp_admin', 'normal', ''); ?>
			</div>		
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready( function($) {
		$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
		postboxes.add_postbox_toggles('gpwmp_admin');
	});
</script>
<?php 