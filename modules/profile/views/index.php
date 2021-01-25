<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/menu"> Menu</a>
                        </li>
                        <li class="breadcrumb-item active">Profile
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">User Profile</h3>
        </div>
    </div>
    <div class="content-body"><div id="user-profile">
            <div class="row">
                <div class="col-12">
                    <div class="card profile-with-cover">
                        <div class="media profil-cover-details w-100">
                            <?php $session_data = $this->session->userdata($this->config->item('ses_id')); ?>
                            <div class="media-left pl-2 pt-2">
                                <a class="profile-image">
                                    <img src="<?php echo base_url('assets/Image/user_logo/' . strtoupper($session_data['firstname'][0]) . '.png'); ?>" class="rounded-circle img-border height-100" alt="user logo">
                                </a>
                            </div>
                            <div class="media-body pt-3 px-2">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="card-title"><?php echo $session_data['name']; ?></h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h3 class="card-title" style="font-size:13px"><?php echo $session_data['emailaddress']; ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav class="navbar navbar-light navbar-profile align-self-end">

                        </nav>
                    </div>
                </div>
            </div>
            
            <section id="multi-item"> 
                <div  class="cardDiv">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Change Password</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0"> 
                                            <li><a data-toggle="collapse" class="min" data-target="#data"><i class="ft-minus"></i></a></li>
                                            <li><a class="max" data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show" id="data" class="collapse">
                                    <div class="card-body card-dashboard">
                                        <div class="card-content collapse show" id="header" class="collapse">
                                            <div class="card-body card-dashboard zoomView"> 
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="opassword">Old Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="password" id="opassword" class="form-control upperCase" placeholder="Enter Old Password" name="opassword">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="npassword">New Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="password" id="npassword" class="form-control upperCase checkPass" placeholder="Enter New Password" name="npassword">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="cpassword">Confirm Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="password" id="cpassword" class="form-control upperCase checkPass" placeholder="Enter Confirm Password" name="cpassword">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <fieldset class="form-group ml-1">
                                                        <button type="button" class="btn btn-info mr-1" id="changePassword" disabled>
                                                            <i class="ft-save"></i> Save
                                                        </button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="multi-item" hidden> 
                <div  class="cardDiv">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Change Contact Information</h4>
                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0"> 
                                            <li><a data-toggle="collapse" class="min" data-target="#datac"><i class="ft-minus"></i></a></li>
                                            <li><a class="max" data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show" id="datac" class="collapse">
                                    <div class="card-body card-dashboard">
                                        <div class="card-content collapse show" id="header" class="collapse">
                                            <div class="card-body card-dashboard zoomView"> 
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="opassword">Old Contact Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input-group"> 
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="sizing-addon2">+63</span>
                                                                </div>
                                                                <input type="text" class="form-control required urequired phone-inputmask" id="contOld" placeholder="Enter Contact Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="npassword">New Contact Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input-group"> 
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="sizing-addon2">+63</span>
                                                                </div>
                                                                <input type="text" class="form-control required urequired phone-inputmask" id="contNew" placeholder="Enter Contact Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="cpassword">Confirm Contact Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input-group"> 
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="sizing-addon2">+63</span>
                                                                </div>
                                                                <input type="text" class="form-control required urequired phone-inputmask" id="contCon" placeholder="Enter Contact Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <fieldset class="form-group ml-1">
                                                        <button type="button" class="btn btn-info mr-1" id="changeContact" disabled>
                                                            <i class="ft-save"></i> Save
                                                        </button>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/robust/app-assets/js/scripts/forms/extended/form-inputmask.min.js"></script>   