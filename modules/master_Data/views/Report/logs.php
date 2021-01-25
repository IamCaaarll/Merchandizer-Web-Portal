<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/robust/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/robust/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/robust/app-assets/css/plugins/pickers/daterange/daterange.min.css">
<div class="content-wrapper" >
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/menu"> Menu</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#/menu/report"> Reports</a>
                        </li>
                        <li class="breadcrumb-item active">Logs
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Merchandizer Logs</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">   
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="multi-item"> 
            <div  class="cardDiv">
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
                    <div class="card-content collapse show" id="data" class="collapse" style="zoom:90%">
                        <div class="card-body card-dashboard">
                            <div class="row">
                                <div class="col-md-3">
                                    <fieldset class="form-group">
                                        <label for="fname">Date From</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="fa fa-calendar-o"></span>
                                                </span>
                                            </div>
                                            <input type='text' class="form-control pickerDate required header" style="background-color:#fff;cursor:pointer;" id="DateFrom" placeholder="Pick Date From"/>
                                        </div>
                                    </fieldset>

                                </div>
                                <div class="col-md-3">
                                    <fieldset class="form-group">
                                        <label for="fname">Date To</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <span class="fa fa-calendar-o"></span>
                                                </span>
                                            </div>
                                            <input type='text' class="form-control pickerDate required header" style="background-color:#fff;cursor:pointer;" id="DateTo" placeholder="Pick Date To"/>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-3">
                                    <fieldset class="form-group">
                                        <label for="cbo_filter">Search By</label>
                                        <fieldset  id="dropParent">
                                            <select class="select2-placeholder form-control required urequired" style="width:100%" id="cbo_filter" name="cbo_filter">
                                                <option></option>
                                                <option value="Name">Name</option>
                                                <option value="TransDate">Transaction Date</option>
                                                <option value="Time">Time</option>
                                                <option value="Event">Event</option>
                                            </select>       
                                        </fieldset>
                                    </fieldset>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <fieldset class="form-group">
                                                <label for="fname">Filter</label>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-icon btn-info mr-1" id="filter" ><i class="ft-filter"> <i class="ft-x clear-filter hidden" style="margin-left:-10px;font-size:10px" hidden></i></i></button>
                                                    <button type="button" class="btn btn-icon btn-danger mr-1" id="cFilter" ><i class="ft-filter"> <i class="ft-x clear-filter" style="margin-left:-10px;font-size:10px"></i></i></button>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <table id="logsTable" class="table table-striped table-bordered select-multi">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Transaction Date</th>
                                            <th>Time</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>				
                            </div>
                        </div>
                    </div>
                    <div class="card-reload" hidden>
                        <div class="blockUI" style="display:none"></div>
                        <div class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); opacity: 0.6; cursor: wait; position: absolute;"></div>
                        <div class="blockUI blockMsg blockElement" style="z-index: 1011; position: absolute; padding: 0px; margin: 0px; width: 30%; top: 348.5px; left: 388.5px; text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: wait;">
                            <div class="ft-refresh-cw icon-spin font-medium-2">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?php echo base_url() ?>assets/robust/app-assets/js/scripts/forms/select/form-select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js"></script>