<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Raphaël · Pie Chart</title>
<script src="assets/js/raphael-min.js"></script>
<script src="assets/js/jquery.js"></script>
<script>
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
                color = Raphael.hsb(start, .75, .75), //(hue, saturation, brightness)
                ms = 500, //dissolve time
                delta = 30, //text distance from slice
                bcolor = Raphael.hsb(start, 1, .8), //(hue, saturation, brightness)
                p = sector(cx, cy, r, angle, angle + angleplus, {fill: "90-" + bcolor + "-" + color, stroke: stroke, "stroke-width": 3}),
                txt = paper.text(cx + (r + delta + 55) * Math.cos(-popangle * rad), cy + (r + delta + 25) * Math.sin(-popangle * rad), labels[j]).attr({fill: bcolor, stroke: "none", opacity: 0, "font-size": 20});
            p.mouseover(function () {
                p.stop().animate({transform: "s1.1 1.1 " + cx + " " + cy}, ms, "elastic");
                txt.stop().animate({opacity: 1}, ms, "elastic");
            }).mouseout(function () {
                p.stop().animate({transform: ""}, ms, "elastic");
                txt.stop().animate({opacity: 0}, ms);
            });
            angle += angleplus;
            chart.push(p);
            chart.push(txt);
            start += .1;
        };
    for (var i = 0, ii = values.length; i < ii; i++) {
        total += values[i];
    }
    for (i = 0; i < ii; i++) {
        process(i);
    }
    return chart;
};

$(function () {
    var values = [],
        labels = [];
    /*$("tr").each(function () {
        values.push(parseInt($("td", this).text(), 10));
        labels.push($("th", this).text());
    });*/
    <?php
    include 'GetData.php';
    include 'visualizations.php';
    $vals = array();
    $labs = array();
    $data = colRange(rowRange(getData("testdata1.csv"),0,1000),0,29);
    for ($h=0; $h<11;$h++){
        array_push($vals,0);
        array_push($labs,$data[0][$h+7]);
    }
    for ($i=0; $i<count($data);$i++){
        for ($j=7; $j<18; $j++){
            $vals[$j-7] = $vals[$j-7] + $data[$i][$j];
        }
    }
    for ($k=0; $k<count($vals);$k++){
            echo "values.push(parseInt('".$vals[$k]."',10));\n";
            echo "labels.push('".$labs[$k]."');\n";
    }
    ?>
    $("table").hide();
    Raphael("holder", 700, 700).pieChart(350, 350, 200, values, labels, "#fff");
});
</script>
<style media="screen">
            #holder {
                margin: 0px 0 0 0px;
                width: 700px;
                height: 700px;
            }
        </style>
    </head>
    <body>
        <table>
            <tbody>
                <tr>
                    <th scope="row">Ruby</th>
                    <td>40%</td>
                </tr>
                <tr>
                    <th scope="row">JavaScript</th>
                    <td>26%</td>
                </tr>
                <tr>
                    <th scope="row">Shell</th>
                    <td>5%</td>
                </tr>
                <tr>
                    <th scope="row">Python</th>
                    <td>5%</td>
                </tr>
                <tr>
                    <th scope="row">PHP</th>
                    <td>4%</td>
                </tr>
                <tr>
                    <th scope="row">C</th>
                    <td>4%</td>
                </tr>
                <tr>
                    <th scope="row">Perl</th>
                    <td>3%</td>
                </tr>
                <tr>
                    <th scope="row">C++</th>
                    <td>2%</td>
                </tr>
                <tr>
                    <th scope="row">Java</th>
                    <td>2%</td>
                </tr>
                <tr>
                    <th scope="row">Objective-C</th>
                    <td>2%</td>
                </tr>
            </tbody>
        </table>
        <div id="holder"></div>
        <p id="copy">Demo of <a href="http://raphaeljs.com/">Raphaël</a>—JavaScript Vector Library</p>
    </body>
</html>

/*
Raphael.fn.pieChart = function (cx, cy, r, values, labels, descs, stroke, title) {
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
        baseHead = $("#"+title.substring(0,3)).find("h2").text(),
        baseP = $("#"+title.substring(0,3)).find("p").text(),
        globClick = null,
        globPerc = null,*/
        /*process = function (j) {
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
            var click = false;    
            p.mouseover(function () {
                p.stop().animate({transform: "s1.1 1.1 " + cx + " " + cy}, ms, "elastic");
                txt.stop().animate({opacity: 1}, ms, ">");
                perc.stop().animate({opacity: 1}, ms, ">");
                $("#"+title.substring(0,3)).find("h2").text(labels[j]);
                $("#"+title.substring(0,3)).find("p").text(descs[j]);
            }).mouseout(function () {
                if (click == false){
                    p.stop().animate({transform: ""}, ms, "elastic");
                    perc.stop().animate({opacity: 0}, ms/10,"<");
                    $("#"+title.substring(0,3)).find("h2").text(baseHead);
                    $("#"+title.substring(0,3)).find("p").text(baseP);
                }
                txt.stop().animate({opacity: 0}, ms/10,"<");
            }).click(function () {
                if (click == false){
                    $("#"+title.substring(0,3)).find("h2").text(labels[j]);
                    $("#"+title.substring(0,3)).find("p").text(descs[j]);
                    baseHead = labels[j];
                    baseP = descs[j];
                    click = true;
                   /*if (globClick != null){
                        globClick.stop().animate({transform: ""}, ms, "elastic");
                        globPerc.stop().animate({opacity: 0}, ms/10,"<");
                    }
                    globClick = p;
                    globPerc = perc;
                } else {
                    click = false;
                    globClick = null;
                    globPerc = null;
                }
            });
            perc.mouseover(function () {
                p.stop().animate({transform: "s1.1 1.1 " + cx + " " + cy}, ms, "elastic");
                txt.stop().animate({opacity: 1}, ms, ">");
                perc.stop().animate({opacity: 1}, ms, ">");
                $("#"+title.substring(0,3)).find("h2").text(labels[j]);
                $("#"+title.substring(0,3)).find("p").text(descs[j]);
            }).mouseout(function () {
                if (click == false){
                    p.stop().animate({transform: ""}, ms, "elastic");
                    perc.stop().animate({opacity: 0}, ms/10,"<");
                    $("#"+title.substring(0,3)).find("h2").text(baseHead);
                    $("#"+title.substring(0,3)).find("p").text(baseP);
                }
                txt.stop().animate({opacity: 0}, ms/10,"<");
            }).click(function () {
                if (click == false){
                    $("#"+title.substring(0,3)).find("h2").text(labels[j]);
                    $("#"+title.substring(0,3)).find("p").text(descs[j]);
                    baseHead = labels[j];
                    baseP = descs[j];
                    click = true;
                    if (globClick != null){
                        globClick.stop().animate({transform: ""}, ms, "elastic");
                        globPerc.stop().animate({opacity: 0}, ms/10,"<");
                    }
                    globClick = p;
                    globPerc = perc;
                } else {
                    click = false;
                    globClick = null;
                    globPerc = null;
                }
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
};*/

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