<?php

class Bootstrap {

    public $project_folder = '';
    public $base_url = '';
    public $view = '';
    public $code = '';
    public $message = '';
    public $config = '';

    public function __construct($level = null) {
        //TODO: move this set_time_limit to a helper
        set_time_limit(0);
        if (empty($level)) {
            $this->_load_config();
            $this->_load_classes();
            $this->_router();
        }
    }
    
    private function _load_config(){
        $config_file = './project.xml';
        if (file_exists($config_file)) {
            $xml = simplexml_load_file($config_file);
            $this->config = array();
            $this->config['project_name'] = $xml->name;
            if (isset($xml->default)) {
                if (isset($xml->default->controller)) {
                     $this->config['default_controller'] = $xml->default->controller . '_controller';
                } else {
                     $this->config['default_controller'] = 'Default_controller';
                }
            }

            if (isset($xml->libraries->library)) {
                foreach($xml->libraries->library as $library) {
                    $this->_load_library($library);
                }
            }
            
        }
    }

    private function _load_library($filename) {
        //TODO: Found a way to declare libraries in a config file
        $filename = './libraries/' . $filename;
        if (file_exists($filename)) {
            require_once($filename);
        }
        
    }

    private function _load_classes() {

        function __autoload($classname) {
            //echo 'paso por aca';
            //echo $classname;
            if (preg_match('#([a-zA-Z0-9_]+)_controller#', $classname, $matches)) {
                $file_name = './controllers/' . strtolower($matches[1]) . '.php';
                
            } else if (preg_match('#([a-zA-Z0-9_]+)_helper#', $classname, $matches)) {
                $file_name = './helpers/' . strtolower($matches[1]) . '.php';
            }
            else if (preg_match('#([a-zA-Z0-9_]+)_view#', $classname, $matches)) {
                $file_name = './views/' . strtolower($matches[1]) . '.php';
            }
            else {
               $file_name =  $classname . '.php';
            }
            
            if (file_exists($file_name)) {
                require_once $file_name;        
            } else {
                //create log helper
                ///echo $file_name . ' class not found';
            }
        }

    }

    private function _router() {
        // Under certain conditions Apache's RewriteRule directive prepends the value
        // assigned to $_GET['q'] with a slash. Moreover we can always have a trailing
        // slash in place, hence we need to normalize $_GET['q'].
        // Thanks Drupal 7!
        if (isset($_GET['q'])) {
            $path = trim($_GET['q'], '/');
            $url_parts = explode('/', $path);
            $controller_name = $url_parts[0] . '_controller';
            if (class_exists($controller_name, true)) {
                $controller = new $controller_name();
                if (isset($url_parts[1]) && method_exists($controller, $url_parts[1])) {
                    $action = $url_parts[1];
                    //remove controller name
                    array_shift($url_parts);
                    //remove controller action
                    array_shift($url_parts);
                    $parms = $url_parts;
                    $this->$action($parms);
                } else {
                    $this->_set_error('404', 'Oops Action not found');
                }
            } else {
                $this->_set_error('404', 'Oops ' . $url_parts[0] . ' Controller not found');
            }
        } else {
            $default_controller = $this->config['default_controller'];
            $controller = new $default_controller();
            $controller->index();
        }
    }

    private function _set_error($code, $message) {
        $this->code = $code;
        $this->message = $message;
        $method_name = 'error_' . $this->code;
        Header_helper::$method_name();
        $view = new Default_view('error');
        $view->base_url = Url_helper::base_url();
        $view->message = $this->message;
        $view->load();
    }

    private function _error() {
        $header_response = 'error_' . $this->code;
    }

}
