<?php
$days = array(
    'Sunday',
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
);
?>
<div class="row">

    <div class="col-md-10 col-md-offset-1">

      <form action="/leader/index/postReserve/" name="reservation-frm" id="reservation-frm" method="POST">
        <fieldset>

          <!--legend>Reservation</legend-->

          <div class="form-group col-md-12">
              <label for="event">Event</label>
              <input name="reserve[event]" type="text" class="form-control" id="event" placeholder="Ex: Lễ Phục Sinh - Easter Sunday - Sunrise Joint Service">
          </div>

          <div class="form-group col-md-12">
              <label for="room">Room</label>
              <select id="room" name="reserve[room_id]" class="form-control">
                <optgroup label="At Church">
                  <?php foreach($rooms->result() as $k => $r):?>
                    <option value="<?=$r->id?>"><?=$r->room?></option>
                  <?php endforeach;?>
                </optgroup>

                <optgroup label="OffSite">
                  <?php foreach($offsite_rooms->result() as $k => $r):?>
                    <option value="<?=$r->id?>"><?=$r->room?></option>
                  <?php endforeach;?>
                </optgroup>

              </select>
          </div>

          <div class="form-group col-md-12">
              <textarea name="reserve[notes]" class="form-control" placeholder="Description ... (optional)"></textarea>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label class='col-md-12'>
                  <input type="radio" name="schedule" id="schedule1" value="1">
                  One time only

                  <div id="datetime-onetime" class="row datetime hide">

                    <div class='col-md-6 col-sm-6 col-xs-6'>

                      <input name="reserve[onetime-start]" type='text' class="form-control form_datetime1" id='onetime-starttime' placeholder="Start: <?=date("F j, Y, g:i a");?>" value="<?=date("F j, Y, g:i a");?>" />

                    </div>

                    <div class='col-md-6 col-sm-6 col-xs-6'>

                      <input name="reserve[onetime-end]" type='text' class="form-control form_datetime1" id='onetime-endtime' placeholder="End: <?=date("F j, Y, g:i a");?>" />

                    </div>
                  </div>

                </label>
              </div>

            </div>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label class='col-md-12'>
                  <input type="radio" name="schedule" id="schedule2" value="2">
                  Every week
                  <select name="reserve[everyweek-on]" id="datetime-everyweek" class="datetime hide">
                    <?php foreach($days as $k => $d):?>
                    <option value="<?=$d?>">on <?=$d?></option>
                  <?php endforeach;?>
                  </select>
                </label>
              </div>
            </div>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label class='col-md-12'>
                  <input type="radio" name="schedule" id="schedule3" value="3">
                  Once every 2 weeks
                  <select name="reserve[every2weeks-on]" id="datetime-every2weeks" class="datetime hide">
                    <?php foreach($days as $k => $d):?>
                    <option value="<?=$d?>">on <?=$d?></option>
                  <?php endforeach;?>
                  </select>
                </label>
              </div>
            </div>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label class='col-md-12'>
                  <input type="radio" name="schedule" id="schedule4" value="4">
                  Once every month
                  <select name="reserve[everymonth-on]" id="datetime-oncemonth" class="datetime hide">
                    <optgroup label="First Week">
                      <?php foreach($days as $k => $d):?>
                        <option value="first <?=$d?>"><?=$d?></option>
                      <?php endforeach;?>
                    </optgroup>

                    <optgroup label="Second Week">
                      <?php foreach($days as $k => $d):?>
                        <option value="second <?=$d?>"><?=$d?></option>
                      <?php endforeach;?>
                    </optgroup>

                    <optgroup label="Third Week">
                      <?php foreach($days as $k => $d):?>
                        <option value="third <?=$d?>"><?=$d?></option>
                      <?php endforeach;?>
                    </optgroup>

                    <optgroup label="Fourth Week">
                      <?php foreach($days as $k => $d):?>
                        <option value="fourth <?=$d?>"><?=$d?></option>
                      <?php endforeach;?>
                    </optgroup>

                  </select>
                </label>
              </div>
            </div>
          </div>
          <div class='col-md-12'>&nbsp</div>
          <div class="row hide" id="time-start-end-wrapper">
          <div class='col-md-6 col-sm-6'>
              <div class="form-group">
                <div class="row">
                  <div class='col-md-12'>
                      <input name="reserve[time-start]" type='text' class="form-control" id='input-time-start' placeholder="Time Start" />
                  </div>
                  <script type="text/javascript">
                      $(function () {
                          $('#input-time-start').datetimepicker1({format: 'LT'});
                      });
                  </script>
                </div>
            </div>
          </div>

          <div class='col-md-6 col-sm-6'>
            <div class="form-group">
              <div class="row">
                <div class='col-md-12'>
                    <input name="reserve[time-end]" type='text' class="form-control" id='input-time-end' placeholder="Time End" />
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#input-time-end').datetimepicker1({format: 'LT'});
                    });
                </script>
              </div>
            </div>
          </div>

          </div>


          <div class="form-group col-md-12 text-center">
            <button type="submit" class="btn btn-primary" data-loading-text="Processing ..."  id="btn-submit">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </div>

        </fieldset>
      </form>

    </div>

</div>

  <script type="text/javascript">

    $(".form_datetime1").datetimepicker({
        format: 'MM dd, yyyy, HH:ii p',
        minuteStep: 15,
        forceParse: true,
        autoclose: true,
        todayBtn: true,
        showMeridian: true,
        startDate: "<?=date("Y-m-d h:i");?>",
    });

    $(".form_datetime7").datetimepicker({
      format: "HH:ii P",
      autoclose: true,
      forceParse: true,
      todayBtn: true,
      startDate: "<?=date("Y-m-d h:i A");?>",
      showMeridian: true
    });

  </script>

<script type="text/javascript">

$( document ).ready(function() {

    $("input[id^='schedule']").click(function(e){
        var obj = $(this);
        $("[id^='datetime-']").addClass("hide");
        obj.siblings(".datetime").removeClass("hide");

        var id_clicked = obj.attr("id");
        //schedule1
        $("#time-start-end-wrapper").addClass("hide");
        if( id_clicked == "schedule1") {
          //do nothing
        } else {
          $("#time-start-end-wrapper").removeClass("hide");
        }

    });


    $("#btn-submit").click(function(e){
      e.preventDefault();

        var frm = $("#reservation-frm");
        var btn = $(this);

        //set to loading before send to server
        btn.button('loading');
        //alert( frm.attr("action") );
        $.ajax({
            type: "POST",
            dataType: "json",
            url: frm.attr("action"),
            data: frm.serialize(), // serializes the form's elements.
            success: function(data)
            {
                console.log(data.status);
                console.log(data.message);
                addGrowlMessage(data.status, data.message);
                if( data.status == 0 ) {
                    /*sending to thank you page*/
                }
                  setTimeout(function(){ btn.button('reset'); }, 2000);
            },
            error: function( jqXHR, textStatus, errorThrown){
              addGrowlMessage(1, textStatus + ": " + errorThrown);
              setTimeout(function(){ btn.button('reset'); }, 500);
            }

        });

    });

});

</script>