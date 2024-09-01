<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

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
                        <h4 class="mb-sm-0">Packages</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All</a></li>
                                <li class="breadcrumb-item active">Packages</li>
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
                            <h5 class="card-title mb-0">Packages List</h5>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Package Title</th>
                                        <th>Package Detail</th>
                                        <th>Updated At</th>
                                      
                                        <th>Number of Days</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     include("../z_db.php");

                                    // Fetch data from package table
                                    $q = "SELECT id, package_title, package_detail, updated_at, place_id, destination_id, no_days, price FROM package ORDER BY id DESC";
                                    $result = mysqli_query($con, $q);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $package_title = $row['package_title'];
                                            $package_detail = $row['package_detail'];
                                            $updated_at = $row['updated_at'];
                                            $place_id = $row['place_id'];
                                            $destination_id = $row['destination_id'];
                                            $no_days = $row['no_days'];
                                            $price = $row['price'];

                                            echo "<tr>
                                                    <td>$id</td>
                                                    <td>$package_title</td>
                                                    <td>$package_detail</td>
                                                    <td>$updated_at</td>
                                                 
                                                    <td>$no_days</td>
                                                    <td>$price</td>
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
                                        echo "<tr><td colspan='9'>No packages found</td></tr>";
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
