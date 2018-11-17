<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Flash\Session as FlashSession;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();


    $di->set(
        'flashSession',
        function () {
            $flash = new FlashSession(
                [
                    'error' => 'alert alert-danger',
                    'success' => 'alert alert-success',
                    'notice' => 'alert alert-info',
                    'warning' => 'alert alert-warning',
                ]
                );
                return $flash; 
        }
    );

    //start session
    $di->setShared(
        'session',
        function (){
            $session = new Session();
            $session->start();
            return $session;
        }
    );

    //not found hal
    $di->set('dispatcher', function () {

        $eventsManager = new \Phalcon\Events\Manager();

        $eventsManager->attach("dispatch:beforeException", function ($event, $dispatcher, $exception) {

            //404
            if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception) {
                $dispatcher->forward(array(
                    'controller' => 'index',
                    'action' => 'show404'
                ));
                return false;
            }

            //handle other exception
            $dispatcher->forward(array(
               'controller' => 'index',
                'action' => 'show503'
            ));

            return false;

        });

        $dispatcher = new Phalcon\Mvc\Dispatcher();

        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;

    }, true);


    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
