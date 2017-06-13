<?php

$chaves = array(array());
$i = 0;
foreach ($_POST as $x => $x_value) {
    
    $chaves[$i][0] = $x;
    $chaves[$i][1] = $x_value;

    $i++;
}


for($j=0; $i>$j;$j++){
    
    echo $chaves[$j][0] ."  ".$chaves[$j][1]." <br/>";
    
    
}
