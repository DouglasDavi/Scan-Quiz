function abrirCamera(valor){
   if(valor == "true"){
       j('#quadro').show('fast')
   }else{
       j('#quadro').hide('fast')
   }
}

function deletarPergunta(id, key){
    var r = confirm("Deseja realmente apagar?");
    if(r == true){
        j.ajax({
            url: "data.php",
            data: {"excluir": "excluir", id: id},
            type: "POST",
            dataType: "html",
            success: function (retorno){
                j('#linha_'+id).fadeOut('slow', function(){ j('#linha_'+id).remove(); });
                j('ul[data-dtr-index='+key+']').fadeOut('slow')
                j('#toast').append(`
                    <div class="alert alert-success alert-dismissible fade show toast" role="alert">
                        <strong>Pergunta removida com sucesso!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>            
                `);
                setTimeout(function(){ $('.toast').remove(); }, 3000);
            }
        });
    }
}

function liberaEnvio(valor) {
    j('.btn-outline-primary').removeClass('pressopc')
    j('#btn_'+valor).addClass('pressopc')
    j('#enviar').show('slow')
    j('#minha_resposta').val(valor)
}

function formulario_resposta(id, autor){    
    var resp = j('#minha_resposta').val()
    var id_respota = j('#id_resposta').val()
    var respondido = j('#respondido').val()
    if(respondido != 0){
        if(confirm("Essa pergunta já foi respondida, voltar a tela inicial?")){
            window.location="view.php";
        }
    }else{
        j.ajax({
            url: "ajax/ajax_quiz.php",
            data: {"form_quiz": "form_quiz", resp: resp, id: id, autor: autor},
            type: "POST",
            dataType: "html",
            success: function (retorno){
                j('#div').html(retorno)
                j("#btn_"+resp).removeClass('btn-outline-primary')
                j("#enviar").remove()
                if(id_respota == resp){
                    j("#btn_"+resp).addClass('acerto')
                }else{
                    j("#btn_"+resp).addClass('erro')
                    j("#btn_"+id_respota).addClass('acerto')
                    //setTimeout(function(){ window.location.href = "view.php?admin=scan" }, 3000);
                }

                j('#cam').show('slow')
            }
        });
    }    
}

function abrirCam(){    
    j.ajax({
        url: "camera.html",
        data: "",
        type: "POST",
        dataType: "html",
        success: function (retorno){
            j("#quiz").hide('slow')
            j("#camera").html(retorno)
        }
    });    
}

function abrir_detalhes(id, evento){
    j.ajax({
        url: 'ajax/ajax_modal.php',
        data: {"id": id, evento: evento},
        type: "POST",
        dataType: "html",
        success: function (retorno){
           j('#myModal').html(retorno)
           $('#modal').modal('show')
        }
    })
}

function verifica_email(email){
    if(email != ""){
        j.ajax({
            url: 'ajax/ajax_verifica.php',
            data: {"email": email},
            type: "POST",
            dataType: "html",
            success: function (retorno){
                j('#alert').html(retorno)          
            }
        })
    }
}