<?php
    include_once('functions.php');
    $isOk = false;
    $frmNom = '';
    $frmMail = '';
    $frmMsg = '';
    if ($_SERVER["REQUEST_METHOD"]=="POST" && (isset($_POST["boto"]))) {
        $frmNom = sanitize($_POST["nom"],4);
        //$frmNom=$_POST["nom"];
        $frmMail = sanitize($_POST["email"],1);
        $frmMsg = sanitize($_POST["missatge"],3);
        
        if (strlen($frmNom)==0) {
            $errors[0] = "Has d'informar un nom";
        }
        if (!filter_var($frmMail, FILTER_VALIDATE_EMAIL)) {
            $errors[1] = "L'adreça de correu no és vàlida";
        }
        if (strlen($frmMsg)==0) {
            $errors[2] = "Has d'escriure el comentari que vols enviar";
        }
        
        if (!isset($errors)) {
            if ($sFile = file_get_contents("ficheros/contact.xml")) {
                $sLlibre = substr($sFile,0,-14);
                $sData = getdate();
                $sLlibre .= "\n    <REGISTRE>\n        <DATA>".$sData['mday']."/".$sData['mon']."/".$sData['year']."</DATA>\n";
                $sLlibre .="        <NOM>$frmNom</NOM>\n        <MAIL>$frmMail</MAIL>\n";
                $sLlibre .= "        <COMENTARI>$frmMsg</COMENTARI>\n    </REGISTRE> \n";
                $sLlibre .= "</REGISTRES>";
                if ($file = fopen("ficheros/contact.xml", "w")) {
                    if (!fputs($file,$sLlibre)) {
                        die ("El fitxer no deixa escriure");
                    }
                    fclose($file);
                } else {
                    die ("No s'ha pogut obrir el fitxer per emmagatzemar informació");
                }
                unset($frmNom);
                unset($frmMail);
                unset($frmMsg);
                $isOk = true;
            }
        }
    }
?>
    <?php if($isOk) { ?>
        <div class="correct">
            <p><?php echo $ok;?></p>
        </div>
    <?php } ?>
    <h1 class="title"><?php echo $contact ?></h1> 
    <div class="form-contact">
        <form action="?pagina=contact-me" method="post" target=_blank" class="form-contact">
            <label for="nom"><?php echo $name ?></label>
            <input type="text" name="nom" placeholder="<?php echo $name;?>" value="<?php echo $frmNom; ?>">
            <?php if(isset($errors)) { ?>
                <span class="error"><?php echo $errors[0];?></span>
            <?php } ?>
            <label for="email"><?php echo $email ?></label>
            <input type="text" name="email" placeholder="<?php echo $email;?>" value="<?php echo $frmMail; ?>">
            <?php if(isset($errors)) { ?>
                <span class="error"><?php echo $errors[1];?></span>
            <?php } ?>
            <label for="missatge"><?php echo $message ?></label>
            <textarea name="missatge" placeholder="<?php echo $message;?>" cols="50"><?php echo $frmMsg; ?></textarea>
            <?php if(isset($errors)) { ?>
                <span class="error"><?php echo $errors[2];?></span>
            <?php } ?>
            <input type="submit" name="boto" value="<?php echo $submit;?>" class="btn">
        </form>
    </div>