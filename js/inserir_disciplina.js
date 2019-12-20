
$(document).ready(function(){
    var nome = $('#nome');

    var inserir = $('#inserir');
    
    inserir.click(function(){
        if(nome.val() != ""){
            
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/disciplinas.php?operacao=5&nome="+nome.val(),
                success: inserir_disciplina
            });
        }else{
            alert("Preencha o nome!");
        }
    });
    /*
    inserir.attr('disabled', true);

    nome.bind('focus', function(){
        inserir.attr('disabled', true);
        $('#msg-erro').html('');
    });

    nome.bind('focusout', function(){

        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "json/disciplinas.php?operacao=1&nome="+nome.val(),
            success: valida_disciplina
        });
    });*/
});

/*
function valida_disciplina(data){
    var linhas;
    $.each(data, function(i, disciplinas){

        linhas = parseInt(disciplinas.linhas);

        if(linhas > 0){
        
            $('#msg-erro').html('Esta disciplina já está registrada ');
            $('#inserir').attr('disabled', true);
        }else{
            $('#msg-erro').html('');
            $('#inserir').attr('disabled', false);
        }
        
    });


}
*/

function inserir_disciplina(data){
    var msg;
    $.each(data, function(i, disciplinas){

        msg = parseInt(disciplinas.msg);

        if(msg == 0){
        
            alert('Esta disciplina já está registrada, tente outro nome');
            
        }else{
            alert("Disciplina inserida com sucesso!");
            $(location).attr('href', 'http://localhost/curso/disciplinas.php');
        }
        
    });


}
