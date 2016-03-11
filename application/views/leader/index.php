<div class="row">

    <div class="col-md-10 col-md-offset-1">



  <fieldset>
    <legend>Map</legend>

    <div class="col-md-offset-2 col-md-8">
        <img src="https://www.uvu.edu/ufra/images/first_floor.jpg" class="img-responsive">
    </div>


  </fieldset>

<form>
  <fieldset>

    <legend>Reservation</legend>

    <div class="form-group col-md-6">
        <label for="exampleInputEmail1">Event</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Lễ Phục Sinh - Easter Sunday - Sunrise Joint Service  ">
    </div>

    <div class="form-group col-md-6">
      <label for="exampleInputEmail1">Room</label>
      <div class='input-group date' id='room'>
          <input type='text' class="form-control" placeholder="Room 11" />
          <span class="input-group-addon">
              <span class="glyphicon glyphicon glyphicon-picture"></span>
          </span>
      </div>
    </div>

    <div class='col-md-6'>
        <div class="form-group">
              <label for="exampleInputEmail1">From</label>
            <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-6'>
        <div class="form-group">
              <label for="exampleInputEmail1">End</label>
            <div class='input-group date' id='datetimepicker2'>
                <input type='text' class="form-control" />
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