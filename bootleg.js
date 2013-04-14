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
function drawPie(data,div,type,values,labels,title){
    if (type === 'google'){
        var pieoptions = {
          title: 'Race Percentages',
          legend: {position:'none'},
          height: '100%',
          sliceVisibilityThreshold: 1/720
        }
        var piechart = new google.visualization.PieChart(document.getElementById(div));
        piechart.draw(data, pieoptions);
    } else if (type === 'raphael'){
        Raphael(div, 250, 250).pieChart(125, 125, 90, values, labels, "#fff",title);
        $("#"+div).find(".spinner").hide();
    }
}
function drawScatter(data,div,type,data2,axisx,axisy){
    if (type === 'google'){
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
    } else if (type === 'raphael'){
        //Raphael("scatter_div",250,250).scatterPlot(250,250, data2, axisx, axisy);
        //$("#scatter_div").find(".spinner").hide();
    }
}

Raphael.fn.pieChart = function (cx, cy, r, values, labels, stroke, title) {
    var paper = this,
        rad = Math.PI / 180,
        chart = this.set();
    function sector(cx, cy, r, startAngle, endAngle, params) {
        var x1 = cx + r * Math.cos(-startAngle * rad),
            x2 = cx + r * Math.cos(-endAngle * rad),
            y1 = cy + r * Math.sin(-startAngle * rad),
            y2 = cy + r * Math.sin(-endAngle * rad);
        return paper.path(["M", cx, cy, "L", x1, y1, "A", r, r, 0, +(endAngle - startAngle > 180), 0, x2, y2, "z"]).attr(params);
    }
    var angle = 0,
        total = 0,
        start = 0,
        process = function (j) {
            var value = values[j],
                angleplus = 360 * value / total,
                popangle = angle + (angleplus / 2),
                color = Raphael.hsb(start, 1, .8), //(hue, saturation, brightness)
                ms = 2000, //dissolve time
                delta = -10, //text distance from slice
                bcolor = Raphael.hsb(start, 1, .8), //(hue, saturation, brightness)
                p = sector(cx, cy, r, angle, angle + angleplus, {fill: "90-" + bcolor + "-" + color, stroke: stroke, "stroke-width": 1}),
                txt = paper.text(125, 236, labels[j]).attr({fill: bcolor, stroke: "none", opacity: 0, "font-size": 20}),
                perc;
                if (values[j]/total > .05){
                    perc = paper.text(cx + (r + delta) * Math.cos(-popangle * rad), cy + (r + delta) * Math.sin(-popangle * rad), Math.round((100*values[j])/total)/1+"%").attr({fill: "#fff", stroke: "none", opacity: 0, "font-size": 14});
                } else {
                    perc = paper.text(cx + (r + delta) * Math.cos(-popangle * rad), cy + (r + delta) * Math.sin(-popangle * rad), Math.round((100*values[j])/total)/1+"%").attr({fill: "#fff", stroke: "none", opacity: 0, "font-size": 0});
                }
            p.mouseover(function () {
                p.stop().animate({transform: "s1.1 1.1 " + cx + " " + cy}, ms, "elastic");
                txt.stop().animate({opacity: 1}, ms, ">");
                perc.stop().animate({opacity: 1}, ms, ">");
            }).mouseout(function () {
                p.stop().animate({transform: ""}, ms, "elastic");
                txt.stop().animate({opacity: 0}, ms/10,"<");
                perc.stop().animate({opacity: 0}, ms/10,"<");
            });
            perc.mouseover(function () {
                p.stop().animate({transform: "s1.1 1.1 " + cx + " " + cy}, ms, "elastic");
                txt.stop().animate({opacity: 1}, ms, ">");
                perc.stop().animate({opacity: 1}, ms, ">");
            }).mouseout(function () {
                p.stop().animate({transform: ""}, ms, "elastic");
                txt.stop().animate({opacity: 0}, ms/10,"<");
                perc.stop().animate({opacity: 0}, ms/10,"<");
            });
            angle += angleplus;
            chart.push(p);
            chart.push(txt);
            chart.push(perc);
            start += 1/values.length;
        };
    for (var i = 0, ii = values.length; i < ii; i++) {
        total += values[i];
    }
    for (i = 0; i < ii; i++) {
        process(i);
    }
    var header = paper.text(60, 15, title).attr({fill: "#000000", stroke: "none", opacity: 1, "font": '10px Fontin-Sans, Arial'});
    chart.push(title);
    return chart;
};

/*Raphael.fn.bubblePlot = function (width,height,data,axisx,axisy){
    var paper = this,
        chart=this.set(),
        txt = {"font": '10px Fontin-Sans, Arial', stroke: "none", fill: "#fff"},
        X = (width - leftgutter) / axisx.length,
        Y = (height - bottomgutter) / axisy.length,
        leftgutter = 30,
        bottomgutter = 20,
        color = $("#scatter_div").css("color"),
        max = Math.round(X / 2) - 1;
        //paper.rect(0, 0, width, height, 5).attr({fill: "#000", stroke: "none"});
    for (var i = 0; i < axisx.length; i++) {
        paper.text(leftgutter + X * (i + .5), 244, axisx[i]).attr(txt);
    }
    for (var i = 0; i < axisy.length; i++) {
        paper.text(10, Y * (i + .5), axisy[i]).attr(txt);
    }
    var o = 0;
    for (var i = 0; i < axisy.length; i++) {
        for (var j = 0; j < axisx.length; j++) {
            //Determine Radius
            var R = data[o] && Math.min(Math.round(Math.sqrt(data[o] / Math.PI) * 4), max);
            if (R) { //If Radius is a number
                (function (dx, dy, R, value) {
                    var color = "hsb(" + [(1 - R / max) * .5, 1, .75] + ")"; //color determined by size
                    var dt = paper.circle(dx + 60 + R, dy + 10, R).attr({stroke: "none", fill: color});
                    if (R < 6) {
                        var bg = paper.circle(dx + 60 + R, dy + 10, 6).attr({stroke: "none", fill: "#000", opacity: .4}).hide();
                    }
                    var lbl = paper.text(dx + 60 + R, dy + 10, data[o])
                            .attr({"font": '10px Fontin-Sans, Arial', stroke: "none", fill: "#fff"}).hide();
                    var dot = paper.circle(dx + 60 + R, dy + 10, max).attr({stroke: "none", fill: "#000", opacity: 0});
                    //event handlers, can improve
                    dot[0].onmouseover = function () {
                        if (bg) {
                            bg.show();
                        } else {
                            var clr = Raphael.rgb2hsb(color);
                            clr.b = .5;
                            dt.attr("fill", Raphael.hsb2rgb(clr).hex);
                        }
                        lbl.show();
                    };
                    dot[0].onmouseout = function () {
                        if (bg) {
                            bg.hide();
                        } else {
                            dt.attr("fill", color);
                        }
                        lbl.hide();
                    };
                })(leftgutter + X * (j + .5) - 60 - R, Y * (i + .5) - 10, R, data[o]);
            }
            o++;
        }
    }
};*/

