<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="col-md-12 no-padding">
    <!--div class="fc-toolbar fc-header-toolbar">
        <label class="switch" id="check">
            <input type="checkbox" id="select-mf" checked>
            <span class="slider round"></span>
        </label>
        </br>
        <div class="fc-center" id='mh-1'><h2>Mitarbeiter</h2></div>
        <div class="fc-center" id='fh-1' style="display: none;"><h2>Fahrzeugliste</h2></div>
        <div class="fc-center" id='fh-1' style="display: none;"><h2>Fremdfirmen</h2></div>
    </div-->
    <select class="form-control switchS mb-2" style="margin-bottom:10px">
            <option value='employee_list'> Mitarbeiter </option>
            <option value='vehicle_list'> Fahrzeugliste </option>
            <!--<option value='lieferanten_list'> Fremdfirmen </option>-->
    </select>

    <div class="fc-view-container listc" id='employee_list' >

        <?php

            foreach($staffs as $employee){
                echo "<div class=' fc-event-container fc-content fc-tile fc-toolbar buttonlike menu-text width:80%' id='emp_".$employee['admin_id']."' data-set='".$employee['admin_id']."' data-type='emp' draggable='true' ondragstart='dragStart(event)' > 
                    <span> ".$employee['full_name']."</span>
                    <span class='closebox' onclick='closebox(event)'>x</span>
                    
                    </div>";
                //print_r($employes);
            }


        ?>
    </div>
    <div class="fc-view-container listc" id='vehicle_list' style="display: none;">
        <?php

            foreach($cars as $car){
                echo "<div class=' fc-event-container fc-content fc-tile fc-toolbar buttonlike menu-text width:80%' id='car_".$car['id']."' data-set='".$car['id']."' data-type='car' draggable='true' ondragstart='dragStart(event)' > 
                    <span> ".$car['modell'].$car['kennzeichen']."</span>
                    <span class='closebox' onclick='closebox(event)'>x</span>
                    
                    </div>";
                //print_r($employes);
            }

        ?>
    </div>
    <div class="fc-view-container listc" id='lieferanten_list' style="display: none;">
        <?php
            // print_r($lieferanten);
            foreach($lieferanten as $car){
                echo "<div class=' fc-event-container fc-content fc-tile fc-toolbar buttonlike menu-text width:80%' id='company_".$car['id']."' data-set='".$car['id']."' data-type='company' draggable='true' ondragstart='dragStart(event)' > 
                    <span> ".$car['company']."</span>
                    <span class='closebox' onclick='closebox(event)'>x</span>
                    
                    </div>";
                //print_r($employes);
            }

        ?>
    </div>

</div>

<style>
.buttonlike{
    padding: 5px;
    color: #FFF;
    border: 0px solid #999;
    background-color: #2196f3;
    font-size:12px;
    margin: 6px 0px;
    cursor:move;
}
.buttondragged{
    padding: 5px;
    color: #fff;
    border: 0px solid #999;
    background-color: #2196f3;
    border-radius: 2px;
    margin: 6px 10px;
    font-size:12px;
    position: relative;
    z-index: 50;
}
.closebox {
    float: right;
    font-size: 16px;
    font-weight: 700;
    line-height: 1;
    color: #8e0202;
    text-shadow: 0 1px 0 #fff;
    opacity: .2;
    cursor: pointer;

}
.closebox:hover {
    float: right;
    font-size: 16px;
    font-weight: 700;
    line-height: 1;
    color: #8e0202;
    text-shadow: 0 1px 0 #fff;
    opacity: .7;
}

.fc-row .fc-bg, .fc-content-skeleton {
    z-index: auto !important;
}

.switch {
  position: relative;
  display: inline-block;
  width: 80px;
  height: 20px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0px;
  left: 0px;
  right: 0px;
  bottom: 0px;
  background-color: #0286c2;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 2px;
  bottom: 2px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(58px);
  -ms-transform: translateX(58px);
  transform: translateX(58px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}


</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
