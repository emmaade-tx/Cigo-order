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
                    'getorders' => ['GET']
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $orders = Order::find()->all();
        $orderTypes = OrderType::find()->all();
        $statuses = Status::find()->all();
        $countries = Country::find()->all();

            // var_dump($countries); die;
        // return $this->render('index', [
        //     'dataProvider' => $dataProvider,
        // ]);

        return $this->render('index', ['orderTypes' => $orderTypes, 'countries' => $countries, 'orders' => $orders, 'statuses' => $statuses]);
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
            $geocoder->setApiKey('43d28b79857ee554d2b779518e57242ebee75d9');
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
        $postData['country_id'] = (int) $data['order_type_id'];
        $postData['status_id'] = 1;
        $postData['lat'] = $data['lat'];
        $postData['lng'] = $data['lng'];

        $newData = [];
        $newData['_csrf'] = $data['_csrf'];
        $newData['Order'] = $postData;
        // var_dump($newData); die;
        // var_dump($model->save());
        if ($model->load($newData) && $model->save()) {
            // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            echo json_encode(["success" => $model]);
            // return ["success" => "Data saved succesfully"];
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            echo ["error" => $model];
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
        // var_dump($model); die;
        // var_dump(Yii::$app->request->post()); die;
        $data = Yii::$app->request->post();
        // var_dump($data); die;
        $postData = [];
        $postData['status_id'] = $data['statusId'];;

        $newData = [];
        $newData['_csrf'] = $data['_csrf'];
        $newData['Order'] = $postData;


        if ($model->load($newData) && $model->save()) {

            echo json_encode(["success" => $model]);
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            echo ["error" => $model];
        }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);
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

        // return $this->redirect(['index']);
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
