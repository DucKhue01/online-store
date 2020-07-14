<?php   
    require_once app_path. '/Model/ProductsModel.php';
    require_once  'Model/CustomerModel.php';
    require_once  'Model/OrderModel.php';
//    nhung file config phpmailer
require_once 'Model/PHPMailer/src/PHPMailer.php';
require_once 'Model/PHPMailer/src/SMTP.php';
require_once 'Model/PHPMailer/src/Exception.php';


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

            $chuyen_trang = "index.php?ct=products&act=list-all";
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
            $chuyen_trang = "index.php?ct=products&act=view-cart";
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
            $chuyen_trang = "index.php?ct=products&act=view-cart";
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
                        $customer_model = new CustomerModel();
                        $customer = $customer_model->getCustomer($fullName);
                        if (empty ($customer )) {
//                            lấy id customer mới được thêm vào
                            $customer[0]['id']  =  $customer_model -> addCustomer($fullName,$pnb,$email,$email);
                        }


                        $order_model = new OrderModel();
//                        lấy id order mới được thêm vào
                        $order_id = $order_model->addOrder($customer[0]['id'],1);
                        if ($order_id > 0) {
                            $product_model = new ProductsModel();

                            $message = "Cảm ơn bạn đã đặt hàng, $fullName";
                            $message .= "<br>";
                            $message .= "Bạn đã đặt hàng <br>";
                            $message .= "<table class='table table-bordered'>";
                            $message .= "<tr>";
                            $message .= "<td>Sản phẩm</td>";
                            $message .= "<td>Số Lượng</td>";
                            $message .= "<td>Tổng giá trị đơn hàng</td>";
                            $message .= "</tr>";
                            foreach ($_SESSION['cart'] AS $product_id => $cart) {
                                $product = $product_model->getProduct($product_id);
                                $message .= "<tr>";
                                $price = $product['price'] * $cart;
                                $message .= "<td>".$product['name']."</td>";
                                $message .= "<td>".$cart."</td>";
                                $message .= "<td>".number_format($price)."</td>";
                                $message .= "</tr>";
                            }
                            $message .= "</table>";
                            if ( $this->sendMail($email, $message,$fullName) == TRUE) {
                                //lưu vào bảng order_details

                                foreach ($_SESSION['cart'] AS $product_id => $cart) {
                                    $product = $product_model->getProduct($product_id);
                                    $price = $product['price'] * $cart;
                                    $order_model->addOrderDetail($order_id,$product_id,$price,$cart);
                                }
                                $_SESSION['success'] = 'Bạn đã đặt hàng thành công';
                                unset($_SESSION['cart']);
                            }
                            else {
                                $_SESSION['error']  = "Đạt hàng thất bại! Vui lòng kiểm tra đường truyền và thử lại";
                            }

                            //tạo message để gửi mail cho kh vừa đặt hàng


                            //gửi mail theo địa chỉ email của kh

                            //chuyển hướng về trang cảm ơn
                            header("Location: index.php?ct=products&act=thank");
                            exit();
                        } else {
                            $_SESSION['error'] = 'Lưu thông tin thanh toán thất bại';
                            header("Location: index.php?ct=products&act=ToPay");
                            exit();
                        }

                    }

            }



            $this->RenderView('products.toPay', $data, 'layout-front');
        }
        public function Thank() {

            $this->RenderView('products.thank',[], 'layout-front');
        }
        protected function sendMail($email, $message,$fullname) {
            // Instantiation and passing `true` enables exceptions
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();
                // Send using SMTP
                //host miễn phí của gmail
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                //username gmail của chính bạn
                $mail->Username   = 'khue2001hd@gmail.com';                     // SMTP username
                //password cho ứng dụng, ko phải password của tài khoảng
//    đăng nhập gmail
//    tạo mật khẩu ứng dụng tại link:
// https://myaccount.google.com/ - menu Bảo mật
                $mail->Password   = 'synuovxmxwpznbqg';                               // SMTP password
                $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('online-store@gmail.com', 'Store');
                //setting mail người gửi
                $mail->addAddress($email, $fullname);     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

                // Attachments
//      $mail->addAttachment('rose.jpeg');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->CharSet = "UTF-8";
                $mail->Subject = 'Cảm ơn bạn đã đặt hàng';
                $mail->Body    = $message;
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                return TRUE;
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                return FALSE;
            }
        }







    }   