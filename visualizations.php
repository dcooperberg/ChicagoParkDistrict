<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function googleTable($data,$var){
    echo "var ".$var." = google.visualization.arrayToDataTable([";
    $type = array();
    for ($k=0; $k<count($data[0]); $k++){
        if (is_numeric($data[2][$k])){
            array_push($type,"numeric");
        } else {
            array_push($type,"string");
        }
    }
    echo "[";
    for ($jj=0; $jj<count($data[0]); $jj++){
        echo "'".$data[0][$jj]."'";
        if ($jj<count($data[0])-1){
            echo ",";
        } else {
            echo "],";
        }
    }
    for ($i=1; $i< count($data); $i++){
        echo "[";
        for ($j=0; $j<count($data[0]); $j++){
            if ($type[$j] == "string"){
                echo "'";
            }
            echo $data[$i][$j];
            if ($type[$j] == "string"){
                echo "'";
            }
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
function googlePie($data,$var,$type){
    echo "var ".$var." = google.visualization.arrayToDataTable([";
    if ($type == "race"){
        echo "['Race', 'Percentage'],";
        $vals = array(0,0,0);
        for ($i=27; $i<count($data[0]);$i++){
            for ($j=1; $j<count($data); $j++){
                $vals[$i-27] = $vals[$i-27] + floatval($data[$j][$i]);
            }
            echo "['".strtoupper($data[0][$i])."', ".$vals[$i-27]."]";
            if ($i < count($data[0])-1){
                echo ",";
            } else {
                echo "]);\n";
            }
        }
    } else if ($type == "segment"){
        $labs = array();
        $vals = array();
        $index = count($data[0])-1;
        array_push($labs,$data[1][$index]);
        array_push($vals,0);
        //find unique names
        for ($j=2;$j<count($data);$j++){
            $new = true;
            for ($k=0;$k<count($labs);$k++){
                if ($labs[$k] === $data[$j][$index]){
                    $new = false;
                }
            }
            if ($new == true){
                array_push($labs,$data[$j][$index]);
                array_push($vals,0);
            }
            $new = true;
        }
        //Count instances of each name
        for ($l=1;$l<count($data);$l++){
            for ($m=0;$m<count($labs);$m++){
                if ($data[$l][$index] == $labs[$m]){
                    $vals[$m] = $vals[$m] + 1;
                }
            }
        }
        echo "['".$data[0][$index]."', 'Count'],";
        for ($k=0; $k<count($vals);$k++){
            echo "['".$labs[$k]."', ".$vals[$k]."]";
            if ($k < count($vals)-1){
                echo ",";
            } else {
                echo "]);\n";
            }
        }
    }
}
function googleScatter($data){
    echo "var scatterData = google.visualization.arrayToDataTable([";
    echo "['".strtoupper($data[0][16])."', '".strtoupper($data[0][21])."'],\n";
    for ($i=1; $i<count($data); $i++){
        echo "[".$data[$i][16].", ".$data[$i][21]."]";
        if ($i<count($data)-1){
            echo ",";
        } else {
            echo "]);\n";
        }
    }
}
/*
function raphaelPie($data){
    $vals = array();
    $labs = array();
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
}
*/
/*
function clusterPie($data,$type){
    $vals = array();
    $labs = array();
    $index = -1;
    for ($i=0;$i<count($data[0]);$i++){
        if ($data[0][$i] == $type){
            $index = $i;
        }
    }
    array_push($labs,$data[1][$index]);
    array_push($vals,0);
    for ($j=2;$j<count($data);$j++){
        $new = true;
        for ($k=0;$k<count($labs);$k++){
            if ($labs[$k] === $data[$j][$index]){
                $new = false;
            }
        }
        if ($new == true){
            array_push($labs,$data[$j][$index]);
            array_push($vals,0);
        }
        $new = true;
    }
    for ($l=1;$l<count($data);$l++){
        for ($m=0;$m<count($labs);$m++){
            if ($data[$l][$index] == $labs[$m]){
                $vals[$m] = $vals[$m] + 1;
            }
        }
    }
    for ($k=0; $k<count($vals);$k++){
            echo "values1.push(parseInt('".$vals[$k]."',10));\n";
            $pos = strpos($labs[$k],"|");
            echo "labels1.push('".substr($labs[$k],0,$pos)."');\n";
            echo "descs1.push('".substr($labs[$k],$pos+1)."');\n";
    }
}

function raphaelScatter($data){
    $list = array();
    $axisx = array();
    $axisy = array();
    for ($i=0;$i<count($data);$i++){
        
    }
}*/
?>
