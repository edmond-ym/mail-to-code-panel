<?php

namespace App\Library\Services;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PrivateCode;
use App\Models\DraftMessage;

use App\Library\Services\MailCodeService;
use App\Models\MyMessage;
use App\Models\SentMessage;

class MessageService{
    function __construct(){

    }
    public static function send(String $sender_public_code, String $receiver_public_code, String $receiver_private_code, Array $message){
        $event_id=Str::random(10);
        $receiver_data=MyMessage::create([
            'id'=> $event_id,
            'sender_public_code'=>$sender_public_code, 
            'receiver_public_code'=>$receiver_public_code, 
            'receiver_private_code'=>$receiver_private_code, 
            'message'=>$message
        ]);
        $sender_data=SentMessage::create([
            'id'=>$event_id,
            'sender_public_code'=>$sender_public_code, 
            'receiver_public_code'=>$receiver_public_code, 
            'receiver_private_code'=>$receiver_private_code, 
            'message'=>$message
        ]);
        return (Object)
        [
            "result"=>"success",
            [
                'data'=>
                [
                    'receiver_data'=>$receiver_data, 
                    'sender_data'=>$sender_data 
                ]
            ]
        ];
    }
    public static function sendMultiple(String $sender_public_code, Array $receiver_list, Array $message, Array $option=[], $event_id=null){
        
        if ($event_id==null) {
            $event_id=Str::random(10);
        }
        $receiver_data=[];
        for ($i=0; $i < count($receiver_list); $i++) { 
            $arr=explode("-",trim($receiver_list[$i]," "));
            $receiver_public_code=$arr[0];
            $receiver_private_code=$arr[1];
            array_push($receiver_data,
                [
                    'id'=> $event_id.'-'.$i,
                    'sender_public_code'=>$sender_public_code, 
                    'receiver_public_code'=>$receiver_public_code, 
                    'receiver_private_code'=>$receiver_private_code, 
                    'message'=>$message
                ]
            );
            MyMessage::create([
                'id'=> $event_id.'-'.$i,
                'sender_public_code'=>$sender_public_code, 
                'receiver_public_code'=>$receiver_public_code, 
                'receiver_private_code'=>$receiver_private_code, 
                'message'=> $message
            ]);

        }


        $sender_data=SentMessage::create([
            'id'=>$event_id,
            'sender_public_code'=>$sender_public_code, 
            'receiver_list'=>$receiver_list,
            'message'=> $message
        ]);
        if ($event_id != null) {
            DraftMessage::where('id',$event_id)->where('sender_public_code', '=',$sender_public_code )->delete();
        }
        return (Object)
        [
            "result"=>"success",
            [
                'data'=>
                [
                    'receiver_data'=>$receiver_data, 
                    'sender_data'=>$sender_data 
                ]
            ]
        ];
    }
    
}