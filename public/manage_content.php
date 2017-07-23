<?php require_once("../includes/db_connection.php"); // 1. создаем соединение с базой данных ?>
<?php require_once("../includes/functions.php"); // подключаем свои функции ?>

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
    <ul class="subjects">
      <?php $subject_set = find_all_subjects();
      // 2. выполняем запрос к базе данных  ?>

      <?php while($subject = mysqli_fetch_assoc($subject_set)) {
        // 3. Использование возвращенных данных (если есть) ?>

        <li>
          <?php echo $subject["menu_name"]; ?>
          <?php
          // 2. выполняем запрос к базе данных
            $page_set = find_pages_for_subject($subject["id"]);
          ?>
          <ul class="pages">
            <?php while($page = mysqli_fetch_assoc($page_set)) {
              // Использование возвращенных данных (если есть) ?>
              <li>
                <?php echo $page["menu_name"]; ?>
              </li>
            <?php
              }
            ?>
            <?php mysqli_free_result($page_set);
            // Отпустить/освободить возвращенные данные ?>
          </ul>
        </li>
       <?php
      }
       ?>
     <?php mysqli_free_result($subject_set);
     // 4. Отпустить/освободить возвращенные данные ?>
    </ul>
  </div>
  <div id="page">
    <h2>Управление контентом сайта</h2>

  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

<?php mysqli_close($connection);
// 5. Закрыть соединение с базой данных ?>
