<?php
        include 'db.php';
        $uploads_dir = 'C:\OpenServer\domains\InfTech\AllFiles';

        if(isset($_GET['file_name']))
            {

            //Читать файл
            $filename = $_GET['file_name'];
            
            $query = "SELECT * FROM file WHERE filename='$filename'";
            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
            $line = pg_fetch_array($result, null, PGSQL_ASSOC);
            
            if ($line['folder_id']!=0){
          
            $query2 = "SELECT * FROM folders WHERE id={$line['folder_id']}";
            $result2 = pg_query($query2) or die('Ошибка запроса: ' . pg_last_error());
            $line2 = pg_fetch_array($result2, null, PGSQL_ASSOC);

            if ($line2['folder_id']==null){
                //Проверка на существование файла
                if(file_exists("$uploads_dir/{$line2['name']}/$filename")) {
                
                    //Определение информации заголовка
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header("Cache-Control: no-cache, must-revalidate");
                    header("Expires: 0");
                    header('Content-Disposition: attachment; filename="'.basename("$uploads_dir/{$line2['name']}/$filename").'"');
                    header('Content-Length: '. "$uploads_dir/{$line2['name']}/$filename");
                    header('Pragma: public');

                    //Очистить выходной буфер системы
                    flush();

                    readfile("$uploads_dir/{$line2['name']}/$filename");

                    //Завершить работу со скриптом
                    die();
                    }
                else{
                    echo "Файл не существует.";
                    }
            }
            else{
                
                $queryMain = "SELECT * FROM folders WHERE id={$line2['folder_id']}";
                $resultMain = pg_query($queryMain) or die('Ошибка запроса: ' . pg_last_error());
                $lineMain = pg_fetch_array($resultMain, null, PGSQL_ASSOC);

                //Проверка на существование файла
                if(file_exists("$uploads_dir/{$lineMain['name']}/{$line2['name']}/$filename")) {
                
                    //Определение информации заголовка
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header("Cache-Control: no-cache, must-revalidate");
                    header("Expires: 0");
                    header('Content-Disposition: attachment; filename="'.basename("$uploads_dir/{$lineMain['name']}/{$line2['name']}/$filename").'"');
                    header('Content-Length: '. "$uploads_dir/{$lineMain['name']}/{$line2['name']}/$filename");
                    header('Pragma: public');

                    //Очистить выходной буфер системы
                    flush();

                    readfile("$uploads_dir/{$lineMain['name']}/{$line2['name']}/$filename");

                    //Завершить работу со скриптом
                    die();
                    }
                else{
                    echo "Файл не существует.";
                    }
            }    
                }else{
                    //Проверка на существование файла
                    if(file_exists("$uploads_dir/$filename")) {
                    
                        //Определение информации заголовка
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header("Cache-Control: no-cache, must-revalidate");
                        header("Expires: 0");
                        header('Content-Disposition: attachment; filename="'.basename("$uploads_dir/$filename").'"');
                        header('Content-Length: '. "$uploads_dir/$filename");
                        header('Pragma: public');

                        //Очистить выходной буфер системы
                        flush();

                        readfile("$uploads_dir/$filename");

                        //Завершить работу со скриптом
                        die();
                        }
                    else{
                        echo "Файл не существует.";
                        }
                }
            }
        else
            echo "Имя файла не определено."
?> 