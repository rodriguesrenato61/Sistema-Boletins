
$(document).ready(function(){
    
    var id = $('#id');

    var nota1 = $('#nota1');

    var nota2 = $('#nota2');

    var nota3 = $('#nota3');

    var nota4 = $('#nota4');

    var salvar = $('#salvar');
    
    salvar.click(function(){
        salvar_boletim(id.val(), nota1.val(), nota2.val(), nota3.val(), nota4.val());
    });

    
});

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

function salvar_boletim(id, nota1, nota2, nota3, nota4){
    var html = "Erro!";
    var nota1_valida, nota2_valida, nota3_valida, nota4_valida;
    
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
    
    if(nota1 != "" && nota2 != "" && nota3 != "" && nota4 != ""){
    
        if(nota1_valida && nota2_valida && nota3_valida && nota4_valida){
            
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/boletins.php?operacao=2&id="+id+"&nota1="+nota1+"&nota2="+nota2+"&nota3="+nota3+"&nota4="+nota4,
                success: valida_atualizacao
            });
            
        }else{
            alert(html);
        }
    }else{
        alert("Preencha todos os campos!");
    }
}

function valida_atualizacao(data){
    var msg;
    
    $.each(data, function(i, boletins){
        msg = boletins.msg;
    });
    alert(msg);
    $(location).attr('href', 'http://localhost/curso/boletins.php');
}
