<?php

ini_set("ERROR_REPORTING", 1);
ini_set("default_charset", "UTF-8");

//if (is_dir('qr-images/'. iconv("UTF-8", "cp1251", 'ОлегДементьев465'))){
//    $result = scandir('qr-images/'. iconv("UTF-8", "cp1251", 'ОлегДементьев465'));
//    var_dump($result);
//} else die("bolt");

?><div style=" margin-left:2%;"><h2>Спасибо за регистрацию на форуме!</h2>
    <h3>Дорогой.<br>
Данные платежа сформированы и вы можете оплатить билеты нажав на кнопку ниже<br>
        Если по каким-либо причинам вы захотите это сделать позже - на ваш электронный адрес также
        выслано письмо с платежом.<br>
После оплаты на Ваш e-mail придет письмо с qr-кодами (электронными билетами), по которым вы
        попадете на мероприятие</h3>
</div>
<div style="text-align: center;">
    <?php
    include_once('liqpay_api.php');
    $liqpay = new LiqPay(i68529970993, C4mHVBRQDS8lwHDN8jgLxdMQ9dk7iRUmCxb20r9l);
    $html = $liqpay->cnb_form(array(
        'action'         => 'pay',
        'amount'         => '4000',
        'sandbox'         => '1',
        'currency'       => 'UAH',
        'description'    => 'Оплата входных билетов',
        'order_id'       => 'order_id_4',
        'version'        => '3'
    ));
    echo $html;
    ?>
