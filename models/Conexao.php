<?php
class Conexao
{

    public function conectar()
    {
        require $_SERVER['DOCUMENT_ROOT'] . '/.env.php';
        try {
            $conexao = new PDO(
                "mysql:host=$host;dbname=$database",
                "$user",
                "$password"
            );
            return $conexao;
        } catch (PDOException $error) {
            echo '<p>' . $error->getMessage() . '</p>';
        }
    }
}
