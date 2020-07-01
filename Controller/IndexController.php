<?php
    require_once app_path. '/Model/UserModel.php';
    require_once app_path. '/Model/ProductsModel.php';



    class IndexController extends ControllerBase{ 
        public function Index(){
           
            $data = ['srr'=>[],'smg'=>[]];
    
            $objModelSP = new ProductsModel();
                
            // $data['list-prod'] = $objModelSP->getBL();
    
            $this->RenderView('index.index', [], 'layout-front');
            
  
            
        }

        public function login(){
            $data = ['err'=>[],'smg'=>[]];
            if (isset($_POST['uname'])) {
                $username = $_POST['uname'];
                $passwd = $_POST['pwd'];

                //verify user & passwd

                $bt = '/^[a-zA-Z][a-zA-Z0-9]{4,30}$/';

                if (!preg_match($bt, $username)) {
                    // khong hop le
                    $data['err'][] = 'username khong hop le';

                }
                if (strlen($passwd) < 3) {
                    $data['err'][] = 'pass it nhat 3 ki tu';
                }
                //thao tac voi co so du lieu

                if (empty($data['err'])) {
                    
                    $objModel = new userModel();
                    $userInfo = $objModel->getLogin($username);
                    if (!empty($userInfo)) {
                        

                        if ($userInfo['passwd'] == $passwd) {



                            $listPms = $objModel -> loadPmsByRole($userInfo['id_role']);

                            $userInfo['list_pms'] = $listPms;
                            
                           unset($userInfo['passwd']);
                           $_SESSION['auth'] = $userInfo;


                           header("Location:" . base_path);


                        }else{
                            $data['err'][] = "sai pass";


                        }
                        
                    }else{
                        $data['err'][] = 'khong ton tai tai khoan' . $username;
                    }



                }


            }
            $this -> RenderView('index.login', $data );
            
            
        }

        public function Logout() {
            if (!empty( $_SESSION['auth'])) {
                unset($_SESSION['auth']);
            }

            header('Location:' . base_path);


        }
        public function SignUp() {
            $data = ['err'=>[],'smg'=>[]];
            $objModel = new userModel();
            
            if (isset($_POST['submit'])){
                
                if (!empty($_POST['uname01'])) {
                    $username = $_POST['uname01'];
                 

                    $userInforName = $objModel->getInfor('username',$username);
                 


                    if (!empty($userInforName)){
                        $data['err'][] = "da ton tai user name";
                    }else{
                        // $data['err'][] = "user name oke";

                    };
                
                }else{
                    $data['err'][] = 'khong duoc de trong pass';
                } 
            
                if (!empty($_POST['email01'])){
                    $email = $_POST['email01'];
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $data['err'][] = "Invalid email format";
                    }else{
                        $userInforEmail = $objModel->getInfor('email',$email);
                        if (!empty($userInforEmail)){
                            $data['err'][] = "da ton tai email";
                        }else{
                            
        
                        }
                    }    
                }else{
                    $data['err'][] = 'khong duoc de trong email';
                }



                if (!empty($_POST['pwd01'])) {
                    $passwd = $_POST['pwd01'];
                    if (strlen($passwd) < 3) {
                        $data['err'][] = 'pass it nhat 3 ki tu';
                    }
                     
                }else{
                    $data['err'][] = 'khong duoc de trong pass';
                }
                // print_r($data);

                if (empty($data['err'])) {
                    $objModel->addAcc($username,$email,$passwd);
                    $data['smg'][] =" tai khoan  $username da tao thanh cong";
                }else{
                    $data['srr'][] = " loi  dang ki";
                }
            }
            $this -> RenderView('index.login', $data );
            
            
        }



    }