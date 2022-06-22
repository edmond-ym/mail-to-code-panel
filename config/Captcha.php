<?php

return [
    'provider'=>env('CAPTCHA_PROVIDER', 'hCaptcha'),
    'site_key'=>env('CAPTCHA_SITE_KEY', '10000000-ffff-ffff-ffff-000000000001'), 
    'secret_key'=>env('CAPTCHA_SECRET_KEY', '0x0000000000000000000000000000000000000000')
];