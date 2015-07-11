<?php
include_once 'ViewDescriptor.php';
include_once basename(__DIR__) . '/../Settings.php';

if (!$vd->isJson()) {
    ?>
    <!DOCTYPE html>
    <!-- 
         pagina master, contiene tutto il layout della applicazione 
         le varie pagine vengono caricate a "pezzi" a seconda della zona
         del layout:
         - logo (header)
         - menu (i tab)
         - leftBar (sidebar sinistra)
         - content (la parte centrale con il contenuto)
         - rightBar (sidebar destra)
         - footer (footer)

          Queste informazioni sono manentute in una struttura dati, chiamata ViewDescriptor
          la classe contiene anche le stringhe per i messaggi di feedback per 
          l'utente (errori e conferme delle operazioni)
    -->
    <html>
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <title><?= $vd->getTitolo() ?></title>
            <base href="<?= Settings::getApplicationPath() ?>php/"/>
            <meta name="keywords" content="AMM esami docente" />
            <meta name="description" content="Una pagina per gestire le funzioni dei docenti" />
            <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
            <link href="../css/responsive.css" rel="stylesheet" type="text/css" media="screen" />
            <?php
            foreach ($vd->getScripts() as $script) {
                ?>
                <script type="text/javascript" src="<?= $script ?>"></script>
                <?php
            }
            ?>
        </head>
        <body>
            <div id="page">
                <header>
                    <div class="social">
                        <?php
                        $logo = $vd->getLogoFile();
                        require "$logo";
                        ?>
                        <ul>
                            <li id="facebook"><a href="www.facebook.com">facebook</a></li>
                            <li id="twitter"><a href="https://twitter.com/">twitter</a></li>
                            <li id="linkedin"><a href="http://www.linkedin.com/">linkedin</a></li>
                        </ul>
                    </div>
                    <!--  header -->
                    <div id="header">
                        <div id="logo">
                            <h1>EsAMMi</h1>
                        </div>

                        <!-- select per la versione del menu mobile -->
                        <select class="menu">
                            <?php
                            $mini_menu = $vd->getMenuFile();
                            require "$mini_menu";
                            ?>

                        </select>
                        <!-- tabs -->
                        <div id="menu">
                            <?php
                            $menu = $vd->getMenuFile();
                            require "$menu";
                            ?>
                        </div>
                    </div>
                </header>
                <!-- start page -->
                <!--  sidebar 1 -->
                <div id="sidebar1">
                    <ul>
                        <li id="categories">
                            <?php
                            $left = $vd->getLeftBarFile();
                            require "$left";
                            ?>
                        </li>
                        <li id="external">
                            <h2 class="icon-title">Link esterni</h2>
                            <ul>
                                <li><a href="http://www.unica.it/">Universit&agrave; di Cagliari</a></li>
                                <li><a href="http://www.unica.it/">Facolt&agrave;</a></li>

                            </ul>
                        </li>

                    </ul>
                </div>

                <div id="sidebar2">
                    <?php
                    $right = $vd->getRightBarFile();
                    require "$right";
                    ?>

                </div>

                <!-- contenuto -->
                <div id="content">
                    <?php
                    if ($vd->getMessaggioErrore() != null) {
                        ?>
                        <div class="error">
                            <div>
                                <?=
                                $vd->getMessaggioErrore();
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($vd->getMessaggioConferma() != null) {
                        ?>
                        <div class="confirm">
                            <div>
                                <?=
                                $vd->getMessaggioConferma();
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    $content = $vd->getContentFile();
                    require "$content";
                    ?>


                </div>

                <div class="clear">
                </div>
                <!--  footer -->
                <footer>
                    <div id="footer">
                        <p>
                            Applicazione d'esempio per l'esame di Amministrazione di Sistema
                        </p>


                    </div>
                    <div class="validator">
                        <p>
                            <a href="http://validator.w3.org/check/referer" class="xhtml" title="Questa pagina contiene HTML valido">
                                <abbr title="eXtensible HyperText Markup Language">HTML</abbr> Valido</a>
                            <a href="http://jigsaw.w3.org/css-validator/check/referer" class="css" title="Questa pagina ha CSS validi">
                                <abbr title="Cascading Style Sheets">CSS</abbr> Valido</a>
                        </p>
                    </div>
                </footer>
            </div>
        </body>
    </html>
    <?php
} else {

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
    
    $content = $vd->getContentFile();
    require "$content";
}
?>





