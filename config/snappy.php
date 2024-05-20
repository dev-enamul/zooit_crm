<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    | Enabled:
    |
    |    Whether to load PDF / Image generation.
    |
    | Binary:
    |
    |    The file path of the wkhtmltopdf / wkhtmltoimage executable.
    |
    | Timeout:
    |
    |    The amount of time to wait (in seconds) before PDF / Image generation is stopped.
    |    Setting this to false disables the timeout (unlimited processing time).
    |
    | Options:
    |
    |    The wkhtmltopdf command options. These are passed directly to wkhtmltopdf.
    |    See https://wkhtmltopdf.org/usage/wkhtmltopdf.txt for all options.
    |
    | Env:
    |
    |    The environment variables to set while running the wkhtmltopdf process.
    |
    */

    'pdf' => [
        'enabled' => true,
//         'binary'  => env('WKHTML_PDF_BINARY', '/usr/bin/wkhtmltopdf'),
//        'binary' => env('WKHTMLTOPDF_BINARY', base_path('bin/wkhtmltopdf-0.12.2.3')),
        'binary' => base_path(env('WKHTMLTOPDF_BINARY', 'vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64')),
        'timeout' => false,
        'options' => array(
            'encoding' => 'utf-8',
            'margin-top' => 15,
            'margin-bottom' => 15,
            'print-media-type' => true
        ),
        'env'     => array(),
    ],

    'image' => [
        'enabled' => true,
        'binary'  => env('WKHTML_IMG_BINARY', '/usr/local/bin/wkhtmltoimage'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],

];
