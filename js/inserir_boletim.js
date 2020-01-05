
$(document).ready(function(){
    
    var aluno = $('#aluno');

    var disciplina = $('#disciplina');

    var nota1 = $('#nota1');

    var nota2 = $('#nota2');

    var nota3 = $('#nota3');

    var nota4 = $('#nota4');

    var inserir = $('#inserir');


    aluno.bind('change', function(){

        if(aluno.val() != "0"){

            disciplina.attr('disabled', false);

            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/disciplinas.php?operacao=1&aluno="+aluno.val(),
                success: valida_disciplinas
            });

        }else{
            disciplina.attr('disabled', true);
        

        }
    });

});

function valida_disciplinas(data){
    var html = "<option value='0'>--Disciplinas--</option>";
    $.each(data, function(i, disciplinas){

        html += "<option value='"+disciplinas.codigo+"'>"+disciplinas.disciplina+"</option>";
        
    });

    $('#disciplina').html(html);


}

