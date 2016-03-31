<style type="text/css">
.table {
    table-layout:fixed;
}

.table td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;

}
</style>
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">

        <table id="event-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>
                    <tr>
                        <th class="hide">ID</th>
                        <th width="180px">Date</th>
                        <th>Event</th>
                        <th width="200px">Room</th>
                        <th width="100px">From</th>
                        <th width="100px">To</th>
                        <th width="200px">Contact</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($events->result() as $row):?>
                    <tr class="<?=($row->approval == 1) ? "success" : "";?>">
                        <td class="hide"><?=$row->id?></td>
                        <td><?=date("F j, Y", $row->date)?></td>
                        <td><?=$row->event?></td>
                        <td><?=$row->room?></td>
                        <td><?=date("h:i A", $row->time_from)?></td>
                        <td><?=date("h:i A", $row->time_to)?></td>
                        <td><?=$row->name?></td>
                        <td>
                            <a class="text-default edit" data-id="<?=$row->id?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        	<a class="text-success approve" data-id="<?=$row->id?>"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>
                        	<a class="text-danger deny" data-id="<?=$row->id?>"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
        </table>

    </div>
    </div>
</div>

<script type="text/javascript">

$(document).ready(function() {

    var event_table = $('#event-table').DataTable({
        order: [[ 1, 'asc' ]],
        pageLength: 15
    });

    $(".edit").click(function(e){
        e.preventDefault();

        var obj = $(this);
        var id = obj.attr("data-id");
        var result = confirm("Under Contruction");
        if (result) {

        }

    });

    $(".approve").click(function(e){
    	e.preventDefault();

        var obj = $(this);
        var id = obj.attr("data-id");
		var result = confirm("Do you want to approve this event?");
		if (result) {
		  $.post( "/admin/leader/updateReservation/", { action: 'approve', id: id })
		    .done(function( data ) {
		      var data = $.parseJSON(data);
		      addGrowlMessage(data.status, data.message);
              setTimeout(function(){ window.location.reload(); }, 2000);

		      //event_table.ajax.reload();
		  });
		}

    });


    $(".deny").click(function(e){
    	e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");
		var result = confirm("Do you want to deny this event?");
		if (result) {
		  $.post( "/admin/leader/updateReservation/", { action: 'deny', id: id })
		    .done(function( data ) {
		      var data = $.parseJSON(data);
		      addGrowlMessage(data.status, data.message);
		      setTimeout(function(){ window.location.reload(); }, 2000);
		      //event_table.ajax.reload();
		  });
		}

    });


} );
</script>