<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RepON</title>

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
                    <span class="title wow animate__animated animate__fadeInDown">Репетиторы</span>
                </div>
            </div>
            <div class="section" id="sec2">
                <!-- <h1 class="wow animate__animated animate__fadeInDown">hello</h1> -->
                <div class="title-div">
                    <span class="title wow animate__animated animate__fadeInDown">Список репетиторов</span>
                </div>
                <div class="form">
                    <form method="POST">
                        <input type="submit" value="Получить список преподавателей" name="conn">
                    </form>
                    <?php
                        $server = "localhost";
                        $database = "tutor";
                        $user = "root";
                        $password = "";

                        $connection = mysqli_connect($server, $user, $password, $database);
                        if(isset($_POST['conn'])){
                            if($connection){
                                echo "<div class='warning'>Соединение с базой данных прошло успешно !</div>";
                                $sql = 'SELECT tutor_surname, subject_name  FROM `tutors` ORDER BY subject_name';
                                
                                $result = mysqli_query($connection, $sql);

                                $rows = mysqli_fetch_all($result);
                                ?>
                                <div class="list-container">
                                <?php
                                foreach ($rows as $row) {
                                    ?>
                                    <div class="list">
                                        <span>Преподаватель: <?=$row[0]?> Предмет: <?=$row[1]?></span>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                                <?php

                               
                            
                            }
                            else{
                                echo "<div class='warning'>При подключении к базе данных произошла ошибка !</div>";
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="section" id="sec3">
                <div class="title-div">
                    <span class="title wow animate__animated animate__fadeInDown">Список занятий</span>
                </div>
                <?php
                    if(isset($_POST['conn'])){
                        if($connection){
                            $sql = "
                                SELECT
                                `students`.`student_surname`,
                                `tutors`.`tutor_surname`,
                                `tutors`.`subject_name`,
                                lesson_hours, 
                                lesson_date 
                                FROM `lessons`
                                
                                INNER JOIN `tutors` ON `lessons`.`tutor_id` = `tutors`.`tutor_id` 
                                INNER JOIN `students` ON `lessons`.student_id = `students`.student_id 
                                WHERE `lessons`.`lesson_date` LIKE '2022-02-%' 
                                ORDER BY `tutors`.`subject_name`
                            ";

                            $result = mysqli_query($connection, $sql);

                            $rows = mysqli_fetch_all($result);
                            ?>
                            <div class="list-container">
                            <?php
                            foreach($rows as $row){
                                ?>
                                <div class="list">
                                    <span>Ученик: <?=$row[0]?> Преподаватель: <?=$row[1]?> Предмет: <?=$row[2]?> Часы: <?=$row[3]?> Дата: <?=$row[4]?></span>
                                </div>
                                <?php
                            }
                            ?>
                            </div>
                            <?php
                                $sql = 
                                "
                                    SELECT 
                                    `tutors`.`tutor_surname`, 
                                    SUM(`lessons`.`lesson_hours`) as 'Hours', 
                                    `tutors`.`hour_price` as 'price',
                                    SUM(`lessons`.`lesson_hours`) * `tutors`.`hour_price`  
                                    FROM `tutors`
                                    
                                    INNER JOIN `lessons` ON `lessons`.`tutor_id` = `tutors`.`tutor_id`
                                    WHERE `tutors`.`tutor_surname` = 'Zubova' AND `lessons`.`lesson_date` LIKE '2022-01-%'
                                    GROUP BY `tutors`.`hour_price`
                                
                                ";
                                $result = mysqli_query($connection, $sql);
                               
                                $rows = mysqli_fetch_all($result);


                                ?>
                                <div class="list-container">
                                    <div class="list">Преподаватель: <?=$rows[0][0]?> Часов отработано: <?=$rows[0][1]?> Стоимость за час: <?=$rows[0][2]?> Итог за янаварь: <?=$rows[0][3]?></div>
                                </div>
                                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>