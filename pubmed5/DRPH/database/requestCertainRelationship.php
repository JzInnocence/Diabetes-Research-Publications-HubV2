<?php
    include ('con.php');

    //Request all publications for a certain author
    $requestFullRecords = "SELECT * FROM `" . $term ."New` WHERE authorName like '%" . $name ."%'";

    //Result
    $fullRecordsResult = mysqli_query($con, $requestFullRecords); 
    $allAuthorList = array();
    $authorRelationship = array();
    
    //Insert these records into table tempRelationship
    while($row = mysqli_fetch_assoc($fullRecordsResult)){
       $allAuthorList =split(",",$row['authorName']);
        for($i = 1; $i<count($allAuthorList); $i++){
            $requestInsert = "INSERT INTO `tempRelationship`(`id`, `pm_id`, `source`, `target`) VALUES (" .$i . "," . $row['pm_id'] . ",'" .$allAuthorList[0] .  "','" . $allAuthorList[$i] ."')";
            $insertResult = mysqli_query($con, $requestInsert); 
        }

    }
    
    //Request relationships record in table tempRelationship
    $requestRelationshipByName = "SELECT source,target,COUNT(*) as value FROM `tempRelationship` where source like '%" . $name . "%' OR target like '%" . $name . "%'
    GROUP by source,target 
    ORDER by value 
    DESC";

    //Result
    $relativeNameResult = mysqli_query($con, $requestRelationshipByName); 

    foreach($relativeNameResult as $row){
        $relationshipByNameRecord[]= $row;
    }

?>