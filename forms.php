<?php

ini_set("ERROR_REPORTING", 1);
ini_set("default_charset", "UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") { // если кто-то пытается попасть в наш файл напрямую, не через отправку формы - получит болт

    if(isset($_POST['registration_form'])) { //если пришла форма регистрации участника

        if (isset($_POST['name']) && $_POST['name'] != '') {
            $name = $_POST['name'];
        } else $name = "Имя не указано";

        if (isset($_POST['surname']) && $_POST['surname'] != '') {

            $surname = $_POST['surname'];
        } else $surname = "Фамилия не указана";

        if (isset($_POST['company']) && $_POST['company'] != '') {
            $company = $_POST['company'];
        } else $company = "Компания не указана";

        if (isset($_POST['activity']) && $_POST['activity'] != '') {
            $activity = $_POST['activity'];
        } else $activity = "Сфера деятельности не указана";

        if (isset($_POST['phone']) && $_POST['phone'] != '') {
            $phone = $_POST['phone'];
        } else {
            $phone = "Телефон не указан";
        }

        if (isset($_POST['email']) && $_POST['email'] != '') {
            $from = $_POST['email'];
        } else {
            $from = "Email не указан";
        }

        if (isset($_POST['position']) && $_POST['position'] != '') {

            $position = $_POST['position'];
        } else $position = "Должность не указана!";

        if (isset($_POST['tickets']) && $_POST['tickets'] != '') {

            $tickets = $_POST['tickets'];
        } else $tickets = "Количество билетов не указано";

        if (isset($_POST['promo']) && $_POST['promo'] != '') {

            $promo = $_POST['promo'];
        } else $promo = "Промокод не указан";

        if (isset($_POST['comments']) && $_POST['comments'] != '') {

            $comment = $_POST['comments'];
        } else $comment = "Комментариев нет";


        $to = 'support@crepla.com';
        $to1 = $from;

        $subject = $name . " зарегистрировался на бизнес-форуме!";
        $subject1 = "Международный бизнес-форум";

        $message = '';

        if (isset($name) && isset($surname)) {
            $message .= '<p>Имя: ' . strip_tags($name) . ' ' . strip_tags($surname) . '</p>';
        }

        if (isset($company)) {
            $message .= '<p>Работает в компании: ' . strip_tags($company) . ' </p>';
        }

        if (isset($activity)) {
            $message .= '<p>Сфера деятельности: ' . strip_tags($activity) . ' </p>';
        }

        if (isset($phone)) {
            $message .= '<p>Телефон: ' . strip_tags($phone) . ' </p>';
        }
        if (isset($from)) {
            $message .= '<p>Имейл: ' . strip_tags($from) . ' </p>';
        }
        if (isset($position)) {
            $message .= '<p>Должность: ' . strip_tags($position) . ' </p>';
        }
        if (isset($tickets)) {
            $message .= '<p>Количество билетов: ' . strip_tags($tickets) . ' </p>';
        }
        if (isset($promo)) {
            $message .= '<p>Промокод: ' . strip_tags($promo) . ' </p>';
        }
        if (isset($comment)) {
            $message .= '<p>Комментарий: ' . strip_tags($comment) . ' </p>';
        }

        if (isset($_POST['investment']) or isset($_POST['export']) or isset($_POST['it'])
            or isset($_POST['energy_saving']) or isset($_POST['grants'])
        ) {
            $message .= "<p>Регистрант интересуется: ";
            if ($_POST['investment'] == 'on') {
                $message .= "<b>Инвестициями <b>";
            } elseif ($_POST['export'] == 'on') {
                $message .= "<b>Экспортом <b>";
            } elseif ($_POST['it'] == 'on') {
                $message .= "<b>Сферой IT <b>";
            } elseif ($_POST['energy_saving'] == 'on') {
                $message .= "<b>Энергосберегающими технологиями <b>";
            } elseif ($_POST['grants'] == 'on') {
                $message .= "<b>Получением грантов <b>";
            }
            $message .= "</p>";
        }

        $message1 = 'Добрый день, '. $name.'!<br> 
                     Спасибо за ваш интерес к форуму!<br>
                     Вы заказали '. (int)$tickets .' билетов. Их можно приобрести кликнув по ссылке: (тут будет Приват24)<br>
                     Со стоимостью и датами проведения мероприятий можно ознакомиться здесь: (ссылка на цены)<br>
                     Мы свяжемся с Вами в ближайшее время для уточнения деталей';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . " \r\n";

        $admin_letter = mail($to, $subject, $message, $headers);
        $thank_letter = mail($to1, $subject1, $message1, $headers);

        if ($admin_letter && $thank_letter) {
            echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
                    <div style=" margin-left:2%;"><h2>Спасибо за регистрацию на форуме!</h2>
                        <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>
                    </div>
              </div>';


        } else {
            echo '<h1 class="modal_main_h">Призошла ошибка, очень сожалеем ;(</h1>
                <p>Попробуйте еще раз позже</p>';
        }
    } if(isset($_POST['volunteer_form'])){ //если пришла форма регистрации волонтера

        $name = strip_tags($_POST['name']);

        $from = strip_tags($_POST['email']);

        if (isset($_POST['surname']) && $_POST['surname'] != '') {

            $surname = $_POST['surname'];
        } else $surname = "Фамилия не указана";

        if (isset($_POST['company']) && $_POST['company'] != '') {
            $company = $_POST['company'];
        } else $company = "Компания не указана";

        if (isset($_POST['activity']) && $_POST['activity'] != '') {
            $activity = $_POST['activity'];
        } else $activity = "Сфера деятельности не указана";

        if (isset($_POST['phone']) && $_POST['phone'] != '') {

            $phone = $_POST['phone'];
        }

        if (isset($_POST['comments']) && $_POST['comments'] != '') {

            $comment = $_POST['comments'];
        } else $comment = "Комментариев нет";

        $to = 'support@crepla.com';
        $to1 = $from;

        $subject = $name . " хочет быть волонтером на форуме";
        $subject1 = "Международный бизнес-форум";

        $message = '';

        if (isset($name)) {
            $message .= '<p>Имя: ' . strip_tags($name) . ' ' . strip_tags($surname) . '</p>';
        }

        if (isset($company)) {
            $message .= '<p>Работает в компании: ' . strip_tags($company) . ' </p>';
        }

        if (isset($activity)) {
            $message .= '<p>Сфера деятельности: ' . strip_tags($activity) . ' </p>';
        }

        if (isset($phone)) {
            $message .= '<p>Телефон: ' . strip_tags($phone) . ' </p>';
        }
        if (isset($from)) {
            $message .= '<p>Имейл: ' . strip_tags($from) . ' </p>';
        }

        if (isset($comment)) {
            $message .= '<p>Комментарий: ' . strip_tags($comment) . ' </p>';
        }

        $message1 = 'Добрый день, '. $name.'!<br> 
                     Спасибо за ваш интерес к форуму и желание нас помочь с его организацией!<br>
                     Мы свяжемся с Вами в ближайшее время для уточнения деталей';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $admin_letter = mail($to, $subject, $message, $headers);
        $thank_letter = mail($to1, $subject1, $message1, $headers);

        if ($admin_letter && $thank_letter) {
            echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
                    <div style=" margin-left:2%;"><h2>Спасибо за желание помочь форуму!</h2>
                        <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>
                    </div>
              </div>';


        } else {
            echo '<h1 class="modal_main_h">Призошла ошибка, очень сожалеем ;(</h1>
                <p>Попробуйте еще раз позже</p>';
        }
    }

} else {
    http_response_code(403);
    echo "Попробуйте еще раз";
}
?>

<script type="text/javascript">
    window.onload = function(){

        (function(){
            var counter = 4;

            setInterval(function() {
                if (counter >= 0) {
                    span = document.getElementById("count");
                    span.innerHTML = counter;
                } else {
                    window.location = "http://www.crepla.com/business-forum/index.html";
                }
                counter--;

            }, 1000);

        })();

    }
</script>