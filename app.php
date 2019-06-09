<?php
namespace kr\bartnet;

class App {
    
    private $params = array();
    
    // constructor
    public function __construct(){
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        
        // request OPTIONS
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }
    }
    
    // print to json
    public function print($arr, $code=200) {
        http_response_code($code);
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // get DATA
    public function getData() {
        return json_decode(file_get_contents('php://input'), true);
    }
    
    // get url parameter
    public function getParams() {
        return $this->params;
    }
    
    // process
    private function route($pat) {
    
        $pat = '~^'.$pat.'$~i';
        
        $request = $_SERVER['REQUEST_URI'];
        $ret = preg_match($pat, $request, $mat);
        if (count($mat) > 1) {
            array_shift($mat);
            $this->params = $mat;
        }
        return $ret;
    }
    
    // check METHOD
    private function checkMethod($method) {
        $_method = strtolower($_SERVER["REQUEST_METHOD"]);
        if ($_method !== $method) return false;
        return true;
    }
    
    // GET
    public function get($pat) {
        if(!$this->checkMethod('get')) return false;
        return $this->route($pat);
    }

    // POST
    public function post($pat) {
        if(!$this->checkMethod('post')) return false;
        return $this->route($pat);
    }

    // PUT
    public function put($pat) {
        if(!$this->checkMethod('put')) return false;
        return $this->route($pat);
    }

    // PATCH
    public function patch($pat) {
        if(!$this->checkMethod('patch')) return false;
        return $this->route($pat);
    }

    // DELETE
    public function delete($pat) {
        if(!$this->checkMethod('delete')) return false;
        return $this->route($pat);
    }
}