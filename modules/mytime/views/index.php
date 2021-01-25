<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/robust/app-assets/css/pages/users.min.css">
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">My Time</h3>
        </div>
    </div>
    <div class="content-body" onload="initClock()">
        <section id="multi-item"> 
            <div  class="cardDiv">
                <div class="row">
                    <div id="map" style="height:400px;width:100%;" hidden></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><div class="badge badge-danger round status-badge">
                                    </div> <b><label id ="status">Status : The Location service failed.</label></b></h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a id="getLocation" data-count="<?php echo $this->session->userdata['login']['count'];
?>"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-toggle="collapse" class="min" data-target="#data"><i class="ft-minus"></i></a></li>
                                        <li><a class="max" data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show" id="data" class="collapse">
                                <div class="card-body card-dashboard centerss">
                                    <div class="row"> 
                                        <div class="col-md-12">
                                            <section id="user-cards-with-square-thumbnail" class="row">
                                                <div class="col-md-12" >
                                                    <div class="card box-shadow-1">
                                                        <div class="text-center">
                                                            <div class="card-body card-clock-body-title">
                                                                <h6 class="card-subtitle text-muted card-clock-sub-title">
                                                                    <span id="dayname"><?php echo date('l'); ?></span>,
                                                                    <span id="month"><?php echo date('F'); ?></span>
                                                                    <span id="daynum"><?php echo date('d'); ?></span>,
                                                                    <span id="year"><?php echo date('Y'); ?></span>
                                                                </h6>
                                                                <h4 class="card-title card-clock-title">
                                                                    <b>
                                                                        <span id="timer" data-clock="<?php echo date('F d, Y h:i:s'); ?>"><?php echo date('h:i:s'); ?></span>
                                                                        <span><?php echo date('A'); ?></span>
                                                                    </b>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-6">
                                            <div class="form-group text-center">
                                                <button type="button" style="width:70%;font-size:12px" class="btn btn-success btn-lg btn-min-width btn-glow" id="morningIn">MORNING IN</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group text-center">
                                                <button type="button" style="width:70%;font-size:12px"  class="btn btn-danger btn-lg btn-min-width btn-glow" id="morningOut">MORNING OUT</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-6">
                                            <div class="form-group text-center">
                                                <button type="button" style="width:70%;font-size:12px"  class="btn btn-success btn-lg btn-min-width btn-glow" id="afternoonIn">AFTERNOON IN</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group text-center">
                                                <button type="button" style="width:70%;font-size:12px"  class="btn btn-danger btn-lg btn-min-width btn-glow" id="afternoonOut">AFTERNOON OUT</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-md-12">
                                            <div class="form-group text-left">
                                                <h4><b> Store Asign :</b> <label id="store"></label></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-reload" hidden>
                            <div class="blockUI" style="display:none"></div>
                            <div class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); opacity: 0.6; cursor: wait; position: absolute;"></div>
                            <div class="blockUI blockMsg blockElement" style="z-index: 1011; position: absolute; padding: 0px; margin: 0px; width: 100%; top: 50%; left: 0px; text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: wait;">
                                <div class="ft-refresh-cw icon-spin font-medium-2">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div> 

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRpa2EuoyCUchrAdEEC06rDOgSnlGI_RM&callback=initMap&libraries=places&geometry&v=weekly"
></script>