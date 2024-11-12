<?php

include 'arrotonda_orario.php';

// example for entry

$datetimeEntry = new DateTime("2024-11-09 8:05");
$roundedEntrata = arrotondaOrario($datetimeEntry, 15, 5, TipoArrotondamento::INGRESSO);
echo "Entrata: " . $roundedEntrata->format("Y-m-d H:i") . "\n";

$datetimeEntry = new DateTime("2024-11-09 08:06");
$roundedEntrata = arrotondaOrario($datetimeEntry, 15, 5, TipoArrotondamento::INGRESSO);
echo "Entrata: " . $roundedEntrata->format("Y-m-d H:i") . "\n";

// example for exit

$datetimeExit = new DateTime("2024-11-09 17:54");
$roundedUscita = arrotondaOrario($datetimeExit, 15, 5, TipoArrotondamento::USCITA);
echo "Uscita: " . $roundedUscita->format("Y-m-d H:i") . "\n";

$datetimeExit = new DateTime("2024-11-09 17:55");
$roundedUscita = arrotondaOrario($datetimeExit, 15, 5, TipoArrotondamento::USCITA);
echo "Uscita: " . $roundedUscita->format("Y-m-d H:i") . "\n";

?>
