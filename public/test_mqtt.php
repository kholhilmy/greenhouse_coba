<?php
$command = 'mosquitto_pub -h localhost -t test/topic -m "Hello GUYS"';
$output = [];
$return_var = 0;
exec($command, $output, $return_var);
echo "Output: " . implode("\n", $output);
echo "\nReturn code: " . $return_var;
?>
