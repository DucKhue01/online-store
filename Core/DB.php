<?php
    class DB{
        protected $cnn = null;
        private $db_name = 'online_store';

        public function __construct(){
            $objConn = new mysqli('localhost', 'root', '');

            if($objConn -> connect_errno){
                die('Connect Error(' . $objConn ->connect_errno . ')' . $objConn -> connect_error);
                           
            }

            $check = $objConn -> select_db($this->db_name);


            if ($check === false) {
                die("database khong ton tai");
            }
            $objConn->set_charset("utf8");
            $this->cnn = $objConn;
            return $this -> cnn;
        }

        public function Query($sql){
            $res = $this -> cnn -> query($sql);
            if ($this->cnn->errno) {
                die('loi truy van co so du lieu' . $this ->cnn ->error);

            }
            return $res;

        }
        
        public function __destruct(){
            if (!empty($this->cnn)) {
                $this->cnn->close();
            }
            
        }
    
    }
