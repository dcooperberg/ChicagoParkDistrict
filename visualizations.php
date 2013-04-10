<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function table($data){
    echo "var data = google.visualization.arrayToDataTable([";
    for ($i=0; $i< count($data); $i++){
        echo "[";
        for ($j=0; $j<count($data[0]); $j++){
            echo "'".$data[$i][$j]."'";
            if ($j<count($data[0])-1){
                echo ",";
            } else {
                echo "]";
            }
        }
        if ($i<count($data)-1){
            echo ",\n";
        } else {
            echo "]);\n";
        }
    }
}
function piechart($data){
    echo "var pieData = google.visualization.arrayToDataTable([";
    echo "['Race', 'Percentage'],";
    $vals = array(0,0,0);
    for ($i=5; $i<count($data[0]);$i++){
        for ($j=1; $j<count($data); $j++){
            $vals[$i-5] = $vals[$i-5] + $data[$j][$i];
        }
        echo "['".strtoupper($data[0][$i])."', ".$vals[$i-5]."]";
        if ($i < count($data[0])-1){
            echo ",\n";
        } else {
            echo "]);\n";
        }
    }
}
function scatterplot($data){
    echo "var scatterData = google.visualization.arrayToDataTable([";
    echo "['".strtoupper($data[0][4])."', '".strtoupper($data[0][5])."', '".strtoupper($data[0][6])."'],\n";
    for ($i=1; $i<count($data); $i++){
        echo "[".$data[$i][4].", ".$data[$i][5].", ".$data[$i][6]."]";
        if ($i<count($data)-1){
            echo ",\n";
        } else {
            echo "]);\n";
        }
    }
}
?>
