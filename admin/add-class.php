<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else {
  // Code for Add New Teacher
  if (isset($_POST['submit'])) {
    //Getting Post Values  
    $tid = $_POST['teacher'];
    $cname = $_POST['classname'];
    $agegroup = $_POST['agegroup'];
    $classtiming = $_POST['classtiming'];
    $capacity = $_POST['capacity'];
    $addedby = $_SESSION['uname'];
    $profilepic = $_FILES["profilepic"]["name"];
    // get the image extension
    $extension = substr($profilepic, strlen($profilepic) - 4, strlen($profilepic));
    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
      //rename the image file
      $newprofilepic = md5($profilepic) . time() . $extension;
      // Code for move image into directory
      move_uploaded_file($_FILES["profilepic"]["tmp_name"], "classpic/" . $newprofilepic);





      $query = mysqli_query($con, "insert into tblclasses(teacherId,className,ageGroup,classTiming,capacity,feacturePic,addedBy) values('$tid','$cname','$agegroup','$classtiming','$capacity','$newprofilepic','$addedby')");
      if ($query) {
        echo "<script>alert('Class added successfully.');</script>";
        echo "<script type='text/javascript'> document.location = 'add-class.php'; </script>";
      } else {
        echo "<script>alert('Something went wrong. Please try again.');</script>";
      }
    }
  }

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aumenta Klase</title>

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <?php include_once("includes/navbar.php"); ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php include_once("includes/sidebar.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Aumenta Klase</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Aumenta Klase</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-8">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Personal Info</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form name="addlawyer" method="post" enctype="multipart/form-data">
                    <div class="card-body">

                      <!-- Teacher--->
                      <div class="form-group">
                        <label for="exampleInputFullname">Profesor</label>
                        <select class="form-control" id="teacher" name="teacher" required>
                          <option value="">Hili Profesore Sira</option>
                          <?php $query = mysqli_query($con, "select id,fullName,teacherSubject from tblteachers");
                          while ($row = mysqli_fetch_array($query)) {
                          ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['fullName']; ?>-(<?php echo $row['teacherSubject']; ?>)</option>
                          <?php } ?>

                        </select>
                      </div>
                      <!--   Class---->
                      <div class="form-group">
                        <label for="exampleInputEmail1">Naran Klase</label>
                        <input type="text" class="form-control" id="classname" name="classname" placeholder="Naran Klase e.g: Dezenu, Dansa, Komiku" required>
                      </div>
                      <!--Age Group---->
                      <div class="form-group">
                        <label for="text">Grupu Idade</label>
                        <select class="form-control" id="agegroup" name="agegroup" required>
                          <option value="">Hili Idade</option>
                          <option value="18 Fulan-2 Tinan">18 Fulan-2 Tinan</option>
                          <option value="2-3 Tinan">2-3 Tinan</option>
                          <option value="3-4 Tinan">3-4 Tinan</option>
                          <option value="4-5 Tinan">4-5 Tinan</option>
                          <option value="5-6 Tinan">5-6 Tinan</option>
                        </select>
                      </div>

                      <!--Time---->
                      <div class="form-group">
                        <label for="text">Tempu Klase</label>
                        <select class="form-control" id="classtiming" name="classtiming" required>
                          <option value="">Hili Oras</option>
                          <option value="08:00-09:00">08:00-09:00</option>
                          <option value="09:00-10:00">09:00-10:00</option>
                          <option value="10:00-11:00">10:00-11:00</option>
                          <option value="11:00-12:00">11:00-12:00</option>
                          <option value="12:00-13:00">12:00-13:00</option>
                          <option value="13:00-14:00">13:00-14:00</option>
                          <option value="14:00-15:00">14:00-15:00</option>
                          <option value="15:00-16:00">15:00-16:00</option>
                          <option value="16:00-17:00">16:00-17:00</option>
                        </select>
                      </div>

                      <!--Capacity---->
                      <div class="form-group">
                        <label for="text">Kapasidade</label>
                        <select class="form-control" id="capacity" name="capacity" required>
                          <option value="">Hili Kapasidade</option>
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="15">15</option>
                          <option value="20">20</option>
                          <option value="25">25</option>
                          <option value="30">30</option>
                          <option value="35">35</option>
                          <option value="40">40</option>
                          <option value="45">45</option>
                          <option value="50">50</option>
                        </select>
                      </div>
                      <!--Class Pic---->
                      <div class="form-group">
                        <label for="exampleInputFile">Imajen Klase <span style="font-size:12px;color:red;">(Only jpg / jpeg/ png /gif format allowed)</span></label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profilepic" name="profilepic" required="true">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                      </div>

                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
              </div>
              <!--/.col (left) -->
              </form>
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php include_once('includes/footer.php'); ?>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <script>
      $(function() {
        bsCustomFileInput.init();
      });
      $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
      });
    </script>
  </body>

  </html>
<?php } ?>