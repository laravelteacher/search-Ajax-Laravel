$(document).ready(function () {  

	var loading = false;
    // Click to Show modal of Add New Data
        $('#add').click(function(){
                    $('#addModal').modal('show');
                });
    
        //Add the Student  
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
                    //   student += '<td>' + data.id + '</td>';
                    //   student += '<td>' + data.name + '</td>';
                    //   student += '<td>' + data.email + '</td>';
                      student += '<td>' + data.type + '</td>';
                      student += '<td>' + data.amount + '</td>';
                      student += '<td>' + data.category + '</td>';
                      student += '<td>' + data.mode + '</td>';
                      student += '<td>' + data.note + '</td>';
                      student += '<td>' + data.date + '</td>';
                      student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
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
      
         //Show view the Student  
         $("#viewStudent").validate({
            rules: {
               name: "required",  
                   email: "required"
               },
               messages: {
               },
    
            submitHandler: function(form) {
             var form_action = $("#viewStudent").attr("action");
             $.ajax({
                 data: $('#viewStudent').serialize(),
                 url: form_action,
                 type: "POST",
                 dataType: 'json',
                 success: function (data) {
                     
                 },
                 error: function (data) {
                 }
             });
           }
       });
     
        //When click edit student
        $('body').on('click', '.btnEdit', function () {
            if (loading){
                return;
               }
          var student_id = $(this).attr('data-id');
          $.get('student/' + student_id +'/edit', function (data) {
              loading = false;
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

       //When click edit student
       $('body').on('click', '.btnEdi', function () {
        if (loading){
            return;
           }
      var student_id = $(this).attr('data-id');
      $.get('student/' + student_id +'/showview', function (data) {
          loading = false;
          $('#showModal').modal('show');
          
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
                    // var student = '<tr id="'+data.id+'">';
                    //   student += '<td>' + data.name + '</td>';
                    //   student += '<td>' + data.email + '</td>';
                    var student = '<td>' + data.type + '</td>';
                      student += '<td>' + data.amount + '</td>';
                      student += '<td>' + data.category + '</td>';
                      student += '<td>' + data.mode + '</td>';
                      student += '<td>' + data.note + '</td>';
                      student += '<td>' + data.date + '</td>';
                      student += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
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
    
    
    //   Paginate Ajax

    // $(function () {
    //     var urll = 'images/Chrysanthemum.jpg';
    //     var image = new Image();
    //     var loading = false; 
    //     image.src = urll;
    //       $('body').on('click', '.pagination a', function (e) {
    //           e.preventDefault();
    //           if (loading){
    //               return;
    //           }
    //           // $('#load').append(image);
    //           var url = $(this).attr('href');
    //           window.history.pushState("", "", url);
    //           loadPosts(url);
    //       });
  
    //       function loadPosts(url) {
    //           loading = true;
    //           $.ajax({
    //               url: url
    //           }).done(function (data) {
    //               loading = false;
    //               $('.posts').html(data);
    //           }).fail(function () {
    //               loading = false;
    //               console.log("Failed to load data!");
    //           });
    //       }
    //   });

   


    

