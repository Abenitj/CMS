
<?php
include "header.php";  // Include your header file
include "sidebar.php"; // Include your sidebar file

// Database connection should be established here (not shown in this snippet)
// Example: include_once("db_connection.php");

// Function to simulate fetching FAQs (replace with actual database connection and query)
function fetchFaqsFromDatabase() {
    global $con; // Assuming $con is your database connection object

    $query = "SELECT * FROM faqs ORDER BY id DESC"; // Sample query to fetch FAQs
    $result = mysqli_query($con, $query);

    $faqs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $faqs[] = $row;
    }

    return $faqs;
}

// Function to handle form submission and insert new FAQ into database
function createFaqs() {
    global $con; // Assuming $con is your database connection object

    $status = "OK";
    $errormsg = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $question = mysqli_real_escape_string($con, $_POST['question']);
        $answer = mysqli_real_escape_string($con, $_POST['answer']);
        $created_at = date('Y-m-d H:i:s'); // Assuming you want to use current timestamp

        // Check if all fields are filled
        if (empty($question) || empty($answer)) {
            $status = "NOTOK";
            $errormsg = "Please fill in all fields.";
        }

        if ($status == "OK") {
            // Insert into database
            $query = "INSERT INTO faqs (question, answer, created_at) VALUES ('$question', '$answer', '$created_at')";
            $result = mysqli_query($con, $query);

            if ($result) {
                $errormsg = "
                    <div class='alert alert-success alert-dismissible alert-outline fade show'>
                        Faqs has been added successfully.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            } else {
                $errormsg = "
                    <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                        Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
            }
        } else {
            $errormsg = "
                <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                    $errormsg
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }

    return $errormsg;
}

// Call the function to handle form submission
$errormsg = createFaqs();

// Fetch FAQs from database (if needed)
$faqs = fetchFaqsFromDatabase();

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
                        <h4 class="mb-sm-0">Create Faqs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Faqs</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="false">
                                        <i class="fas fa-home"></i> New Faqs
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <?php echo $errormsg; ?> <!-- Display error/success message -->

                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="question" class="form-label">Question</label>
                                                    <input type="text" class="form-control" name="question" placeholder="Enter Question">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="answer" class="form-label">Answer</label>
                                                    <textarea class="form-control" name="answer" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" name="save" class="btn btn-primary">Create Faqs</button>
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
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <?php include "footer.php"; ?> <!-- Include your footer file -->