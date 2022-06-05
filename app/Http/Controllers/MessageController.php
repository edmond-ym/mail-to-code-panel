<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Services\MessageService;
use App\Library\Services\MailCodeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\MailCodeVerify;
use Illuminate\Support\Facades\Redirect;
use App\Rules\MessageRule;
use App\Models\MyMessage;
use App\Models\SentMessage;
use App\Models\PrivateCode;
use App\Models\DraftMessage;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function send(Request $request, $event_id){
        $request->validate([
            'receiver_list' => ['required', new MailCodeVerify],
            'message'=>['required', new MessageRule]
        ]);
        //$arr=explode("-",trim($request->input('receiver_code')," "));
        //MessageService::send(MailCodeService::fetchPublicCode(Auth::id()), $arr[0], $arr[1], $request->input('message'));
        MessageService::sendMultiple(MailCodeService::fetchPublicCode(Auth::id()),$request->input('receiver_list'), $request->input('message'),[], $event_id);
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());

    }
    public function viewAnReceivedMessage(Request $request, $msg_id){
     
    
        $data=MyMessage::withTrashed()->where('id', '=', $msg_id )->where('receiver_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->get();
        if (count($data)>0) {
            

            return response()->json(['exist'=>true, 'data'=>$data]);
        } else {
            return response()->json(['exist'=>false, 'data'=>[]]);
        }
        
    }
    public function markAsRead(Request $request, $msg_id){
        MyMessage::where('id', '=', $msg_id )->where('receiver_public_code', '=', MailCodeService::fetchPublicCode(Auth::id()) )
        ->update([
            'read_at'=>\Carbon\Carbon::now()->toDateTimeString()
        ]);
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());

    }
    public function trashReceivedMessage(Request $request, $msg_id){
        MyMessage::where('id','=', $msg_id)->where('receiver_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->delete();
        //return Redirect::route('TrashedMessages');
        return redirect(url()->previous());

    }
    public function restoreReceivedMessage(Request $request, $msg_id){
        MyMessage::where('id','=', $msg_id)->where('receiver_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->restore();
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());
    }

    public function permanentlyDeleteReceivedMessage(Request $request, $msg_id){
        MyMessage::where('id','=', $msg_id)->where('receiver_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->forceDelete();
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());
    }





    public function viewASentMessage(Request $request, $msg_id){


        $data=SentMessage::withTrashed()->where('id','=', $msg_id)->where('sender_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->get();
        if (count($data)>0) {
            return response()->json(['exist'=>true, 'data'=>$data]);
        } else {
            return response()->json(['exist'=>false, 'data'=>[]]);
        }
        
    }
    public function trashSentMessage(Request $request, $msg_id){
        SentMessage::where('id',$msg_id)->where('sender_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->delete();
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());
    }
    public function restoreSentMessage(Request $request, $msg_id){
        SentMessage::where('id',$msg_id)->where('sender_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->restore();
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());
    }
    public function permanentlyDeleteSentMessage(Request $request, $msg_id){
        SentMessage::where('id',$msg_id)->where('sender_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->forceDelete();
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());
    }
    public function viewDraftMessage(Request $request, $event_id){
        $data=DraftMessage::where('id', $event_id)->where('sender_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()))->get();
        if (count($data)>0) {
            return response()->json(['exist'=>true, 'data'=>$data]);
        } else {
            return response()->json(['exist'=>false, 'data'=>[]]);
        }
    }
    public function updateDraftMessage(Request $request, $event_id){
        //return $request->all();
        $data=DraftMessage::updateOrCreate(
            ['id' => $event_id],
            [
                'sender_public_code'=> MailCodeService::fetchPublicCode(Auth::id()),
                'receiver_list'=> $request->input('receiver_list'),
                'message'=> $request->input('message')
            ]
        );
        //return Redirect::route(url()->previous());
        return redirect(url()->previous());
        //return response()->json(['event_id'=>$event_id,'data'=>$data]);

        
    }
    public function eraseDraftMessage($event_id){
        DraftMessage::where('id',$event_id)->where('sender_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->delete();
        //return Redirect::route('MyMessages');
        return redirect(url()->previous());
    }

}
