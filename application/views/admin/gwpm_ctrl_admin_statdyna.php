<?php
if (! function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

echo "<h3>" . __('Migrate Static Fields to Dynamic Fields', 'genie-wp-matrimony') . "</h3>";

global $wpdb;

$dynaMigComplete = get_option(GWPM_DYNA_FIELD_MIG_COMPLETE ) ;
appendLog($dynaMigComplete);
$dynaMigOpts = get_option(GWPM_DYNA_FIELD_MIG_OPTS);
appendLog(print_r($dynaMigOpts, true));
$totalFields = get_option(GWPM_DYNA_FIELD_COUNT);
appendLog("Total Count: " . $totalFields . '<br />');

if (isset($dynaMigComplete) && $dynaMigComplete != null ) {
    _e("Migration of fields already done !", 'genie-wp-matrimony') ;
    echo "<br /><br />" ;
} else {
    $formSubmitted = null ;
    if (isset($_POST['formSubmitted'] )) {
        $formSubmitted = $_POST['formSubmitted'] ;
    }
?>

<form name="gwpm_form" method="post"
	action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="formSubmitted" value="Y">

<?php
if (isset($formSubmitted) && $formSubmitted != null) {
    
    $createFields = null ;
    $migrateFields = null ;
    
    if (isset($_POST['createFields'] )) {
        $createFields= $_POST['createFields'] ;
    }
    
    if (isset($_POST['migrateFields'] )) {
        $migrateFields= $_POST['migrateFields'] ;
    }
    
    if (isset($createFields) && $createFields != null) {
        
        if ($totalFields == false)
            $totalFields = 0;
        
        $totalFields ++;
        
        $migObjects = [];
        
        $migrationKeys = [];
        
        // Mobile
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_contact_no'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Contact No';
        $migObject['gwpm_dyna_field_type'] = 'text';
        
        $migObjects[$nextKey] = $migObject;
        
        // Caste
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_caste'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Caste';
        $migObject['gwpm_dyna_field_type'] = 'text';
        
        $migObjects[$nextKey] = $migObject;
        
        // Religion
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_religion'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Religion';
        $migObject['gwpm_dyna_field_type'] = 'text';
        
        $migObjects[$nextKey] = $migObject;
        
        // Sevai Dosham
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_sevvai_dosham'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Sevai Dosham';
        $migObject['gwpm_dyna_field_type'] = 'yes_no';
        
        $migObjects[$nextKey] = $migObject;
        
        // Marital Status
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_martial_status'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Marital Status';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getMaritalOptions();
        
        $migObjects[$nextKey] = $migObject;
        
        // Star Sign (Nakshatram)
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_starsign'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Star Sign';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getStarSignOptions();
        
        $migObjects[$nextKey] = $migObject;
        
        // Zodiac Sign (Raasi)
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_zodiac'] = $nextKey;
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Zodiac Sign';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getZodiacOptions();
        
        $migObjects[$nextKey] = $migObject;
        
        foreach ($migObjects as $key => $value) {
            
            appendLog("Process object: " . $key);
            appendLog(print_r($value, true));
            
            $dynaMigOpts[$key] = $value['gwpm_dyna_field_label'];
            
            $result = update_option($key, $value);
            appendLog("Done " . $key . ' - ' . $result);
        }
        
        update_option(GWPM_DYNA_FIELD_COUNT, ($totalFields - 1));
        update_option(GWPM_DYNA_FIELD_MIG_OPTS, $migrationKeys);
        
        print_r($migrationKeys);
        
        echo "Created new Dynamic fields for migration !<br /><br />";
        echo '<input type="hidden" name="migrateFields" value="Y">';
        printf(esc_html__('Migrate Batch of %d Users to Dynamic fields?', 'genie-wp-matrimony'), GWPM_MAX_DYNA_MIGRATE_USER_COUNT);
        echo "<br />" ;
        _e("Note: You can change default number property GWPM_MAX_DYNA_MIGRATE_USER_COUNT at /config/gwpm_config.php. ") ;
        echo "<br />" ;
        _e("Migration might take a while to complete. Please be patient and note any error thrown !", 'genie-wp-matrimony') ;
    } else if (isset($migrateFields) && $migrateFields!= null) {
        echo '<input type="hidden" name="migrateFields" value="Y">';
        $adminModel = new GwpmAdminModel() ;
        $resp = $adminModel->migrateToDynamicFieldData() ;
        if (isset($resp) && sizeof($resp) > 0 ) {
            printf(esc_html__('Migrate next Batch of %d Users to Dynamic fields?', 'genie-wp-matrimony'), GWPM_MAX_DYNA_MIGRATE_USER_COUNT);
            echo "<br />" ;
            _e("Migration might take a while to complete. Please be patient and note any error thrown !", 'genie-wp-matrimony') ;
        } else {
            
        }
    }
} else {
    if (! isset($dynaMigOpts) || $dynaMigOpts == false) {
        echo _e("Create Dynamic Fields from Static Fields ?", 'genie-wp-matrimony');
        echo '<input type="hidden" name="createFields" value="Y">';
    } else {
        echo '<input type="hidden" name="migrateFields" value="Y">';
        printf(esc_html__('Migrate Batch of %d Users to Dynamic fields?', 'genie-wp-matrimony'), GWPM_MAX_DYNA_MIGRATE_USER_COUNT);
        echo "<br />" ;
        _e("Note: You can change default number property GWPM_MAX_DYNA_MIGRATE_USER_COUNT at /config/gwpm_config.php. ", 'genie-wp-matrimony') ;
        echo "<br />" ;
        _e("Migration might take a while to complete. Please be patient and note any error thrown !", 'genie-wp-matrimony') ;
    }
}
?>
	<p class="submit">
		<input type="submit" name="SubmitForm" value="Submit" />
	</p>
</form>
<?php 
}
?>
