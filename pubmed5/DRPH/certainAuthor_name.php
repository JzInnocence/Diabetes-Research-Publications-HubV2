<html>

    <head>
        <meta charset="utf-8">
        <script src="https://d3js.org/d3.v3.min.js"></script>
        <script src = "jquery-3.2.1.js"></script>
        <link rel = "stylesheet" href = "bootstrap/css/bootstrap.css">
        <script src = "bootstrap/js/bootstrap.min.js"></script>
        <link href = "styles/certainAuthor.css" rel = "stylesheet" type="text/css"/>
    </head>

<body>
    <?php
    
        $name = $_POST['name'];    
        include ('database/requestCertainRelationshipWithoutTerm.php');
    
    ?>
    
        <section class = "intro">
            <nav class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
            <div>
                <ul class="nav navbar-nav navbar-right">
                    <li style="color : white"><a href= index.php>Home</a></li>
                    <li><a href= searchTerm.php>Search</a></li>
                </ul>
            </div>
            </div>
            </nav>
            
            <div class="content">
                <h1>Diabetes Research Publications Hub</h1>
                <Form class = "form-search" style = "margin-left:0" method = "post" action = "certainAuthor_name.php">
                    <input style = "margin-left:0" class= "nameSearchText" name = "name" id = "searchName" type="text" placeholder="Please enter the author you are interested in...">
                    <input id = "term" type = "hidden" name = "term" value = "<?php echo $term; ?>">
                    <input style = "width : 60px" class="nameSearchBtn" type="submit" value = "Go">
                </Form>
            </div>

        </section>

        <div id="main">
            <div id="left" style="float:left;  width:50%;  height:100%; margin-top : 10px">
                <div class ="publicationsList"; style = "height : 8%;">
                    <h1 style="text-align:center; color : #036A81 ">Publications</h1>
                </div>

                 <div class = "container bg-info", style = "width : 100%; background : white; color : #036A81">
                    <div class = "row", style = "fill : #FFFFFF" >
                        <div class= "col-sm-r", style = "fill : #FFFFFF" >
                            <table class="table" bgcolor="#FFFFFF">
                                <tbody text = "black"; bgcolor="#FFFFFF">
                                    <?php
                                        include("database/requestCertainPulicationsWithoutTerm.php");
                                        while($row = mysqli_fetch_assoc($fullRecordsResultV2)){
                                    ?>
                                    <ul style="list-style-type:none">
                                        <li id = "publicationsTitle" style="margin-top:5px; font-size : 15px"><a href = "<?php echo "https://www.ncbi.nlm.nih.gov/pubmed/" . $row['pm_id']?>"><?php echo $row['title']?></a></li>
                                        <li id = "publicationsInfo" style="font-size:12px; margin-top : 3px"><?php echo $row['authorName'] . " " . $row['pubYear']?></li>
                                    </ul>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="right" style="float:right;  width:40%; height:100%; margin-top : 10px">
                <div id ="authorRelationship"; style = "height : 8%;">
                    <h1 style="text-align:center; color : #036A81 ">Related Authors</h1>
                </div>
                <div id = "relationshipChart" style="float:left ;  width:99%; height:60%; border: solid #036A81 3px;"></div>
            </div>
        </div>   
    
        <?php include("visualization/certainRelationshipChart.php"); ?>

    </body>
</html>