
$(document).ready(function(){//quando toda página carregar esse javascript será carregado
    
    var aluno = $('#aluno');

    var disciplina = $('#disciplina');

    var nota1 = $('#nota1');

    var nota2 = $('#nota2');

    var nota3 = $('#nota3');

    var nota4 = $('#nota4');

    var inserir = $('#inserir');


    aluno.bind('change', function(){//quando um aluno for escolhido irá as disciplinas que ele ainda não faz serão carregadas

        if(aluno.val() != "0"){//se o aluno foi escolhido

            disciplina.attr('disabled', false);//ativando o select das disciplinas

            $.ajax({//fazendo uma requisição ajax com o método get para chamar um json com as disciplinas que o aluno ainda não faz
                type: "GET",
                dataType: "JSON",
                url: "json/disciplinas.php?operacao=1&aluno="+aluno.val(),
                success: valida_disciplinas
            });

        }else{//se o aluno ainda não foi escolhido
            disciplina.attr('disabled', true);//disativando o select de disciplinas
        

        }
    });

});

//função para carregar o json as disciplinas que o aluno ainda não faz e imprimí-las em um select
function valida_disciplinas(data){
    var html = "<option value='0'>--Disciplinas--</option>";
    $.each(data, function(i, disciplinas){

        html += "<option value='"+disciplinas.codigo+"'>"+disciplinas.disciplina+"</option>";
        
    });

    $('#disciplina').html(html);


}

