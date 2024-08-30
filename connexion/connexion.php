<?php
	#Demarer la session
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	try {
		$connexion=new PDO('mysql:dbname=gestion_rv; host=localhost', 'root', '');
	} catch (Exception $e) {
		print $e->getMessage();
	}
