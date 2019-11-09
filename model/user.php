<?php 
class User {
    var $userName;
    var $passWord;
    var $fullName;

    function User($userName, $passWord, $fullName) {
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->fullName = $fullName;
    }

    /**
     * Xac thuc nguoi su dung
     * @param $userName string Ten dang nhap
     * @param $passWord string Mat khau
     * @return User hoac null 
     */
    static function authentication($userName, $passWord) {
        if($userName == "admin" && $passWord == "admin") {
            return new User("admin", "admin", "Nguyen Van Quang");
        }
        else {
            return null;
        }
    }
}
?>