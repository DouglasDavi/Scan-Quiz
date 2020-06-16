<?php
include_once("topo.php");
require_once("funcoes.php");
$classificacao = classificacaoGeral($_SESSION['user_ID']);
$total_perguntas_evento = total_perguntas_evento($_SESSION['user_ID']);
?>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="css/responsive.dataTables.min.css"/>
<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">
            Classificação dos participantes 
            <br> 
            Total de perguntas criadas <span class="badge badge-secondary"><?=$total_perguntas_evento?></span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabela" class="table table-striped table-hover dt-responsive display nowrap">
                    <thead>
                        <tr>
                            <th class="width:10%">Classificação</th>
                            <th>Nome</th>
                            <th>Pontuação</th>
                            <th>Respondidas</th>
                            <th>Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($classificacao as $key => $value) {?>
                                <tr>
                                    <td><?=$key+1?></td>
                                    <td><?=$value['nome']?></td>
                                    <td><?=$value['total']?></td>
                                    <td><?=total_perguntas_respondidas($_SESSION['user_ID'], $value['id'])."/".$total_perguntas_evento?></td>
                                    <td><div class="btn btn-primary" onclick="abrir_detalhes(<?= $value['id']?>, <?=$_SESSION['user_ID']?>)"><i class="fas fa-info-circle"></i></div></td>
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
<div id="myModal"></div>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script>
var j = jQuery.noConflict();
j('#tabela').DataTable({
    
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
})
</script>
<?php
require_once('rodape.php');
?>