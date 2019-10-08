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
                    'name' => encrypt($request['name'])
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
        if (!$conversation->users->contains(Auth::user())) {
            return redirect()->route('conversation.list');
        }
        $messages = $conversation->messages;
        $colors = Color::all();
        return view('conversation.conversation', [
            'conversation' => $conversation,
            'messages' => $messages,
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
            'message' => encrypt($request['message']),
            'user_id' => Auth::user()->id,
            'conversation_id' => $id,
            'color_id' => $request['color_id']
        ]);

        return redirect()->route('conversation.findConversationById', [
            'id' => $id
        ]);
    }

    public function updateMessage(Request $request, $message_id)
    {

        $message = Message::find($message_id);

        // This method is called when a message is dragged or resize,
        // when the user drags the message towards the bin, the dragged event is called.
        // If the user drops it in the bin, this method will be called, but the message will be
        // deleted before we can update it. This condition is a way of checking that the message still exists
        if ($message !== null) {
            $updateMessage = Message::find($message_id)->update([
                'left' => $request['left'],
                'top' => $request['top'],
                'width' => $request['width'],
                'height' => $request['height'],
                'zIndex' => $request['zIndex']
            ]);
        } else {
            $updateMessage = true;
        }


        if ($updateMessage) {
            return response()->json([
                'status' => 200,
                'message' => $updateMessage
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => $updateMessage
            ]);
        }
    }

    public function deleteMessage(Request $request)
    {

        return response()->json([
            'status' => 200,
            'content' => $request['id']
        ]);
        $deleteMessage = Message::destroy($request['id']);

        if ($deleteMessage) {
            return response()->json([
                'status' => 200
            ]);
        } else {
            return response()->json([
                'status' => 500
            ]);
        }
    }
}
