<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th >First Name</th>
                        <th>Last Name</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php foreach ($orders as $key => $order) { ?>
                            <tr>
                            <td><?= $key + 1 ?><td>
                            <td><?= $order->first_name ?><td>
                            <td><?= $order->last_name ?><td>
                            <td><?= $order->scheduled_date ?><td>
                            <td>
                                <select class="form-control">
                                    <?php foreach ($statuses as $status) { ?>
                                        <option 
                                        <?php echo $order->status_id === $status->id ? "selected" : ""; ?>
                                        ><?= $status->name ?></option>
                                    <?php } ?>

                                </select>
                            <td>
                            </tr>
                        <?php } ?>
                
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
        <div>

    </div>
</div>
