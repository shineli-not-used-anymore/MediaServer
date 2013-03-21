<?php
App::uses('AppModel', 'Model');

Class System extends AppModel {

/**
* shut down system
*
* @return void
*/
	public function shutDown()
	{
		exec('shutdown -h now');
	}
}
