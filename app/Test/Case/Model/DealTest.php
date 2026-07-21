<?php
/* Deal Test cases generated on: 2014-04-04 16:54:37 : 1396630477*/
App::uses('Deal', 'Model');

/**
 * Deal Test Case
 *
 */
class DealTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.deal');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Deal = ClassRegistry::init('Deal');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Deal);

		parent::tearDown();
	}

}
