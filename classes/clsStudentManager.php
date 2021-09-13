<?php
include_once 'clsStud_data.php';
include("/xampp/htdocs/Nishant/Class_crud/dbconnect.php");
include_once("clsStudentSet.php");
class clsStudentManager
{
    function SaveStudent($ObjStud_data, $myConn = null)
    {
        $stud_regd_date = $ObjStud_data->getStud_regd_date();
        $stud_name =  $ObjStud_data->getStud_name();
        $stud_dob =  $ObjStud_data->getStud_dob();
        $stud_gender = $ObjStud_data->getStud_gender();
        $stud_mobile =  $ObjStud_data->getStud_mobile();
        $stud_photo = $ObjStud_data->getStud_photo();

        if ($stud_regd_date == null)
            $stud_regd_date = 'null';
        else
            $stud_regd_date = "'$stud_regd_date'";

        if ($stud_name == null)
            $stud_name = 'null';
        else
            $stud_name = "'$stud_name'";

        if ($stud_dob == null)
            $stud_dob = 'null';
        else
            $stud_dob = "'$stud_dob'";

        if ($stud_gender == null)
            $stud_gender = 'null';
        else
            $stud_gender = "'$stud_gender'";

        if ($stud_mobile == null)
            $stud_mobile = 'null';
        else
            $stud_mobile = "'$stud_mobile'";

        if ($stud_photo == null)
            $stud_photo = 'null';
        else
            $stud_photo = "'$stud_photo'";

        $sQuery = "insert into stud_regd(stud_regd_date,stud_name, stud_dob, stud_gender, stud_mobile, stud_photo) values($stud_regd_date,$stud_name,$stud_dob,$stud_gender,$stud_mobile,$stud_photo)";

        // echo $sQuery;
        if (is_resource($myConn) and get_resource_type($myConn) == 'pgsql link') {
            $rsltSUser = pg_query($myConn, $sQuery) or die("Couldn't execute query in clsUserRegistrationManager:SaveUser");
            $lNumTuples = pg_cmdtuples($rsltSUser);
        } else {
            // @pg_close();
            include("./dbconnect.php");
            $rsltSUser = pg_query($connection, $sQuery) or die("Couldn't execute query in clsUserRegistrationManager:SaveUser");
            $lNumTuples = pg_cmdtuples($rsltSUser);
            pg_close();
        }
        return $lNumTuples;
    }





    function RetrieveUserSet($sQuery)
    {
        include("./dbconnect.php");

        $clsStudentSet = new clsStudentSet();

        $rsltAllSUser = pg_exec($connection, $sQuery) or die("Couldn't execute query in clsUserRegistrationManager:RetrieveUserSet.");
        $lNumRows = pg_numrows($rsltAllSUser);
        if ($lNumRows == 0) {
            pg_close();
            return $clsStudentSet;
        }
        for ($lCount = 0; $lCount < $lNumRows; $lCount++) {
            $ObjclsStud_data = new clsStud_data();
            $arrAllSUser = pg_fetch_array($rsltAllSUser, $lCount);

            $ObjclsStud_data->setStud_id($arrAllSUser['stud_id']);
            $ObjclsStud_data->setStud_regd_date($arrAllSUser['stud_regd_date']);
            $ObjclsStud_data->setStud_name($arrAllSUser['stud_name']);
            $ObjclsStud_data->setStud_dob($arrAllSUser['stud_dob']);
            $ObjclsStud_data->setStud_gender($arrAllSUser['stud_gender']);
            $ObjclsStud_data->setStud_mobile($arrAllSUser['stud_mobile']);
            $ObjclsStud_data->setStud_photo($arrAllSUser['stud_photo']);
            $clsStudentSet->Add($ObjclsStud_data);
        }
        pg_close();
        return $clsStudentSet;
    }

    function DeleteUser($ObjStud_data, $myConn = null)
    {
        $UserID = $ObjStud_data->getStud_id();
        $photo = $ObjStud_data->getStud_photo();

        if ($UserID == null)
            $UserID = 'null';

        $sQuery = "delete from stud_regd where stud_id=$UserID";

        if (is_resource($myConn) and get_resource_type($myConn) == 'pgsql link') {
            $rsltUser = pg_exec($myConn, $sQuery) or die("Couldn't execute query in clsUserRegistrationManager:DeleteUser");
            $lNumTuples = pg_cmdtuples($rsltUser);
            // unlink("./image/".$photo);
            // unlink("../image/".$photo);
            // echo $photo;

        } else {
            @pg_close();
            include("../dbconnect.php");
            $rsltUser = pg_exec($connection, $sQuery) or die("Couldn't execute query in clsUserRegistrationManager:DeleteUser");
            $lNumTuples = pg_cmdtuples($rsltUser);
            pg_close();
        }
        return $lNumTuples;
    }

    //----
    
    function UpdateUserDetails($ObjUserRegistrationMaster, $myConn=null)
    {
        $UserID = $ObjUserRegistrationMaster->getUserID();
        $UserName = $ObjUserRegistrationMaster->getName();
        $Password = $ObjUserRegistrationMaster->getPassword();
        $ContactNo = $ObjUserRegistrationMaster->getContactNo();
        $IsActive = $ObjUserRegistrationMaster->getIsActive();
        
        $sQuery = "update userdetails set name='$UserName',password='$Password',contactno=$ContactNo,isactive='$IsActive' where id=$UserID";
    
        if(is_resource($myConn) and get_resource_type($myConn)== 'pgsql link')
        {
            $Result = pg_exec($myConn,$sQuery) or die ("Couldn't execute query in clsUserRegistrationManager:UpdateUserDetails");
            $lNumTuples = pg_cmdtuples($Result);
        }
        else
        {
            include("../dbconnect.php");
            $Result = pg_exec($connection,$sQuery) or die ("Couldn't execute query in clsUserRegistrationManager:UpdateUserDetails");
            $lNumTuples = pg_cmdtuples($Result);
            pg_close();
        }
        return $lNumTuples;
    }
}
