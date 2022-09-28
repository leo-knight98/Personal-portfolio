<?php
$opc2 = array(
    "cb1" => array (
         "name" => "bike",
         "label" => "I have a bike",
         "value" => "bike",
         "id" => "bike",
         "checked" => true
    ),
    "cb2" => array (
         "name" => "car",
         "label" => "I have a car",
         "value" => "car",
         "checked" => true
    ),
    "cb3" => array (
         "name" => "boat",
         "label" => "I have a boat",
         "value" => "boat",
         "checked" => false
    )
);

$opc = array(1 => "volvo", 2=>"bmw", 3=>"vw", "otros"=>"altres");
$params = array(
     "autofocus" => false,
     "disabled" => false,
     "multible" => true,
     "name" => "cotxe",
     "required" => true,
     "class" => "cotxets",
     "id" => "c1",
     "label" => "Els meus cotxes"
);

function html_generate_checkBox($array) {
    $label = '';
    $input = '';
    $html = '';

    foreach($array as $key => $value) {
        $label = "<label>";
        $input = "<input type='checkbox'";
    
        foreach($value as $etiqueta => $valor) {
            if(gettype($valor) == "boolean" && $valor == true) {
                $input .= " $etiqueta";
            } else if($etiqueta == "label") {
                $label .= $valor;
            } else if($etiqueta != "checked") {
                $input .= " $etiqueta = '$valor'";
            } 
            
        }
    
        $label .= "</label>";
        $input .= ">";
    
        $html .= $input . $label . "<br>";
    }
    
    return $html;
}

function html_generate_select($options, $attrs) {
    $html = "<select ";
    $label = '';
    foreach($attrs as $key => $value) {
        if($value == false) {
            $html .= '';
        } else if($key == "label") {
            $label = "<label>$value</label><br>";
        } else {
            $html .= "$key = '$value' ";
        }
    }
    $html .= ">";

    foreach($options as $key => $value) {
        $html .= "<option value='$key'>$value</option>";
    }

    $html .= "</select>";
    $html = $label . $html;
    return $html;
}

$html = html_generate_checkBox($opc2);
$select = html_generate_select($opc, $params);
?>

<form method="post">
    <?php 
        echo $html;
        echo $select;
    ?>
</form>