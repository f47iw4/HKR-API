<?php

return [
    'proxies' => null, // Confía en todos los proxies
    'headers' => Illuminate\Http\Request::HEADER_X_FORWARDED_FOR | 
                 Illuminate\Http\Request::HEADER_X_FORWARDED_HOST | 
                 Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO,
];
