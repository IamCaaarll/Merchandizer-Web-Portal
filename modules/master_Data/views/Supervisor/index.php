<div class="content-wrapper" >
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/menu"> Menu</a>
                        </li>
                        <li class="breadcrumb-item active">Account Manager
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Account Manager List</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">   
                <button type="button" class="btn btn-info btn-min-width box-shadow-1 mr-1 mb-1" id ="addmanager_Modal" data-toggle="modal" data-target="#managerModal"><i class="ft-plus icon-left"></i> Add Account Manager</button>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal animated pulse text-left" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModal" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="resetModalTitle"><i class="ft-edit"></i> Reset Password</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <fieldset class="form-group floating-label-form-group">
                            <label for="resetPass">New Password</label>
                            <input type="password" id="resetPass" class="form-control passRequired" placeholder="Enter New Password" name="resetPass">
                        </fieldset> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="resetManager" disabled>
                            <i class="ft-save"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->




        <!-- Modal -->
        <div class="modal animated pulse text-left" id="managerModal" tabindex="-1" role="dialog" aria-labelledby="merchModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="managerModalTitle"><i class="ft-edit"></i> Account Manager Entry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body merch-body">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="fa fa-eye"></i> About Account Manager</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" id="fname" class="form-control upperCase required urequired" placeholder="Enter First Name" name="fname">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="mname">Middle Name</label>
                                            <input type="text" id="mname" class="form-control upperCase required urequired" placeholder="Enter Middle Name" name="mname">
                                        </fieldset>
                                    </div>  
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" id="lname" class="form-control upperCase required urequired" placeholder="Enter Last Name" name="lname">
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <fieldset class="form-group">
                                            <label for="address">Address</label>
                                            <textarea id="address" style="max-width:100%;max-height:100px;" class="form-control upperCase required urequired" placeholder="Enter Address"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="conNum">Contact Number</label>
                                            <div class="input-group"> 
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="sizing-addon2">+63</span>
                                                </div>
                                                <input type="text" class="form-control required urequired phone-inputmask" id="contNum" placeholder="Enter Contact Number">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="contPer">Store</label>
                                            <fieldset  id="dropParent">
                                                <select class="select2-placeholder form-control" disabled style="width:100%" id="cbo_Store" name="cbo_Store">
                                                    <option></option>
                                                    <?php foreach ($storeData as $row): ?>
                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->storeName; ?></option>
                                                    <?php endforeach; ?>
                                                </select>       
                                            </fieldset>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="eaddress">Email Address</label>
                                            <input type="text" id="eaddress" class="form-control required urequired" placeholder="Enter Email Address" name="eaddress">
                                        </fieldset>
                                    </div>
                                </div>
                                <h4 class="form-section"><i class="ft-user"></i>Account Manager</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="userid">User ID</label>
                                            <input type="text" id="userid" class="form-control required urequired" placeholder="Enter User ID" name="userid">
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" class="form-control required" placeholder="Enter password" name="password">
                                        </fieldset>
                                    </div>  
                                    <div class="col-md-4">
                                        <fieldset class="form-group floating-label-form-group" id="dropParent">
                                            <label for="stats">Status</label>
                                            <fieldset>
                                                <input type="checkbox" class="switch" checked data-on-label="Active" data-off-label="Inactive" id="stats"/>
                                            </fieldset> 
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="userid">Unlock Account</label>
                                            <fieldset>
                                                <input type="checkbox" class="switch" checked data-on-label="Unlocked" data-off-label="Locked" id="locked"/>
                                            </fieldset> 
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="form-group">
                                            <label for="userid">User Must Change Password</label>
                                            <fieldset>
                                                <input type="checkbox" class="switch" checked data-on-label="True" data-off-label="False" id="change"/>
                                            </fieldset> 
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="saveManager" disabled>
                            <i class="ft-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </div>
    <div class="content-body">
        <section id="multi-item"> 
            <div  class="cardDiv">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List</h4>
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

                                    <table id="managerTable" class="table table-striped table-bordered select-multi">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>User ID</th>
                                                <th>Full Name</th>
                                                <th>Contact Number</th>
                                                <th>Store</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>				
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/forms/switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?php echo base_url() ?>assets/robust/app-assets/js/scripts/forms/select/form-select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/robust/app-assets/js/scripts/forms/extended/form-inputmask.min.js"></script>  