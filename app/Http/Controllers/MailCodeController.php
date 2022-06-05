<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Services\MailCodeService;
use Illuminate\Support\Facades\Redirect;
use App\Rules\ConfirmPrivateCodeMatch;
use App\Rules\ConfirmPasswordCheck;



class MailCodeController extends Controller
{
    public function new(Request $request){
        $request->validate([
            'nickname' => 'required|max:100',
        ]);
        
        MailCodeService::generatePrivateCode(Auth::id(), $request->input('nickname'));
        return Redirect::route('PrivateCodeManager');
    }
    public function delete(Request $request){
        $request->validate([
            'secret_code' => 'required',
        ]);
 
        MailCodeService::deletePrivateCode(Auth::id(),$request->input('secret_code'));
        return Redirect::route('PrivateCodeManager');
    }
    public function restore(Request $request){
        $request->validate([
            'secret_code' => 'required',
        ]);
 
        MailCodeService::restorePrivateCode(Auth::id(),$request->input('secret_code'));
        return Redirect::route('PrivateCodeManager');
    }
    public function amendInfo(Request $request, $privateCode){
        $request->validate([
            'nickname' => 'required'
        ]);
        MailCodeService::updatePrivateCodeInfo(Auth::id(), $privateCode, $request->input('nickname'));
        return Redirect::route('PrivateCodeManager');
    }

    public function permanentlyDelete(Request $request, $privateCode){
        $request->validate([
            'confirmPrivateCode'=>['required',new ConfirmPrivateCodeMatch($privateCode)],
            'confirmPassword'=>['required', new ConfirmPasswordCheck(Auth::id())]
        ]);
        MailCodeService::permanentlyDeletePrivateCode(Auth::id(), $privateCode);
        return Redirect::route('PrivateCodeManager');
    }
}

