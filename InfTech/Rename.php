<?php
        include 'db.php';
        $uploads_dir = 'C:\OpenServer\domains\InfTech\AllFiles';

        if(isset($_POST["old_file_name"])){
            $name = $_POST["old_file_name"];
            $name2 = $_POST["new_file_name"];
            $query = "SELECT * FROM file WHERE filename='$name'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
             
            if ($line['folder_id']!=null){
                $queryFolder = "SELECT * FROM folders WHERE id='{$line['folder_id']}'";
                $resultFolder = pg_query($queryFolder) or die('Ошибка запроса: ' . pg_last_error());
                $lineFolder = pg_fetch_array($resultFolder, null, PGSQL_ASSOC);

                if ($lineFolder['folder_id']!=null){
                    $queryFolderMain = "SELECT * FROM folders WHERE id='{$lineFolder['folder_id']}'";
                    $resultFolderMain = pg_query($queryFolderMain) or die('Ошибка запроса: ' . pg_last_error());
                    $lineFolderMain = pg_fetch_array($resultFolderMain, null, PGSQL_ASSOC);
                    rename( "$uploads_dir/{$lineFolderMain['name']}/{$lineFolder['name']}/$name","$uploads_dir/{$lineFolderMain['name']}/{$lineFolder['name']}/$name2");

                }
                else{
                    rename( "$uploads_dir/{$lineFolder['name']}/$name","$uploads_dir/{$lineFolder['name']}/$name2");
                }
            }
            

            else{
                rename( "$uploads_dir/$name","$uploads_dir/$name2");
            }
            $res = pg_update($dbconn, 'file',array('filename'=> $name2),array('id'=>$line['id'])); 
            $redicet = $_SERVER['HTTP_REFERER'];
            @header ("Location: $redicet");
                  
        } 

                           
?> 