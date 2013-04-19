/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function navScripts(val,data){
    $("#main-container").load(val+".php", function(responseTxt,statusTxt,xhr){
        if(statusTxt=="success"){
          if (val == "contact"){
            drawTable(data,'contactdiv');
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
            drawScatter(scatData,'scatter_div');
            var bubData=bubbleData(data,'Sports','Number of Parks');
            drawBubble(bubData,'chart_div','Sports','Number of Parks');
          } else if (val == "segment"){
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
                var heads = ["Age","Recency","Program Cluster","Loyalty Cluster","Other"];
                var tempData = getSubset(data,str,heads);
                drawTable(tempData,'contactdiv');
                var clusData = clusterData(tempData,"Program Cluster");
                var pieoptions = {
                  title: 'Programs',
                  legend: {position:'none'},
                  height: '250',
                  sliceVisibilityThreshold: 1/720,
                  tooltip: {trigger: 'none'}
                }
                drawPie(clusData,'pie_div1',pieoptions);
                var clusData2 = clusterData(tempData,"Loyalty Cluster");
                var pieoptions = {
                  title: 'Loyalty',
                  legend: {position:'none'},
                  height: '250',
                  sliceVisibilityThreshold: 1/720,
                  tooltip: {trigger: 'none'}
                }
                drawPie(clusData2,'pie_div2',pieoptions);
                var prog = $("#programs").find("option:selected").text();
                  if (prog != "Any"){
                      for (var i=0; i<programs.length;i++){
                          if (programs[i] == prog){
                              $("#Pro").find("p").text(prodescs[i]);
                              $("#Pro").find("h2").text(programs[i]);
                          }
                      }
                  }
                var loy = $("#loyalty").find("option:selected").text();
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


