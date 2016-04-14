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
                        <th>Event</th>
                        <th>Description</th>
                        <th width="180px">Creation</th>
                        <th width="100px"></th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach ($events->result() as $row):?>
                    <tr class="<?=($row->public == 1) ? "success" : "";?>">
                        <td class="hide"><?=$row->id?></td>
                        <td><?=$row->event?></td>
                        <td><?=$row->description?></td>
                        <td><?=date("F j, Y", strtotime($row->creation_date) )?></td>
                        <td align="center">
                            <a href="/leader/index/eventDetail/<?=$row->id?>/" class="text-default deny" data-id="<?=$row->id?>">View</a>
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
        order: [[ 3, 'desc' ]],
        pageLength: 15
    });


} );
</script>