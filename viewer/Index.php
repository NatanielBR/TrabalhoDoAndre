<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="./css/main.css">
        <title> Mundanos - Agência de Viagens </title>

    </head>

    <body>

        <h1>
            Mundanos - Agência de Viagens
        </h1>

        <h3> Conheça o mundo através da nossa agência </h3>

    </body>

    <body>

        <header class="home-page">


            <main>
                <div class="header-1">
                    <div class="logo">
                        <img src="./img/logo.jpg">

<!--                        <p><img src="./img/logo.png" width="35" height="60" align="left"></p>-->


                    </div>
                    <div class="social-media">
                        <ul>
                            <li><a href=""><img src="./img/instagram.png " style="width: 25px; height: 25px;"> </a></li>


                            <li><a href=""><img src="./img/twitter.png " style="width: 25px; height: 25px;"> </a></li>


                            <li><a href=""><img src="./img/facebook.png " style="width: 25px; height: 25px;"></a></li>


                            <li><a href=""><img src="./img/whatsapp.png " style="width: 25px; height: 25px;"></a>
                            </li>


                        </ul>
                    </div>
                </div>


            </main>
        </header>

        <table style="width:100%; text-align: center">
            <tr>
               <th>Pais</th>
               <th>Estado</th>
               <th>Cidade</th>
               <th>Descrição</th>
            </tr>
            <?php
            foreach ($dados as $item){
                echo "<tr>\n";
                echo "<td>".$item['Pais']."</td>\n";
                echo "<td>".$item['Estado']."</td>\n";
                echo "<td>".$item['Cidade']."</td>\n";
                echo "<td>".$item['Descricao']."</td>\n";
                echo "</tr>\n";
            }
            ?>
        </table>

    </body>

</html>


<!--CSS-->

<!--body {-->
<!--width: 50%;-->
<!--height: 50%;-->
<!--}-->

<!--.home-page{-->
<!--width: 100%;-->
<!--background-color : ADD8E6;-->
<!--height: 170px;-->
<!--margin: 0 auto-->

<!--}-->

<!--main {-->
<!--margin : 0 auto;-->
<!--width: 80px;-->
<!--float: left;-->
<!--position:  relative;-->

<!--}-->

<!--.logo {-->
<!--float: right;-->
<!--padding: 5px;-->
<!--width: 10%;-->
<!--}-->
<!--.social-medias ul li {-->
<!--margin-left: 14px;-->
<!--display: inline-block;-->
<!--float: left;-->
<!--list-style: none;-->
<!--}-->

<!--.social-medias {-->
<!--width: 20%-->

<!--}-->
