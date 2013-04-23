/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function navScripts(val,data,market,parkdata){
    $("#main-container").load(val+".php", function(responseTxt,statusTxt,xhr){
        if(statusTxt=="success"){
          if (val == "contact"){
            drawTable(data,'contactdiv');
          } else if (val == "parks") {
              loadmap(parkdata);
          } else if (val == "home"){
            var pieData = raceData(data);
            var pieoptions = {
              title: 'Race Percentages',
              legend: {position:'none'},
              height: '100%',
              sliceVisibilityThreshold: 1/720,
              tooltip: {trigger: 'none'},
              legend: {position: 'bottom'}
            }
            drawPie(pieData,'pie_div',pieoptions);
            var scatData = scatterData(data,"Sports","Recency");
            var scatteroptions = {
              title: 'Recency vs. Sports',
              hAxis: {title: 'Sports Programs', minValue: 0},
              vAxis: {title: 'Recency', minValue: 0},
              legend: 'none',
              height: '100%',
              //theme: 'maximized',
              pointSize: 4,
              titlePosition: 'out'
            }
            drawScatter(scatData,'scatter_div',scatteroptions);
            var bubData=bubbleData(data,'Sports','Number of Parks');
            drawBubble(bubData,'chart_div','Sports','Number of Parks');
          } else if (val == "rules"){
              var subgroups = market.getDistinctValues(1);
              $.each(subgroups, function(val, text) {
                $('.target2').append( $('<option></option>').val(val).html(text) )
                });
          } else if (val == "segment") {
              var str = "Children|Any|Any|Any|Option1|";
              var heads = ["Age","Recency","Program Cluster","Loyalty Cluster","Other"];
              var clusData = clusterData(getSubset(data,str,heads),"Program Cluster");
              var pieoptions = {
                title: 'Programs',
                legend: {position:'none'},
                height: '250',
                sliceVisibilityThreshold: 1/720,
                tooltip: {trigger: 'none'}
              }
              drawPie(clusData,'pie_div1',pieoptions);
              var clusData2 = clusterData(getSubset(data,str,heads),"Loyalty Cluster");
              var pieoptions = {
                title: 'Loyalty',
                legend: {position:'none'},
                height: '250',
                sliceVisibilityThreshold: 1/720,
                tooltip: {trigger: 'none'}
              }
              drawPie(clusData2,'pie_div2',pieoptions);
              
              $(".hero-unit").click(function(){
                $(".hero-unit").animate({opacity:0,height:0}, 750, function() {
                  $(this).remove();
                });
                return false;
              });
              $("select").change(function () {
                var str = "";
                $("select option:selected").each(function () {
                  str += $(this).text() + "|";
                });
                var prog = $("#programs").find("option:selected").text();
                var loy = $("#loyalty").find("option:selected").text();
                
                var heads = ["Age","Recency","Program Cluster","Loyalty Cluster","Other"];
                var tempData = getSubset(data,str,heads);
                drawTable(tempData,'contactdiv');
                
                //output charts
                if (prog == "Any"){
                    var clusData = clusterData(tempData,"Program Cluster");
                    var pieoptions = {
                      title: 'Programs',
                      legend: {position:'none'},
                      height: '250',
                      sliceVisibilityThreshold: 1/720,
                      tooltip: {trigger: 'none'}
                    }
                    if (clusData.getNumberOfRows() > 0){
                        drawPie(clusData,'pie_div1',pieoptions);
                    } else {
                        $("#pie_div1").html("<h3>No matching customers</h3>");
                    }
                } else {
                    var scatData = scatterData(tempData,"Summer Participation","Weekday Participation");
                    var scatteroptions = {
                      title: 'Summer vs. Weekday',
                      hAxis: {title: 'Summer', minValue: 0},
                      vAxis: {title: 'Weekday', minValue: 0},
                      legend: 'none',
                      height: '250',
                      //theme: 'maximized',
                      pointSize: 4,
                      titlePosition: 'out'
                    }
                    if (scatData.getNumberOfRows() > 0){
                        drawScatter(scatData,'pie_div1',scatteroptions);
                    } else {
                        $("#pie_div1").html("<h3>No matching customers</h3>");
                    }
                }
                
                if (loy == "Any"){
                    var clusData2 = clusterData(tempData,"Loyalty Cluster");
                    var pieoptions2 = {
                      title: 'Loyalty',
                      legend: {position:'none'},
                      height: '250',
                      sliceVisibilityThreshold: 1/720,
                      tooltip: {trigger: 'none'}
                    }
                    if (clusData2.getNumberOfRows() > 0){
                        drawPie(clusData2,'pie_div2',pieoptions2);
                    } else {
                        $("#pie_div2").html("<h3>No matching customers</h3>");
                    }
                } else {
                    var scatData2 = scatterData(tempData,"Summer Participation","Weekday Participation");
                    var scatteroptions2 = {
                      title: 'Summer vs. Weekday',
                      hAxis: {title: 'Summer', minValue: 0},
                      vAxis: {title: 'Weekday', minValue: 0},
                      legend: 'none',
                      height: '250',
                      //theme: 'maximized',
                      pointSize: 4,
                      titlePosition: 'out'
                    }
                    if (scatData2.getNumberOfRows() > 0){
                        drawScatter(scatData2,'pie_div2',scatteroptions2);
                    } else {
                        $("#pie_div2").html("<h3>No matching customers</h3>");
                    }
                }
                
                //Change Description for selected cluster
                  if (prog != "Any"){
                      for (var i=0; i<programs.length;i++){
                          if (programs[i] == prog){
                              $("#Pro").find("p").text(prodescs[i]);
                              $("#Pro").find("h2").text(programs[i]);
                          }
                      }
                  }
                  if (loy != "Any"){
                      for (var j=0; j<loyalty.length;j++){
                          if (loyalty[j] == loy){
                              $("#Loy").find("p").text(loydescs[j]);
                              $("#Loy").find("h2").text(loyalty[j]);
                          }
                      }
                  }
              });
          }
        }
        if(statusTxt=="error"){
            $(".spinner").hide();
          alert("Error: "+xhr.status+": "+xhr.statusText);
        }
    });
}


