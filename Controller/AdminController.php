<?php
    require_once app_path. '/Model/ProductsModel.php';
    require_once app_path. '/Model/AdminModel.php';

    class AdminController extends ControllerBase{
        public function Prod(){
            $data = ['srr'=>[],'smg'=>[]];

            $objModelSP = new ProductsModel();
            
            $data['list-prod'] = $objModelSP->getAll();




            $this->RenderView('admin.prod', $data, 'layout-back');
        }
        public function Index(){
            



            $this->RenderView('admin.index', [], 'layout-back');
        }
        public function Delete(){
            $chuyen_trang = base_path . "?ct=admin&act=admin";


            // $data = ['srr'=>[],'smg'=>[]];

            $objModelSP = new AdminModel();
            
            $objModelSP->Remove();

            header("Location:$chuyen_trang");
            
            
        }
        public function AddProd(){
            if(isset($_POST["submit"])){
                $chuyen_trang = base_path . "?ct=admin&act=admin";
                $objAdminModel = new AdminModel();
              
                $data = ['err'=>[],'smg'=>[]];
                $target_dir =  "Public/files/products/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                
                // if (isset($_POST['id'])) {
                //     echo "khue dep trai" . $_POST['id'];
                // } ,$_POST['name'],$_POST['price'],$_POST['category'],$_POST['file']
                if (empty($_POST['uid'])) {
                    
                    $data['err'][] = "thieu id";
                    
                }else{
                    $uid = $_POST['uid'];
                    $objModelSP = new ProductsModel();

                    $data['check'] = $objModelSP->getAll(['id_in'=>$uid]);
                    if (empty($data['check'])) {
                        
                    }else{
                        $data['err'][] = "id cua ban da bi trung voi mot san pham co trong list";
                    }



                    // echo $uid;
                    // echo "<pre>";
                    // print_r( $data['check']);
                    // echo "</pre>";

                }
                if (empty($_POST['name'])) {
                    $data['err'][] = "thieu name";
                }
                if (empty($_POST['price'])) {
                    $data['err'][] = "thieu price";
                }
                if ($_FILES['fileToUpload']['error'] != 0) {
                    $data['err'][] = "thieu file img";
                }else{
                  
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    
    
                    
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                         
                         
                        } else {
                          $data['err'][] = "File is not an image.";
                          
                        }
                      
                      
                      // Check if file already exists
                    //   if (file_exists($target_file)) {
                    //       $data['err'][] = "Sorry, file already exists.";
                       
                    //   }
                      
                      // Check file size
                      if ($_FILES["fileToUpload"]["size"] > 500000) {
                          $data['err'][] = "Sorry, your file is too large.";
                        
                      }
                      
                      // Allow certain file formats
                      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                      && $imageFileType != "gif" ) {
                          $data['err'][] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                       
                      }
          
                }
               
             
                
                // Check if image file is a actual image or fake image
                
                if (empty($data['err'])) {
                    $objModelSP = new AdminModel();
                   
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
    
                    $data['msg'][] = $objModelSP->Add($uid,$name,$price,$category);
                    $data['msg'][] = $objModelSP->Upload($target_file);
                    $data['msg'][] = $objModelSP->Rename($target_file,$uid);
                    $this->RenderView('admin.add-prod',$data, 'layout-back');
                   
                    
                }
                else{
                    $this->RenderView('admin.add-prod',$data, 'layout-back');
                }
                    
                
            }else{
                $this->RenderView('admin.add-prod',[], 'layout-back');
            }

               
        }
        public function Edit(){
            $oldUid = $_GET['uid'];
            $data = ['srr'=>[],'smg'=>[]];

            $objModelSP = new ProductsModel();
            
            $data['list-prod'] = $objModelSP->getAll(['id_in'=>$oldUid]);

            // print_r($uid);
            if(isset($_POST["submit"])){
                $name = $_POST['name'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $uid = $_POST['uid'];


              
                $objModelSP = new AdminModel();
                $data['msg'][] = $objModelSP->Edit($oldUid,$uid,$name,$price,$category);
                
                if ($_FILES['fileToUpload']['error'] != 0) {
                    // echo "khong co file upload";
                    $target_file = 'Public/files/products/'.$oldUid.'.webp';
                    $data['msg'][] = $objModelSP->Rename($target_file,$uid);
                }else{
                    $target_dir =  "Public/files/products/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $data['msg'][] = $objModelSP->Upload($target_file);
                    $file = 'Public/files/products/'.$oldUid.'.webp';
                    if (file_exists($file)) {
                        unlink($file);
                    }
                    $data['msg'][] = $objModelSP->Rename($target_file,$uid);

                }




            }

            $this->RenderView('admin.edit', $data, 'layout-back');

        }
        public function Staff(){
            $this->RenderView('admin.staff', $data, 'layout-back');
            
        }
        
             
    }
    

?>