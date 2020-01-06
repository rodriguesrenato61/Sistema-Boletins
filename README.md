# Sistema Boletins
Email: rodriguesrenato61@gmail.com
Contatos: 98 999812283/ 98 988258639
Sistema web feito com Php, MySQL, HTML, CSS e javascript para realizar gestão de boletins dos alunos com CRUD.
Para utilizar o banco de dados importe o arquivo escola.sql para seu phpmyadmim ou qualquer outro SGBD que utilize.
Para configurar o host, nome, usuário e senha do banco vá em class/conexao.php e faça as configurações de acordo com o banco que você fez. O sistema utiliza bootstrap e jquery por isso é necessário internet para seu funcionamento. Essa pequena aplicação já está funcional.

## Exibindo dados dos alunos
Aqui é possível observar o número de matrícula, o nome, a quantidade de disciplinas que cada aluno cursa, quantidade de aprovações, quantidade de reprovações e quantidade de recuperações. Além disso há botões para inserir um novo aluno, editar os dados do aluno, removê-lo do sistema e uma barra de busca para encontrar o aluno pelo nome.

![exibindo alunos](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/alunos.png)

## Exibindo dados das disciplinas
Nesta página podemos observar o código, nome, quantidade de alunos que fazem cada disciplina, quantidade de alunos aprovados, reprovados e de recuperação. Há também botões para inserir, editar, remover uma disciplina e uma barra de busca para encontrar disciplinas pelo nome.

![exibindo disciplinas](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/disciplinas.png)

## Exibindo dados dos boletins
Aqui podemos visualizar os dados referentes aos boletins como matrícula do aluno, aluno, disciplina, primeira nota, segunda nota, terceira nota, quarta nota, média das notas e a situação que o aluno se encontra nas disciplinas de acordo com sua média de cada uma. Além disso existem butões para inserir, editar, excluir um boletim e uma barra de pesquisa onde podemos pesquisar os boletins por aluno, disciplina e situação.

![exibir boletins](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/boletins.png)

## Inserindo aluno
A inserção de um novo aluno é feita garantindo que seu nome não seja igual a nenhum outro aluno já cadastrado, caso tente inserir um nome que já está cadastrado retornará uma mensagem de erro e ele não será inserindo. O número da matrícula é gerado automaticamente.

![inserir aluno](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/inserindo_aluno.png)

## Inserindo disciplina
A inserção de uma nova disciplina é feita garantindo que seu nome não seja igual a nenhuma outra já cadastrada, se tentar inserir um nome repetido uma mensagem de erro aparecerá e a inserção é cancelada. O número do seu código é gerado automaticamente.

![inserir disciplina](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/inserir_disciplina.png)

## Inserindo boletim
A inserção de um boletim é feita garantindo que todos os dados sejam inseridos corretamente. Ao escolher o aluno somente as disciplinas que o aluno não faz serão exibidas no campo de escolha da disciplina. Se nenhum aluno ou disciplina for escolhida retornará o erro impedindo a sua inserção, assim como as notas que precisam ser um número que vai de 0 a 10 também são verificadas.

![inserir boletim](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/inserir_boletim.png) 

## Atualizando dados do aluno
Para atualizar o nome do aluno seu novo nome precisa ser diferente de qualquer outro que já esteja registrado, assim a atualização só é concluída quando o nome for validado.

![atualizar aluno](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/editar_aluno.png)

## Atualizando dados da disciplina
A atualização do nome da disciplina é feita garantindo que seu novo nome seja diferente das outras disciplinas já registradas, caso o nome já esteja em uso retornará um erro impedindo sua atualização.

![atualizar disciplina](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/editar_disciplina.png)

## Atualizando dados do boletim
Para atualização de um boletim só é possível modificar as notas do registro fazendo as devidas verificações para impedir que alguma nota que não esteja no intervalo de 0 a 10 seja colocada.

![atualizar boletim](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/editar_boletim.png) 

## Deletando um aluno
A exclusão do aluno é feita removendo também todos os boletins em que ele está incluído para que nenhum registro fique inválido.

![deletar aluno](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/excluir_aluno.png)

## Deletando uma disciplina
A exclusão da disciplina é feita removendo todos os boletins em que ela está incluída para que nenhum registro fique inválido.

![deletar disciplina](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/excluir_disciplina.png)

## Deletando um boletim


![deletar boletim](https://github.com/rodriguesrenato61/Sistema-Boletins/blob/master/prints/excluir_boletim.png)
