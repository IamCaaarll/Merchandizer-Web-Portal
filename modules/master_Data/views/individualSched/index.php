
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
                        <li class="breadcrumb-item active"> Individual Schedule
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Individual Schedule List</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">
                <button type="button" class="btn btn-info btn-min-width box-shadow-1 mr-1 mb-1" id ="addsched_Modal" data-toggle="modal" data-target="#schedModal"><i class="ft-plus icon-left"></i> Add Individual Schedule</button>
            </div>
        </div>
        <div class="modal animated pulse text-left" id="schedModal" tabindex="-1" role="dialog" aria-labelledby="schedModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content ">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="schedModalTitle"><i class="ft-edit"></i> Individual Schedule Entry</h3>
                        <a href="index.php"></a>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"  style="zoom:90%">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="form-group">
                                            <label for="agency">Period Cover</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="dropParentperiodCover">
                                                        <select class="form-control required" style="width:100%" id="cbo_periodCover" name="cbo_periodCover">
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" id="periodDesc" class="form-control" placeholder="Period Cover" disabled>
                                                </div>
                                            </div>


                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group dropParentStore">
                                            <label for="cbo_store">Store</label>
                                            <select class="form-control required urequired" style="width:100%" id="cbo_store" name="cbo_store">
                                            </select>    
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group dropParentGroupSchedule">
                                            <label for="cbo_groupSchedule">Group Schedule</label>
                                            <select disabled class="form-control required urequired" style="width:100%" id="cbo_groupSchedule" name="cbo_groupSchedule">
                                            </select>    
                                        </fieldset>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <fieldset class="form-group dropParentmerchName">
                                            <label for="cbo_merchName">Merchandizer Name</label>
                                            <select class="form-control required urequired" style="width:100%" id="cbo_merchName" name="cbo_merchName" disabled>
                                            </select>    
                                        </fieldset>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <fieldset class="form-group dropParentschedCode">
                                            <label for="cbo_store">Schedule Code</label>
                                            <select class="form-control view" style="width:100%" id="cbo_schedCode" name="cbo_schedCode" disabled>
                                            </select> 
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="txt_aminout">Morning In - Out</label>
                                            <input type="text" id="txt_aminout" class="form-control" placeholder="Time In - Time Out" disabled>
                                        </fieldset> 
                                    </div>
                                    <div class="col-md-3">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label for="txt_pminout">Afternoon In - Out</label>
                                            <input type="text" id="txt_pminout" class="form-control" placeholder="Time In - Time Out" disabled>
                                        </fieldset> 
                                    </div>

                                </div> 
                                <div class="row">
                                    <div class="col-md-4">
                                        <fieldset class="form-group dropParentdayStatus">
                                            <label for="cbo_dayStatus">Status</label>
                                            <select class="form-control view" style="width:100%" id="cbo_dayStatus" name="cbo_dayStatus" disabled>
                                                <option></option>
                                                <option>Regular Day</option>
                                                <option>Rest Day</option>
                                            </select> 
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <fieldset class="form-group" style="margin-top:25px">
                                            <button type="button" class="btn btn-info" id ="setStatus" disabled><i class="ft-plus icon-left" ></i> Set Status</button>    
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <fieldset class="form-group" style="margin-top:25px">
                                            <button type="button" class="btn btn-info" id ="setSchedule" disabled><i class="ft-plus icon-left"></i> Set Schedule</button>    
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class ="col-md-12">
                                        <fieldset class="form-group floating-label-form-group" >
                                            <label for="dailyschedTable">Daily Schedule</label>
                                            <table id="dailyschedTable"  style="zoom:95%" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="select-checkbox"><input id="checkBox" type="checkbox"></th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Schedule Code Actual</th>
                                                        <th class="text-center">Schedule Date</th>
                                                        <th class="text-center">Day</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </fieldset>
                                    </div>  
                                </div>  
                            </div>    
                        </div>    





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
                                    <div class="row">
                                        <div class="col-md-2">
                                            <fieldset class="form-group">
                                                <label for="cbo_FperiodCover">Period Cover</label>
                                                <fieldset >
                                                    <select class="form-control" style="width:100%" id="cbo_FperiodCover" name="cbo_FperiodCover">
                                                    </select>       
                                                </fieldset>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-2">
                                            <fieldset class="form-group">
                                                <label for="cbo_Fstore">Store</label>
                                                <fieldset >
                                                    <select class="form-control" style="width:100%" id="cbo_Fstore" name="cbo_Fstore">
                                                    </select>       
                                                </fieldset>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-3">
                                            <fieldset class="form-group">
                                                <label for="cbo_FgroupSchedule">Group Schedule</label>
                                                <fieldset >
                                                    <select class="form-control" style="width:100%" id="cbo_FgroupSchedule" name="cbo_FgroupSchedule" disabled>
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
                                                            <button type="button" class="btn btn-icon btn-info mr-1" id="filter" ><i class="ft-filter"> </i></button>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <table id="schedTable" class="table table-striped table-bordered select-multi">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Name</th>
                                                <th>Period Code</th>
                                                <th>Store</th>
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