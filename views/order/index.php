
<div class="container mb-4 mt-lg-5">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-7">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
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
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <div class="order-header border-bottom pb-2 mb-0">
                    <div class="order-title">
                        <h6>Existing Order</h6>
                    </div>
                    <div class="order-icon">
                        <span class="fa fa-check-square-o"></span>
                    </div>
                </div>
                <div class="existing-order table-responsive">
                    <table class="table table-checkable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                        <tr>
                            <td>Darlene</td>
                            <td>Jones</td>
                            <td>20/02/2020</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control order-select">
                                    <option id="pending" value="pending" selected>Pending</option>
                                    <option id="assigned" value="assigned">Assigned</option>
                                    <option id="onRoute" value="on_route">On Route</option>
                                    <option id="cancelled" value="cancelled">Cancelled</option>
                                    <option id="done" value="done">Done</option>
                                </select>
                                </div>
                            </td>
                            <td><span class="fa fa-close"></span></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-5">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
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
</div>