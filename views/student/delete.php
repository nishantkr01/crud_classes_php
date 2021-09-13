<?php

        // include_once 'database.php';
            $stud_id = $_GET["userid"];
            $stud_photo = $_GET["photo"];
        // include_once "./classes/clsStud_data.php";
        include_once "../../classes/clsStudentManager.php";

        $ObjStud_data = new clsStud_data();
        $ObjStudentManager = new clsStudentManager();
        $ObjStud_data->setStud_id($stud_id);
        $ObjStud_data->setStud_photo($stud_photo);

        $deleted = $ObjStudentManager->DeleteUser($ObjStud_data,$connection);

        if($deleted)
        {
            unlink("image/".$stud_photo);
            echo "<script>alert('Record deleted successfully');  window.location.href = '../../index.php'; </script>";

        }
        else
        {
            echo "<script>alert('Data not deleted. Try again !!')</script>";
        }
?>

