
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
                url: "json/disciplinas.php?operacao=2&aluno="+aluno.val(),
                success: valida_disciplinas
            });

        }else{
            disciplina.attr('disabled', true);
        

        }
    });

    
    inserir.click(function(){
        inserir_boletim(aluno.val(), disciplina.val(), nota1.val(), nota2.val(), nota3.val(), nota4.val());
    });

    
});

function valida_disciplinas(data){
    var html = "<option value='0'>--Disciplinas--</option>";
    $.each(data, function(i, disciplinas){

        html += "<option value='"+disciplinas.codigo+"'>"+disciplinas.disciplina+"</option>";
        
    });

    $('#disciplina').html(html);


}



function valida_nota(nota){
    var retorno;
    nota = parseFloat(nota);

    if(nota >= 0 && nota <= 10){
        retorno = true;
    }else{
        retorno = false;
    }
    return retorno;    
}

function inserir_boletim(aluno, disciplina, nota1, nota2, nota3, nota4){
    var html = "Erro!";
    var valida_aluno, valida_disciplina, nota1_valida, nota2_valida, nota3_valida, nota4_valida;
    
    if(aluno != "0"){
        valida_aluno = true;
    }else{
        valida_aluno = false;
        html += "\nEscolha um aluno!";
    }
    
    if(disciplina != "0"){
        valida_disciplina = true;
    }else{
        valida_disciplina = false;
        html += "\nEscolha uma disciplina!";
    }
    
    nota1_valida = valida_nota(nota1);
    
    if(!nota1_valida){
        html += "\nNota 1 precisa ser um valor de 0 a 10!";
    }
    
    nota2_valida = valida_nota(nota2);
    
    if(!nota2_valida){
        html += "\nNota 2 precisa ser um valor de 0 a 10!";
    }
    
    nota3_valida = valida_nota(nota3);
    
    if(!nota3_valida){
        html += "\nNota 3 precisa ser um valor de 0 a 10!";
    }
    
    nota4_valida = valida_nota(nota4);
    
    if(!nota4_valida){
        html += "\nNota 4 precisa ser um valor de 0 a 10!";
    }
    
    if(valida_aluno && valida_disciplina && nota1 != "" && nota2 != "" && nota3 != "" && nota4 != ""){
    
        if(valida_aluno && valida_disciplina && nota1_valida && nota2_valida && nota3_valida && nota4_valida){
            
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/boletins.php?operacao=1&aluno="+aluno+"&disciplina="+disciplina+"&nota1="+nota1+"&nota2="+nota2+"&nota3="+nota3+"&nota4="+nota4,
                success: valida_insercao
            });
            
        }else{
            alert(html);
        }
    }else{
        alert("Preencha todos os campos!");
    }
}

function valida_insercao(data){
    var msg;
    
    $.each(data, function(i, boletins){
        msg = boletins.msg;
    });
    alert(msg);
    $(location).attr('href', 'http://localhost/curso/boletins.php');
}
