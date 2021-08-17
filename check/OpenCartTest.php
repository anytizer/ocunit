<?php
use \PHPUnit\Framework\TestCase as TestCase;
use Opencart\System\Engine\Action as Action;

class OpenCartTest extends TestCase
{
    private static $loaded = false;
    public static $registry;
    private static $is_admin = null;

    public function __get($name)
    {
        return self::$registry->get($name);
    }

    public function dispatchAction($route, $request_method = 'GET', $data = array())
    {
        if ($request_method != 'GET' && $request_method != 'POST') {
            $request_method = 'GET';
        }

        foreach ($data as $key => $value) {
            $this->request->{strtolower($request_method)}[$key] = $value;
        }

        $this->request->get['route'] = $route;
        $this->controller->dispatch(new Action($route), new Action($this->config->get('action_error')));

        return $this->response;
    }

    public function loadModel($route)
    {
        $this->load->model($route);
        $model = "model_".str_replace("/", "_", $route);
        return $this->$model;
    }

    public function login($username, $password)
    {
        return $logged = $this->user->login($username, $password);
    }

    public function tearDown(): void
    {
    }
}
