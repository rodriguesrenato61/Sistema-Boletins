$(document).ready(function(){

    var nome = $('#nome');

    var matricula = $('#matricula');

    var salvar = $('#salvar');
    
    salvar.click(function(){
        atualizar(matricula.val(), nome.val());
    });

});
    

function valida_aluno(data){
    var msg;

    $.each(data, function(i, alunos){
        msg = alunos.msg;
    });
    
    if(msg == "Aluno atualizado com sucesso!"){
        alert(msg);
        $(location).attr('href', 'http://localhost/curso/index.php');
            
    }else{
        alert(msg);
    }
    
}

function atualizar(matricula, nome){
    
    if(nome != ""){
        $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/alunos.php?operacao=4&matricula="+matricula+"&nome="+nome,
                success: valida_aluno
            });
    }else{
        alert("Preencha o nome!");
    }
}
