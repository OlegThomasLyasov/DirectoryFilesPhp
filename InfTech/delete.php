<?php
        include 'db.php';
        $uploads_dir = 'C:\OpenServer\domains\InfTech\AllFiles';

        if(isset($_POST["folder_id"])){

            $foldername = $_POST["folder_id"];

            $query = "SELECT * FROM folders WHERE name='$foldername'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);

            $queryMain = "SELECT * FROM folders WHERE folder_id={$line['id']}";
            $resultMain = pg_query($queryMain) or die('Ошибка запроса: ' . pg_last_error());

            while($lineMain = pg_fetch_array($resultMain, null, PGSQL_ASSOC)){

                $queryFile = "SELECT * FROM file WHERE folder_id={$lineMain['id']}";
                $resultFile = pg_query($queryFile) or die('Ошибка запроса: ' . pg_last_error());

                while($lineFile  = pg_fetch_array($resultFile, null, PGSQL_ASSOC)){
                    $res = pg_delete($dbconn, 'file',array('folder_id'=> $lineFile['folder_id']));
                    unlink("$uploads_dir/{$line['name']}/{$lineMain['name']}/{$lineFile['filename']}");
                }
                rmdir("$uploads_dir/{$line['name']}/{$lineMain['name']}");
                $res = pg_delete($dbconn, 'folders',array('id'=> $lineMain['id']));
            }


            $queryFile = "SELECT * FROM file WHERE folder_id={$line['id']}";
            $resultFile = pg_query($queryFile) or die('Ошибка запроса: ' . pg_last_error());
            while($lineFile = pg_fetch_array($resultFile, null, PGSQL_ASSOC)){
                $res = pg_delete($dbconn, 'file',array('folder_id'=> $lineFile['folder_id']));
                unlink("$uploads_dir/{$line['name']}/{$lineFile['filename']}");
            }


            rmdir("$uploads_dir/{$line['name']}");
            $res = pg_delete($dbconn, 'folders',array('id'=> $line['id']));
            $redicet = $_SERVER['HTTP_REFERER'];
            @header ("Location: $redicet");
              
    }   
                 
?> 