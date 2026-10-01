<?php

if(isset($_COOKIE['chocolat'])){
echo "le cookie existe deja" . $_COOKIE['chocolat'];
} else {
setcookie("chocolat", "noir-70", time() + 3600 * 2);
echo "création cookie";
}