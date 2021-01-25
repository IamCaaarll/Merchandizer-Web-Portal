<div class="card border-grey border-lighten-3 m-0">
    <div class="card-header border-0">
        <div class="card-title text-center gfg">
            <img class="imgs" src="<?php echo base_url(); ?>assets/image/logo/logo6.png" alt="branding logo">
        </div>
        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Hi! Please enter your new password.</span></h6>
    </div>
    <div class="card-content">
        <div class="card-body form-horizontal">
            <fieldset class="form-group position-relative has-icon-left">
                <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                <input type="password" class="form-control input-lg" id="txt_old_password" placeholder="Enter Old Password" tabindex="2" required data-validation-required-message= "Please enter valid passwords.">
                <div class="form-control-position">
                    <i class="fa fa-key"></i>
                </div>
                <div class="help-block font-small-3"></div>
            </fieldset>
            <fieldset class="form-group position-relative has-icon-left">
                <input type="password" class="form-control input-lg" id="txt_new_password" placeholder="Enter New Password" tabindex="2" required data-validation-required-message= "Please enter valid passwords.">
                <div class="form-control-position">
                    <i class="fa fa-key"></i>
                </div>
                <div class="help-block font-small-3"></div>
            </fieldset>
            <fieldset class="form-group position-relative has-icon-left">
                <input type="password" class="form-control input-lg" id="txt_confirm_password" placeholder="Enter Confirm Password" tabindex="2" required data-validation-required-message= "Please enter valid passwords.">
                <div class="form-control-position">
                    <i class="fa fa-key"></i>
                </div>
                <div class="help-block font-small-3"></div>
            </fieldset>
            
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <button type="submit" class="btn btn-info btn-lg btn-block" id="keeppass"><i class="ft-user"></i> Keep</button>
                </div>
                <div class="col-12 col-sm-6 col-md-6">
                    <button type="submit" class="btn btn-danger btn-lg btn-block" id="changepass"><i class="ft-unlock"></i> Change</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer border-0">
        <p class="text-center text-muted"><small><strong>DOC Version 1.0.0</strong><br>Copyright © 2020 <a href="">Bounty Fresh Food Inc</a>.<br>All rights reserved.</small></p>
    </div>
</div>




