<div class="page-header">
  <h1>Customer Segmentation <small>Filter and Sort</small></h1>
</div>
<div class="container-fluid">
      <div class="row-fluid">
        <div class="span4">
          <div class="well well-small sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Park</li>
                <select class="span12 filter" id="parks">
                    <option value="Any">Any</option>
                </select>
              <li class="nav-header">Gender</li>
                <select class="span12 filter" id="gender">
                  <option value="Any">Any</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
              <li class="nav-header">Age</li>
                <input id="minAge" type="text" class="input-mini tbox" placeholder="MIN"> <i class="icon-minus"></i> <input id="maxAge" type="text" class="input-mini tbox" placeholder="MAX">
              <li class="nav-header">Recency</li>
                <input id="minRec"  type="text" class="input-mini tbox" placeholder="MIN"> <i class="icon-minus"></i> <input id="maxRec" type="text" class="input-mini tbox" placeholder="MAX">
              <li class="nav-header">Programs</li>
              <div class="row-fluid">
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="aquatics"> Aquatics
                  </label>
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="school"> After School
                  </label>
              </div>
              <div class="row-fluid">
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="camps"> Camps
                  </label>
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="interests"> Special Interests
                  </label>
              </div>
              <div class="row-fluid">
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="arts"> Culture & Arts
                  </label>
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="recreation"> Special Recreation
                  </label>
              </div>
              <div class="row-fluid">
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="child"> Early Childhood
                  </label>
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="sports"> Sports
                  </label>
              </div>
              <div class="row-fluid">
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="event"> General Event
                  </label>
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="wellness"> Wellness
                  </label>
              </div>
              <div class="row-fluid">
                  <label class="checkbox span6">
                      <input type="checkbox" class="target" id="nature"> Nature
                  </label>
              </div>
              <hr>
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
              <li class="nav-header"><br/></li>
              <li class="nav"><button type="button" id="submit" class="span12 btn btn-primary btn-small">Submit</button></li>
              <li class="nav-header"><br/></li>
              <li class="nav"><button type="button" class="span12 btn btn-danger btn-small"><i class="icon-envelope icon-white"></i>  Email List &raquo;</button></li>
              <li class="nav-header"><br/></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span8">
          <div class="row-fluid" id="Table">
            <div class="span12" id="table_div"></div>
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->
    </div><!--/.fluid-container-->
    <hr>