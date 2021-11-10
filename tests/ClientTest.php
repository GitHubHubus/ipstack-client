<?php

namespace Tests;

use OK\Ipstack\Client;
use OK\Ipstack\Entity\Location;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClientTest extends TestCase
{
    protected Client $client;
    
    protected function setUp()
    {
        $this->client = new Client(self::API_KEY);
    }

    /**
     * @param string $protocol
     * @param string $ip
     * @param array $fields
     * @param string $language
     * @param string $format
     * 
     * @dataProvider getUrlProvider
     */
    public function testGetUrl($protocol, $ip, $fields, $language, $format)
    {
        $this->client->getParams()
                ->setProtocol($protocol)
                ->setFields($fields)
                ->setLanguage($language)
                ->setFormat($format)
                ->enableHostnameLookup();

        $expectation = "$protocol://" . Client::URL . "/$ip?access_key=test_api_key&fields=" . implode(',', $fields) . "&language=$language&output=$format&hostname=1&security=0";

        $this->assertEquals($expectation, $this->client->getUrl($ip));
    }

    /**
     * @param array $data
     * @param Location $result
     *
     * @dataProvider createLocationProvider
     */
    public function testCreateLocation($data, $result)
    {
        $createLocationMethod = $this->makeCallable($this->client, 'createLocation');
        
        $this->assertEquals($result, $createLocationMethod->invokeArgs($this->client, [$data]));
    }

    public function getUrlProvider()
    {
        return [
            ['http', '12.12.12.12', ['main'], 'en', 'json'],
            ['https', '12.12.12.12', ['country_name', 'country_code'], 'en', 'xml'],
            ['http', '12.12.12.12,234.123.123.123', [], 'en', 'json'],
        ];
    }
    
    public function createLocationProvider()
    {
        $location1 = new Location();
        $location1->setCity('Moscow')
                ->setValid(false)
                ->setContinentCode()
                ->setZip()
                ->setContinentName()
                ->setCallingCode()
                ->setCountryCode()
                ->setCountryName()
                ->setIp()
                ->setIsEu()
                ->setRegionCode()
                ->setRegionName()
                ->setLatitude()
                ->setLongitude()
                ->setHostname();
        
        $location2 = new Location();
        $location2->setCity('New York')
                ->setIp('211.234.3.4')
                ->setIsEu(false)
                ->setValid(true)
                ->setContinentCode()
                ->setZip()
                ->setContinentName()
                ->setCallingCode()
                ->setCountryCode()
                ->setCountryName()
                ->setRegionCode()
                ->setRegionName()
                ->setLatitude()
                ->setLongitude()
                ->setHostname();
        
        $location3 = new Location();
        $location3->setZip('25721')
                ->setIp('1.1.1.1')
                ->setCallingCode('1')
                ->setValid(false)
                ->setContinentCode()
                ->setContinentName()
                ->setCountryCode()
                ->setCountryName()
                ->setIsEu()
                ->setRegionCode()
                ->setRegionName()
                ->setLatitude()
                ->setLongitude()
                ->setCity()
                ->setHostname();
        
        return [
            [
                ['city' => 'Moscow'], $location1
            ],
            [
                ['city' => 'New York', 'ip' => '211.234.3.4', 'type' => 'ipv4', 'isEu' => false], $location2
            ],
            [
                ['zip' => '25721', 'ip' => '1.1.1.1', 'type' => null, 'calling_code' => '1'], $location3
            ]
        ];
    }
}

