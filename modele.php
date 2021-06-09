<?php
include('config.php');


if (isset($_GET['mar'])) {

    echo "obj.options[obj.options.length] = new Option('Alege','');\n";
    if (isset($_GET['ser'])) {
        $cerereSQL = 'SELECT * FROM `serie` WHERE `marca`="' . $_GET['mar'] . '" ORDER BY `nume` ASC';
        $rezultat = mysqli_query($conexiune, $cerereSQL);
    } else {
        $cerereSQL = 'SELECT * FROM `model` WHERE `marca`="' . $_GET['mar'] . '" ORDER BY `nume` ASC';
        $rezultat = mysqli_query($conexiune, $cerereSQL);
    }
    while ($rand = mysqli_fetch_assoc($rezultat)) {
        echo "obj.options[obj.options.length] = new Option('" . $rand["nume"] . "','" . $rand["nume"] . "');\n";
    }
    echo "obj.options[obj.options.length] = new Option('Alta','');\n";
}
