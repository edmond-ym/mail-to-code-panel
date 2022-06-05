<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\ContactStore;
use Illuminate\Support\Facades\Redirect;
use App\Rules\MailCodeVerify;
use App\Rules\ContactMailCodeNotRepeat;

use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    public function new(Request $request, $case_code){
       
        $request->validate([
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'contactList'=>'required',
        ]);
        $contact_store=ContactStore::find(Auth::id());
        $current_contact_list=$contact_store->contact_list;
      
        $request->validate([
            'contactList' => [new MailCodeVerify/*, new ContactMailCodeNotRepeat($current_contact_list)*/],
        ]);
        //return $request->all();
        //$case_code=Str::random(6);
        $current_contact_list[$case_code]=$request->all();
        $contact_store->contact_list=$current_contact_list;

        $contact_store->save();
        
        return Redirect::route('ContactList');
    }
    public function fetchContact(Request $request,$case_code = null){
        $contact_store=ContactStore::find(Auth::id());
        $current_contact_list=$contact_store->contact_list;
        if ($case_code==null) {
            return response()->json(['exist'=>true, 'data'=>$current_contact_list]);
        }else{
            if (array_key_exists($case_code, $current_contact_list)) {
                return response()->json(['exist'=>true, 'data'=>$current_contact_list[$case_code]]);
            }else{
                return response()->json(['exist'=>true, 'data'=>[]]);
            }
        }
        

    }

    public function updateContact($case_code, Request $request){
        
        $request->validate([
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'contactList'=>'required',
        ]);
        
        $contact_store=ContactStore::find(Auth::id());
        $current_contact_list=$contact_store->contact_list;
        
        //return $request->all();
        $request->validate([
            'contactList' => [new MailCodeVerify/*, new ContactMailCodeNotRepeat($current_contact_list)*/],
        ]);
        
        $current_contact_list[$case_code]=$request->all();
        $contact_store->contact_list=$current_contact_list;

        $contact_store->save();
        
        return Redirect::route('ContactList');
    }
    public function deleteContact($case_code, Request $request){
        $contact_store=ContactStore::find(Auth::id());
        $current_contact_list=$contact_store->contact_list;
        unset($current_contact_list[$case_code]);
        $contact_store->contact_list=$current_contact_list;

        $contact_store->save();
        
        return Redirect::route('ContactList');
    }
}
