<?php

namespace App\Library\Services;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PrivateCode;


class MailCodeService{
    function __construct(){

    }
    public static function publicCode(){
        return Str::random(7);
    }
    public static function privateCode(){
        return Str::random(6);
    }
    public static function generatePublicCode($user_id){
        return User::where('id', $user_id)
        ->update(['public_code' => self::publicCode()]);
    }
    public static function generatePrivateCode($user_id, $nickname){
        return PrivateCode::create([
            'secret_code' => self::privateCode(),
            'nickname'=> $nickname, 
            'user_id' => $user_id,

        ]);
    }
    public static function fetchPublicCode($user_id){
        return User::where('id', $user_id)->get()[0]->public_code;
    }
    public static function deletePrivateCode($user_id, $secret_code){
        return PrivateCode::where('secret_code',$secret_code)->where('user_id', $user_id)->delete();
    }
    public static function restorePrivateCode($user_id, $secret_code){
        return PrivateCode::withTrashed()
        ->where('secret_code',$secret_code)->where('user_id', $user_id)
        ->restore();
    }
    public static function CodeExistCheck($public_code, $secret_code){
        $user_public_data=User::where('public_code', '=', $public_code)->get();
        if (count($user_public_data)>0) {
            $user_id=$user_public_data[0]->id;
            $user_private_data=PrivateCode::where('secret_code',$secret_code)->where('user_id', $user_id)->get();
            if (count($user_private_data)>0) {
                return (Object)['result'=>true, 'reason'=>''];
            } else {
                $include_trashed_data=PrivateCode::withTrashed()->where('secret_code',$secret_code)->where('user_id', $user_id)->get();
                if (count($include_trashed_data)>0) {
                    return (Object)['result'=>false, 'reason'=>'trashed'];
                }else{
                    return (Object)['result'=>false, 'reason'=>'not-exist'];
                }
            }
        }else{
            return (Object)['result'=>false, 'reason'=>'public-code-not-exist'];
        }
    }

    public static function updatePrivateCodeInfo($user_id, $secret_code, $nickname){
        return PrivateCode::where('user_id', '=', $user_id)->where('secret_code',$secret_code)
               ->update(['nickname'=>$nickname]);
    }
    public static function permanentlyDeletePrivateCode($user_id, $secret_code){
        return PrivateCode::where('secret_code',$secret_code)->where('user_id', $user_id)->forceDelete();
    }
 
}