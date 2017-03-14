<?php declare(strict_types = 1);

use DebugBar\StandardDebugBar;
// use DebugBar\DataCollector\PDO\TraceablePDO;
// use DebugBar\DataCollector\PDO\PDOCollector;

class Initialize extends Content
{
    use Singleton, Tools, Storage {
        Storage::__construct as private _storage;
    }

    public $path    = [];
    public $page    = ['id' => 0];
    public $router  = null;

    protected $app = null;

    protected $base_tpl = 'base';

    protected $template = null;
    protected $template_dir = null;
    protected $template_driver = null;

    protected $is_admin = false;

    protected $controller = null;
    protected $action = null;
    protected $params = null;

    public $debugbar = null;
    public $debugbarRenderer = null;

    protected $locale = null;
    protected static $domain = null;
    protected static $request = null;

    public function __construct()
    {
        self::$domain   = $_SERVER['HTTP_HOST'];
        self::$request  = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $this->path     = preg_split('/\/+/', self::$request, -1, PREG_SPLIT_NO_EMPTY);
        $this->locale   = $this->getLocale(self::$request, $this->path);
        $this->apath    = $this->path;

        $this->_storage();

        $this->checkAdmin();

        $this->initMVC();

        $this->initDebugger();

        $this->initTemplate();

        $this->csrfProtection();
    }

    protected function initMVC()
    {
        $this->app = new stdClass([
            'meta' => [],
            'styles' => [],
            'scripts' => []
        ]);

        if ($this->is_admin)
        {
            array_shift($this->apath);
        }

        if (isset($this->apath[0]))
        {
            $this->controller = $this->apath[0];
        }

        if (isset($this->apath[1]))
        {
            $this->action = $this->apath[1];
        }

        if (count($this->apath) > 2)
        {
            $this->params = array_slice($this->apath, 2, count($this->apath));
        }
    }

    protected function initHooks()
    {
        if ($this->controller == CAPTCHA_URL && !$this->action)
        {
            return new Captcha;
        }

        if ($this->is_admin)
        {
            if ($this->controller == 'cache')
            {
                fn_rrmdir(PATH_RUNTIME, true);
                fn_redirect(DS.ADMIN_DIR);
            }   
        }
    }

    private function initTemplate()
    {
        if ($this->is_admin)
        {
            $this->base_tpl = 'base';
            $this->template_dir = PATH_BACKEND;
            $this->template_driver = TEMPLATING_BACKEND;
        }
        else
        {
            $this->template_dir = PATH_FRONTEND;
            $this->template_driver = TEMPLATING_FRONTEND;
        }

        $this->template = new templateEngine($this->template_driver, $this->template_dir, FRONTEND_THEME);

        if ($this->is_admin)
        {
            $this->template->assign('ADMIN_DIR', ADMIN_DIR);
        }
    }

    protected function initDebugger($isRender = false)
    {
        if (DEV_MODE)
        {
            $this->debugbar = new StandardDebugBar();
            $this->debugbarRenderer = $this->debugbar->getJavascriptRenderer();
            $this->debugbarRenderer->setBaseUrl('/debugbar');

            $this->debugbar['messages']->addMessage('Fastest-CMF debugger init');

            // try {
            //     throw new Exception('Something failed!');
            // } catch (Exception $e) {
            //     $this->debugbar['exceptions']->addException($e);
            // }

            // $this->debugbar['messages']->addMessage('hello');
            // $this->debugbar['time']->startMeasure('op1', 'sleep 500');

            // usleep(300);
            // $this->debugbar['time']->startMeasure('op2', 'sleep 400');
            
            // usleep(200);
            // $this->debugbar['time']->stopMeasure('op1');
            
            // usleep(200);
            // $this->debugbar['time']->stopMeasure('op2');
            // $this->debugbar['messages']->addMessage('world', 'warning');
            // $this->debugbar['messages']->addMessage(array('toto' => array('titi', 'tata')));
            // $this->debugbar['messages']->addMessage('oups', 'error');
            // $this->debugbar['time']->startMeasure('render');

            // $pdo = new TraceablePDO(new PDO('sqlite::memory:'));
            // $this->debugbar->addCollector(new PDOCollector($pdo));
            // $pdo->exec('create table users (name varchar)');
            // $stmt = $pdo->prepare('insert into users (name) values (?)');
            // $stmt->execute(array('foo'));
            // $stmt->execute(array('bar'));
            // $users = $pdo->query('select * from users')->fetchAll();
            // $stmt = $pdo->prepare('select * from users where name=?');
            // $stmt->execute(array('foo'));
            // $foo = $stmt->fetch();
            // $pdo->exec('delete from titi');

            if ($isRender)
            {
                $this->app->head = $this->debugbarRenderer->renderHead();
                $this->app->footer = $this->debugbarRenderer->render();
            }
        }
    }

