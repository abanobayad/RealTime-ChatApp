<?php

use App\Events\MessageSentEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('App\Http\Controllers')->middleware('auth')->group(function (){
    Route::get('/chat', [App\Http\Controllers\HomeController::class, 'messages'])->name('messages');

    Route::post('/send-message' , function(Request $request){

        // dd($request->all());
        $user = User::find(Auth::id());
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);
        $e = event(new MessageSentEvent($request->message,Auth::user()->name , Auth::user()->id));
        // dd($e);
            return ['success' =>true];
    });
});


