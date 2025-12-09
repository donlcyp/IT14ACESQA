<?php

return [
    'mode'                  => 'utf-8',
    'format'                => 'A4',
    'default_font'          => 'Helvetica',
    'font_path'             => base_path('resources/fonts/'),
    'font_cache'            => storage_path('fonts/'),
    
    'pdf_backend'           => 'CPDF',
    'php_path'              => base_path('vendor/bin/wkhtmltopdf'),
    
    'font_subsetting'       => true,
    'remote_pdf_lib'        => false,
    'pdf_lib_path'          => null,
    
    'logOutputFile'         => storage_path('logs/dompdf.log'),
    'tempDir'               => sys_get_temp_dir(),
    
    'chroot'                => public_path(),
    
    'allowed_protocols'     => [
        'file://' => [
            'rules' => []
        ],
        'http://' => [
            'rules' => []
        ],
        'https://' => [
            'rules' => []
        ]
    ],
    
    'svg' => [
        'convert_entities' => true,
    ],
    
    'enable_php'            => false,
    'enable_javascript'     => false,
    'enable_remote'         => true,
    'enable_font_subsetting'=> false,
    
    'margin_top'            => 0,
    'margin_right'          => 0,
    'margin_bottom'         => 0,
    'margin_left'           => 0,
    
    'Attachment'            => false,
    'isPhpEnabled'          => false,
];
