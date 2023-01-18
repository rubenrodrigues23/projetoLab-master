<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\User;
use Stripe\ApiOperations\All;

class ChatsController extends Controller
{
    private $currentUser;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logged_user = Auth::user()->getAuthIdentifier();//id user logado

        //SELECT * FROM messages WHERE participant1_id = 1
        $messages = Message::where('participant1_id', $logged_user)->with('user')->get();
        dump($messages);
        $uniqueUsers = [];

        foreach ($messages as $message) {
            $this->currentUser = $message->participant2_id;
            if (!in_array($message->participant1_id->name, $uniqueUsers)) {
                array_push($uniqueUsers, $message->participant1_id->name);
            }
        }

        return view('chat', ['messages' => $messages, 'uniqueUsers' => $uniqueUsers, 'currentUser' => $this->currentUser]);
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        //return Message::with('user')->get();
        return view('chat');
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        // $user = Auth::user();

        // $message = $user->messages()->create(['message' => $request->input('message')
        // ]);

        // broadcast(new MessageSent($user, $message))->toOthers();

        // return ['status' => 'Message Sent!'];

        // $user = Auth::user();
        // $message = $user->messages()->create([
        //     'message' => $request->input('message'),
        //     'first_team_id' => request('team1'),
        //     'second_team_id' => request('team1')
        // ]);
    }
    public function changeCurrentUser(Request $request)
    {
        $this->currentUser = $request->input('uniqueUser');
        //$this->currentUser->changeCurrentUser($request->input('uniqueUser'));
        //$this->currentUser = $request->user()->name;
    }
}
