<div class="content-wrapper" >
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/menu"> Menu</a>
                        </li>
                        <li class="breadcrumb-item active">System Update
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Send System Updates</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">   
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="multi-item"> 
            <div  class="cardDiv">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">SMS</h4>
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
                                    <div class="row"> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="label-control" for="userinput5">To :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <fieldset  id="dropParent">
                                                    <select class="select2 form-control" multiple="multiple" id="recipient">
                                                        <option value="ALL" selected >All</option>
                                                        <?php foreach ($storeData as $row): ?>
                                                            <option value="<?php echo $row->id; ?>"><?php echo $row->storeName; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>  
                                                </fieldset>
                                            <!--<input class="form-control" type="text" placeholder="Send To" id="sms_to">-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="label-control" for="userinput5">Message :</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <textarea id="txt_message" maxlength="150" class="form-control square required header" placeholder="Enter Message . ." style="margin-top: 0px; margin-bottom: 0px; height: 15px;max-height:150px;min-height:100px;"></textarea>
                                                <label class="label-control" for="userinput5" id="remaining"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"> 
                                            <div class="form-group">
                                                <button class="btn btn-info btn-sm" id ="submitSMS"><i class="fa fa-paper-plane white"></i> Send</button>
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
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/forms/switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?php echo base_url() ?>assets/robust/app-assets/js/scripts/forms/select/form-select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/robust/app-assets/js/scripts/forms/extended/form-inputmask.min.js"></script>   