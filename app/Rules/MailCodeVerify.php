<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Library\Services\MailCodeService;

class MailCodeVerify implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nonExistList=[];
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
 
        if (is_array($value)) {
            if (count($value)>0) {
                $exist=true;
                for ($i=0; $i < count($value); $i++) { 
                    
                    
                    $arr=explode("-",trim($value[$i]," "));
                    $public_code=$arr[0];
                    $private_code=$arr[1];
                    if (!MailCodeService::CodeExistCheck($public_code, $private_code)->result) {
                        $exist=false;
                        array_push($this->nonExistList, $public_code.'-'.$private_code);
                    }
                }
                return $exist;
            }else{
                return false;
            }
        }
        if (is_string($value)) {
            $arr=explode("-",trim($value," "));
            $public_code=$arr[0];
            $private_code=$arr[1];
            if (MailCodeService::CodeExistCheck($public_code, $private_code)->result) {
                return true;
            } else {
                array_push($this->nonExistList, $public_code.'-'.$private_code);
                return false;
            }
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if (count($this->nonExistList)>0) {
            return 'Mail Code '. json_encode($this->nonExistList).' Not Exist';
        } else {
            return 'Mail Code Required';
        }
        
    }
}
