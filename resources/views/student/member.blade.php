@extends('layouts.ap')

@section('content')
<div class="">
	<h2>{{ $member->type }}</h2>
	<h2>{{ $member->amount }}</h2>
	<h2>{{ $member->mode }}</h2>
	<h2>{{ $member->note }}</h2>
	<h2>{{ $member->date }}</h2>
	<a href="/pagination" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Home</a>

</div>

@endsection
