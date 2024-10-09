<?php
 /* Classe TConnection 
 * gerencia conexões com banco de dados através de arquivos de configuração.
 */

 final class TConnection
 {
    /* Método __construct()
    * não exisirão instancias de TConnection, por isto estamos marcando-o como private
    */

    private function __construct(){}

    /* Método Open ()
    * recebe o nome do banco de dados e instancia o objeto PDO correspondente
    */

    public static function open($name){
        //verifica se existe arquivo de configuração para este banco de dados

        if(file_exists("app.config/{$name}.ini")){
            // le o INI e retorna um Array            
            $db = parse_ini_file("app.config/{$name}.ini");
        }

        else{
            // Se não existir, lança um erro
            throw new Exception("Arquivo. '$name' não encontrado");
        }

        // Lê os arquivos e grava as informações contidas neles
        $user = isset($db['user']) ? $db['user'] :'NULL';
        $pass = isset($db['pass']) ? $db['pass'] :'NULL';
        $name = isset($db['name']) ? $db['name'] :'NULL';
        $host = isset($db['host']) ? $db['host'] :'NULL';
        $type = isset($db['type']) ? $db['type'] :'NULL';
        $port = isset($db['port']) ? $db['port'] :'NULL';

    }

    // Descobre qual o tipo de (driver) banco de dados a ser utilizado
    switch($type){
        case 'pgsql':
            $port = $port ? $port : '5432';
            $conn = new PDO('pgsql:dbname={$name}; user={$user}; password={$password}; host=$host; port={$host}');
            break;

        case 'mysql':
            $port = $port ? $port : '3306';
            

    }
}
 
 






?>