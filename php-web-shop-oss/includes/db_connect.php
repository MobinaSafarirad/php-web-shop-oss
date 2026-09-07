<?php

$link = mysqli_connect("127.0.0.1", "myshop_user", "1234", "myshop_database");

if (mysqli_connect_errno())
    exit("A database connection error occurred: " . mysqli_connect_error());

mysqli_set_charset($link, "utf8");

?>