<?php

    //Query for all publications related to diabetes
    $requestAllPublications = "SELECT pm_id, title, pubYear, authorName FROM `DiabetesNew` 
    ORDER by pubYear
    DESC"; 

    //Get results based on query
    $allPulicationsResult = mysqli_query($con, $requestAllPublications);

    //Store results in array $allPublicationsRecord[]
    foreach($allPulicationsResult as $row){
        $allPublicationsRecord[]= $row;
    }
    
?>
        