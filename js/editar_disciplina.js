$(document).ready(function(){

    var nome = $('#nome');

    var codigo = $('#codigo');

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
                url: "json/disciplinas.php?operacao=3&codigo="+codigo.val()+"&nome="+nome.val(),
                success: valida_disciplina
            });
        }else{
            alert("Insira o nome");
            salvar.attr('disabled', true);
        }

    });
});

function valida_disciplina(data){
    var linhas;

    $.each(data, function(i, disciplinas){
        linhas = parseInt(disciplinas.linhas);
        if(linhas > 0){
            alert("Essa disciplina já existe");
            $('#salvar').attr('disabled', true);
        }else{
            $('#salvar').attr('disabled', false);
        }
    });
}