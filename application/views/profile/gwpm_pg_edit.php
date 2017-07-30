<?php 

$isMigrated = get_option( GWPM_DYNA_FIELD_MIG_COMPLETE ) ;
if ($isMigrated != null && isset($isMigrated) ) {
    include_once 'gwpm_pg_edit_new.php';
} else {
    include_once 'gwpm_pg_edit_old.php';
}