    protected static function responseCode($code = 200)
    {
        $status = [
            100 => [ 'text' => 'Continue' ], # продолжай
            101 => [ 'text' => 'Switching Protocols' ], # переключение протоколов
            102 => [ 'text' => 'Processing' ], # идёт обработка.
            
            # Success (успешно):
            200 => [ 'text' => 'OK' ], # хорошо
            201 => [ 'text' => 'Created' ], # создано
            202 => [ 'text' => 'Accepted' ], # принято
            203 => [ 'text' => 'Non-Authoritative Information' ], # информация не авторитетна
            204 => [ 'text' => 'No Content' ], # нет содержимого
            205 => [ 'text' => 'Reset Content' ], # сбросить содержимое
            206 => [ 'text' => 'Partial Content' ], # частичное содержимое
            207 => [ 'text' => 'Multi-Status' ], # многостатусный
            226 => [ 'text' => 'IM Used' ], # использовано IM.
            
            # Redirection (перенаправление):
            300 => [ 'text' => 'Multiple Choices' ], # множество выборов
            301 => [ 'text' => 'Moved Permanently' ], # перемещено навсегда
            302 => [ 'text' => 'Moved Temporarily' ], # перемещено временно
            302 => [ 'text' => 'Found' ], # найдено
            303 => [ 'text' => 'See Other' ], # смотреть другое
            304 => [ 'text' => 'Not Modified' ], # не изменялось
            305 => [ 'text' => 'Use Proxy' ], # использовать прокси
            306 => [ 'text' => '— зарезервировано' ], # код использовался только в ранних спецификациях
            307 => [ 'text' => 'Temporary Redirect' ], # временное перенаправление
            
            # Client Error (ошибка клиента):
            400 => [ 'text' => 'Bad Request' ], # плохой, неверный запрос
            401 => [ 'text' => 'Unauthorized' ], # не авторизован
            402 => [ 'text' => 'Payment Required' ], # необходима оплата
            403 => [ 'text' => 'Forbidden' ], # запрещено
            404 => [ 'text' => 'Not Found' ], # не найдено
            405 => [ 'text' => 'Method Not Allowed' ], # метод не поддерживается
            406 => [ 'text' => 'Not Acceptable' ], # неприемлемо
            407 => [ 'text' => 'Proxy Authentication Required' ], # необходима аутентификация прокси
            408 => [ 'text' => 'Request Timeout' ], # истекло время ожидания
            409 => [ 'text' => 'Conflict' ], # конфликт
            410 => [ 'text' => 'Gone' ], # удалён
            411 => [ 'text' => 'Length Required' ], # необходима длина
            412 => [ 'text' => 'Precondition Failed' ], # условие ложно
            413 => [ 'text' => 'Request Entity Too Large' ], # размер запроса слишком велик
            414 => [ 'text' => 'Request-URI Too Large' ], # запрашиваемый URI слишком длинный
            415 => [ 'text' => 'Unsupported Media Type' ], # неподдерживаемый тип данных
            416 => [ 'text' => 'Requested Range Not Satisfiable' ], # запрашиваемый диапазон не достижим
            417 => [ 'text' => 'Expectation Failed' ], # ожидаемое неприемлемо
            422 => [ 'text' => 'Unprocessable Entity' ], # необрабатываемый экземпляр.
            423 => [ 'text' => 'Locked' ], # заблокировано.
            424 => [ 'text' => 'Failed Dependency' ], # невыполненная зависимость.
            425 => [ 'text' => 'Unordered Collection' ], # неупорядоченный набор
            426 => [ 'text' => 'Upgrade Required' ], # необходимо обновление.
            428 => [ 'text' => 'Precondition Required' ], # необходимо предусловие
            429 => [ 'text' => 'Too Many Requests' ], # слишком много запросов
            431 => [ 'text' => 'Request Header Fields Too Large' ], # поля заголовка запроса слишком большие
            434 => [ 'text' => 'Requested host unavailable.' ], # Запрашиваемый адрес недоступен
            444 => [ 'text' => 'Закрывает соединение без передачи заголовка ответа. Нестандартный код' ],
            449 => [ 'text' => 'Retry With' ], # повторить с
            451 => [ 'text' => 'Unavailable For Legal Reasons' ], # недоступно по юридическим причинам
            
            # Server Error (ошибка сервера):
            500 => [ 'text' => 'Internal Server Error' ], # внутренняя ошибка сервера
            501 => [ 'text' => 'Not Implemented' ], # не реализовано
            502 => [ 'text' => 'Bad Gateway' ], # плохой, ошибочный шлюз
            503 => [ 'text' => 'Service Unavailable' ], # сервис недоступен
            504 => [ 'text' => 'Gateway Timeout' ], # шлюз не отвечает
            505 => [ 'text' => 'HTTP Version Not Supported' ], # версия HTTP не поддерживается
            506 => [ 'text' => 'Variant Also Negotiates' ], # вариант тоже проводит согласование[12]
            507 => [ 'text' => 'Insufficient Storage' ], # переполнение хранилища.
            508 => [ 'text' => 'Loop Detected' ], # обнаружено бесконечное перенаправление[13]
            509 => [ 'text' => 'Bandwidth Limit Exceeded' ], # исчерпана пропускная ширина канала.
            510 => [ 'text' => 'Not Extended' ], # не расширено.
            511 => [ 'text' => 'Network Authentication Required' ] # требуется сетевая аутентификация
        ];

        if (function_exists('http_response_code'))
        {
            http_response_code($code);
        }
        else
        {
            header('HTTP/1.1 '.$code.' '.$status[$code]['text']);
        }
    }

    protected static function headers($cache = false)
    {
        header('Content-Type: text/html; charset=utf-8');
        header('X-Powered-By: Fastest CMF');

        header("Last-Modified: " . gmdate('D, d M Y H:i:s', (time() - 3600)) . " GMT");
        header("Cache-control: public");

        if ($cache)
        {
            header("Cache-control: max-age=31536000");
        }
        else
        {
            header("Strict-Transport-Security: max-age=31536000");
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0');
            header("Pragma: no-cache");
            header("Expires: " . date("r", time() + 2592000));
        }

        if (extension_loaded('zlib') && (!defined('GZIP_COMPRESS') || defined('GZIP_COMPRESS') && GZIP_COMPRESS))
        {
            ini_set("zlib.output_compression", "On");
            ini_set('zlib.output_compression_level', "7");
        }
    }

    private function csrfProtection()
    {
        $this->csrf = new CSRF;
    }

    private function checkAdmin()
    {
        $this->is_admin = isset($this->path[0]) && $this->path[0] == ADMIN_DIR;
    }
}