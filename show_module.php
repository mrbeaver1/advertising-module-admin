<?php

class ContentBuilder
{
    private const CACHE_DIRECTORY = 'log'; //Директория кэша
    private const CACHE_FILE_NAME = 'footer.txt'; //Название файла для кэша футера
    private const LAST_UPDATE_LOG_FILE = 'uodate_log.txt'; // Название файла для логов обновления
    private const ADS_URL = 'http://advertising-module.local'; // Сайт адвентер
    private const ADS_GET_URL = '/api/get-ads'; //Не трогать
    private const CLIENT_ID = 1; //ID клиента в системе сайта адвентера
    private const ADS_COUNT = 5; // Количество банеров
    private const TIMEOUT = 1; // Таймаут запросов в минутах
    private const ADS_RANGE = [
        "50X60",
        "60X70",
        "70X80",
        "80X90",
        "90X100"
    ]; // Разрешения фотографий

    public static function getContent()
    {
        if (!is_dir(self::CACHE_DIRECTORY)) {
            mkdir(self::CACHE_DIRECTORY);
        }

        $cacheFileName = self::CACHE_DIRECTORY . DIRECTORY_SEPARATOR . self::CACHE_FILE_NAME;
        $lastUpdateLogFile = self::CACHE_DIRECTORY . DIRECTORY_SEPARATOR . self::LAST_UPDATE_LOG_FILE;

        if (
            is_file($cacheFileName) &&
            is_file($lastUpdateLogFile) &&
            (new DateTimeImmutable(file_get_contents($lastUpdateLogFile)))->diff(new DateTimeImmutable())->i <= self::TIMEOUT) {
            return file_get_contents(self::CACHE_DIRECTORY . DIRECTORY_SEPARATOR . self::CACHE_FILE_NAME);
        } else {
            $post = json_encode([
                "clientId" => self::CLIENT_ID,
                'adsCount' => self::ADS_COUNT,
                'adsRange' => self::ADS_RANGE,
            ]);

            $url = self::ADS_URL . self::ADS_GET_URL;

            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($post)
            ]);

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

            if (curl_exec($curl) === false) {
                return '<h1>Ошибка curl: ' . curl_error($curl) . '</h1>';
            }

            $response = curl_exec($curl);

            curl_close($curl);

            $html = '<div class="ads-baner-data">';

            $data = json_decode($response, true);

            if (is_null($data)) {
                return '<h1>Данные с сайта адвентера не получены! Проверьте передаваемые параметры или свяжитесь с нами!</h1>';
            } else {
                $data = $data['data'];
            }

            foreach ($data as $ads) {
                $html .= '
                <span class="ads-baner-image">
                    <a href="' . self::ADS_URL . $ads['redirectUrl'] . '"><img src="' . $ads['base64'] . '"></a>
                </span>
            ';
            }

            $html .= '</div>';

            file_put_contents($lastUpdateLogFile, (new DateTimeImmutable())->format('Y-m-d H:i:s'));
            file_put_contents($cacheFileName, $html);

            return $html;
        }
    }
}
