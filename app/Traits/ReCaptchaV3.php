<?php

namespace App\Traits;

use Log;

trait ReCaptchaV3 {
    use GuzzleHttp;

    /**
     * ReCaptchaV3
     * 
     * @param string $token
     * @param string $remoteip
     * 
     * @return bool
     */
    public function reCaptchaV3(string $response, string $remoteip = null): bool
    {
        $request = $this->guzzleHttp('https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET', ''),
                'response' => $response,
                'remoteip' => $remoteip
            ],
            'POST',
            [
                'Accept' => 'application/json'
            ]
        );

        if ($request['success'] == false) {
            Log::error(__CLASS__ . '\\' . __FUNCTION__ . ':' . __LINE__, ['context' => $request['error-codes']]);
            return false;
        } else if ($request['success'] == true) {
            return true;
        }
    }
}