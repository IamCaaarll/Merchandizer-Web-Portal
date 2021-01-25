<div class="content-wrapper" >
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/menu"> Menu</a>
                        </li>
                        <li class="breadcrumb-item active">Store
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Store List</h3>
        </div>
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group">
                <button type="button" class="btn btn-info btn-min-width box-shadow-1 mr-1 mb-1" id ="addstore_Modal" data-toggle="modal" data-target="#storeModal"><i class="ft-plus icon-left"></i> Add Store</button>
            </div>
        </div>
        <div class="modal animated pulse text-left" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="storeModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="storeModalTitle"><i class="ft-edit"></i> Store Entry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <fieldset class="form-group floating-label-form-group">
                            <label for="agency">Sap Code</label>
                            <input type="text" id="sapCode" class="form-control required upperCase" placeholder="Enter Sap Code" name="sapCode">
                        </fieldset>    
                        <fieldset class="form-group floating-label-form-group">
                            <label for="agency">Store Name</label>
                            <input type="text" id="storeName"  class="form-control required upperCase" placeholder="Enter Store Name" name="storeName">
                        </fieldset>
                        <fieldset class="form-group floating-label-form-group">
                            <label for="agency">Store Location</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nameLoc" placeholder="Enter Location" disabled>
                                <div class="input-group-append">
                                    <button data-controls-modal="locmodal" data-backdrop="static" data-keyboard="false" class="btn btn-primary" id="testMap"  data-id="" data-name="" data-rad="" data-long="" data-lat="" type="button" data-toggle="modal" data-target="#location"><i class="fa fa-map-marker"></i></button>
                                </div>
                            </div> 
                        </fieldset>
                    
                        <fieldset class="form-group floating-label-form-group">
                            <label for="cbo_manager">Account Manager</label>
                            <fieldset  id="dropParent">
                                <select class="select2-placeholder form-control required urequired" style="width:100%" id="cbo_manager" name="cbo_manager">
                                    <option></option>
                                    
                                </select>  
                              
                            </fieldset>
                        </fieldset>
                        <fieldset class="form-group floating-label-form-group">
                            <label for="stats">Status</label>
                            <fieldset>
                                <input type="checkbox" class="switch" data-on-label="Active" data-off-label="Inactive" id="stats"/>
                            </fieldset> 
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" id="saveStore" disabled>
                            <i class="ft-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal animated pulse text-left"  id="location" role="dialog" aria-labelledby="locationLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h3 class="modal-title white" id="storeModalTitle"><i class="ft-edit"></i> Store Location</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="locmodal">
                    </div>
                    <!----> 
                    <div class="modal-footer">
                        <button  type="button" class="btn btn-outline-danger " class="close" data-dismiss="modal" aria-label="Close" id="setLocation" >
                            <i class="fa fa-map-marker"></i> Set Location
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

                                    <table id="storeTable" class="table table-striped table-bordered select-multi">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Sap Code</th>
                                                <th>Store Location</th>
                                                <th>Store</th>
                                                <th>Manager</th>
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



<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRpa2EuoyCUchrAdEEC06rDOgSnlGI_RM&callback=initMap&libraries=places&geometry&v=weekly"
></script>