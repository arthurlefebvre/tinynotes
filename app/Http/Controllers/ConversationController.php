<?php

namespace App\Http\Controllers;

use App\Color;
use App\Conversation;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class ConversationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view('conversation.index');
    }

    public function create(Request $request)
    {
        if ($request['name'] === null) {

            return response()->json([
                'status' => 403,
            ]);
        } else {

            $conversation = Conversation::create(
                [
                    'name' => $request['name']
                ]
            );

            $conversation->users()->sync([
                $request['userId'], Auth::user()->id
            ]);

            return response()->json([
                'status' => 200,
                'id' => $conversation->id
            ]);
        }
    }

    public function findConversationById($id)
    {
        $conversation = Conversation::find($id);
        $lastMessage = $conversation->messages->last();
        $colors = Color::all();
        return view('conversation.conversation', [
            'conversation' => $conversation,
            'message' => $lastMessage,
            'colors' => $colors
        ]);
    }

    public function list()
    {
        $conversations = Auth()->user()->conversations;

        return view('conversation.list', [
            'conversations' => $conversations
        ]);
    }

    public function findUserByEmail(Request $request)
    {

        $user = User::findUserByEmail($request['email']);

        return view('conversation.partials.users_table', [
            'user' => $user
        ]);
    }

    public function addMessage(Request $request, $id)
    {
        $message = Message::create([
            'message' => $request['message'],
            'user_id' => Auth::user()->id,
            'conversation_id' => $id,
            'color_id' => $request['color_id']
        ]);

        return redirect()->route('conversation.findConversationById', [
            'id' => $id
        ]);
    }
}
