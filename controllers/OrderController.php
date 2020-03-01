<?php

namespace app\controllers;

use Yii;
use app\models\Order;
use app\models\Status;
use app\models\Country;
use app\models\OrderType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\geocodio;


/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'geocoder' => ['GET'],
                    'getorders' => ['GET'],
                    'datatableorders' => ['GET']
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixe
     * 
     */
    public function actionIndex()
    {
        $orderTypes = OrderType::find()->all();
        $countries = Country::find()->all();

        return $this->render('index', ['orderTypes' => $orderTypes, 'countries' => $countries]);
    }

    /**
     * Get latitude and longitude.
     * @param string $city
     * @param string $state
     * @param string $address
     * @param string $country
     * 
     * @return obj
     */
    public function actionGeocoder($city, $state, $address, $country)
    {
        try {
            $fullAddress = $address . " " . $city . " " . $state . " " . $country;
            $geocoder = new \Geocodio\Geocodio();
            $geocoder->setApiKey(\Yii::$app->params['geocodeApiKey']);
            $response = $geocoder->geocode($fullAddress);
            
            echo json_encode($response->results[0]->location);
          }
          //catch exception
          catch(\Exception $e) {
              echo json_encode($e->getMessage());
          }
    }

    /**
     * Get orders model.
     * @return mixed
     */
    public function actionGetorders() {
        $orders = Order::find()->all();
        if ($orders) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $orders;
        }
    }

    /**
     * Get orders model.
     * @return mixed
     */
    public function actionDatatableorders() {
        $orders = Order::find()->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $csrfTokenName = \Yii::$app->request->csrfParam;
        $csrfToken = \Yii::$app->request->getCsrfToken();
        $data = [];
        foreach($orders as $order) {
            $newOrder = [];
            $newOrder['id'] = $order->id;
            $newOrder['first_name'] = $order->first_name;
            $newOrder['last_name'] = $order->last_name;
            $newOrder['scheduled_date'] = $order->scheduled_date;
            $newOrder['status_id'] = $order->status_id;
            $newOrder['country_id'] = $order->country_id;
            $newOrder['order_type_id'] = $order->order_type_id;
            $newOrder['lat'] = $order->lat;
            $newOrder['lng'] = $order->lng;
            $newOrder['email'] = $order->email;
            $newOrder['phone_number'] = $order->phone_number;
            $newOrder['order_value'] = $order->order_value;
            $newOrder['state'] = $order->state;
            $newOrder['city'] = $order->city;
            $newOrder['address'] = $order->address;
            $newOrder[$csrfTokenName] = $csrfToken;
            array_push($data, $newOrder);
        }

        return (object) array("data" => $data);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $order = $this->findModel($id);
        if ($order) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $order;
        }
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $data = Yii::$app->request->post();
        $postData = [];

        $postData['first_name'] = $data['first_name'];
        $postData['last_name'] = $data['last_name'];
        $postData['email'] = $data['email'];
        $postData['order_type_id'] = (int) $data['order_type_id'];
        $postData['scheduled_date'] = $data['scheduled_date'];
        $postData['phone_number'] = $data['phone_number'];
        $postData['order_value'] = $data['order_value'];
        $postData['address'] = $data['address'];
        $postData['city'] = $data['city'];
        $postData['zip_code'] = $data['zip_code'];
        $postData['state'] = $data['state'];
        $postData['country_id'] = (int) $data['country_id'];
        $postData['status_id'] = 1;
        $postData['lat'] = $data['lat'];
        $postData['lng'] = $data['lng'];

        $newData = [];
        $newData['_csrf'] = $data['_csrf'];
        $newData['Order'] = $postData;
        
        if ($model->load($newData) && $model->save()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return "success";
        } else {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $model->getErrors();
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Yii::$app->request->post();
        $postData = [];
        $postData['status_id'] = $data['statusId'];;
        $newData = [];
        $newData['_csrf'] = $data['_csrf'];
        $newData['Order'] = $postData;

        if ($model->load($newData) && $model->save()) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return $model;
        } else {
            return "error";
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $deleteResponse = $this->findModel($id)->delete();

        if ($deleteResponse) {
            echo true;
        } else {
            echo false;
        }
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
