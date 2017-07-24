<?php
  function confirm_query($result_set) {
    // проверяем или запрос правильный
    if (!$result_set) {
      die("Соединене с базой провалилось 1");
    }
  }

  function find_all_subjects() {
          global $connection; // для использования внутри функции
    // выполняем запрос к базе данных
          $query = "SELECT * ";
          $query .= "FROM subjects ";
          // $query .= "WHERE visible = 1 ";
          $query .= "ORDER BY position ASC";
          $subject_set = mysqli_query($connection, $query);
          // проверяем или запрос правильный
          confirm_query($subject_set);
          return $subject_set;  // локальная переменная
  }

  function find_pages_for_subject($subject_id) {
      global $connection;

      $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
          // защита от sql инекции

      // выполняем запрос к базе данных
      $query = "SELECT * ";
      $query .= "FROM pages ";
      $query .= "WHERE visible = 1 ";
      $query .= "AND subject_id = {$safe_subject_id} ";
      $query .= "ORDER BY position ASC";
      $page_set = mysqli_query($connection, $query);
      // проверяем или запрос правильный
      confirm_query($page_set);
      return $page_set; // вернуть набор страниц
  }

  function find_subject_by_id($subject_id) {
    global $connection; // для использования внутри функции

    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    // защита от sql инекции

    // выполняем запрос к базе данных
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE id = {$safe_subject_id} ";
    $query .= "LIMIT 1";
    $subject_set = mysqli_query($connection, $query);
    // var_dump($connection, $query); // отладка ошибки поиск
    // проверяем или запрос правильный
    confirm_query($subject_set);
    if ($subject = mysqli_fetch_assoc($subject_set)) {
      return $subject;  // локальная переменная
    } else {
      return null;
    }
  };

  function navigation($subject_id, $page_id) {
    // навигация берет 2 аргумента
    // текущий выбранный subject id (если есть)
    // текущий выбранный page id (если есть)
      $output = "<ul class=\"subjects\">";
      $subject_set = find_all_subjects();
        // 2. выполняем запрос к базе данных
        while($subject = mysqli_fetch_assoc($subject_set)) {
          // 3. Использование возвращенных данных (если есть)
            $output .= "<li";
            if($subject["id"] == $subject_id) { //когда текущий id равен выбраному
              $output .= " class=\"active\""; // класс который подсвечивает выбранное
            }
            $output .= ">";

            $output .= "<a href=\"manage_content.php?subject=";
            $output .= urlencode($subject["id"]);
            $output .= "\">";
            $output .= $subject["menu_name"];
            $output .= "</a>";

            // 2. выполняем запрос к базе данных
            $page_set = find_pages_for_subject($subject["id"]);
            $output .= "<ul class=\"pages\">";
            while($page = mysqli_fetch_assoc($page_set)) {
                // Использование возвращенных данных (если есть)
                  $output .= "<li";
                  if($page["id"] == $page_id) {
                    $output .= " class=\"active\"";
                  }
                  $output .= ">";
                  $output .= "<a href=\"manage_content.php?page=";
                  $output .= urlencode($page["id"]);
                  $output .= "\">";
                  $output .= $page["menu_name"];
                  $output .= "</a></li>";
                }
                mysqli_free_result($page_set);
              // Отпустить/освободить возвращенные данные
            $output .= "</ul></li>";
      }
      mysqli_free_result($subject_set);
       // 4. Отпустить/освободить возвращенные данные
      $output .= "</ul>";
      return $output;
  }
 ?>
