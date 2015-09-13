<?php
	//username and password of root in ubuntu
	$userName = "root";
	$password = "123456";
	
	$pathOfMyApp = "/home/".get_current_user()."/app";
	if(!file_exists($pathOfMyApp)){
		echo shell_exec("sudo -u $userName -p $password mkdir $pathOfMyApp");
		echo shell_exec("sudo -u $userName -p $password chown -R www-data:www-data $pathOfMyApp");
	}
?>