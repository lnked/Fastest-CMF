<?php

Установить другой шаблон:

$this->layout()->setTemplate('layout/new-layout');
Добавить новый шаблон для сайдбара:


$view = new ViewModel();
$sideView = new ViewModel();
$sideView->setTemplate('content/sidebar');
$this->$layout->addChild($sideView, 'side-view');
return $view;
Отключить шаблон:

$view = new ViewModel();
$view->setTerminal(true);
return $view;
Разные файлы шаблона для разных контролеров:


//module.php
public function init(ModuleManager $moduleManager){
    $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
    $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
        $controller = $e->getTarget();
        if ($controller instanceof Controller\FrontEndController) {
            $controller->layout('layout/front');
        }
    }, 100);
}
Получить доступ к объекту View в модули:

public function onBootstrap($e){
  $app = $e->getApplication();
  $viewModel = $app->getMvcEvent()->getViewModel();
}
Получить значение представления в Layout:

$viewModel = $this->viewModel()->getCurrent();
$children = $viewModel->getChildren();
$viewModel = $children[0];
$viewModel->foo;





View Model
Переопределить шаблон для View:

$view = new ViewModel();
$view->setTemplate('my-template.phtml');
Передать переменные в представление:

$view = new ViewModel();
$view->setVariables(['var' => 'foo']);
Добавление нескольких объектов View Model и передача их в представления:


$view = new ViewModel();
$sidebarView = new ViewModel();
$sidebarView->setTemplate('content/sidebar');
$view->addChild($sidebarView, 'sidebar');
return $view;
Отключить представления (view):

$response = $this->getResponse();
$response->setStatusCode(200);
return $response;
Вернуть Json ответ (response):

$view = new JsonModel(['success' => '1','data'=>'foo']);
return $response;




Перенаправление
Перенаправление на определённый маршрут (route):

// page - маршрут (route)
// action - действие, на которое нужно сделать перенаправление
// param - параметр, например id
$this->redirect()->toRoute('page', ['action' => 'show'], ['param => 1']);
Перенаправление на опредёлённый контроллер и действия:

// controllerName - имя контроллера (controller)
// actionName - имя действия (action)
$this->forward()->dispatch('controllerName', ['action' => 'actionName']);
Перенаправление на опредёлённую ссылку:

$this->redirect()->toUrl('http://google.com');
Перенаправление на страницу 404:

$this->getResponse()->setStatusCode(404);




$this->getRequest();             // Объект запроса
$this->getResponse();            // Объект ответа
 
$this->getRequest()->getUri();     // URI
$this->getRequest()->getCookie();  // Cookies
$this->getRequest()->getServer();  // Переменные сервера
 
$this->params()->fromPost('foo');  // Запрос POST
$this->params()->fromQuery('foo'); // Запрос GET
$this->params()->fromRoute('foo'); // RouteMatch
$this->params()->fromHeader('foo');// Header
$this->params()->fromFiles('foo'); // Загруженные файл
 
$this->getRequest()->isXmlHttpRequest(); // Ajax запрос
$this->getRequest()->isPost(); // POST запрос