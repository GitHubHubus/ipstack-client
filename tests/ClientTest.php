<?php

namespace OK\Ipstack\Tests;

use OK\Ipstack\Exception\InvalidApiException;
use OK\Ipstack\Client;
use OK\Ipstack\Entity\Location;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    const API_KEY = 'test_api_key';
    
    /**
     * @var Client 
     */
    protected $client;
    
    protected function setUp()
    {
        $this->client = new Client(self::API_KEY);
    }
    
    /**
     * Make private and protected function callable
     *
     * @param mixed $object
     * @param string $function
     * @return \ReflectionMethod
     */
    protected function makeCallable($object, $function)
    {
        $method = new \ReflectionMethod($object, $function);
        $method->setAccessible(true);

        return $method;
    }
    
    /**
     * Make private and protected property callable
     *
     * @param mixed $object
     * @param string $property
     * @return \ReflectionProperty
     */
    protected function makeCallableProperty($object, $property)
    {
        $property = new \ReflectionProperty($object, $property);
        $property->setAccessible(true);

        return $property;
    }

    public function testSetLanguage()
    {
        $this->assertEquals('en', $this->client->getLanguage());
        $this->client->setLanguage('ru');
        $this->assertEquals('ru', $this->client->getLanguage());
    }

    public function testAddField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->client, 'fields');
        
        $this->client->addField('country_name');
        
        $this->assertEquals(['main', 'country_name'], $fieldsProperty->getValue($this->client));
        
        $this->client->addField('country_name');
        
        $this->assertEquals(['main', 'country_name'], $fieldsProperty->getValue($this->client));
    }
    
    public function testRemoveField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->client, 'fields');
        
        $this->client->removeField('country_name');
        
        $this->assertEquals(['main'], $fieldsProperty->getValue($this->client));
        
        $this->client->removeField('country_name');
        
        $this->assertEquals(['main'], $fieldsProperty->getValue($this->client));
    }
    
    public function testSetField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->client, 'fields');
        
        $this->client->setFields(['country_name', 'country_code']);
        
        $this->assertEquals(['country_name', 'country_code'], $fieldsProperty->getValue($this->client));
    }
    
    public function testClearField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->client, 'fields');
        
        $this->client->clearFields();
        
        $this->assertEquals([], $fieldsProperty->getValue($this->client));
    }
    
    /**
     * @param string $key
     * @param string $protocol
     * @param string $ip
     * @param array $fields
     * @param string $language
     * 
     * @dataProvider getUrlProvider
     */
    public function testGetUrl($key, $protocol, $ip, $fields, $language)
    {
        $client = new Client($key, $protocol, $fields, $language);
        
        $this->assertEquals("{$protocol}://" . Client::URL . "/{$ip}?access_key={$key}&fields=" . implode(',', $fields) . "&language={$language}", $client->getUrl($ip));
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
            ['key1', 'http', '12.12.12.12', ['main'], 'en'],
            ['key1', 'https', '12.12.12.12', ['country_name', 'country_code'], 'en'],
            ['key1', 'http', '12.12.12.12,234.123.123.123', [], 'en'],
        ];
    }
    
    public function createLocationProvider()
    {
        $location1 = new Location();
        $location1->setCity('Moscow')
                ->setValid(false);
        
        $location2 = new Location();
        $location2->setCity('New York')
                ->setIp('211.234.3.4')
                ->setValid(true);
        
        $location3 = new Location();
        $location3->setZip('25721')
                ->setIp('1.1.1.1')
                ->setValid(false);
        
        return [
            [
                ['city' => 'Moscow'], $location1
            ],
            [
                ['city' => 'New York', 'ip' => '211.234.3.4', 'type' => 'ipv4'], $location2
            ],
            [
                ['zip' => '25721', 'ip' => '1.1.1.1', 'type' => null], $location3
            ]
        ];
    }
}

