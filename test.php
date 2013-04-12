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