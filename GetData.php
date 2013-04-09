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
    array_push($table, $data[0]);
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

/*function byCol($data,$col,$Val){
    $table = array();
    $index = -1;
    for ($i=0;$i<count($data[0]);$i++){
        if($col == $data[$i]){
            $index = $i;
        }
    }
    if (index > -1){
        
    }
}*/

?>
