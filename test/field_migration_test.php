<?php
if (! function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

global $wpdb;

$dynaMigOpts = get_option(GWPM_DYNA_FIELD_MIG_OPTS);

appendLog( print_r($dynaMigOpts, true) );

$totalFields = get_option(GWPM_DYNA_FIELD_COUNT);
appendLog("Total Count: " . $totalFields . '<br />');
gwpm_echo("Total Count: " . $totalFields . '<br />');

if (!isset($dynaMigOpts) || $dynaMigOpts == false) {
    
    if ($totalFields == false)
        $totalFields = 0;
        
        $totalFields++ ;
        
        $migObjects = [] ;
        
        $migrationKeys = [] ;
        
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
        $migObjectSelects[0] = "Single" ;
        $migObjectSelects[1] = "Married" ;
        $migObjectSelects[2] = "Divorsed" ;
        $migObject['gwpm_dyna_field_values'] = getMaritalOptions() ;
        
        $migObjects[$nextKey] = $migObject;
        
        // Star Sign (Nakshatram)
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_starsign'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Star Sign';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getStarSignOptions() ;
        
        $migObjects[$nextKey] = $migObject;
        
        // Zodiac Sign (Raasi)
        $nextKey = GWPM_DYNA_KEY_PREFIX . ($totalFields ++);
        $migrationKeys['gwpm_zodiac'] = $nextKey; 
        $migObject = [];
        
        $migObject['gwpm_dyna_field_label'] = 'Zodiac Sign';
        $migObject['gwpm_dyna_field_type'] = 'select';
        $migObject['gwpm_dyna_field_values'] = getZodiacOptions() ;
        
        $migObjects[$nextKey] = $migObject;
        
        foreach($migObjects as $key => $value) {
            
            appendLog("Process object: " . $key) ;
            appendLog( print_r($value, true)) ;
            
            $dynaMigOpts[$key] = $value['gwpm_dyna_field_label'] ;
            
            $result = update_option ($key, $value) ;
            appendLog("Done " . $key . ' - ' . $result ) ;
            
        }
        
        update_option (GWPM_DYNA_FIELD_COUNT, ($totalFields-1)) ;
        update_option(GWPM_DYNA_FIELD_MIG_OPTS, $migrationKeys);
        
        echo "Created new fields for migration <br /><br />" ;
        
        print_r($migrationKeys) ;
    
} else {
    
    $adminModel = new GwpmAdminModel() ;
    $dynaNewFields = $adminModel->getMigratingDynaFields() ;
    print_r($dynaNewFields) ;
    appendLog("New dyna field: ") ;
    appendLog( $dynaNewFields) ;
    
}