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
    <?php // include("../includes/layouts/navigation.php"); // первый вариант?>
    <?php echo navigation($select_subject_id, $select_page_id); // 2 вариант?>

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
