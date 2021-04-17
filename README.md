# Валюты

Пакет позволяет получить курс валют через [API ЦРБ](http://www.cbr.ru/development/sxml/)


## Установка

````
$ composer require unetway/rates
````

## Использование


#### Получение котировок на заданный день

Если дата отсутствует, то вы получите документ на последнюю зарегистрированную дату.

**Параметры:**

- date_req дата запроса (dd/mm/yyyy)

````
use Unetway\Rates\Rates;

$date_req = '03/04/2021';

$rates = new Rates();
$res = $rates->getDaily($date_req);

echo $res;
````

#### Список включающий ISO коды валют

**Параметры:**

- d=0 Коды валют устанавливаемые ежедневно
- d=1 Коды валют устанавливаемые ежемесячно

````
use Unetway\Rates\Rates;

$d = 0;
$rates = new Rates();
$res = $rates->getFullValuteCode($d);

echo $res;
````


#### Справочник по кодам валют

````
use Unetway\Rates\Rates;

$rates = new Rates();
$res = $rates->getValuteCode();

echo $res;
````

#### Получение динамики котировок валюты по заданному VAL_NM_RQ

**Параметры:**

- date_req1 и date_req2 диапазон дат (dd/mm/yyyy)
- VAL_NM_RQ уникальный ISO код валюты

````
use Unetway\Rates\Rates;

$date_req1 = '02/03/2001';
$date_req2 = '14/03/2001';
$val_nm_rq = 'R01235';

$rates = new Rates();
$res = $rates->getDynamic($date_req1, $date_req2, $val_nm_rq);

echo $res;
````

#### Получение динамики сведений об остатках средств на корреспондентских счетах кредитных организаций

**Параметры:**

- date_req1 и date_req2 диапазон дат (dd/mm/yyyy)

````
use Unetway\Rates\Rates;

$date_req1 = '02/03/2001';
$date_req2 = '14/03/2001';

$rates = new Rates();
$res = $rates->getOstat($date_req1, $date_req2);

echo $res;
````

#### Получение динамики котировок драгоценных металлов

**Параметры:**

- date_req1 и date_req2 диапазон дат (dd/mm/yyyy)

````
use Unetway\Rates\Rates;

$date_req1 = '02/03/2001';
$date_req2 = '14/03/2001';

$rates = new Rates();
$res = $rates->getMetall($date_req1, $date_req2);

echo $res;
````

#### Получение динамики ставок межбанковского рынка

**Параметры:**

- date_req1 и date_req2 диапазон дат (dd/mm/yyyy)

````
use Unetway\Rates\Rates;

$date_req1 = '02/03/2001';
$date_req2 = '14/03/2001';

$rates = new Rates();
$res = $rates->getMkr($date_req1, $date_req2);

echo $res;
````

#### Получение динамики ставок привлечения средств по депозитным операциям Банка России на денежном рынке

**Параметры:**

- date_req1 и date_req2 диапазон дат (dd/mm/yyyy)

````
use Unetway\Rates\Rates;

$date_req1 = '02/03/2001';
$date_req2 = '14/03/2001';

$rates = new Rates();
$res = $rates->getDepo($date_req1, $date_req2);

echo $res;
````

#### Получение новостей сервера

````
use Unetway\Rates\Rates;

$rates = new Rates();
$res = $rates->getServerNews();

echo $res;
````


#### Получение соответствия названий кредитных организаций кодам BIC (9 знаков)

**Параметры:**

- bic код кредитной организации (9 знаков)
- name название (часть названия) кредитной организации

Вы можете указать какой — либо один или оба параметра.

Если оба параметра отсутствуют, тогда Вы получите полный список соответствия названий кредитных организации и кодов BIC.

````
use Unetway\Rates\Rates;

$name = 'АВТО';
$bic = '044525774';

$rates = new Rates();
$res = $rates->getBic($name, $bic);

echo $res;
````

#### Получение динамики ставок «валютный своп» — " Валютный своп buy/sell overnight"

**Параметры:**

- date_req1 и date_req2 диапазон дат (dd/mm/yyyy)

````
use Unetway\Rates\Rates;

$date_req1 = '02/03/2001';
$date_req2 = '14/03/2001';

$rates = new Rates();
$res = $rates->getSwap($date_req1, $date_req2);

echo $res;
````

#### Получения динамики отпускных цен Банка России на инвестиционные монеты

**Параметры:**

- date_req1 и date_req2 диапазон дат (dd/mm/yyyy)

````
use Unetway\Rates\Rates;

$date_req1 = '02/03/2001';
$date_req2 = '14/03/2001';

$rates = new Rates();
$res = $rates->getCoinsBase($date_req1, $date_req2);

echo $res;
````


