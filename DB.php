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

        public function getParams() {
            $res = $this->connection->query("SELECT * FROM `params`");

            $data = array();
            while ($val = $res->fetch_assoc()) {
                $data[] = $val;
            }
            return $data;
        }

        public function saveParam($paramName)
        {
            $this->connection->query("INSERT INTO `params` (`name`) VALUES (\"$paramName\")");
        }

        public function saveRating($userId, $paramId, $value)
        {
            $check = $this->connection->query("SELECT * FROM `rating` WHERE `user_id` = \"$userId\" AND `param_id` = \"$paramId\"");
            if (mysqli_num_rows($check) == 0) {
                $this->connection->query("INSERT INTO `rating` (`user_id`, `param_id`, `rating`) VALUES (\"$userId\", \"$paramId\", \"$value\")");
            }
        }

        public function getRatings()
        {
            $res = $this->connection->query("SELECT `users`.`id`, `users`.`name` as \"user_name\", `params`.`name`, `rating`.`rating` FROM `rating`, `params`, `users` WHERE `rating`.`user_id` = `users`.`id` AND `params`.`id` = `rating`.`param_id` GROUP BY `rating`.`id`");
            $data = array();
            while ($val = $res->fetch_assoc()) {
                $data[] = $val;
            }
            return $data;
        }
    }
?>