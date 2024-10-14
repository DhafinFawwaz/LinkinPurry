<?php

require_once __DIR__ . "/../lib/database.php";

// TODO: env loader
$db = new Database("db", "5432", "job", "postgres", "12345678");
$db->migrate();

echo "Database migrated successfully\n";
