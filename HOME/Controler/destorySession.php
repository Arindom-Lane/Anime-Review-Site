<?php 
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <script>
        localStorage.removeItem('theme');
        window.location.href = "../View/login.php";
    </script>
</head>
</html>