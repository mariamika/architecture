<?php

declare(strict_types = 1);

namespace Service\Communication;

use Model;

class Email implements ICommunication
{
    /**
     * Класс, который следует целевому интерфейсу ICommunication
     * @inheritdoc
     */

    public function process(Model\Entity\User $user, string $templateName, array $params = []): void
    {
        // Имя пользователя
        $name = $user->getName();

        // Email пользователя
        $email = $user->getEmail();

        // Сообщение об успешном оформлении заказа.
        $message = 'Уважаемый/ая ' . $name . '. Ваш заказ успешно оформлен. Спасибо за покупку!';

        // Отправляем письмо
        mail($email,$templateName,$message);
    }
}
