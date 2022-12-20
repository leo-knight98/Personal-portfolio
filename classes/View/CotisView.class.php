<?php
class CotisView extends View{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show($newTable) {
        require_once $this->getFitxer();
        
        $taula = $this->html_generateTable($newTable);
       
        include "templates/head.php";
        include "templates/nav.php";
        include "templates/header.php";
        include "templates/main_cotis.php";
        include "templates/footer.php";
    }
    
    function html_generateTable($aParametre) {
        $capcelera = "<tr>\n";
        $cos = "<tbody>\n";
        
        foreach ($aParametre as $key => $value) {
            $cos .= "<tr>";
            foreach ($value as $clau => $valor) {
                if (!isset($resultat)) {
                    $capcelera .= "<th>".ucwords($clau)."</th>";
                }
                if ($clau == "ultima_coti") {
                    if (isset($_SESSION["cotis"])) {
                        if (floatval(str_replace(",",".",$valor)) > floatval(str_replace(",",".",$_SESSION["cotis"][$key]["ultima_coti"]))) {
                            $cos .= "<td class=\"bgGreen\">$valor</td>";
                        } elseif (floatval(str_replace(",",".",$valor)) < floatval(str_replace(",",".",$_SESSION["cotis"][$key]["ultima_coti"]))) {
                            $cos .= "<td class=\"bgRed\">$valor</td>";
                        } else {
                            $cos .= "<td>$valor</td>";
                        }
                    } else {
                        $cos .= "<td>$valor</td>";
                    }
                } elseif ($clau == "variacio" || $clau == "variacio_percent") {
                    if (floatval(str_replace(",",".",$valor))<0) {
                        $cos .= "<td class=\"red\">$valor</td>";
                    } elseif (floatval(str_replace(",",".",$valor))>0){
                        $cos .= "<td class=\"green\">$valor</td>";
                    } else {
                        $cos .= "<td>$valor</td>";
                    }
                } else {
                    $cos .= "<td>$valor</td>";
                }
            }
            $cos .= "</tr>\n";
            $resultat = "<table>$capcelera</tr>\n";
        }
        $cos .= "</tr>\n</tbody>";
        $resultat .= "$cos</table>";
        
        return $resultat;
    }
    
}