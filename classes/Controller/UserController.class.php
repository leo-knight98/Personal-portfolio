<?php
class UserController extends Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function login() {
        if(($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST["submit"] != null)) {
            $sEmail = $this->sanitize($_POST["email"], 1);
            $sPassword = $this->sanitize($_POST["pass"], 0);

            if($sEmail == "" || $sPassword == "") {
                $errorsDetectats = "L'usuari o la contrasenya són incorrectes";
            } else if(!$this->esEmail($sEmail)) {
                $errorsDetectats = "El correu electrònic no és correcte";
                unset($sEmail);
            } else {
                $model = new UserModel();
                $lUser = $model::getOneByMail($sEmail);
                if(count($lUser) == 0) {
                    $errorsDetectats = "No estàs registrat";
                } else {
                    if($lUser[0]['password'] != $sPassword) {
                        $errorsDetectats = "Contrasenya incorrecta";
                    } else {
                        $_SESSION['user_id'] = $lUser[0]['id'];
                        header("Location: ?/home/show");
                        return;
                    }
                }
            }
        }
        $vista = new UserView();
        $vista->login();        
    }
    
    public function registre() {
        if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST[""] == "")) {
            $sEmail = $this->sanitize($_POST["email"], 1);
            $sPassword = $this->sanitize($_POST["pass"], 0);
            $cPassword = $this->sanitize($_POST["cpass"], 0);
            
            $sTipus = $this->sanitize($_POST["tipus"], 2);
            $sDni = $this->sanitize($_POST["dni"], 2);
            $sNom = $this->sanitize($_POST["nom"], 1);
            $sCognoms = $this->sanitize($_POST["cognoms"], 1);
            $sSexe = $this->sanitize($_POST["sexe"], 2);
            $dNaixement = $this->sanitize($_POST["naixement"], 0);
            
            $sAdreca = $this->sanitize($_POST["adreca"], 1);
            $sCP = $this->sanitize($_POST["cp"], 0);
            $sPoblacio = $this->sanitize($_POST["poblacio"], 1);
            $sProvincia = $this->sanitize($_POST["provincia"], 1);
            $sTelefon = $this->sanitize($_POST["telefon"], 0);
            
            $sImatge = $this->sanitize($_FILES['imatge']['name'], 0);
            
            if ($sEmail == "") {
                $errorsDetectats["email"] = "L'email és una dada obligatòria, si us plau indica-la.";
            } else {
                if (! $this->esEmail($sEmail)) {
                    $errorsDetectats["email"] = "l'email no té un format adient.";
                    unset($sEmail);
                }
            }
            
            if (($sPassword == "") || ($cPassword == "")) {
                $errorsDetectats["pass"] = "El password és una dada obligatòria, si us plau indica-la.";
            } else {
                if ($sPassword != $cPassword) {
                    $errorsDetectats["cpass"] = "La repetició del password no correspon amb el password entrat.";
                }
            }
            
            if (! $this->esTipus($sTipus)) {
                $errorsDetectats["tipus"] = "Hi ha algun error amb el tipus";
                unset($sTipus);
            }
            
            if ($sDni == "") {
                $errorsDetectats["dni"] = "El dni és una dada obligatòria, si us plau indica-la.";
            } else {
                if (($sTipus != "pas") && (! $this->validarNif($sDni))) {
                    $errorsDetectats["dni"] = "El dni no té un format correcte.";
                    unset($sDni);
                }
            }
            
            if ($sNom == "") {
                $errorsDetectats["nom"] = "El nom és una dada obligatòria, si us plau indica-la.";
            } else {
                if (! $this->esNom($sNom)) {
                    $errorsDetectats["nom"] = "El nom no té un format correcte.";
                    unset($sNom);
                }
            }
            
            if ($sCognoms == "") {
                $errorsDetectats["cognoms"] = "El cognom és una dada obligatòria, si us plau indica-la.";
            } else {
                if (! $this->esNom($sCognoms)) {
                    $errorsDetectats["cognoms"] = "El cognom no te un format correcte.";
                    unset($sCognoms);
                }
            }
            
            if (! $this->esSexe($sSexe)) {
                $errorsDetectats["sexe"] = "Hi ha hagut algun problema amb la seleccio de sexe.";
                unset($sSexe);
            }
            
            if ($dNaixement == "") {
                $errorsDetectats["dNaixement"] = "La data de naixement és una dada obligatòria, si us plau indica-la.";
            }
            
            if (($sCP != "") && (! $this->esCodiPostal($sCP))) {
                $errorsDetectats["cp"] = "Els codi postal no correspon a cap població.";
                unset($esCodiPostal);
            }
            
            if (($sProvincia != "") && (! $this->esProvincia($sProvincia))) {
                $errorsDetectats["provincia"] = "La provincia no és una de les espanyoles.";
                unset($sProvincia);
            }
            
            if (($sTelefon != "") && (! $this->esTelefon($sTelefon))) {
                $errorsDetectats["telefon"] = "El format del telèfon no és correcte.";
                unset($sTelefon);
            }
            
            $user = new User();

            $user->email = $sEmail;
            $user->password = $sPassword;
            $user->cPassword = $cPassword;
            $user->tipusIdent = $sTipus;
            $user->numeroIdent = $sDni;
            $user->nom = $sNom;
            $user->cognoms = $sCognoms;
            $user->sexe = $sSexe;
            $user->naixement = $dNaixement;
            $user->adreca = $sAdreca;
            $user->codiPostal = $sCP;
            $user->poblacio = $sPoblacio;
            $user->provincia = $sProvincia;
            $user->telefon = $sTelefon;
            $user->imatge = $sImatge;
             
            if (!isset($errorsDetectats)) {                
                if ($_FILES['imatge']['error'] == 0) { // Si hi ha foto ....
                    $directoriDePujades ="uploads/";			//carpeta on emmagatzemearem les imatges pujades pels usuaris
                    $formatsImatgesPermesos = array('jpg','jpeg','gif','png','tif','tiff','bmp');		  	//formats permesos
                    $mimesImatgesPermesos = array ("image/jpg", "image/jpeg", "image/png", "image/gif", "image/tif", "image/tiff", "image/bmp");
                    
                    $imatge = $_FILES['imatge']['tmp_name']; // carreguem el nom temporal del fitxer
                    $nomOriginal = $_FILES['imatge']['name']; // carreguem el nom original
                    $sImatge = $nomOriginal;
                    $tamany = $_FILES['imatge']['size']; // carreguem el tamany del fitxer en bytes
                    $error = $_FILES['imatge']['error']; // carreguem el tamany del fitxer en bytes
                    $tipus = $_FILES['imatge']['type']; // carreguem el tipus mime del fitxer en bytes
                    
                    if ($error === 0) {
                        $aNom = explode('.', $nomOriginal); // Busquem l'extensió del fitxer
                        $aNomLong = count($aNom); // ens diu quants elements té l'array
                        $sExtensio = strtolower($aNom[-- $aNomLong]);
                        
                        // Verifiquem si hi ha errors en la pujada del fitxer:
                        if (in_array($sExtensio, $formatsImatgesPermesos)) { // format incorrecte per extensió
                            if (in_array($tipus, $mimesImatgesPermesos)) { // format incorrecte per mime
                                if ($tamany > 2097152) { // tamany massa gran
                                    $errorsDetectats["imatge"] = "Error2013 - Tamany excessiu del fitxer";
                                } else {
                                    $nomNou = microtime(true) . '_' . $nomOriginal; // Afegim l'hora per fer un fitxer únic
                                    $rutaNova = $directoriDePujades . $nomNou; // Afegim el path al nom del fitxer
                                    $result = move_uploaded_file($imatge, $rutaNova); // Movem el fitxer a la carpeta
                                    
                                    if ($result) {
                                        $titol = "Procès finalitzat correctament";
                                        $missatge = "El procès de registre ha finacilitzat amb éxit, el mail està validat.<br>Ara ja podràs accedir a la noastra àrea privada.<br><br>Moltes gràcies<br>";
                                        $vista = new ErrorView();
                                        $vista->ok($titol,$missatge);
                                        exit();
                                    } else {
                                        $errorsDetectats["imatge"] = "Error2014 - Problemes al moure el fitxer definitiu";
                                    }
                                }
                            } else {
                                $errorsDetectats["imatege"] = "Error2012 - El format intern del fitxer no està permés";
                            }
                        } else {
                            $errorsDetectats["imatge"] = "Error2011 - Tipus de fitxer amb extensió no permesa";
                        }
                    } 
                } else {
                    if (!isset($_FILES['imatge'])) {
                        $errorsDetectats["imatge"] = "Error2010 - No ha pujat el fitxer.";
                    }
                }
                
                if (isset($errorsDetectats)) {
                    $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
                } else {
                    $titol = "Procès finalitzat correctament";
                    $missatge = "El procès de registre ha finacilitzat amb éxit, el mail està validat.<br>Ara ja podràs accedir a la noastra àrea privada.<br><br>Moltes gràcies<br>";
                    $vista = new ErrorView();
                    $vista->ok($titol,$missatge);

                    $model = new UserModel();
                    $model::create($user);
                    exit();
                }
            } else {
                $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
            }
        }
        
        $vista = new UserView($user);
        $vista->registre($errorsDetectats);
    }

    public function logout() {
        session_unset();
        header("Location: ?/home/show");
    }
    
    public function passwordforgotten() {
        
    }
}

