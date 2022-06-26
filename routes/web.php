<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailCodeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ContactController;

use App\Models\MyMessage;
use App\Models\PrivateCode;
use App\Library\Services\MailCodeService;
use App\Library\Services\MessageService;
use App\Models\SentMessage;
use App\Models\ContactStore;
use App\Models\DraftMessage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    /*return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);*/
    return view('home', ['loggedIn'=>Auth::check()]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        //return Inertia::render('Dashboard');
        return Redirect::route('MyMessages');
    })->name('dashboard');
    Route::get('/private-code-manager', function () {
        return Inertia::render('Dashboard/PrivateCodeManager', [
            'privateCodeList' => PrivateCode::where('user_id', '=', Auth::id())->get(),
            'publicCode'=>MailCodeService::fetchPublicCode(Auth::id()),
            'trashedPrivateCode'=>PrivateCode::onlyTrashed()->where('user_id', '=', Auth::id())->get()
        ]);
    })->name('PrivateCodeManager');
   

    Route::get('/my-messages/{search_keyword?}', function ($search_keyword=null) {
        return Inertia::render('Dashboard/MyMessages', [
            'messageList'=>MyMessage::search($search_keyword)->where('receiver_public_code',MailCodeService::fetchPublicCode(Auth::id()) )->get(), 
            'publicCode'=>MailCodeService::fetchPublicCode(Auth::id()),
            'searchKeyword'=>$search_keyword,
        ]);
    })->name('MyMessages');
    Route::get('/sent-messages/{search_keyword?}', function ($search_keyword=null) {
        return Inertia::render('Dashboard/SentMessages', [
            'sentMessages'=>SentMessage::search($search_keyword)->where('sender_public_code',MailCodeService::fetchPublicCode(Auth::id()) )->get(), 
            'publicCode'=>MailCodeService::fetchPublicCode(Auth::id()),
            'searchKeyword'=>$search_keyword,
        ]);
    })->name('SentMessages');
    Route::get('/draft-messages/{search_keyword?}', function ($search_keyword=null) {
        return Inertia::render('Dashboard/DraftMessages', [
            'draftMessageList'=>DraftMessage::search($search_keyword)->where('sender_public_code',MailCodeService::fetchPublicCode(Auth::id()))->get(),
            'publicCode'=>MailCodeService::fetchPublicCode(Auth::id()),
            'searchKeyword'=>$search_keyword,
        ]);
    })->name('DraftMessages');
    Route::get('/trashed-messages/{search_keyword?}', function ($search_keyword=null) {
        return Inertia::render('Dashboard/TrashedMessages', [
            'trashedReceivedMessageList'=>MyMessage::search($search_keyword)->onlyTrashed()->where('receiver_public_code',MailCodeService::fetchPublicCode(Auth::id()) )->get(), 
            'trashedSentMessageList'=>SentMessage::search($search_keyword)->onlyTrashed()->where('sender_public_code',MailCodeService::fetchPublicCode(Auth::id()) )->get(), 
            'publicCode'=>MailCodeService::fetchPublicCode(Auth::id()),
            'searchKeyword'=>$search_keyword,
        ]);
    })->name('TrashedMessages');
    /*Route::get('/my-messages/{msg_id}', function ($msg_id) {
        return Inertia::render('Dashboard/SpecificMessage', [
            'specificMessage'=>MyMessage::withTrashed()->where('id', '=', $msg_id )->where('receiver_public_code', '=',MailCodeService::fetchPublicCode(Auth::id()) )->get(), 
            'msgId'=>$msg_id
        ]);
    })->name('SpecificMessage');*/


    Route::get('/contact-list', function () {
        $contact_list = ContactStore::firstOrCreate(
            ['user_id' => Auth::id()],
            ['contact_list' => []]
        );
        return Inertia::render('Dashboard/ContactList', [
            'publicCode'=>MailCodeService::fetchPublicCode(Auth::id()),
            'contactList'=>$contact_list->contact_list
        ]);
    })->name('ContactList');

    /*Route::get('/edit-contact/{case_code}', function ($case_code) {
        $contact_list = ContactStore::firstOrCreate(
            ['user_id' => Auth::id()],
            ['contact_list' => []]
        );
        //return ($contact_list->contact_list)[$case_code];
        return Inertia::render('Dashboard/EditContact', [
            'caseCode'=>$case_code,
        ]);
    })->name('EditContact');*/

    Route::post('/new-private-code', [MailCodeController::class, 'new'])->name('NewPrivateCode');
    Route::post('/delete-private-code', [MailCodeController::class, 'delete'])->name('DeletePrivateCode');
    Route::post('/restore-private-code', [MailCodeController::class, 'restore'])->name('RestorePrivateCode');
    Route::post('/amend-private-code-info/{privateCode}', [MailCodeController::class, 'amendInfo'])->name('AmendPrivateCodeInfo');
    Route::post('/permanently-delete-private-code/{privateCode}', [MailCodeController::class, 'permanentlyDelete'])->name('PermanentlyDelete');
    
    
    
    
    
    Route::post('/send-message/{event_id}', [MessageController::class, 'send'])->name('SendMessage');

    Route::post('/view-an-received-message/{msg_id}', [MessageController::class, 'viewAnReceivedMessage'])->name('viewAnReceivedMessage');
    Route::post('/mark-as-read/{msg_id}', [MessageController::class, 'markAsRead'])->name('markAsRead');
    Route::post('/trash-received-message/{msg_id}', [MessageController::class, 'trashReceivedMessage'])->name('trashReceivedMessage');
    Route::post('/restore-received-message/{msg_id}', [MessageController::class, 'restoreReceivedMessage'])->name('restoreReceivedMessage');
    Route::post('/permenently-delete-received-message/{msg_id}', [MessageController::class, 'permanentlyDeleteReceivedMessage'])->name('permanentlyDeleteReceivedMessage');


    Route::post('/view-a-sent-message/{msg_id}', [MessageController::class, 'viewASentMessage'])->name('viewASentMessage');
    Route::post('/trash-sent-message/{msg_id}', [MessageController::class, 'trashSentMessage'])->name('trashSentMessage');
    Route::post('/restore-sent-message/{msg_id}', [MessageController::class, 'restoreSentMessage'])->name('restoreSentMessage');
    Route::post('/permenently-delete-sent-message/{msg_id}', [MessageController::class, 'permanentlyDeleteSentMessage'])->name('permanentlyDeleteSentMessage');

    Route::post('/view-draft-message/{event_id}',[MessageController::class, 'viewDraftMessage'])->name('viewDraftMessage');
    Route::post('/update-draft-message/{event_id}',[MessageController::class, 'updateDraftMessage'])->name('updateDraftMessage');
    Route::post('/erase-draft-message/{event_id}',[MessageController::class, 'eraseDraftMessage'])->name('eraseDraftMessage');

    Route::post('/new-contact/{case_code}', [ContactController::class, 'new'])->name('NewContact');

    Route::post('/fetch-contact/{case_code?}', [ContactController::class, 'fetchContact'])->name('FetchContact');
    Route::post('/update-contact/{case_code}', [ContactController::class, 'updateContact'])->name('UpdateSpecificContact');
    Route::post('/delete-contact/{case_code}', [ContactController::class, 'deleteContact'])->name('DeleteSpecificContact');


});
