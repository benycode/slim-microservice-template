<?php

// Application default settings

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

// Timezone
date_default_timezone_set('Europe/Vilnius');

$settings = [];

$settings['version'] = 'v0.0.0';

// Error handler
$settings['error'] = [
    // Should be set to false for the production environment
    'display_error_details' => false,
];

// Logger settings
$settings['logger'] = [
    // Default log level
    'level' => \Psr\Log\LogLevel::INFO,
];

return $settings;
