<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 1/7/15
 * Time: 2:28 PM
 */

namespace Nmrkt\Tests\Linkshare\Client;

use Nmrkt\Tests\ClientTestCase;

use Nmrkt\Linkshare\Client\Reports;

/**
 * Class EventsTest
 * @package Nmrkt\Tests\Linkshare\Client
 */
class ReportsTest extends ClientTestCase
{

    /**
     * @var Nmrkt\Linkshare\Client\Reports
     */
    protected $linkshare_client;

    /**
     *
     */
    public function setup()
    {
        $config = [
            'username' => 'nmrkt',
            'password' => 'password',
            'client_id' => 'your client id',
            'client_secret' => 'your client secret',
            'scope' => 'your scope(s)', // optional
        ];
        $this->linkshare_client = new Reports($config);

        $this->linkshare_client->getEmitter()->attach($this->getHistoryObject());
    }

    /**
     *
     */
    public function testSetsBaseUrlToReports()
    {
        $base_url = $this->linkshare_client->getBaseUrl();

        $this->assertEquals('https://api.rakutenmarketing.com/advancedreports/1.0/', $base_url);
    }

    /**
     *
     */
    public function testGetreportsSetsRequestBodyCorrectly()
    {
        //add the mock to fake a response
        $this->addClientMock(new \GuzzleHttp\Stream\Stream(fopen(RESOURCE_PATH . '/linkshare-response.json', 'r')));

        //get the mocked subscriber from parent and attach
        $this->linkshare_client->getEmitter()->attach($this->getMockObject());

        $date = date('Ymd');
        $token = 'atoken';
        $reportId = 14;

        $this->linkshare_client->setBdate($date);
        $this->linkshare_client->setEdate($date);
        $this->linkshare_client->setToken($token);
        $this->linkshare_client->setReportId($reportId);
        $this->linkshare_client->setLimit(1000);


        $this->linkshare_client->getReports();

        $history = $this->getHistoryObject();

        $request = $history->getLastRequest();

        $this->assertEquals('https://api.rakutenmarketing.com/advancedreports/1.0/?bdate='.$date.'&edate='.$date.'&token='.$token.'&reportid='.$reportId.'&limit=1000', $request->getUrl());

    }
}
