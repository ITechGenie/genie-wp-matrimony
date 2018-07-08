<?php

/** Configuration Variables **/

define('DEVELOPMENT_ENVIRONMENT', true);
define('GWPM_ENABLE_DEBUGGING', true);

define('GWPM_APPLICATION_URL', GWPM_ROOT . DS . 'application');
define('GWPM_LIBRARY_URL', GWPM_ROOT . DS . 'library');
define('GWPM_LOG_URL', GWPM_ROOT . DS . 'logs');
define('GWPM_PUBLIC_URL', GWPM_CONTENT_URL . URL_S . 'public');
define('GWPM_PUBLIC_CSS_URL', GWPM_PUBLIC_URL . URL_S . 'css');
define('GWPM_PUBLIC_JS_URL', GWPM_PUBLIC_URL . URL_S . 'js');
define('GWPM_PUBLIC_IMG_URL', GWPM_PUBLIC_URL . URL_S . 'images');
define('GWPM_PAGE_TITLE', 'Matrimony');
define('GWPM_META_KEY', 'genie_wp_matrimony');
define('GWPM_META_VALUE', 'matrimony_page_meta');
define('GWPM_USER_ROLE', 'matrimony_user');
define('GWPM_USER_PREFIX', 'gwpm_');
define('GWPM_GALLERY_DIR', WP_CONTENT_DIR . URL_S . 'uploads' . URL_S . 'gwpm_gallery');
define('GWPM_GALLERY_URL', WP_CONTENT_URL . URL_S . 'uploads' . URL_S . 'gwpm_gallery');
// define("GWPM_IMAGE_MAX_SIZE", "2048");  // In KBs
define("GWPM_GALLERY_MAX_IMAGES", "12");
define("GWPM_CONVERSE_MAX_NOS", "10");
define("GWPM_ACTIVITY_MAX_NOS", "10");
define("GWPM_DYNA_KEY_PREFIX", "gwpm_dyna_field_");
define("GWPM_DYNA_FIELD_COUNT", "gwpm_dyna_field_count");
define("GWPM_DYNA_FIELD_MIG_OPTS", "gwpm_dyna_mig_opts_field");
define("GWPM_DYNA_FIELD_MIG_COMPLETE", "gwpm_dyna_mig_complete");
define("GWPM_AVATAR", "gwpm_avatar");
define("GWPM_MAX_USER_MESSAGES", 5);

define('GWPM_USER_LOGIN_PREF', 'gwpm_user_login_pref');

define('GWPM_INTERNAL_VERSION', 'gwpm_0.9.1');
define ('GWPM_MAX_DYNA_MIGRATE_USER_COUNT' , 50 );

$gwpm_db_version = 0.1;

/*
define('DB_NAME', 'yourdatabasename');
define('DB_USER', 'yourusername');
define('DB_PASSWORD', 'yourpassword');
define('DB_HOST', 'localhost');
*/