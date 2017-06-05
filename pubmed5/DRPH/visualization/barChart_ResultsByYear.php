<script>
            var myData = <?php echo json_encode($amount); ?>;

            var margin = {
                top :30,
                right : 80,
                bottom:40,
                left:150
            }
            var height = 300-margin.top - margin.bottom;
            var width = 400 - margin.right - margin.left;
            var animateDuration = 700;
            var animateDelay = 30;

            var tooltip = d3.select('#relationshipChart').append('div')
                .style('position','absolute')
                .style('background','#f4f4f4')
                .style('padding','5 15px')
                .style('border','1px #333 solid')
                .style('border-radius','5px')
                .style('opacity','0');

            var yScale = d3.scale.linear()
                .domain([0,d3.max(myData)])
                .range([0,height]);
            
            var xScale = d3.scale.ordinal()
                .domain(d3.range(0,myData.length))
                .rangeBands([0,width]);
            
            var colors = d3.scale.linear()
                .domain([0,myData.length])
                .range(['#E0E0E0','#C0C0C0']);
            
            var myChart = d3.select('#relationshipChart').append('svg')
                            .attr('width',width + margin.left + margin.right)
                            .attr('height',height + margin.top + margin.bottom)
                            .append('g')
                            .attr('transform', 'translate('+margin.left + ',' + margin.top +')')
                            .style('barkground','#f4f4f4')
                            .selectAll('rect')
                                .data(myData)
                                .enter().append('rect')
                                    .style('fill', function(d, i){
                                        return colors(i);
                                    })
                                    .attr('width',xScale.rangeBand())
                                    .attr('height',0)
                                    .attr('x',function(d,i){
                                        return xScale(i);
                                    })
                                    .attr('y',height)
                            .on('mouseover', function(d){
                                tooltip.transition()
                                    .style('opacity',1)
                                
                                tooltip.html(d)
                                    .style('left', (d3.event.pageX) + 'px')
                                    .style('top', (d3.event.pageY) + 'px')
                                d3.select(this).style('opacity',0.5)

                            })
            
                            .on('mouseout', function(d){
                                tooltip.transition()
                                    .style('opacity',0)
                                d3.select(this).style('opacity',1)
                            });
            
            myChart.transition()
                .attr('height', function(d){
                    return yScale(d);
                })
                .attr('y',function(d){
                    return height - yScale(d)
                })
                .duration(animateDuration)
                .delay(function(d, i){
                    return i * animateDelay;
                })
                .ease('elastic');
            
            
            var vScale = d3.scale.linear()
                .domain([0,d3.max(myData)])
                .range([height,0]);
            
            var hScale = d3.scale.ordinal()
                .domain(d3.range(2014,2014+myData.length))
                .rangeBands([0,width]);
            
            
            var vAxis = d3.svg.axis()
                .scale(vScale)
                .orient('left')
                .ticks(5)
                .tickPadding(5)
            
            var vGuide = d3.select('svg')
                .append('g')
                    vAxis(vGuide)
                    vGuide.attr('transform', 'translate('+margin.left+','+margin.top+')')
                    vGuide.selectAll('path')
                        .style('fill','none')
                        .style('stroke','#000')
                    vGuide.selectAll('line')
                        .style('stroke', '#000');
            
            
            var hAxis = d3.svg.axis()
                .scale(hScale)
                .orient('bottom')
                .tickValues([2014,2015,2016,2017]);
            
      
            var hGuide = d3.select('svg')
                .append('g')
                    hAxis(hGuide)
                    hGuide.attr('transform', 'translate('+margin.left+','+(height + margin.top)+')')
                    hGuide.selectAll('path')
                        .style('fill','none')
                        .style('stroke','#000')
                    hGuide.selectAll('line')
                        .style('stroke', '#000');
            
            
            var titleData = "Results by Year"
            var title = myChart.selectAll('.title')
                .data(titleData)
                .enter()
                .append('text')
                .attr('x', 850)
                .attr('y', 500)
                .text("Results By Year");
        
            </script>