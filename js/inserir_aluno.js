
$(document).ready(function(){
    var nome = $('#nome');

    var inserir = $('#inserir');
/*
    nome.bind('focusout', function(){

        $.ajax({
            type: "GET",
            dataType: "JSON",
            url: "json/alunos.php?operacao=1&nome="+nome.val(),
            success: valida_aluno
        });
    });*/
    
    inserir.click(function(){
        if(nome.val() != ""){
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "json/alunos.php?operacao=3&nome="+nome.val(),
                success: inserir_aluno
            });
        }else{
            alert("Preencha o nome!");
        }
    });
        
});

/*
function valida_aluno(data){
    var linhas;
    $.each(data, function(i, alunos){

        linhas = parseInt(alunos.linhas);

        if(linhas > 0){
        
            alert('Este aluno já está registrado ');
            
        }
            
        
    });

}
*/
function inserir_aluno(data){
    var linhas;
    $.each(data, function(i, alunos){

        retorno = parseInt(alunos.msg);
        
    });

        if(retorno == 0){
        
            alert('Este aluno já está registrado, tente outro nome!');
            
        }else{
            alert("Aluno inserido com sucesso!");
            $(location).attr('href', 'http://localhost/curso/index.php');
        }

}

