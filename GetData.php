<?php

function getData($url){
    ini_set('memory_limit', '-1');
    $file = fopen($url,"r");
    $index = 0;
    $table = array();
    while(! feof($file))
      {
          $table[$index] = fgetcsv($file);
          $index++;
      }

    fclose($file);
    return $table;
}

function rowRange($data,$start,$end){
    $table = array();
    if ($start < 0){
        $start = 0;
    }
    if ($start > 0){
        array_push($table, $data[0]);
    }
    if ($end < $start){
        $end = count($data)-1;
    } elseif ($end > count($data)-1){
        $end = count($data)-1;
    } else if ($end == null){
        $end = count($data)-1;
    }
    for ($i=$start; $i<=$end;$i++){
        array_push($table, $data[$i]);
    }
    return $table;
}

function colRange($data,$start,$end){
    $table = array();
    for ($i=0;$i<count($data);$i++){
        $temp = array();
        for ($j=$start;$j<$end+1;$j++){
            array_push($temp,$data[$i][$j]);
        }
        array_push($table,$temp);
    }
    return $table;
}

function addCluster ($data,$means,$title){
    //Function to get avg object in type of object that fills array
    function getAvg($data,$index){
        $avg = array();
        array_push($avg,"Averages");
        for ($ii=1;$ii<count($index);$ii++){
            $val = 0;
            for ($jj=1;$jj<count($data);$jj++){
                $val = $val + floatval($data[$jj][$index[$ii]]);
            }
            $val = $val/(count($data)-1);
            array_push($avg,$val);
        }
        return $avg;
    }

    //Similarly to getAvg, gets standard devation
    function getSD($data,$index,$avg){
        $sd = array();
        array_push($sd,"St Devs");
        for ($ii=1;$ii<count($index);$ii++){
            $val = 0;
            for ($jj=1;$jj<count($data);$jj++){
                $val = $val + pow((floatval($data[$jj][$index[$ii]])-$avg[$ii]),2);
            }
            $val = sqrt($val/(count($data)-1));
            array_push($sd,$val);
        }
        return $sd;
    }
    $index = array();
    $cluster = array();
    $table = array();
    array_push($cluster,$title);
    array_push($index,"indexes");
    for ($i=1;$i<count($means[0]);$i++){
        for ($j=0;$j<count($data[0]);$j++){
            if ($means[0][$i] == $data[0][$j]){
                array_push($index,$j);
            }
        }
    }
    $avg = getAvg($data,$index);
    $sd = getSD($data, $index, $avg);
    
    for ($k=1;$k<count($data);$k++){      
        $distance = array();
        array_push($distance,"distances");
        for ($l=1;$l<count($means);$l++){
            $val = 0;
            for ($m=1;$m<count($index);$m++){
                $val = $val + pow(((log10($data[$k][$index[$m]]+1)-$avg[$m])/$sd[$m]) - $means[$l][$m],2);
            }
            $val = sqrt($val);
            array_push($distance,$val);
        }
        
        $min = $distance[1];
        $name = $means[1][0];
        for ($n=2;$n<count($distance);$n++){
            if ($distance[$n] < $min){
                $min = $distance[$n];
                $name = $means[$n][0];
            }
        }
        array_push($cluster,$name);
    }
    for ($o=0;$o<count($data);$o++){
        $temp = array();
        for ($p=0;$p<count($data[0]);$p++){
            array_push($temp,$data[$o][$p]);
        }
        array_push($temp,$cluster[$o]);
        array_push($table,$temp);
    }
    return $table;
}
?>
