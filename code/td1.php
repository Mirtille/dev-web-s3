<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TD1</title>
</head>
<body>

<h1>Première chaîne avec <strong>mise en gras</strong></h1>
<h3>Deuxième chaîne</h3>
<h2>Troisième chaîne</h2>

<?php
$v1 = 42;
$v2 = 73;

echo "<p>Somme : " . ($v1 + $v2) . "</p>\n";
echo "<p>Différence : " . ($v1 - $v2) . "</p>\n";

echo "<p>Type v1 : " . gettype($v1) . "</p>\n";
echo "<p>Type v2 : " . gettype($v2) . "</p>\n";

$v1 = "442";
echo "<p>Nouveau type v1 : " . gettype($v1) . "</p>\n";
echo "<p>Somme : " . ($v1 + $v2) . "</p>\n";

$a = 1337;
$b = 01337;
$c = 0x1337;
$d = 3.14159;
$e = "yopyop";
$f = 'yepyep';
$g = true;
$h = false;

echo "<p>la variable a est de type: " . gettype($a) . " et a pour valeur: $a</p>\n";
echo "<p>la variable b est de type: " . gettype($b) . " et a pour valeur: $b</p>\n";
echo "<p>la variable c est de type: " . gettype($c) . " et a pour valeur: $c</p>\n";
echo "<p>la variable d est de type: " . gettype($d) . " et a pour valeur: $d</p>\n";
echo "<p>la variable e est de type: " . gettype($e) . " et a pour valeur: $e</p>\n";
echo "<p>la variable f est de type: " . gettype($f) . " et a pour valeur: $f</p>\n";
echo "<p>la variable g est de type: " . gettype($g) . " et a pour valeur: " . var_export($g, true) . "</p>\n";
echo "<p>la variable h est de type: " . gettype($h) . " et a pour valeur: " . var_export($h, true) . "</p>\n";

echo "<p>\"variable v1: $v1\"</p>\n";
echo '<p>\'variable v2: $v2\'</p>' . "\n";

$v1 = 42;
echo "<p>la variable \$v1 vaut $v1</p>\n";
echo "<p>la variable \"\$v2\" vaut $v2</p>\n";
?>

</body>
</html>
