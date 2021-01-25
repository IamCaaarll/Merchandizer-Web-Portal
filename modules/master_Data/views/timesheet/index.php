
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
                        <li class="breadcrumb-item active"> Timesheet
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Timesheet List</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">
                <button type="button" class="btn btn-info btn-min-width box-shadow-1 mr-1 mb-1" id ="addtimesheet_Modal" data-toggle="modal" data-target="#timeSheetModal"><i class="ft-plus icon-left"></i> Timesheet</button>
            </div>
        </div>
        <div class="modal animated pulse text-left" id="timeSheetModal" tabindex="-1" role="dialog" aria-labelledby="timeSheetModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="timesheetodalTitle"><i class="ft-edit"></i> Timesheet</h3>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class ="col-md-12"> 
                                <fieldset class="form-group ">
                                    <label for="cbo_periodCover">Period Cover</label>
                                    <div class="dropParentperiodCover">
                                        <select class="form-control required" style="width:100%" id="cbo_periodCover" name="cbo_periodCover">
                                        </select> 
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class ="col-md-12"> 
                                <fieldset class="form-group dropParentStore">
                                    <label for="cbo_store">Store</label>
                                    <select class="form-control required" style="width:100%" id="cbo_store" name="cbo_store" >
                                    </select>    
                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            <div class ="col-md-12"> 
                                <fieldset class="form-group dropParentGroup">
                                    <label for="cbo_groupSched">Group Schedule</label>
                                    <select class="form-control required" style="width:100%" id="cbo_groupSched" name="cbo_groupSched" disabled>
                                    </select>    
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class ="col-md-12">
                                <fieldset class="form-group floating-label-form-group" >
                                    <div class="row">

                                        <fieldset class="form-group col-md-7">
                                            <table id="merchTable" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-left">Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </fieldset>
                                        <fieldset class="form-group col-md-5">
                                            <button type="button" class="btn btn-outline-danger" id="generateTimesheet" disabled>
                                                <i class="fa fa-refresh"></i> Generate TimeSheet
                                            </button>
                                        </fieldset>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="closeTimesheet" >
                            <i class="ft-x-square"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal animated pulse text-left" id="editTimesheetModal" tabindex="-1" role="dialog" aria-labelledby="timeSheetModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content ">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="editTimesheetModalTitle"><i class="ft-edit"></i> Timesheet</h3>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class ="col-md-4"> 
                                <fieldset class="form-group ">
                                    <label for="editmerchName">Merchandizer Name</label>
                                    <input type="text" disabled id="editmerchName" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>   
                        </div>
                        <div class="row">
                            <div class ="col-md-4"> 
                                <fieldset class="form-group ">
                                    <label for="editdateCovered">Date Covered</label>
                                    <input type="text" disabled id="editdateCovered" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="edittimein">Time In</label>
                                    <input type="text" disabled id="edittimein" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="editlunchin">Lunch In</label>
                                    <input type="text" disabled id="editlunchin" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="editlunchout">Lunch Out</label>
                                    <input type="text" disabled id="editlunchout" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="edittimeout">Time Out</label> 
                                    <input type="text" disabled id="edittimeout" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                        </div>
                        <table id="editTimesheetTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>  
                                    <th class="text-center" width="10%">Day Type</th>
                                    <th class="text-center" width="10%">Transaction Date</th>
                                    <th class="text-center" width="10%">Week Day</th>
                                    <th class="text-center" width="5%">Time In</th>
                                    <th class="text-center" width="5%">Lunch In</th>
                                    <th class="text-center" width="5%">Lunch Out</th>
                                    <th class="text-center" width="5%">Time Out</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="updateTimesheet" >
                            <i class="ft-x-square"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal animated pulse text-left" id="MerchTimesheetModal" tabindex="-1" role="dialog" aria-labelledby="MerchTimesheetModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content ">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="merchtimesheetodalTitle"><i class="ft-edit"></i> Merchandiser Timesheet</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class ="col-md-4"> 
                                <fieldset class="form-group ">
                                    <label for="merchName">Merchandizer Name</label>
                                    <input type="text" disabled id="merchName" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>   
                        </div>
                        <div class="row">
                            <div class ="col-md-4"> 
                                <fieldset class="form-group ">
                                    <label for="dateCovered">Date Covered</label>
                                    <input type="text" disabled id="dateCovered" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="timein">Time In</label>
                                    <input type="text" disabled id="timein" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="lunchin">Lunch In</label>
                                    <input type="text" disabled id="lunchin" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="lunchout">Lunch Out</label>
                                    <input type="text" disabled id="lunchout" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                            <div class ="col-md-2"> 
                                <fieldset class="form-group ">
                                    <label for="timeout">Time Out</label> 
                                    <input type="text" disabled id="timeout" class="form-control required upperCase" placeholder="Enter Agency" name="agency">
                                </fieldset>
                            </div>
                        </div>
                        <table id="merchTimesheetTable" class="table table-striped table-bordered">
                            <thead>
                                <tr> 
                                    <th class="text-center" width="10%">Day Type</th>
                                    <th class="text-center" width="10%">Transaction Date</th>
                                    <th class="text-center" width="5%">Week Day</th>
                                    <th class="text-center" width="5%">Time In</th>
                                    <th class="text-center" width="5%">Lunch In</th>
                                    <th class="text-center" width="5%">Lunch Out</th>
                                    <th class="text-center" width="5%">Time Out</th>
                                    <th class="text-center" width="5%">Actual Hours</th>
                                    <th class="text-center" width="5%">Late Hours</th>
                                    <th class="text-center" width="5%">Undertime Hours</th>
                                    <th class="text-center" width="5%">Total Hours</th>
                                    <th class="text-center" width="5%">Absent</th>
                                    <th class="text-center" width="5%">Special holiday</th>
                                    <th class="text-center" width="5%">Regular holiday</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="closeTimesheet" >
                            <i class="ft-x-square"></i> Close
                        </button>
                    </div>
                </div>
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
                                <div class="card-body card-dashboard"><div class="row">
                                        <div class="col-md-3">
                                            <fieldset class="form-group">
                                                <label for="cbo_FperiodCover">Period Cover</label>
                                                <fieldset >
                                                    <select class="form-control" style="width:100%" id="cbo_FperiodCover" name="cbo_FperiodCover">
                                                    </select>       
                                                </fieldset>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-3">
                                            <fieldset class="form-group">
                                                <label for="cbo_Fstore">Store</label>
                                                <fieldset >
                                                    <select class="form-control" style="width:100%" id="cbo_Fstore" name="cbo_Fstore">
                                                    </select>       
                                                </fieldset>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2">
                                            <fieldset class="form-group">
                                                <label for="cbo_Fschedule">Schedule</label>
                                                <fieldset>
                                                    <select class="form-control" style="width:100%" id="cbo_Fschedule" name="cbo_Fschedule">
                                                    </select>       
                                                </fieldset>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2">
                                            <fieldset class="form-group">
                                                <label for="cbo_FStatus">Status</label>
                                                <fieldset>
                                                    <select class="form-control" style="width:100%" id="cbo_FStatus" name="cbo_FStatus">
                                                        <option></option>
                                                        <option value="0">In Process</option>
                                                        <option value="1">Process</option>
                                                    </select>       
                                                </fieldset>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <fieldset class="form-group">
                                                        <label for="fname">Filter</label>
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-icon btn-info mr-1" id="filter" ><i class="ft-filter"> </i></button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <table id="TimesheetTable" class="table table-striped table-bordered select-multi">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>TimeSheet Code</th>
                                                <th>Merchandizer</th>
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
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="<?php echo base_url(); ?>assets/robust/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.min.js"></script>