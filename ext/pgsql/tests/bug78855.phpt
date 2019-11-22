--TEST--
Bug #78855 Native PHP types in database fetches
--SKIPIF--
<?php
include("skipif.inc");
?>
--FILE--
<?php
error_reporting(E_ALL);

include 'config.inc';

$db = pg_connect($conn_str);

$res = pg_query($db, "SELECT null, true, false, 1::smallint, 2::int, 3::oid, 'text', '\\x3031'::bytea");
var_dump(pg_fetch_array($res, 0, PGSQL_NUM));
var_dump(pg_fetch_array($res, 0, PGSQL_NUM|PGSQL_TYPED));

var_dump(pg_fetch_all($res, PGSQL_NUM));
var_dump(pg_fetch_all($res, PGSQL_NUM|PGSQL_TYPED));

?>
--EXPECTF--
array(8) {
  [0]=>
  NULL
  [1]=>
  string(1) "t"
  [2]=>
  string(1) "f"
  [3]=>
  string(1) "1"
  [4]=>
  string(1) "2"
  [5]=>
  string(1) "3"
  [6]=>
  string(4) "text"
  [7]=>
  string(6) "\x3031"
}
array(8) {
  [0]=>
  NULL
  [1]=>
  bool(true)
  [2]=>
  bool(false)
  [3]=>
  int(1)
  [4]=>
  int(2)
  [5]=>
  int(3)
  [6]=>
  string(4) "text"
  [7]=>
  string(2) "01"
}
array(1) {
  [0]=>
  array(8) {
    [0]=>
    NULL
    [1]=>
    string(1) "t"
    [2]=>
    string(1) "f"
    [3]=>
    string(1) "1"
    [4]=>
    string(1) "2"
    [5]=>
    string(1) "3"
    [6]=>
    string(4) "text"
    [7]=>
    string(6) "\x3031"
  }
}
array(1) {
  [0]=>
  array(8) {
    [0]=>
    NULL
    [1]=>
    bool(true)
    [2]=>
    bool(false)
    [3]=>
    int(1)
    [4]=>
    int(2)
    [5]=>
    int(3)
    [6]=>
    string(4) "text"
    [7]=>
    string(2) "01"
  }
}
