<?php
	//echo"<head><title>Form Submitted</title></head>";
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "test", "test", "cms0_1");
    $id = uniqid() ;
    $created_timestamp = date('Y-m-d H:i:s');
    $title = $_POST['title'];
    $summary =  $_POST['postSummary'];
    $detail = $_POST['postDescription'];
    echo $mysqli->host_info;
    echo $id;
    echo $title;
    echo $summary;
    echo $detail;
    
    //$result = $mysqli->query('insert into blog_articles(id,title,created_datetime,summary,detailed)
    // values (\'6a50e5b90e0e\',\'test title1\',\'2026-07-10 17:59:37\',\'summary\',\'detail\')');
    $insert_statement = $mysqli->prepare("insert into blog_articles(id,title,created_datetime,summary,detailed) values (?,?,?,?,?)");
    $insert_statement->bind_param('sssss',$id,$title,$created_timestamp,$summary,$detail);
    $insert_statement->execute();
    echo "affected rows: ",$insert_statement->affected_rows;

    //$result = $mysqli->query("insert into blog_articles(id,title,created_datetime,summary,detailed) values (id,\$title,\$created_timestamp,\$summary,\$detail)");
    //$result2 = $mysqli->query("select id,title,summary,detailed from blog_articles");
    /*$rows = $result2->fetch_all(MYSQLI_ASSOC);
    foreach($rows as $row){
    	echo $row["title"] ,"<br>";
    }
    */
    //echo $result;

	//echo 'title : ',($_POST['title']);
	//echo "<br>";
	//echo 'postsummary : ', $_POST['postSummary'];
	//echo "<br>";
	//echo 'postdetail : ', $_POST['postDescription'];
?>