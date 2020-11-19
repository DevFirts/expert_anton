<?php
    class DB {

        public $connection;

        function __construct()
        {
            $this->connection = new mysqli("localhost", "root", "root", "experts");
            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        }

        public function userIsExist($login, $pass) {
            $mdPass = md5($pass);
            $result = $this->connection->query("SELECT * FROM `users` WHERE users.login = \"$login\" AND users.pass = \"$mdPass\"");
            return mysqli_num_rows($result);
        }

        public function getUserId($login) {
            $res = $this->connection->query("SELECT `id` FROM `users` WHERE `login` = \"$login\"");
            $row = $res->fetch_assoc();
            return $row["id"];
        }

        public function regNewUser($name, $pass, $login)
        {
            $mdPass = md5($pass);
            return $this->connection->query("INSERT INTO `users` (`login`, `pass`, `name`) VALUES (\"$login\", \"$mdPass\", \"$name\")");
        }
    }
?>