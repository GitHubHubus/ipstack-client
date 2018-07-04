<?php

namespace Tests\Entity;

use Tests\TestCase;
use OK\Ipstack\Entity\ParameterBag;

/** 
 * @author Oleg Kochetkov <oleg.kochetkov999@yandex.ru>
 */
class ParameterBagTest extends TestCase
{
    /**
     * @var ParameterBag
     */
    private $params;
    
    protected function setUp()
    {
        $this->params = new ParameterBag(self::API_KEY);
    }

    public function testSetLanguage()
    {
        $this->assertEquals('en', $this->params->getLanguage());
        $this->params->setLanguage('ru');
        $this->assertEquals('ru', $this->params->getLanguage());
    }

    public function testAddField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->params, 'fields');
        
        $this->params->addField('country_name');
        
        $this->assertEquals(['country_name'], $fieldsProperty->getValue($this->params));
        
        $this->params->addField('country_name');
        
        $this->assertEquals(['country_name'], $fieldsProperty->getValue($this->params));
    }
    
    public function testRemoveField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->params, 'fields');
        
        $this->params->removeField('country_name');
        
        $this->assertEquals([], $fieldsProperty->getValue($this->params));
        
        $this->params->addField('country_name');
        
        $this->assertEquals(['country_name'], $fieldsProperty->getValue($this->params));
        
        $this->params->removeField('country_name');
        
        $this->assertEquals([], $fieldsProperty->getValue($this->params));
    }
    
    public function testSetField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->params, 'fields');
        
        $this->params->setFields(['country_name', 'country_code']);
        
        $this->assertEquals(['country_name', 'country_code'], $fieldsProperty->getValue($this->params));
    }
    
    public function testClearField()
    {
        $fieldsProperty = $this->makeCallableProperty($this->params, 'fields');
        
        $this->params->clearFields();
        
        $this->assertEquals([], $fieldsProperty->getValue($this->params));
    }
}
