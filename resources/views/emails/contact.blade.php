@extends('emails.layout')
@section('content')

 <p style="float:left; width:100%; font-size:16px; color:#000;"><strong style="font-weight:bold;"> Thank you for Contect to <a href="{{url('/')}}"> Heyasia </a>.</strong></p>

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td>Name:</td><td>{{$data['name']}} </td></tr>
<tr><td>Email:</td><td>{{$data['email']}} </td></tr>
<tr><td>Subject:</td><td>{{$data['subject']}} </td></tr>
<tr><td>Message:</td><td>{{$data['message']}} </td></tr>
</table> 

@endsection