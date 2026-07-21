<!DOCTYPE html>
<!-- Page construction -->
<?php
	//echo"<head><title>Form Submitted</title></head>";
    openlog("cmsLogger", LOG_PID | LOG_PERROR, LOG_LOCAL0);
	//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect("localhost:3306", "test", "test", "cms0_1");
    $id = $_GET['id'];
    syslog(LOG_INFO, "id = $id");   
    error_log("id = $id") ;   
    if($id === "main"){
        $id_array = ["4","6","19","21"];
        $statement = mysqli_prepare($link,"select id,title,created_datetime,summary,detailed from blog_articles where id in (?,?,?,?)");  
        mysqli_stmt_bind_param($statement,"ssss",$id_array[0],$id_array[1],$id_array[2],$id_array[3]);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement,$article_id,$title,$created_datetime,$summary,$detailed);
        $objectArray =[];
        $assocArray = array();
        while (mysqli_stmt_fetch($statement)) {
            echo "<h1>$title</h1>";
            echo "<p>$summary</p>";
            echo "<br>";
            syslog(LOG_INFO, "retrieved $title,$created_datetime");  
            $object = new stdClass();
            $object->title = $title;
            $object->summary = $summary;
            $objectArray[] = $object;
            $assocArray[$article_id] = $object;

        }
        $count = count($objectArray);
        syslog(LOG_INFO, "no of articles retrieved: $count");  
     //   syslog(LOG_INFO, var_dump($objectArray[0]->title));  
       // syslog(LOG_INFO, print_r($assocArray));  
        syslog(LOG_INFO, print_r($assocArray['4']->title));  



        mysqli_stmt_close($statement);
 
    } else {

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

    }

?>
<html>