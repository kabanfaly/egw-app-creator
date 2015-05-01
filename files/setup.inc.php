<?php

$setup_info['TO_CHANGE']['name'] = 'TO_CHANGE';
$setup_info['TO_CHANGE']['title'] = 'TO_CHANGE';
$setup_info['TO_CHANGE']['version'] = '1.001';
$setup_info['TO_CHANGE']['app_order'] = 10; 
$setup_info['pushoffres']['license']  = 'GPL';
//$setup_info['TO_CHANGE']['tables'] = array('TO_CHANGE');
$setup_info['TO_CHANGE']['enable'] = 1;


//menu definition
$setup_info['TO_CHANGE']['hooks'][] = 'sidebox_menu';

/* Dependencies for this app to work */
$setup_info['TO_CHANGE']['depends'][] = array(
'appname' => 'phpgwapi',
'versions' => Array('1.8')
);

$setup_info['TO_CHANGE']['depends'][] = array(
'appname' => 'etemplate',
'versions' => Array('1.8')
);

