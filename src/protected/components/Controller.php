<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this.
 */
class Controller extends CController
{

	/**
	 * @var string the default layout for the controller view
	 */
	public $layout = '//layouts/main';

	/**
	 * @var array context menu items. This property will be assigned to 
	 * {@link CMenu::items}.
	 */
	public $menu = array();

	/**
	 * @var array the breadcrumbs of the current page. The value of this 
	 * property will be assigned to {@link CBreadcrumbs::links}. Please refer 
	 * to {@link CBreadcrumbs::links} for more details on how to specify this 
	 * property.
	 */
	public $breadcrumbs = array();

	/**
	 * @var SimpleJsonRpcClient\Client the JSON-RPC client
	 */
	protected $jsonRpcClient;

	/**
	 * Initializes the controller
	 */
	public function init()
	{
		parent::init();

		// Set up the JSON-RPC client
		$xbmcParams = Yii::app()->params['xbmc'];
		$endpoint = 'http://'.$xbmcParams['hostname'].':'.$xbmcParams['port']
				.'/jsonrpc';

		$this->jsonRpcClient = new SimpleJsonRpcClient\Client($endpoint, $xbmcParams['username'], $xbmcParams['password']);
	}

	/**
	 * Wrapper for \SimpleJsonRpcClient\Request
	 * @param string $method
	 * @param mixed $params
	 * @param mixed $id
	 * @return \SimpleJsonRpcClient\Response
	 */
	protected function performRequest($method, $params = null, $id = 0)
	{
		$request = new SimpleJsonRpcClient\Request($method, $params, $id);
		return $this->jsonRpcClient->performRequest($request);
	}
	
	protected function getAbsoluteVfsUrl($relativeUrl)
	{
		$xbmcParams = Yii::app()->params['xbmc'];

		return 'http://'.$xbmcParams['hostname'].':'.$xbmcParams['port']
				.'/'.$relativeUrl;
	}

}