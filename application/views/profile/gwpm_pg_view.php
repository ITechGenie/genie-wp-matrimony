<?php 

$isMigrated = get_option( GWPM_DYNA_FIELD_MIG_COMPLETE ) ;
if ($isMigrated != null && isset($isMigrated) ) {
    include_once 'gwpm_pg_view_new.php';
} else {
    include_once 'gwpm_pg_view_old.php';
}
