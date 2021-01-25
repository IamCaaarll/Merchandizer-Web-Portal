<?php $session_data = $this->session->userdata("recovery"); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="padding-bottom: 0px;">
                <a class="card-title" data-action="expand" id="return"><i class="ft-arrow-left"></i></a>
                <div class="card-title text-center" style="margin-top:-1.5em">
                    <img src="<?php echo base_url(); ?>assets/image/logo/mwp_logo.png" alt="branding logo">
                </div>
                <div class="heading-elements" hidden>
                    <ul class="list-inline mb-0"> 
                        <li><a class="max" data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
            </div>
            <h1 class="card-subtitle line-on-side text-muted text-center font-medium-5 pt-2"><span id="title" data-id="<?php echo $session_data['id']; ?>" data-email="<?php echo $session_data['email']; ?>" data-cont="<?php echo $session_data['contact']; ?>">Find Your Account</span></h1>
            <!--FOR CHECKING EMAIL ADDRESS-->
            <div class="card-content" id="check_emailadd">
                <div  class="card-body" style="padding-top: 10px;">
                    <div class="card-body" style="text-align: center;padding: 10px 0px;">
                        <label>Please enter your email or phone number to search your account.</label>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control input-lg" id="emailaddress" placeholder="Enter yout Email Address" tabindex="1">
                        <div class="form-control-position">
                            <i class="ft-mail"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-lg" id="checkEmail" disabled><i class="ft-mail"></i> Confirm</button>
                        </div>
                    </div> 
                </div>
            </div>
           
            <!--FOR CHECKING VERIFICATION CODE-->
            <div class="card-content" id="check_otp">
                <div  class="card-body" style="padding-top: 10px;">
                    <div class="card-body" style="text-align: center;padding: 10px 0px;">
                        <div style="text-align: center;">
                            <label>This helps show that this account really belongs to you</label>
                            <b><label><?php echo $session_data['email']; ?></label></b>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <img src="<?php echo base_url(); ?>assets/image/gif/account-recovery-sms-pin.gif" alt="branding logo">
                    </div>
                    <div class="form-group position-relative"  style="text-align: center;">
                        <b><label>Get a verification code</label></b>
                        <label>A text message with 6-digit verification code was just sent to •••• ••• ••<label><?php echo substr($session_data['contact'], 8); ?></label>.</label>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                         <input type="text" id="code" class="form-control" maxlength="6" style="text-align:center; padding-left: 10px;padding-right: 10px;text-transform:uppercase;font-weight: bold;">
                        <div class="form-control-position">
                            <i class="ft-lock"></i>
                        </div>
                        <div class="help-block font-small-3"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-lg" id="verifyCode" disabled><i class="ft-mail"></i> Verify Code</button>
                        </div>
                    </div> 
                </div>
            </div>

            <!--FOR NEW PASSWORD-->
            <div class="card-content" id="create_pass">
                <div  class="card-body" style="padding-top: 10px;">
                    <div class="form-group position-relative"  style="text-align: center;">
                        <label>Create a new Password.</label>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control input-lg" id="txt_password" placeholder="Enter New Password" tabindex="2" >
                        <div class="form-control-position">
                            <i class="fa fa-key"></i>
                        </div>
                        <div class="help-block font-small-3"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-info btn-lg" id="change_password" disabled><i class="ft-mail"></i> Confirm Password</button>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>





