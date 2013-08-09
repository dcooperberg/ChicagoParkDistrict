<div class="page-header">
  <h1>Customer Segmentation <small>Filter and Sort</small></h1>
</div>
<div class="container-fluid" id="full">
    
      <div class="well well-small sidebar-nav" id="filterwell">
          <div class="span11" id ="max_div" style="display:none">
              <p class="pull-right" id="maximize"><i class="icon-plus-sign"></i></p>
          </div>
          <div class="row-fluid" id="filters">
          <div class="span3">
              <ul class="nav nav-list">
                  <li class="nav-header">Preselected Filters</li>
                        <select class="span12 preselect" id="clusters">
                            <option value="any">Any</option>
                            <option value="after">After Schoolers</option>
                            <option value="early">Early Childhood</option>
                            <option value="summer">Summer Campers</option>
                            <option value="all">All-Arounders</option>
                            <option value="sports">Sports Lovers</option>
                            <option value="water">Water Lovers</option>
                        </select>
                  <li class="nav-header">Park</li>
                    <select class="span12 filter" id="parks2">
                        <option value="Any">Any</option>
                    </select>
                  <li class="nav-header">Gender</li>
                        <select class="span12 filter" id="gender">
                          <option value="Any">Any</option>
                          <option value="M">Male</option>
                          <option value="F">Female</option>
                        </select>
              </ul>
                
          </div>
          <div class="span3">
              <ul class="nav nav-list">
                    <li class="nav-header">Age</li>
                      <input id="minAge" type="text" class="input-mini tbox" placeholder="MIN"> <i class="icon-minus"></i> <input id="maxAge" type="text" class="input-mini tbox" placeholder="MAX">
                      <li class="nav-header">Recency</li>
                    <input id="minRec"  type="text" class="input-mini tbox" placeholder="MIN"> <i class="icon-minus"></i> <input id="maxRec" type="text" class="input-mini tbox" placeholder="MAX">
                  </ul>
          </div>
          <div class="span6">
              <div class="row-fluid">
                  <div class="span6">
                      <ul class="nav nav-list">
                            <li class="nav-header">Programs</li>
                      </ul>
                  </div>
                  <div class="span6">
                      <p class="pull-right" id="minimize"><i class="icon-minus-sign"></i></p>
                  </div>
              </div>
              <div class="row-fluid">
                  <div class="span6">
                      <ul class="nav nav-list">
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="aquatics"> Aquatics
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="school"> After School
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="camps"> Camps
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="interests"> Special Interests
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="arts"> Culture & Arts
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="recreation"> Special Recreation
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="child"> Early Childhood
                      </label>
                      </li>
                  </ul>
                  </div>
                  <div class="span6">
                  <ul class="nav nav-list">
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="sports"> Sports
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="event"> General Event
                      </label>
                          </li>
                          <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="wellness"> Wellness
                      </label>
                      </li>
                      <li>
                      <label class="checkbox">
                          <input type="checkbox" class="target" id="nature"> Nature
                      </label>
                      </li>
                    <button type="button" id="submit" class="span12 btn btn-primary btn-small" style="margin-bottom:10px">Submit</button>
                    <button type="button" id="getemail" class="span12 btn btn-info btn-small">Email List &raquo;</button>
                    <!--<li class="nav-header"><br/></li>
                    <button type="button" class="span12 btn btn-danger btn-small"><i class="icon-envelope icon-white"></i>  Email List &raquo;</button>-->
                  </ul> 
                  </div>
              </div>
          </div>
          </div>
      </div><!--/row-->
      <div class="row-fluid" id="Table">
          <div class="span12" id="table_div"></div>
      </div><!--/row-->
    </div><!--/.fluid-container-->
    