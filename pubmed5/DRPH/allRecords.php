<html>
    <head>
        <meta charset="utf-8">
        <link rel = "stylesheet" href = "bootstrap/css/bootstrap.css">
        <link href = "styles/allRecords.css" rel = "stylesheet" type="text/css"/>
        <script src="https://d3js.org/d3.v3.min.js"></script>
        <script src = "jquery-3.2.1.js"></script>
        <script src = "bootstrap/js/bootstrap.min.js"></script>
        
    </head>

    <body>
        
        <?php $term = $_POST['term'];
        if(strcasecmp($term, "CGM") == 0){
        }else if(strcasecmp($term, "HBA1c") == 0){
        }else if(strcasecmp($term, "diabetes") == 0){
        }else
        {
            echo "
            <script language=\"JavaScript\">alert(\"Sorry I don't know the answer, But I am working on it!                                              Why not try [CGM] OR [HBA1c]!\");
            window.history.back(-1);
            </script>";
        }
        ?>

        <section class = "intro">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="container-fluid">
                    <ul class="nav navbar-nav navbar-right">
                        <li style="color : white"><a href= index.php>Home</a></li>
                        <li><a href= searchTerm.php>Term</a></li>
                    </ul>
                </div>
            </nav>

            <div class="content">
                <h1>Diabetes Research Publications Hub</h1>
                <Form class = "form-search" name = "getTerm" method = "post" action = "certainAuthor.php">
                    <input class= "nameSearchText" name = "name" id = "searchName" type="text" placeholder="Please enter the author you are interested in...">
                    <input name = "term" type = "hidden" value = "<?php echo $term; ?>">
                    <input style = "width : 60px" class="nameSearchBtn" type="submit" value = "Go">
                </Form>
            </div>

        </section>
        
        <div style="width : 100%;height:150%;" id = "d3Dispaly">
            <?php  include ('visualization/allRelationshipVisualization.php'); ?>
        </div>
    
    </body>
    
</html>
