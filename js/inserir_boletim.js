
$(document).ready(function(){
    var aluno = $('#aluno');

    var validaAluno = false;

    var disciplina = $('#disciplina');

    var validaDisciplina = false;

    var nota1 = $('#nota1');

    var validaN1 = false;

    var nota2 = $('#nota2');

    var validaN2 = false;

    var nota3 = $('#nota3');

    var validaN3 = false;

    var nota4 = $('#nota4');

    var validaN4 = false;

    var inserir = $('#inserir');

    disciplina.attr('disabled', true);
    inserir.attr('disabled', true);

    aluno.bind('change', function(){

        if(aluno.val() != "0"){

            disciplina.attr('disabled', false);
            validaAluno = true;
            validaDisciplina = false;

            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);

            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/disciplinas.php?operacao=2&aluno="+aluno.val(),
                success: valida_disciplinas
            });

        }else{
            disciplina.attr('disabled', true);
            validaAluno = false;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);

        }
    });

    disciplina.bind('change', function(){

        if(disciplina.val() != "0"){
            validaDisciplina = true;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }else{
            validaDisciplina = false;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }
    });

    nota1.bind('focusout', function(){

        var n1 = parseFloat(nota1.val());

        if(n1 >= 0 && n1 <= 10){
            $('#n1-msg-erro').html('');
            validaN1 = true;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }else{
            $('#n1-msg-erro').html('Digite um valor entre 0 e 10');
            validaN1 = false;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }

    });

    nota2.bind('focusout', function(){

        var n2 = parseFloat(nota2.val());

        if(n2 >= 0 && n2 <= 10){
            $('#n2-msg-erro').html('');
            validaN2 = true;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }else{
            $('#n2-msg-erro').html('Digite um valor entre 0 e 10');
            validaN2 = false;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }

    });

    nota3.bind('focusout', function(){

        var n3 = parseFloat(nota3.val());

        if(n3 >= 0 && n3 <= 10){
            $('#n3-msg-erro').html('');
            validaN3 = true;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }else{
            $('#n3-msg-erro').html('Digite um valor entre 0 e 10');
            validaN3 = false;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }

    });

    nota4.bind('focusout', function(){

        var n4 = parseFloat(nota4.val());

        if(n4 >= 0 && n4 <= 10){
            $('#n4-msg-erro').html('');
            validaN4 = true;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
        }else{
            $('#n4-msg-erro').html('Digite um valor entre 0 e 10');
            validaN4 = false;
            valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
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

function valida_boletim(aluno, disciplina, nota1, nota2, nota3, nota4){
    if(aluno == true && disciplina == true && nota1 == true && nota2 == true && nota3 == true && nota4 == true){
        $('#inserir').attr('disabled', false);
    }else{
        $('#inserir').attr('disabled', true);
    }
}
