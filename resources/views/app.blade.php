<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Layout</title>
	{{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ elixir('css/all.css') }}"/>
    {{--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />--}}
</head>
<body>
	<div class="container">
        {{-- package name: view --}}
        @include('flash::message')
		@yield('content')
	</div>

    <script src="{{ elixir('js/all.js') }}"></script>
    {{--<script src="//code.jquery.com/jquery.js"></script>--}}
    {{--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}
    <script>
//        $('div.alert').not('.alert-important').delay(3000).slideUp(300);
        $('#flash-overlay-modal').modal();
    </script>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>--}}
	@yield('footer')
</body>
</html>