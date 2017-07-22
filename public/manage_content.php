<?php require_once("../includes/db_connection.php"); // 1. создаем соединение с базой данных ?>
<?php require_once("../includes/functions.php"); // подключаем свои функции ?>

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
    <ul class="subjects">
      <?php
      // 2. выполняем запрос к базе данных
        $query = "SELECT * ";
        $query .= "FROM subjects ";
        $query .= "WHERE visible = 1 ";
        $query .= "ORDER BY position ASC";
        $subject_set = mysqli_query($connection, $query);
        // проверяем или запрос правильный
        confirm_query($subject_set);
      ?>
      <?php
        // 3. Использование возвращенных данных (если есть)
        while($subject = mysqli_fetch_assoc($subject_set)) {
      ?>
        <li>
          <?php echo $subject["menu_name"]; ?>
          <?php
          // 2. выполняем запрос к базе данных
            $query = "SELECT * ";
            $query .= "FROM pages ";
            $query .= "WHERE visible = 1 ";
            $query .= "AND subject_id = {$subject["id"]} ";
            $query .= "ORDER BY position ASC";
            $page_set = mysqli_query($connection, $query);
            // проверяем или запрос правильный
            confirm_query($page_set);
          ?>
          <ul class="pages">
            <?php
              // Использование возвращенных данных (если есть)
              while($page = mysqli_fetch_assoc($page_set)) {
            ?>
              <li><?php echo $page["menu_name"]; ?></li>
            <?php
              }
            ?>
            <?php
            // Отпустить/освободить возвращенные данные
               mysqli_free_result($page_set);
            ?>
          </ul>
        </li>
       <?php
      }
       ?>
     <?php
     // 4. Отпустить/освободить возвращенные данные
        mysqli_free_result($subject_set);
      ?>
    </ul>
  </div>
  <div id="page">
    <h2>Управление контентом сайта</h2>

  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

<?php
// 5. Закрыть соединение с базой данных
mysqli_close($connection);
 ?>
