<?php
include "../partials/FormHeader.blade.php";




if($rec2 == TRUE) {
  $_SESSION['delete_lesson'] = "<div class='success'>Delete Lesson Successfully.</div>";
  header("", 302);
} else {
  $_SESSION['delete_f_lesson'] = "<div class='error'>Failed to Delete lesson.</div>";
  header("", 401);
}
