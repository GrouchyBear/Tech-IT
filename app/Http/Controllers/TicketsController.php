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
        'ticket_id' => strtoupper(str_random(10)),
        'category_id' => $request->input('category'),
        'priority'    => $request->input('message'),
        'status'      => "Open",
      ]);

      $ticket->save();

      $mailer->sendTicketInformation(Auth::user(), $ticket);

      return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened");
    }
}
