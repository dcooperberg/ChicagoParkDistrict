
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!-- Main hero unit for a primary marketing message or call to action -->
<div class="hero-unit">
    <h2>Market Basket Analysis</h2>
    <p>By analyzing the program types that each customer enrolls in, CPD can find cusomters who may interested in new program offerings and underperforming programs. Association rules can also be used to recommend additional programs to customers to increase their involvement in CPD programs.</p>
</div>
<div class="row-fluid" style="height:250px">
    <div id="left_div" class="span5" style="text-align:center">
        <div><h2>Left Side</h2></div>
        <ul class="nav nav-list">
              <li class="nav-header">Subgroup 1</li>
                <select class="target2" name="left1">
                    <option value="null"></option>
                </select>
              <li class="nav-header">Subgroup 2</li>
                <select class="target2" name="left2">
                    <option value="null"></option>
                </select>
        </ul>
    </div>
    <div id="arrow" class="span2" style="text-align:center;padding-top: 8%">
        <p style="font-size:150px">&rarr;</p>
    </div>
    <div id="right_div" class="span5" style="text-align:center">
        <div><h2>Right Side</h2></div>
        <ul class="nav nav-list">
              <li class="nav-header">Subgroup Result</li>
                <select class="target2" name="right">
                    <option value="null"></option>
                </select>
              <li class="nav-header"><br/></li>
              <li><center><a href="" class="btn btn-primary btn-small" style="width:175px"><i class="icon-envelope icon-white"></i> Get Email List &raquo;</a></center></li>
        </ul>
    </div>
</div>
<div class="row-fluid">
    <div id="stat_div" class="span4" style="height:250px">
        <table class="table table-hover">
            <tbody>
            <tr class="error">
                <td>Support:</td>
                <td>0.03%</td>
            </tr>
            <tr class="warning">
                <td>Confidence:</td>
                <td>5.7%</td>
            </tr>
            <tr class="success">
                <td>Lift:</td>
                <td>2.56</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="scatter_div" class="span4" style="height:250px">
        
    </div>
    <div id="pie_div" class="span4" style="height:250px">
        
    </div>
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

