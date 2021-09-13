<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Student Details</title>
    <style>
        .jumbotron {
            color: #ffff;
            background-color: #000 !important;
            min-height: 85vh;
        }

        body {
            background-color: lightblue !important;
        }

        .margin-top1 {
            position: absolute;
            top: 85vh;
        }

        .table {
            width: 50vw !important;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center">
        <div class="jumbotron">
            <a class="btn btn-primary form-control" href="views/student/registration.php"> Add More Entry </a> <br><br>
            <h3>Student Details</h3>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>


                    <?php

                    //-----------------------------test
                    include_once "dbconnect.php";
                    include "classes/clsStudentManager.php";

                    //--------------------------

                    $showRecordPerPage = 5;
                    if (isset($_GET['page']) && !empty($_GET['page'])) {
                        $currentPage = $_GET['page'];
                    } else {
                        $currentPage = 1;
                    }
                    $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
                    $totalEmpSQL = "SELECT * FROM stud_regd";
                    $allResult = pg_query($connection, $totalEmpSQL);
                    $totalResult = pg_num_rows($allResult);
                    $lastPage = ceil($totalResult / $showRecordPerPage);
                    $firstPage = 1;
                    $nextPage = $currentPage + 1;
                    $previousPage = $currentPage - 1;
                    $Query = "SELECT * FROM stud_regd ORDER BY stud_id OFFSET  $startFrom LIMIT  $showRecordPerPage";
                    $clsStudentSet = new clsStudentSet();
                    $clsStudentManager = new clsStudentManager();

                    $clsStudentSet = $clsStudentManager->RetrieveUserSet($Query);
                    $count = $clsStudentSet->GetCount();
                    ?>

                    <?php
                    $pageNo = null;

                    if ($count > 0) {
                        for ($i = 0; $i < $count; $i++) {
                            $ObjStud_data = new clsStud_data();
                            $ObjStud_data = $clsStudentSet->GetItem($i);
                    ?>
                            

                            <tr id="<?php echo $ObjStud_data->getStud_id(); ?>">
                                <td><?php echo $ObjStud_data->getStud_id(); ?></td>
                                <td><?php echo $ObjStud_data->getStud_regd_date(); ?></td>
                                <td><?php echo $ObjStud_data->getStud_name(); ?> </td>
                                <td><?php echo $ObjStud_data->getStud_dob(); ?></td>
                                <td><?php echo $ObjStud_data->getStud_gender(); ?></td>
                                <td><?php echo $ObjStud_data->getStud_mobile(); ?></td>
                                <td><img style=" width: 60px;  height: 60px; border-radius: 50px; object-fit: cover;" src="image/<?php echo $ObjStud_data->getStud_photo(); ?>"></td>
                                <!-- <td><a  href="update.php?userid=<?php echo $ObjStud_data->getStud_id(); ?>" class="btn btn-primary btn-sm">Update</a> <a href="delete.php?userid=<?php echo $ObjStud_data->getStud_id; ?>" class="btn btn-danger btn-sm">Delete</a></td> -->

                                <td><a href="update.php?userid=<?php echo $ObjStud_data->getStud_id(); ?>" class="btn btn-primary btn-sm">Update</a> <a href="views/student/delete.php?userid=<?php echo $ObjStud_data->getStud_id(); ?>&photo=<?php echo $ObjStud_data->getStud_photo(); ?>" onclick='return checkdelete()' class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                    <?php
                        }
                    }

                    //   pg_close($connection); 
                    ?>

                </tbody>
            </table>

            <script>
                function checkdelete() {
                    return confirm('Are you Sure Want to delete this Record');
                }
            </script>

            <nav class="margin-top1" aria-label="Page navigation">

                <ul class="pagination ">
                    <?php if ($currentPage != $firstPage) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
                                <span aria-hidden="true">First</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($currentPage >= 2) { ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
                    <?php } ?>
                    <li class="page-item active"><a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a></li>
                    <?php if ($currentPage != $lastPage) { ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
                                <span aria-hidden="true">Last</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

            </nav>

        </div>
    </div>








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>