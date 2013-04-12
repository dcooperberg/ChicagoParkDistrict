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
function drawPie(data,div,type,values,labels){
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
        Raphael("chart_div", 250, 250).pieChart(125, 125, 90, values, labels, "#fff");
        $("#chart_div").find(".spinner").hide();
    }
}
function drawScatter(data,div){
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
}

Raphael.fn.pieChart = function (cx, cy, r, values, labels, stroke) {
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
            start += 1/values.length;
        };
    for (var i = 0, ii = values.length; i < ii; i++) {
        total += values[i];
    }
    for (i = 0; i < ii; i++) {
        process(i);
    }
    return chart;
};

