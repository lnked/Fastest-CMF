<?php declare(strict_types = 1);

// https://bitsofco.de/an-overview-of-client-side-storage/

class Caching extends Initialize
{
    use Singleton, Tools;

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
        if (!$this->cache_enable || ($this->caching == 1 && !($articles = $this->getCache('module.articles.item'))))
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
                $this->cache = new Memcached;
                $this->cache_driver = 'memcached';

                if ($this->cache->addServer($this->server, 11211))
                {
                    $this->cache_enable = true;
                }
            }
        }
    }

    protected function getCache($key = '', $global = false)
    {
        if (!$this->cache_enable) return false;
        
        if (!$global)
        {
            $key .= $this->cache_path;
        }

        if (!($this->cache->get($this->domain . $key) === false))
        {
            return $this->cache->get($this->domain . $key);
        }

        return false;
    }

    protected function setCache($key = '', $value = '', $global = false)
    {
        if ($this->cache_enable)
        {
            if (!$global)
            {
                $key .= $this->cache_path;
            }

            if ($this->cache_driver == 'memcached')
            {
                $this->cache->set($this->domain . $key, $value, time() + $this->cache_expire);
            }
            else
            {
                $this->cache->set($this->domain . $key, $value, $this->cache_compress, time() + $this->cache_expire);
            }
        }
    }
}