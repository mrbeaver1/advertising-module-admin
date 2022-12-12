<?php

class ContentBuilder
{
    public $cacheDirectory;// = 'log/1/2'; //Директория кэша
    public $cacheFileName; //= 'footer.txt'; //Название файла для кэша футера
    public $lastUpdateLogFile;// = 'update_log.txt'; // Название файла для логов обновления
    public $adsUrl;// = 'http://advertising-module.local'; // Сайт адвентер
    public $adsGetUrl; //Не трогать
    public $clientId; //ID клиента в системе сайта адвентера
    public $adsCount;// Количество банеров
    public $timeout;// Таймаут запросов в минутах
    public $adsRange;

    /**
     * @param $cacheDirectory
     * @param $cacheFileName
     * @param $lastUpdateLogFile
     * @param $adsUrl
     * @param $adsGetUrl
     * @param $clientId
     * @param $adsCount
     * @param $timeout
     * @param $adsRange
     */
    public function __construct()
    {
        $this->cacheDirectory = 'log/1/2';
        $this->cacheFileName = 'footer.txt';
        $this->lastUpdateLogFile = 'last_update.txt';
        $this->adsUrl = 'http://advertising-module.local';
        $this->adsGetUrl = '/api/get-ads';
        $this->clientId = 4;
        $this->adsCount = 5;
        $this->timeout = 1;
        $this->adsRange = [
            "50X60",
            "60X70",
            "70X80",
            "80X90",
            "90X100"
        ];
    }

    private function prepare()
    {
        if (!is_dir($this->cacheDirectory)) {
            mkdir($this->cacheDirectory);
        }
    }

    private function isTimeoutNotEnded($lastUpdateLogFile)
    {
        $lastUpdateDatetime = new DateTimeImmutable(file_get_contents($lastUpdateLogFile));
        $difInMinutes = $lastUpdateDatetime->diff(new DateTimeImmutable())->i;

        return $difInMinutes <= $this->timeout;
    }

    private function isUseCache($cacheFileName, $lastUpdateLogFile)
    {
        if (is_file($cacheFileName) && is_file($lastUpdateLogFile) && $this->isTimeoutNotEnded($lastUpdateLogFile)) {
            return true;
        }

        return false;
    }

    private function getAdsData()
    {
        $post = json_encode([
            "clientId" => $this->clientId,
            'adsCount' => $this->adsCount,
            'adsRange' => $this->adsRange,
        ]);

        $url = $this->adsUrl . $this->adsGetUrl;

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

        return $response;
    }

    private function generateContent($adsData, $lastUpdateLogFile, $cacheFileName)
    {
        $html = '<div class="ads-baner-data">';

        $data = json_decode($adsData, true);

        if (is_null($data)) {
            return '<h1>Данные с сайта адвентера не получены! Проверьте передаваемые параметры или свяжитесь с нами!</h1>';
        } else {
            $data = $data['data'];
        }

        foreach ($data as $ads) {
            $html .= '
                <span class="ads-baner-image">
                    <a href="' . $this->adsUrl . $ads['redirectUrl'] . '"><img src="' . $ads['base64'] . '"></a>
                </span>
            ';
        }

        $html .= '</div>';

        file_put_contents($lastUpdateLogFile, (new DateTimeImmutable())->format('Y-m-d H:i:s'));
        file_put_contents($cacheFileName, $html);

        return $html;
    }

    public function getContent()
    {
        $this->prepare();

        $cacheFileName = $this->cacheDirectory . DIRECTORY_SEPARATOR . $this->cacheFileName;
        $lastUpdateLogFile = $this->cacheDirectory . DIRECTORY_SEPARATOR . $this->lastUpdateLogFile;

        if ($this->isUseCache($cacheFileName, $lastUpdateLogFile)) {
            return file_get_contents($cacheFileName);
        } else {
            $data =  $this->getAdsData();
            return $this->generateContent($data, $lastUpdateLogFile, $cacheFileName);
        }
    }
}
