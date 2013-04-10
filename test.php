<?php
include 'GetData.php';
include 'visualizations.php';
$data = colRange(rowRange(getData("testdata.csv"),1,1000),0,7);
$file = fopen("data.csv", "w");
$arr = array();
array_push($arr,array("race","population"));
$vals = array(0,0,0);
for ($i=5; $i<count($data[0]);$i++){
    $temp = array();
    for ($j=1; $j<count($data); $j++){
        $vals[$i-5] = $vals[$i-5] + $data[$j][$i];
    }
    array_push($arr,array($data[0][$i],$vals[$i-5]));
}
for ($k=0;$k<count($arr);$k++){
    fputcsv($file,$arr[$k]);
}
fclose($file);
?>
<?php
/*$file = fopen("data.csv", "w");
$table = array();
for ($i=0;$i<count($data);$i++){
    $arr = array();
    $var = 0.02;
    $val = "";
    for ($j=0;$j<count($data[$i]);$j++){
        if ($i > 0){
            if ($j == 2){
                if (intval($data[$i][$j]) == -1){
                    array_push($arr,"male");
                } elseif (intval($data[$i][$j]) == 1){
                    array_push($arr,"female");
                } else {
                    array_push($arr,"unknown");
                }
            } elseif ($j > 4){
                if (floatval($data[$i][$j]) > $var){
                    $var = floatval($data[$i][$j]);
                    $val = $data[0][$j];
                }
                if ($j = 7){
                    array_push($arr,$val);
                }
            } else {
                array_push($arr,$data[$i][$j]);
            }
        } elseif ($j<5) {
             array_push($arr,$data[$i][$j]);
        } elseif ($j==5) {
            array_push($arr,"race");
        }
    }
    fputcsv($file,$arr);
}
fclose($file);*/
?>
<!--<!DOCTYPE html>
<meta charset="utf-8">
<style>

body {
  font: 10px sans-serif;
}

.arc path {
  stroke: #fff;
}

</style>
<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
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

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

d3.csv("data.csv", function(error, data) {

  data.forEach(function(d) {
    d.population = +d.population;
  });

  var g = svg.selectAll(".arc")
      .data(pie(data))
    .enter().append("g")
      .attr("class", "arc");

  g.append("path")
      .attr("d", arc)
      .style("fill", function(d) { return color(d.data.race); });

  g.append("text")
      .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
      .attr("dy", ".35em")
      .style("text-anchor", "middle")
      .text(function(d) { return d.data.race; });

});

</script>-->



<!DOCTYPE html>
<meta charset="utf-8">
<style>

body {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.dot {
  stroke: #000;
}

</style>
<body>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script>

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var x = d3.scale.linear()
    .range([0, width]);

var y = d3.scale.linear()
    .range([height, 0]);

var color = d3.scale.category10();

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

d3.csv("data.csv", function(error, data) {
  data.forEach(function(d) {
    d.age_guess = +d.age_guess;
    d.income = +d.income;
  });

  x.domain(d3.extent(data, function(d) { return d.age_guess; })).nice();
  y.domain(d3.extent(data, function(d) { return d.income; })).nice();

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis)
    .append("text")
      .attr("class", "label")
      .attr("x", width)
      .attr("y", -6)
      .style("text-anchor", "end")
      .text("Age");

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("class", "label")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Income")

  svg.selectAll(".dot")
      .data(data)
    .enter().append("circle")
      .attr("class", "dot")
      .attr("r", 3.5)
      .attr("cx", function(d) { return x(d.age_guess); })
      .attr("cy", function(d) { return y(d.income); })
      .style("fill", function(d) { return color(d.gender_guess); });

  var legend = svg.selectAll(".legend")
      .data(color.domain())
    .enter().append("g")
      .attr("class", "legend")
      .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

  legend.append("rect")
      .attr("x", width - 18)
      .attr("width", 18)
      .attr("height", 18)
      .style("fill", color);

  legend.append("text")
      .attr("x", width - 24)
      .attr("y", 9)
      .attr("dy", ".35em")
      .style("text-anchor", "end")
      .text(function(d) { return d; });

});

</script>