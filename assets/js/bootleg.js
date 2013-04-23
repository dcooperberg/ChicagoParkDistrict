/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function drawTable(data,div) {
    var output = new Array();
    var titles = new Array();
    var cols = [0,1,2,3,6,30,31];
    for (var i=0;i<cols.length;i++){
        titles.push(data.getColumnLabel(cols[i]));
    }
    output.push(titles);
    for (var j=0; j<data.getNumberOfRows();j++){
        var temp = new Array();
        for (var k=0; k<cols.length;k++){
            if (titles[k].indexOf("Cluster") >= 0){
                var loc = data.getValue(j,cols[k]).indexOf("|");
                temp.push(data.getValue(j,cols[k]).substring(0,loc));
            } else {
                temp.push(data.getValue(j,cols[k]));
            }
        }
        output.push(temp)
    }
    var results = google.visualization.arrayToDataTable(output);
    
    var options = {
        showRowNumber: false,
        page: 'enable',
        pageSize: 20
    }
    var table = new google.visualization.Table(document.getElementById(div));
    table.draw(results, options);
}
function drawPie(data,div,options/*,type,values,labels,descs,title*/){
    //if (type === 'google'){
        var piechart = new google.visualization.PieChart(document.getElementById(div));
        function selectHandler() {
          var selectedItem = piechart.getSelection()[0];
          if (selectedItem) {
              var topping = data.getValue(selectedItem.row, 0);
              var loc = topping.indexOf("|");
              var title = topping.substring(0,loc);
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
function drawScatter(data,div,options/*,type,data2,axisx,axisy*/){
    //if (type === 'google'){
        var scatterplot = new google.visualization.ScatterChart(document.getElementById(div));
        scatterplot.draw(data, options);
    /*} else if (type === 'raphael'){
        //Raphael("scatter_div",250,250).scatterPlot(250,250, data2, axisx, axisy);
        //$("#scatter_div").find(".spinner").hide();
    }*/
}
function drawBubble(data,div,x,y/*,type,data2,axisx,axisy*/){
    //if (type === 'google'){
        var bubbleoptions = {
          title: x+' vs. '+y,
          hAxis: {title: x, minValue: 0},
          vAxis: {title: y, minValue: 0},
          height: '100%',
          legend: 'none',
          titlePosition: 'out',
          sizeAxis: {minSize: 3,maxSize: 10},
          colors: ['red','yellow','green','green']
          //theme: 'maximized'
        }
        var bubbleplot = new google.visualization.BubbleChart(document.getElementById(div));
        bubbleplot.draw(data, bubbleoptions);
    /*} else if (type === 'raphael'){
        //Raphael("scatter_div",250,250).scatterPlot(250,250, data2, axisx, axisy);
        //$("#scatter_div").find(".spinner").hide();
    }*/
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

function bubbleData(data,x,y){
    var xindex = -1;
    var yindex = -1;
    for (var l=0; l<data.getNumberOfColumns(); l++){
        if (data.getColumnLabel(l) == x){
            xindex = l;
        } else if (data.getColumnLabel(l) == y){
            yindex = l;
        }
    }
    var xys = new Array();
    xys.push([data.getValue(0,xindex),data.getValue(0,yindex),1]);
    for (var i=1; i<data.getNumberOfRows();i++){
        var write = true;
        for (var j=0; j<xys.length;j++){
            if (data.getValue(i,xindex) == xys[j][0]){
                if (data.getValue(i,yindex) == xys[j][1]){
                    write = false;
                    xys[j][2] = xys[j][2]+1;
                }
            }
        }
        if (write == true){
            xys.push([data.getValue(i,xindex),data.getValue(i,yindex),1]);
        }
    }
    var output = new Array();
    output.push(['ID',x,y,'color','count']);
    for (var k=0;k<xys.length;k++){
        if (parseFloat(xys[k][0]) != 0 || parseFloat(xys[k][1])){
            output.push(['',parseFloat(xys[k][0]),parseFloat(xys[k][1]),xys[k][2],xys[k][2]]);
        }    
    }
    var results = google.visualization.arrayToDataTable(output);
    return results;
}

function getSubset(data,str,fields){
    var pDescs = new Array();
    var lDescs = new Array();
    var programs = new Array();
    var loyalties = new Array();
    pDescs.push("Customers in the After-Schoolers group are characterized by high schoolyear, weekday, and afternoon/evening participation rates. They have a higher than average participation rate in out-of-school activities and special recreation programs, and tend to enroll in programs with a higher than average age range (approximately 5 years).","Early Childhood Participants have their highest participation in early childhood programs and typically register for programs during the schoolyear. These customers also tend to register in weekday programs with a lower percentage of summer programs than average and prefer sports, culture & arts, and special interest programs.","Customers in the Summer Campers group have registered for almost 2 camps on average, with primarily weekday and summer program registrations. Although they do not participate in any other types of programs very frequently, the most common groups other than camps are out-of-school time, sports, and aquatics.","The All-Arounders participate in the most distinct program types. They most often participate in sports, culture & arts, early childhood, camps, and aquatics programs. These customers also have a lower than average summer participation rate and a higher than average participation rate in special interest, wellness, general event, and nature programs.","Sports Lovers have very high sports program registration rates similar to All-Arounders, but do not tend to register for other program categories at a very high frequency. When they do register for other program categories, they tend to choose aquatics and camps. About a fifth of their registrations are for summer programs, which is lower than average. ","These customers frequently register for weekend programs, with an average of 77.4% of their programs meeting at least once on a weekend. They are year-round participants that have generally low participation rates favoring aquatics and sports. Additionally, their programs tend to start earlier in the day.");
    programs.push("After Schoolers","Early Childhood Participants","Summer Campers","All Arounders","Sports Lovers","Weekenders");
    loyalties.push("One Time Participants","Occasional Average Spenders","Parkies","Occasional Big Spenders","Selective Big Spenders","Deal Seekers");
    
lDescs.push("Very high recency, and very low frequency. Average spend. Mostly one park",
"High recency, and low frequency. Different types of programs but only one park.",
"Have participated recently, and participate very frequently. Spend an average amount and go to multiple parks",
"Have not participated recent, and frequency is relatively low. Tend to spend a lot on a mix of programs at several parks.",
"High recency, and a high frequency. Mostly one type of program at a mix of parks",
"Have participated recently, but spend very little on different types of program at only one park.");
    
    var filters = new Array();
    var rows = new Array();
    for (var h=0;h<fields.length;h++){
        var pos = str.indexOf("|");
        filters.push(str.substring(0,pos));
        str = str.substring(pos+1);
    }
    var index = new Array();
    for (var g=0;g<fields.length;g++){
        for (var j=0;j<data.getNumberOfColumns();j++){
            if (fields[g] == data.getColumnLabel(j)){
                index.push(j);
            }
        }
    }
    for (var i=0; i<fields.length;i++){
        if (fields[i] == "Age"){
            if (filters[i] == "Adults"){
                var ageMin = 19;
                var ageMax = 100;
            } else {
                var ageMin = 0;
                var ageMax = 18;
            }
            rows.push(data.getFilteredRows([{column: index[i], minValue: ageMin, maxValue: ageMax}]));
        } else if (fields[i] == "Program Cluster"){
            var PC = filters[i];
            for (var pp=0; pp<programs.length;pp++){
                if (PC == programs[pp]){
                    var pindex = pp;
                }
            }
            if (PC != "Any"){
                rows.push(data.getFilteredRows([{column: index[i],value:PC+"|"+pDescs[pindex]}]));
            }
        } else if (fields[i] == "Loyalty Cluster"){
            var LC = filters[i];
            for (var qq=0; qq<loyalties.length;qq++){
                if (LC == loyalties[qq]){
                    var lindex = qq;
                }
            }
            if (LC != "Any"){
                rows.push(data.getFilteredRows([{column: index[i],value:LC+"|"+lDescs[lindex]}]));
            }
        }
    }
    var finalRows = new Array();
    for (var a=0;a<rows[0].length;a++){
        var add = new Array();
        for (var bb=1;bb<rows.length; bb++){
            add.push(1);
        }
        for (var b=1; b<rows.length; b++){
            for (var c=0; c<rows[b].length; c++){
                if (rows[0][a] == rows[b][c]){
                    add[b-1] = 0;
                }
            }
        }
        var sum = 0;
        for (var cc=0; cc<add.length;cc++){
            sum = sum + add[cc];
        }
        if (sum == 0 || rows.length == 1){
            finalRows.push(rows[0][a]);
        }
    }
    
    var output = new Array();
    var titles = new Array();
    for (var jj=0;jj<data.getNumberOfColumns();jj++){
        titles.push(data.getColumnLabel(jj));
    }
    output.push(titles);
    for (var n=0; n<finalRows.length;n++){
        var temp = new Array();
        for (var p=0; p<data.getNumberOfColumns();p++){
            temp.push(data.getValue(finalRows[n],p));
        }
        output.push(temp);
    }
    var results = google.visualization.arrayToDataTable(output);
    return results;
}
function loadmap(parkdata){
    var map;
    var mapOptions = {
        zoom: 11,
        center: new google.maps.LatLng(41.850233,-87.638532),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    $('#map_canvas').height("500px");
    //$('#map_canvas').height($(window).height());
    /*$(window).on('resize', function() {
        $('#map_canvas').height($(window).height()-40)
    });*/
    $(function() {
        $("#map_canvas").mousemove(function(e){
            mouseXpos = e.pageX 
            mouseYpos = e.pageY
        });
    });
    
    google.maps.Polygon.prototype.getBounds = function() {
        var bounds = new google.maps.LatLngBounds();
        var paths = this.getPaths();
        var path;        
        for (var i = 0; i < paths.getLength(); i++) {
            path = paths.getAt(i);
            for (var ii = 0; ii < path.getLength(); ii++) {
                bounds.extend(path.getAt(ii));
            }
        }
        return bounds;
    }

    String.prototype.format = function() {
        var formatted = this;
        for (var i = 0; i < arguments.length; i++) {
            var regexp = new RegExp('\\{'+i+'\\}', 'gi');
            formatted = formatted.replace(regexp, arguments[i]);
        }
        return formatted;
    };
    
    map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
    jQuery.getJSON('parks.json',function(data){
        $.each(data,function(i){
            var MapCoords = [];
            $.each(data[i].Points, function(j){
                MapCoords.push(new google.maps.LatLng(data[i].Points[j].Lat, data[i].Points[j].Lng))
            });
            var polygon = new google.maps.Polygon({
                paths: MapCoords,
                strokeColor: "#333333",
                strokeOpacity: 0.7,
                strokeWeight: 1,
                fillColor: "#079626",
                fillOpacity: 0.5
            });
            google.maps.event.addListener(polygon,"mouseover",function(){
                this.setOptions({filleOpacity: 5});
                var html = '';
                if (data[i].Title != ''){
                    html = html + '<h4 style="margin-bottom:-10px;padding-bottom:0px;" >'
                    + data[i].Title + '</h4><br/>';
                }
                if (data[i].Description != '' && data[i].Description != null){
                    html += '<p>' + data[i].Description + '</p>';
                }
                $('#g_map_CT_Main_0_ccGoogleMap_tooltip').html(html);
                $('#g_map_CT_Main_0_ccGoogleMap_tooltip').css('left',mouseXpos + 20);
                $('#g_map_CT_Main_0_ccGoogleMap_tooltip').css('top',mouseYpos + 20);
                $('#g_map_CT_Main_0_ccGoogleMap_tooltip').show();
            })
            google.maps.event.addListener(polygon,"mouseout",function(){
                if (data[i].FitTo){
                    this.setOptions({fillOpacity: 0.5});
                } else {
                    this.setOptions({fillOpacity: 0.5});
                }
                $('#g_map_CT_Main_0_ccGoogleMap_tooltip').hide();
            })
            google.maps.event.addListener(polygon,"click",function(){
                //window.location = data[i].ParkURL;
            })
            polygon.setMap(map);
            if (data[i].FitTo){
                polygon.setOptions({
                    fillOpacity: 0.5,fillColor: "#079626"
                })
                map.fitBounds(polygon.getBounds());
            }
        })
    })
    google.maps.event.addListener(map, 'click', function(){
        google.maps.event.addListenerOnce(map,"zoom_changed",function() {
            if (map.draggable == false){
                map.draggable = true;
            }
        });
    });
}
