<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ИнфТех</title>

  <!-- Bootstrap CSS (jsDelivr CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Bootstrap Bundle JS (jsDelivr CDN) -->
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!--Подключение CSS-->
  <link rel="stylesheet" href="style.css">
  <!--Подключение иконок-->
  <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>

</head>

<!--Подключение БД-->
<?php
    include 'db.php';
?>

<body>
    
    <!--Кнопки для папок и файлов-->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="btn-group">
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalCreate">Создать папку</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalRenameFolder">Переименовать папку</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalDelete">Удалить папку</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalCreateFile">Загрузить файл</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalRename">Переименовать файл</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalDownloadFile">Скачать файл</button>
                    <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalDeleteFile">Удалить файл</button> 
                </div>
            </div>
        </div>
    </div>

    <!--Создать папку-->
    <div class="modal fade" id="ModalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создать папку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                    <form action="create.php" method="POST">
                    <div class="dropdown mb-4">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Укажите папку (при необходимости)
                        </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php  
                        $query = 'SELECT * FROM folders';
                        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                        while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                        {

                            echo " <li class='chooseFolderCreate' id=$line[name] > $line[name]</li>";
                        }   
                        ?>
                    </ul> 
                    <p class="mt-2">Выбранная папка: <input type="text" name="folder_name" id="name_folder_create" readonly /></p>
                </div>
                            <p>Имя папки: <input type="text" name="name" /></p>
                            <input type="submit" value="Создать папку">
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>

     <!--Удалить папку-->
     <div class="modal fade" id="ModalDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удалить папку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="POST"action="delete.php"enctype="multipart/form-data">
                <div class="dropdown mb-4">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Выберите папку для удаления
                </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php  
                        $query = 'SELECT * FROM folders';
                        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                        while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                        {

                            echo " <li class='chooseFolder' id=$line[name] > $line[name]</li>";
                        }   
                        ?>
                    </ul> 
                    <p class="mt-2">Выбранная папка: <input type="text" name="folder_id" id="name_folder_delete" readonly /></p>
                </div>
                    <input type="submit"name="submit_file"value="Удалить папку">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>


    <!--Загрузить файл-->
    <div class="modal fade" id="ModalCreateFile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Загрузить файл</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="POST"action="uploadfile.php"enctype="multipart/form-data">
                <div class="dropdown mb-4">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Выберите папку (при необходимости)
                </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php  
                        $query = 'SELECT * FROM folders';
                        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                        while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                        {

                            echo " <li class='choose' id=$line[name] > $line[name]</li>";
                        }   
                        ?>
                    </ul> 
                    <p class="mt-2">Выбранная папка для загрузки: <input type="text" name="folder_id" id="name_file" readonly /></p>
                </div>
                    <input type="file"name="myfile">
                    <p class="mt-2">Введите краткое описание файла: <input type="text" name="description"></p>
                    <input type="submit"name="submit_file"value="Загрузить файл">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>

    <!--Скачать файл-->
    <div class="modal fade" id="ModalDownloadFile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Скачать файл</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="downloadFile.php"enctype="multipart/form-data">
                <div class="dropdown mb-4">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Выберите файл для скачивания
                </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php  
                        $query = 'SELECT * FROM file';
                        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                        while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                        {

                            echo " <li class='chooseFileDownload' id=$line[filename] > $line[filename]</li>";
                        }   
                        ?>
                    </ul> 
                    <p class="mt-2">Выбранный файл: <input type="text" name="file_name" id="name_file_download" readonly /></p>
                </div>
                    <input type="submit"name="submit_file"value="Скачать файл">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>

    <!--Удалить файл-->
    <div class="modal fade" id="ModalDeleteFile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удалить файл</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="POST"action="deleteFile.php"enctype="multipart/form-data">
                <div class="dropdown mb-4">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Выберите файл для удаления
                </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php  
                        $query = 'SELECT * FROM file';
                        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                        while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                        {

                            echo " <li class='chooseFile' id=$line[filename] > $line[filename]</li>";
                        }   
                        ?>
                    </ul> 
                    <p class="mt-2">Выбранный файл: <input type="text" name="folder_id" id="name_file_delete" readonly /></p>
                </div>
                    <input type="submit"name="submit_file"value="Удалить файл">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>

    <!--Переименовать файл-->
    <div class="modal fade" id="ModalRename" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Переименовать файл</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="POST"action="Rename.php"enctype="multipart/form-data">
                    <div class="dropdown mb-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Выберите файл, который хотите переименовать
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php  
                            $query = 'SELECT * FROM file';
                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                            while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                            {

                                echo " <li class='chooseReFile' id=$line[filename] > $line[filename]</li>";
                            }   
                            ?>
                        </ul> 
                        <p class="mt-2">Выбранный файл: <input type="text" name="old_file_name" id="name_file_rename" readonly /></p>
                    </div>
                    <p> Введите новое имя файла: <input type="text"name="new_file_name"></p>
                    <input type="submit"name="submit_file"value="Переименовать файл">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>
    
    <!--Переименовать папку-->
    <div class="modal fade" id="ModalRenameFolder" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Переименовать папку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form method="POST"action="RenameFolder.php"enctype="multipart/form-data">
                    <div class="dropdown mb-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Выберите папку, которую хотите переименовать
                    </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php  
                            $query = 'SELECT * FROM folders';
                            $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
                            while($line = pg_fetch_array($result, null, PGSQL_ASSOC))// получаем все строки в цикле по одной
                            {
                                echo " <li class='chooseReFolder' id=$line[name] > $line[name]</li>";
                            }   
                            ?>
                        </ul> 
                        <p class="mt-2">Выбранная папка: <input type="text" name="old_folder_name" id="name_folder_rename" readonly /></p>
                    </div>
                    <p> Введите новое имя папки: <input type="text"name="new_folder_name"></p>
                    <input type="submit"name="submit_file"value="Переименовать папку">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>

    <!--Список папок и файлов-->
    <div class="container-fluid mt-3">
        <div class="row">            
            <div class="col-md-3" >
                    <?php
                        include "./components/structure.php";
                    ?> 
            </div>

        <!--Содержимое файла-->         
            <div class="col-md-9" >       
                <?php
                    include "./components/main_content.php";
                ?>
            </div>
        </div>  
    </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="js/jquery.js"></script>
</body>
</html>