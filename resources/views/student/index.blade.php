@extends('layouts.ap')
@section('content')
<div class="container" style="max-width: 700px;">
    <div class="text-center" style="margin: 20px 0px 20px 0px;">
        <span class="text-secondary"><h2>Laravel <b>IMAGE</b> with jquery Ajax </h2></span>
    </div>

    <!-- <img src="images/amazing-animal-beautiful-beautifull.jpg" width='30%' />

    <img src={!!asset("images/Chrysanthemum.jpg")!!} width='30%' />

    <img src={{asset("images/Desert.jpg")}} width='30%' /> -->  


    
 @if (count($students) > 0)
        <section class="posts">
            @include('student.data')  
        </section>
    @else
        No data found :()
    @endif
</div>
<script type="text/javascript">
   $(function () {
        var urll = 'images/Chrysanthemum.jpg';
        var image = new Image();
        var loading = false; 
        image.src = urll;
          $('body').on('click', '.pagination a', function (e) {
              e.preventDefault();
              if (loading){
                  return;
              }
              // $('#load').append(image);
              var url = $(this).attr('href');
              window.history.pushState("", "", url);
              loadPosts(url);
          });
  
          function loadPosts(url) {
              loading = true;
              $.ajax({
                  url: url
              }).done(function (data) {
                  loading = false;
                  $('.posts').html(data);
              }).fail(function () {
                  loading = false;
                  console.log("Failed to load data!");
              });
          }
      });
</script>
@endsection
