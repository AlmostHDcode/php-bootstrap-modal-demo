<?php
putenv("host=localhost");
putenv("user=");
putenv("pass=");
putenv("db=");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect(getenv("host"),getenv("user"),getenv("pass"),getenv("db"));
} catch (\mysqli_sql_exception $e) {
    die("Connection Error: $e");
}
?>
