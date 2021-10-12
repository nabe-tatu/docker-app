<?php

return [
    's3' => [
        'domain' => env('AWS_S3_DOMAIN', ''),
        'bucket' => env('AWS_S3_BUCKET', '')
    ]
];
