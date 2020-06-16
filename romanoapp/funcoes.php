<?php
require_once("conexao.php");

function verificaUsuario($post){
    
    $sql = "SELECT count(*) as total FROM usuarios where email ='".$post['email_cadastro']."'";
	$rs = db_query($sql);
	$array = array();
	while($row = mysqli_fetch_array($rs)){
		$array['total'] = $row['total'];	
    }
       
    if($array['total'] > 0 ){
        $array = true;
    }else{         
	    $array = false;
    }     
    return $array;
}

function cadastrarUserApp($post){
    
    $sql = "INSERT INTO usuarios (
                nome, 
                email, 
                senha
            ) 
            VALUES 
            (
                '".addslashes($post['nome_cadastro'])."', 
                '".addslashes($post['email_cadastro'])."', 
                '".$post['senha_cadastro']."'
            )";
    $rs = db_query($sql) or die("Database error ao inserir");	
    
}

function efetuarLogin($post){    

    $sql = "SELECT id, nome, senha, email FROM usuarios WHERE email = '".$post['email_login']."'";
    $rs = db_query($sql) or die("Database error");
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;    	
    }
    
    if(!empty($array[0])){         
        if(password_verify($post['senha_login'], $array[0]['senha'])){        
            return $array; 
        }else{
            return NULL;
        }
    }else{
        return NULL;
    }
    
}

function perfil_acesso($id){
    $sql = "SELECT p.perfil FROM perfil_acesso p JOIN usuarios u ON u.id_acesso = p.id WHERE u.id = ".$id;
    $rs = db_query($sql) or die("Perfil não identificado");
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row['perfil'];
    }
    if(!empty($array[0])){
        return $array[0];
    }else{
        return NULL;
    }    
}

function insert_pergunta_respostas($post, $id_usuario){
    GLOBAL $mysqli;
    $sql = "INSERT INTO perguntas (pergunta_titulo, user_ID) VALUE ('".addslashes($post['pergunta'])."', $id_usuario)";
    $rs = db_query($sql) or die("Database error ao inserir");
    $id_perguntas = mysqli_insert_id($mysqli);

    for ($i=1; $i <=4 ; $i++) { 
        $sql = "INSERT INTO respostas_opc (respostas_opc, id_perguntas) VALUE ('".addslashes($post['resposta_'.$i])."', ".$id_perguntas.")";
        $rs = db_query($sql) or die("Database error ao inserir");
        if($i == $post['verdadeira']){
            $id_marcado = mysqli_insert_id($mysqli);
        }
    }        
    $sql2= "INSERT INTO resposta_verdadeira (id_resposta) VALUE ($id_marcado)";
    $rs = db_query($sql2) or die("Database error ao inserir");
    return $id_perguntas;
}

function tabelaPergunta($id_usuario){
    $sql = "SELECT id, pergunta_titulo FROM perguntas WHERE user_ID = ".$id_usuario; 
    $rs = db_query($sql) or die("Perfil não identificado");
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;
    }
    if(!empty($array[0])){
        return $array;
    }else{
        return NULL;
    }    
}

function seleciona_questao($id){
    $sql = "SELECT 
                p.id, p.pergunta_titulo, ro.respostas_opc, ro.id AS id_opc, rv.id_resposta, rv.id AS id_marcado
            FROM
                perguntas p
                    JOIN
                respostas_opc ro ON p.id = ro.id_perguntas
                    LEFT JOIN
                resposta_verdadeira rv ON ro.id = rv.id_resposta
            WHERE
                p.id = ".$id; 
    $rs = db_query($sql) or die("Erro DataBase");
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;
    }
    if(!empty($array[0])){
        return $array;
    }else{
        return NULL;
    }    
}

