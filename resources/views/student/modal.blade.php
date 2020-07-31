@extends('layouts.mod')
@section('content')

<h2>Modal Example</h2>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>


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
    <table class="table table-bordered" id="studentTable">
		<thead>
			<tr>
				<th>id</th>
				<th>First Name</th>
				<th>email</th>
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
        @foreach ($students as $student)
            <tr id="{{ $student->id }}">
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
				<td>{{ $student->email }}</td>
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!-- Student Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Student</h4>
      </div>
	  <div class="modal-body">
		<form id="addStudent" name="addStudent" action="{{ URL::to('studenta') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="txtFirstName">First Name:</label>
				<input type="text" class="form-control" id="name" placeholder="Name" name="name">
			</div>
			<div class="form-group">
				<label for="txtLastName">email:</label>
				<input type="email" class="form-control" id="email" placeholder="email" name="email">
			</div>
			<div class="form-group">
				<label for="txtAddress">type:</label>
				<input type="text" class="form-control" id="type" name="type" rows="10" placeholder="type">
			</div>
			<div class="form-group">
				<label for="txtAddress">amount:</label>
				<input type="number" class="form-control" id="amount" name="amount" rows="10" placeholder="amount">
			</div>
			<div class="form-group">
				<label for="txtAddress">category:</label>
				<input type="text" class="form-control" id="category" name="category" rows="10" placeholder="category">
			</div>
			<div class="form-group">
				<label for="txtAddress">mode:</label>
				<input type="text" class="form-control" id="mode" name="mode" rows="10" placeholder="mode">
			</div>
			<div class="form-group">
				<label for="txtAddress">note:</label>
				<input type="text" class="form-control" id="note" name="note" rows="10" placeholder="note">
			</div>
			<div class="form-group">
				<label for="txtAddress">date:</label>
				<input type="date" class="form-control" id="date" name="date" rows="10" placeholder="date">
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
<script>
  $(document).ready(function () {
	
// Click to Show modal of Add New Data
    $('#add').click(function(){
				$('#addModal').modal('show');
			});

	//Add the Student  txtAddress
	$("#addStudent").validate({
		 rules: {
			name: "required",  
				email: "required"
			},
			messages: {
			},
 
		 submitHandler: function(form) {
		  var form_action = $("#addStudent").attr("action");
		  $.ajax({
			  data: $('#addStudent').serialize(),
			  url: form_action,
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  var student = '<tr id="'+data.id+'">';
				  student += '<td>' + data.id + '</td>';
				  student += '<td>' + data.name + '</td>';
				  student += '<td>' + data.email + '</td>';
				  student += '<td>' + data.type + '</td>';
				  student += '<td>' + data.amount + '</td>';
				  student += '<td>' + data.category + '</td>';
				  student += '<td>' + data.mode + '</td>';
				  student += '<td>' + data.note + '</td>';
				  student += '<td>' + data.date + '</td>';
				  student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
				  student += '</tr>';            
				  $('#studentTable tbody').prepend(student);
				  $('#addStudent')[0].reset();
				  $('#addModal').modal('hide');
			  },
			  error: function (data) {
			  }
		  });
		}
	});
  
 
    //When click edit student
    $('body').on('click', '.btnEdit', function () {
      var student_id = $(this).attr('data-id');
      $.get('student/' + student_id +'/edit', function (data) {
          $('#updateModal').modal('show');
		  $('#updateStudent #hdnStudentId').val(data.id);
          $('#updateStudent #name').val(data.name);
          $('#updateStudent #email').val(data.email);
          $('#updateStudent #type').val(data.type);
		  $('#updateStudent #amount').val(data.amount); 
          $('#updateStudent #category').val(data.category);
          $('#updateStudent #mode').val(data.mode);
          $('#updateStudent #note').val(data.note);
		  $('#updateStudent #date').val(data.date);
      })
   });
    // Update the student
	$("#updateStudent").validate({
		//  rules: {
		// 		txtFirstName: "required",
		// 		txtLastName: "required",
		// 		txtAddress: "required"
				
		// 	},
			messages: {
			},
 
		 submitHandler: function(form) {
		  var form_action = $("#updateStudent").attr("action");
		  $.ajax({
			  data: $('#updateStudent').serialize(),
			  url: form_action,
			  type: "POST",
			  dataType: 'json',
			  success: function (data) {
				  var student = '<td>' + data.id + '</td>';
				  student += '<td>' + data.name + '</td>';
				  student += '<td>' + data.email + '</td>';
				  student += '<td>' + data.type + '</td>';
				  student += '<td>' + data.amount + '</td>';
				  student += '<td>' + data.category + '</td>';
				  student += '<td>' + data.mode + '</td>';
				  student += '<td>' + data.note + '</td>';
				  student += '<td>' + data.date + '</td>';
				  student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
				  $('#studentTable tbody #'+ data.id).html(student);
				  $('#updateStudent')[0].reset();
				  $('#updateModal').modal('hide');
			  },
			  error: function (data) {
			  }
		  });
		}
	});		
		
   //delete student
	$('body').on('click', '.btnDelete', function () {
      var student_id = $(this).attr('data-id');
      $.get('student/' + student_id +'/delete', function (data) {
          $('#studentTable tbody #'+ student_id).remove();
      })
   });	
	
  
});	 


</script>

@endsection
