<?php

namespace Happyr\CloudFlareBundle\Tests\Service;

use Happyr\CloudFlareBundle\Service\CloudFlareService;
use Mockery as m;

/**
 * Class CloudFlareServiceTest
 *
 * @author Tobias Nyholm
 *
 */
class CloudFlareServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testApi()
    {
        $constructParams=array('url', 'email', 'token');
        $postString='abc=def&tkn=token&email=email&a=foobar';

        $expectedParams=CloudFlareService::$curlOptions;
        $expectedParams[CURLOPT_URL] = 'url';
        $expectedParams[CURLOPT_POST] = 4;
        $expectedParams[CURLOPT_POSTFIELDS] = $postString;

        $service=$this->getMock('Happyr\CloudFlareBundle\Service\CloudFlareService', array('sendRequest'), $constructParams);
        $service
            ->expects($this->once())
            ->method('sendRequest')
            ->with($this->equalTo($expectedParams))
            ->will($this->returnValue(json_encode(array('baz'=>'success'))));

        $service->api('foobar', array('abc'=>'def'));
    }


    public function testApiEmptyParams()
    {
        $service=new CloudFlareService(null, 'foo', 'bar');
        $this->assertNull($service->api('foobar', array()), 'Should return null when url is not set.');

        $service=new CloudFlareService('', 'foo', 'bar');
        $this->assertNull($service->api('foobar', array()), 'Should return null when url is not set.');

        $service=new CloudFlareService('foo', null, 'bar');
        $this->assertNull($service->api('foobar', array()), 'Should return null when email is not set.');

        $service=new CloudFlareService('foo', 'bar', null);
        $this->assertNull($service->api('foobar', array()), 'Should return null when token is not set.');
    }
}