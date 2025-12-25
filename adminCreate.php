<?PHP 
include ("db.php");
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
    header('Location: login.php');
 }

?>