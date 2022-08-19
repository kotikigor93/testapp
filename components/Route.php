<?php
/**
 * Created by Kotyk Ihor
 * Date : 19.07.2022
 * Time : 18:47
 */

namespace components;

use app\Controllers\CabinetController;

class Route
{
    public function run()
    {
        $uri = SRC::getURI();
        require_once ROOT.'/config/route.php';

        foreach ($routes as $uriPattern => $path) {
            if (preg_match('#^' . $uriPattern . '$#', $uri)) {
                $internalRoute = preg_replace('#^' . $uriPattern . '$#', $path, $uri);
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                $controllerFile = 'app\controllers\\' . $controllerName;
                $controllerObject = new $controllerFile ();
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
        if(is_null($result) && !($controllerObject && $actionName)){
            $action = new CabinetController();
            $action->actionError();
        }
    }
}