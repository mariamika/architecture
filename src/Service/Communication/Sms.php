<?php

declare(strict_types = 1);

namespace Service\Communication;

use Model;

class Sms implements ICommunication
{
    /**
     * Класс адаптер, который связывает целевой интерфейс ICommunication и Адаптируемый класс SmsAPI.
     *
     * **** login и password записываем те, что использовали при регистрации на сервисе www.smsfeedback.ru/smsapi/php.php.
     * @inheritdoc
     */
    private $host = 'api.smsfeedback.ru';
    private $port = 80;
    private $login = 'test';
    private $password = 'qwerty';

    //Преобразуем входные данные в формат, необходимый адаптируемому классу.
    public function process(Model\Entity\User $user, string $templateName, array $params = []): void
    {
        // Имя пользователя
        $name = $user->getName();

        // Текст сообщения
        $smsMessage = $templateName . '/n' . 'Уважаемый/ая ' . $name . 'Ваш заказ успешно оформлен.';

        // Телефон пользователя
        $phone = $user->getPhone();

        // Создаем новый объект SmsAPI
        $sms = new SmsAPI();

        // Отправка
        $sms->send($this->host, $this->port, $this->login, $this->password, $phone, $smsMessage);
    }
}
