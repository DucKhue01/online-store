<?php
    class ProductsModel extends DB{
        private $tb = 'tb_book';
        public function getAll($params = []){
            $sql = 'SELECT * FROM tb_book';


            $res = $this -> Query($sql);
            $data = [];

            while ($row = $res ->fetch_assoc()) {
                $data[] = $row; 
            }
            
            return $data;
        }
    }

