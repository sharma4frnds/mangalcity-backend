@extends('layouts.master')
@section('title','Mangalcity')

@section('content')
<section class="think-pnl post-pnl">
<div class="container">
  <div class="row">
  	<div class="text-center text-center">
  		<h1 class="error-number">403</h1>
  		<h4>The requested page is temporary unavailable. Please return to <a href="{{url('home')}}">Home</a></h4>
  	</div>
  </div>

</section>


<!-- End Remote popup -->
@endsection
@section('footer_script')
{{ Html::script('public/js/jquery.form.js') }}

@endsection