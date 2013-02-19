<?php
App::uses('MediaFilesController', 'Controller');

/**
 * MediaFileController Test Case
 *
 */
class MediaFilesControllerTest extends ControllerTestCase {

    /**
     * test list method
     */
    public function testList()
    {
        $this->generate('MediaFiles',array(
            'models' => array(
                'MediaFile' => array(
                    'listAll'
                )
            )
        ));
        $list = array('dummmy list');
        $this->controller
            ->MediaFile
            ->expects($this->once())
            ->method('listAll')
            ->will($this->returnValue($list));
        $this->testAction('/MediaFiles');
        $this->assertEquals($list, $this->vars['list']);
    }

    /**
     * test play method
     */
    public function testPlay()
    {
        $this->generate('MediaFiles',array(
            'models' => array(
                'MediaFile' => array(
                    'open'
                )
            )
        ));
        $dummyFilePath = 'dummy file path';
        $this->controller
            ->MediaFile
            ->expects($this->once())
            ->method('open')
            ->with($dummyFilePath);
        $this->testAction('/MediaFiles/play/', array(
            'data' => array(
                'MediaFile' => array(
                    'path' => $dummyFilePath
                )
            )
        ));

    }
}
