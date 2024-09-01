<?php include "header.php"; ?>
<?php include "sidebar.php"; 
include("../z_db");

?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
 <div class="page-content">
       <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Bookings</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All</a></li>
                                <li class="breadcrumb-item active">Bookings</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Bookings List</h5>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Destination</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                

                                    // Fetch data from bookings table
                                    $q = "SELECT id, name, email, date, destination, message FROM bookings ORDER BY id DESC";
                                    $result = mysqli_query($con, $q);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $email = $row['email'];
                                            $date = $row['date'];
                                            $destination = $row['destination'];
                                            $message = $row['message'];

                                            echo "<tr>
                                                    <td>$id</td>
                                                    <td>$name</td>
                                                    <td>$email</td>
                                                    <td>$date</td>
                                                    <td>$destination</td>
                                                    <td>$message</td>
                                                    <td>
                                                        <div class='dropdown d-inline-block'>
                                                            <button class='btn btn-soft-secondary btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                <i class='ri-more-fill align-middle'></i>
                                                            </button>
                                                            <ul class='dropdown-menu dropdown-menu-end'>
                                                                <li><a href='editport.php?id=$id' class='dropdown-item edit-item-btn'><i class='ri-pencil-fill align-bottom me-2 text-muted'></i> Edit</a></li>
                                                                <li><a href='deleteport.php?id=$id' class='dropdown-item remove-item-btn'><i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No bookings found</td></tr>";
                                    }

                                    mysqli_close($con);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

<?php include "footer.php"; ?>
