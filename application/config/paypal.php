<?php
/** set your paypal credential **/

$config['client_id'] = 'AewXvr3POnKBUopd9LjgPEzh4M8u4M-QbcvsGK7lSmn4JwICLtHRqJVQZQZ4rvtE5I3aAUOHcB143VZX';
$config['secret'] = 'EBzKMRSCxW3QT9I97Rw4qXYMvaZlscy4GNz6F25Rab2o3SAmDDd-QyQb4mEt2g4WGU-xq90PgE9mA3qK';

/**
 * SDK configuration
 */
/**
 * Available option 'sandbox' or 'live'
 */
$config['settings'] = array(

    'mode' => 'sandbox',
    /**
     * Specify the max request time in seconds
     */
    'http.ConnectionTimeOut' => 1000,
    /**
     * Whether want to log to a file
     */
    'log.LogEnabled' => true,
    /**
     * Specify the file that want to write on
     */
    'log.FileName' => 'application/logs/paypal.log',
    /**
     * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
     *
     * Logging is most verbose in the 'FINE' level and decreases as you
     * proceed towards ERROR
     */
    'log.LogLevel' => 'FINE'
);
