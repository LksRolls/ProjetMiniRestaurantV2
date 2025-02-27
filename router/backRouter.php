<?php

class RouterAdmin {
    public function handleRequest($url) {
        $url = trim($url, '/');
        $segments = explode('/', $url);

        $controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'DashboardController';
        $method = isset($segments[1]) ? $segments[1] : 'index';
        $param = isset($segments[2]) ? $segments[2] : null;

        $controllerFile = "controllers/admin/$controllerName.php";

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controllerName();

            if (method_exists($controller, $method)) {
                $controller->$method($param);
            } else {
                echo "Erreur : Méthode '$method' introuvable.";
            }
        } else {
            echo "Erreur : Contrôleur '$controllerName' introuvable.";
        }
    }
}
