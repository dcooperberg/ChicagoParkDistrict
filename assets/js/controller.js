/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function navScripts(val,data,parkdata){
    $("#main-container").load(val+".php", function(responseTxt,statusTxt,xhr){
        if(statusTxt=="success"){
          if (val == "home"){
            
            $(".btn").click(function(){
                if (this.id == "perc"){
                    $("#perc").removeClass("btn-inverse").addClass("btn-inverse");
                    $("#tot").removeClass("btn-inverse");
                } else {
                    $("#tot").removeClass("btn-inverse").addClass("btn-inverse");
                    $("#perc").removeClass("btn-inverse");
                }
            })
            var years = parkdata.getDistinctValues(1);
            var yrct = 0;
            $.each(years, function(val, text) {
                $("#year").append( $('<option></option>').val(val).html(text) )
                yrct++;
            });
            var curDate = new Date();
            var delay = 0;
            var seasPush = 0;
            if (curDate.getMonth() < 1){
                seasPush = 0;
            } else if (curDate.getMonth() < 4){
                seasPush = 1;
            } else if (curDate.getMonth() < 8){
                seasPush = 2;
            } else if (curDate.getMonth() < 11){
                seasPush = 3;
            } else {
                seasPush = 0;
                delay++;
            }
            //Remove after Presentation
            //seasPush = 3;
            //delay = 1;
            for (var i=0;i<seasPush;i++){
                $("#season").find('option:selected', 'select').removeAttr('selected').next('option').attr('selected', 'selected');
            }
            for (var i=0;i<yrct-1+delay;i++){
                $("#year").find('option:selected', 'select').removeAttr('selected').next('option').attr('selected', 'selected');
            }
            $(".preselect").change(function(){
                season = $("#season option:selected").text();
                year = $("#year option:selected").text();
                map = loadmap(parkdata,season,parseInt(year),map.getZoom(),map.getCenter());
            })
            var season = $("#season option:selected").text();
            var year = $("#year option:selected").text();
            var map = loadmap(parkdata,season,parseInt(year),10,new google.maps.LatLng(41.850233,-87.638532));
            var mapR = $("#map_canvas").position();
            $("#map_legend").css('left',mapR.left+275);
            $("#map_legend").css('top',mapR.top+335);
            $("#mapFilters").css('left',mapR.left+30);
            $("#mapFilters").css('top',mapR.top+5);
            $(window).resize(function(){
                mapR = $("#map_canvas").position();
                $("#map_legend").css('left',mapR.left+275);
                $("#map_legend").css('top',mapR.top+335);
                $("#mapFilters").css('left',mapR.left+30);
                $("#mapFilters").css('top',mapR.top+5);
            })
          } else if (val == "parks") {
              $("#all").change(function(){
                  var bool = this.checked
                  $("input[type=checkbox]").each(function () {
                      if (this.id != "all"){
                          if (bool == false){
                              if (this.checked){
                                  this.checked = false;
                              }
                          } else {
                              if (this.checked == false){
                                  this.checked = true;
                              }
                          }
                      }
                  });
              })
              $(".reset").click(function(){
                  var rows = ["parks","comms","areas","regions","seasons","years"];
                  if (this.id == "rReset"){
                      rightData = parkdata;
                      //removeOptions('#','r')
                      var ii = 0;
                      $.each(rows,function(){
                          $("#"+rows[ii]+"r").find("option").each(function(){
                              if ($(this).text() != "Any"){
                                  $(this).remove();
                              }
                          })
                          ii++
                      })
                      loadMenus(rightData,'#','r');
                  } else {
                      leftData = parkdata;
                      //removeOptions('#','l')
                      var ii = 0;
                      $.each(rows,function(){
                          $("#"+rows[ii]+"l").find("option").each(function(){
                              if ($(this).text() != "Any"){
                                  $(this).remove();
                              }
                          })
                          ii++
                      })
                      loadMenus(leftData,'#','l');
                  }
                  
                  var bardata = barData2(leftData,rightData,groups);
                  if (gType == "Percentage"){
                        barChart.draw(bardata, pOptions);
                    } else {
                        barChart.draw(bardata, tOptions);
                    }
              })
              var gType = $(".btn-inverse").text();
                $(".switch").click(function(){
                    if (this.id == "perc"){
                        $("#perc").removeClass("btn-inverse").addClass("btn-inverse");
                        $("#tot").removeClass("btn-inverse");
                    } else {
                        $("#tot").removeClass("btn-inverse").addClass("btn-inverse");
                        $("#perc").removeClass("btn-inverse");
                    }
                    gType = $(".btn-inverse").text();
                    bardata = barData2(leftData,rightData,groups);
                    if (gType == "Percentage"){
                        barChart.draw(bardata, pOptions);
                    } else {
                        barChart.draw(bardata, tOptions);
                    }
                })
              
              function removeOptions(c,side){
                  var rows = ["parks","comms","areas","regions","seasons","years"];
                  for (var i=0;i<rows.length;i++){                      
                      $(c+rows[i]+side).find('option').each(function(){
                          if ($(this).text() != "Any"){
                            $(this).remove();
                          }
                      })
                  }
              }
              //Load options
              function loadMenus(parkdata,c,side){
                  var rows = ["parks","comms","areas","regions","seasons","years"];
                  var parks = parkdata.getDistinctValues(11);
                  var comms = parkdata.getDistinctValues(8);
                  var areas = parkdata.getDistinctValues(6);
                  var regions = parkdata.getDistinctValues(5);
                  var seasons = parkdata.getDistinctValues(2);
                  var years = parkdata.getDistinctValues(1);
                  var cols = [parks,comms,areas,regions,seasons,years]
                  for (var i=0;i<rows.length;i++){
                      $.each(cols[i], function(val, text) {
                          $(c+rows[i]+side).append( $('<option></option>').val(val).html(text) )
                      });
                      if (cols[i].length == 1){
                          $(c+rows[i]+side).find('option:selected', 'select').removeAttr('selected').next('option').attr('selected', 'selected');
                      }
                  } 
              }
              loadMenus(parkdata,'.','');
              
              //create bar chart for both charts
              var pOptions = {
                  title: 'Enrollment Utilization',
                  height: 340,
                  legend: {position: 'top', alignment:'end'},
                  colors: ['#49afcd','#da4f49'],
                  chartArea: {left:50,top:40,width:"100%",height:"67%"},
                  //theme: 'maximized',
                  vAxis: {format:'#%', minValue: 0, maxValue: 1, titleTextStyle: {color: 'red'}},
                  hAxis: {titleTextStyle: {color: 'red'}, showTextEvery: 1, slantedText: true, slantedTextAngle: 30}
              };
              var tOptions = {
                  title: 'Total Enrollment',
                  height: 340,
                  legend: {position: 'top', alignment:'end'},
                  colors: ['#49afcd','#da4f49'],
                  chartArea: {left:50,top:40,width:"100%",height:"67%"},
                  //theme: 'maximized',
                  vAxis: {format:'#,###', minValue: 0, titleTextStyle: {color: 'red'}},
                  hAxis: {titleTextStyle: {color: 'red'}, showTextEvery: 1, slantedText: true, slantedTextAngle: 30}
              };
              var curDate = new Date();
              var yrct = 0;
              $("#yearsr").find("option").each(function(){
                  yrct++;
              })
              
              var seas = 0;
              var del = 0;
            if (curDate.getMonth() < 1){
                seas = 4;
            } else if (curDate.getMonth() < 4){
                seas = 2;
            } else if (curDate.getMonth() < 8){
                seas = 3;
            } else if (curDate.getMonth() < 11){
                seas = 1;
            } else {
                seas = 4;
                del++;
            }
            //Remove after presentation
            //seas = 1;
            //del = -1;
              
              $("#seasonsr").val(seas.toString());
              $("#yearsr").val((yrct-2+del).toString());
              
              var index = [11,8,6,5,2,1];
              var masterGroups=["Aquatics","Camps","Sports","Wellness","General Event","Nature","Culture and Arts","Early Childhood","Out of School Time","Special Interests","Special Recreation"];
              var groups = masterGroups;
              var leftData = parkdata;
              var str = "";
              $(".rightF option:selected").each(function () {
                  str += $(this).text() + "|";
              });
              var rightData = getSubset2(parkdata,str,index);
              var bardata = barData2(leftData,rightData,groups);
              var barChart = new google.visualization.ColumnChart(document.getElementById('barChart'));
              if (gType == "Percentage"){
                    barChart.draw(bardata, pOptions);
                } else {
                    barChart.draw(bardata, tOptions);
                }
              
              //On filter change update chart
              $(".checkbox").change(function(){
                  var str = "";
                  $("input[type=checkbox]").each(function () {
                      if (this.id != "all"){
                          if (this.checked){
                              str += "1|";
                          } else {
                              $("#all").each(function(){
                                  this.checked = false;
                              })
                              str += "0|";
                          }
                      }
                      
                  });
                  if(str == "1|1|1|1|1|1|1|1|1|1|1|"){
                      $("#all").each(function(){
                          this.checked = true;
                      })
                  }
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
                  if (gType == "Percentage"){
                        barChart.draw(bardata, pOptions);
                    } else {
                        barChart.draw(bardata, tOptions);
                    }
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
                  if (gType == "Percentage"){
                        barChart.draw(bardata, pOptions);
                    } else {
                        barChart.draw(bardata, tOptions);
                    }
                    //removeOptions('#','l')
                    //loadMenus(leftData,'#','l');
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
                  if (gType == "Percentage"){
                        barChart.draw(bardata, pOptions);
                    } else {
                        barChart.draw(bardata, tOptions);
                    }
                    //removeOptions('#','r')
                    //loadMenus(rightData,'#','r');
              });
              
          } else if (val == "customers") {
              var curData = data;
              //email list           
              $("#getemail").click(function(){
                  curData.sort(col);
                  var list = "";
                  var link = "";
                  var count = 0;
                  for (var i=0;i<curData.getNumberOfRows();i++){
                      if (curData.getValue(i,col) != ""){
                          if (curData.getValue(i,3) != curData.getValue(i-1,col)){
                              list += curData.getValue(i,col)+",<br/>";
                              link += curData.getValue(i,col).replace(" ","")+",";
                              count++;
                          }
                      }
                  }
                  var limit = 2000
                  if (count < limit){
                    window.location = "mailto:"+link;
                  } else {
                      alert("Email list is too long ("+count+"). List must contain fewer than "+limit+" entries.\n\nPlease provide additional filters");
                  }
                  curData.sort(0);
              })
              
              //Populate Park Filter
              $('#minimize').click(function(){
                  $("#filterwell").animate({opacity:1,height:20}, 750, function() {
                      
                  });
                  $('#max_div').show();
                  $('#filters').hide();
                  return false;
              })
              $('#maximize').click(function(){
                  $('#max_div').hide();
                  $('#filters').show();
                  $("#filterwell").animate({opacity:1,height:195}, 750, function() {
                      
                  });
                  return false;
              })
              
              var parks = parkdata.getDistinctValues(11);
              $.each(parks, function(val, text) {
                $('#parks2').append( $('<option></option>').val(val).html(text) )
                });
                
              var heads = [17,5,4,4,21,21,6,12,7,13,8,14,9,15,10,16,11];
              curData = drawTable(data,'table_div');
              var col = -1;
              for (var i=0;i<curData.getNumberOfColumns();i++){
                  if (curData.getColumnLabel(i) == "Email Address"){
                      col = i;
                  }
              }
              if (col < 0){
                  $(".btn-info").addClass("disabled");
              }
              
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
                  curData = drawTable(tempData,'table_div');
              });
              function reset(){
                  $('#gender').val("Any");
                  $('#parks2').val("Any");
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
                      $('#child').attr('checked', true);
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
          alert("Error: "+xhr.status+": "+xhr.statusText);
        }
    });
}


