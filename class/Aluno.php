<?php

    include_once('conexao.php');//importando a conexão com o banco de dados
    include_once('Mensagem.php');//importando a classe mensagem

    class Aluno{

        //função que retorna os registros dos alunos do banco de acordo com os filtros de busca
        public function exibir($matricula, $nome, $aluno, $status_matricula){

            global $sistema;

            $pdo = $sistema->getPdo();//pegando o objeto pdo de conexão com o banco

            $query = "SELECT * FROM vw_alunos";//query inicial para ser enviada ao banco

            $clausula = array();//array que guarda as cláusulas where para filtragem
            $i = 0;//variável que define a quantidade de cláusulas

            if($nome != null){//se o nome for setado ele ser buscado
                $clausula[$i] = "aluno LIKE '%".$nome."%'";
                $i++;
            }

            if($matricula != "0"){//se a matricula for setada ela será buscada de acordo com o status
                $matricula = (int) $matricula;
                $status_matricula = (int) $status_matricula;
                if($status_matricula > 0){
                    $clausula[$i] = "matricula = ".$matricula;
                }else{
                    $clausula[$i] = "matricula != ".$matricula;
                }
                $i++;
            }

            if($aluno != null){//se o aluno for setado ele será buscado
                $clausula[$i] = "aluno = '".$aluno."'";
                $i++;
            }
            

            for($cont = 0; $cont < $i; $cont++){//adicionando as cláusulas a query
                if($cont == 0){
                    $query .= " WHERE ".$clausula[$cont];
                }else{
                    $query .= " AND ".$clausula[$cont];
                }
            }
            

            $query .= " ORDER BY aluno";//ordenando os alunos pelo nome

            $sql = $pdo->prepare($query);//enviando a query para o banco de dados

            $sql->execute();//executando a query

            return $sql;//retornando o resultado da consulta
        }

        public function inserir($nome){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL insert_aluno(:nome)");
            $sql->bindValue(":nome", $nome);
            $sql->execute();
        }
        
        public function valida_aluno($nome){
            
            $registros = $this->exibir(0, null, $nome, 0);
            
            $linhas = $registros->rowCount();
            
            if($linhas > 0){
                
                $msg = ("Erro, esse nome já está em uso!");
                
            }else{
                
                $msg = ("Pode inserir o aluno!");
                
            }
            
            return $msg;
        }
        
        public function verificar_disponibilidade($matricula, $nome){
            
            $registros = $this->exibir($matricula, null, $nome, 0);
            
            $linhas = $registros->rowCount();
            
            if($linhas > 0){
                
                $msg = "Erro, esse nome já está em uso!";
                
            }else{
                
                $msg = "Pode atualizar o aluno!";
                
            }
            
            return $msg;
        }

        public function editar($matricula, $nome){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL update_aluno(:matricula, :nome)");
            $sql->bindValue(":matricula", (int) $matricula);
            $sql->bindValue(":nome", $nome);
            $sql->execute();
        }

        public function excluir($matricula){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL delete_aluno(:matricula)");
            $sql->bindValue(":matricula", (int) $matricula);

            $sql->execute();
        }
        
        public function get($matricula){
            
            global $sistema;
            
            $pdo = $sistema->getPdo();
            
            $sql = $pdo->prepare("SELECT * FROM alunos WHERE matricula = :matricula");
            $sql->bindValue(":matricula", (int) $matricula);
            
            $sql->execute();
            
            $aluno = $sql->fetch();
            
            return $aluno;
        }
        
        public function modalExcluir($matricula){
            
            $msg = new Mensagem;
            
            $aluno = $this->get($matricula);
            
            $conteudo = "Tem certeza de que deseja excluir o aluno(a) ".$aluno['nome']."?";
            
            $msg->modalExcluir("Excluir aluno", $conteudo, "alunos", $matricula);
        }

    }

?>
