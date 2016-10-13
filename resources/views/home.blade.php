@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <p>You are logged in!</p>

                    @if (Auth::user()->is_admin)
                        <div class="row">
                          <div class="col-lg-3 col-md-6">
                            <div class="panel panel-success">
                              <div class="panel-heading">
                              <div class="row">
                                <div class="col-xs-3">
                                  <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9">
                                  <div class="huge">7</div>
                                  <div>Completed tasks</div>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @else
                        <p>
                            See all your <a href="{{ url('user_tickets') }}">tickets</a> or <a href="{{ url('new_ticket') }}">open new ticket</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
