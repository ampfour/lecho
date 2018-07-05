<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Chat;
use App\Http\Resources\Chat as ChatResource;

class ChatController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $chats = Chat::with('to')->with('user')->orderBy('updated_at', 'desc')->paginate(5);

        // Get the currently authenticated user...
        $user = Auth::user();

        if (Auth::check()) {
            $id = Auth::id();
        } else {
            $id = 'Not logged in';
        }

        dd($id);
       // dd($chats);
       // return ChatResource::collection($chats);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
