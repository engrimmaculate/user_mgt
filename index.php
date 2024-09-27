<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Crud App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link href="https://cdn.datatables.net/v/bs4/dt-2.1.7/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">E-Solution Technology</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">User Area</a>
      </li>
      <li class="nav-item"><a href="#" class="nav-link"><span class="fa  fa-user"></span> Sign Up</a></li>
        <li class="nav-item"><a href="#" class="nav-link"><span class="fa fa-lock"></span> Login</a></li>
    </ul>
  </div>
</nav> 
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h4 class="text-center mt-5 mb-5 text-danger font-weight-bold my-3 " >Php Mysql Ajax Crud Application</h4>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6 mt-2">
      <h4 class="mt-2 mb-2 ml-1 text-success font-weight-bold">All users in the Table</h4>
    </div>
    <div class="col-lg-6">
      <button class="btn btn-success float-right m-1" data-toggle="modal" data-target="#addUserModal"><i class="fa fa-user-plus fa-lg"></i> Add User</button>
      <a href="controller.php?export=excel" class="btn btn-primary float-right m-1"><i class="fa fa-file-excel-o fa-lg"></i> Excel</a>
      <a href="controller.php?export=pdf" class="btn btn-danger float-right m-1"><i class="fa fa-file-pdf-o fa-lg"></i> PDF</a>
    </div>
  </div>
  <hr class="m-1">
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive" id="showUser">
      
      </div>
    </div>
  </div>
</div>
<!-- Add New User Modal -->
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="" method="post" id="addUserForm">
            <div class="form-group">
              <label for="fullName">Full Name:</label>
              <input type="text" class="form-control" name="fullname" id="fullName" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="Email" id="email" placeholder="Enter Email">
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" class="form-control" name="Phone" id="phone" placeholder="Enter Phone">
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-danger" name="insert"  id="addUserBtn">Create New User</button>
            </div>
          </form>
        </div>
        
        </div>
    </div>
</div>

<!-- Edit  User Modal -->
<div class="modal fade" id="editUserModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit  User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="" method="post" id="editUserForm">
            <div class="form-group">
            <input type="hidden" class="form-control" id="id"  name="id" placeholder="Enter Full Name">
              <label for="fullName">Full Name:</label>
              <input type="text" class="form-control" name="fullName" id="fullname" placeholder="Enter Full Name">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" id="Email" placeholder="Enter Email">
            </div>
            <div class="form-group">
              <label for="phone">Phone:</label>
              <input type="text" class="form-control" name="phone" id="Phone" placeholder="Enter Phone">
            </div>
            <div class="form-group">
              <div classs="col-lg-12">
                <button type="button" class="btn btn-success lg-12" name="update"  id="update">Update User</button>
              </div>
            </div>
          </form>
        </div>
        
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/bs4/dt-2.1.7/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>