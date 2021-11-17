<?php

namespace Tests\Entity\Dto;

use OK\Ipstack\Entity\Dto\Location;
use OK\Ipstack\Entity\Dto\LocationFactory;
use Tests\TestCase;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class LocationFactoryTest extends TestCase
{
    public function testCreateArray()
    {
        $locationMock = $this->createMock(Location::class);
        $locationMock2 = $this->createMock(Location::class);
        $factory = $this->getMockBuilder(LocationFactory::class)
                        ->onlyMethods(['create'])
                        ->getMock();

        $map = [
            [['ip' => '127.0.0.1'], $locationMock],
            [['ip' => '127.0.0.2'], $locationMock2]
        ];

        $factory->expects($this->exactly(2))->method('create')->will($this->returnValueMap($map));

        $this->assertEquals([$locationMock, $locationMock2], $factory->createArray([['ip' => '127.0.0.1'], ['ip' => '127.0.0.2']]));
    }

    public function testCreate()
    {
        $data = [
            'city' => 'test_city',
            'hostname' => 'test_host',
            'zip' => 'test_zip',
            'type' => 'ipv4'
        ];

        $factory = new LocationFactory();
        $location = $factory->create($data);

        $this->assertEquals('test_city', $location->getCity());
        $this->assertEquals('test_host', $location->getHostname());
        $this->assertEquals('test_zip', $location->getZip());
        $this->assertEquals(true, $location->isValid());
    }
}
