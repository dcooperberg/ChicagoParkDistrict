<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
    <h1>Welcome to CPD's Analytics Portal!</h1>
    <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
</div>

<!-- Example row of columns -->
<script>

var width = 250,
    height = 250,
    radius = Math.min(width, height) / 2;

var color = d3.scale.ordinal()
    .range(["#a05d56", "#d0743c", "#ff8c00"]);

var arc = d3.svg.arc()
    .outerRadius(radius - 10)
    .innerRadius(0);

var pie = d3.layout.pie()
    .sort(null)
    .value(function(d) { return d.population; });

var svg = d3.select("d3div").append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
<?php
/*include 'GetData.php';
        include 'visualizations.php';
$data = colRange(rowRange(getData("testdata.csv"),1,1000),0,7);*/
$file = fopen("temp.csv", "w");
fwrite($file,"race, percentage\n");
$vals = array(0,0,0);
for ($i=5; $i<count($data[0]);$i++){
    for ($j=1; $j<count($data); $j++){
        $vals[$i-5] = $vals[$i-5] + $data[$j][$i];
    }
    fwrite($file,strtoupper($data[0][$i]).",".$vals[$i-5]);
    if ($i < count($data[0])-1){
        fwrite($file,"\n");
    }
}
fclose($file);
?>
d3.csv("temp.csv", function(error, data) {

  data.forEach(function(d) {
    d.population = +d.population;
  });

  var g = svg.selectAll(".arc")
      .data(pie(data))
    .enter().append("g")
      .attr("class", "arc");

  g.append("path")
      .attr("d", arc)
      .style("fill", function(d) { return color(d.data.age); });

  g.append("text")
      .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
      .attr("dy", ".35em")
      .style("text-anchor", "middle")
      .text(function(d) { return d.data.age; });

});
</script>
