<?php


namespace Happyr\CloudFlareBundle\Service;


/**
 * Class CloudFlareService
 *
 * @author Tobias Nyholm
 *
 */
class CloudFlareService
{
    /**
     * Default options for curl.
     */
    public static $curlOptions = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_USERAGENT      => 'happyr-cloud-flare-bundle',
    );

    protected $url;

    protected $token;

    protected $email;

    /**
     * @param string $url
     * @param string $email
     * @param string $token
     */
    public function __construct($url, $email, $token)
    {
        $this->url = $url;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Make a API call to CloudFlare
     * @link https://www.cloudflare.com/docs/client-api.html
     *
     * @param $action
     * @param array $parameters
     *
     * @return mixed|null
     */
    public function api($action, array $parameters)
    {
        if (empty($this->email) || empty($this->token) || empty($this->url)) {
            return null;
        }

        //add some values
        $parameters['tkn']=$this->token;
        $parameters['email']=$this->email;
        $parameters['a']=$action;

        //prepare the data
        $postString='';
        foreach($parameters as $key=>$value) {
            $postString .= $key.'='.$value.'&';
        }
        $postString = rtrim($postString, '&');

        //add some options
        $opts=self::$curlOptions;
        $opts[CURLOPT_URL] = $this->url;
        $opts[CURLOPT_POST] = count($parameters);
        $opts[CURLOPT_POSTFIELDS] = $postString;

        //send the request
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $result = curl_exec($ch);
        curl_close($ch);

        //return the response
        return json_decode($result, true);
    }
}