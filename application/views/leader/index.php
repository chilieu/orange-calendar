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
          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                  One time only
                </label>
              </div>
            </div>
          </div>

          <div class='col-md-12'>
            <div class="form-group">
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                  Every week on
                  <select>
                    <?php foreach($days as $k => $d):?>
                    <option value="<?=$d?>"><?=$d?></option>
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
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                  Once every 2 weeks on
                  <select>
                    <?php foreach($days as $k => $d):?>
                    <option value="<?=$d?>"><?=$d?></option>
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
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                  Once month on first
                  <select>
                    <?php foreach($days as $k => $d):?>
                    <option value="<?=$d?>"><?=$d?></option>
                  <?php endforeach;?>
                  </select>
                </label>
              </div>
            </div>
          </div>

          <div class='col-md-6'>
              <div class="form-group">
                    <label for="exampleInputEmail1">Time Start</label>
                  <div class='input-group date' id='datetimepicker1'>
                      <input type='text' class="form-control" value="<?=date("m-d-Y h:i A");?>" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>
          </div>

          <div class='col-md-6'>
              <div class="form-group">
                    <label for="exampleInputEmail1">Time End</label>
                  <div class='input-group date' id='datetimepicker2'>
                      <input type='text' class="form-control" value="<?=date("m-d-Y h:i A");?>" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
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
    $('#datetimepicker1').datetimepicker({
                sideBySide: true
            });

    $('#datetimepicker2').datetimepicker({
                sideBySide: true
            });
});

</script>