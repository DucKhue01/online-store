<?php
/**
 * Created by PhpStorm.
 * User: tu901
 * Date: 7/10/2020
 * Time: 1:16 PM
 */

class OrderModel extends DB
{
    public function addOrder($idcus,$status){

        $sql = "INSERT INTO `tb_order` (id_customer, status) VALUES ('$idcus','$status')";

        $this->Query($sql);
        return $this->cnn->insert_id;
    }
    public function addOrderDetail($idorder,$id_book,$price,$quality){

        $sql = "INSERT INTO `tb_order_detail` (id_order, id_book,price, quality) VALUES ('$idorder','$id_book','$price','$quality')";

        return $this->Query($sql);
}
}