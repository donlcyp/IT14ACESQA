<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Bundy Clock Integration Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for bundy clock (time clock) device integration
    |
    */

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist Security
    |--------------------------------------------------------------------------
    |
    | Enable IP-based access control for bundy clock API endpoints
    | Only requests from whitelisted IPs will be accepted
    |
    */
    'use_ip_whitelist' => env('BUNDY_CLOCK_USE_IP_WHITELIST', false),
    
    'allowed_ips' => [
        // Add your bundy clock device IP addresses here
        // '192.168.1.100',
        // '10.0.0.50',
    ],

    /*
    |--------------------------------------------------------------------------
    | API Token Authentication
    |--------------------------------------------------------------------------
    |
    | Enable token-based authentication for bundy clock devices
    | Devices must send: Authorization: Bearer YOUR_TOKEN
    |
    */
    'use_api_token' => env('BUNDY_CLOCK_USE_API_TOKEN', false),
    
    'api_token' => env('BUNDY_CLOCK_API_TOKEN', 'your-secret-token-here'),

    /*
    |--------------------------------------------------------------------------
    | Attendance Settings
    |--------------------------------------------------------------------------
    |
    | Configure attendance behavior
    |
    */
    
    // Scheduled work start time (24-hour format)
    'scheduled_start_hour' => env('BUNDY_CLOCK_START_HOUR', 8),
    'scheduled_start_minute' => env('BUNDY_CLOCK_START_MINUTE', 0),
    
    // Grace period for lateness (in minutes)
    'grace_period_minutes' => env('BUNDY_CLOCK_GRACE_PERIOD', 15),
    
    // Auto-approve attendance (disable HR validation)
    // Set to false to require HR validation
    'auto_approve' => env('BUNDY_CLOCK_AUTO_APPROVE', false),

    /*
    |--------------------------------------------------------------------------
    | Device Settings
    |--------------------------------------------------------------------------
    */
    
    // Log all bundy clock activity
    'enable_logging' => env('BUNDY_CLOCK_ENABLE_LOGGING', true),
    
    // Store device_id with attendance records
    'track_device_id' => env('BUNDY_CLOCK_TRACK_DEVICE_ID', true),
];
