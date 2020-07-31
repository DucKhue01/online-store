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
            $sql = "select *  from tb_order_detail ";

            $res = $this -> Query($sql);
            $data = [];
            $newData = [];
            
            while ($row = $res ->fetch_assoc()) {
                $data[] = $row; 
            }
            foreach ( $data as $item) {
                if (array_key_exists($item['id_book'],$newData)) {
                    // array_push($newData,$item['id_book']);                    
                    $newData[$item['id_book']] += $item['quality'];

                }else{
                    $newData[$item['id_book']] = $item['quality'];                  
                    
                }                      
            }
            arsort($newData);
            $newArray = array_keys($newData);
            $idBSL = [] ;
            for ($i= 0; $i < 6; $i++) { 
                $idBSL[] =  $newArray[$i];
            }
            $list_id_bestsl = array_values($idBSL);
            $list_id_bestsl = implode(',', $list_id_bestsl);
            $dataBSL = $this->getAll(['id_in'=>$list_id_bestsl]);
            return $dataBSL ; 
        }

    }


