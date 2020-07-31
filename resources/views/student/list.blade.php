
@extends('layouts.ap')
@section('content')

<div id=''>
<div class="row">
        <div class="col-lg-11">
                <h2>Laravel 7 Ajax CRUD Example</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-success" id="add" href="#">Add</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
	<div class="table-responsive">
    <table class="table table-bordered" id="studentTable">
		<thead>
			<tr>
				
				<th>type</th>
				<th>amount</th>
				<th>category</th>
				<th>mode</th>
				<th>note</th>
				<th>date</th>
				<th width="280px">Action</th>  
			</tr>
		</thead>	
		<tbody>

		<!-- This is to Show All Data from Table  -->
        @foreach ($students as $student)
            <tr id="{{ $student->id }}">
             
				<td>{{ $student->type }}</td>
                <td>{{ $student->amount }}</td>
				<td>{{ $student->category }}</td>
				<td>{{ $student->mode }}</td>
                <td>{{ $student->note }}</td>
				<td>{{ $student->date }}</td>
                <td>  
		     <a data-id="{{ $student->id }}" class="btn btn-primary btnEdit">Edit</a>
		     <a data-id="{{ $student->id }}" class="btn btn-danger btnDelete">Delete</button>
                </td>
            </tr>
        @endforeach
		</tbody>
    </table>
	<!-- This button is to change Page -->
	<input type="button" id='bn' value='Go'>
<!-- This is for Ajax -->
	<script>
	$('#bn').click(function(){
        $.ajax({
        url: '/ajax/GetContent',
        type: "GET", // not POST, laravel won't allow it
        success: function(data){
        $data = $(data); // the HTML content your controller has produced
        $('#clear').hide().html($data).show();    
      }
  });
});
	</script>
	{!! $students->render() !!} 
</div>


<!-- Add Student Modal -->
<div id="addModal" class="modal fade" role="dialog"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">

    <!-- Student Modal content-->
    <div class="modal-content">
      
	  <div class="modal-body">
		<form id="addStudent" name="addStudent" action="{{ URL::to('studenta') }}" method="post">
			@csrf
			<div class="form-group row">
				<label for="txtFirstName" class="col-sm-3 col-form-label">First Name:</label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name" value='{{ Auth::user()->name }}'>
				</div>
			</div>
			<div class="form-group row">
			    
                <label for="txtLastName" class="col-sm-3 col-form-label">email:</label>
		        <div class="col-sm-9">

		           <input type="email" class="form-control" id="email" placeholder="email" name="email" value='{{ Auth::user()->email }}'>
				 </div>
			

			</div>
			<div class="form-group row">
               <label for="exampleFormControlSelect1" class="col-sm-3">type:</label>
			   <div class="col-sm-9">

                    <select class="form-control" id="type" name="type">
                      <option>Income</option>
                      <option>Expend</option>
                    </select>
				</div>

            </div>
			<div class="form-group row">
				<label for="txtAddress" class="col-sm-3 col-form-label">amount:</label>
				<div class="col-sm-9">
				  <input type="number" class="form-control" id="amount" name="amount" rows="10" placeholder="amount">
				</div>
			</div>
			<div class="form-group row">
				<label for="txtAddress" class="col-sm-3 col-form-label">category:</label>
                <div class="col-sm-9">
				   <input type="text" class="form-control" id="category" name="category" rows="10" placeholder="category">
				</div>   
			</div>
			<div class="form-group row">
				<label for="txtAddress"  class="col-sm-3 col-form-label">mode:</label>
				<div class="col-sm-9">
				    <input type="text" class="form-control" id="mode" name="mode" rows="10" placeholder="mode">
				</div>	
			</div>
			<div class="form-group row">
				<label for="txtAddress"  class="col-sm-3 col-form-label">note:</label>
				<div class="col-sm-9">
				    <input type="text" class="form-control" id="note" name="note" rows="10" placeholder="note">
				</div>
			</div>
			<div class="form-group row">
				<label for="txtAddress"  class="col-sm-3 col-form-label">date:</label>
				<div class="col-sm-9">
				    <input type="date" class="form-control" id="date" name="date" rows="10" placeholder="date">
				</div>
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
<!-- Update Student Modal -->
<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Student Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Student</h4>
      </div>
	  <div class="modal-body">
		<form id="updateStudent" name="updateStudent" action="{{ route('student.update') }}" method="post">
			<input type="hidden" name="hdnStudentId" id="hdnStudentId"/>
			@csrf
			<div class="form-group row">
				<label for="txtFirstName" class="col-sm-3 col-form-label">First Name:</label>
				<div class="col-sm-9">
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name">
				</div>
			</div>
			<div class="form-group row">
			    
                <label for="txtLastName" class="col-sm-3 col-form-label">email:</label>
		        <div class="col-sm-9">

		           <input type="email" class="form-control" id="email" placeholder="email" name="email">
				 </div>
			

			</div>
			<div class="form-group row">
               <label for="exampleFormControlSelect1" class="col-sm-3">type:</label>
			   <div class="col-sm-9">

                    <select class="form-control" id="type" name="type">
                      <option>Income</option>
                      <option>Expend</option>
                    </select>
				</div>

            </div>
			<div class="form-group row">
				<label for="txtAddress" class="col-sm-3 col-form-label">amount:</label>
				<div class="col-sm-9">
				  <input type="number" class="form-control" id="amount" name="amount" rows="10" placeholder="amount">
				</div>
			</div>
			<div class="form-group row">
				<label for="txtAddress" class="col-sm-3 col-form-label">category:</label>
                <div class="col-sm-9">
				   <input type="text" class="form-control" id="category" name="category" rows="10" placeholder="category">
				</div>   
			</div>
			<div class="form-group row">
				<label for="txtAddress"  class="col-sm-3 col-form-label">mode:</label>
				<div class="col-sm-9">
				    <input type="text" class="form-control" id="mode" name="mode" rows="10" placeholder="mode">
				</div>	
			</div>
			<div class="form-group row">
				<label for="txtAddress"  class="col-sm-3 col-form-label">note:</label>
				<div class="col-sm-9">
				    <input type="text" class="form-control" id="note" name="note" rows="10" placeholder="note">
				</div>
			</div>
			<div class="form-group row">
				<label for="txtAddress"  class="col-sm-3 col-form-label">date:</label>
				<div class="col-sm-9">
				    <input type="text" class="form-control" id="date" name="date" rows="10" placeholder="date">
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	

</div>
<script type="text/javascript" src="/js/script.js?id=c9583f87faaae9d32ff9" ></script>

@endsection

