<?php
                if(isset($_GET['path'])){
                    $uploads_dir = 'AllFiles';
                    $filename = $_GET['path'];
                    
                    $query = "SELECT * FROM file WHERE filename='$filename'";
                    $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                    $line = pg_fetch_array($result, null, PGSQL_ASSOC);
                    
                    if ($line['folder_id']!=0){
                        
                        $query2 = "SELECT * FROM folders WHERE id={$line['folder_id']}";
                        $result2 = pg_query($query2) or die('Ошибка запроса: ' . pg_last_error());
                        $line2 = pg_fetch_array($result2, null, PGSQL_ASSOC);
                        if ($line2['folder_id']!=null){
                            $queryl = "SELECT * FROM folders WHERE id={$line2['folder_id']}";
                            $resultl = pg_query($queryl) or die('Ошибка запроса: ' . pg_last_error());
                            $linel = pg_fetch_array($resultl, null, PGSQL_ASSOC);
                            if (substr($filename,-3)=='jpg' || substr($filename,-3)=='png' ){
                                echo "<div class='title mb-2'>$filename</div>";
                                echo "<div class='content'>"; 
                                echo "<img src='$uploads_dir/{$linel['name']}/{$line2['name']}/$filename'>";   
                                echo"</div>";
                            }
                            else{
                                echo "<div class='title mb-2'>$filename</div>";
                                echo "<pre class='prettyprint'>";
                                echo "<div class='content'>";
                                echo file_get_contents("$uploads_dir/{$linel['name']}/{$line2['name']}/$filename");
                                echo"</div>";
                                echo "</pre>";
                            }       
                        }
                        else{

                            if (substr($filename,-3)=='jpg' || substr($filename,-3)=='png' ){

                                echo "<div class='title mb-2'>$filename</div>";
                                echo "<div class='content'>";
                                echo "<img src='$uploads_dir/{$line2['name']}/$filename'>";
                                echo"</div>";
                            }
                            else{
                                echo "<div class='title mb-2'>$filename</div>";
                                echo "<pre class='prettyprint'>";
                                echo "<div class='content'>";
                                echo file_get_contents("$uploads_dir/{$line2['name']}/$filename");
                                echo"</div>";
                                echo "</pre>";
                            }
                           
                        }
                        
                    }
                    else{
                        if (substr($filename,-3)=='jpg' || substr($filename,-3)=='png' ){

                            echo "<div class='title mb-2'>$filename</div>";
                            echo "<div class='content'>";
                            echo "<img src='$uploads_dir/$filename'";
                            echo"</div>";
                        }
                        else{
                            echo "<div class='title mb-2'>$filename</div>";
                            echo "<pre class='prettyprint'>";
                            echo "<div class='content'>";
                            echo file_get_contents("$uploads_dir/$filename");
                            echo"</div>";
                            echo "</pre>";
                        }
                        
                    }
                }
            ?>  