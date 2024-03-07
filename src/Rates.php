<?php

namespace Unetway\Rates;

use Exception;
use GuzzleHttp\Client;

class Rates
{

    /**
     * @var string
     */
    private string $daily = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @var string
     */
    private string $fullValuteCode = 'http://www.cbr.ru/scripts/XML_valFull.asp';

    /**
     * @var string
     */
    private string $valuteCode = 'http://www.cbr.ru/scripts/XML_val.asp';

    /**
     * @var string
     */
    private string $dynamic = 'http://www.cbr.ru/scripts/XML_dynamic.asp';

    /**
     * @var string
     */
    private string $ostat = 'http://www.cbr.ru/scripts/XML_ostat.asp';

    /**
     * @var string
     */
    private string $metall = 'http://www.cbr.ru/scripts/xml_metall.asp';

    /**
     * @var string
     */
    private string $mkr = 'http://www.cbr.ru/scripts/xml_mkr.asp';

    /**
     * @var string
     */
    private string $depo = 'http://www.cbr.ru/scripts/xml_depo.asp';

    /**
     * @var string
     */
    private string $news = 'http://www.cbr.ru/scripts/XML_News.asp';

    /**
     * @var string
     */
    private string $bic = 'http://www.cbr.ru/scripts/XML_bic.asp';

    /**
     * @var string
     */
    private string $swap = 'http://www.cbr.ru/scripts/xml_swap.asp';

    /**
     * @var string
     */
    private string $coinsBase = 'http://www.cbr.ru/scripts/XMLCoinsBase.asp';

    /**
     * @var int
     */
    private int $bicCountCode = 9;

    /**
     * Получение котировок на заданный день
     *
     * @param string|null $dateReq
     * @return array
     * @throws Exception
     */
    public function getDaily(?string $dateReq = null): array
    {
        if (empty($dateReq)) {
            return $this->getRequest($this->daily);
        }

        return $this->getRequest($this->daily, [
            'date_req' => $dateReq,
        ]);
    }

    /**
     * @param $url
     * @param null $params
     * @return array
     * @throws Exception
     */
    private function getRequest($url, $params = null): array
    {
        $client = new Client();

        if ($params) {
            $query = http_build_query($params);
            $url .= '?' . $query;
        }

        try {
            $response = $client->get($url);
        } catch (Exception $exception) {
            throw new Exception($exception);
        }

        $xml = simplexml_load_string($response->getBody());

        if ($xml === false) {
            throw new Exception('Failed to parse XML response');
        }

        return json_decode(json_encode((array)$xml), true);
    }

    /**
     * Список включающий ISO коды валют
     *
     * @param int $d
     * @return array
     * @throws Exception
     */
    public function getFullValuteCode(int $d = 0): array
    {
        return $this->getRequest($this->fullValuteCode, [
            'd' => $d,
        ]);
    }

    /**
     * Справочник по кодам валют
     *
     * @return array
     * @throws Exception
     */
    public function getValuteCode(): array
    {
        return $this->getRequest($this->valuteCode);
    }

    /**
     * Получение динамики котировок валюты по заданному VAL_NM_RQ
     *
     * @param string $dateReq1
     * @param string $dateReq2
     * @param string $valNmRq
     * @return array
     * @throws Exception
     */
    public function getDynamic(string $dateReq1, string $dateReq2, string $valNmRq): array
    {
        return $this->getRequest($this->dynamic, [
            'date_req1' => $dateReq1,
            'date_req2' => $dateReq2,
            'VAL_NM_RQ' => $valNmRq,
        ]);
    }

    /**
     * Получение динамики сведений об остатках средств на корреспондентских счетах кредитных организаций
     *
     * @param string $dateReq1
     * @param string $dateReq2
     * @return array
     * @throws Exception
     */
    public function getOstat(string $dateReq1, string $dateReq2): array
    {
        return $this->getRequest($this->ostat, [
            'date_req1' => $dateReq1,
            'date_req2' => $dateReq2,
        ]);
    }

    /**
     * Получение динамики котировок драгоценных металлов
     *
     * @param string $dateReq1
     * @param string $dateReq2
     * @return array
     * @throws Exception
     */
    public function getMetall(string $dateReq1, string $dateReq2): array
    {
        return $this->getRequest($this->metall, [
            'date_req1' => $dateReq1,
            'date_req2' => $dateReq2,
        ]);
    }

    /**
     * Получение динамики ставок межбанковского рынка
     *
     * @param string $dateReq1
     * @param string $dateReq2
     * @return array
     * @throws Exception
     */
    public function getMkr(string $dateReq1, string $dateReq2): array
    {
        return $this->getRequest($this->mkr, [
            'date_req1' => $dateReq1,
            'date_req2' => $dateReq2,
        ]);
    }

    /**
     * Получение динамики ставок привлечения средств по депозитным операциям Банка России на денежном рынке
     *
     * @param string $dateReq1
     * @param string $dateReq2
     * @return array
     * @throws Exception
     */
    public function getDepo(string $dateReq1, string $dateReq2): array
    {
        return $this->getRequest($this->depo, [
            'date_req1' => $dateReq1,
            'date_req2' => $dateReq2,
        ]);
    }

    /**
     * Получение новостей сервера
     *
     * @return array
     * @throws Exception
     */
    public function getServerNews(): array
    {
        return $this->getRequest($this->news);
    }

    /**
     * Получение соответствия названий кредитных организаций кодам BIC (9 знаков)
     *
     * @param string|null $name
     * @param string|null $bic
     * @return array
     * @throws Exception
     */
    public function getBic(?string $name = null, ?string $bic = null): array
    {
        if (!empty($bic) && strlen($bic) > $this->bicCountCode) {
            throw new Exception("Params bic cannot be more than {$this->bicCountCode} characters");
        }

        if (empty($bic) && empty($name)) {
            return $this->getRequest($this->bic);
        }

        return $this->getRequest($this->bic, [
            'bic' => $bic,
            'name' => $name,
        ]);
    }

    /**
     * Получение динамики ставок «валютный своп» — " Валютный своп buy/sell overnight"
     *
     * @param string $dateReq1
     * @param string $dateReq2
     * @return array
     * @throws Exception
     */
    public function getSwap(string $dateReq1, string $dateReq2): array
    {
        return $this->getRequest($this->swap, [
            'date_req1' => $dateReq1,
            'date_req2' => $dateReq2,
        ]);
    }

    /**
     * Получения динамики отпускных цен Банка России на инвестиционные монеты
     *
     * @param string $dateReq1
     * @param string $dateReq2
     * @return array
     * @throws Exception
     */
    public function getCoinsBase(string $dateReq1, string $dateReq2): array
    {
        return $this->getRequest($this->coinsBase, [
            'date_req1' => $dateReq1,
            'date_req2' => $dateReq2,
        ]);
    }

}