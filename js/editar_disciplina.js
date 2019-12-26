$(document).ready(function(){

    var nome = $('#nome');

    var codigo = $('#codigo');

    var salvar = $('#salvar');
    
    salvar.click(function(){
        atualizar_disciplina(codigo.val(), nome.val());
    });

});

function valida_disciplina(data){
    var msg;

    $.each(data, function(i, disciplinas){
        
        msg = disciplinas.msg;
        
    });
    
    alert(msg);
    
    if(msg == "Disciplina atualizada com sucesso!"){
        
        $(location).attr('href', 'http://localhost/curso/disciplinas.php');
    }
}

function atualizar_disciplina(codigo, nome){
    
    if(nome != ""){
        $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/disciplinas.php?operacao=6&codigo="+codigo+"&nome="+nome,
                success: valida_disciplina
            });
    }else{
        alert("Preencha o campo!");
    }
}
