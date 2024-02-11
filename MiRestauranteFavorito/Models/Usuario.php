<?php
class Usuario
{
    public $name;
    public $password;


    function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = hash('sha256', $password);
    }

    public function isLogged()
    {
        global $connection;
        $query = $connection->prepare('SELECT (password = :password) as "isLogged" FROM usuarios WHERE name = :name; ');
        $query->execute(array(':name' => $this->name, ':password' => $this->password));
        $response = $query->fetch();
        if (!$response)
            return 0;
        else
            return $response[0];
    }

}

?>