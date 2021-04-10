<?php

namespace Unetway\Rates;

use GuzzleHttp\Client;
use Exception;

class Rates
{

    /**
     * @var string
     */
    private $daily = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @var string
     */
    private $full_valute_code = 'http://www.cbr.ru/scripts/XML_valFull.asp';

    /**
     * @var string
     */
    private $valute_code = 'http://www.cbr.ru/scripts/XML_val.asp';

    /**
     * @var string
     */
    private $dynamic = 'http://www.cbr.ru/scripts/XML_dynamic.asp';

    /**
     * @var string
     */
    private $ostat = 'http://www.cbr.ru/scripts/XML_ostat.asp';

    /**
     * @var string
     */
    private $metall = 'http://www.cbr.ru/scripts/xml_metall.asp';

    /**
     * @var string
     */
    private $mkr = 'http://www.cbr.ru/scripts/xml_mkr.asp';

    /**
     * @var string
     */
    private $depo = 'http://www.cbr.ru/scripts/xml_depo.asp';

    /**
     * @var string
     */
    private $news = 'http://www.cbr.ru/scripts/XML_News.asp';

    /**
     * @var string
     */
    private $bic = 'http://www.cbr.ru/scripts/XML_bic.asp';

    /**
     * @var string
     */
    private $swap = 'http://www.cbr.ru/scripts/xml_swap.asp';

    /**
     * @var string
     */
    private $coinsBase = 'http://www.cbr.ru/scripts/XMLCoinsBase.asp';

    /**
     * @var int
     */
    private $bicCountCode = 9;

    /**
     * Получение котировок на заданный день
     *
     * @param null $date_req
     * @return mixed
     */
    public function getDaily($date_req = null)
    {
        if (empty($date_req)) {
            return $this->getRequest($this->daily);
        }

        return $this->getRequest($this->daily, [
            'date_req' => $date_req,
        ]);
    }

    /**
     * Список включающий ISO коды валют
     *
     * @param int $d
     * @return mixed
     */
    public function getFullValuteCode($d = 0)
    {
        return $this->getRequest($this->full_valute_code, [
            'd' => $d,
        ]);
    }

    /**
     * Справочник по кодам валют
     *
     * @return mixed
     */
    public function getValuteCode()
    {
        return $this->getRequest($this->valute_code);
    }

    /**
     * Получение динамики котировок валюты по заданному VAL_NM_RQ
     *
     * @param $date_req1
     * @param $date_req2
     * @param $val_nm_rq
     * @return mixed
     * @throws Exception
     */
    public function getDynamic($date_req1, $date_req2, $val_nm_rq)
    {
        if (empty($date_req1)) {
            throw new Exception('Params date_reg1 is not defined');
        }

        if (empty($date_req2)) {
            throw new Exception('Params date_reg2 is not defined');
        }

        return $this->getRequest($this->dynamic, [
            'date_req1' => $date_req1,
            'date_req2' => $date_req2,
            'VAL_NM_RQ' => $val_nm_rq,
        ]);
    }

    /**
     * Получение динамики сведений об остатках средств на корреспондентских счетах кредитных организаций
     *
     * @param $date_req1
     * @param $date_req2
     * @return mixed
     * @throws Exception
     */
    public function getOstat($date_req1, $date_req2)
    {
        if (empty($date_req1)) {
            throw new Exception('Params date_reg1 is not defined');
        }

        if (empty($date_req2)) {
            throw new Exception('Params date_reg2 is not defined');
        }

        return $this->getRequest($this->ostat, [
            'date_req1' => $date_req1,
            'date_req2' => $date_req2,
        ]);
    }

    /**
     * Получение динамики котировок драгоценных металлов
     *
     * @param $date_req1
     * @param $date_req2
     * @return mixed
     * @throws Exception
     */
    public function getMetall($date_req1, $date_req2)
    {
        if (empty($date_req1)) {
            throw new Exception('Params date_reg1 is not defined');
        }

        if (empty($date_req2)) {
            throw new Exception('Params date_reg2 is not defined');
        }

        return $this->getRequest($this->metall, [
            'date_req1' => $date_req1,
            'date_req2' => $date_req2,
        ]);
    }

    /**
     * Получение динамики ставок межбанковского рынка
     *
     * @param $date_req1
     * @param $date_req2
     * @return mixed
     * @throws Exception
     */
    public function getMkr($date_req1, $date_req2)
    {
        if (empty($date_req1)) {
            throw new Exception('Params date_reg1 is not defined');
        }

        if (empty($date_req2)) {
            throw new Exception('Params date_reg2 is not defined');
        }

        return $this->getRequest($this->mkr, [
            'date_req1' => $date_req1,
            'date_req2' => $date_req2,
        ]);
    }

    /**
     * Получение динамики ставок привлечения средств по депозитным операциям Банка России на денежном рынке
     *
     * @param $date_req1
     * @param $date_req2
     * @return mixed
     * @throws Exception
     */
    public function getDepo($date_req1, $date_req2)
    {
        if (empty($date_req1)) {
            throw new Exception('Params date_reg1 is not defined');
        }

        if (empty($date_req2)) {
            throw new Exception('Params date_reg2 is not defined');
        }

        return $this->getRequest($this->depo, [
            'date_req1' => $date_req1,
            'date_req2' => $date_req2,
        ]);
    }

    /**
     * Получение новостей сервера
     *
     * @return mixed
     */
    public function getServerNews()
    {
        return $this->getRequest($this->news);
    }

    /**
     * Получение соответствия названий кредитных организаций кодам BIC (9 знаков)
     *
     * @param null $name
     * @param null $bic
     * @return mixed
     * @throws Exception
     */
    public function getBic($name = null, $bic = null)
    {
        if (!empty($bic)) {
            if (strlen($bic) > $this->bicCountCode) {
                throw new Exception('Params bic cannot be more than 9 characters');
            }
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
     * @param $date_req1
     * @param $date_req2
     * @return mixed
     * @throws Exception
     */
    public function getSwap($date_req1, $date_req2)
    {
        if (empty($date_req1)) {
            throw new Exception('Params date_reg1 is not defined');
        }

        if (empty($date_req2)) {
            throw new Exception('Params date_reg2 is not defined');
        }

        return $this->getRequest($this->swap, [
            'date_req1' => $date_req1,
            'date_req2' => $date_req2,
        ]);
    }

    /**
     * Получения динамики отпускных цен Банка России на инвестиционные монеты
     *
     * @param $date_req1
     * @param $date_req2
     * @return mixed
     * @throws Exception
     */
    public function getCoinsBase($date_req1, $date_req2)
    {
        if (empty($date_req1)) {
            throw new Exception('Params date_reg1 is not defined');
        }

        if (empty($date_req2)) {
            throw new Exception('Params date_reg2 is not defined');
        }

        return $this->getRequest($this->coinsBase, [
            'date_req1' => $date_req1,
            'date_req2' => $date_req2,
        ]);
    }

    /**
     * @param $url
     * @param null $params
     * @return mixed
     */
    private function getRequest($url, $params = null)
    {
        $client = new Client();

        if ($params) {
            $query = http_build_query($params);
            $url = $url . '?' . $query;
        }

        $response = $client->get($url)->getBody();

        $xml = simplexml_load_string($response);
        return json_decode(json_encode((array)$xml), TRUE);
    }

}