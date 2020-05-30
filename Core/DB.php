<?php
    class{
        protected $cnn = null;
        private $db_name = '';

        public function __construct(){
            $objConn = new mysqli('localhost', 'root', '');

            if($objConn -> connect_errno){
                die('Connect Error(' . $objConn ->connect_errno . ')' . $objConn -> connect_error);
                

                
            }
        }

    }