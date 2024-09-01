<?php include "header.php"; ?>
<?php include "sidebar.php"; ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Package</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Package</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> Add Package
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php
                        $status = "OK"; //initial status
                        $msg = "";
                        if (isset($_POST['save'])) {
                            $port_title = mysqli_real_escape_string($con, $_POST['port_title']);
                            $no_days = mysqli_real_escape_string($con, $_POST['no_days']);
                            $port_detail = mysqli_real_escape_string($con, $_POST['port_detail']);
                            $destination_id = mysqli_real_escape_string($con, $_POST['destination_id']);
                            $place_id = mysqli_real_escape_string($con, $_POST['place_id']);
                            $price = mysqli_real_escape_string($con, $_POST['price']);

                            $uploads_dir = 'uploads/package';
                            $tmp_name = $_FILES["ufile"]["tmp_name"];
                            $name = basename($_FILES["ufile"]["name"]);
                            $random_digit = rand(0000, 9999);
                            $new_file_name = $random_digit . $name;
                            move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");
                            $new_file_name = "./dashboard/uploads/package/" . $new_file_name;

                            if ($status == "OK") {
                                $qb = mysqli_query($con, "INSERT INTO package (package_title, no_days, package_detail, ufile, destination_id, place_id, price) VALUES ('$port_title', '$no_days', '$port_detail', '$new_file_name', '$destination_id', '$place_id', '$price')");

                                if ($qb) {
                                    $errormsg = "<div class='alert alert-success alert-dismissible alert-outline fade show'>
                                                      Package has been added successfully.
                                                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                      </div>";
                                }
                            } elseif ($status !== "OK") {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                                 " . $msg . " <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>";
                            } else {
                                $errormsg = "<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                                                 Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                                                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                 </div>";
                            }
                        }
                        ?>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        print $errormsg;
                                    }
                                    ?>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="destinationSelect" class="form-label">Destination</label>
                                                    <select class="form-select" id="destinationSelect" name="destination_id">
                                                        <option selected disabled>Select Destination</option>
                                                        <?php
                                                        $dest_query = "SELECT id, destination_title FROM destination ORDER BY destination_title ASC";
                                                        $dest_result = mysqli_query($con, $dest_query);
                                                        while ($dest_row = mysqli_fetch_assoc($dest_result)) {
                                                            echo "<option value='" . $dest_row['id'] . "'>" . $dest_row['destination_title'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="placeSelect" class="form-label">Place</label>
                                                    <select class="form-select" id="placeSelect" name="place_id">
                                                        <option selected disabled>Select Place</option>
                                                        <?php
                                                        $place_query = "SELECT id, port_title FROM portfolio ORDER BY port_title ASC";
                                                        $place_result = mysqli_query($con, $place_query);
                                                        while ($place_row = mysqli_fetch_assoc($place_result)) {
                                                            echo "<option value='" . $place_row['id'] . "'>" . $place_row['port_title'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="packageTitle" class="form-label">Package Title</label>
                                                    <input type="text" class="form-control" id="packageTitle" name="port_title" placeholder="Enter Package Title">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="packageDays" class="form-label">Number of Days</label>
                                                    <input type="text" class="form-control" id="packageDays" name="no_days" placeholder="Enter Number of Days">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="packageDetail" class="form-label">Package Detail</label>
                                                    <textarea class="form-control" id="packageDetail" name="port_detail" rows="3"></textarea>
                                                </div>
                                            </div>

                                       


                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="packagePrice" class="form-label">Price</label>
                                                    <input type="text" class="form-control" id="packagePrice" name="price" placeholder="Enter Price">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="packagePhoto" class="form-label">Photo</label>
                                                    <input type="file" class="form-control" id="packagePhoto" name="ufile">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">Add Package</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
