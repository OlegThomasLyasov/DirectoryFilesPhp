<?php
        include 'db.php';
        $uploads_dir = 'C:\OpenServer\domains\InfTech\AllFiles';
        $filename=$_FILES["myfile"]["name"];
        $handle = $_FILES["myfile"]["tmp_name"];
       
        $folderID = $_POST["folder_id"];
        $description = $_POST["description"];
        $query = "SELECT * FROM folders WHERE name='$folderID'";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
        $line = pg_fetch_array($result, null, PGSQL_ASSOC);
        $res = pg_insert($dbconn, 'file',array('filename'=> $filename, 'description'=>$description,'folder_id'=>$line['id'] ));
        if ($line['folder_id']!=null){
                $query2 = "SELECT * FROM folders WHERE id={$line['folder_id']}";
                $result2 = pg_query($query2) or die('Ошибка запроса: ' . pg_last_error());
                $line2 = pg_fetch_array($result2, null, PGSQL_ASSOC); 

                move_uploaded_file($handle,"$uploads_dir/{$line2['name']}/{$line['name']}/$filename");   
        }
        else{
            move_uploaded_file($handle,"$uploads_dir/{$line['name']}/$filename");
        }
        $redicet = $_SERVER['HTTP_REFERER'];
        @header ("Location: $redicet"); 
         
  
?>