<?php
$db_path = 'config/db/db.php';
$main_path = 'app/view/pages/main.php';
if (file_exists($db_path)) {
    require($db_path);
    echo '<script>console.log("database connected");</script>';
    if (file_exists($main_path)) {
        require($main_path);
        echo '<script>console.log("home page found");</script>';
    } else {
        echo '<script>console.log("home page is not found");</script>';
    }
} else {
        echo '<script>console.log("database is not connected");</script>';
}
?>
