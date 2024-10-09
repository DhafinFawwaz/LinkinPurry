<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Epic Website</title>
</head>
<body>
    
<div id="anotherthing">anotherthing</div>

<?php

$dbconn = pg_connect("host=db port=5432 dbname=job user=postgres password=12345678");
if (!$dbconn) {
    echo "An error occurred.\n";
    exit;
}


pg_query(
    $dbconn, 
"
    CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL
    );
"
);

$insertUserQuery = "INSERT INTO users (name, email) VALUES ($1, $2);";
$result = pg_prepare($dbconn, "Insert users", $insertUserQuery);


$path = $_SERVER['REQUEST_URI'];
$result = pg_execute(
    $dbconn, 
    "Insert users",
    array($path, $path . "@gmail.com")
);

$result = pg_query($dbconn, "SELECT * FROM users");

while ($row = pg_fetch_row($result)) {
    echo "id: $row[0] name: $row[1] email: $row[2]<br>";
}

echo '<br>Hello World!';
echo '<div id=something>something</div>';

if ($path == '/') {
    echo "try <a href='/kodok'>try this</a>";
}
else echo 'path:' . $path;

echo '<script src="/public/index.js"></script>';

include 'testimport.php';
echo "<br>";
testimport(123);
?>


</body>
</html>