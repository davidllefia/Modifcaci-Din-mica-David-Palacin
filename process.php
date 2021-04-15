<?php 
//process.php
require("abstract.databoundobject.php");
require("class.pdofactory.php");
require("class.palabra.php");

$strDSN = "pgsql:dbname=postgres;host=localhost;port=5432"; //Connexió BBDD
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", 
            array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$palabra = $_POST["palabra"];

$query="SELECT * FROM palabra WHERE palabra='$palabra'";
$resultado=$objPDO->query($query);

if ($resultado->rowCount()<=0)	{
	$nuevapalabra = new Palabra($objPDO);
	$nuevapalabra->setpalabra($palabra)->settotal(0)->setlastvisit(date("Y-m-d H:i:s"))->Save();
}else{
	foreach ($resultado as $row) {
		$id = $row[0];
		$palabraExiste = new Palabra($objPDO,$id);
		$palabraExiste->settotal($palabraExiste->gettotal()+1)->setlastvisit(date("Y-m-d H:i:s"))->Save();
	}

	$query="SELECT palabra FROM palabra WHERE palabra LIKE '$palabra%' order by total desc limit 5";
	$html="";
	foreach ($objPDO->query($query) as $row) {
		$html.="<option value='". $row['palabra'] ."'>";
	}


	echo $html;

}

?>