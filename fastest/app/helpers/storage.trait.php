<?php declare(strict_types = 1);

// https://bitsofco.de/an-overview-of-client-side-storage/

trait Storage
{
    protected static $server = 'localhost';
    protected static $secret = 11211;

    protected static $cache = null;
    protected static $cache_path = '';
    protected static $cache_expire = 3600;

    public function __construct()
    {
        if (ENABLED_CACHING)
        {
            if (!empty($_REQUEST['server']))
            {
                self::$server = $_REQUEST['server'];
            }

            self::hash();
            self::connect();
        }
    }

    public static function setCache($key = '', $value = '', $global = false)
    {
        if (!$global)
        {
            $key .= self::$cache_path;
        }

        self::$cache->set(self::$domain . $key, $value, time() + self::$cache_expire);
    }

    public static function getCache($key = '', $global = false)
    {
        if (!$global)
        {
            $key .= self::$cache_path;
        }

        if (!(self::$cache->get(self::$domain . $key) === false))
        {
            return self::$cache->get(self::$domain . $key);
        }

        return false;
    }

    public static function clearStorage()
    {
        self::$cache->flush();
    }

    private static function hash()
    {
        self::$cache_path = str_replace('/', '.', trim(self::$requestUri, '/'));
    }

    private static function connect()
    {
        switch(strtolower(CACHING_ADAPTER))
        {
            case 'memcached':
                $client = new \Memcached();
                $client->addServer(self::$server, self::$secret);
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\Memcached($client);
            break;
            
            case 'redis':
                $client = new \Redis();
                $client->connect('127.0.0.1');
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\Redis($client);
            break;
            
            case 'couchbase':
                $cluster = new \CouchbaseCluster('couchbase://localhost');
                $bucket = $cluster->openBucket('default');
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\Couchbase($bucket);
            break;
            
            case 'apc':
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\Apc();
            break;
            
            case 'mysql':
                $client = new \PDO('mysql:dbname='.DB_BASE.';host='.DB_HOST, DB_USER, DB_PASS);
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\MySQL($client);
            break;
            
            case 'sqlite':
                $client = new \PDO('sqlite:cache.db');
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\SQLite($client);
            break;
            
            case 'postgresql':
                $client = new \PDO('pgsql:user=postgres dbname=cache password=');
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\PostgreSQL($client);
            break;
            
            case 'memory':
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\MemoryStore();
            break;
            
            default:
                $adapter = new \League\Flysystem\Adapter\Local(PATH_RUNTIME, LOCK_EX);
                $filesystem = new \League\Flysystem\Filesystem($adapter);
                self::$cache = new \MatthiasMullie\Scrapbook\Adapters\Flysystem($filesystem);
            break;
        }
    }
}