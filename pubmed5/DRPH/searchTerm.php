<!DOCTYP html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Diabetes Search Hub</title>
        
        <script src="https://d3js.org/d3.v3.min.js"></script>
        <script src = "jquery.min.js"></script>
        <script src="jqPaginator.js"></script>
        
        <link href = "styles/searchTerm.css" rel = "stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="/try/bootstrap/twitter-bootstrap-v2/docs/examples/images/favicon.ico">
        <link rel="stylesheet" href="styles/bootstrap.min.css">
        <link rel="apple-touch-icon" href="/try/bootstrap/twitter-bootstrap-v2/docs/examples/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/try/bootstrap/twitter-bootstrap-v2/docs/examples/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/try/bootstrap/twitter-bootstrap-v2/docs/examples/images/apple-touch-icon-114x114.png">
        
    </head>
    
    <body>
        <?php 
            include ('database/requestPublicationsCount.php');
            include ('database/requestPublicationList.php');
        ?>
        
        <section class = "intro">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="container-fluid">
                <div>
                    <ul class="nav navbar-nav navbar-right">
                        <li style="color : white"><a href= index.html>Home</a></li>
                        <li><a href= searchTerm.php>Search</a></li>
                    </ul>
                </div>
                </div>
            </nav>

            <div class="content">
                <h1>Diabetes Research Publications Hub</h1>
            </div>
            
            <div style = "width: 58%; margin: 48px 26%; height: 50px">
                <select style = "width : 80; float: left; height: 50;" name = "" id = "searchType" onchange = "changeSch()">
                    <option value = "1">Term</option>
                    <option value = "2">Author</option>
                </select>
                
                <form class="search1" name = "getTerm" style="text-align: center;width: 90%;float: left;height: 50px; margin: 0;padding: 0;" method="post" action="allRecords.php">
                    <input class="termSearchText" name="term" type="text" placeholder="Please enter the term you are interested in...">
                    <input class="termSearchBtn" type="submit" value="Go">
                </form>

                <Form class = "search2 hide" style = "text-align: center; width: 90%; float: left; height: 50px; margin: 0;padding: 0;" method = "post" action = "certainAuthor_name.php">
                    <input class = "authorName" name = "name"  type="text" placeholder="Please enter the Author you are interested in..."> 
                    <input class = "nameSearchBtn" type="submit" value = "Go">
                </Form>
            </div>
        
        </section>
        
        <script>
            function changeSch(){
              if($("#searchType").val() == 1){
                $(".search1").removeClass("hide");
                $(".search2").addClass("hide");
              }else{
                 $(".search2").removeClass("hide");
                $(".search1").addClass("hide");
              }
            }
        </script>
        
        <div id="main">
            <div id="left" style="float:left;  width:60%;  height:100%; margin-top : 10px">
                <div class ="publicationsList"; style = "height : 40%;">
                    <h1 style="text-align:center; color : #036A81 ">Publications</h1>
                </div>

                 <div class = "container", style = "width : 100%; background : white; color : #036A81">
                    <div class = "row", style = "fill : #FFFFFF" >
                        <div class= "col-sm-r", style = "fill : #FFFFFF" >
                            <table class="table" bgcolor="#FFFFFF">
                                <tbody text = "black"; bgcolor="#FFFFFF">
                                    <ul class = "list" style="list-style-type:none"></ul>
                                </tbody>
                                <tfoot class="footer">
                                    <ul class="pagination" id = "callBackPager"></ul>
                                    <script> 
                                        var dataList = <?php echo json_encode($allPublicationsRecord); ?>;
                                        
                                        dataList.forEach(function(d,i){
                                          $(".list").append("<li id = \"publicationsTitle\" style=\"margin-top:5px; font-size : 15px\">" +d.title +"</li>")
                                                    .append("<li id = \"publicationsInfo\" style=\"font-size:12px; margin-top : 3px\">"+ d.pubYear + "     " + d.authorName +"</li>");
                                        });
                                        
                                    $(".list li").each(function(index,d){
                                        if(index>=20){
                                            $(d).css("display","none");
                                        }
                                    });
                                        
                                        $.jqPaginator('#callBackPager', {
                                            totalPages: (dataList.length%20) + 1,
                                            visiblePages: 5,
                                            currentPage: 1,
                                            onPageChange: function (num, type) {
                                                $(".list li").each(function(index,d){
                                                    if(index>=20*num || index<20*(num-1)){
                                                        $(d).css("display","none");
                                                    }else{
                                                        $(d).css("display","block");
                                                    }
                                                });
                                            }
                                        });
                                        
                                    </script>  
                                    
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
        <div id="right" style="float:right;  width:30%; height:100%; margin-top : 10px">
            <div class ="rankByYearResult"; style = "height : 40%;">
                <h1 style="text-align:center; color : #036A81 ">Results By Year</h1>
            </div>
            <div id = "relationshipChart"></div>
        </div> 

        <?php include('visualization/barChart_ResultsByYear.php');?>
            
        </div>
        
    </body>

</html>