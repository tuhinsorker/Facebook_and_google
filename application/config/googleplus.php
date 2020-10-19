<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| Developer by Md Tuhin sarker <tuhinsorker92@gmail.com>
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|
| To get an Google app details you have to create a Google app
| at Google developers panel (https://developers.Google.com)
|
|  application_name        string   Set login type. (web)
|  client_id               string   Your Google client_id.
|  client_secret           string   Your Google  client_secret.
|  redirect_uri   		   string   URL to redirect back to after login. (do not include base URL)
|  api_key           	   string   Set api key.
|  scopes           	   string   Set scopes. (profile,email)
*/

$ci =& get_instance();
$googleplus = $ci->db->select('*')->from('social_auth')->where('id',2)->where('status',1)->get()->row();

$config['googleplus']['application_name'] = 'web';
$config['googleplus']['client_id']        = @$googleplus->app_id;
$config['googleplus']['client_secret']    = @$googleplus->app_secret;
$config['googleplus']['redirect_uri']     = base_url().'registration/googl_login/';
$config['googleplus']['api_key']          = @$googleplus->api_key;
$config['googleplus']['scopes']           = array('profile','email');

