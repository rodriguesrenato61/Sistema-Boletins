<?php

    include_once('conexao.php');//importando a conexão com o banco
    include_once('Mensagem.php');//importando a classe mensagem

    Class Boletim{

        //função para exibir os dados dos boletins de acordo com os parâmetros de filtragem
        public function exibir($id, $aluno, $disciplina, $situacao){

            global $sistema;

            $pdo = $sistema->getPdo();

            $query = "SELECT * FROM vw_boletins";

            $clausula = array();
            $i = 0;

            if($aluno != null){
                $clausula[$i] = "aluno LIKE '%".$aluno."%'";
                $i++;
            }
            if($disciplina != null){
                $clausula[$i] = "disciplina LIKE '%".$disciplina."%'";
                $i++;
            }
            $id = (int) $id;
            if($id != 0){
                $clausula[$i] = "id = ".$id;
                $i++;
            }
            $situacao = (int) $situacao;
            if($situacao != 0){
                switch($situacao){
                    case 1:
                        $clausula[$i] = "situacao = 'Aprovado'";
                    break;
                    case 2:
                        $clausula[$i] = "situacao = 'Reprovado'";
                    break;
                    case 3:
                        $clausula[$i] = "situacao = 'Recuperação'";
                    break;
                }
                $i++;
            }
            for($cont = 0; $cont < $i; $cont++){
                if($cont == 0){
                    $query .= " WHERE ".$clausula[$cont];
                }else{
                    $query .= " AND ".$clausula[$cont];
                }
            }

            $query .= " ORDER BY aluno";

            $sql = $pdo->prepare($query);

            $sql->execute();

            return $sql;
        }

        //função para inserir um novo boletim no banco
        public function inserir($aluno, $disciplina, $nota1, $nota2, $nota3, $nota4){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL insert_aluno_disciplina(:aluno, :disciplina, :nota1, :nota2, :nota3, :nota4)");
            $sql->bindValue(":aluno", (int) $aluno);
            $sql->bindValue(":disciplina", (int) $disciplina);
            $sql->bindValue(":nota1", (float) $nota1);
            $sql->bindValue(":nota2", (float) $nota2);
            $sql->bindValue(":nota3", (float) $nota3);
            $sql->bindValue(":nota4", (float) $nota4);

            $sql->execute();

        }
        
        //função que verifica se uma nota é válida ou não
        public function valida_nota($nota){
            
            if(is_numeric($nota)){
                
                $nota = (float) $nota;
            
                if($nota >= 0 && $nota <= 10){
                
                    return true;
                
                }else{
                
                    return false;
                
                }
            }else{
                
                return false;
                
            }
        }
        
        //função que verifica se todos os dados do novo boletim são válidos
        public function valida_boletim($aluno, $disciplina, $nota1, $nota2, $nota3, $nota4){
            
            $aluno = (int) $aluno;
            
            $disciplina = (int) $disciplina;
            
            $nota1_valida = $this->valida_nota($nota1);
            
            $nota2_valida = $this->valida_nota($nota2);
            
            $nota3_valida = $this->valida_nota($nota3);
            
            $nota4_valida = $this->valida_nota($nota4);
            
            if($aluno != 0 && $disciplina != 0 && $nota1_valida && $nota2_valida && $nota3_valida && $nota4_valida){
                
                $msg = "válido!";
                
            }else{
                
                $msg = "Erro, preencha os dados corretamente!";
                
            }
            
            return $msg;
        }

        //função que atualiza os dados do boletim
        public function editar($id, $nota1, $nota2, $nota3, $nota4){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL update_aluno_disciplina(:id, :nota1, :nota2, :nota3, :nota4)");
            $sql->bindValue(":id", (int) $id);
            $sql->bindValue(":nota1", (float) $nota1);
            $sql->bindValue(":nota2", (float) $nota2);
            $sql->bindValue(":nota3", (float) $nota3);
            $sql->bindValue(":nota4", (float) $nota4);

            $sql->execute();

        }

        //função que exclui um boletim do banco
        public function excluir($id){

            global $sistema;

            $pdo = $sistema->getPdo();

            $sql = $pdo->prepare("CALL delete_aluno_disciplina(:id)");
            $sql->bindValue(":id", (int) $id);

            $sql->execute();
        }
        
        //função que retorna os dados de um determinado boletim
        public function get($id){
            
            global $sistema;
            
            $pdo = $sistema->getPdo();
            
            $sql = $pdo->prepare("SELECT * FROM vw_boletins WHERE id = :id");
            $sql->bindValue(":id", (int) $id);
            
            $sql->execute();
            
            $boletim = $sql->fetch();
            
            return $boletim;
        }
        
        //função que exibe uma janela modal para exclusão de um boletim
        public function modalExcluir($id){
            
            $msg = new Mensagem;
            
            $boletim = $this->get($id);
            
            $conteudo = "Tem certeza de que deseja excluir o boletim do(a) aluno(a) ".$boletim['aluno']." com a disciplina ".$boletim['disciplina']."?";
            
            $msg->modalExcluir("Excluir boletim", $conteudo, "boletins", $id);
        }

    }

?>
