<?php
// 1. создаем соединение с базой данных
define("DB_SERVER", "localhost");
define("DB_USER", "widget_cms");
define("DB_PASS", "12345678");
define("DB_NAME", "widget_corp");

  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// проверяем или соединение произошло
if (mysqli_connect_errno()) {
  die("Соединение провалилось: " .
    mysqli_connect_error() .
      " (" . mysqli_connect_errno() . ")"
  );
}
?>
