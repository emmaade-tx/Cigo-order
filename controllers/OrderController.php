<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Order;
use app\models\ContactForm;

class OrderController extends Controller
{
     /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $orders = new Order();

        var_dump($orders); die;
    }
}