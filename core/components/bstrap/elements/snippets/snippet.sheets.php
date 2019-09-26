<?php

$list = $modx->getOption('list',$scriptProperties,false);

$row = "";
foreach(preg_split("/((\r?\n)|(\r\n?))/", $list) as $line){

    $data = explode('||',$line);
    $row .= "<tr><td>".$data[0]."</td><td>".$data[1]."</td><td><a href=\"".$data[3]."\" target=\"_blank\">".$data[2]."</a></td></tr>";      
}
return $row;

/*
$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vRlbmORik-bflmPxde-NkAxLXPEtxsX13Lr_vx70cdCKp4RhX5Zoh8xigJMsCwYkTkdshLPKUotZcXu/pub?gid=0&single=true&output=csv";

if(!ini_set('default_socket_timeout', 15)) return "<!-- unable to change socket timeout -->";

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $row = "";
    $isfirst = true;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if( !$isfirst ){
        $row .= "<tr><td>".$data[0]."</td><td>".$data[1]."</td><td><a href=\"".$data[3]."\" target=\"_blank\">".$data[2]."</a></td></tr>";            
        }
        $isfirst = false;
    }
    fclose($handle);
}

return $row;

*/