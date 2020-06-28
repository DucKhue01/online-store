<?php
    class ProductsModel extends DB{
        private $tb = 'tb_book';
        public function getAll($params = []){

            $sql = 'SELECT * FROM tb_book ';
            if (!empty($params)) {

                $sql .= 'WHERE uid IN ('. $params['id_in'].')';  
                // echo $sql;
            }

            $res = $this -> Query($sql);
            $data = [];

            while ($row = $res ->fetch_assoc()) {
                $data[] = $row; 
            }
            
            return $data;
        }
        //can ca tien them
        
        public function getBL(){
            $sql = "SELECT * FROM tb_book WHERE uid = 1 ";
            $res = $this -> Query($sql);
            $data = [];

            while ($row = $res ->fetch_assoc()) {
                $data[] = $row; 
            }
            
            return $data;
        }

    }

