<?php
    include_once('functions.php');
    load('classes/GuestBook');
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
            $errors[0] = $error1;
        }
        if (!filter_var($frmMail, FILTER_VALIDATE_EMAIL)) {
            $errors[1] = $error2;
        }
        if (strlen($frmMsg)==0) {
            $errors[2] = $error3;
        }
        
        if (!isset($errors)) {
            $guestBook = new GuestBook($frmNom, $frmMail, $frmMsg);
            $guestBook->create();
            unset($frmNom);
            unset($frmMail);
            unset($frmMsg);
        }
    }

    $guest = new GuestBook('', '', '');
    $comments_array = $guest->read();
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
            <?php if(isset($errors[0])) { ?>
                <span class="error"><?php echo $errors[0];?></span><br>
            <?php } ?>
            <label for="email"><?php echo $email ?></label>
            <input type="text" name="email" placeholder="<?php echo $email;?>" value="<?php echo $frmMail; ?>">
            <?php if(isset($errors[1])) { ?>
                <span class="error"><?php echo $errors[1];?></span><br>
            <?php } ?>
            <label for="missatge"><?php echo $message ?></label>
            <textarea name="missatge" placeholder="<?php echo $message;?>" cols="50"><?php echo $frmMsg; ?></textarea>
            <?php if(isset($errors[2])) { ?>
                <span class="error"><?php echo $errors[2];?></span><br>
            <?php } ?>
            <input type="submit" name="boto" value="<?php echo $submit;?>" class="btn">
        </form>
    </div>
    <h1 class="title"><?php echo $comments ?></h1>
    <div class="comments">
        <?php
        $count = 0;
            foreach($comments_array as $key => $value) {
                if($count % 2 == 0) {
                    echo "<div class='comment parell'>";
                } else {
                    echo "<div class='comment senar'>";
                }

                foreach($value as $data => $info) {
                    if($data != "MAIL") {
                        echo "<p><span><b>$data:</b></span> $info";
                    }
                }
                echo "</div>";
                $count++;             
            }
        ?>
    </div>
    