
<form id="myForm" class="needs-validation pt-3" novalidate>
    <input hidden="hidden" name=<?= Yii::$app->request->csrfParam; ?> value=<?= Yii::$app->request->getCsrfToken(); ?> />
    <div class="order">
    <!--First Row-->
    <div class="row">
    <!--Column 1-->
    <div class="col">
        <div class="form-group">
        <label for="">First Name <span class="red">*</span></label>
        <input name="first_name" type="text" class="form-control" placeholder="First Name" required>
        <div class="invalid-feedback">
            Valid first name is required.
        </div>
        </div>
        <div class="form-group">
        <label for="">Email</label>
        <input name="email" type="email" class="form-control" placeholder="you@ask.com">
        </div>
        <div class="form-group">
        <label for="">Order Type <span class="red">*</span></label>
        <select name="order_type_id" class="form-control" required>
            <option value="" selected>Please Select order type</option>
            <?php forEach ($orderTypes as $orderType) { ?>
                <option value=<?= $orderType->id ?>><?= $orderType->name ?></option>
            <?php }?>
        </select>
        <div class="invalid-feedback">
            Valid order type is required.
        </div>
        </div>
        <div class="form-group">
        <label for="">Scheduled Date <span class="red">*</span></label>
        <!-- <div class="input-group"> -->
            <!-- <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            <input name="scheduled_date"  value="" type="date" class="form-control" placeholder="" required> -->
            <div class="input-group date">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="text" class="form-control"><span class="input-group-addon"></span>
                <div class="invalid-feedback">
                    Valid date is required.
                </div>
            </div>


            
        <!-- </div> -->
        </div>
    </div>
    <!--Column 2-->
    <div class="col">
        <div class="form-group">
        <label for="">Last Name</label>
        <input name="last_name" type="text" class="form-control" placeholder="Last Name">
        </div>
        <div class="form-group">
        <label for="">Phone Number <span class="red">*</span></label>
        <input name="phone_number" value="" type="text" class="form-control" placeholder="+1 (888) 892-1321" required>
        <div class="invalid-feedback">
            Valid phone number is required.
        </div>
        </div>
        <div class="form-group">
        <label for="">Order Value</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-dollar"></i></div>
            </div>
            <input name="order_value" value="" type="text" class="form-control" placeholder="Amount">
        </div>
        </div>
    </div>
    </div>
    <!--Middle row-->
    <div class="form-group">
    <label for="">Street Address <span class="red">*</span></label>
    <input id="address" name="address" value="" type="text" class="form-control" placeholder="Street Address" required>
    <div class="invalid-feedback">
        Valid address is required.
    </div>
    </div>
    <!--Last row-->
    <div class="row">
    <!--Column 1-->
    <div class="col">
        <div class="form-group">
        <label for="">City <span class="red">*</span></label>
        <input id="city" name="city" value="" type="text" class="form-control" placeholder="" required>
        <div class="invalid-feedback">
            Valid city is required.
        </div>
        </div>
        <div class="form-group">
        <label for="">Postal / Zip Code</label>
        <input name="zip_code" value="" type="text" class="form-control" placeholder="">
        </div>
    </div>
    <!--Column 2-->
    <div class="col">
        <div class="form-group">
        <label for="">State / Province <span class="red">*</span></label>
        <input id="state" name="state" type="text" class="form-control" placeholder="" required>
        <div class="invalid-feedback">
            Valid state/province is required.
        </div>
        </div>
        <div class="form-group">
        <label for="">Country <span class="red">*</span></label>
        <select id="country" name="country_id" class="form-control" required>
            <option value="" selected>Please Select Country</option>
            <?php forEach($countries as $country) { ?>
                <option value=<?php echo $country->id ?>><?php echo $country->name ?></option>
            <?php } ?>
        </select>
        <div class="invalid-feedback">
            Valid state is required.
        </div>
        </div>
    </div>
    </div>
    </div>

    <div class="border-top mt-3"></div>
    <div class="order-footer">
    <div class="row">
        <div class="col-6 col-lg-6">
            <button type="button" class="btn btn-sm btn-gray-outline">Preview Location</button>
        </div>
        <div class="col-6 col-lg-6 text-right">
            <button disabled id="submitButton" type="submit" class="btn btn-sm btn-purple">Submit</button>
            <input id="reset" type="reset" value="Cancel"  class="btn btn-sm btn-gray"/>
        </div>
    </div>
    </div>
</form>