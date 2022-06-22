<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckCaptchaResponse implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->provider=config('Captcha.provider');
        $this->secret_key=config('Captcha.secret_key');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        if ($this->provider=='hCaptcha') {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://hcaptcha.com/siteverify');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "response=".$value."&secret=".$this->secret_key);
            
            $headers = array();
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            $result = curl_exec($ch);
        
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            if (isset(json_decode($result)->success)) {
                return json_decode($result)->success;
            }else{
                return false;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Captcha verification failed!';
    }
}
