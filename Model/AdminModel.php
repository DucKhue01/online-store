<?php 
    class AdminModel extends DB {
        public function Remove(){
            $uid = $_GET['uid'];
            // $sql = 'SELECT * FROM tb_book ';
            $sql = "DELETE FROM tb_book WHERE uid = $uid";
            if (!empty($params['id_in'])) {

                $sql .= 'WHERE uid IN ('. $params['id_in'] .')';  
                // echo $sql;
            }

            $res = $this -> Query($sql);
          
            
        }
        public function Upload($target_file){
            // $target_dir =  "Public/files/products/";
            // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            
            // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          
            
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              
              $msg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
              $msg = "Sorry, there was an error uploading your file.";
            }
            return $msg;
       
        }
        public function Add($uid,$name,$price,$category){
          $sql = "INSERT INTO `tb_book` (name, price, uid,type) VALUES ('$name','$price','$uid','$category')";       
          if ( $this -> Query($sql)) {
            $msg = "your prod has been uploded";
            
          }
          return $msg;
        }
        public function Rename($target_file,$uid){
          if (file_exists($target_file)) {
            if (rename( $target_file, 'Public/files/products/'.$uid.'.webp')) {
              $msg = "thang cong";
             }else{
               $msg = "loi";
             }
             return $msg;
           
          }

          
          
        }
        public function Edit($oldUid,$uid,$name,$price,$category){
          // $sql = "INSERT INTO `tb_book` (name, price, uid,type) VALUES ('$name','$price','$uid','$category')";       
          $sql = "UPDATE `tb_book`
                  SET name = '$name', price = '$price', uid = '$uid', type = '$category'
                  WHERE uid = $oldUid;";


          if ( $this -> Query($sql)) {
            $msg = "your prod has been edited";
            
          }
          return $msg;
          
        }


        
    }
    

?>


