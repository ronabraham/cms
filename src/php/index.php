<!DOCTYPE html>
<html>

        <?php
		  echo "<head><title>CMS 0.1</title></head>";
        ?>
        <?php
            $mysqli = new mysqli("190.92.174.93:3306", "admin3", "9nK==VvLZTivQ*]N", "cmsdb_mysql");
            //$mysqli = new mysqli("localhost:3306", "admin3", "admin", "cmsdb_mysql");

            $result = $mysqli->query('select * from blog_articles');
            echo "No of rows : $result->num_rows";
            $filename_article =  "http://localhost/cms/files/articles/july_articles.json";
            $filename = "http://localhost/cms/files/images/rajyaseva.png";
            $headers = get_headers($filename,true);
            $filesize = isset($headers['Content-Length']) ? (int) $headers['Content-Length'] : 0;
            $file = fopen($filename, "rb");

            echo "mysqli->host_info : $mysqli->host_info" ;

            if(!$file){
             //   echo "<h6>Unable to open file</h6>";
                error_log("Unable to open file $filename");
            } else
            {   
              //  echo "<h6>image read successful</h6>";
                syslog(LOG_INFO,"image read successful : $filename");
                $contents = fread($file,$filesize);
            }

            $output_filename = "/Library/WebServer/Documents/cms/web/rajyaseva.png";
            $output_file = fopen($output_filename,"wb");
            if(!$output_file) {
                echo "<h6>Unable to open output image file</h6>";
            } else {
                $success = fwrite($output_file, $contents);
                if($success) {
              //      echo "<h6>image write successful</h6>" ;
                    syslog(LOG_INFO, "image write successful");
                } else {
               //    echo "<h6>image write Unsuccessful</h6>"; 
                    error_log("image write unsuccessful");                
                }
            fclose($file);
            fclose($output_file);
            }

            //$file_contents = extract_file($filename_article,"article");
            //$json_data = json_decode($file_contents);
            //echo " dumping article content from : $filename_article <br>";
            //print $json_data->{'postSummary'};

            //reading article data
            function extract_file($filename,$filetype){
                $headers = get_headers($filename,true);
                $filesize = isset($headers['Content-Length']) ? (int) $headers['Content-Length'] : 0;
                switch($filetype){
                    case 'article':
                        $mode = 'r';

                }
                $file = fopen($filename, $mode);

                if(!$file){
                 //   echo "<h6>Unable to open file</h6>";
                    error_log("Unable to open file $filename");
                } else
                {   
                    error_log("file read successful");
                    $contents = fread($file,$filesize);
                }

                return $contents;
                fclose($file);
            }            

        ?>
        <?php
            echo "<body>";
            echo "<header>";
            echo "<img src=\"http://localhost/cms/web/rajyaseva.png\"/>";
            echo "</header>";
            echo "<section id=\"content\">";
            $filename_article =  "http://localhost/cms/files/articles/july_articles.json";
            $file_contents = extract_file($filename_article,"article");
            $json_data = json_decode($file_contents);
            print $json_data->{'postSummary'};
            echo "</section>";
            echo "</body>";
        ?>

</html>
