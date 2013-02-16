<?php
App::uses('MediaFile', 'Model');

/**
 * MediaFile Test Case
 *
 * @property MediaFile $MediaFile
 */
class MediaFileTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
    public function setUp() {
        parent::setUp();
        $this->MediaFile = ClassRegistry::init('MediaFile');
    }

/**
 * tearDown method
 *
 * @return void
 */
    public function tearDown() {
        unset($this->MediaFile);

        parent::tearDown();
    }

/**
 * testListAll method
 *
 * @return void
 */
    public function testListAll() {
        $this->assertInternalType('array', $this->MediaFile->listAll());
    }

/**
 * test open method
 * @return void
 */
    public function testOpen() {
        $this->MediaFile->open(__DIR__ . '/test.mp3');
    }
}
