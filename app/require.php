<?php
	// Chargement des bibliothèques nécessaire à partir du dossier des bibliothèques(libraries)
	require_once 'config/config.php';
	require_once 'libraries/Core.php';
	require_once 'libraries/Controller.php';
	require_once 'libraries/Database.php';
	
	require_once 'helpers/categories_helper.php';
	require_once 'helpers/session_helper.php';
	

	
	// Instancie le contrôleur Core
	$init = new Core();