</div>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { // если кто-то пытается попасть в наш файл напрямую, не через отправку формы - получит болт

    if (isset($_POST['registration_form'])) { //если пришла форма регистрации участника


        include_once('phpqrcode/qrlib.php'); //наша библиотека генерации кр-кодов
        //var_dump($_POST); die;

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

        if ($promo == "рыба") {
            $promo_code = 0.9;
        } elseif ($promo == "носки") {
            $promo_code = 0.8;
        } elseif ($promo == "море") {
            $promo_code = 0.7;
        } else $promo_code = 1;


        $to = 'vyzovyivozmozhnosti@gmail.com';
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

        $summ = 4000 * $promo_code * (int)$tickets;

        if ($tickets > 1) {
            //$folder = iconv("UTF-8", "cp1251", 'qr-images/' . $_POST['name'] . $_POST['surname']);
            //echo $folder; die;
            $folder = mkdir('qr-images/' . iconv("UTF-8", "cp1251", $name . $surname . substr($phone, -3)));
            $qr_path = 'qr-images/' . $name . $surname . substr($phone, -3);
            for ($i = 0; $i < $tickets; $i++) {
                $qr_hash[] = md5($name . $surname . $from . $i);
                QRcode::png(md5($name . $surname . $from . $i), 'qr-images/' . iconv("UTF-8", "cp1251", $name . $surname . substr($phone, -3)) . '/' . iconv("UTF-8", "cp1251", $name . $surname . $i . substr($phone, -3)) . '.png'); //генерируем кр-коды
            }
        } elseif ($tickets == 1){
            $qr_path = 'qr-images/' . $name . $surname . substr($phone, -3);
            $qr_hash = md5($name . $surname . $from);
            QRcode::png($qr_hash, 'qr-images/' . iconv("UTF-8", "cp1251", $name . $surname . substr($phone, -3) . '.png')); //генерируем кр-код для одного пользователя
        } else echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
                    <div> style=" margin-left:2%;"><h2>Не указано количество билетов!</h2>
                    <h3>Заполните заново форму регистрации и проверьте поля на правильность</h3>
                    <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>
                    </div>
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
                     Вы заказали ' . (int)$tickets . ' билетов. На сумму ' . $summ . 'грн.<br>                      
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
                        <input type="hidden" name="return_url" value="http://business-forum/forms.php"/>
                        <input type="hidden" name="server_url" value="http://business-forum/forms.php"/>
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
                     Вы заказали ' . (int)$tickets . ' билетов. На сумму ' . $summ . 'грн.<br>
                     Оплатить можно на карту Приват Банка 5168 7556 0211 6184 ПЛАТОНОВА МАРИЯ ВАЛЕНТИНОВНА.
                     Просьба оплатить в течение 3 рабочих дней.<br>
                     После оплаты Вам на почту будет отправлен билет с QR кодом.<br>
                     По вопросам регистрации можно обратиться по номеру 067 556 71 66<br>                      
                     Мы свяжемся с Вами в ближайшее время для уточнения деталей<br>
                     По факту оплаты Вам будут предоставлены qr-коды для посещения мероприятия. Их можно распечатать или предъявить на экране телефона';
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
                        Данные платежа сформированы и вы можете оплатить билеты нажав на кнопку ниже<br>
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
                        <input type="hidden" name="return_url" value="http://business-forum/forms.php"/>
                        <input type="hidden" name="server_url" value="http://business-forum/forms.php"/>
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
                    <h3>Дорогой <?php echo $name; ?>, вы указали способом оплаты <?php echo $radio1 ?>.<br>
                        Данные платежа сформированы и вы можете оплатить билеты нажав на кнопку ниже<br>
                        Если по каким-либо причинам вы захотите это сделать позже - на ваш электронный адрес также
                        выслано письмо с платежом.<br>
                        После оплаты на Ваш e-mail придет письмо с qr-кодами (электронными билетами), по которым вы
                        попадете на мероприятие</h3>
                </div>
                <div style="text-align: center;">
                    <?php
                    include_once('liqpay_api.php');
                    $liqpay = new LiqPay($public_key, $private_key);
                    $html = $liqpay->cnb_form(array(
                    'action'         => 'pay',
                    'amount'         => '4000',
                    'sandbox'         => '1',
                    'currency'       => 'UAH',
                    'description'    => 'Международный бизнес-форум',
                    'order_id'       => 'order_id_1',
                    'version'        => '3'
                    ));
                    ?>
                </div>
            </div>
            <?php
        } else if ($admin_letter && $thank_letter && $result) {

            echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
                    <div> style=" margin-left:2%;"><h2>Спасибо за регистрацию на форуме!</h2>
                    <h3>Мы свяжемся с Вами по указанному Вами номеру в ближайшее время для уточнения деталей выставления счета</h3>
                    <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>
                    </div>
              </div>';


        } else {
            echo '<h1 class="modal_main_h">Призошла ошибка, очень сожалеем ;(</h1>
                <p>Попробуйте еще раз позже</p>';
        }
    } else if (isset($_POST['volunteer_form'])) { //если пришла форма регистрации волонтера

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

            $to = 'vyzovyivozmozhnosti@gmail.com';
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
            //var_dump($request_data);
            $to = "vyzovyivozmozhnosti@gmail.com"; //Кому
            $subject = "Test"; //Тема
            $message = "Текстовое сообщение"; //Текст письма
            $boundary = "---"; //Разделитель
            /* Заголовки */
            $headers = "Content-Type: multipart/mixed; boundary=\"$boundary\"";
            $body = "--$boundary\n";
            /* Присоединяем текстовое сообщение */
            $body .= "Content-type: text/html; charset='utf-8'\n";
            $body .= "Content-Transfer-Encoding: quoted-printablenn";
            $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
            $body .= $message."\n";
            $body .= "--$boundary\n";
            $filename = "form.txt"; //Имя файла для прикрепления
            $file = fopen($filename, "r"); //Открываем файл
            $text = fread($file, filesize($filename)); //Считываем весь файл
            fclose($file); //Закрываем файл
            /* Добавляем тип содержимого, кодируем текст файла и добавляем в тело письма */
            $body .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode($filename)."?=\n";
            $body .= "Content-Transfer-Encoding: base64\n";
            $body .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($filename)."?=\n\n";
            $body .= chunk_split(base64_encode($text))."\n";
            $body .= "--".$boundary ."--\n";
            $result = mail($to, $subject, $body, $headers);
                        var_dump($result);

//            echo '<div style="margin-top:25%; margin-left:25%; border:solid 1px black; height:20%; width:40%;">
//                    <div style=" margin-left:2%;"><h2>Спасибо за оплату!</h2>
//                        <br><h3>Ваши электронные билеты должны быть уже на Вашей электронной почте!</h3>
//                        <br><h3>Переадресация на главную страницу через: <span id="count">5</span></h3>
//                    </div>
//              </div>';
        } else {
                echo "Ошибка! Но на вашем имейле уже есть письмо для повторной оплаты ;)" . $signature;
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