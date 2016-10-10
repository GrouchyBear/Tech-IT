<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

class TicketsController extends Controller
{
    public function create()
    {
      $categories = Category::all();

      return view('tickets.create', compact('categories'));
    }

    public function store(Request $request, AppMailer $mailer)
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
        'priority'    => $request->('message'),
        'status'      => "Open",
      ]);

      $ticket->save();

      $mailer->sendTicketInformation(Auth::user(), $ticket);

      return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened");
    }
}
