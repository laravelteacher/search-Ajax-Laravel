<div id='clear'>

@extends('layouts.ap')

@section('content')
  

  <div class="container">

<h1>



@foreach($search as $member)
		<li>
	
		<a data-id="{{ $member->id }}" class="btn btn-primary btnEdi"> {{ $member->mode }}{{ $member->type }} {{ $member->amount }}</a>
		</li>
        <a data-id="" class="btn btn-primary butto">Home</a>
	@endforeach
</h1>

<script>

$('.butto').click(function(){
	//var date = $(this).attr("data-id");
	//var date = $(this).attr('value');
	$('#clear').hide()
$.ajax({
	url: "<?php echo url('/paginatio'); ?>",
	// data: {
    //         date: date
    //     },
    type: "GET", 
    success: function(data){
      $data = $(data); 
	  $('#clear').hide().html($data).fadeIn(); 
	  //$('h1').hide();
      }
  });
});

//------------------------

</script>
</div>
@endsection

</div>