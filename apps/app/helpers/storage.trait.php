<?php declare(strict_types = 1);

// https://bitsofco.de/an-overview-of-client-side-storage/

trait Storage
{
    protected $client = null;
    protected $server = 'localhost';
    protected $secret = 11211;

    protected $cache = null;
    protected $cache_path = '';
    protected $cache_expire = 3600;

    public function storage()
    {
        if (ENABLED_CACHING)
        {
            if (!empty($_REQUEST['server']))
            {
                $this->server = $_REQUEST['server'];
            }

            $this->connect();

            $this->cache_path = str_replace('/', '.', trim($this->request, '/'));
        }
    }

    public function setCache($key = '', $value = '', $global = false)
    {
        if (!$global)
        {
            $key .= $this->cache_path;
        }

        $this->cache->set($this->domain . $key, $value, time() + $this->cache_expire);
    }

    public function getCache($key = '', $global = false)
    {
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

    public function clearStorage()
    {
        $this->cache->flush();
    }

    private function connect()
    {
        switch(strtolower(CACHING_ADAPTER))
        {
            case 'memcached':
                $this->client = new \Memcached();
                $this->client->addServer($this->server, $this->secret);
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\Memcached($this->client);
            break;
            
            case 'redis':
                $this->client = new \Redis();
                $this->client->connect('127.0.0.1');
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\Redis($this->client);
            break;
            
            case 'couchbase':
                $cluster = new \CouchbaseCluster('couchbase://localhost');
                $bucket = $cluster->openBucket('default');
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\Couchbase($bucket);
            break;
            
            case 'apc':
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\Apc();
            break;
            
            case 'mysql':
                $this->client = new \PDO('mysql:dbname='.DB_BASE.';host='.DB_HOST, DB_USER, DB_PASS);
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\MySQL($this->client);
            break;
            
            case 'sqlite':
                $this->client = new \PDO('sqlite:cache.db');
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\SQLite($this->client);
            break;
            
            case 'postgresql':
                $this->client = new \PDO('pgsql:user=postgres dbname=cache password=');
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\PostgreSQL($this->client);
            break;
            
            case 'memory':
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\MemoryStore();
            break;
            
            default:
                $adapter = new \League\Flysystem\Adapter\Local(PATH_RUNTIME, LOCK_EX);
                $filesystem = new \League\Flysystem\Filesystem($adapter);
                $this->cache = new \MatthiasMullie\Scrapbook\Adapters\Flysystem($filesystem);
            break;
        }
    }
}