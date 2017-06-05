<?php
    include ('con.php');

    //Delete all records in tempRelationship
    $requestDelete = "DELETE FROM `tempRelationship`";
    mysqli_query($con, $requestDelete);
    mysqli_close($con);  
?>