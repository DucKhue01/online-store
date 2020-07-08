<?php   
    require_once app_path. '/Model/ProductsModel.php';


    class ProductsController extends ControllerBase{
        public function ListAll() {
            // echo '<br> ham hien thi danh sahc san pham';
            $data = ['srr'=>[],'smg'=>[]];

            $objModelSP = new ProductsModel();
            
            $data['list-prod'] = $objModelSP->getAll();

            $this->RenderView('products.list-all', $data, 'layout-front');

        }
        
        public function AddCart(){
            //?ct=products&add-cart&id=123
            $idprod = @$_GET['id'];
            $idprod = intval($idprod);

            $chuyen_trang = base_path .'/' . "?ct=products&act=list-all";
            if ($idprod <= 0) {
                header("Location: $chuyen_trang");

            }
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (!isset( $_SESSION['cart'][$idprod])) {
                $_SESSION['cart'][$idprod] = 1;
            }else{
                $_SESSION['cart'][$idprod]++;
            }

            header("Location: $chuyen_trang");
        }

        public function ViewCart(){
            $data = ['srr'=>[],'smg'=>[]];

            if (!empty($_SESSION['cart'])) {
                $list_id_prod = array_keys($_SESSION['cart']);
                $list_id_prod = implode(',', $list_id_prod);
                // echo $list_id_prod;
                
                $objModelProd = new ProductsModel();
                $list_prod = $objModelProd ->getALl(['id_in'=>$list_id_prod]);

                $data['list_prod'] = $list_prod;
                
                
            }
            // print_r($_SESSION['cart']);



            
            $this ->RenderView('products.view-cart',$data,'layout-front');
        }

        public function IncProd(){
            $chuyen_trang = base_path . "?ct=products&act=view-cart";
            print_r($_SESSION['cart']);
            $id = $_GET["id"];
            $_SESSION['cart'][$id]++;
            // print_r($_SESSION['cart'][$id]);

            header("Location:$chuyen_trang");
            
        }
        public function RedProd(){
            $id = $_GET["id"];
            $chuyen_trang = base_path  . "?ct=products&act=view-cart";
                if ( $_SESSION['cart'][$id] > 1) {
                    
                    print_r($_SESSION['cart']);
                   
                    $_SESSION['cart'][$id]--;
                    // print_r($_SESSION['cart'][$id]);
        
                    
                }
            header("Location:$chuyen_trang");

            

            
            
        }
        
        public function Remove(){
            $chuyen_trang = base_path . "?ct=products&act=view-cart";
            print_r( $_SESSION['cart']);
            $id = $_GET["id"];
            unset($_SESSION['cart'][$id]);
             
            header("Location:$chuyen_trang");
            
        }
        public function Filter(){
            $data = ['srr'=>[],'smg'=>[]];
            $category =$_GET['category'];

            $objModelSP = new ProductsModel();
            
            $data['list-prod'] = $objModelSP->getAllByType($category);
            
            $this->RenderView('products.list-all', $data, 'layout-front');
            

           
            
        }
        public function ToPay(){
            $data = ['err'=>[],'smg'=>[]];

            if (isset($_POST['submit'])){
               
               
              
                    if (!empty($_POST['fullname'])){
                        $fullName = $_POST['fullname'];
                      

                    }else{
                        $data['err'][] = "thieu ten";
                    };


                    if (!empty($_POST['dc'])){
                        $dc = $_POST['dc'];
                      

                    }else{
                        $data['err'][] = "thieu dia chi";
                    };



                    if (!empty($_POST['pnb'])){
                        $pnb = $_POST['pnb'];
                      
                    }else{
                        $data['err'][] = "thieu s dien thoai";
                    };



                    if (!empty($_POST['email'])){
                        $email = $_POST['email'];
                        
                    }else{
                        $data['err'][] = "thieu email";
                    }


                    if (empty($data['err'])) {
                        $data['smg'][] ="ban da dat hang thanh cong";
                    }else{
                        
                    }

                    






               
            }



            $this->RenderView('products.toPay', $data, 'layout-front');
        }





    }   