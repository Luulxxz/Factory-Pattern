<?php

/* Classe TSqlUpdate
* Essa clase provê meios para manipulação de uma instrução UPDATE nos
* bancos de dados
*/

final class TSqlUpdate extends TSqlInstruction {
    private $columnValues;

    /* Método setRowData()
    * Atribui valores a determinadas colunas no banco de dados que serão modificadas
    * @param $column = coluna da tabela
    * @param $value = valor a ser armazenado
    */

    public function setRowData($column, $value){

        //Verifica se um dado é escalar (string, inteiro...)
        if(is_scalar($value)){
            if(is_string($value) and (!empty($value))){
                // Adiciona \ em aspas
                $value = addslashes($value);

                // Caso seja uma string
                $this -> columnValues[$column] = "'$value'";
            }

            else if(is_bool($value)){
                // Caso seja um booleano
                $this -> columnValues[$column] = $value ? 'TRUE':'FALSE';
            }

            else if($value!==''){
                // Caso seja um tipo de dado
                $this -> columnValues[$column] = $value;
            }

            else{
                //Caso seja NULL
                $this -> columnValues[$column] = "NULL";
            }
        }
    }

    public function getInstruction(){
        // Monta a string UPDATE
        $this -> sql = "UPDATE {$this -> entity}";

        // Monta os pares: coluna=valor
        if($this -> collumnValues){
            foreach($this -> collumnValues as $column => $value){
                $set[] = "{$column} = {$value}";
            }
        }

        $this -> sql .= 'SET' . implode(',', $set);
        // Retorna a clausula where do objeto $this -> criteria

        if($this -> criteria){
            $this -> sql .= 'WHERE'. $this -> criteria -> dump();
        }

        return $this -> sql;
    }
}
?>