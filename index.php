<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agroholding</title>

        <link href="scripts/fullpage.css" rel="stylesheet">
        <link href="styles/styles.css" rel="stylesheet">

        <!-- animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">

        <script type="text/javascript" src="scripts/jquery-3.6.0.min.js"></script>
        <script src="scripts/slimscroll.min.js" type="text/javascript"></script>
        <script src="scripts/fullpage.js" type="text/javascript"></script>
        <script src="scripts/wow.min.js" type="text/javascript"></script>
        <script>
            new WOW().init();
        </script>
    </head>
    <script>
        jQuery(document).ready(function($){
            $('#fullpage').fullpage({
                scrollBar: true,
            });
        })
    </script>
    <body>
        <div id="fullpage">
            <div class="section" id="sec1">
                <div class="title-div">
                    <span class="title wow animate__animated animate__fadeInDown">Agroholding</span>
                </div>
            </div>
            <div class="section" id="sec2">
                <!-- <h1 class="wow animate__animated animate__fadeInDown">hello</h1> -->
                <div class="title-div">
                    <span class="title wow animate__animated animate__fadeInDown">Sowing list</span>
                </div>
                <div class="form">
                    <form method="POST">
                        <input type="submit" value="Get sowing list" name="conn">
                    </form>
                    <?php
                        $server = "localhost";
                        $database = "farm";
                        $user = "root";
                        $password = "";

                        $connection = mysqli_connect($server, $user, $password, $database);
                        if(isset($_POST['conn'])){
                            if($connection){
                                echo "<div class='warning'>Connection success !</div>";
                                $sql = 'SELECT 
                                fields.field_place, 
                                fields.`field_area(ga)`, 
                                cultures.culture_name, 
                                fields.field_id,
                                sowing.Year,
                                cultures.`culture_price(per/cent)` * fields.`field_area(ga)` 
                                FROM sowing 
                                INNER JOIN fields ON sowing.Field = fields.field_id 
                                INNER JOIN cultures ON sowing.Culture = cultures.culture_id
                                ORDER BY sowing.Year';
                                
                                $result = mysqli_query($connection, $sql);

                                $rows = mysqli_fetch_all($result);
                                ?>
                                <div class="list-container">
                                <?php
                                foreach ($rows as $row) {
                                    ?>
                                    <div class="list">
                                        <span>
                                            Field number: <?=$row[3]?> 
                                            <br>Field location: <?=$row[0]?> 
                                            <br>Area(ga): <?=$row[1]?> 
                                            <br>Culture: <?=$row[2]?> 
                                            <br>Year: <?=$row[4]?>
                                            <br>Total price: <?=$row[5]?> rub
                                        </span>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                                <?php

                               
                            
                            }
                            else{
                                echo "<div class='warning'>Something went wrong !</div>";
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="section" id="sec3">
                <div class="title-div">
                    <span class="title wow animate__animated animate__fadeInDown">Price for sow in Spring</span>
                </div>
                <?php
                    if(isset($_POST['conn'])){
                        if($connection){
                            $sql = 'SELECT * FROM cultures WHERE cultures.culture_season = 2';

                            $result = mysqli_query($connection, $sql);

                            $rows = mysqli_fetch_all($result);
                            ?>
                            <div class="list-container">
                            <?php
                            foreach($rows as $row){
                                ?>
                                <div class="list">
                                    <span>
                                        Culture: <?=$row[1]?> 
                                        <br>Season: <?=$row[2]?> 
                                        <br>Price per centner: <?=$row[3]?>
                                    </span>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>