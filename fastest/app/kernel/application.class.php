<?php declare(strict_types = 1);

use DebugBar\StandardDebugBar;
use DebugBar\DataCollector\PDO\TraceablePDO;
use DebugBar\DataCollector\PDO\PDOCollector;

final class Application extends Initialize
{
    public function __construct()
    {
        parent::__construct();
    }

    public function launch()
    {
        if (count($_POST))
        {
            if ($this->csrf->validate($_POST))
            {
                exit(__("<b style='color: green'>valid</b>", $_POST));
            }
            else
            {
                exit(__("<b style='color: red'>invalid</b>", $_POST));
            }
        }

        $this->initHooks();

        // use Nette\Http;

        // https://doc.nette.org/en/2.4/
        // https://github.com/nette/http

        // $input = $request->only(['username', 'password']);

        // $input = $request->only('username', 'password');

        // $input = $request->except(['credit_card']);

        // $input = $request->except('credit_card');
        // Determining If An Input Value Is Present

        // if ($request->has('name')) {
        //     //
        // }

        // Without Query String...
        // $url = $request->url();

        // With Query String...
        // $url = $request->fullUrl();

        // $uri = $request->path();
        // if ($request->is('admin/*')) {
        // $url = $request->url();
        // $method = $request->method();
        // if ($request->isMethod('post')) {
        //     //
        // }

        $app = [
            'title'         => 'Fastest CMS',
            'controller'    => $this->controller,
            'action'        => $this->action,
            'params'        => $this->params,
            'content'       => $this->getContent()
        ];

        $this->template->assign('app', $app);
    }
    
    public function terminate()
    {
        $this->headers();

        // Q("SELECT * FROM `db_site__structure`")->all();

        $debugbar = new StandardDebugBar();
        $debugbarRenderer = $debugbar->getJavascriptRenderer();
        $debugbarRenderer->setBaseUrl('/Resources');
        
        try {
            throw new Exception('Something failed!');
        } catch (Exception $e) {
            $debugbar['exceptions']->addException($e);
        }

        $debugbar['messages']->addMessage('hello');
        $debugbar['time']->startMeasure('op1', 'sleep 500');
        usleep(300);
        $debugbar['time']->startMeasure('op2', 'sleep 400');
        usleep(200);
        $debugbar['time']->stopMeasure('op1');
        usleep(200);
        $debugbar['time']->stopMeasure('op2');
        $debugbar['messages']->addMessage('world', 'warning');
        $debugbar['messages']->addMessage(array('toto' => array('titi', 'tata')));
        $debugbar['messages']->addMessage('oups', 'error');
        $debugbar['time']->startMeasure('render');

        $pdo = new TraceablePDO(new PDO('sqlite::memory:'));
        $debugbar->addCollector(new PDOCollector($pdo));
        $pdo->exec('create table users (name varchar)');
        $stmt = $pdo->prepare('insert into users (name) values (?)');
        $stmt->execute(array('foo'));
        $stmt->execute(array('bar'));
        $users = $pdo->query('select * from users')->fetchAll();
        $stmt = $pdo->prepare('select * from users where name=?');
        $stmt->execute(array('foo'));
        $foo = $stmt->fetch();
        $pdo->exec('delete from titi');

        $render = [
            'meta' => '',
            'head' => $debugbarRenderer->renderHead(),
            'footer' => $debugbarRenderer->render()
        ];

        $this->template->assign('render', $render);
        $this->template->display($this->base_tpl);
    }
}