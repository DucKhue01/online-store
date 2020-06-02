<?php
    require_once app_path. '/Model/UserModel.php';



    class IndexController extends ControllerBase{ 
        public function Index(){
            

            $this -> RenderView('index.home', [] , 'layout-front');
        }

        public function login(){
            $data = ['srr'=>[],'smg'=>[]];
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
                        // //lay thon  tin cuua tai khoan
                        // //kt pass   
                        // unset($userInfo['passwd']);
                        // echo '<pre>';
                        //     print_r($userInfo);
                        // echo '/<pre>';

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
            $this -> RenderView('index.login', $data , 'layout-front');
            
            
        }



        public function Logout() {
            if (!empty( $_SESSION['auth'])) {
                unset($_SESSION['auth']);
            }

            header('Location:' . base_path);


        }



    }