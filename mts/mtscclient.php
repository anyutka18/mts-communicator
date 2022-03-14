<?php

namespace Mts;
use Mts\Sms;
use Mts\MTSCLog;


/**
 * The MTC API Client
 *
 * Example:
 *
 * $menu = $MTC->NomenclatureApi()->getMenu($organization['id']);
 * $MTC->OrdersApi()->checkAddress($organization['id'], [
 *     "city" => "Москва",
 *     "street" => "Планетарная",
 *     "home" => "1"
 * ]);
 * $cities = $MTC->CitiesApi()->getCitiesWithStreets($organization['id']);
 * $res = $MTC->OrdersApi()->addOrder([
 *     'organization' => $organization['id'],
 *     'customer' => ['name' => 'test', 'phone' => 'Phone'],
 *     'order' => ['phone' => 'Phone'],
 * ]);
 * $res = $MTC->OrdersApi()->getDeliveryOrders($organization['id'], [
 *     'dateFrom' => '2020-04-09',
 *     'dateTo' => '2020-04-09',
 * ]);
 * $res = $MTC->SettingsApi()->getSupportedProtocols($organization['id']);
 * $res = $MTC->DeliverySettingsApi()->getDeliveryDiscounts($organization['id']);
 */
class MTSCClient
{
     private $default_uri = 'api.mcommunicator.ru';
 /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $options;

    /**
     * @var string
     */
    private $token = 'af76bed1-11d2-464b-9eff-616ed537ff1c';

    public $header = array();

   public $logger;
    const MAX_RETRIES = 1;

    /**
     * Construct the MTC Client
     *
     * @param array $config
     * @param bool $autoTokening
     */
    public function __construct($registry,array $options = [])
    {
        $this->config = $registry->get('config');
        $this->options = $options;
		$options['logging']=DIR_LOGS.'MTC.log';
        if (isset($options['logging']) && is_string($options['logging'])) {
            $this->logger = new MTSCLog($options['logging']);
        }

        $this->setheader();
    }


    /**
     * @return string
     */
    public function getToken(): string
    {
    
        return $this->token;
    }

    public function setheader()
    {
        $token = $this->getToken();
        $authorization = "Authorization: Bearer $token";
        $this->header = array('Content-Type: application/json' , $authorization );
   
    }

    public function pushheader($header)
    {
        array_push($this->header, $header);

        return $this->header;
    }

    /**
     * @return Sms
     */
    public function SmsApi(): Sms
    {
        return new Sms($this);
    }

    public function geturi(){
        return $this->default_uri;
    }
}
