<!DOCTYPE html>
<!-- Page construction -->
<?php
	//echo"<head><title>Form Submitted</title></head>";
    openlog("cmsLogger", LOG_PID | LOG_PERROR, LOG_LOCAL0);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
   // $mysqli = new mysqli("localhost:3306", "test", "test", "cms0_1");
    $link = mysqli_connect("localhost:3306", "test", "test", "cms0_1");
    $id = $_GET['id'];
    $statement = mysqli_prepare($link,"select title,created_datetime,summary,detailed from blog_articles where id = ?");
    mysqli_stmt_bind_param($statement,"s",$id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$title,$created_datetime,$summary,$detailed);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    echo "<h1>$title</h1>";
    echo "<p>$summary</p>";
    echo "<p>$detailed</p>";
    syslog(LOG_INFO, "retrieved $title,$created_datetime,$summary,$detailed");
    $statement = mysqli_prepare($link,"select image_id,description,data from blog_images where article_id = ?");
    mysqli_stmt_bind_param($statement,"s",$id);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$image_id,$description,$image_data);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
    echo "retrieved ",$image_id,$description,"<br>";
    echo '<img src="data:image/jpeg;base64,'.base64_encode($image_data).'"/>';
?>
<html>