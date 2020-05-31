<?php


class UserModel extends DB{
    private $tb = 'tb_user';

    public function getAll(){
        $sql =  "SELECT * FROM $this->tb";
        $res = $this->Query($sql);

        $data = [];

        while ($row = $res ->fetch_assoc()) {
           $data[] = $row;
        }
        return $data;

    }

    public function getLogin($username) {
        $sql = "select * from tb_user where username = '$username'";
        $res = $this->Query($sql);
        if ($res->num_rows == 1) {
            $user = $res->fetch_assoc();
            return $user;
        }
        return null;
    }


}