<?php
$databases = [];
$settings['hash_salt'] = getenv('SITE_HASH_SALT');
$settings['update_free_access'] = FALSE;
$settings['file_private_path'] = '../private';
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';
$settings['trusted_host_patterns'] = [
    '^'.addcslashes(getenv('SITE_URL'), ".").'$',
];
$settings['file_scan_ignore_directories'] = [
    'node_modules',
    'bower_components',
];
$settings['entity_update_batch_size'] = 50;
$settings['entity_update_backup'] = TRUE;
$settings['config_sync_directory'] = '../config/sync';
$config['build_hooks_circleci.circleCiConfig']['circleci_api_key'] = getenv('CIRCLECI_API_KEY');
$databases['default']['default'] = array (
    'database' => 'drupal',
    'username' => 'drupal',
    'password' => getenv('MYSQL_PASSWORD'),
    'prefix' => '',
    'host' => 'portfolio-drupal-mariadb',
    'port' => '3306',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
);