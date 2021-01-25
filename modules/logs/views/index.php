<div class="content-wrapper" >
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Merchandizer Summary</h3>
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
                                    
                                    <?php $session_data = $this->session->userdata($this->config->item('ses_id')); ?>
                                    <table id="logTable" class="table table-striped table-bordered select-multi" data-id="<?php echo $session_data['id'] ?>">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Transaction Date</th>
                                                <th>Morning In</th>
                                                <th>Morning Out</th>
                                                <th>Afternoon In</th>
                                                <th>Afternoon Out</th>
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
        </section>
    </div>
</div>
<!-- Modal -->
<div class="modal animated pulse text-left" id="summaryModal" tabindex="-1" role="dialog" aria-labelledby="summaryModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger white">
                <h3 class="modal-title white" ><i class="ft-edit"></i> Merchandizer Logs</h3>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="zoom:90%">
                <section id="multi-item">
                    <table id="logsHTable" class="table table-striped table-bordered select-multi">
                        <thead>
                            <tr>
                                <th>Transaction Date</th>
                                <th>Time</th>
                                <th>Transaction</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-check-square-o"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->