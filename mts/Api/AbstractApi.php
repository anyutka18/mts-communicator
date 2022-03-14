<?php
namespace MTS;

use MTS\MTSCClient;

/**
 * Class AbstractApi
 * @package Tmdb\Api
 */
abstract class AbstractApi
{
    /**
     * The client
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param Client $client
     */
    public function __construct(MTSCClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send a POST request
     *
     * @param  string $url
     * @param  array  $body
     * @param  array  $headers
     * @return mixed
     */
   
    public function post($url, $body, $headers = array())
    {
        $cl = $this->client;
        $post_url = $cl->geturi().$url;
        $ch = curl_init($post_url);
        $post = json_encode($body,JSON_UNESCAPED_UNICODE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cl->header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1); // Specify the request method as POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post); // Set the posted fields
         $result = curl_exec($ch); // Execute the cURL statement
       curl_close($ch); // Close the cURL connection
       $cl->logger->write($result);
        $cl->logger->write($post);
       return json_decode($result); // Return the received data
    }

    /**
     * Send a GET request
     *
     * @param  string $path
     * @param  array  $params
     * @param  array  $headers
     * @return mixed
     */

    public function  get($url, $params, $headers = array())
    {

    }


    /**
     * Retrieve the client
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

}
