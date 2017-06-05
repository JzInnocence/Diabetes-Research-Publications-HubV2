<?php
    include ('con.php');

    //Query For All Publications Related to Diabetes and Rank By Year
    $requestPublicationsCount = 
        "SELECT COUNT(*) AS amount FROM `DiabetesNew`
        GROUP BY pubYear
        ORDER BY pubYear
        ASC";

    //Result
    $publicationsCountResult = mysqli_query($con, $requestPublicationsCount);

    while($publicationsCountRecord = mysqli_fetch_array($publicationsCountResult)){
        $amount[] = $publicationsCountRecord['amount'];
    }
?>