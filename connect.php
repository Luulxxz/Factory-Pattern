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

?>