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

            $chuyen_trang = base_path .'/';
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




            
            $this ->RenderView('products.view-cart',$data,'layout-front');
        }

    }   