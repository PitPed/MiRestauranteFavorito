<?php
if (!isset($fromController)) {
    header("Location: ../");
    die();
}

$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : (isset($_COOKIE['page']) ? $_COOKIE['page'] : 1);
setcookie('page', $page);

const DEAFAULT_PPP = 5;

if (isset($_REQUEST['ppp'])) {
    $platosPerPage = $_REQUEST['ppp'];
    setcookie('ppp', $platosPerPage);
    $page = 1;
    setcookie('page', 1);
} else if (isset($_COOKIE['ppp'])) {
    $platosPerPage = $_COOKIE['ppp'];
} else {
    $platosPerPage = DEAFAULT_PPP;
}
setcookie('ppp', $platosPerPage);

$platosArray = $connection->query('SELECT * FROM platos LIMIT ' . ($page - 1) * $platosPerPage . ', ' . $platosPerPage)->fetchAll(PDO::FETCH_ASSOC);

$platos = array();
foreach ($platosArray as $plato) {
    $platos[$plato['name']] = new Plato($plato['name'], $plato['price'], $plato['category']);
}

$totalPlatos = $connection->query('SELECT COUNT(*) as "totalPlatos" FROM platos')->fetch(PDO::FETCH_ASSOC)['totalPlatos'];

if (isset($_POST['add'])) {
    if (!isset($_SESSION['cart'][$_POST['name']])) {
        $_SESSION['cart'][$_POST['name']] = array('plato' => $platos[$_POST['name']], 'quantity' => 0);
    }
    $_SESSION['cart'][$_POST['name']]['quantity']++;
} else if (isset($_POST['substract']) && isset($_SESSION['cart'][$_POST['name']]) && $_SESSION['cart'][$_POST['name']]['quantity'] > 0) {
    $_SESSION['cart'][$_POST['name']]['quantity']--;
} else if (isset($_POST['del'])) {
    unset($_SESSION['cart'][$_POST['name']]);
}

?>

<head>
    <link rel="stylesheet" href="Styles/style.css">
</head>

<body>
    <div id='mas-vendidos'>
        <h1>Más vendido</h1>
        <ul>
            <?php
            $_COOKIE['mas-vendidos'] = isset($_COOKIE['mas-vendidos']) ? $_COOKIE['mas-vendidos'] : json_encode(array());
            $masVendidos = array_slice(json_decode($_COOKIE['mas-vendidos'], true), 0, 3);
            foreach ($masVendidos as $plato => $numero) {
                echo '<li>' . $plato . ' Vendidos: ' . $numero . '</li>';
            }
            ?>
        </ul>
    </div>
    <main>
        <h1>Menú</h1>
        <div id='platos'>
            <?php
            foreach ($platos as $plato) {
                $plato->draw(true);
            }
            ?>
        </div>
        <div id='paginado'>
            <form method="post">
                <label for="ppp">Platos por página</label>
                <input type="number" name='ppp' min='0' value="<?php echo $platosPerPage ?>">
                <input type="submit" value="Envíar">
            </form>
            <form method="post">
                <?php for ($pag = 1; $pag <= (($totalPlatos + 1) / $platosPerPage); $pag++): ?>
                    <input type="submit" name='page' value="<?php echo $pag ?>">
                <?php endfor; ?>
            </form>
        </div>
    </main>
    <div id='carrito'>
        <h1>Carrito</h1>
        <?php
        $_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        foreach ($_SESSION['cart'] as $plato) {
            $plato['plato']->draw(true);
        }
        ?>
        <form method="post">
            <input type="submit" value="Terminar pedido" name='end'>
        </form>
    </div>
    <div>
        <form method="POST" class="cerrarSesion">
            <input type="submit" name="CerrarSesion" value="Cerrar Sesion">
        </form>
    </div>
</body>