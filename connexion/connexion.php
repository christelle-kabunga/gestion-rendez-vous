<?php
	#Demarer la session
	session_start();
	try {
		$connexion=new PDO('mysql:dbname=gestion_rv; host=localhost', 'root', '');
	} catch (Exception $e) {
		print $e->getMessage();
	}
