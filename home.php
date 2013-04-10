<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
    <h2>Welcome to CPD's Analytics Portal!</h2>
    <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
</div>
<div class="viz container" id="homediv">
        <div id="chart_div" class="span4">
        </div>
        <div id="scatter_div" class="span4">
        </div>
        <div id="pie_div" class="span4">
        </div>
    </div>

<!-- Example row of columns 
<script>

var width = 250,
    height = 250,
    radius = Math.min(width, height) / 2;

var color = d3.scale.category20c();

var arc = d3.svg.arc()
    .outerRadius(radius - 10)
    .innerRadius(0);

var pie = d3.layout.pie()
    .sort(null)
    .value(function(d) { return d.population; });

var svg = d3.select("#pie_div").append("svg")
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
