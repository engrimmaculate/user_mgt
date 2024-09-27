$(document).ready(function() {
    
    // make request to the user api to get the list of  all registered users
    showAllUsers()
    function showAllUsers(){
      $.ajax({
      url: 'http://localhost/php_job_test/controllers/controller.php',
      type: 'POST',
      data:{action:"view"},

      success: function(response) {
        // console.log(response.data);
        $('#showUser').html(response);
        
        $('#usersTable').DataTable({
          order:[0,'dsc'],
          columnDefs: [
            { targets: [0], visible: true }
          ],
        });
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
    }
    
    // insert a new user into the database
    $('#addUserBtn').click(function(e){
      if($('#addUserForm')[0].checkValidity()){
        e.preventDefault();
        $.ajax({
          url: 'http://localhost/php_job_test/controllers/controller.php',
          type: 'POST',
          data: $('#addUserForm').serialize()+"&action=insert",
          success: function(response) {
            // console.log(response);
            Swal.fire({
              position: 'top-end',
              icon:'success',
              title: 'User added successfully!',
              showConfirmButton: false,
              timer: 1500
            });
            $('#addUserForm')[0].reset();
            $('#addUserModal').modal('hide');
            showAllUsers();
          },
          error: function(xhr, status, error) {
            console.log(error);
          }
        });
  
    }
    });
  

    // edit user details
    $("body").on('click', '.editBtn', function(e){
      e.preventDefault();
      var edit_id = $(this).attr('id');
      
      $('#editUserModal').modal('show');
      $('#id').val(id);
      $('#fullName').val(fullName);
      $('#email').val(email);
      $('#phone').val(phone);

      $.ajax({
        url: 'http://localhost/php_job_test/controllers/controller.php',
        type: 'POST',
        data: {edit_id:edit_id},
        success: function(response) {
          data = JSON.parse(response);
          
        $('#id').val(data.id);
        $('#fullname').val(data.fullname);
        $('#Email').val(data.email);
        $('#Phone').val(data.phone);
        },
        error: function(xhr, status, error) {
          console.log(error);
        }

      });
    });

    // update User details
    $('#update').click(function(e){
      if($('#editUserForm')[0].checkValidity()) { 
      e.preventDefault();
      console.log($('#editUserForm').serialize());
      $.ajax({
        url: 'http://localhost/php_job_test/controllers/controller.php',
        type: 'POST',
        data: $('#editUserForm').serialize()+"&action=updateUser",
        success: function(response) {
          console.log(response);
          Swal.fire({
            title: 'Success',
            text: 'User updated successfully',
            icon:'success',
            confirmButtonText: 'Ok',
            timer: 1500
          });
          $('#editUserModal').modal('hide');
          $('#editUserForm')[0].reset();
            showAllUsers();
        },
        error: function(xhr, status, error) {
          console.log(error);
          Swal.fire({
            title: 'Error',
            text: 'Something went wrong',
            icon: 'error',
            confirmButtonText: 'Ok'
          });
        }
      });
    }
    });
        
    
   
  
  // delete user
  $(document).on('click', '.deleteBtn', function(e){
    e.preventDefault();
    var tr = $(this).closest('tr');
    var del_id = $(this).attr('id');
    console.log(del_id);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'http://localhost/php_job_test/controllers/controller.php',
          type: 'POST',
          data: {del_id:del_id, action:"delete"},
          success: function(response) {
            // console.log(response);
            
            Swal.fire(
              'Deleted!',
              'User has been deleted Successfully.',
             'success',
             15000
            );
            tr.css('background-color', '#ff6666');
            setTimeout(function(){
              
              tr.remove();
            }, 15000);

            showAllUsers();
          },
          error: function(xhr, status, error) {
            console.log(error);
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'Something went wrong',
              showConfirmButton: false,
              timer: 1500
            });
          }
        });
    }
  });
  
  });

  // View User Details
  $(document).on('click', '.infoBtn', function(e){
    e.preventDefault();
    view_id = $(this).attr('id');
    $.ajax({
      url: 'http://localhost/php_job_test/controllers/controller.php',
      type: 'POST',
      data: {view_id:view_id, action:"viewUser"},
      success: function(response) {
        var data = JSON.parse(response);
        Swal.fire({
          title: 'User Details !',
          type: 'info',
          icon: 'success',
          html: '<div class="row">'+
                    '<div class="col-md-12">'+
                    '<label for="fullName"><strong>User ID:</strong> </label>'+
                    '<span id="viewFullName">'+data.id+'</span>'+
                    '</div>'+
                  '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-12">'+
                      '<label for="fullName"><strong>Full Name:</strong> </label>'+
                      '<span id="viewFullName">'+data.fullname+'</span>'+
                      '</div>'+
                      '</div>'+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    '<label for="email"><strong>Email:</strong> </label>'+
                    '<span id="viewEmail">'+data.email+'</span>'+
                    '</div>'+
                    '</div>'+
                    '<div class="row">'+
                    '<div class="col-md-12">'+
                    '<label for="phone"><strong>Phone:</strong> </label>'+
                    '<span id="viewPhone">'+data.phone+'</span>'+
                    '</div>'+
                  '</div>',
          showCancelButton: true,
          confirmButtonText: 'Close'
        });
        
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });
  // end jquery ajax dom ready function
});