/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function navScripts(val,data,parkdata){
    $("#main-container").load(val+".php", function(responseTxt,statusTxt,xhr){
        if(statusTxt=="success"){
          if (val == "home2"){
            loadmap(parkdata,"Fall",2012);
          } else if (val == "parks3") {
              $("#leftSide").css("border-right","1px #333");
              //Load options
              var parks = parkdata.getDistinctValues(11);
              $.each(parks, function(val, text) {
                  $('.parks').append( $('<option></option>').val(val).html(text) )
              });
              var areas = parkdata.getDistinctValues(6);
              $.each(areas, function(val, text) {
                  $('.areas').append( $('<option></option>').val(val).html(text) )
              });
              var regions = parkdata.getDistinctValues(5);
              $.each(regions, function(val, text) {
                  $('.regions').append( $('<option></option>').val(val).html(text) )
              });
              var seasons = parkdata.getDistinctValues(2);
              $.each(seasons, function(val, text) {
                  $('.seasons').append( $('<option></option>').val(val).html(text) )
              });
              var years = parkdata.getDistinctValues(1);
              $.each(years, function(val, text) {
                  $('.years').append( $('<option></option>').val(val).html(text) )
              });
                
              
              //create bar chart for both charts
              var options = {
                  title: 'Utilization by Group',
                  height: 400,
                  legend: {position: 'none'},
                  vAxis: {title: 'Utilization', titleTextStyle: {color: 'red'}},
                  hAxis: {title: 'Group', titleTextStyle: {color: 'red'}, showTextEvery: 2, slantedText: true, slantedTextAngle: 90}
              };
              var bardata = barData(parkdata);
              var leftChart = new google.visualization.ColumnChart(document.getElementById('leftChart'));
              leftChart.draw(bardata, options);
              var rightChart = new google.visualization.ColumnChart(document.getElementById('rightChart'));
              rightChart.draw(bardata, options);
              
              //On filter change update chart
              
          } else if (val == "parks2") {
              //Load options
              function loadMenus(parkdata,c,side){
                  var parks = parkdata.getDistinctValues(11);
                  $.each(parks, function(val, text) {
                      $(c+'parks'+side).append( $('<option></option>').val(val).html(text) )
                  });
                  var comms = parkdata.getDistinctValues(8);
                  $.each(comms, function(val, text) {
                      $(c+'comms'+side).append( $('<option></option>').val(val).html(text) )
                  });
                  var areas = parkdata.getDistinctValues(6);
                  $.each(areas, function(val, text) {
                      $(c+'areas'+side).append( $('<option></option>').val(val).html(text) )
                  });
                  var regions = parkdata.getDistinctValues(5);
                  $.each(regions, function(val, text) {
                      $(c+'regions'+side).append( $('<option></option>').val(val).html(text) )
                  });
                  var seasons = parkdata.getDistinctValues(2);
                  $.each(seasons, function(val, text) {
                      $(c+'seasons'+side).append( $('<option></option>').val(val).html(text) )
                  });
                  var years = parkdata.getDistinctValues(1);
                  $.each(years, function(val, text) {
                      $(c+'years'+side).append( $('<option></option>').val(val).html(text) )
                  });
              }
              loadMenus(parkdata,'.','');
              
              //create bar chart for both charts
              var options = {
                  title: 'Enrollment Utilization',
                  height: 340,
                  legend: {position: 'top', alignment:'end'},
                  chartArea: {left:40,top:40,width:"100%",height:"67%"},
                  //theme: 'maximized',
                  vAxis: {format:'#%', minValue: 0, maxValue: 1, titleTextStyle: {color: 'red'}},
                  hAxis: {titleTextStyle: {color: 'red'}, showTextEvery: 1, slantedText: true, slantedTextAngle: 30}
              };
              $("#seasonsr").val("1");
              $("#yearsr").val("0");
              
              var index = [11,8,6,5,2,1];
              var masterGroups=["Aquatics","Camps","Sports","Wellness","General Event","Nature","Culture and Arts","Early Childhood","Out of School Time","Special Interests","Special Recreation"];
              var groups = masterGroups;
              var leftData = parkdata;
              var rightData = getSubset2(parkdata,"Any|Any|Any|Any|Fall|2012|",index);
              var bardata = barData2(leftData,rightData,groups);
              var barChart = new google.visualization.ColumnChart(document.getElementById('barChart'));
              barChart.draw(bardata, options);
              
              //On filter change update chart
              $(".checkbox").change(function(){
                  var str = "";
                  $("input[type=checkbox]").each(function () {
                      if (this.checked){
                          str += "1|";
                      } else {
                          str += "0|";
                      }
                  });
                  groups = new Array();
                  var temp = new Array();
                  for (var i=0;i<masterGroups.length;i++){
                      var pos = str.indexOf("|");
                      temp.push(parseInt(str.substring(0,pos)));
                      str = str.substring(pos+1);
                  }
                  for (var j=0;j<masterGroups.length;j++){
                      if (temp[j] == 1){
                          groups.push(masterGroups[j]);
                      }
                  }
                  bardata = barData2(leftData,rightData,groups);
                  barChart.draw(bardata, options);
              })
              $(".leftF").change(function(){
                  var str = "";
                  $(".leftF option:selected").each(function () {
                      str += $(this).text() + "|";
                  });
                  if (str != "Any|Any|Any|Any|Any|Any|"){
                      leftData = getSubset2(parkdata,str,index);
                  } else {
                      leftData = parkdata;
                  }
                  bardata = barData2(leftData,rightData,groups);
                  barChart.draw(bardata, options);
                  /*$(".leftF").empty();
                  $(".leftF").append( $('<option></option>').val("any").html("Any") );
                  loadMenus(parkdata,'#','l');*/
              });
              $(".rightF").change(function(){
                  var str = "";
                  $(".rightF option:selected").each(function () {
                      str += $(this).text() + "|";
                  });
                  if (str != "Any|Any|Any|Any|Any|Any|"){
                      rightData = getSubset2(parkdata,str,index);
                  } else {
                      rightData = parkdata;
                  }
                  bardata = barData2(leftData,rightData,groups);
                  barChart.draw(bardata, options);
              });
              
          } else if (val == "customers2" || val == "customers3") {
              //Populate Park Filter
              var parks = parkdata.getDistinctValues(11);
              $.each(parks, function(val, text) {
                $('#parks').append( $('<option></option>').val(val).html(text) )
                });
                
              var str = "Any|Any|0|100|0|100|false|false|false|false|false|false|false|false|false|false|false|";
              var heads = [17,5,4,4,20,20,6,12,7,13,8,14,9,15,10,16,11];
              var tableData = data;
              drawTable(data,'table_div');
              
              $(".hero-unit").click(function(){
                $(".hero-unit").animate({opacity:0,height:0}, 750, function() {
                  $(this).remove();
                });
                return false;
              });
              
              //create filter string
              
              $("#submit").click(function () {
                  var fstr = "";
                  $(".filter option:selected").each(function () {
                      fstr += $(this).text() + "|";
                  });
                  $(".tbox").each(function(){
                      fstr += $(this).val() + "|";
                  });
                  $(".target").each(function(){
                      fstr += $(this).attr('checked') + "|";
                  });
                  var tempData = getSubset(data,fstr,heads);
                  drawTable(tempData,'table_div');
              });
              function reset(){
                  $('#gender').val("Any");
                  $('#minAge').val("");
                  $('#maxAge').val("");
                  $('#minRec').val("");
                  $('#maxRec').val("");
                  $('#aquatics').attr('checked', false);
                  $('#school').attr('checked', false);
                  $('#camps').attr('checked', false);
                  $('#interests').attr('checked', false);
                  $('#arts').attr('checked', false);
                  $('#recreation').attr('checked', false);
                  $('#child').attr('checked', false);
                  $('#sports').attr('checked', false);
                  $('#event').attr('checked', false);
                  $('#wellness').attr('checked', false);
                  $('#nature').attr('checked', false);
              }
              $("#clusters").change(function () {
                  var opt = $(this).find("option:selected").text();
                  if (opt == "After Schoolers"){
                      reset();
                      $('#school').attr('checked', true);
                      $('#maxAge').val("18");
                  } else if (opt == "Early Childhood"){
                      reset();
                      $('#arts').attr('checked', true);
                      $('#early').attr('checked', true);
                      $('#sports').attr('checked', true);
                      $('#maxAge').val("18");
                  } else if (opt == "Summer Campers"){
                      reset();
                      $('#camps').attr('checked', true);
                      $('#maxAge').val("18");
                  } else if (opt == "All-Arounders"){
                      reset();
                      $('#aquatics').attr('checked', true);
                      $('#camps').attr('checked', true);
                      $('#arts').attr('checked', true);
                      $('#sports').attr('checked', true);
                      $('#maxAge').val("18");
                  } else if (opt == "Sports Lovers"){
                      reset();
                      $('#sports').attr('checked', true);
                      $('#maxAge').val("18");
                  } else if (opt == "Water Lovers"){
                      reset();
                      $('#aquatics').attr('checked', true);
                      $('#maxAge').val("18");
                  }
              })
          }
        } else if(statusTxt=="error"){
            $(".spinner").hide();
          alert("Error: "+xhr.status+": "+xhr.statusText);
        }
    });
}


