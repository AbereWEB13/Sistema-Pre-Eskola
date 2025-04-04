<?php session_start();
error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['aid']) == 0) {
  header('location:index.php');
} else {
  //Code For Deletion the teacher
  if ($_GET['action'] == 'delete') {
    $lid = intval($_GET['tid']);
    $profilepic = $_GET['profilepic'];
    $ppicpath = "teacherspic" . "/" . $profilepic;
    $query = mysqli_query($con, "delete from tblteachers where id='$lid'");
    if ($query) {
      unlink($ppicpath);
      echo "<script>alert('Detallu Professore Hamos tiha ona');</script>";
      echo "<script type='text/javascript'> document.location = 'manage-teachers.php'; </script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
  }


?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jere Profesores</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <?php include_once("includes/navbar.php"); ?>
      <!-- /.navbar -->

      <?php include_once("includes/sidebar.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Jere Profesor</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <li class="breadcrumb-item active">Jere Profesoress</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">


                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Detalu Profesor</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Imajen Perfil</th>
                            <th>Naran Kompletu</th>
                            <th>Email</th>
                            <th>Numeru Telemovel</th>
                            <th>Asuntu</th>
                            <th>Data Rejistu</th>
                            <th>Asaun</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $query = mysqli_query($con, "select * from tblteachers");
                          $cnt = 1;
                          while ($result = mysqli_fetch_array($query)) {
                          ?>

                            <tr>
                              <td><?php echo $cnt; ?></td>
                              <td><img src="teacherspic/<?php echo $result['teacherPic'] ?>" width="80"></td>
                              <td><?php echo $result['fullName'] ?></td>
                              <td><?php echo $result['teacherEmail'] ?></td>
                              <td><?php echo $result['teacherMobileNo'] ?></td>
                              <td><?php echo $result['teacherSubject'] ?></td>
                              <td><?php echo $result['regDate'] ?></td>
                              <th>
                                <a href="edit-teacher.php?tid=<?php echo $result['id']; ?>" title="Edit Sub Admin Details"> <i class="fa fa-edit" aria-hidden="true"></i> </a> |
                                <a href="manage-teachers.php?action=delete&&tid=<?php echo $result['id']; ?>&&profilepic=<?php echo $result['teacherPic']; ?>" style="color:red;" title="Delete this record" onclick="return confirm('Ita-boot hakarak duni atu hamos rejistu ida nee?');"><i class="fa fa-trash" aria-hidden="true"></i> </a>
                              </th>
                            </tr>
                          <?php $cnt++;
                          } ?>

                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <?php include_once('includes/footer.php'); ?>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
      $(function() {
        $("#example1").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
  </body>

  </html>
<?php } ?>