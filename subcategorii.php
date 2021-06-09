<?php
include('config.php');


if (isset($_GET['cat'])) {

	echo "obj.options[obj.options.length] = new Option('Alege','');\n";
	$cerereSQL = 'SELECT * FROM `subcat` WHERE `cat`="' . $_GET['cat'] . '" ORDER BY `nume` ASC';
	$rezultat = mysqli_query($conexiune, $cerereSQL);
	while ($rand = mysqli_fetch_assoc($rezultat)) {
		if ($rand['nume'] != "Altele")	echo "obj.options[obj.options.length] = new Option('" . $rand["nume"] . "','" . $rand["nume"] . "');\n";
	}
	echo "obj.options[obj.options.length] = new Option('Altele','Altele');\n";
}
