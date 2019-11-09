<?php
class Contact {
    var $id;
    var $name;
    var $phone;
    var $email;
    var $regency;
    

    public function __construct($id, $name, $phone, $email, $regency)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->regency = $regency;
    }
    static function connectToDB() {
        $con = new mysqli("localhost", "root", "", "contact");
        $con->set_charset("utf8");
        if($con->connect_error)
            die("Ket noi that bai khi tao moi. Chi tiet: " . $con->connect_error);
        return $con;
    }

    static function coutContactDB() {
        $con = Contact::connectToDB();
        $sql = "SELECT * FROM Contact";
        $result = $con->query($sql);
        return $result->num_rows;
    }

    static function createToDB( $name, $phone, $email, $regency) {
        $con = Contact::connectToDB();

        $sql = "INSERT INTO Contact (name, phone, email, regency) VALUES ('$name', '$phone', '$email', '$regency')";
        $result = $con->query($sql);

        $con->close();
    }


    static function editToDB($id, $name, $phone, $email, $regency){
        $con = Contact::connectToDB();
        
        $sql = "UPDATE Contact SET name = '$name', phone = $phone, email = '$email', regency = $regency WHERE Contact.id = $id";
        $result = $con->query($sql);

        $con->close();
    }


    static function deleteToDB($id) {
        $con = Contact::connectToDB();
        
        $sql = "DELETE FROM Contact WHERE id = $id";
        $result = $con->query($sql);

        $con->close();
    }  
    static function getListFromDB($search = null) {
        $con = Contact::connectToDB();
        $sql = "";
        if($search != null) {
            $sql = "SELECT * FROM Contact WHERE name LIKE '%$search%' OR phone LIKE '%$search%' OR email = '%$search%' OR regency = '%$search%'";
        }
        else {
            $sql = "SELECT * FROM Contact";
        }
        
        $result = $con->query($sql);    
        $arrContact = [];
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $contact = new Contact($row["id"], $row["name"],$row["phone"],$row["email"],$row["regency"]);
                array_push($arrContact, $contact);
            }
        }

        $con->close();
        return $arrContact;
    }
}