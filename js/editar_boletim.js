
$(document).ready(function(){

    var validaAluno = true;

    var validaDisciplina = true;

    var nota1 = $('#nota1');

    var validaN1 = true;

    var nota2 = $('#nota2');

    var validaN2 = true;

    var nota3 = $('#nota3');

    var validaN3 = true;

    var nota4 = $('#nota4');

    var validaN4 = true;

    var salvar = $('#salvar');

    salvar.prop('disabled', true);

    nota1.bind('focus', function(){
        validaN1 = false;
        valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
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

    nota2.bind('focus', function(){
        validaN2 = false;
        valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
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

    nota3.bind('focus', function(){
        validaN3 = false;
        valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);
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

    nota4.bind('focus', function(){
        validaN4 = false;
        valida_boletim(validaAluno, validaDisciplina, validaN1, validaN2, validaN3, validaN4);

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


function valida_boletim(aluno, disciplina, nota1, nota2, nota3, nota4){
    if(aluno == true && disciplina == true && nota1 == true && nota2 == true && nota3 == true && nota4 == true){
        $('#salvar').attr('disabled', false);
    }else{
        $('#salvar').attr('disabled', true);
    }
}