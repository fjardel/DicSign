
<p>Você só verá isso se estiver autenticado.</p><br />
<?php

$html->link('CLIQUE AQUI PARA SAIR' , array('controller' => 'users' , 'action' => 'logout')); 

echo "<pre>";
print_r($users);
echo "</pre>";