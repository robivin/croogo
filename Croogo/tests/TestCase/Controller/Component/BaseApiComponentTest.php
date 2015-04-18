<?php

namespace Croogo\Croogo\Test\TestCase\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\Controller;
use Croogo\Croogo\Controller\Component\BaseApiComponent;
use Croogo\Croogo\TestSuite\CroogoTestCase;
class TestApiComponent extends BaseApiComponent {

	protected $_apiVersion = 'v1.0';

	protected $_apiMethods = array(
		'index',
		'view',
		'delete',
	);
}

class TestBaseApiController extends Controller {

	public $components = array('TestApi');

	public function index() {
	}

	public function view() {
	}

}

class BaseApiComponentTest extends CroogoTestCase {

	public $fixtures = array(
		'plugin.croogo/settings.setting',
	);

	public function setUp() {
		parent::setUp();
		$request = $this->_apiRequest(array(
			'api' => 'api', 'prefix' => 'v1.0',
			'controller' => 'users', 'action' => 'index',
		));
		$response = $this->getMock('CakeRespone');

		$this->Controller = new TestBaseApiController($request, $response);
		$this->Controller->constructClasses();
		$this->Controller->startupProcess();
		$this->TestApi = $this->Controller->TestApi;
	}

	public function testControllerMethodInjection() {
		$expected = array(
			'index', 'view', 'v1_0_index', 'v1_0_view', 'v1_0_delete',
		);
		$this->assertEquals($expected, $this->Controller->methods);
	}

	public function testVersion() {
		$this->assertEquals('v1.0', $this->TestApi->version());
	}

	public function testApiMethods() {
		$expected = array('index', 'view', 'delete');
		$this->assertEquals($expected, $this->TestApi->apiMethods());
	}

	public function testIsValidAction() {
		$this->assertEquals(true, $this->TestApi->isValidAction('index'));
		$this->assertEquals(false, $this->TestApi->isValidAction('bogus'));
	}

}
