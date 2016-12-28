<?php

class Upload
{
    use Tools, Singleton;

    public function __construct()
    {

        $uploaddir = '/var/www/uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        echo '<pre>';
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }

        echo 'Некоторая отладочная информация:';
        print_r($_FILES);

        print "</pre>";

        // ##

        foreach ($_FILES["pictures"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                // basename() может спасти от атак на файловую систему;
                // может понадобиться дополнительная проверка/очистка имени файла
                $name = basename($_FILES["pictures"]["name"][$key]);
                move_uploaded_file($tmp_name, "data/$name");
            }
        }

        // ##

        foreach ($_FILES["attachment"]["error"] as $key => $error)
        {
               $tmp_name = $_FILES["attachment"]["tmp_name"][$key];
               if (!$tmp_name) continue;

               $name = basename($_FILES["attachment"]["name"][$key]);

            if ($error == UPLOAD_ERR_OK)
            {
                if ( move_uploaded_file($tmp_name, "/tmp/".$name) )
                    $uploaded_array[] .= "Uploaded file '".$name."'.<br/>\n";
                else
                    $errormsg .= "Could not move uploaded file '".$tmp_name."' to '".$name."'<br/>\n";
            }
            else $errormsg .= "Upload error. [".$error."] on file '".$name."'<br/>\n";
        }

        // ##

        if($_FILES["filename"]["size"] > 1024*3*1024)
        {
            echo ("Размер файла превышает три мегабайта");
            exit;
        }

        // Проверяем загружен ли файл
        if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
        {
            // Если файл загружен успешно, перемещаем его
            // из временной директории в конечную
            move_uploaded_file($_FILES["filename"]["tmp_name"], "/path/to/file/".$_FILES["filename"]["name"]);
        }
        else {
            echo("Ошибка загрузки файла");
        }

        if($_FILES["filename"]["size"] > UPLOAD_MAX_FILESIZE * 1024 * 1024)
        {
            echo("Размер файла превышает три мегабайта");
            exit;
        }
    }

    protected function normalize_files_array($files = [])
    {
        $normalized_array = [];

        foreach($files as $index => $file) {

            if (!is_array($file['name'])) {
                $normalized_array[$index][] = $file;
                continue;
            }

            foreach($file['name'] as $idx => $name) {
                $normalized_array[$index][$idx] = [
                    'name' => $name,
                    'type' => $file['type'][$idx],
                    'tmp_name' => $file['tmp_name'][$idx],
                    'error' => $file['error'][$idx],
                    'size' => $file['size'][$idx]
                ];
            }

        }

        return $normalized_array;
    }

}