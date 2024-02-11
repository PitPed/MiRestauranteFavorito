<?php
if (!isset($fromController)) {
    header("Location: ../");
    die();
}
$platosPedidos = isset($_COOKIE['mas-vendidos']) ? json_decode($_COOKIE['mas-vendidos'], true) : array();
foreach ($_SESSION['cart'] as $plato) {
    $platosPedidos[$plato['plato']->name] = $plato['quantity'] + (isset($platosPedidos[$plato['plato']->name]) ? $platosPedidos[$plato['plato']->name] : 0);
}
arsort($platosPedidos);
setcookie('mas-vendidos', json_encode($platosPedidos));
?>

<link rel="stylesheet" href="Styles/style.css">
<div id='ticket'>
    <h1>Pedido final</h1>
    <?php
    $precioFinal = 0;
    foreach ($_SESSION['cart'] as $plato) {
        $plato['plato']->draw(false);
        $precioFinal += $plato['plato']->price * $plato['quantity'];
    }
    $_SESSION['cart'] = array();
    setcookie('page', 1);

    ?>
    <h1>Precio final:
        <?php echo $precioFinal; ?>
    </h1>
    <a href=".">Volver al inicio</a>
</div>