<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container-fluid">
    <div class="hero-unit">
            <h2>Customer Segmentation</h2>
            <p>By analyzing customer behavioral and demographic data, customers can 
            be grouped based on similar qualities. This unsupervised learning technique 
            can be used to identify customers who need additional outreach and can be 
            helpful in determining targeted marketing strategies.</p>
    </div>
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Age</li>
                <select class="target" id="ages">
                  <option value="children">Children</option>
                  <option value="adult">Adults</option>
                </select>
              <li class="nav-header">Recency</li>
                <select class="target" id="recency">
                  <option value="any">Any</option>
                  <option value="year"><?php echo (date("Y")-1) ?> to Present</option>
                  <option value="season">Last Season</option>
                </select>
              <li class="nav-header">Program Cluster</li>
                <select class="target" id="programs">
                  <option value="any">Any</option>
                  <option value="after">After Schoolers</option>
                  <option value="weekend">Weekenders</option>
                  <option value="early">Early Childhood</option>
                  <option value="sports">Sports Lovers</option>
                  <option value="summer">Summer Campers</option>
                </select>
              <li class="nav-header">Loyalty Cluster</li>
                <select class="target" id="loyalty">
                  <option value="volvo">Any</option>
                  <option value="parkies">Parkies</option>
                  <option value="deals">Deal Seekers</option>
                  <option value="occ">Occasionals</option>
                </select>
              <li class="nav-header">Category</li>
                <select class="target">
                  <option value="volvo">Option1</option>
                  <option value="saab">Option2</option>
                  <option value="mercedes">Option3</option>
                  <option value="audi">Option4</option>
                </select>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="row-fluid" id="Pro">
            <div class="span5" id="pie_div">
              <p class='spinner' style='text-align:center;top:100px;position:relative'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
            </div><!--/span-->
            <div class="span7 description">
              <h2>Program Participation</h2>
              <p>Customers prefer to participate in specific types of programs. 
              By analyzing registration history by program type, season, and age range,
              customers are placed in any of six Programs clusters. Scroll over to 
              read a description of each cluster.</p>
            </div><!--/span-->
          </div><!--/row-->
          <div class="row-fluid" id="Loy">
            <div class="span7">
              <h2>Park District Loyalty</h2>
              <p>By analyzing the frequency and recency of a customer's participation, 
              it is possible to understand how likely a customer is to continue 
              participating in CPD programs. Combined further with the number of programs 
              a customer enrolls in and the diversity of those programs, several interesting clusters emerged.</p>
            </div><!--/span-->
            <div class="span5" id="pie_div2">
              <p class='spinner' style='text-align:center;top:100px;position:relative'><img style='top:50px;height:50px' src='assets/img/spinner.gif'></p>
            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->
    </div><!--/.fluid-container-->
<script type="text/javascript">
  $(".hero-unit").click(function(){
      $(".hero-unit").animate({opacity:0,height:0}, 750, function() {
          $(this).remove();
      });
      return false;
  });
  $(".target").change(function(){
      var choice = $(this).find("option:selected").text();

      //transform data

      var pieoptions = {
        title: 'Programs',
        legend: {position:'none'},
        height: '250',
        sliceVisibilityThreshold: 1/720,
        tooltip: {trigger: 'none'}
      }
      drawPie(clusData,'pie_div',pieoptions);
  });
  
</script>