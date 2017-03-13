<?php

// https://denisyuk.by/all/polnoe-rukovodstvo-po-zagruzke-izobrazheniy-na-php/

class Upload
{
    use Tools, Singleton;

    // Массив с названиями ошибок
    protected $errorMessages = [
        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
        UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
    ];

    public function __construct()
    {
        // require '../Fastimage.php';
        // $uri = 'http://pcdn.500px.net/8123858/7051e2440a869a3fec74406a3aa200618452c390/4.jpg';
        // echo "\n\n";
        // $time = microtime(true);
        // $image = new FastImage($uri);
        // list($width, $height) = $image->getSize();
        // echo "FastImage: \n";
        // echo "Width: ". $width . "px Height: ". $height . "px in " . (microtime(true)-$time) . " seconds \n";
        // $time = microtime(true);
        // list($width, $height) = getimagesize($uri);
        // echo "getimagesize: \n";
        // echo "Width: ". $width . "px Height: ". $height . "px in " . (microtime(true)-$time) . " seconds \n";
        // exit;

        // $uri = "http://farm9.staticflickr.com/8151/7357346052_54b8944f23_b.jpg";

        // // loading image into constructor
        // $image = new FastImage($uri);
        // list($width, $height) = $image->getSize();
        // echo "dimensions: " . $width . "x" . $height;

        // // or, create an instance and use the 'load' method
        // $image = new FastImage();
        // $image->load($uri);
        // $type = $image->getType();
        // echo "filetype: " . $type;
    }

    protected function hash()
    {
        // SELECT * FROM `db_image_hash` WHERE BIT_COUNT( 0x2f1f76767e5e7f33 ^ hash ) <= 10

        // use Jenssegers\ImageHash\ImageHash;

        // $hasher = new ImageHash;
        // $hash = $hasher->hash('path/to/image.jpg');
        // $distance = $hasher->distance($hash1, $hash2);


        // use Jenssegers\ImageHash\Implementations\DifferenceHash;
        // use Jenssegers\ImageHash\ImageHash;
        // $implementation = new DifferenceHash;
        // $hasher = new ImageHash($implementation);
        // $hash = $hasher->hash('path/to/image.jpg');


        // $distance = $hasher->compare('path/to/image1.jpg', 'path/to/image2.jpg');


        // $hasher = new ImageHash($implementation, ImageHash::DECIMAL);
    }

    protected function upload()
    {
        if (is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            echo md5_file($_FILES['attachment']['tmp_name']);
            exit;
        }

        // Перезапишем переменные для удобства
        $filePath  = $_FILES['upload']['tmp_name'];
        $errorCode = $_FILES['upload']['error'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

            // Выведем название ошибки
            die($outputMessage);
        }


        // Проверим изображение и результат функции запишем в переменную
        if (!$image = getimagesize($filePath)) {
            die('Файл не является изображением.');
        }

        // Зададим ограничения для картинок
        $limitBytes  = 1024 * 1024 * 5;
        $limitTypes  = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
        $limitWidth  = 1280;
        $limitHeight = 768;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
        if (!in_array($image[2], $limitTypes)) die('Мы поддерживаем картинки только с типом JPG, PNG и GIF.');
        if ($image[1] > $limitHeight)          die('Высота изображения не должна превышать 768 точек.');
        if ($image[0] > $limitWidth)           die('Ширина изображения не должна превышать 1280 точек.');


        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = md5_file($filePath);

        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);

        // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);

