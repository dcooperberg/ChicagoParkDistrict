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

<div id="chart_div" class="span4" style="height:250px">
    <p class="spinner" style='text-align:center;top:100px;position:relative'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
</div>
<div id="scatter_div" class="span4" style="height:250px">
    <p class="spinner" style='text-align:center;top:100px;position:relative'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
</div>
<div id="pie_div" class="span4" style="height:250px">
    <p class="spinner" style='text-align:center;top:100px;position:relative'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
</div>

<script type="text/javascript">
    $(".hero-unit").click(function(){
        $(".hero-unit").animate({opacity:0,height:0}, 750, function() {
            $(this).remove();
        });
        return false;
  });
</script>

<!-- Example row of columns -->
