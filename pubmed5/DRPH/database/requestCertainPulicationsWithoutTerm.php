<?php
    include("con.php");

    //Request publication list for a certain author
    $requestFullRecordsV2 = "SELECT * FROM `DiabetesNew` WHERE authorName like '%" . $name ."%'";

    //Result
    $fullRecordsResultV2 = mysqli_query($con, $requestFullRecordsV2); 
?>