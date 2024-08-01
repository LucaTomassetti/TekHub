<?php
class CFrontController{
    public function run(){
        session_start();
        $URL = parse_url($_SERVER['REQUEST_URI'])['path'];
        $URL = explode('/', $URL);

        array_shift($URL);
        
        $file = "./src/Controller/C".ucfirst($URL[1]).".php";
        $controllerClass = "C".ucfirst($URL[1]);
        $methodName = !empty($URL[2]) ? $URL[2] : 'home';
        
        if(file_exists($file)){
            require_once $file;
            // Check if the method exists in the controller
            if (method_exists($controllerClass, $methodName)) {
                
                // Controlla se il metodo è ad accesso pubblico
                if (!$this->isPublic($URL[1], $methodName)) {
                    if(!isset($_SESSION['utente'])){
                        //L'utente non è loggato
                        header('Location: /TekHub/utente/login');
                        exit;
                    } else if (!$this->hasPermission($_SESSION['role'], $URL[1], $methodName)) { //Controllo se l'utente ha i permessi in base al suo ruolo definito al login
                        // L'utente loggato non ha i permessi per accedere a questo metodo
                        http_response_code(403); //codice per accesso non autorizzato
                        $view = new VUtente();
                        $view->accessUnAuthorized();
                        exit;
                    }
                }

                // Call the method
                $params = array_slice($URL, 3); // Get optional parameters
                call_user_func_array([new $controllerClass, $methodName], $params);
            
            } else {
                // Method not found, handle appropriately (e.g., show 404 page)
                header('Location: /TekHub/utente/home');
                exit;
            }

        } else{
            header('Location: /TekHub/utente/home');
            exit;
        }
    }

    private function isPublic($controller, $method) {
        // Define your public routes here
        $publicRoutes = [
            'utente' => ['home', 'login', 'logout', 'signUp', 'carrello'],
            'gestioneAcquisto' => ['vediProdotto']
            // Add more public controllers and methods as needed
        ];

        return isset($publicRoutes[$controller]) && in_array($method, $publicRoutes[$controller]);
    }

    private function hasPermission($roleUser, $controller, $method) {
        // Define your user roles and permissions here
        $rolePermissions = [
            'admin' => [
                'gestioneProdotti' => ['listaProdotti', 'addProduct', 'modificaProdotto', 'eliminaProdotto'],
                // Add more controllers and methods for admin
            ],
            'acquirente' => [
                'utente' => ['logout', 'userDataForm', 'userDataSection', 'userHistoryOrders', 'deleteAccount', 'changePass', 'changeUserData'],
                // Add more controllers and methods for acquirente
            ],
            'venditore' => [
                'utente' => ['logout', 'userDataForm', 'userDataSection', 'deleteAccount', 'changePass', 'changeUserData'],
                'gestioneProdotti' => ['listaProdotti', 'addProduct', 'modificaProdotto', 'eliminaProdotto'],
                // Add more controllers and methods for venditore
            ],
            // Add more roles as needed
        ];

        return isset($rolePermissions[$roleUser][$controller]) && in_array($method, $rolePermissions[$roleUser][$controller]);
    }
}
?>