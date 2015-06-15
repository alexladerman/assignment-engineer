<?php

interface IClient
{
    /**
     * Initialize the client with api key and secret.
     */
    public function initialize($key, $secret);

    /**
     * Sign in based on credentials. CHANGED: to email and password which is more straightforward.
     */
    public function signIn($email, $password);

    /**
     * Sign out.
     */
    public function signOut();

    /**
     * Cleanup function.
     * Must destroy session.
     */
    public function destroy();

    //optionals:

    /**
     */
    public function getCatalogList($options);

    /**
     */
    public function getCatalog($options);

    /**
     */
    public function getStoreList($options);

    /**
     */
    public function getStore($options);

    /**
     */
    public function getOfferList($options);

    /**
     */
    public function getOffer($options);

    /**
     */
    public function getDealerList($options);

    /**
     */
    public function getDealer($options);
}
