<?php
        include 'db.php';
        $uploads_dir = 'C:\OpenServer\domains\InfTech\AllFiles';
        if(isset($_POST["name"])){
            $name = $_POST["name"];
            $folder_name = $_POST["folder_name"];

            $query = "SELECT * FROM folders WHERE name='$folder_name'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);

            $res = pg_insert($dbconn, 'folders',array('name'=> $name,'folder_id'=>$line['id']));

            if ($folder_name!=''){
                mkdir("$uploads_dir/$folder_name/$name", 0700);
            }
            else{
                mkdir("$uploads_dir/$name", 0700);
            }
        }
        $redicet = $_SERVER['HTTP_REFERER'];
        @header ("Location: $redicet");         
?>   