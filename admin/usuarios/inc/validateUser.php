<?php

if (!$_SESSION["validUser"]){
	redirect("/bdc/login.php");
}
?>