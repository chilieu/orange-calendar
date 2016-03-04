<div class="row">

	<div class="col-md-10 col-md-offset-1">


<form>

  <fieldset>
  	<legend>Contact Info</legend>

	<div class="form-group col-md-6">
	    <label for="exampleInputEmail1">First Name</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="John">
  	</div>

	<div class="form-group col-md-6">
	    <label for="exampleInputEmail1">Last Name</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Doe">
  	</div>

	<div class="form-group col-md-12">
	    <small class="text-muted">We'll never share your email and phone number with anyone else.</small>
  	</div>

  	<div class="form-group col-md-12">
	    <label for="exampleInputEmail1">Email address</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="YourEmail@example.com">
  	</div>

  	<div class="form-group col-md-12">
	    <label for="exampleInputEmail1">Phone</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="(xxx)-xxx-xxxx">
  	</div>

  </fieldset>

  <fieldset>

  	<legend>Reservation</legend>

  	<div class="form-group col-md-12">
	    <label for="exampleInputEmail1">Event</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Lễ Phục Sinh - Easter Sunday - Sunrise Joint Service	">
  	</div>

	<div class="form-group col-md-6">
	    <label for="exampleInputEmail1">Start</label>
        <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
  	</div>

	<div class="form-group col-md-6">
	    <label for="exampleInputEmail1">End</label>
        <div class='input-group date' id='datetimepicker2'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
  	</div>

  	<div class="form-group col-md-12">
	    <label for="exampleInputEmail1">Room</label>
	    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Room 11">
  	</div>



  	<div class="form-group col-md-12">
  		<button type="submit" class="btn btn-primary">Submit</button>
  	</div>

  </fieldset>


</form>

	</div>

</div>

<script type="text/javascript">

$( document ).ready(function() {
    $('#datetimepicker1').datetimepicker();

    $('#datetimepicker2').datetimepicker();
});

</script>