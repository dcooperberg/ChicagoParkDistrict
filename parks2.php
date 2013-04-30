<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="page-header">
  <h1>Park Utilization <small>Filter and Compare</small></h1>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="span3 well well-small sidebar-nav" id="leftFilters">
                <ul class="nav nav-list">
                    <li class="nav-header">Park</li>
                        <select class="span12 leftF parks" id="parksl">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Community Area</li>
                        <select class="span12 leftF comms" id="commsl">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">CPD Area</li>
                        <select class="span12 leftF areas" id="areasl">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Region</li>
                        <select class="span12 leftF regions" id="regionsl">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Season</li>
                        <select class="span12 leftF seasons" id="seasonsl">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Year</li>
                        <select class="span12 leftF years" id="yearsl">
                            <option value="Any">Any</option>
                        </select>
                    <hr>
                    <li class="nav"><button type="button" class="span12 btn btn-info btn-small">Export Data</button></li>
              
                </ul>
            </div>
            <div class="span6">
                <div class="row-fluid" id="barChart">
                </div>
                <hr>
                <div class="row-fluid" id="groups1">
                    <div class="span3">
                        <label class="checkbox" id="aquatics">
                            <input type="checkbox" checked> Aquatics
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="camps">
                            <input type="checkbox" checked> Camps
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="sports">
                            <input type="checkbox" checked> Sports
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="wellness">
                            <input type="checkbox" checked> Wellness
                        </label>
                    </div>
                </div>
                <div class="row-fluid" id="groups2">
                    <div class="span3">
                        <label class="checkbox" id="general">
                            <input type="checkbox" checked> General Event
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="nature">
                            <input type="checkbox" checked> Nature
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="arts">
                            <input type="checkbox" checked> Culture and Arts
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="early">
                            <input type="checkbox" checked> Early Childhood
                        </label>
                    </div>
                    
                </div>
                <div class="row-fluid" id="groups">
                    <div class="span3">
                        <label class="checkbox" id="school">
                            <input type="checkbox" checked> Out of School Time
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="interests">
                            <input type="checkbox" checked> Special Interests
                        </label>
                    </div>
                    <div class="span3">
                        <label class="checkbox" id="recreation">
                            <input type="checkbox" checked> Special Recreation
                        </label>
                    </div>
                </div>
            </div>
            <div class="span3 well well-small sidebar-nav" id="rightFilters">
                <ul class="nav nav-list">
                    <li class="nav-header">Park</li>
                        <select class="span12 rightF parks" id="parksr">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Community Area</li>
                        <select class="span12 rightF comms" id="commsr">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">CPD Area</li>
                        <select class="span12 rightF areas" id="areasr">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Region</li>
                        <select class="span12 rightF regions" id="regionsr">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Season</li>
                        <select class="span12 rightF seasons" id="seasonsr">
                            <option value="Any">Any</option>
                        </select>
                    <li class="nav-header">Year</li>
                        <select class="span12 rightF years" id="yearsr">
                            <option value="Any">Any</option>
                        </select>
                    <hr>
                    <li class="nav"><button type="button" class="span12 btn btn-danger btn-small">Export Data</button></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<hr>