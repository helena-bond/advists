<?php

class Soap {

    private static $_soapClient;

    private static function getSoapClient() {
        if (self::$_soapClient === NULL) {
            self::$_soapClient = new SoapClient('http://192.168.7.15:8081/UserWCFRepository.svc?singleWsdl');
        }
        return self::$_soapClient;
    }

    /*
     * Used just for testing
     * TODO: REMOVE
     */
    public static function debug($args) {
        if (is_array($args) || is_object($args)) {
            echo '<pre>';
            print_r($args);
            echo '</pre>';
        }else
            echo $args;
    }

    /*
     * Used just for testing
     * TODO: REMOVE
     */
    public static function getSoapFunctions() {
        $client = self::getSoapClient();
        self::debug($client->__getFunctions());
    }

    /*
     * Gets all users and their info from a divice provided in params
     * Params: ip, port
     */
    public static function getAllUsersData($params) {
        $client = self::getSoapClient();
        self::debug($client->GetAllUserDatas($params));
    }

    
    
    /*
     * Registers new user in a divice provided in params
     * Params: ip, port, enrollNumber, name, cardNumber
     */
    public static function registerNewUser($params) {
        $client = self::getSoapClient();
        return $client->RegisterNewUser($params);
    }

    
    
    /*
     * Deletes a user in a divice provided in params
     * Params: ip, port, enrollNumber
     */
    public static function deleteUser($params) {
        $client = self::getSoapClient();
        $client->DeleteUserData($params);
    }

    
    
    /*
     * Activates a user in a divice provided in params
     * Params: ip, port, enrollNumber
     */
    public static function activateUser($params) {
        $client = self::getSoapClient();
        $client->EnableUser($params);
    }
    
    

    /*
     * Deactivates a user in a divice provided in params
     * Params: ip, port, enrollNumber
     */
    public static function deactivateUser($params) {
        $client = self::getSoapClient();
        $client->DisableUser($params);
    }

    
    
    /*
     * Syncs all active contollers time
     * Params: no params
     */
   public static function syncActiveControllersTime() {
        $client = self::getSoapClient();
        $client->SynchronizeAllEnabledControllersTime();
    }

    
    
    /*
     * Gets time in a divice provided in params
     * Params: ip, port
     */
    public static function getControllerTime($params) {
        $client = self::getSoapClient();
        self::debug($client->GetControllerTime($params));
    }

}
