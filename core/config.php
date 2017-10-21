<?php
	$pos = filter_input_array(INPUT_POST); // permet de recuperer tout ce qui vient du formulaire via post
	$get = filter_input_array(INPUT_GET); // permet de recuperer tout ce qui vient du formulaire get
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

	function __autoload($name){
		
		$file = dirname(__FILE__)."/classes/".strtolower($name).".php";
		require_once($file);
	}
	//************* Definition des parametres de la BD ************
	define("BDHOST", "localhost");
	define("BDUSER", "root");
	define("BDPASS", "");
	define("BDBD", "mccroftbd");
	$contenuPage = "contenus/accueil.php";
	$db = new Database();
       
	include_once(dirname(__FILE__)."/fonctions.php");
	$msg = array();
?> 
