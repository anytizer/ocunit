<?php
header("Content-Type: text/plain");

$configurations = parse_ini_file("../config.ini", true, INI_SCANNER_NORMAL);
print_r($configurations);
