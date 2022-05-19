<?php  
                    //Главные папки
                    $query = 'SELECT * FROM folders WHERE folder_id is NULL';
                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

                    while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                    {  
                        echo "<ul> <i class='fa fa-archive' aria-hidden='true'></i> $line[name]";
                        //Если есть дочерние папки то выводим их
                        $queryFolder = "SELECT * FROM folders WHERE folder_id is NOT NULL";
                        $resultFolder = pg_query($queryFolder) or die('Ошибка запроса: ' . pg_last_error());   
                        while($lineFolder = pg_fetch_array($resultFolder, null, PGSQL_ASSOC)){
                            //находим из общего числа нужные
                            if ($lineFolder['folder_id']==$line['id']){                               
                                echo "<li><ul><i class='fa fa-archive' aria-hidden='true'></i> $lineFolder[name]";  
                                //находим файлы дочерних папок и выводим их
                                $querySec = "SELECT * FROM file WHERE folder_id='{$lineFolder['id']}'";
                                $resultSec = pg_query($querySec) or die('Ошибка запроса: ' . pg_last_error());                            
                                while($lineSec = pg_fetch_array($resultSec, null, PGSQL_ASSOC)){
                                echo "<li title='$lineSec[description]'><i class='fa fa-file' aria-hidden='true'></i><a href='index.php?path=$lineSec[filename]'> $lineSec[filename]</a></li>"; 
                                }
                                echo "</ul></li>";
                            }
                        }   
                        
                        //Обычные файлы в папке
                        $querySec = "SELECT * FROM file WHERE folder_id='{$line['id']}'";
                        $resultSec = pg_query($querySec) or die('Ошибка запроса: ' . pg_last_error());
                        while($lineSec = pg_fetch_array($resultSec, null, PGSQL_ASSOC)){
                        echo "<li> <ul title='$lineSec[description]'><i class='fa fa-file' aria-hidden='true'></i><a href='index.php?path=$lineSec[filename]'> $lineSec[filename]</a></ul> </li>";
                        }
                        echo "</ul>";  
                    }                                               
                    //Оставшиеся одинокие файлы
                    $query = "SELECT * FROM file WHERE folder_id IS NULL";
                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                    while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                    {
                        echo "<ul title='$line[description]'><i class='fa fa-file' aria-hidden='true'></i><a href='index.php?path=$line[filename]'> $line[filename]</a></ul>";
                    }   
                ?>