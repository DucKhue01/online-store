<?php
/**
 * Created by PhpStorm.
 * User: tu901
 * Date: 7/10/2020
 * Time: 12:45 PM
 */

class CustomerModel extends DB
{
    public function getCustomer($fullname){
        $sql = "SELECT * FROM tb_customer WHERE fullname = '$fullname' ";
        $res = $this -> Query($sql);
        $data = [];

        while ($row = $res ->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    public function addCustomer($fullname,$phone,$email,$address){

        $sql = "INSERT INTO `tb_customer` (fullname, phone, email,address) VALUES ('$fullname','$phone','$email','$address')";
        $this->Query($sql);

        return $this->cnn->insert_id;
    }
}