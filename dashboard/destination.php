<?php include"header.php";?>
<?php include"sidebar.php";?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Destination</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">All</a></li>
                                <li class="breadcrumb-item active">Destination</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Destination List</h5>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Destination Title</th>
                                        <th>Destination Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q="SELECT * FROM destination ORDER BY id DESC";
                                    $r123 = mysqli_query($con, $q);

                                    while($ro = mysqli_fetch_array($r123)) {
                                        $id = $ro['id'];
                                        $destination_title = $ro['destination_title'];
                                        $destination_desc = $ro['destination_desc'];

                                        echo "<tr>
                                            <td>$destination_title</td>
                                            <td>$destination_desc</td>
                                            <td>
                                                <div class='dropdown d-inline-block'>
                                                    <button class='btn btn-danger btn-sm dropdown' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                      Delete
                                                    </button>
                                                    <ul class='dropdown-menu dropdown-menu-end'>
                                                        <li>
                                                            <a href='#' class='dropdown-item remove-item-btn' onclick='confirmDelete($id)'>
                                                                <i class='ri-delete-bin-fill align-bottom me-2 text-muted'></i> Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include"footer.php";?>

<script>
function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        window.location.href = 'destination.php?id=' + id;
    }
}
</script>
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM destination WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Record deleted successfully');
                window.location.href = 'destination.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to delete record');
                window.location.href = 'destination.php';
              </script>";
    }
    
 
    
}
?>
