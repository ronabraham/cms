<?php
	//echo"<head><title>Form Submitted</title></head>";
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "test", "test", "cms0_1");
    $uid = uniqid() ;
    $created_timestamp = date('Y-m-d H:i:s');
    $title = $_POST['title'];
    $summary =  $_POST['postSummary'];
    $detail = $_POST['postDescription'];
    echo $mysqli->host_info;
    echo $uid;
    echo $title;
    echo $summary;
    echo $detail;
    
    $insert_statement = $mysqli->prepare("insert into blog_articles(uid,title,created_datetime,summary,detailed) values (?,?,?,?,?)");
    $insert_statement->bind_param('sssss',$uid,$title,$created_timestamp,$summary,$detail);
    $insert_statement->execute();
    echo "affected rows: ",$insert_statement->affected_rows;
    echo "temp dir : ",sys_get_temp_dir();
    echo "<br>image : ",$_FILES['postImage']['name'];
    echo "<br>image name: ",$_FILES['postImage']['tmp_name'];
    echo "<br>image size: ",$_FILES['postImage']['size'];
    $image_size = $_FILES['postImage']['size'];
    if($image_size>0) {

        $filename = $_FILES['postImage']['tmp_name'];
        $file = fopen($filename, "rb");

        if(!$file){
         //   echo "<h6>Unable to open file</h6>";
            error_log("Unable to open file $filename");
        } else
        {   
          //  echo "<h6>image read successful</h6>";
            syslog(LOG_INFO,"image read successful : $filename");
            $contents = fread($file,$image_size);
            $image_uid = uniqid();
            $description = "test image description";
            $image_type = 'section';
            //$article_id = "1";
            $select_statement = $mysqli->prepare("SELECT id from blog_articles where uid = ?");
            $select_statement->bind_param('s',$uid);
            $result = $select_statement->execute();
            if($result){
              $data = $select_statement->get_result();
              $row = $data->fetch_assoc();
              echo "row data : ",var_dump($row),$row['id'];
              $article_id = $row['id'];
              $insert_statement = $mysqli->prepare("insert into blog_images(uid,image_type,article_id,description,data) values (?,?,?,?,?)");
              $insert_statement->bind_param('sssss',$image_uid,$image_type,$article_id,$description,$contents);
              $insert_statement->execute();
              echo "affected rows: ",$insert_statement->affected_rows;
            }
        }

    }
?>