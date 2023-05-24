<?php
$uid = "";
class User
{
    public $id;
    public $username;
    public $password;
    public $email;

    public function __construct($username, $password, $email, $id = 0)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    function username_exists($username, $db)
    {
        //$db = Db::getInstance();

        $query = "SELECT * FROM user WHERE username='$username'";
        $res = $db->query($query);
        return mysqli_num_rows($res) > 0;
    }

    public function dodaj($db)
    {
        $id = $this->id;
        $uid = $id;
        $username = $this->username;
        $password = sha1($this->password);
        $email = $this->email;
        $qs = "INSERT INTO user (id,username,password,email) VALUES ($id,'$username','$password','$email');";

        $result = mysqli_query($db, $qs);

        if (mysqli_error($db)) {
            var_dump(mysqli_error($db));
            exit();
        }
        $this->id = mysqli_insert_id($db);

    }

    public static function login($username, $password, $db)
    {
        $password = sha1($password);
        $qs = "SELECT * FROM user WHERE username='$username'";
        //$db = Db::getInstance();

        if ($result = mysqli_query($db, $qs)) {
            while ($row = $result->fetch_assoc()) {
                $user = new User($row["username"], $row["password"], $row["email"], $row["id"]);
                return $user;
            }
        }

    }
}