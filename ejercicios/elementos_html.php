<?php
require('functions.php');

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

$html = html_generate_checkBox($opc2);
$select = html_generate_select($opc, $params);
?>
<h1 class="title"><?php echo $generador ?></h1>
<form method="post">
    <?php 
        echo $html;
        echo $select;
    ?>
</form>