<?php
require_once("../funcoes.php");
$ID = verifica_email($_POST['email']);
if(empty($ID)){?>
<script>
    alert('email inexistente')
</script>
<?php
}
?>