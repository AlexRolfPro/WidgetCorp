<?php
  function confirm_query($result_set) {
    // проверяем или запрос правильный
    if (!$result_set) {
      die("Соединене с базой провалилось");
    }
  }
  function find_all_subjects() {
          global $connection; // для использования внутри функции
    // выполняем запрос к базе данных
          $query = "SELECT * ";
          $query .= "FROM subjects ";
          $query .= "WHERE visible = 1 ";
          $query .= "ORDER BY position ASC";
          $subject_set = mysqli_query($connection, $query);
          // проверяем или запрос правильный
          confirm_query($subject_set);
          return $subject_set;  // локальная переменная
  }

  function find_pages_for_subject($subject_id) {
      global $connection;

      // выполняем запрос к базе данных
      $query = "SELECT * ";
      $query .= "FROM pages ";
      $query .= "WHERE visible = 1 ";
      $query .= "AND subject_id = {$subject_id} ";
      $query .= "ORDER BY position ASC";
      $page_set = mysqli_query($connection, $query);
      // проверяем или запрос правильный
      confirm_query($page_set);
      return $page_set; // вернуть набор страниц
  }
 ?>
