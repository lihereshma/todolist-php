<?php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'todolist');

  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(!$connection) {
    die("Failed to connect to the database " . mysqli_error($connection));
  }
?>