function update_pergunta_respostas($post, $id_usuario){
    GLOBAL $mysqli;
         
    $sql= "UPDATE perguntas SET pergunta_titulo = '".addslashes($post['pergunta'])."', user_ID = $id_usuario WHERE id = ".$post['id'];
    $rs = db_query($sql) or die("Database error ao inserir");
    $sql2 = "SELECT id FROM respostas_opc WHERE id_perguntas = ". $post['id'];
    $rs2 = db_query($sql2) or die("Erro DataBase");
    $i = 1;
    while($row = mysqli_fetch_array($rs2)){
       $sql3 = "UPDATE respostas_opc SET respostas_opc = '".addslashes($post['resposta_'.$i])."' WHERE id = ". $row['id'];
       $rs3 = db_query($sql3) or die("Erro DataBase");
       if($i == $post['verdadeira']){
            $id_resposta = $row['id']; 
       }
       $i++;
    } 
    $sql_resposta = "UPDATE resposta_verdadeira SET id_resposta = $id_resposta WHERE id = ". $post['id_marcado'];
    $rs4 = db_query($sql_resposta) or die("Erro DataBase Ao Atualizar");
    return $post['id'];
}

function excluirPerguntas($id){

    $sql = "SELECT id FROM respostas_opc WHERE id_perguntas = $id";
    $rs = db_query($sql) or die("Erro Consulta DataBase");
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row['id'];
    }

    $sql_res = "SELECT id as id_resp, id_resposta FROM resposta_verdadeira WHERE id_resposta IN (".implode(",",$array).")";
    $rs2 = db_query($sql_res) or die("Erro Consulta DataBase");
    $row2 = mysqli_fetch_array($rs2);
    
    $sql_excluir = "DELETE FROM resposta_verdadeira WHERE id = ".$row2['id_resp']; 
    db_query($sql_excluir) or db_die("Erro Ao Excluir");
    $sql_excluir2 = "DELETE FROM respostas_opc WHERE id_perguntas = ".$id; 
    db_query($sql_excluir2) or db_die("Erro Ao Excluir");
    $sql_excluir3 = "DELETE FROM perguntas WHERE id  = ". $id;
    db_query($sql_excluir3) or db_die("Erro Ao Excluir");
}

function quizPergunta($id){
    $sql = "SELECT id, pergunta_titulo, user_ID FROM perguntas WHERE id = ".$id;
    $rs = db_query($sql) or die("Erro DataBase");
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;
    }    
    if(!empty($array[0])){
        return $array[0];
    }else{
        return NULL;
    }
}

function verificaResposta($resp, $user_ID, $id, $autor){
    $id_pergunta = selecionausuarioResposta($id , $user_ID);
    if(empty($id_pergunta)){
        $sql = "INSERT INTO  usuario_resposta (usuario, id_pergunta, resposta, evento) VALUE ($user_ID, $id, $resp, $autor) ";        
    	$rs = db_query($sql) or die("Erro DataBase");
    }    
}

function selecionausuarioResposta($id , $user_ID){
    $sql = "SELECT id FROM usuario_resposta where id_pergunta = $id AND usuario = $user_ID";
    $rs = db_query($sql) or die();
    $row = mysqli_fetch_array($rs);    
    if(!empty($row['id'])){
        return  $row['id'];
    }else{
        return NULL;
    } 
   
}

function atualizarPermissao($user_ID){
    $sql = "UPDATE usuarios SET id_acesso = 1 WHERE id = ".$user_ID;
    $rs = db_query($sql) or die("Erro Ao Atualizar");
}

function classificacao($user_ID, $evento){ 
    $sql = "SELECT id_pergunta, resposta FROM usuario_resposta WHERE usuario =".$user_ID." AND evento = ".$evento;
    $rs = db_query($sql) or die("Erro de Busca");
    while($row = mysqli_fetch_array($rs)){
        $arrayPergunta[] = $row['id_pergunta'];
        $arrayResposta[] = $row['resposta'];
    }
    $sql2 ="SELECT 
                Resultado.id, Resultado.nome, SUM(Resultado.total)
            FROM
                (SELECT 
                    u.id,
                        u.nome,
                        ur.id_pergunta,
                        ur.resposta,
                        COUNT(rv.id_resposta) AS total
                FROM
                    usuario_resposta ur
                JOIN usuarios u ON u.id = ur.usuario
                LEFT JOIN resposta_verdadeira rv ON rv.id_resposta = ur.resposta
                WHERE
                    ur.id_pergunta IN (".implode(",",$arrayPergunta).")
                GROUP BY u.id) AS Resultado
            GROUP BY Resultado.id
            ORDER BY Resultado.total DESC";
    $rs2 = db_query($sql2) or die('Erro de Consulta');
    while($row2 = mysqli_fetch_array($rs2)){
        $array[] = $row2;
    }
    if(!empty($array)){
        return $array;
    }else{
        return NULL;
    }
    
}

