<script>
    var queryName = window.location.href.split("#")[1];
    var width = $("#relationshipChart").width();
    var height = $("#relationshipChart").height();
    var linecolor = ["#E8E8E8","#E8E8E8","#FFCC33","#FF9933","#FF6633","#FF3333","#FF0033","#993333","#990000"];
    var color = d3.scale.category10();
    var links = Array();
    var links =<?php echo json_encode($relationshipByNameRecord); ?>;

    <?php
        include("database/emptyTempRelationship.php");

    ?>

    // create empty nodes array
    var nodes = {};

    // compute nodes from links data
    links.forEach(function(link) {
        link.source = nodes[link.source] ||
            (nodes[link.source] = {name: link.source, group :1,state : 1});
        link.target = nodes[link.target] ||
            (nodes[link.target] = {name: link.target, group :2, state :1});        
    });

    //add svg to our body
    var svg = d3.select("#relationshipChart").append('svg')
        .attr('width', width)
        .attr('height',height);

    var force = d3.layout.force()
        .size([width,height])
        .nodes(d3.values(nodes))
        .links(links)
        .on('tick', tick)
        .linkDistance(150)
        .start();

    var link = svg.selectAll('.link')
        .data(links)
        .enter().append('line')
        .attr('class', 'link')
        .attr("stroke", function(d){return linecolor[d.value];});

    var node = svg.selectAll('.node')
        .data(force.nodes())
        .enter().append('circle')
        .attr('class', 'node')
        .attr('r', function(d){
            if(d.group == 1){
                return 10;
            }else{
                return 8;
            }
        })
        .attr('x', function(d){
            if(d.group == 1){
                return 0.5 * width;
            }
        })
        .attr('y', function(d){
            if(d.group == 1){
                return 0.5 * height;
            }
        })
        .style('fill',function(d){return color(d.group);})
        .on("mouseover", function(d){

            console.log(d.name);
                d3.select(this)
                    .attr("r", 15);
                var xPos = d3.mouse(this)[0] -15;
                var yPos = d3.mouse(this)[1] -55;
                tooltip.style("display", "block");
                tooltip.attr("transform", "translate("+[xPos,yPos]+")");
                tooltip.select("text").text(d.name)

            })
            .on("mouseout", function(d){
                tooltip.style("display", "none");
                d3.select(this)
                .attr('r', function(d){
                    if(d.group == 1){
                        return 10;
                    }else{
                        return 8;
                    }
                })
                .style("fill", function(d){return color(d.group);});

            })
            .on("click", function(d){
                $("#searchName").val(d.name);

                console.log(d.name);
            });

    var tooltip = svg.append("g")
        .attr("class", "tooltip")
        .style({"display":"none","opacity":1});

        tooltip.append("text")
            .attr("x", 15)
            .attr("dy", "1.2px")
            .style("font-size", "18px")
            .attr("fill", "#036A81")
            .attr("font-weight", "bold")

    function tick(e) {
        node.attr('cx', function(d) {return d.x;})
            .attr('cy', function(d) { return d.y; })
            .call(force.drag()
                  .on("dragstart",function(d,i){
                        d.fixed = true;
                        d.state = 0;
                        console.log("start");

                    })
                  .on("dragend",function(d,i){
                        console.log("end");
                    })
                  .on("drag",function(d,i){
                        console.log("ing");
                    }
             ));

        link.attr('x1', function(d) { return d.source.x; })
            .attr('y1', function(d) { return d.source.y; })
            .attr('x2', function(d) { return d.target.x; })
            .attr('y2', function(d) { return d.target.y; });

    }
    
    //Legend
    var first = 0.05 * height; 
    var two = first + 30;
    var three = first + 60;
    var four = first + 90;
    var five = first + 120;
    var six = first + 150;
    var seven = first + 180;

    var legendData = ["FirstAuthor", "OtherAuthor"];
    var legend = svg.selectAll('.legend')
        .data(legendData)
        .enter()
        .append('circle')
        .attr('cx', 150)
        .attr('cy', function(d){
            if(d == "FirstAuthor"){
                return first;
            }else{
                return first + 30; 
            }
        })
        .attr('r', function(d){
            if(d == "FirstAuthor"){
                return 10;                        
            }else{
                return 8;
            }
        })
        .attr('stroke', '#E8E8E8')
        .attr('stroke-width', '2px')
        .style('fill', function(d,i){
            return color(i+1);

        });

    var legendText = svg.selectAll('.legendText')
        .data(legendData)
        .enter()
        .append('text')
        .attr('x', 165)
        .attr('y', function(d){
            if(d == "FirstAuthor"){
                return first+5;
            }else{
                return first+35; 
            }
        })
        .text(function(d){
            return d;
        });


    var legendLine = svg.append('line')
    .attr('x1', 45)
    .attr('x2', 80)
    .attr('y1',function(d,i){
        return first;
    })
    .attr('y2',function(d,i){
        return first;
    })
    .style({
        stroke : linecolor[1],
        'stroke-width': 2
    });

     var legendLine = svg.append('line')
    .attr('x1', 45)
    .attr('x2', 80)
    .attr('y1',function(d,i){
        return first;
    })
    .attr('y2',function(d,i){
        return first;
    })
    .style({
        stroke : linecolor[1],
        'stroke-width': 2
    });

    var legendLine = svg.append('line')
        .attr('x1', 45)
        .attr('x2', 80)
        .attr('y1',function(d,i){
            return two;
        })
        .attr('y2',function(d,i){
            return two;
        })
        .style({
            stroke : linecolor[2],
            'stroke-width': 2
        });

    var legendLine = svg.append('line')
        .attr('x1', 45)
        .attr('x2', 80)
        .attr('y1',function(d,i){
            return three;
        })
        .attr('y2',function(d,i){
            return three;
        })
        .style({
            stroke : linecolor[3],
            'stroke-width': 2
        });
    var legendLine = svg.append('line')
        .attr('x1', 45)
        .attr('x2', 80)
        .attr('y1',function(d,i){
            return four;
        })
        .attr('y2',function(d,i){
            return four;
        })
        .style({
            stroke : linecolor[4],
            'stroke-width': 2
        });

    var legendLine = svg.append('line')
        .attr('x1', 45)
        .attr('x2', 80)
        .attr('y1',function(d,i){
            return five;
        })
        .attr('y2',function(d,i){
            return five;
        })
        .style({
            stroke : linecolor[5],
            'stroke-width': 2
        });
    var legendLine = svg.append('line')
        .attr('x1', 45)
        .attr('x2', 80)
        .attr('y1',function(d,i){
            return six;
        })
        .attr('y2',function(d,i){
            return six;
        })
        .style({
            stroke : linecolor[6],
            'stroke-width': 2
        });

    var legendLineText = svg.append('text')
            .attr('x', 95)
            .attr('y', first +5)
            .text("1");

    var legendLineText = svg.append('text')
            .attr('x', 95)
            .attr('y', two +5)
            .text("2");
    var legendLineText = svg.append('text')
            .attr('x', 95)
            .attr('y', three +5)
            .text("3");

    var legendLineText = svg.append('text')
            .attr('x', 95)
            .attr('y', four +5)
            .text("4");

    var legendLineText = svg.append('text')
            .attr('x', 95)
            .attr('y', five +5)
            .text("5");

    var legendLineText = svg.append('text')
            .attr('x', 95)
            .attr('y', six +5)
            .text("6");
</script>