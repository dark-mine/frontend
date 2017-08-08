<?php

namespace app\controllers;

use GuzzleHttp\Client;
use yii\filters\AccessControl;
use yii\web\Controller;

class ApiController extends Controller {
	
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}
	
	public function actionTest() {
		$client = new Client([
			'base_uri' => 'http://helpdesk.nemo.travel',
		]);
		
		$response = $client->get('/issues.json', [
			'query' => [
				'key' => \Yii::$app->params['apiKey'],
				'assigned_to_id' => 'me'
			]
		]);
		
		return $response->getBody()->getContents();
	}
}