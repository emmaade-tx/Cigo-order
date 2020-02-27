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
                    'geocoder' => ['GET']
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
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find(),
        ]);

        

        // $orders = Order::find()->with('orderType', 'country', 'status')->all();
        $orders = Order::find()->all();
        $orderTypes = OrderType::find()->all();
        $statuses = Status::find()->all();
        $countries = Country::find()->all();

            // var_dump($countries); die;
        // return $this->render('index', [
        //     'dataProvider' => $dataProvider,
        // ]);

        return $this->render('index', ['orderTypes' => $orderTypes, 'countries' => $countries, 'orders' => $orders, 'statuses' => $statuses, 'dataProvider' => $dataProvider]);
    }

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
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        // var_dump(Yii::$app->request->post()); die;

        $data = Yii::$app->request->post();
        $postData = [];
        // var_dump($newData); die;
        // var_dump(Yii::$app->request->post()); die;
        // $model->load(Yii::$app->request->post())
        // $model->first_name = $data['first_name'];
        // $model->first_name = $data['last_name'];
        // $model->first_name = $data['email'];

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
