<?php
include_once("topo.php");
require_once("funcoes.php");

$_SESSION['perfil_acesso'] = perfil_acesso($_SESSION['user_ID']);
$verificaPerguntasUsuario = verificaPerguntasUsuario($_SESSION['user_ID']);
if(!empty($verificaPerguntasUsuario)){
    $dnone = "";
}else{
    $dnone = "dnone";
}

?>    
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="css/responsive.dataTables.min.css"/>
<input type="hidden" id="get" value="<?=$_GET['admin']?>">
<div class="tab-content" id="pills-tabContent">
    
    <div class="tab-pane fade" id="pills-perguntas" role="tabpanel" aria-labelledby="pills-perguntas-tab">
      <div class="container mb71">
            <div id="quadro">
                <script type="text/javascript" src="instascan.min.js"></script>                
                <video id="preview" class="cameraMob"></video>                
                <script>
                    let scanner = new  Instascan.Scanner(
                        {
                            video: document.getElementById("preview")
                        }
                    )
                    scanner.addListener('scan', function(content){
                        window.location.href=content
                        //window.open(content, "_blank")
                    })
                    Instascan.Camera.getCameras().then(cameras => {
                        if(cameras.length > 0){
                            scanner.start(cameras[1])
                        }else{
                            console.log("Não existe camera")
                        }
                    })                    
                </script>
            </div>            
        </div>
    </div>
    <div class="tab-pane fade show active mb71" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card-group">
            <div class="card mb-3 sombra-img">
                <a href="minhaClassificacao.php" class="text-dark stretched-link">
                    <div class="color">
                    <svg class="bi bi-person-fill img-center" width="50%" height="50%" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                    </svg>
                    </div>        
                    <div class="card-body text-center">
                        <h5 class="card-title">Minhas Classificações</h5>                
                    </div>
                </a>
            </div>
            <div class="card mb-3 sombra-img <?=$dnone?>">
                <a href="minhasPerguntas.php" class="text-dark stretched-link">
                    <div class="color">                       
                        <svg class="bi bi-clipboard-data img-center mt10" width="50%" height="50%" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 00-2 2V14a2 2 0 002 2h10a2 2 0 002-2V3.5a2 2 0 00-2-2h-1v1h1a1 1 0 011 1V14a1 1 0 01-1 1H3a1 1 0 01-1-1V3.5a1 1 0 011-1h1v-1z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 00-.5.5v1a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-1a.5.5 0 00-.5-.5zm-3-1A1.5 1.5 0 005 1.5v1A1.5 1.5 0 006.5 4h3A1.5 1.5 0 0011 2.5v-1A1.5 1.5 0 009.5 0h-3z" clip-rule="evenodd"/>
                            <path d="M4 11a1 1 0 112 0v1a1 1 0 11-2 0v-1zm6-4a1 1 0 112 0v5a1 1 0 11-2 0V7zM7 9a1 1 0 012 0v3a1 1 0 11-2 0V9z"/>
                        </svg>
                    </div>        
                    <div class="card-body text-center">
                        <h5 class="card-title">Minhas Perguntas</h5>                
                    </div>
                </a>    
            </div>
        </div>       
    </div>
    <div class="tab-pane fade" id="pills-perfil" role="tabpanel" aria-labelledby="pills-perfil-tab">
        <div class="container mb71">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="data.php" method="POST">
                        <label for="nome_usuario">Nome:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="nome_usuario" id="nome_usuario" class="form-control drop" placeholder="digite seu nome de usuário" value="<?=$_SESSION['nome']?>" disabled>
                        </div>
                        <label for="email_usuario">Email:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="text" name="email_usuario" id="email_usuario" class="form-control drop" placeholder="Digite seu email" value="<?=$_SESSION['email']?>" disabled>
                        </div>
                        
                        <?php
                            if($_SESSION['perfil_acesso'] != "admin"){
                        ?>
                            <button class="btn btn-outline-warning btn-lg btn-block" name="tornar_admin" value="Tornar Desenvolvedor"><i class='fas fa-crown'></i> Tornar Administrador</button>    
                        <?php
                            }
                        ?>
                        <button class="btn btn-outline-success btn-lg btn-block" name="deslogar" value="deslogar"><i class='fas fa-caret-square-left'></i> SAIR</button>
                    </form>

                </div>
            </div>
            
        </div>    
    </div>
    <div class="tab-pane fade" id="pills-admin" role="tabpanel" aria-labelledby="pills-admin-tab">
        <div class="container">
            <div id="toast"></div>
            <button class="btn btn-primary mtb20" onclick="window.location.href='perguntas.php'">Criar Pergunta <i class="far fa-question-circle"></i></button>
            <?php
            if(isset($_SESSION['msg'])){?>
                <div class="container col-xs-12 col-md-6 text-center">
                    <div class="alert <?=$_SESSION['alertNivel']?> alert-dismissible fade show" role="alert">
                        <strong><?=$_SESSION['msg']?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php } 
                unset($_SESSION['msg']);
                unset($_SESSION['alertNivel']);
            ?>
            <div class="card mb71">
                <h5 class="card-header">Tabela de perguntas criadas</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0" style="width:100%">            
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pergunta</th>
                                    <th class="text-center none">Ações</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tabelaPergunta = tabelaPergunta($_SESSION['user_ID']);
                            if(!empty($tabelaPergunta)){
                                foreach ($tabelaPergunta as $key => $value) {?>
                                    <tr id="linha_<?=$value['id']?>">
                                        <td><?=$value["id"]?></td>
                                        <td width="80%"><?=strlen($value["pergunta_titulo"]) > 30 ? substr($value["pergunta_titulo"],0, 26)."..." : $value["pergunta_titulo"] ?></td>
                                        <td class="text-center">
                                            <a href="perguntas.php?&id=<?=$value['id']?>" class="btn btn-info" title="Editar"><i class="fas fa-edit"></i></a>
                                            <a onclick="deletarPergunta(<?=$value['id']?>, <?=$key?>)" class="btn btn-danger" title="excluir pergunta"><i class="fa fa-trash"></i></a>
                                        </td>                                    
                                    </tr>
                                <?php
                                }
                            }else{?> 
                                <tr class="text-center">
                                    <td colspan="3">
                                        Crie uma pergunta para o nosso quiz <i class="far fa-laugh-beam" style="background-color: yellow; border-radius: 50%;"></i> 
                                    </td>                              
                                </tr>                               
                            <?php
                            }                                        
                            ?>
                                            
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
<ul class="nav nav-pills col-xs-12 menu" id="pills-tab" role="tablist">
    <li class="nav-item col p0 text-center">
        <a class="nav-link active" id="pills-home-tab" onclick="abrirCamera('false')" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
            <i class="fas fa-chart-line icone"></i>            
            Ranking
        </a>
    </li>
    <li class="nav-item col p0 text-center">
        <a class="nav-link" id="pills-perguntas-tab" onclick="abrirCamera('true')" data-toggle="pill" href="#pills-perguntas" role="tab" aria-controls="pills-perguntas" aria-selected="false">
            <i class="fas fa-qrcode icone"></i>
            Perguntas
        </a>
    </li>
    <li class="nav-item col p0 text-center">
        <a class="nav-link" id="pills-perfil-tab" onclick="abrirCamera('false')" data-toggle="pill" href="#pills-perfil" role="tab" aria-controls="pills-perfil" aria-selected="false">
            <i class="fas fa-user-friends icone"></i>
            Perfil
        </a>
    </li>
    <?php
        if($_SESSION['perfil_acesso'] == "admin"){
    ?>
        <li class="nav-item col p0 text-center">
            <a class="nav-link" id="pills-admin-tab" onclick="abrirCamera('false')" data-toggle="pill" href="#pills-admin" role="tab" aria-controls="pills-admin" aria-selected="false">
                <i class="fas fa-home icone"></i>
                Admin
            </a>
        </li>
    <?php
    }
    ?>    

</ul>

 
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/pace.min.js"></script>
<script>

var j = jQuery.noConflict(); 
       
j(document).ready(function() {   
    j(".callback").hide() 
    j('#example').DataTable({
        responsive: true,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        }
    });
    if($('#get').val() == 'admin'){
        $('#pills-home').removeClass('show active')
        $('#pills-home-tab').removeClass('active')
        $('#pills-admin').addClass('show active')
        $('#pills-admin-tab').addClass('active')
        setTimeout(function(){ $('#get').val(""); }, 100);
        
    }
    if($('#get').val() == 'scan'){
        console.log($('#get').val())
        $('#pills-home').removeClass('show active')
        $('#pills-home-tab').removeClass('active')
        $('#pills-perguntas').addClass('show active')
        $('#pills-perguntas-tab').addClass('active')
        setTimeout(function(){ $('#get').val(""); }, 1000);
        
    }
} );
</script>
<?php
include_once("rodape.php");
?>