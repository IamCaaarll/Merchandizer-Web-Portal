
<div class="content-wrapper" >
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/menu"> Menu</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#/menu/schedule"> Schedule Menu</a>
                        </li>
                        <li class="breadcrumb-item active">Schedule
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Schedule List</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">
                <button type="button" class="btn btn-info btn-min-width box-shadow-1 mr-1 mb-1" id ="addsched_Modal" data-toggle="modal" data-target="#schedModal"><i class="ft-plus icon-left"></i> Add Schedule</button>
            </div>
        </div>
        <div class="modal animated pulse text-left" id="schedModal" tabindex="-1" role="dialog" aria-labelledby="schedModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="schedModalTitle"><i class="ft-edit"></i> Schedule Entry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="scheduleCode">Description</label>
                                    <input type="text" id="scheduleCode" class="form-control required" placeholder="Schedule Code" name="scheduleCode" disabled>
                                </fieldset>
                            </div>
                            <div class="col-md-8">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" style="max-width:100%;max-height:100px;" class="form-control upperCase required urequired" placeholder="Enter Description"></textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="morning_In">Morning In</label>
                                    <div class="md-form md-outline">
                                        <input type="time" id="morning_In" class="form-control" placeholder="Select time">
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="morning_Out">Morning Out</label>
                                    <div class="md-form md-outline">
                                        <input type="time" id="morning_Out" class="form-control" placeholder="Select time">
                                    </div>
                                </fieldset> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="afternoon_In">Afternoon In</label>
                                    <div class="md-form md-outline">
                                        <input type="time" id="afternoon_In" class="form-control" placeholder="Select time">
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="afternoon_Out">Afternoon Out</label>
                                    <div class="md-form md-outline">
                                        <input type="time" id="afternoon_Out" class="form-control" placeholder="Select time">
                                    </div>
                                </fieldset> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="txt_totalHours">Total Hours</label>
                                    <input type="text" id="txt_totalHours" class="form-control" placeholder="Total Hours" disabled>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <fieldset class="form-group floating-label-form-group">
                                    <label for="txt_totalBreak">Total Break</label>
                                    <input type="text" id="txt_totalBreak" class="form-control" placeholder="Total Break" disabled>
                                </fieldset> 
                            </div>
                        </div>
                        <fieldset class="form-group floating-label-form-group">
                            <label for="stats">Status</label>
                            <fieldset>
                                <input type="checkbox" class="switch" data-on-label="Active" data-off-label="Inactive" id="stats"/>
                            </fieldset> 
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="saveSched" disabled>
                            <i class="ft-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--class="close" data-dismiss="modal" aria-label="Close"-->
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
                                    <table id="schedTable" class="table table-striped table-bordered select-multi">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Schedule Code</th>
                                                <th>Description</th>
                                                <th>Morning In</th>
                                                <th>Morning Out</th>
                                                <th>Afternoon In</th>
                                                <th>Afternoon Out</th>
                                                <th>Minutes Hour</th>
                                                <th>Break</th>
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
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js"></script>