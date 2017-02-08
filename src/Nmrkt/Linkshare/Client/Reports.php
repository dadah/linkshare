<?php
/**
 * Created by PhpStorm.
 * User: ian
 * Date: 1/7/15
 * Time: 1:58 PM
 */

namespace Nmrkt\Linkshare\Client;

use Nmrkt\Linkshare\Client as LinkshareClient;
use GuzzleHttp\Event\SubscriberInterface;
use GuzzleHttp\Query;

class Reports extends LinkshareClient
{
    /**
     * @var string
     *
     * formatted YYMMDD
     */
    private $bdate;

    /**
     * @var string
     *
     * formatted YYMMDD
     */
    private $edate;

    /**
     * @var string
     *
     * formatted Y-m-d H:i:s
     */
    private $token;

    /**
     * @var string | int
     */
    private $reportId;

    /**
     * @var string | int
     */
    private $limit;

    /**
     * @var string | int
     */
    private $page;

    /**
     * @return string
     */
    public function getBdate()
    {
        return $this->bdate;
    }

    /**
     * @param string bdate
     */
    public function setBdate($bdate)
    {
        $this->bdate = $bdate;
    }

    /**
     * @return int
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * @param int $reportId
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;
    }

    /**
     * @return string
     */
    public function getEdate()
    {
        return $this->edate;
    }

    /**
     * @param string $edate
     */
    public function setEdate($edate)
    {
        $this->edate = $edate;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return int|string
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int|string $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int|string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int|string $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }



    public function __construct($config = [])
    {
        parent::__construct('advancedreports', $config);
    }

    /**
     * @param array $params
     * @return array
     */
    public function getReports()
    {
        $response = $this->get('', [
            'query' => $this->createQueryString()
        ]);

        return $response->json();

    }

    private function createQueryString()
    {
        $q_string = '';
        $q_string .= isset($this->bdate) ? '&bdate=' . $this->bdate : '';
        $q_string .= isset($this->edate) ? '&edate=' . $this->edate : '';
        $q_string .= isset($this->token) ? '&token=' . $this->token : '';
        $q_string .= isset($this->reportId) ? '&reportid=' . $this->reportId : '';
        $q_string .= isset($this->limit) ? '&limit=' . $this->limit : '';
        $q_string .= isset($this->page) ? '&page=' . $this->page : '';


        return Query::fromString($q_string, false);
    }

}
