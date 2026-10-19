<?php

return [
    'admin_email' => env('ADMIN_EMAIL'),
    'supabase_storage' => [
        'url' => env('SUPABASE_URL'),
        'service_role_key' => env('SUPABASE_SERVICE_ROLE_KEY'),
        'bucket' => env('SUPABASE_STORAGE_BUCKET', 'car-images'),
    ],
];
