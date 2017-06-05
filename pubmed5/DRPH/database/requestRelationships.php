<?php 
    include ('con.php');

    //Request all publications under certain field
    $requestAllRecords = "SELECT * FROM `" . $term ."New`";

    //Result
    $allRecordsResult = mysqli_query($con, $requestAllRecords);

    $allRecordsList = array();

    //Insert these records into table tempRelationship
    while($row = mysqli_fetch_assoc($allRecordsResult)){
           $allRecordsList =split(",",$row['authorName']);
            for($i = 1; $i<count($allRecordsList); $i++){
                $requestInsert = "INSERT INTO `tempRelationship`(`id`, `pm_id`, `source`, `target`) VALUES (" .$i . "," . $row['pm_id'] . ",'" .$allRecordsList[0] .  "','" . $allRecordsList[$i] ."')";
                $insertResult = mysqli_query($con, $requestInsert); 
            }             
        }

    //Request  relationships record in table tempRelationship
    $requestRelationship = 
        "SELECT source,target,COUNT(*) as value FROM `tempRelationship`
        GROUP by source,target 
        ORDER by value 
        DESC";

    $relationshipResult = mysqli_query($con, $requestRelationship);

    foreach($relationshipResult as $row){
            $relationshipRecord[]= $row;
    }

    while($row = mysqli_fetch_assoc($relationshipResult)){
    }
    
    //Get how many relationships in tempRelationship
    $linkNum = sizeof($relationshipRecord);
    
    mysqli_close($con);


?>