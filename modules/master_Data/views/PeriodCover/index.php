
<div class="content-wrapper" >
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/menu"> Menu</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#/menu/schedule"> Schedule</a>
                        </li>
                        <li class="breadcrumb-item active">Period Cover
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Period Cover List</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">
                <button type="button" class="btn btn-info btn-min-width box-shadow-1 mr-1 mb-1" id ="addperiod_Modal" data-toggle="modal" data-target="#periodModal"><i class="ft-plus icon-left"></i> Add Period Cover</button>
            </div>
        </div>
        <div class="modal animated pulse text-left" id="periodModal" tabindex="-1" role="dialog" aria-labelledby="periodModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="periodModalTitle"><i class="ft-edit"></i> Period Entry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <fieldset class="form-group floating-label-form-group" >
                            <label for="periodCode">Period Code</label>
                            <input type="text" id="periodCode" class="form-control required" placeholder="Period Code" name="periodCode" disabled>
                        </fieldset>  
                        <fieldset class="form-group floating-label-form-group">
                            <label for="Period_from">Period From</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fa fa-calendar-o"></span>
                                    </span>
                                </div>
                                <input type='text' class="form-control pickadate required header" style="background-color:#fff;cursor:pointer;" id="Period_from" placeholder="Pick Period From"/>
                            </div>
                        </fieldset>    
                        <fieldset class="form-group floating-label-form-group">
                            <label for="Period_to">Period To</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fa fa-calendar-o"></span>
                                    </span>
                                </div>
                                <input type='text' class="form-control pickadate required header" style="background-color:#fff;cursor:pointer;" id="Period_to" placeholder="Pick Period To"/>
                            </div>
                        </fieldset>
                        <fieldset class="form-group floating-label-form-group">
                            <label for="Date_from">Date From</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fa fa-calendar-o"></span>
                                    </span>
                                </div>
                                <input type='text' class="form-control pickadate required header" style="background-color:#fff;cursor:pointer;" id="Date_from" placeholder="Pick Date From"/>
                            </div>
                        </fieldset>    
                        <fieldset class="form-group floating-label-form-group">
                            <label for="Date_to">Date To</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="fa fa-calendar-o"></span>
                                    </span>
                                </div>
                                <input type='text' class="form-control pickadate required header" style="background-color:#fff;cursor:pointer;" id="Date_to" placeholder="Pick Date To"/>
                            </div>
                        </fieldset>
                        <fieldset class="form-group floating-label-form-group">
                            <label for="stats">Status</label>
                            <fieldset>
                                <input type="checkbox" class="switch" data-on-label="Active" data-off-label="Inactive" id="stats"/>
                            </fieldset> 
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="savePeriod" disabled>
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
                                    <table id="periodTable" class="table table-striped table-bordered select-multi">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Period Code</th>
                                                <th>Period From</th>
                                                <th>Period To</th>
                                                <th>Date From</th>
                                                <th>Date To</th>
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