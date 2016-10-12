<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function create()
    {
      $categories = Category::all();

      return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'title'       => 'required',
        'category'    => 'required',
        'priority'    => 'required',
        'message'     => 'required'
      ]);

      $ticket = new Ticket([
        'title'       => $request->input('title'),
        'user_id'     => Auth::user()->id,
        'ticket_id'   => strtoupper(str_random(10)),
        'category_id' => $request->input('category'),
        'priority'    => $request->input('priority'),
        'message'     => $request->input('message'),
        'status'      => "Open",
      ]);

      $ticket->save();

      return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened");
    }

    public function userTickets()
   {
       $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
       $categories = Category::all();
       return view('tickets.user_tickets', compact('tickets', 'categories'));
   }

   public function show($ticket_id)
   {
     $ticket = Ticket::where('ticket_id', $ticket_id)->firstorFail();

     $comments = $ticket->comments;

     $category = $ticket->category;

     return view('tickets.show', compact('ticket', 'category', 'comments'));
   }

}
