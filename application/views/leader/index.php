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

      <form action="" name="reservation-frm" method="POST">
        <fieldset>

          <legend>Reservation</legend>

          <div class="form-group col-md-12">
              <label for="exampleInputEmail1">Event</label>
              <input name="reserve[event]" type="text" class="form-control" id="exampleInputEmail1" placeholder="Ex: Lễ Phục Sinh - Easter Sunday - Sunrise Joint Service">
          </div>

          <div class="form-group col-md-12">
              <label for="exampleInputEmail1">Room</label>
              <select name="reserve[room_id]" class="form-control">
                <?php foreach($rooms->result() as $k => $r):?>
                  <option value="<?=$r->id?>"><?=$r->room?></option>
                <?php endforeach;?>
              </select>
          </div>

          <div class="form-group col-md-12">
              <label for="exampleInputEmail1">Notes</label>
              <textarea name="reserve[notes]" class="form-control" placeholder="Notes ..."></textarea>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="schedule" id="schedule1" value="1">
                  One time only

                  <div id="datetime-onetime" class="datetime hide">
                    <div class='col-md-6'>
                      <label for="onetime-starttime">Time Start</label>

                      <div class='col-md-12'>
                          <input name="reserve[onetime-start]" type='text' class="form-control" id='onetime-starttime' placeholder="From ..." />
                      </div>
                      <script type="text/javascript">
                          $(function () {
                              $('#onetime-starttime').datetimepicker();
                          });
                      </script>

                    </div>

                    <div class='col-md-6'>
                      <label for="onetime-endtime">Time End</label>

                      <div class='col-md-12'>
                          <input name="reserve[onetime-end]" type='text' class="form-control" id='onetime-endtime' placeholder="To ..." />
                      </div>
                      <script type="text/javascript">
                          $(function () {
                              $('#onetime-endtime').datetimepicker();
                          });
                      </script>

                    </div>
                  </div>

                </label>
              </div>

            </div>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label>
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
                <label>
                  <input type="radio" name="schedule" id="schedule3" value="option1">
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
                <label>
                  <input type="radio" name="schedule" id="schedule4" value="option1">
                  Once every month
                  <select name="reserve[everymonth-on]" id="datetime-oncemonth" class="datetime hide">
                    <?php foreach($days as $k => $d):?>
                    <option value="<?=$d?>">on first <?=$d?></option>
                  <?php endforeach;?>
                  </select>
                </label>
              </div>
            </div>
          </div>

          <div class="row hide" id="time-start-end-wrapper">
          <div class='col-md-6 col-sm-6'>
              <div class="form-group">
                <div class="row">
                  <div class='col-md-12'>
                      <input name="reserve[time-start]" type='text' class="form-control" id='input-time-start' placeholder="Time Start" />
                  </div>
                  <script type="text/javascript">
                      $(function () {
                          $('#input-time-start').datetimepicker({format: 'LT'});
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
                        $('#input-time-end').datetimepicker({format: 'LT'});
                    });
                </script>
              </div>
            </div>
          </div>

          </div>


          <div class="form-group col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default">Reset</button>
          </div>

        </fieldset>
      </form>

    </div>

</div>

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

});

</script>