
<?php
require_once './admin/refer.php';
$refer = new refer;



echo $_POST['novo'];


$mysql = mysql_connect('localhost', $refer->dbuser, $refer->dbpass);
if (!$mysql) {
    die('Não foi possível conectar: ' . mysql_error());
}

//leitura de uma tabela na base de dados
$db = mysql_select_db(mercadoa_mercado, $mysql);
if (!$db) {
    die('Não é possível utilizar a Bade de Dados «loja»: ' . mysql_error());
}

// Número de artigos a apresentar por página
$rowsPerPage = 20;

// Número total de artigos existentes na base de dados
$query = 'SELECT * FROM trator';
$result = mysql_query($query);
$totalRows = mysql_result($result);
mysql_free_result($result);

// Total de páginas
$totalPages = ceil($totalRows / $rowsPerPage);

// Anterior à última página
$lpm1 = $totalPages - 1;

// Paginação : Número de páginas em cada lado
$adjacents = 3;

// Página actual
$currentPage = (isset($_GET['page']) && (int) $_GET['page'] > 0) ? (int) $_GET['page'] : 1;

// Calcula offset
$offset = $currentPage * $rowsPerPage;

// Artigos para incluir na página
$novo = $_POST['novo'];
$modelo = $_POST['modelo'];
echo $novo;
echo $modelo;
$query = 'SELECT * FROM trator where novo =' . $novo;
$result = mysql_query($query);
$totalRows = mysql_result($result);
?>


<!-- Mostra produtos -->
<table width="100%" border="0">
    <?php while (($row = mysql_fetch_assoc($result))) : ?>
        <tr>
            <td><img src="artigos/<?= $row['img']; ?>" border="0" width="189" height="14"></td>
            <td><?= $row['marca']; ?></td>
            <td><?= $row['modelo']; ?></td>
            <td><?= $row['novo']; ?></td>
            <td><?= $row['cor']; ?></td>
            <td><?= $row['combustivel']; ?></td>
            <td><?= $row['ano']; ?></td>
            <td><?= number_format($row['preco'], 2, ',', '.'); ?></td>
            <td><?= $row['estoque']; ?></td>
        </tr>
    <?php endwhile; ?>

    <!-- Paginação -->
    <?php
    if ($totalPages > 1) {
        echo '<div class="pagination">';

        // previous button
        if ($currentPage > 1) {
            echo '<a href="?page=', ($currentPage - 1), '">« anterior</a>';
        }

        // not enough pages to bother breaking it up
        if ($totalPages < 7 + ($adjacents * 2)) {
            for ($counter = 1; $counter <= $totalPages; $counter++) {
                echo ($counter == $currentPage) ?
                        '<span class="current">' . $counter . '</span>' :
                        '<a href="?page=' . $counter . '">' . $counter . '</a>';
            }

            // enough pages to hide some
        } elseif ($totalPages > 5 + ($adjacents * 2)) {
            if ($currentPage < 1 + ($adjacents * 2)) {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    echo ($counter == $currentPage) ?
                            '<span class="current">' . $counter . '</span>' :
                            '<a href="?page=' . $counter . '">' . $counter . '</a>';
                }
            }
            echo '...', '<a href="?page=', $lpm1, '">', $lpm1, '</a>',
            '<a href="?page=', $totalPages, '">', $totalPages, '</a>';

            // in middle; hide some front and some back
        } elseif ($totalPages - ($adjacents * 2) > $currentPage && $currentPage > ($adjacents * 2)) {
            echo '<a href="?page=1">1</a> <a href="?page=2">2</a> ... ';
            for ($counter = $currentPage - $adjacents; $counter <= $currentPage + $adjacents; $counter++) {
                echo ($counter == $currentPage) ?
                        '<span class="current">' . $counter . '</span>' :
                        '<a href="?page=' . $counter . '">' . $counter . '</a>';
            }
            echo '...', '<a href="?page=', $lpm1, '">', $lpm1, '</a>',
            '<a href="?page=', $totalPages, '">', $totalPages, '</a>';

            // close to end; only hide early pages
        } else {
            echo '<a href="?page=1">1</a> <a href="?page=2">2</a> ... ';
            for ($counter = $totalPages - (2 + ($adjacents * 2)); $counter <= $totalPages; $counter++) {
                echo ($counter == $currentPage) ?
                        '<span class="current">' . $counter . '</span>' :
                        '<a href="?page=' . $counter . '">' . $counter . '</a>';
            }
        }

        // next button
        if ($currentPage < $totalPages) {
            echo '<a href="?page=', ($currentPage + 1), '>seguinte »</a>';
        }
        echo '</div>';
    }
    ?>
