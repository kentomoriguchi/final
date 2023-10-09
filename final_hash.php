<?php
$pw = password_hash("kentetsuya69",PASSWORD_DEFAULT);
echo $pw;

echo "<br>";
var_dump(password_verify('kentetsuya69', $pw));

?>