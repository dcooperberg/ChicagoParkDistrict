/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function drawTable(data,div) {
    var options = {
        showRowNumber: true,
        page: 'enable',
        pageSize: 20
    }
    var table = new google.visualization.Table(document.getElementById(div));
    table.draw(data, options);
}
function drawPie(data,div,options/*,type,values,labels,descs,title*/){
    //if (type === 'google'){
        var piechart = new google.visualization.PieChart(document.getElementById(div));
        function selectHandler() {
          var selectedItem = piechart.getSelection()[0];
          if (selectedItem) {
              var topping = data.getValue(selectedItem.row, 0);
              var loc = topping.indexOf("|");
              var title = topping.substring(0,loc-1);
              var desc = topping.substring(loc+1);
            $("#"+options.title.substring(0,3)).find("h2").text(title);
            $("#"+options.title.substring(0,3)).find("p").text(desc);
          }
        }

        google.visualization.events.addListener(piechart, 'select', selectHandler);       
        
        
        piechart.draw(data, options);
    /*} else if (type === 'raphael'){
        Raphael(div, 250, 250).pieChart(125, 125, 90, values, labels, descs, "#fff",title);
        $("#"+div).find(".spinner").hide();
    }*/
}
function drawScatter(data,div/*,type,data2,axisx,axisy*/){
    //if (type === 'google'){
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
        var scatterplot = new google.visualization.ScatterChart(document.getElementById(div));
        scatterplot.draw(data, scatteroptions);
    /*} else if (type === 'raphael'){
        //Raphael("scatter_div",250,250).scatterPlot(250,250, data2, axisx, axisy);
        //$("#scatter_div").find(".spinner").hide();
    }*/
}

function filterData(data,param,value,other){

}

function clusterData(data,cluster){
    var index = -1;
    for (var i=0; i<data.getNumberOfColumns(); i++){
        if (data.getColumnLabel(i) == cluster){
            index = i;
        }
    }
    var labels = data.getDistinctValues(index);
    var values = new Array();
    for (var j=0; j<labels.length;j++){
        values.push(0);
    }
    for (var k=0;k<data.getNumberOfRows();k++){
        for (var l=0; l<labels.length; l++){
            if (data.getValue(k,index) == labels[l]){
                values[l] = values[l] + 1;
            }
        }
    }
    var output = new Array();
    output.push([cluster,"Count"]);
    for (var m=0;m<labels.length;m++){
        //var loc = labels[m].indexOf("|");
        output.push([labels[m],values[m]]);
    }
    var results = google.visualization.arrayToDataTable(output);
    return results;
}
function raceData(data){
    var labels = new Array("White","Black","Hispanic");
    var values = new Array(0,0,0);
    for (var i=0; i<data.getNumberOfRows();i++){
        values[0] = values[0] + data.getValue(i,27);
        values[1] = values[1] + data.getValue(i,28);
        values[2] = values[2] + data.getValue(i,29);
    }
    var output = new Array();
    output.push(["Race","Count"]);
    for (var j=0;j<labels.length;j++){
        if (values[j]>0){
            output.push([labels[j],values[j]]);
        }
    }
    var results = google.visualization.arrayToDataTable(output);
    return results;
}

function scatterData(data,x,y){
    var xindex = -1;
    var yindex = -1;
    for (var i=0; i<data.getNumberOfColumns(); i++){
        if (data.getColumnLabel(i) == x){
            xindex = i;
        } else if (data.getColumnLabel(i) == y){
            yindex = i;
        }
    }
    var output = new Array();
    output.push([x,y]);
    for (var j=0;j<data.getNumberOfRows();j++){
        output.push([data.getValue(j,xindex),data.getValue(j,yindex)]);
    }
    var results = google.visualization.arrayToDataTable(output);
    return results;
}

