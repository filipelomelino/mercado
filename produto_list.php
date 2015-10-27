          <!-- Container Novos -->

            <div class="fundo_tabela_produto" id="div_novo" style="display: none;">

                <?php
                require_once './admin/refer.php';
                $refer = new refer;

                $mysql = mysql_connect('localhost', $refer->dbuser, $refer->dbpass);
                if (!$mysql) {
                    die('Não foi possível conectar: ' . mysql_error());
                }

//leitura de uma tabela na base de dados
                $db = mysql_select_db(mercadoa_mercado, $mysql);
                if (!$db) {
                    die('Não é possível utilizar a Bade de Dados «loja»: ' . mysql_error());
                }

                   echo $_POST['novo'];

// Artigos para incluir na página
                $query = 'SELECT * FROM trator where novo = '. $_POST['novo']. ' and modelo = ' . $_POST['tipo'];
                $result = mysql_query($query);
                $totalRows = mysql_result($result);
                
                ?>


                <!-- Mostra produtos -->

                <table class="table-action table-striped" width="100%" border="0">
                    <thead>
                        <tr>
                            <td></td>
                            <td>MARCA</td>
                            <td>TIPO</td>
                            <td>CONDIÇÃO</td>
                            <td>COR</td>
                            <td>COMBUSTÍVEL</td>
                            <td>ANO</td>
                            <td>PREÇO</td>
                            <td>DESTAQUE</td>
                        </tr>
                    </thead>
                    <?php while (($row = mysql_fetch_assoc($result))) : ?>
                        <tr>
                            <td><div id="thumbDestaque"><img src="<?php echo '../admin/img/trator/', 'img', str_pad($row['codigo'], 4, '0', STR_PAD_LEFT), '0001.jpg'; ?>" border="0" width="110" height="70"></div></td>
                            <td><?= $row['marca']; ?></td>
                            <td><?= $row['modelo']; ?></td>
                            <td><?php
                                if ($row['novo'] == 1) {
                                    echo "NOVO";
                                } elseif ($row['novo'] == 0) {
                                    echo "USADO";
                                }
                                ?></td>
                            <td><?= $row['cor']; ?></td>
                            <td><?= $row['combustivel']; ?></td>
                            <td><?= $row['ano']; ?></td>
                            <td><?= number_format($row['preco'], 2, ',', '.'); ?></td>
                            <td><?php
                                if ($row['estoque'] == 1) {
                                    echo "SIM";
                                } elseif ($row['estoque'] == 0) {
                                    echo "NÃO";
                                }
                                ?></td>
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
                </table>
            </div>

            <!-- Fim Container Novos -->