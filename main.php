<?php

include 'arrotonda_entrata.php';
include 'arrotonda_uscita.php';

// example for entry 

$datetimeEntry = new DateTime("2024-11-09 8:05");
$roundedEntrata = arrotondaEntrata($datetimeEntry, 15, 5);
echo "Entrata: " . $roundedEntrata->format("Y-m-d H:i") . "\n";

$datetimeEntry = new DateTime("2024-11-09 08:06");
$roundedEntrata = arrotondaEntrata($datetimeEntry, 15, 5);
echo "Entrata: " . $roundedEntrata->format("Y-m-d H:i") . "\n";

// example for exit 

$datetimeExit = new DateTime("2024-11-09 17:54");
$roundedUscita = arrotondaUscita($datetimeExit, 15, 5);
echo "Uscita: " . $roundedUscita->format("Y-m-d H:i") . "\n";

$datetimeExit = new DateTime("2024-11-09 17:55");
$roundedUscita = arrotondaUscita($datetimeExit, 15, 5);
echo "Uscita: " . $roundedUscita->format("Y-m-d H:i") . "\n";

?>