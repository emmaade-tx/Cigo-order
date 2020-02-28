<div class="existing-order table-responsive">
    <table class="table table-checkable">
    <thead>
        <tr>
            <th>First Name</th>
            <th>&nbsp;</th>
            <th>Last Name</th>
            <th>&nbsp;</th>
            <th>Date</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) { ?>
            <tr class="viewOrder" order-id=<?= $order->id ?>>
                <td><?php echo $order->first_name ?><td>
                <td><?php echo $order->last_name ?><td>
                <td><?php echo $order->scheduled_date ?><td>
                <td>
                    <div class="form-group">
                    <input id="csrf" hidden="hidden" name=<?= Yii::$app->request->csrfParam; ?> value=<?= Yii::$app->request->getCsrfToken(); ?> />
                    <select order-id=<?= $order->id ?> class="form-control order-select">
                        <?php foreach ($statuses as $status) { ?>
                            <option value=<?= $status->id ?> id=<?= $status->name ?> 
                            <?php echo $order->status_id === $status->id ? "selected" : ""; ?>
                            ><?= $status->name ?></option>
                        <?php } ?>
                        
                    </select>
                    </div>
                </td>
                <td><span order-id=<?= $order->id; ?> class="fa fa-close deleteOrder"></span></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
</div>