        // Переместим картинку с новым именем и расширением в папку /pics
        if (!move_uploaded_file($filePath, __DIR__ . '/pics/' . $name . $format)) {
            die('При записи изображения на диск произошла ошибка.');
        }
    }

    protected function upload2()
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

    protected function multi($files = [])
    {
        // Изменим структуру $_FILES
        foreach($_FILES['upload'] as $key => $value) {
            foreach($value as $k => $v) {
                $_FILES['upload'][$k][$key] = $v;
            }

            // Удалим старые ключи
            unset($_FILES['upload'][$key]);
        }

        // Загружаем все картинки по порядку
        foreach ($_FILES['upload'] as $k => $v) {

            // Загружаем по одному файлу
            $_FILES['upload'][$k]['tmp_name'];
            $_FILES['upload'][$k]['error'];
        }

    }

    protected function curl($files = [])
    {
        // Каким-то образом получим ссылку
        $url = 'https://site.ru/picture.jpg';

        // Проверим HTTP в адресе ссылки
        if (!preg_match("/^https?:/i", $url) && filter_var($url, FILTER_VALIDATE_URL)) {
            die('Укажите корректную ссылку на удалённый файл.');
        }

        // Запустим cURL с нашей ссылкой
        $ch = curl_init($url);

        // Укажем настройки для cURL
        curl_setopt_array($ch, [

            // Укажем максимальное время работы cURL
            CURLOPT_TIMEOUT => 60,

            // Разрешим следовать перенаправлениям
            CURLOPT_FOLLOWLOCATION => 1,

            // Разрешим результат писать в переменную
            CURLOPT_RETURNTRANSFER => 1,

            // Включим индикатор загрузки данных
            CURLOPT_NOPROGRESS => 0,

            // Укажем размер буфера 1 Кбайт
            CURLOPT_BUFFERSIZE => 1024,

            // Напишем функцию для подсчёта скачанных данных
            // Подробнее: http://stackoverflow.com/a/17642638
            CURLOPT_PROGRESSFUNCTION => function ($ch, $dwnldSize, $dwnld, $upldSize, $upld) {

                // Когда будет скачано больше 5 Мбайт, cURL прервёт работу
                if ($dwnld > 1024 * 1024 * 5) {
                    return -1;
                }
            },

            // Включим проверку сертификата (по умолчанию)
            CURLOPT_SSL_VERIFYPEER => 1,

            // Проверим имя сертификата и его совпадение с указанным хостом (по умолчанию)
            CURLOPT_SSL_VERIFYHOST => 2,

            // Укажем сертификат проверки
            // Скачать: https://curl.haxx.se/docs/caextract.html
            CURLOPT_CAINFO => __DIR__ . '/cacert.pem',
        ]);

        $raw   = curl_exec($ch);    // Скачаем данные в переменную
        $info  = curl_getinfo($ch); // Получим информацию об операции
        $error = curl_errno($ch);   // Запишем код последней ошибки

        // Завершим сеанс cURL
        curl_close($ch);


        // Проверим ошибки cURL и доступность файла
        if ($error === CURLE_OPERATION_TIMEDOUT)  die('Превышен лимит ожидания.');
        if ($error === CURLE_ABORTED_BY_CALLBACK) die('Размер не должен превышать 5 Мбайт.');
        if ($info['http_code'] !== 200)           die('Файл не доступен.');

        // Проверим на соответствие изображения
        if (!$image = getimagesizefromstring($raw)) {
            die('Файл не является изображением.');
        }

        // Зададим ограничения для картинок
        $limitTypes  = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
        $limitWidth  = 1280;
        $limitHeight = 768;

        // Проверим нужные параметры
        if (!in_array($image[2], $limitTypes)) die('Мы поддерживаем картинки только с типом JPG, PNG и GIF.');
        if ($image[1] > $limitHeight)          die('Высота изображения не должна превышать 768 точек.');
        if ($image[0] > $limitWidth)           die('Ширина изображения не должна превышать 1280 точек.');

        // Сгенерируем новое имя из MD5-хеша изображения
        $name = md5($raw);

        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);

        // Сократим .jpeg до .jpg
        $format = str_replace('jpeg', 'jpg', $extension);

        // Сохраним картинку с новым именем и расширением в папку /pics
        if (!file_put_contents(__DIR__ . '/pics/' . $name . $format, $raw)) {
            die('При сохранении изображения на диск произошла ошибка.');
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