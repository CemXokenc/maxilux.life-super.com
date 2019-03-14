<?php

echo "memory_limit<br/>";
echo ini_get('memory_limit') . "<br />";
ini_set('memory_limit', '1024M');
echo ini_get('memory_limit') . "<br />";
?>

<br /><br />

Code:<br />
echo "memory_limit";
echo ini_get('memory_limit');
ini_set('memory_limit', '1024M');
echo ini_get('memory_limit');