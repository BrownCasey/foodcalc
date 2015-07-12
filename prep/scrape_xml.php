<?php
if (file_exists("Food_Table.xml")) {
    $fp = fopen("output.txt", "w");

    $xml = simplexml_load_file("Food_Table.xml");
   
    foreach($xml->Food_Display_Row as $a){
        $prefix = $a->Display_Name;
        $suffix = $a->Portion_Display_Name;
        
        foreach($a->Portion_Display_Name as $b){
            if (strpos($b, '"') !== false ){
                $suffix = str_replace('"', '\"', $b);
            }
        }
        fwrite($fp, '"' . $prefix . ' ' . $suffix . '"' . ', ');
    };

    fclose($fp);
}
else {
    exit("Failed to open Food_Table.xml");
}
?>
