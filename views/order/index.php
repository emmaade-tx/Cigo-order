
<div class="mb-4 mt-lg-4">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-7">
            <div class="my-4 p-3 bg-white rounded shadow-sm">
                <div class="order-header border-bottom pb-2 mb-0">
                    <div class="order-title">
                        <h6>Add an Order</h6>
                    </div>
                    <div class="order-icon">
                        <span class="fa fa-address-card-o"></span>
                    </div>
                </div>
                <?= $this->render('_form', array('countries' => $countries, 'orderTypes' => $orderTypes)); ?>
            </div>
            <div class="my-1 p-3 bg-white rounded shadow-sm">
                <div class="order-header border-bottom pb-2 mb-0">
                    <div class="order-title">
                        <h6>Existing Order</h6>
                    </div>
                    <div class="order-icon">
                        <span class="fa fa-check-square-o"></span>
                    </div>
                </div>
                <?= $this->render('_view'); ?>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-5">
            <div class="my-4 p-3 bg-white rounded shadow-sm">
                <div class="order-header">
                    <div class="order-title">
                        <h6>Map</h6>
                    </div>
                    <div class="order-icon">
                        <span class="fa fa-globe"></span>
                    </div>
                </div>
                <div class="media text-muted pt-3" id="mapid">
                
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('_detailModal'); ?>
</div>