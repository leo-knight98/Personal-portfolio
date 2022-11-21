<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('functions.php');
    $errors = [];
    if(isset($_POST['submit'])) {
        foreach($_POST as $key => $value) {
            $value = sanitize($value);
        }

        if(strlen($_POST['name']) == 0) {
            $errors['nom'] = "Hi ha d'haver un nom";
            echo $errors['nom'];
        }

        if(strlen($_POST['email']) == 0) {
            $errors['email'] = "Hi ha d'haver un email";
            echo $errors['email'];
        }

        if(strlen($_POST['password']) < 8) {
            $errors['password'] = "La contrasenya és massa curta";
            echo $errors['password'];
        } else if($_POST['password'] != $_POST['confirm']) {
            $errors['password'] = "La contrasenya i la confirmació han de ser iguals";
            echo $errors['password'];
        }
        

        if(sizeof($errors) == 0) {
            $filecount = count(glob('uploads/' . "*"));
            $filecount++;
            if($_FILES['img']['type'] != 'image/jpeg' && $_FILES['img']['type'] != 'image/png' && $_FILES['img']['type'] != 'image/gif') {
                $errors['img'] = 'El format de la imatge no és correcte';
                echo $errors['img'];
            }

            if($_FILES['img']['size'] > 2097152) {
                $errors['img'] = 'La imatge és massa gran';
                echo $errors['img'];
            }

            if(empty($errors)) {
                $tmp_name = $_FILES['img']['name'];
                $newName = 'uploads/' . $filecount . '_' . $name;
                $result = move_uploaded_file($tmp_name, $newName);

                if(!$result) {
                    $errors['img'] = "No s'ha pogut moure la imatge";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $register ?></title>
</head>
<body>
    <h1><?php echo $register ?></h1>
    <div class="register-form">
        <form action="?pagina=register" method="post" enctype="multipart/form-data">
            <label for="name"><?php echo $name ?></label>
            <input type="text" name="name" id="name" />
            <label for="email"><?php echo $email ?></label>
            <input type="text" name="email" id="email" />
            <label for="password"><?php echo $password_form ?></label>
            <input type="password" name="password" id="password" />
            <label for="confirm"><?php echo $password_confirm ?></label>
            <input type="password" name="confirm" id="confirm" />
            <label for="gender"><?php echo $gender ?></label><br>
            <select name="gender" id="gender">
                <option value="male"><?php echo $male ?></option>
                <option value="female"><?php echo $female ?></option>
                <option value="nb"><?php echo $nb ?></option>
                <option value="other"><?php echo $other ?></option>
            </select>
            <p><?php echo $age ?></p>
            <input type="radio" name="age" value="adult" />
            <label for="adult"><?php echo $adult ?><br>
            <input type="radio" name="age" value="minor" />
            <label for="minor"><?php echo $minor ?><br>
            <input type="file" name="img" />
            <input type="submit" value="<?php echo $submit ?>" name="submit" />
        </form>
    </div>
</body>
</html>