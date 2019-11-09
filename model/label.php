<?php
 include_once('model/contact.php');
class Label {
    var $id;
    var $name; 
    

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;    
    }
   
    static function connectToDB() {
        $con = new mysqli("localhost", "root", "", "contact");
        $con->set_charset("utf8");
        if($con->connect_error)
            die("Ket noi that bai khi tao moi. Chi tiet: " . $con->connect_error);
        return $con;
    }

    static function coutLabelDB() {
        $con = Label::connectToDB();
        $sql = "SELECT * FROM Label";
        $result = $con->query($sql);
        return $result->num_rows;
    }
    static function getListLabelDB() {
        $con = Label::connectToDB();
        $sql = "SELECT * FROM Label";
        $result = $con->query($sql);
        $arr = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $label = new Label($row["id"], $row["name"]);
                array_push($arr, $label);
            }
        }
        $con->close();
        return $arr;
    }
    static function coutContactByIdDB($id) {
        $con = new mysqli("localhost", "root", "", "contact");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM label_contact where label_id = $id ";
        $result = $con->query($sql);
        return $result->num_rows;
    }

    static function createToDB( $name) {
        $con = Label::connectToDB();        
        $sql = "INSERT INTO Label (name) VALUES ('$name')";
        $result = $con->query($sql);
        $con->close();
    }


    static function editToDB($id, $name){
        $con = Label::connectToDB();        
        $sql = "UPDATE Label SET name = '$name' WHERE Label.id = $id";
        $result = $con->query($sql);

        $con->close();
    }


    static function deleteToDB($id) {
        $con = Label::connectToDB();
        
        $sql = "DELETE FROM Label WHERE Label.id = $id";
        $result = $con->query($sql);

        $con->close();
    }  
    static function getListContactOfLabel($label_id){
        // var_dump ( $label_id);
        $con = new mysqli("localhost", "root", "", "contact");
        $con->set_charset("utf8");
        $sql = "SELECT * FROM `label_contact` WHERE label_id = $label_id ";       
        // echo $sql;
        $result = $con->query($sql);       
        // var_dump($result)      ;
        $arrLabelId = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){                
                array_push($arrLabelId,$row["contact_id"]);
            }
        }
        // echo $arrLabelId[0];
        $arrId = implode(",",$arrLabelId); 
        // echo $arrId;
        $con2 = new mysqli("localhost", "root", "", "contact");
        $con2->set_charset("utf8");
        $sql2 = "SELECT * FROM `contact` WHERE id in ($arrId) ";
        $result2 = $con2->query($sql2);
        // var_dump($result2);
        $arrContact = [];
        if($result2 != false) {
            while($row = $result2->fetch_assoc()){
                $contact = new Contact($row["id"], $row["name"],$row["phone"],$row["email"],$row["regency"]);
                array_push($arrContact, $contact);
            }
        }
        $con->close();
        $con2->close();
        return $arrContact;      
    }   
}