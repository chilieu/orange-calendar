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
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($events->result() as $row):?>
                    <tr>
                        <td class="hide"><?=$row->id?></td>
                        <td><?=date("F j, Y", $row->date)?></td>
                        <td><?=$row->event?></td>
                        <td><?=$row->room?></td>
                        <td><?=date("h:i A", $row->time_from)?></td>
                        <td><?=date("h:i A", $row->time_to)?></td>
                        <td><?=$row->name?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
        </table>

    </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#event-table').DataTable({
        order: [[ 1, 'asc' ]],
        pageLength: 15
    });


} );
</script>