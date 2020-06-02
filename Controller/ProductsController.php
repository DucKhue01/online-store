<?php   
    require_once app_path. '/Model/ProductsModel.php';


    class ProductsController extends ControllerBase{
        public function ListAll() {
            echo '<br> ham hien thi danh sahc san pham';
            $data = ['srr'=>[],'smg'=>[]];

            $objModelSP = new ProductsModel();
            
            $data['list-prod'] = $objModelSP->getAll();

            $this->RenderView('products.list-all', $data, 'layout-front');

                




           
        }



    }