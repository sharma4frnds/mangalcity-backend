@extends('emails.layout')
@section('content')

 <p style="float:left; width:100%; font-size:16px; color:#000;"><strong style="font-weight:bold;"> Thank you for using <a href="{{url('/')}}"> Heyasia </a>to make a reservation.</strong></p>
<p>Here is a copy of your reservation for your reference.</p>
<table width="100%" cellpadding="0" cellspacing="0">

<tr><td>Property Name:</td><td>{{$property_name}} </td></tr>
<tr><td>Name:</td><td>{{$name}} </td></tr>
<tr><td>Email:</td><td>{{$email}} </td></tr>
<tr><td>Phone:</td><td>{{$phone}} </td></tr>
<tr><td>Date:</td><td>{{$date}} </td></tr>
<tr><td>Time:</td><td>{{$time}} </td></tr>
<tr><td>Message:</td><td>{{$message1}} </td></tr>
</table>

@endsection