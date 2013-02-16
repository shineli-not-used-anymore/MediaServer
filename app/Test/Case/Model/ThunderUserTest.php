<?php
App::uses('ThunderUser', 'Model');

/**
 * ThunderUser Test Case
 *
 */
class ThunderUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.thunder_user',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ThunderUser = ClassRegistry::init('ThunderUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ThunderUser);

		parent::tearDown();
	}

}
