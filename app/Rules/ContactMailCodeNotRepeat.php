<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContactMailCodeNotRepeat implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($contactList, $case_code=null)
    {
        $this->contactList=$contactList;
        $this->case_code=$case_code;
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
        if (is_string($value)) {
            $arr=explode("-",trim($value," "));
            $public_code=$arr[0];
            $private_code=$arr[1];
            if ($this->case_code==null) {
                foreach($this->contactList as $key=>$item) {
                    if ($item['publicCode']==$public_code &&  $item['privateCode']==$private_code) {
                        return false;
                    }
                }
                return true;
            }else{
                foreach($this->contactList as $key=>$item) {
                    if ($item['publicCode']==$public_code &&  $item['privateCode']==$private_code && $key != $this->case_code) {
                        return false;
                    }
                }
                return true;
            }
        }if (is_array($value)) {
            if (count($value)>0) {
                $exist=true;
                for ($i=0; $i < count($value); $i++) { 
                   
                }
                return $exist;
            }else{
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
        return 'Contact Repeated';
    }
}
