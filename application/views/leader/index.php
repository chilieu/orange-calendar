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

      <form>
        <fieldset>

          <legend>Reservation</legend>

          <div class="form-group col-md-12">
              <label for="exampleInputEmail1">Event</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ex: Lễ Phục Sinh - Easter Sunday - Sunrise Joint Service  ">
          </div>

          <div class="form-group col-md-12">
              <label for="exampleInputEmail1">Room</label>
              <select class="form-control">
                <?php foreach($rooms->result() as $k => $r):?>
                  <option value="<?=$r->id?>"><?=$r->room?></option>
                <?php endforeach;?>
              </select>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="schedule" id="schedule1" value="option1">
                  One time only

                  <div id="datetime-onetime" class="datetime hide">
                    <div class='col-md-6'>
                      <label for="onetime-starttime">Time Start</label>

                      <div class='col-md-12'>
                          <input type='text' class="form-control" id='onetime-starttime' placeholder="Time End" />
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
                          <input type='text' class="form-control" id='onetime-endtime' placeholder="Time End" />
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
                  <input type="radio" name="schedule" id="schedule2" value="option1">
                  Every week
                  <select id="datetime-everyweek" class="datetime hide">
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
                  <select id="datetime-every2weeks" class="datetime hide">
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
                  <select id="datetime-oncemonth" class="datetime hide">
                    <?php foreach($days as $k => $d):?>
                    <option value="<?=$d?>">on first <?=$d?></option>
                  <?php endforeach;?>
                  </select>
                </label>
              </div>
            </div>
          </div>

          <div class='col-md-6 col-sm-6'>
              <div class="form-group">
                <div class="row">
                  <div class='col-md-12'>
                      <input type='text' class="form-control" id='input-time-start' placeholder="Time Start" />
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
                    <input type='text' class="form-control" id='input-time-end' placeholder="Time End" />
                </div>
                <script type="text/javascript">
                    $(function () {
                        $('#input-time-end').datetimepicker({format: 'LT'});
                    });
                </script>
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
    });

});

</script>