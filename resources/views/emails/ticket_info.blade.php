<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tech IT Ticket Information</title>
</head>
<body>
  <p>
    Thank you {{ ucfirst($user->name) }} for submitting a Techit Ticket.
  </p>

  <p>Title: {{ $ticket->title }}</p>
  <p>Priority: {{ $ticket->priority }}</p>
  <p>Status: {{ $ticket->status }}</p>

  <p>
    You can view the ticket at any time at {{ url('tickets/' . $ticket->ticket_id)}}
  </p>

</body>
</html>
