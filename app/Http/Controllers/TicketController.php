<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ticket;
use App\Http\Resources\Ticket as TicketResource;
use App\Events\TicketUpdate;

class TicketController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $tickets = Ticket::with('to')->with('user')->orderBy('updated_at', 'desc')->paginate(5);

//        dd($tickets);
        return TicketResource::collection($tickets);
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id)->with('user');

        return new TicketResource($ticket);
    }

    public function store(Request $request)
    {
        $ticket = $request->isMethod('put') ? Ticket::findOrFail($request->ticket_id) : new Ticket;

        $ticket->id = $request->input('ticket_id');
        $ticket->to = $request->input('to');
        $ticket->from = $request->input('from');
        $ticket->company = $request->input('company');
        $ticket->phone = $request->input('phone');
        $ticket->email = $request->input('email');
        $ticket->order_no = $request->input('order_no');
        $ticket->acct_no = $request->input('acct_no');
        $ticket->user_id = $request->input('user_id');
        $ticket->type = $request->input('type');
        $ticket->message = $request->input('message');
        $ticket->status = $request->input('status');
        $ticket->notes = $request->input('notes');

        if ($ticket->save()) {
            TicketUpdate::dispatch($ticket);

            return new TicketResource($ticket);
        }
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->delete()) {
            TicketUpdate::dispatch($ticket);

            return new TicketResource($ticket);
        }
    }
}
