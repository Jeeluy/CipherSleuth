<?php 
session_start();

session_unset();
session_destroy();

 setcookie("admin_user", null, time() - (86400 * 30), "/");
 echo "<meta http-equiv='refresh' content='0;url=index.php'>";
?>