<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="page-header">
  <h1>Welcome to the Analytics Portal!</h1>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        
        <div class="span5" id="map_canvas"></div>
        <div class="span7">
            <div class="row-fluid">
                <div class="span12 page-header" id="chart_title">
                    <h1><small>Discover More About Our Parks</small></h1>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12" id="line_div" style="height: 320px">
                    <p class="lead">
                        Welcome to Chicago Park District's Analytics Portal. With this tool, you 
                        can compare park performance, identify parks 
                        that need additional attention, and obtain distribution lists 
                        specific to your needs!
                    </p>
                    <p class="lead">
                        Click around and explore. The data is updated directly from 
                        ActiveNet on a weekly basis and is constantly changing.
                    </p>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">
                </div>
                <div class="span4">
                    <div class="btn-group" id="btn-toggle" style="display:none">
                      <button class="btn btn-inverse" id="perc">Percentage</button>
                      <button class="btn" id="tot">Total</button>
                    </div>
                </div>
                <div class="span4">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mapFilters" style="position:absolute">
      <ul class="nav nav-list inline">
          <li>
            <select class="preselect" id="season" style="border:2px solid black;height:25px;margin-bottom:0px;font-size:11px">
                <option value="winter" selected>Winter</option>
                <option value="spring">Spring</option>
                <option value="summer">Summer</option>
                <option value="fall">Fall</option>
            </select>
          </li>
          <li>
            <select class="preselect" id="year" style="border:2px solid black;height:25px;margin-bottom:0px;font-size:11px">
            </select>
          </li>
      </ul>
</div>
<div id="map_legend" style="position:absolute;width:110px">
    <table class="table table-condensed table-hover table-bordered">
        <thead>
        <tr>
            <th>
                Utilization
            </th>
        </tr>
        </thead>
        <tbody>
        <tr class="success">
            <td>75-100%</td>
        </tr>
        <tr class="warning">
            <td>50-75%</td>
        </tr>
        <tr class="error">
            <td>0-50%</td>
        </tr>
        </tbody>
    </table>
</div>