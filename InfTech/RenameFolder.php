<?php
        include 'db.php';
        $uploads_dir = 'C:\OpenServer\domains\InfTech\AllFiles';
        if(isset($_POST["old_folder_name"])){
            $name = $_POST["old_folder_name"];
            $name2 = $_POST["new_folder_name"];
            $query = "SELECT * FROM folders WHERE name='$name'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            if ($line['folder_id']!=null){
                $query2 = "SELECT * FROM folders WHERE id={$line['folder_id']}";
                $result2 = pg_query($query2) or die('Ошибка запроса: ' . pg_last_error());
                $line2 = pg_fetch_array($result2, null, PGSQL_ASSOC);
                $res = pg_update($dbconn, 'folders',array('name'=> $name2),array('id'=>$line['id']));
                echo $line2['name'];
                rename( "$uploads_dir/{$line2['name']}/$name","$uploads_dir/{$line2['name']}/$name2"); 
            }
            else{
            $res = pg_update($dbconn, 'folders',array('name'=> $name2),array('id'=>$line['id'])); 
            rename( "$uploads_dir/$name","$uploads_dir/$name2"); 
            }
            $redicet = $_SERVER['HTTP_REFERER'];
            @header ("Location: $redicet");     
        } 
                           
?> 