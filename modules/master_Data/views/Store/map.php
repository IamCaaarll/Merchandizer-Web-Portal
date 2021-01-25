<div class="row">
    <div class="col-md-12">
        <div style="display: none;">
            <input
                id="pac-input"
                class="controls"
                type="text"
                placeholder="Enter a location"
                />
        </div>
        <div id="map" style="height:400px;width:100%;"></div>
        <div id="infowindow-content">
            <span id="place-name" class="title"></span><br />
            <strong>Address</strong>: <span id="place-address"></span>
        </div>
    </div>
</div>
<div class="row" style="margin-top:10px">

    <div class="col-md-3">
        <fieldset class="form-group floating-label-form-group">
            <label for="agency">Latitude</label>
            <input type="text" id="lat" class="form-control required upperCase" name="lat" disabled>
        </fieldset>    
    </div>
    <div class="col-md-3">
        <fieldset class="form-group floating-label-form-group">
            <label for="agency">Longitude</label>
            <input type="text" id="long" class="form-control required upperCase" name="long" disabled>
        </fieldset>    
    </div>
    <div class="col-md-3">
        <fieldset class="form-group floating-label-form-group">
            <label for="agency">Meters</label>
            <input type="text"  id="meter" class="form-control jui-spinner-min" disabled/>
        </fieldset>    
    </div>
      <div class="col-md-3">
        <fieldset class="form-group floating-label-form-group">
            <label for="agency">Kilometers</label>
            <input type="text"  id="km" class="form-control jui-spinner-min" disabled/>
        </fieldset>    
    </div>
</div>
