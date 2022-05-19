<?php
        include 'db.php';
        $uploads_dir = 'C:\OpenServer\domains\InfTech\AllFiles';
        if(isset($_POST["folder_id"])){
            $name = $_POST["folder_id"];
            $query = "SELECT * FROM file WHERE filename='$name'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            
            if ($line['folder_id']!=null){
                $query2 = "SELECT * FROM folders WHERE id={$line['folder_id']}";
                $result2 = pg_query($query2) or die('Ошибка запроса: ' . pg_last_error());
                $line2 = pg_fetch_array($result2, null, PGSQL_ASSOC);

                if ($line2['folder_id']!=null){
                    $queryMain = "SELECT * FROM folders WHERE id={$line2['folder_id']}";
                    $resultMain = pg_query($queryMain) or die('Ошибка запроса: ' . pg_last_error());
                    $lineMain = pg_fetch_array($resultMain, null, PGSQL_ASSOC);
                    unlink("$uploads_dir/{$lineMain['name']}/{$line2['name']}/$name");
                }
                else{
                    unlink("$uploads_dir/{$line2['name']}/$name");
                }
                
            }else{
                unlink("$uploads_dir/$name");
            }

            $res = pg_delete($dbconn, 'file',array('id'=> $line['id']));
            $redicet = $_SERVER['HTTP_REFERER'];
            @header ("Location: $redicet");           
        } 
        
                                   
?> 