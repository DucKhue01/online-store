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
        
        public function getAllByType($category){
            $sql = "SELECT * FROM tb_book WHERE type = '$category' ";
            $res = $this -> Query($sql);
            $data = [];

            while ($row = $res ->fetch_assoc()) {
                $data[] = $row; 
            }
            
            return $data;
        }
        public function getProduct($id){

            $sql = "SELECT * FROM tb_book WHERE `uid` = $id";

            $res = $this -> Query($sql);
            $data = [];
            while ($row = $res ->fetch_assoc()) {
                $data = $row;
            }

            return $data;
        }
        public function getBSL() {
        $sql = "select *  tb_order_detail ";

        $res = $this -> Query($sql);
        $data = [];
        $newData = [];
        while ($row = $res ->fetch_assoc()) {
            $data[] = $row; 
        }
        foreach ( $data as $item ) {
            if (!in_array( $item['uid'], $newData )) {
                
            }else{
                
            }
            
            // xu li best seller bang list








        return $data;
                
        }



    }


