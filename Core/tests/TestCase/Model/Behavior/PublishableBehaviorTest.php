<?php

namespace Croogo\Core\Test\TestCase\Model\Behavior;

use Croogo\Core\TestSuite\CroogoTestCase;

class PublishableBehaviorTest extends CroogoTestCase
{

    public $fixtures = [
//      'plugin.Croogo/Settings.Setting',
//      'plugin.Croogo/Core.OrderRecord',
    ];

    /**
     * setUp
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
//      $this->OrderRecord = ClassRegistry::init('OrderRecord');
//      $this->OrderRecord->Behaviors->load('Croogo.Publishable', array(
//          'fields' => array(
//              'publish_start' => 'start',
//              'publish_end' => 'end',
//          ),
//      ));
    }

    /**
     * tearDown
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->OrderRecord);
//      ClassRegistry::flush();
    }

    /**
     * testPeriodFilter
     */
    public function testPeriodFilter()
    {
        $this->markTestIncomplete('This test needs to be ported to CakePHP 3.0');

        $results = $this->OrderRecord->find('all', [
            'date' => '2014-01-31 06:59:59',
        ]);
        $this->assertEquals(1, count($results));

        $results = $this->OrderRecord->find('all', [
            'date' => '2014-01-31 07:00:01',
        ]);
        $this->assertEquals(2, count($results));

        $results = $this->OrderRecord->find('all', [
            'date' => '2014-01-31 07:11:01',
        ]);
        $this->assertEquals(3, count($results));

        $results = $this->OrderRecord->find('all', [
            'date' => '2014-01-31 09:11:30',
        ]);
        $this->assertEquals(2, count($results));

        $results = $this->OrderRecord->find('all', [
            'date' => '2014-01-31 09:13:45',
        ]);
        $this->assertEquals(3, count($results));
    }
}
