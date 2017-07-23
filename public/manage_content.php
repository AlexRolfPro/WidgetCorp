<?php require_once("../includes/db_connection.php"); // 1. создаем соединение с базой данных ?>
<?php require_once("../includes/functions.php"); // подключаем свои функции ?>

<?php include("../includes/layouts/header.php"); ?>

<?php
// выясняем какая страница задана
  if (isset($_GET["subject"])) { // задан ли subject
    $select_subject_id = $_GET["subject"];
    $select_page_id = null; // задаем знач. по умолчанию/определяем переменную
  } elseif (isset($_GET["page"])) { // задан ли page
    $select_page_id = $_GET["page"];
    $select_subject_id = null; // задаем знач. по умолчанию/определяем переменную
  } else { // умолчание пока ничего не выбрано
    $select_subject_id = null;
    $select_page_id = null;
  }
 ?>
<div id="main">
  <div id="navigation">
    <ul class="subjects">
      <?php $subject_set = find_all_subjects();
      // 2. выполняем запрос к базе данных  ?>

      <?php while($subject = mysqli_fetch_assoc($subject_set)) {
        // 3. Использование возвращенных данных (если есть) ?>

        <li>
          <a href="manage_content.php?subject=<?php
           echo urlencode($subject["id"]) ?>"> <?php echo $subject["menu_name"]; ?> </a>
          <?php
          // 2. выполняем запрос к базе данных
            $page_set = find_pages_for_subject($subject["id"]);
          ?>
          <ul class="pages">
            <?php while($page = mysqli_fetch_assoc($page_set)) {
              // Использование возвращенных данных (если есть) ?>
              <li>
                <a href="manage_content.php?page=<?php
           echo urlencode($page["id"]) ?>"> <?php echo $page["menu_name"]; ?> </a>
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
    <?php echo $select_subject_id; ?> <br>
    <?php echo $select_page_id; ?>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>

<?php mysqli_close($connection);
// 5. Закрыть соединение с базой данных ?>
