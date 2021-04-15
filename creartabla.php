<?php
include 'class.pdofactory.php';
include 'abstract.databoundobject.php';
include 'class.palabra.php';

$strDSN = "pgsql:dbname=postgres;host=localhost;port=5432"; //Connexió BBDD
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "postgres", 
            array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query="SELECT * FROM palabra WHERE palabra LIKE '".$_POST['palabra']."%' order by total desc limit 5 ";
	$html="<table border>";
		$html.="<tr>";
			$html.="<td><b>id</b></td>";
			$html.="<td><b>palabra</b></td>";
			$html.="<td><b>total</b></td>";
			$html.="<td><b>lastvisit</b></td>";
		$html.="</tr>";
	foreach ($objPDO->query($query) as $row) {
		$html.="<tr>";
			$html.="<td>". $row[0] ."</td>";
			$html.="<td>". $row[1] ."</td>";
			$html.="<td>". $row[2] ."</td>";
			$html.="<td>". $row[3] ."</td>";
		$html.="<tr>";
	}
	$html.="</table>";

	echo $html;

?>