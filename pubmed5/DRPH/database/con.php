 <?php

    //Connect to database
    $con = mysqli_connect('localhost','root','');

    if(!$con){
        echo ("Can not conncet: " . mysql_error());
        exit();
    }

    mysqli_select_db($con, "DiabetesResearchPublicationsHub");
    mysqli_query($con, 'SET names UTF8');

?>