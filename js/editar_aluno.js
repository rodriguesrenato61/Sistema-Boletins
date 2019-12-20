$(document).ready(function(){

    var nome = $('#nome');

    var matricula = $('#matricula');

    var salvar = $('#salvar');

    salvar.attr('disabled', true);

    nome.bind('focus', function(){
        salvar.attr('disabled', true);
    });

    nome.bind('focusout', function(){

        if(nome.val() != ""){
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/alunos.php?operacao=2&matricula="+matricula.val()+"&nome="+nome.val(),
                success: valida_aluno
            });
        }else{
            alert("Insira o nome");
            salvar.attr('disabled', true);
        }

    });
});

function valida_aluno(data){
    var linhas;

    $.each(data, function(i, alunos){
        linhas = parseInt(alunos.linhas);
        if(linhas > 0){
            alert("Esse nome já existe");
            $('#salvar').attr('disabled', true);
        }else{
            $('#salvar').attr('disabled', false);
        }
    });
}