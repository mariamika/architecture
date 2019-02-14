<?php
declare(strict_types = 1);

namespace Service\Communication;


class SmsAPI
{
    /**
     * Это адаптируемый класс. Примерная его функциональность. От компании SmsFeedback.
     * www.smsfeedback.ru/smsapi/php.php
     */
    protected $host;
    protected $port;
    protected $login;
    protected $password;

    public function send($host, $port, $login, $password, $phone, $text, $sender = false, $wapurl = false ): string
    {
        $fp = fsockopen($host, $port);
        if (!$fp) {
            return 'Не найдены хост и порт!';
        }
        fwrite($fp, "GET /messages/v2/send/" .
            "?phone=" . rawurlencode($phone) .
            "&text=" . rawurlencode($text) .
            ($sender ? "&sender=" . rawurlencode($sender) : "") .
            ($wapurl ? "&wapurl=" . rawurlencode($wapurl) : "") .
            "  HTTP/1.0\n");
        fwrite($fp, "Host: " . $host . "\r\n");
        if ($login != "") {
            fwrite($fp, "Authorization: Basic " .
                base64_encode($login. ":" . $password) . "\n");
        }
        fwrite($fp, "\n");
        $response = "";
        while(!feof($fp)) {
            $response .= fread($fp, 1);
        }
        fclose($fp);
        list($other, $responseBody) = explode("\r\n\r\n", $response, 2);
        return $responseBody;
    }

}