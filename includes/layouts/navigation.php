<ul class="subjects">
  <?php $subject_set = find_all_subjects();
  // 2. выполняем запрос к базе данных  ?>

  <?php while($subject = mysqli_fetch_assoc($subject_set)) {
    // 3. Использование возвращенных данных (если есть) ?>
    <?php
      echo "<li";
      if($subject["id"] == $select_subject_id) { //когда текущий id равен выбраному
        echo " class=\"active\""; // класс который подсвечивает выбранное
      }
      echo ">";
    ?>
      <a href="manage_content.php?subject=<?php
       echo urlencode($subject["id"]) ?>"> <?php echo $subject["menu_name"]; ?> </a>
      <?php
      // 2. выполняем запрос к базе данных
        $page_set = find_pages_for_subject($subject["id"]);
      ?>
      <ul class="pages">
        <?php while($page = mysqli_fetch_assoc($page_set)) {
          // Использование возвращенных данных (если есть) ?>
          <?php
            echo "<li";
            if($page["id"] == $select_page_id) {
              echo " class=\"active\"";
            }
            echo ">";
          ?>
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
