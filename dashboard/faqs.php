
<?php
include "header.php";  // Include your header file
include "sidebar.php"; // Include your sidebar file

// Database connection should be established here (not shown in this snippet)
// Example: include_once("db_connection.php");

// Function to simulate fetching FAQs (replace with actual database connection and query)
function fetchFaqsFromDatabase() {
    global $con; // Assuming $con is your database connection object

    $query = "SELECT * FROM faqs ORDER BY id DESC"; // Query to fetch FAQs
    $result = mysqli_query($con, $query);

    $faqs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $faqs[] = $row;
    }

    return $faqs;
}

// Call the function to fetch FAQs
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
                        <h4 class="mb-sm-0">Faqs</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All</a></li>
                                <li class="breadcrumb-item active">Faqs</li>
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
                            <h5 class="card-title mb-0">Faqs List</h5>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Questions</th>
                                        <th>Answer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($faqs as $faq): ?>
                                    <tr>
                                        <td><?php echo $faq['question']; ?></td>
                                        <td><?php echo $faq['answer']; ?></td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a href="editfaqs.php?id=<?php echo $faq['id']; ?>" class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                                    <li><a href="deletefaqs.php?id=<?php echo $faq['id']; ?>" class="dropdown-item remove-item-btn"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

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

    <?php include "footer.php"; ?> <!-- Include your footer file -->