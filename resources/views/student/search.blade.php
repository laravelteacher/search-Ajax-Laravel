
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{mix('css/app.css')}}" rel='stylesheet'> 

<!-- There are some things you need to Ajax, Js -->
   <script type="text/javascript" src="{{ mix('js/app.js') }}" ></script>
   <script type="text/javascript" src="{{ mix('js/validate.js') }}"></script>
   <script type="text/javascript" src="{{ mix('js/script.js') }}" ></script>

</head>
<body>
    <div class='container'>
    
           
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
		    

<h1>

</h1>

            
<!-- this is a input to show data from search of table -->

<!-- this is hide untill we fill input -->
    <div id="result" class="panel panel-default" style="width:400px; position:absolute; left:0; top:55px; z-index:1; display:none">
	  <ul style="margin-top:10px; list-style-type:none;" id="memList">
		
	  </ul>
    </div>




<!-- this is script to Ajax and call data -->
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
                // when i fill input for search Ajax call data from this function
				$.get("{{ URL::to('sdch') }}",{search:search}, function(data){
					$('#memList').empty().html(data);
					$('#result').show();
				})
			}
		});
	});
</script>

    </div>
</body>
</html>

