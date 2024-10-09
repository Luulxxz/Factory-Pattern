<?php

spl_autoload_register(function ($class){
    if(file_exists("{$class}.class.php")){
        include_once "{$class}.class.php";
    }
});

// Cria a instrução de SELECT
$sql - new TSqlSelect;

// Define o nome da entidade
$sql -> SetEntity('famosos');

// Acrescenta colunas a consulta
$sql -> AddColumn('codigo');
$sql -> AddColumn('nome');

// Crio o critério de seleção
$criteria = new TCriteria;

// Obtem a pessoa codigo "1"
$criteria -> add(new TFilter('codigo', '=', '1'));

// Atribui o critério de seleção
$sql -> SetCriteria($criteria);

try{
    // Abre conexão com banco de dados my_livro(mysql)
    $conn = new TConnection::open('my_livro');

    // Executa a instrução sql
    $result = $conn->query($sql -> getInstruction());

    if($result){
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // Exibe os resultados
        echo $row['codigo']. '-'. $row['nome']. "<br>\n";

        // Fecha a conexão
        $conn = null;
    }
}

catch(PDOException $e){
    // Exibe a mensagem de erro
    print "ERRO!:". $e->getMessage() ."<br>\n";
    die();
}

try{
    // Abre conexão com a base pg_livro 
    $conn = new TConnection::open('pg_livro');

    // Executa a instrução SQL
    $result = $conn->query($sql -> getInstruction());

    if($result){
        $row = $result->fetch(PDO::FETCH_ASSOC);

        //Exibe os resultados
        echo $row['codigo']. '-'. $row['nome']. "<br>\n";
    }

    // Fecho a conexão
    $conn = null;
}

catch(Exception $e){
    // Exibe a mensagem de erro
    print "ERRO!:". $e->getMessage(). "<br>\n";
}
?>