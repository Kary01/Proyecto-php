<?php
    /*
        Clase principal de la aplicación
        Crea URL y dirife el núcleo del controlador
        Formato de URL - /controlador/método/parámetros
    */

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            //print_r($this->getUrl());

            $url = $this->getUrl();

            //Buscar en controladores para el primer valor
            if (file_exists("../app/controllers/" .ucwords($url[0]). ".php")) {
                //si existe, se establecera como controlador
                $this->currentController = ucwords($url[0]);

                //0 index
                unset($url[0]);
            }


            //solicita el controlador
            require_once "../app/controllers/" .$this->currentController. ".php";

            //instancia del controlador
            $this->currentController = new $this->currentController;
        }

        public function getUrl(){
            if(isset( $_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>