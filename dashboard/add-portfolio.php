<?php include"header.php";?>
<?php include"sidebar.php";?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Places</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Places</a></li>
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
                                        <i class="fas fa-home"></i> Add Places
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <?php
                        $status = "OK"; //initial status
                        $msg = "";
                        if (isset($_POST['save'])) {
                            $port_title = mysqli_real_escape_string($con, $_POST['port_title']);
                            $port_desc = mysqli_real_escape_string($con, $_POST['port_desc']);
                            $port_detail = mysqli_real_escape_string($con, $_POST['port_detail']);
                         

                            

                            $uploads_dir = 'uploads/portfolio';
                            $tmp_name = $_FILES["ufile"]["tmp_name"];
                            $name = basename($_FILES["ufile"]["name"]);
                            $random_digit = rand(0000, 9999);
                            $new_file_name = $random_digit . $name;
                            move_uploaded_file($tmp_name, "$uploads_dir/$new_file_name");
                            $new_file_name="./dashboard/uploads/portfolio/".$new_file_name;
 
                            if ($status == "OK") {
                                $qb = mysqli_query($con, "INSERT INTO portfolio (port_title, port_desc, port_detail, ufile) VALUES ('$port_title', '$port_desc', '$port_detail', '$new_file_name')");

                                if ($qb) {
                                    $errormsg = "<div class='alert alert-success alert-dismissible alert-outline fade show'>
                                                      Places has been added successfully.
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

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="portfolioTitle" class="form-label">Places Title</label>
                                                    <input type="text" class="form-control" id="portfolioTitle" name="port_title" placeholder="Enter Places Title">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="portfolioDesc" class="form-label">Short Description</label>
                                                    <textarea class="form-control" id="portfolioDesc" name="port_desc" rows="2"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="portfolioDetail" class="form-label">Places Detail</label>
                                                    <textarea class="form-control" id="portfolioDetail" name="port_detail" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="portfolioPhoto" class="form-label">Photo</label>
                                                    <input type="file" class="form-control" id="portfolioPhoto" name="ufile">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">Add Places</button>
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

    <?php include"footer.php";?>
