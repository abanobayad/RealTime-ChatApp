<?php
//this class not working
namespace App\Http\Controllers;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $messages =  Message::with('user')->get();
        return view('messages' );
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::id());
        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);


        //Broadcasting
        $b = broadcast(new MessageSentEvent($message, "3 min ago" ,$user))->toOthers();
        // dd($b);
        return [
            'message' => $message,
            'time' => "3",
            'user' => $user,
        ];
    }
}
