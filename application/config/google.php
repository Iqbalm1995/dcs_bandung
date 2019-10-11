<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '824732929351-6j48ti5712qu6gd7pbn4qrcgm18t408u.apps.googleusercontent.com';
$config['google']['client_secret']    = '7Ikqc-gEsTbxPiv7pZQRQSb6';
$config['google']['redirect_uri']     = 'http://localhost/dcs_bandung/user_authentication';
$config['google']['application_name'] = 'Daily Activity Service';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();