function minhaClassificacao($user_ID){
    $sql = "SELECT u.nome, u.id FROM usuario_resposta ur JOIN usuarios u ON u.id = ur.evento WHERE usuario = $user_ID GROUP BY evento";
    $rs = db_query($sql) or db_die("Não encontrado");
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;
    }
    if(!empty($array[0])){
        return $array;
    }else{
        return NULL;
    }   
}

function classificacaoGeral($evento){
    $sql= " SELECT 
                Resultado.nome, Resultado.total, Resultado.id
            FROM
                (SELECT 
                    u.id,
                        u.nome,
                        ur.id_pergunta,
                        ur.resposta,
                        COUNT(rv.id_resposta) AS total
                FROM
                    usuario_resposta ur
                JOIN usuarios u ON u.id = ur.usuario
                JOIN resposta_verdadeira rv ON rv.id_resposta = ur.resposta
                WHERE
                    ur.evento = $evento
                GROUP BY u.id) AS Resultado
                ORDER BY Resultado.total DESC";
    $rs = db_query($sql) or die('Erro de Consulta');
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;
    }
    if(!empty($array)){
        return $array;
    }else{
        return NULL;
    }               
}

function verificaPerguntasUsuario($user_ID){
    $sql = "SELECT * FROM perguntas WHERE user_ID = ". $user_ID;
    $rs = db_query($sql) or die('Erro de Consulta');
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;
    }
    if(!empty($array)){
        return $array;
    }else{
        return NULL;
    }   
}

function detalhes_resposta($id, $evento){
    $sql = "SELECT 
                u.nome,
                p.pergunta_titulo,
                p.id AS id_pergunta,
                ro.respostas_opc,
                ro.id,    
                ur.resposta,
                rv.id_resposta
            FROM
                usuario_resposta ur
                    JOIN
                usuarios u ON ur.usuario = u.id
                    JOIN
                perguntas p ON p.id = ur.id_pergunta
                    JOIN
                respostas_opc ro ON ro.id_perguntas = p.id
                    JOIN
                resposta_verdadeira rv ON ro.id = rv.id_resposta
            WHERE
                usuario = $id AND evento = $evento";
    $rs = db_query($sql) or die('Erro de Consulta');
    while($row = mysqli_fetch_array($rs)){
        $array[] = $row;
    }
    if(!empty($array)){
        return $array;
    }else{
        return NULL;
    }               
}

function resposta_falsa($resposta){ 
    $sql = "SELECT respostas_opc FROM respostas_opc WHERE id = $resposta";
    $rs = db_query($sql) or die('Erro de Consulta');
    $row = mysqli_fetch_array($rs);    
    if(!empty($row['respostas_opc'])){
        return  $row['respostas_opc'];
    }else{
        return NULL;
    }      
}
function total_perguntas_evento($user_ID){ 
    $sql = "SELECT count(id) AS total_pergunta FROM perguntas WHERE user_id = $user_ID";
    $rs = db_query($sql) or die('Erro de Consulta');
    $row = mysqli_fetch_array($rs);    
    if(!empty($row['total_pergunta'])){
        return  $row['total_pergunta'];
    }else{
        return NULL;
    }      
}

function total_perguntas_respondidas($user_ID, $id_usuario){
    $sql = "SELECT count(id) AS total_resposta FROM usuario_resposta WHERE evento = $user_ID AND usuario = $id_usuario";
    $rs = db_query($sql) or die('Erro de Consulta');
    $row = mysqli_fetch_array($rs);    
    if(!empty($row['total_resposta'])){
        return  $row['total_resposta'];
    }else{
        return NULL;
    } 
}

function verifica_email($email){
    $sql = "SELECT id FROM usuarios where email = '".addslashes($email)."'";
    $rs = db_query($sql) or die('Erro de Consulta');
    $row = mysqli_fetch_array($rs);    
    if(!empty($row['id'])){
        return  $row['id'];
    }else{
        return NULL;
    } 
}

function atualizar_senha($id, $senha_nova){
    $sql = "UPDATE usuarios SET senha = '".addslashes($senha_nova)."' WHERE id = $id";
    $rs = db_query($sql) or die('Erro ao atualizar');
}

?>