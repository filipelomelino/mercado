<!DOCTYPE html>
<html lang="pt-br">
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
    $query = 'SELECT * FROM trator where estoque = 1';
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
    $query = 'SELECT * FROM trator where estoque = 1;';
    $result = mysql_query($query);
    $totalRows = mysql_result($result);
    ?>

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
                            <a href="http://mercadoagricolas.com.br/produto.php">Produtos</a>
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








        <!-- container -->
        <div class="container margem-topo">
            <!-- tempo -->
            <!-- carrossel -->
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="./images/carrossel/pag1.png" alt="Chania">
                    </div>

                    <div class="item">
                        <img src="./images/carrossel/pag2.png" alt="Chania">
                    </div>

                    <div class="item">
                        <img src="./images/carrossel/pag3.png" alt="Flower">
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- fim carrossel -->

            <div class="row ">
                <div class="col-md-10 col-md-offset-2">
                    <iframe src="http://www.agron.com.br/widgets/cotacao_interna_horizontalv2.php" width="650px;" height="100px;" scrolling="no" frameborder="0" style="border-color:#F7F7F7; border:dotted 1px; border-color:#CCC"></iframe>
                    <iframe scrolling="no" frameborder="0" marginwidth="0" marginheight="0" width="120" height="100" src="http://selos.climatempo.com.br/selos/MostraSelo120.php?CODCIDADE=4053,186,3984,3970&SKIN=verde"></iframe>

                </div>
            </div>

            <!-- imagens em circulo -->
            <div class="row  margem-topo">
                <div class="col-md-3">
                    <a href="http://mercadoagricolas.com.br/produto.php">
                        <img src="images/bola_maquinas.png" alt="" class="img-circle img-responsive sombra">
                        <div class="texto_bola">Máquinas</div>
                    </a>
                </div>

                <div class="col-md-3">
                    <img src="images/bola_Implementos.png" alt="" class="img-circle img-responsive sombra">
                    <div class="texto_bola">Implementos</div>
                </div>
                <div class="col-md-3">
                    <img src="images/bola_Irrigacao.png" alt="" class="img-circle img-responsive sombra">
                    <div class="texto_bola">Irrigação</div>
                </div>
                <div class="col-md-3">
                    <img src="images/bola_Consorcio.png" alt="" class="img-circle img-responsive sombra">
                    <div class="texto_bola">Consórcio</div>
                </div>
            </div>



            <!-- Destaques -->
            <div class="row respiro"></div>
            <div class="row titulodestaque text-center">          
                DESTAQUES
            </div>
            <div class="row destaque" id="destaque">
                <!-- Inicio Bloco -->
                <?php while (($row = mysql_fetch_assoc($result))) : ?>
                    <div class="col-md-3">
                        <div id="thumbDestaque">
                            <img src="<?php echo '../admin/img/trator/', 'img', str_pad($row['codigo'], 4, '0', STR_PAD_LEFT), '0001.jpg'; ?>" alt="" width="100%" height="170">

                            <table class="table">
                                <tr class="linha_tabela_destaque">
                                    <td> <strong>Tipo</strong></td>
                                    <td> <?= $row['modelo']; ?> </td>
                                </tr>
                                <tr class="linha2_tabela_destaque">
                                    <td>Marca</td>
                                    <td><?= $row['marca']; ?></td>
                                </tr>
                                <tr class="linha_tabela_destaque">
                                    <td>Cor</td>
                                    <td><?= $row['cor']; ?></td>
                                </tr>
                                <tr class="linha2_tabela_destaque">
                                    <td>Combustível</td>
                                    <td><?= $row['combustivel']; ?></td>
                                </tr>
                                <tr class="linha_tabela_destaque">
                                    <td>Ano</td>
                                    <td><?= $row['ano']; ?></td>
                                </tr>
                                <tr class="linha3_tabela_destaque">
                                    <td>Preço</td>
                                    <td>R$<?= number_format($row['preco'], 2, ',', '.'); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php endwhile; ?>                
            </div>
            <!-- fim Destaques -->
        </div>
        <!-- fim container -->

        <!-- Container Usados -->

        <div class="container" style="margin-top:15px">
            <div class="row">

                <div class="row" id="msn">
                    <h3> “Atendimento de primeira e resolveram todas as minhas necessidades de máquinas e implementos de forma rápida, com uma negociação que não encontrei em outro lugar.”
                        <br><br>
                        Adilson Lemos - Cliente Mercado Agrícola.</h3>
                </div>  
            </div>
            <!-- Inicio Parceiros -->
            <div class="row tituloparceiros text-center">
                Parceiros
            </div>        


            <div class="row parceiros">
                <div class="col-md-2" >
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_tramontini.jpg">
                    </div>
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_bbconsorcio.png">
                    </div>                    
                </div>
                <div class="col-md-2" >
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_AGRIMAK.jpg">
                    </div>
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_montana.jpg">
                    </div>
                </div>
                <div class="col-md-2">
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_nogueira.png">
                    </div>
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_jumil.jpg">
                    </div>                   
                </div>
                <div class="col-md-2">
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_incomagri.png">
                    </div>
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_jan.png">
                    </div>                   
                </div>
                <div class="col-md-2">
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_baldan.png">
                    </div>
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_AGRIMAK.jpg">
                    </div>                   
                </div>
                <div class="col-md-2">
                    <div id="parceiros2">
                        <img id="imgparceirosaltura" src="images/logo_vencetudo.gif">                        
                    </div>
                    <div id="parceiros2">
                        <img id="imgparceiroslargura" src="images/logo_tatu.jpg">
                    </div>                   
                </div>
            </div>
            <!-- Fim Parceiros -->
            <div class="row respiro"></div>


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
