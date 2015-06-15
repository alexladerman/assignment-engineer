<?php

require_once __DIR__.'/utils/HttpClient.php';
require_once __DIR__.'/IClient.php';

class Client implements IClient
{
    private $_apiUrl = 'https://api.etilbudsavis.dk/';
    private $_apiKey;
    private $_apiSecret;
    private $_session;
    private $_headers;

  /**
   * Initialize the client with api key and secret.
   *
   * @param string $key API key obtained from http://docs.api.etilbudsavis.dk/v2/docs/getting-started
   * @param string $secret API secret
   */
  public function initialize($key, $secret)
  {
      $this->_apiKey = $key;
      $this->_apiSecret = $secret;
  }

  /**
   * Sign in based on credentials.
   *
   * @param string $email email
   * @param string $password password
   */
  public function signIn($email, $password)
  {
      $fields = array(
      'api_key' => $this->_apiKey,
      'email' => $email,
      'password' => $password,
    );

      $this->_session = json_decode(HttpClient::Post($this->_apiUrl.'v2/sessions', $fields));

      $this->_headers = array(CURLOPT_HTTPHEADER => array(
      'X-Token: '.$this->_session->token,
      'X-Signature: '.$signature = hash('sha256', $this->_apiSecret.$this->_session->token),
      'Content-Type: application/json',
      'Accept: application/json',
      'Origin: localhost',
    ));
  }

  /**
   * Sign out.
   */
  public function signOut()
  {
      $fields = array('email' => '');

      $headers = array(CURLOPT_HTTPHEADER => array(
      'X-Token: '.$this->_session->token,
      'X-Signature: '.$signature = hash('sha256', $this->_apiSecret.$this->_session->token),
      'Origin: localhost',
    ));

      HttpClient::Put($this->_apiUrl.'v2/sessions', $fields, $headers);
  }

  /**
   * Deletes the session.
   */
  public function destroy()
  {
      HttpClient::Delete($this->_apiUrl.'v2/sessions', $this->_headers);
      $this->_session = null;
      $this->_headers = null;
  }

  //optionals:

  /**
   * Retrieves a list of publicly accessible catalogs.
   *
   * @param array $options For possible options see http://docs.api.etilbudsavis.dk/v2/docs/catalog-list
   *
   * @return mixed decoded JSON object
   */
  public function getCatalogList($options)
  {
      return json_decode(HttpClient::Get($this->_apiUrl.'v2/catalogs', $options, $this->_headers));
  }

    public function getCatalog($options)
    {
    }

    public function getStoreList($options)
    {
    }

    public function getStore($options)
    {
    }

    public function getOfferList($options)
    {
    }

    public function getOffer($options)
    {
    }

    public function getDealerList($options)
    {
    }

    public function getDealer($options)
    {
    }
}
