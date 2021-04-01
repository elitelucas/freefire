<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\SiteChat;
use Illuminate\Http\Request;
use Auth;

class ChatController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
   function index()
    {
        $chat = Chat::join('users', 'chats.chat_user_id', '=', 'users.id')
            ->select('chats.chat_content', 'chats.chat_created_date', 'users.name', 'users.avatar')
            ->orderBy('chats.chat_created_date', 'desc')
            ->take(100)
            ->get();
        $chat_status=SiteChat::all()[0]->chat_enable;
        return view('chat',['chat'=>$chat,'chat_status'=>$chat_status]);
    }
    function addChat(Request $request){
        $chat_val=$request->input('chat_val');
        Chat::insert([
            'chat_user_id'=>Auth::id(),
            'chat_content'=>htmlspecialchars($chat_val),
            'chat_created_date'=>date('Y:m:d h:i:s'),
            ]);
            $this->getChat();
    }
    function getChat(){
     $chat= Chat::join('users', 'chats.chat_user_id', '=', 'users.id')
    ->select('chats.chat_content', 'chats.chat_created_date', 'users.name','users.avatar')
    ->orderBy('chats.chat_created_date', 'desc')
    ->take(100)
    ->get();
        if(count($chat)>0)
        echo json_encode($chat);
    }
    function chatHistory(){
        $chat= Chat::join('users', 'chats.chat_user_id', '=', 'users.id')
    ->select('chats.chat_content', 'chats.chat_created_date', 'users.name','users.avatar')
    ->orderBy('chats.chat_created_date', 'desc')
    ->get();
    return view('chat-history',['chat'=>$chat]);
    }
}
