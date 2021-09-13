<?php
class clsStud_data
{
    private $stud_id;
    private $stud_regd_date;
    private $stud_name;
    private $stud_dob;
    private $stud_gender;
    private $stud_mobile;
    private $stud_photo;

    function getStud_id()
    {
        return $this->stud_id;
    }
    function setStud_id($Data)
    {
        $this->stud_id = $Data;
    }

    function getStud_regd_date()
    {
        return $this->stud_regd_date;
    }
    function setStud_regd_date($Data)
    {
        $this->stud_regd_date = $Data;
    }

    function getStud_name()
    {
        return $this->stud_name;
    }
    function setStud_name($Data)
    {
        $this->stud_name = $Data;
    }
    //---
    function getStud_dob()
    {
        return $this->stud_dob;
    }
    function setStud_dob($Data)
    {
        $this->stud_dob = $Data;
    }
    //--
    function getStud_gender()
    {
        return $this->stud_gender;
    }
    function setStud_gender($Data)
    {
        $this->stud_gender = $Data;
    }
    //--
    function getStud_mobile()
    {
        return $this->stud_mobile;
    }
    function setStud_mobile($Data)
    {
        $this->stud_mobile = $Data;
    }
    //--
    function getStud_photo()
    {
        return $this->stud_photo;
    }
    function setStud_photo($Data)
    {
        $this->stud_photo = $Data;
    }
}
