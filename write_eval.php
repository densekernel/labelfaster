<?php

var_dump($_POST);

$params = array();
parse_str($_POST["formString"], $params);



$txt = $params['fn']; 

var_dump($params);
if (isset($params['fn']) && isset($params['story']) && isset($params['event']) && isset($params['decision'])) { // check if both fields are set
    $fh = fopen($txt, 'a'); 
    $txt= $params['story']."\t".$params["event"]."\t".$params["decision"]."\n"; 
    fwrite($fh,$txt); // Write information to the file
    fclose($fh); // Close the file
}
?>