<?php
session_start();

include_once("../index.php");
$data = utf8_encode(file_get_contents("https://www.inversis.com/inversiones/productos/cotizaciones-nacionales&pathMenu=3_1_0_0&esLH=N"));
$inici = '<tr id=';
$final = '</tr>';
$pos = 0;
$taula = 1;

while (($posIni = strpos($data, $inici, $pos)) !== false) {
    $posIni += 22;
    $posFin = strpos($data, $final, $posIni);
    $dades[] = substr($data, $posIni, $posFin - $posIni);
    $pos = $posFin;
}

$iniciNom = 'value="N"';
$finalNom = "</td>";
$pos = 0;
$valors = array();

$iniciTicker = "<td>";
$finalTicker = "</td>";

$iniciPreu = "id=";

$iniciDivisa = "class=";

$iniciVolum = "id=\"tdVol_";

$iniciMinim = "id=\"tdMinSes_";

$iniciMaxim = "id=\"tdMaxSes_";

$iniciData = "<span source=";
$finalData = "</span>";

for($i = 0; $i < count($dades); $i++) {
    $pos_inici = strpos($dades[$i], $iniciNom, $pos)+12;
    $pos_final = strpos($dades[$i], $finalNom, $pos_inici);
    $valors[$i]["nom"] = trim(substr($dades[$i], $pos_inici, $pos_final - $pos_inici));

    $pos_inici_ticker = strpos($dades[$i], $iniciTicker, $pos)+4;
    $pos_final_ticker = strpos($dades[$i], $finalTicker, $pos_inici_ticker);
    $valors[$i]["ticker"] = trim(substr($dades[$i], $pos_inici_ticker, $pos_final_ticker - $pos_inici_ticker));

    $pos_inici_mercado = strpos($dades[$i], $iniciTicker, $pos_final_ticker)+4;
    $pos_final_mercado = strpos($dades[$i], $finalTicker, $pos_inici_mercado);
    $valors[$i]["mercado"] = trim(substr($dades[$i], $pos_inici_mercado, $pos_final_mercado - $pos_inici_mercado));

    $pos_inici_preu = strpos($dades[$i], $iniciPreu, $pos_final_mercado)+17;
    $pos_final_preu = strpos($dades[$i], $finalTicker, $pos_inici_preu);
    $valors[$i]["ultima_cotizacion"] = trim(strip_tags(substr($dades[$i], $pos_inici_preu, $pos_final_preu - $pos_inici_preu)));

    $pos_inici_divisa = strpos($dades[$i], $iniciDivisa, $pos_final_preu)+11;
    $pos_final_divisa = strpos($dades[$i], $finalTicker, $pos_inici_divisa);
    $valors[$i]["divisa"] = trim(strip_tags(substr($dades[$i], $pos_inici_divisa, $pos_final_divisa - $pos_inici_divisa)));

    $pos_inici_diferencial = strpos($dades[$i], $iniciDivisa, $pos_final_divisa)+18;
    $pos_final_diferencial = strpos($dades[$i], $finalTicker, $pos_inici_diferencial);
    $valors[$i]["diferencial"] = trim(strip_tags(substr($dades[$i], $pos_inici_diferencial, $pos_final_diferencial - $pos_inici_diferencial)));

    $pos_inici_percentatge = strpos($dades[$i], $iniciDivisa, $pos_final_diferencial)+18;
    $pos_final_percentatge = strpos($dades[$i], $finalTicker, $pos_inici_percentatge);
    $valors[$i]["percentatge"] = trim(strip_tags(substr($dades[$i], $pos_inici_percentatge, $pos_final_percentatge - $pos_inici_percentatge)));

    $pos_inici_volum = strpos($dades[$i], $iniciVolum, $pos_final_percentatge)+14;
    $pos_final_volum = strpos($dades[$i], $finalTicker, $pos_inici_volum);
    $valors[$i]["volum"] = trim(strip_tags(substr($dades[$i], $pos_inici_volum, $pos_final_volum - $pos_inici_volum)));

    $pos_inici_minim = strpos($dades[$i], $iniciMinim, $pos_final_volum)+17;
    $pos_final_minim = strpos($dades[$i], $finalTicker, $pos_inici_minim);
    $valors[$i]["minim"] = trim(strip_tags(substr($dades[$i], $pos_inici_minim, $pos_final_minim - $pos_inici_minim)));

    $pos_inici_maxim = strpos($dades[$i], $iniciMaxim, $pos_final_minim)+17;
    $pos_final_maxim = strpos($dades[$i], $finalTicker, $pos_inici_maxim);
    $valors[$i]["maxim"] = trim(strip_tags(substr($dades[$i], $pos_inici_maxim, $pos_final_maxim - $pos_inici_maxim)));

    $pos_inici_data = strpos($dades[$i], $iniciData, $pos_final_maxim);
    $pos_final_data = strpos($dades[$i], $finalData, $pos_inici_data);
    $valors[$i]["data"] = trim(strip_tags(substr($dades[$i], $pos_inici_data, $pos_final_data - $pos_inici_data)));

    $pos_inici_hora = strrpos($dades[$i], $iniciData, $pos_final_data);
    $pos_final_hora = strrpos($dades[$i], $finalData, $pos_inici_hora);
    $valors[$i]["hora"] = trim(strip_tags(substr($dades[$i], $pos_inici_hora, $pos_final_hora - $pos_inici_hora)));
}
?>

<h2>Cotitzacions</h2>

<table class="tabla7">
    <thead>
        <tr>
            <th class="tabla7">Nom</th>
            <th class="tabla7">Ticker</th>
            <th class="tabla7">Mercado</th>
            <th class="tabla7">Ultima Cotización</th>
            <th class="tabla7">Divisa</th>
            <th class="tabla7">Diferencial</th>
            <th class="tabla7">Percentatge</th>
            <th class="tabla7">Volum</th>
            <th class="tabla7">Minim</th>
            <th class="tabla7">Maxim</th>
            <th class="tabla7">Data</th>
            <th class="tabla7">Hora</th>
        <tr>
    </thead>
    <tbody>
        <?php foreach($valors as $empresa => $datos) {
            $i = 0;
            ?>
            <tr>
                <?php foreach($datos as $clau => $valor) { 
                    if(isset($_SESSION['ultima'])) {
                        $sesion = $_SESSION['ultima'];
                        if($clau == 'ultima_cotizacion') {
                            if(floatval($sesion[$i]['ultima_cotizacion']) > floatval($datos[$clau])) {
                                echo "<td class=\"tabla7 verde\">$datos[$clau]</td>";
                            } else if(floatval($sesion[$i]['ultima_cotizacion']) < floatval($datos[$clau])) {
                                echo "<td class=\"tabla7 rojo\">$datos[$clau]</td>";
                            } else {
                                echo "<td class=\"tabla7\">$datos[$clau]</td>";
                            }
                        } else {
                            echo "<td class=\"tabla7\">$datos[$clau]</td>";
                        }
                    } else {
                        echo "<td class=\"tabla7\">$datos[$clau]</td>";
                    }  
                 } ?>
            </tr>
        <?php 
        $i++;
    } ?>
    </tbody>
</table>

<?php $_SESSION['ultima'] = $valors; ?>