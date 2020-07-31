<div id='clear'>
@extends('layouts.ap')

@section('content')
  

  <div class="container">
   <h3 align="center">Laravel Pagination using Ajax</h3><br />
   
   <div id="table_data">
    @include('student.pagination_data')
   </div>
  </div>
 
<script>
$(document).ready(function(){
    var loading = false; 

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  if (loading){
     return;
    }
     var page = $(this).attr('href').split('page=')[1];
     fetch_data(page);
   });

 function fetch_data(page)
   {
    loading = true;
  $.ajax({
   url:"/pagination/fetch_data?page="+page,
   success:function(data)
         {
    loading = false;
    $('#table_data').html(data);
         }
    });
   }
 
});
</script>
@endsection

