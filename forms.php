<?php

ini_set("ERROR_REPORTING", 1);
ini_set("default_charset", "UTF-8");

if ($_SERVER["REQUEST_METHOD"] == "POST") { // если кто-то пытается попасть в наш файл напрямую, не через отправку формы - получит болт

    if (isset($_POST['registration_form'])) { //если пришла форма регистрации участника

        include_once('phpqrcode/qrlib.php'); //наша библиотека генерации кр-кодов

        if (isset($_POST['name']) && $_POST['name'] != '') {
            $name = stripslashes(strip_tags(trim($_POST['name'])));
        } else $name = "Имя не указано";

        if (isset($_POST['surname']) && $_POST['surname'] != '') {
            $surname = stripslashes(strip_tags(trim($_POST['surname'])));
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
        setcookie("Email", $from, time()+3600);

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



        $to = 'vyzovyivozmozhnosti@gmail.com,join@businessforum.kharkov.ua';
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

        if (!empty($_POST['checkbox1'])) {
            $checkbox1 = $_POST['checkbox1'];

            $message .= "<p>Регистрант интересуется: ";
            foreach ($_POST['checkbox1'] as $checkbox) {
                $message .= "<b>" . $checkbox . "<b> ";
            }
            $message .= "</p>";
        } else $checkbox1 = false;

        $radio1 = $_POST['radio1'];

        $message .= "<p>И в качестве способа платежа выбрал " . $radio1 . "</p>";

        $promo_file = file_get_contents("promo.txt"); //рассчитываем нашу скидку
        $promo_array = explode("\n", $promo_file);
        $promo_phrase = array();
        $promo_percent = array();
        foreach ($promo_array as $value) {
            $promo_phrase[] = iconv("cp1251", "UTF-8", current(explode(";", $value)));
            $promo_percent[] = iconv("cp1251", "UTF-8", end(explode(";", $value)));
        }

        $promo_code = 1;

        foreach($promo_phrase as $key=>$value) {
            if ($promo == $value) {
                $promo_code = $promo_percent[$key];
            }
        }

        if($tickets > 3){
            $promo_code .= -.15;
            $skidon2 = "Вы заказали более 3 билетов, что дает право на автоматическую скидку 15%<br>";
        } else $skidon2 = '';

        if($promo_code < 1){
            $skidon = "Вы ввели промокод: ".$promo.", который дает скидку ". (1 - $promo_code)*100 ."%<br>";
        } else $skidon = '';

        $price = $_POST['summ'] ? (int)$_POST['summ'] : 4000;

        $summ = $price * $promo_code;
        //echo $summ; die;

        //До кр-кодов, чтоб не засирать сервер всяким лишним хламом, проверим ответ рекаптчи, ну а потом можно продолжать
        // 1) Смотрим на то, что назаполнял пользователь и если рекаптча пришла, записываем ее ответ
//        if($_POST['g-recaptcha-response']){
//            $recaptcha = $_POST['g-recaptcha-response'];
//        } else  die("<div style=\"margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;\">
//                    <div style=\" margin-left:2%;\"><h2>Ага! Попробовали войти без капчи?</h2>
//                    <h3>Попробуйте еще раз!</h3>
//                    <br><h3><a href=".$_SERVER['HTTP_REFERER'].">Назад на страницу форума</a></span></h3>
//                    </div>
//              </div>");
//
//        // 2) Посылаем постом запрос на гугл апи и смотрим, решил ли он пропускать человека, или это бот
//
//        $url = 'https://www.google.com/recaptcha/api/siteverify';
//        $data = array('secret' => '6LfOliEUAAAAACIq7kJlicCm_Kp2C-j37_mTflsx', 'response' => $recaptcha, 'remoteip' => $_SERVER['REMOTE_ADDR']);
//
//        // use key 'http' even if you send the request to https://...
//        $options = array(
//            'http' => array(
//                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//                'method'  => 'POST',
//                'content' => http_build_query($data)
//            )
//        );
//        $context  = stream_context_create($options);
//        $result = file_get_contents($url, false, $context);
//        if ($result === FALSE) { echo "Все очень плохо"; } else echo $result;
//
//        json_decode($result, true);
//
//        if(!$result['success']){
//            die("<div style=\"margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;\">
//                    <div style=\" margin-left:2%;\"><h2>Ошибка капчи!</h2>
//                    <h3>Попробуйте еще раз!</h3>
//                    <br><h3>Переадресация на главную страницу через: <span id=\"count\">5</span></h3>
//                    </div>
//              </div>");
//        }


        if ($tickets > 1) {
            //$folder = iconv("UTF-8", "cp1251", 'qr-images/' . $_POST['name'] . $_POST['surname']);
            mkdir('qr-images/' . iconv("UTF-8", "cp1251", $name . $surname . substr($phone, -3)));
            $qr_path = 'qr-images/' . $name . $surname . substr($phone, -3);
            $qr_photos = array();
            for ($i = 0; $i < $tickets; $i++) {
                $qr_hash[] = md5($name . $surname . $from . $i);
                QRcode::png(md5($name . $surname . $from . $i), 'qr-images/' . iconv("UTF-8", "cp1251", $name . $surname . substr($phone, -3)) . '/' . iconv("UTF-8", "cp1251", $name . $surname . $i . substr($phone, -3)) . '.png'); //генерируем кр-коды
                //$qr_photos[] = $name . $surname . $i . substr($phone, -3) . '.png';
            }
            setcookie("QrPath", $qr_path, time()+3600);
            //setcookie("QrPhotos", serialize($qr_photos), time()+3600);
            //var_dump($_COOKIE); die;
        } elseif ($tickets == 1){
            $qr_hash = md5($name . $surname . $from);
            QRcode::png($qr_hash, 'qr-images/' . iconv("UTF-8", "cp1251", $name . $surname . substr($phone, -3) . '.png')); //генерируем кр-код для одного пользователя
            setcookie("QrPhoto", 'qr-images/'. $name . $surname . substr($phone, -3) . '.png', time()+3600);
        } else echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
                    <h2>Не указано количество билетов!</h2>
                    <h3>Заполните заново форму регистрации и проверьте поля на правильность</h3>
                    <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>                   
                    </div>';

        if (is_array($qr_hash)) {
            foreach ($qr_hash as $value) {
                $qr_hash_result .= $value . "\n";
            }
            $qr_hash_result = substr($qr_hash_result, 0, -1);
        } else $qr_hash_result = $qr_hash;

        $payment_id =  rand(1, 9999) ;
        if($radio1 == 'Приват24'){
            $message1 = 'Добрый день, ' . $name . '!<br> 
                     Спасибо за ваш интерес к форуму!<br>
                     Вы заказали ' . (int)$tickets . ' билетов. На сумму ' . $summ . 'грн.<br>'.$skidon. $skidon2.'                                          
                     Их можно приобрести кликнув по ссылке: 
                     <div style="text-align: center;">
                    <form method="POST" action="https://api.privatbank.ua/p24api/ishop">
                        <input type="hidden" name="amt" value="' . $summ . '"/>
                        <input type="hidden" name="ccy" value="UAH"/>
                        <input type="hidden" name="merchant" value="102003"/>
                        <input type="hidden" name="order" value="' . $payment_id . '"/>
                        <input type="hidden" name="details"
                               value="Оплата билетов. Заказано билетов: ' . $tickets . '"/>
                        <input type="hidden" name="ext_details"
                               value="Наш международный бизнес-форум - это мероприятие, объединяющие десятки лучших отечественных спикеров в области ведения собственного дела"/>
                        <input type="hidden" name="pay_way" value="privat24"/>
                        <input type="hidden" name="return_url" value="http://businessforum.kharkov.ua/forms.php"/>
                        <input type="hidden" name="server_url" value="http://businessforum.kharkov.ua/forms.php"/>
                        <button type="submit"><img src="https://privat24.privatbank.ua/p24/img/buttons/api_logo_1.jpg"
                                                   border="0"/></button>
                    </form>
                    </div>
                     Если Вы уже приобретали билеты и у вас есть qr-коды на мероприятие, переходить по ссылке не нужно.
                     Со стоимостью и датами проведения мероприятий можно ознакомиться здесь: (ссылка на цены)<br>
                     Мы свяжемся с Вами в ближайшее время для уточнения деталей<br>
                     По факту оплаты Вам будут предоставлены qr-коды для посещения мероприятия. Их можно распечатать или предъявить на экране телефона';
        } else if($radio1 == 'Перевод на карту VIsa/Mastercard'){
            $message1 = 'Добрый день, ' . $name . '!<br> 
                     Спасибо за ваш интерес к форуму!<br>
                     Вы заказали ' . (int)$tickets . ' билетов. На сумму ' . $summ . 'грн.<br>'.$skidon. $skidon2.' 
                     Оплатить можно на карту Приват Банка 5168 7556 0211 6184 ПЛАТОНОВА МАРИЯ ВАЛЕНТИНОВНА.
                     Просьба оплатить в течение 3 рабочих дней.<br>
                     После оплаты Вам на почту будет отправлен билет с QR кодом.<br>
                     По вопросам регистрации можно обратиться по номеру 067 556 71 66<br>                      
                     Мы свяжемся с Вами в ближайшее время для уточнения деталей<br>
                     По факту оплаты Вам будут предоставлены qr-коды для посещения мероприятия. Их можно распечатать или предъявить на экране телефона';
        } else {
            $message1 = 'Добрый день, ' . $name . '!<br> 
                     Спасибо за ваш интерес к форуму!<br>
                     Вы заказали ' . (int)$tickets . ' билетов. На сумму ' . $summ . 'грн.<br>'.$skidon. $skidon2.' 
                     Мы свяжемся с Вами в ближайшее время для уточнения деталей<br>
                     Просьба оплатить билеты в течение 3 рабочих дней.<br>
                     После оплаты Вам на почту будет отправлен билет с QR кодом.<br>
                     По вопросам регистрации можно обратиться по номеру 067 556 71 66<br>';
        }

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . " \r\n";

        $admin_letter = mail($to, $subject, $message, $headers);
        $thank_letter = mail($to1, $subject1, $message1, $headers);


        // теперь подготовим данные для отправки в гугл форму
        $url = 'https://docs.google.com/forms/d/e/1FAIpQLSf-N5XwbM552fCa1geneDABFTEm6Sx79D7mRG2QB_aB7fAatA/formResponse'; // куда слать, это атрибут action у гугл формы
        $data = array(); // массив для отправки в гугл форм
        $data['entry.1202315488'] = $name; // указываем соответствия полей, ключи массива это нэймы оригинальных полей гугл формы
        $data['entry.1494576082'] = $surname;
        $data['entry.987063443'] = $company;
        $data['entry.1922735953'] = $activity;
        $data['entry.976439214'] = $phone;
        $data['entry.384145225'] = $from;
        $data['entry.1186723470'] = $position;
        $data['entry.1187646765'] = $tickets;
        $data['entry.146022313'] = $promo;
        $data['entry.1756814250'] = $comment;
        $data['entry.2135006552'] = $radio1;
        $data['entry.341797208'] = $checkbox1;
        $data['entry.1561159570'] = $qr_path;
        $data['entry.273555319'] = $qr_hash_result;

        $data = http_build_query($data); // теперь сериализуем массив данных в строку для отправки
        if (is_array($checkbox1)) {
            foreach ($checkbox1 as $key => $value) { // если у нас есть элементы с нескольки значениями (например чекбоксы), надо пройтись по каждому и заменить кое что в отправляемой строке
                $data = str_replace('entry.341797208%5B' . $key . '%5D', 'entry.341797208', $data); // а именно выпилить [0], [1], [2].. из ключей, иначе в гугл форму это поле с несколькими значениями не запишется
            }
        }

        $options = array( // задаем параметры запроса
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => $data,
            ),
        );
        $context = stream_context_create($options); // создаем контекст отправки
        $result = file_get_contents($url, false, $context); // отправляем

        if ($admin_letter && $thank_letter && $result && $radio1 == 'Приват24') {
            ?>
            <div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:30%; width:40%;">
                <div style=" margin-left:2%;"><h2>Спасибо за регистрацию на форуме!</h2>
                    <h3> Дорогой <?php echo $name; ?>, вы указали способом оплаты <?php echo $radio1 ?>.<br>
                        Данные платежа сформированы и вы можете оплатить билеты нажав на кнопку ниже<br><?php echo $skidon. $skidon2; ?>
                        Если по каким-либо причинам вы захотите это сделать позже - на ваш электронный адрес также
                        выслано письмо с платежом.<br>
                        После оплаты на Ваш e-mail придет письмо с qr-кодами (электронными билетами), по которым вы
                        попадете на мероприятие</h3>
                </div>
                <div style="text-align: center;">
                    <form method="POST" action="https://api.privatbank.ua/p24api/ishop">
                        <input type="hidden" name="amt" value="<?php echo $summ; ?>"/>
                        <input type="hidden" name="ccy" value="UAH"/>
                        <input type="hidden" name="merchant" value="102003"/>
                        <input type="hidden" name="order" value="<?php echo $payment_id ?>"/>
                        <input type="hidden" name="details"
                               value="Оплата билетов. Заказано билетов: <?php echo $tickets; ?> "/>
                        <input type="hidden" name="ext_details"
                               value="Наш международный бизнес-форум - это мероприятие, объединяющие десятки лучших отечественных спикеров в области ведения собственного дела"/>
                        <input type="hidden" name="pay_way" value="privat24"/>
                        <input type="hidden" name="return_url" value="http://businessforum.kharkov.ua/forms.php"/>
                        <input type="hidden" name="server_url" value="http://businessforum.kharkov.ua/forms.php"/>
                        <button type="submit"><img src="https://privat24.privatbank.ua/p24/img/buttons/api_logo_1.jpg"
                                                   border="0"/></button>
                    </form>
                </div>
            </div>
            <?php
        } else if ($admin_letter && $thank_letter && $result && $radio1 == 'Перевод на карту Visa/Mastercard') { //если через форму пришел LiqPay
            ?>
            <div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:30%; width:40%;">
                <div style=" margin-left:2%;"><h2>Спасибо за регистрацию на форуме!</h2>
                    <h3>Дорогой <?php echo $name; ?>, вы указали способом оплаты <?php echo $radio1 ?>.<br><?php echo $skidon. $skidon2; ?>
                        Данные платежа сформированы и вы можете оплатить билеты нажав на кнопку ниже<br>
                        После оплаты, укажите еще раз Ваш e-mail для получения чека об оплате, а мы свяжемся с Вами в ближайшее время</h3>
                </div>
                <div style="text-align: center;">
                <?php
                include_once('liqpay_api.php');
                $liqpay = new LiqPay(i68529970993, C4mHVBRQDS8lwHDN8jgLxdMQ9dk7iRUmCxb20r9l);
                $html = $liqpay->cnb_form(array(
                    'action'         => 'pay',
                    'amount'         => $summ,
                    'sandbox'         => '1',
                    'currency'       => 'UAH',
                    'description'    => 'Оплата входных билетов',
                    'order_id'       => $payment_id,
                    'version'        => '3'
                ));
                echo $html;
                ?>
                </div>
                </div>
            </div>
            <?php
        } else if ($admin_letter && $thank_letter && $result) {

            echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
                    <div style=" margin-left:2%;"><h2>Спасибо за регистрацию на форуме!</h2>
                    <h3>Мы свяжемся с Вами по указанному Вами номеру в ближайшее время для уточнения деталей выставления счета</h3>
                    <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>
                    </div>
              </div>';


        } else {
            echo '<h1 class="modal_main_h">Призошла ошибка, очень сожалеем ;(</h1>
                <p>Попробуйте еще раз позже</p>';
        }
    } else if (isset($_POST['volunteer_form'])) { //если пришла форма регистрации волонтера

            //До всего проеврим форму регистрации волонтера
            // 1) Смотрим на то, что назаполнял пользователь и если рекаптча пришла, записываем ее ответ
//            if($_POST['g-recaptcha-response']){
//                $recaptcha = $_POST['g-recaptcha-response'];
//            } else  echo "<div style=\"margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;\">
//                        <div style=\" margin-left:2%;\"><h2>Ага! Попробовали войти без капчи?</h2>
//                        <h3>Попробуйте еще раз!</h3>
//                        <br><h3>Переадресация на главную страницу через: <span id=\"count\">5</span></h3>
//                        </div>
//                  </div>"; die;
//
//            // 2) Посылаем постом запрос на гугл апи и смотрим, решил ли он пропускать человека, или это бот
//
//            $url = 'https://www.google.com/recaptcha/api/siteverify';
//            $data = array('secret' => '6LeQoSEUAAAAAJx3eLI52adB2KwmrjmHtI6RcTV0', 'response' => $recaptcha, 'remoteip' => $_SERVER['REMOTE_ADDR']);
//
//            // use key 'http' even if you send the request to https://...
//            $options = array(
//                'http' => array(
//                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//                    'method'  => 'POST',
//                    'content' => http_build_query($data)
//                )
//            );
//            $context  = stream_context_create($options);
//            $result = file_get_contents($url, false, $context);
//            if ($result === FALSE) { /* Handle error */ }
//
//            json_decode($result, true);
//
//            if(!$result['success']){
//                echo "<div style=\"margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;\">
//                        <div style=\" margin-left:2%;\"><h2>Ошибка капчи!</h2>
//                        <h3>Попробуйте еще раз!</h3>
//                        <br><h3>Переадресация на главную страницу через: <span id=\"count\">5</span></h3>
//                        </div>
//                  </div>"; die;
//            }

            $volunteer = "Волонтер";
            $name = strip_tags(trim($_POST['name']));
            $from = strip_tags(trim($_POST['email']));
            $phone = strip_tags(trim($_POST['phone']));

            if (isset($_POST['surname']) && $_POST['surname'] != '') {
                $surname = $_POST['surname'];
            } else $surname = "Фамилия не указана";

            if (isset($_POST['company']) && $_POST['company'] != '') {
                $company = $_POST['company'];
            } else $company = "Компания не указана";

            if (isset($_POST['activity']) && $_POST['activity'] != '') {
                $activity = $_POST['activity'];
            } else $activity = "Сфера деятельности не указана";



            if (isset($_POST['comments']) && $_POST['comments'] != '') {

                $comment = $_POST['comments'];
            } else $comment = "Комментариев нет";

            $to = 'vyzovyivozmozhnosti@gmail.com,join@businessforum.kharkov.ua';
            $to1 = $from;

            $subject = $name . " хочет быть волонтером на форуме";
            $subject1 = "Международный бизнес-форум";

            //До формирования данных проверим ответ рекаптчи, ну а потом можно продолжать
            // 1) Смотрим на то, что назаполнял пользователь и если рекаптча пришла, записываем ее ответ
            if($_POST['g-recaptcha-response']){
                $recaptcha = $_POST['g-recaptcha-response'];
            } else  die("<div style=\"margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;\">
                        <div style=\" margin-left:2%;\"><h2>Ага! Попробовали войти без капчи?</h2>
                        <h3>Попробуйте еще раз!</h3>
                        <br><h3><a href=".$_SERVER['HTTP_REFERER'].">Назад на страницу форума</a></span></h3>
                        </div>
                  </div>");

            // 2) Посылаем постом запрос на гугл апи и смотрим, решил ли он пропускать человека, или это бот

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array('secret' => '6LeQoSEUAAAAAJx3eLI52adB2KwmrjmHtI6RcTV0', 'response' => $recaptcha, 'remoteip' => $_SERVER['REMOTE_ADDR']);

            // use key 'http' even if you send the request to https://...
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result === FALSE) { /* Handle error */ }

            json_decode($result, true);

            if(!$result['success']){
                die("<div style=\"margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;\">
                        <div style=\" margin-left:2%;\"><h2>Ошибка капчи!</h2>
                        <h3>Попробуйте еще раз!</h3>
                        <br><h3><a href=".$_SERVER['HTTP_REFERER'].">Назад на страницу форума</a></span></h3>
                        </div>
                  </div>");
            }
            //end captcha verifying

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

            $message1 = 'Добрый день, ' . $name . '!<br> 
                     Спасибо за ваш интерес к форуму и желание нас помочь с его организацией!<br>
                     Мы свяжемся с Вами в ближайшее время для уточнения деталей';

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

            $admin_letter = mail($to, $subject, $message, $headers);
            $thank_letter = mail($to1, $subject1, $message1, $headers);

            // теперь подготовим данные для отправки в гугл форму
            $url = 'https://docs.google.com/forms/d/1dmSB67x0ZXWEUMNOnGTZNJjfv6aMskgkxSJKqsZnYQg/formResponse'; // куда слать, это атрибут action у гугл формы
            $data = array(); // массив для отправки в гугл форм
            $data['entry.1437149509'] = $name; // указываем соответствия полей, ключи массива это нэймы оригинальных полей гугл формы
            $data['entry.26007662'] = $surname;
            $data['entry.994326669'] = $phone;
            $data['entry.247367182'] = $from;
            $data['entry.927409302'] = $company;
            $data['entry.1878265984'] = $activity;
            $data['entry.1958491584'] = $comment;

            $data = http_build_query($data); // теперь сериализуем массив данных в строку для отправки

            $options = array( // задаем параметры запроса
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => $data,
                ),
            );
            $context = stream_context_create($options); // создаем контекст отправки
            $result = file_get_contents($url, false, $context); // отправляем

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
        } else if(isset($_POST['payment'])) { //в случае ответа от привабанка

        function _privatbank_parse_query($query)
        {
            $items = explode("&", $query);
            $ar = array();
            foreach ($items as $it) {
                list($key, $value) = explode("=", $it, 2);
                $ar[$key] = $value;
            }
            return $ar;
        }

        $pb_payment = _privatbank_parse_query($_POST['payment']);
        $request_data = $_POST;
        $pass = 'JL333qhE7IrcM9eHL5EIccjt2K3M9Zte'; //Пароль от Мерчанта
        $signature = sha1(md5($request_data['payment'] . $pass)); //расчет сигнатуры

        if ($request_data['signature'] == $signature && $pb_payment['state'] == 'test') { //если оплата прошла, то посылаем коды в письме
            if (is_dir(iconv("UTF-8", "cp1251", $_COOKIE['QrPath']))){
                $result = scandir(iconv("UTF-8", "cp1251", $_COOKIE['QrPath']));
                foreach ($result as $value){
                    if(substr(strrchr($value, '.'), 1)=='png'){
                        $file[] = $_COOKIE['QrPath'].'/'. iconv("cp1251", "UTF-8", $value);
                    }
                }
                //var_dump($file);
            } else if (is_string($_COOKIE["QrPhoto"])){
                $file[] = $_COOKIE["QrPhoto"];
            } else die("QR-коды не сгенерированы или произошла какая-то другая ошибка с файламами. Сообщите об ошибке администрации 
            по телефону 067 556 71 66 или имейлом: . В любом случае, наши менеджеры вскоре свяжутся с Вами, не переживайте!"); //вытяги
                //var_dump($request_data);
            $to = $_COOKIE['Email']; //Кому. Берем из куки, т.к. это уже ответ сервера
            unset($_COOKIE); //куки больше не нужны
            $from = "vyzovyivozmozhnosti@gmail.com";
            $msg = "<h3>Спасибо за оплату входных билетов на мероприятие бизнес-форума 2017!</h3><br>
                         Ниже, в приложении, Вы найдете кр-коды билетов для входа. Распечатайте их или предъявите на экране телефона.<br>
                         Ждем Вас на мероприятии 20-21 июня!";
            $subject = "Входные билеты на бизнес-форум 2017";
            function send_mail($email, $subject, $msg, $from, $file)
            {
                $boundary = "--" . md5(uniqid(time()));
                $headers = "MIME-Version: 1.0\n";
                $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
                $headers .= "From: $from\n";
                $multipart = "--$boundary\n";
                $multipart .= "Content-Type: text/html; charset=utf-8\n";
                $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n";
                $multipart .= "$msg\n\n";
                $message_part = "";
                foreach ($file as $key => $value) {
                    $file = file_get_contents(iconv("UTF-8", "cp1251", $value));
                    $message_part .= "--$boundary\n";
                    $message_part .= "Content-Type: application/octet-stream\n";
                    $message_part .= "Content-Transfer-Encoding: base64\n";
                    $message_part .= "Content-Disposition: attachment; filename=\"$value\"\n\n";
                    $message_part .= chunk_split(base64_encode($file)) . "\n";
                }
                $multipart .= $message_part . "--$boundary--\n";

                mail($email, $subject, $multipart, $headers);
                return true;
            };
            if (send_mail($to, $subject, $msg, $file) == true){
                echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
                        <div style=" margin-left:2%;"><h2>Спасибо за оплату!</h2>
                            <br><h3>Ваши электронные билеты должны быть уже на Вашей электронной почте!</h3>
                            <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>
                        </div>
                  </div>';
            } else "Ошибка отправки билетов. Сообщите по телефону 067 556 71 66 или имейлом: В любом случае, наши менеджеры вскоре свяжутся с Вами, не переживайте!";

        } else {
                echo "Ошибка! Но на вашем имейле уже есть письмо для повторной оплаты ;)<br>
                      <h3>Переадресация на главную страницу через: <span id=\"count\">5</span></h3>";
                //var_dump($request_data);
            }
        }

} else {
    http_response_code(403);
    echo "Попробуйте еще раз";
}
?>

<script type="text/javascript">
    window.onload = function () {
        (function () {
            var counter = 4;
            setInterval(function () {
                if (counter >= 0) {
                    span = document.getElementById("count");
                    span.innerHTML = counter;
                } else {
                    window.location = "http://businessforum.kharkov.ua/";
                }
                counter--;
            }, 1000);
        })();
    }
</script>