<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Mercado Agrícola</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- meta http-equiv="X-UA-Compatible" content="IE=edge" / -->
        <!-- css -->
        <link rel="stylesheet" href="./css/bootstrap.css" media="screen">
        <link rel="stylesheet" href="./css/teste.css" media="screen">
        <link rel="stylesheet" href="./css/font-awesome.css" media="screen">
        <link rel="stylesheet" href="./css/estilo.css" media="screen">
        <link rel="stylesheet" media="(min-width: 800px)" href="./css/desktop.css" />
        <link rel="stylesheet" media="(max-width: 799px)" href="./css/mobile.css" />
        <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    </head>

    <body>
        <div class="fundotopo .hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="images/logo.png" alt="" class="img-responsive" id="logotopo">

                    </div>
                    <div class="col-md-3" id="busca"> 
                        <input type="search" />
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="col-md-5">
                        <div class="pull-right" id="redesociais">
                            <i class="fa fa-facebook-official fa-3x"></i>
                            <i class="fa fa-twitter-square fa-3x"></i>
                            <i class="fa fa-linkedin-square fa-3x"></i>
                            <i class="fa fa-youtube-square fa-3x"></i>
                            <i class="fa fa-envelope fa-3x"></i>
                        </div>

                        <div class="tel pull-right">31 3534-9885</div>


                    </div>
                </div>

            </div>
        </div>



        <!-- menu -->
        <div class="navbar navbar-inverse ">
            <!-- navbar-fixed-top -->
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="http://mercadoagricolas.com.br/index.php">Principal</a>
                        </li>
                        <li>
                            <a href="#">A empresa</a>
                        </li>
                        <li>
                            <a href="#">Produtos</a>
                        </li>
                        <li>
                            <a href="#">Irrigação</a>
                        </li>
                        <li>
                            <a href="#">Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- fim menu -->        


        <!-- Filtros Trator -->

        <div class="container" style="margin-top:15px">


            <div class="col-md-1">



            </div>
            <div class="col-md-1">



            </div>
            <div class="col-md-1">



            </div>

            <div class="col-md-1">

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

// Artigos para incluir na página
                $query = 'SELECT distinct modelo FROM trator ';
                echo $_POST['variavel'];
                $result = mysql_query($query);
                $totalRows = mysql_result($result);
                ?>

                <select id="tipo" >
                    <?php
                    while (($row = mysql_fetch_assoc($result))) :
                        ?> 

                        <option value=<?= $row['modelo']; ?>> <?= $row['modelo']; ?></option>

                        <?php
                    endwhile;
                    ?>
                </select>

            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1">
                <select id="s_novo">                    
                    <option value="1">NOVO</option>
                    <option value="0">USADO</option>                    
                </select>
            </div>
            <div class="col-md-1">             
            </div>
            <div class="col-md-1">                
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-1">




            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-1">
            </div>
        </div>



        <!-- Fim Filtros Trator -->


        <!-- Container-->

        <div class="container" style="margin-top:15px">

            <!-- Container Novos -->

            <div id="resp" style="display: none"> <?php // class="borda-sombra well oculto">   ?>
                carregando........
            </div>

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

// Número de artigos a apresentar por página
                $rowsPerPage = 20;

// Número total de artigos existentes na base de dados
                $query = 'SELECT * FROM trator where novo = 1';
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
                $query = 'SELECT * FROM trator where novo = 1';
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



            <!-- Container Usados -->


            <div class="fundo_tabela_produto" id="div_usado" style="display: none;">


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

// Número de artigos a apresentar por página
                $rowsPerPage = 20;

// Número total de artigos existentes na base de dados
                $query = 'SELECT * FROM trator where novo = 0';
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
                $query = 'SELECT * FROM trator where novo = 0';
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
            <!-- Fim Container Usados -->






            <div class="row sobre" id="sobre">
                <div class="col-md-3">
                    <h4>MISSÃO</h4>
                    Satisfazer as necessidades e expectativas dos clientes,
                    oferecendo produtos e serviços com qualidade e excelência,
                    contribuindo para transformar
                    seus sonhos em realidade.
                </div>
                <div class="col-md-3">
                    <h4>MISSÃO</h4>          
                    Satisfazer as necessidades e expectativas dos clientes,
                    oferecendo produtos e serviços com qualidade e excelência,
                    contribuindo para transformar
                    seus sonhos em realidade.
                </div>
                <div class="col-md-3">
                    <h4>VISÃO</h4> 
                    Ser reconhecida como a melhor empresa de vendas de
                    equipamentos, peças, serviços e implementos agrícolas no
                    município e toda Região Metropolitana e Belo Horizonte.
                </div>
                <div class="col-md-3">
                    <h4>VALORES</h4>
                    Fé em DEUS, porque ele sustenta nosso cainhar;
                    Respeito com nossos colaboradores, nossos clientes, nossos
                    Fornecedores e Concorrentes;
                    Comprometimento com a qualidade a entrega com a excelência
                    de nossos serviços;
                    Compromisso com a verdade, transparência, ética e as
                    pessoas;
                    Valorização de nossos Colaboradores sempre.
                </div>


            </div> 
        </div>

        <!-- fim container -->
    </body>

</html>
<!-- js -->
<script src="js/jq.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/inicio.js"></script>
<script src="js/filipe.js"></script>