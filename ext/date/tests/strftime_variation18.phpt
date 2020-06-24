--TEST--
Test strftime() function : usage variation - Checking day related formats which are supported other than on Windows.
--SKIPIF--
<?php
if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
    die("skip Test is not valid for Windows");
}
?>
--FILE--
<?php
echo "*** Testing strftime() : usage variation ***\n";

// Initialise function arguments not being substituted (if any)
setlocale(LC_ALL, "en_US");
date_default_timezone_set("Asia/Calcutta");
$timestamp = mktime(8, 8, 8, 8, 8, 2008);

echo "\n-- Testing strftime() function with Day of the month as decimal single digit format --\n";
$format = "%e";
var_dump( strftime($format) );
var_dump( strftime($format, $timestamp) );
?>
--EXPECTF--
*** Testing strftime() : usage variation ***

-- Testing strftime() function with Day of the month as decimal single digit format --
string(%d) "%s"
string(2) " 8"
