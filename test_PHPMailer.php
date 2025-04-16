<?php
// Įjunk klaidų rodymą
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Bandome įtraukti PHPMailer failus
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';





// Jei sėkmingai įkelta
echo "PHPMailer biblioteka įkelta sėkmingai.";
?>
