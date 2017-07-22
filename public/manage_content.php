<?php require_once("../includes/db_connection.php"); // 1. создаем соединение с базой данных ?>
<?php require_once("../includes/functions.php"); // подключаем свои функции ?>

<?php
// 2. выполняем запрос к базе данных
  $query = "SELECT * ";
  $query .= "FROM subjects ";
  $query .= "WHERE visible = 1 ";
  $query .= "ORDER BY position ASC";

  $result = mysqli_query($connection, $query);
  // проверяем или запрос правильный
  confirm_query($result);
?>

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
    <ul class="subjects">
      <?php
      // 3. Использование возвращенных данных (если есть)
      while($row = mysqli_fetch_assoc($result)) {
        // вывод данных через каждый ряд
      ?>
        <li>
          <?php echo $row["menu_name"] . " (" . $row["id"] . ")" . "<br />"; ?>
        </li>
       <?php
      }
       ?>
    </ul>
  </div>
  <div id="page">
    <h2>Управление контентом сайта</h2>

  </div>
</div>

<?php
// 4. Отпустить/освободить возвращенные данные
   mysqli_fetch_row($result);
 ?>

<?php include("../includes/layouts/footer.php"); ?>

<?php
// 5. Закрыть соединение с базой данных
mysqli_close($connection);
 ?>
