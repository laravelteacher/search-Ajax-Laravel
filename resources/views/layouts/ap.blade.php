<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel 7 Ajax CRUD Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{mix('css/app.css')}}" rel='stylesheet'> 
    <script type="text/javascript" src="{{ mix('js/app.js') }}" ></script>

<script type="text/javascript" src="{{ mix('js/validate.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/script.js') }}" ></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->

  
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<form class="navbar-form navbar-left" action="" method="POST">
		      		{{ csrf_field() }}
		        	<div class="input-group">
		          		<input type="text" id="search" name="search" class="form-control" placeholder="Search Member">
		          		<span class="input-group-btn">
	                  		<button type="submit" class="btn btn-default">
	                   		<span class="glyphicon glyphicon-search"></span>
	                   		</button>
	                	</span>
		        	</div>
		      	</form>
		    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>

                                
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


<div id="result" class="panel panel-default" style="width:400px; position:absolute; left:0; top:55px; z-index:1; display:none">
	<ul style="margin-top:10px; list-style-type:none;" id="memList">
		
	</ul>
</div>

    @yield('content')
    <script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('#search').keyup(function(){
			var search = $('#search').val();
			if(search==""){
				$("#memList").html("");
				$('#result').hide();
			}
			else{
				$.get("{{ URL::to('search') }}",{search:search}, function(data){
					$('#memList').empty().html(data);
					$('#result').show();
				})
			}
		});
	});
</script>



</body>
</html>