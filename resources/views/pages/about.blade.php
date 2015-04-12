@extends('app')

@section('content')
<h1>About</h1>

@if(count($people))
<h3>People I Like:</h3>
<ul>
	@foreach($people as $person)
		<li>{{ $person }}</li>
	@endforeach
</ul>
@endif

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem perferendis, labore ipsum modi recusandae impedit, doloribus nostrum minima tempore accusamus sequi omnis saepe molestias vel unde, obcaecati quam illum consectetur.</p>
@stop