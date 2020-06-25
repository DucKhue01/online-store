<?php
    require_once app_path. '/Model/ProductsModel.php';

    class AdminController extends ControllerBase{
        public function Edit(){
            $data = ['srr'=>[],'smg'=>[]];

            $objModelSP = new ProductsModel();
            
            $data['list-prod'] = $objModelSP->getAll();




            $this->RenderView('admin.edit', $data, 'layout-back');
        }
        public function Index(){
            




            $this->RenderView('admin.index', [], 'layout-back');
        }
        
    }
    



?>