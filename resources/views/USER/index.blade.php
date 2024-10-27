@extends('USER.layouts.navigation')

@section('content1')
<link rel="stylesheet" href="/css/user/dashboard.css">
<h1>DASHBOARD</h1>
<div class="sales">

    <div class="total-orders">
        <h1 style="margin: 10px 20px 0px; padding: 0;">{{$category}}</h1>
        <p style="margin: 5px 20px 0px; padding: 0;">Total Categories</p><br>
        <a href="{{route('categories.index')}}">View more</a>
    </div>
    <div class="total-customers">
        <h1 style="margin: 10px 20px 0px; padding: 0;">{{$event}}</h1>
        <p style="margin: 5px 20px 0px; padding: 0;">Total Events</p><br>
        <a href="{{route('events.index')}}">View more</a>
    </div>
    <div class="total-sales">
        <h1 style="margin: 10px 20px 0px; padding: 0;">{{$attendee}}</h1>
        <p style="margin: 5px 20px 0px; padding: 0;">Total Attendees</p><br>
        <a href="{{route('attendes.index')}}">View more</a>
    </div>
</div>

@endsection
