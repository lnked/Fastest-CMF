<?php declare(strict_types = 1);

class Caching extends Initialize
{
    use Singleton, Tools;

    protected $mcache = null;
    protected $mcache_enable = false;
    protected $mcache_driver = null;
    protected $mcache_compress = MEMCACHE_COMPRESSED;
    protected $mcache_expire = 3600;
    protected $mcache_path = '';

    public function __construct()
    {
        // exit("1");
    }

    protected function savePage($url = '')
    {
        $handle = fopen($cache_file, 'w'); // Открываем файл для записи и стираем его содержимое
        fwrite($handle, ob_get_contents()); // Сохраняем всё содержимое буфера в файл
        fclose($handle); // Закрываем файл
        ob_end_flush(); // Выводим страницу в браузере
    }

    protected function getPage($url = '')
    {

    }

    protected function getContent()
    {
        if (!$this->mcache_enable || ($this->caching == 1 && !($articles = $this->getCache('module.articles.item'))))
        {
            $articles = Q("SELECT `id`, `date`, `name`, `system`, `anons`, `text`, `meta_title`, `meta_robots`, `meta_keywords`, `meta_description` FROM `#_mdd_articles` WHERE `visible`='1' AND `id`=?i", array( $item ))->row();
            $articles['date'] = Dates($articles['date'], $this->locale);
        
            $this->setCache('module.articles.item', $articles);
        }
    }

    protected function memory()
    {
        if ($this->enabled_caching === true)
        {
            if (!empty($_REQUEST['server']))
            {
                $this->server = $_REQUEST['server'];
            }

            if (class_exists('Memcached'))
            {
                $this->mcache = new Memcached;
                $this->mcache_driver = 'memcached';

                if ($this->mcache->addServer($this->server, 11211))
                {
                    $this->mcache_enable = true;
                }
            }
        }
    }

    protected function getCache($key = '', $global = false)
    {
        if (!$this->mcache_enable) return false;
        
        if (!$global)
        {
            $key .= $this->mcache_path;
        }

        if (!($this->mcache->get($this->domain . $key) === false))
        {
            return $this->mcache->get($this->domain . $key);
        }

        return false;
    }

    protected function setCache($key = '', $value = '', $global = false)
    {
        if ($this->mcache_enable)
        {
            if (!$global)
            {
                $key .= $this->mcache_path;
            }

            if ($this->mcache_driver == 'memcached')
            {
                $this->mcache->set($this->domain . $key, $value, time() + $this->mcache_expire);
            }
            else
            {
                $this->mcache->set($this->domain . $key, $value, $this->mcache_compress, time() + $this->mcache_expire);
            }
        }
    }
}