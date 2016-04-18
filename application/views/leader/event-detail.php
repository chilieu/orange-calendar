<h1><?=$event->result()[0]->event;?></h1>
<blockquote><?=$event->result()[0]->description;?></blockquote>


<table class="table table-striped">
    <thead>
        <th class="text-center">Room</th>
        <th width="120px" class="text-center">Day</th>
        <th width="100px" class="text-center">From</th>
        <th width="100px" class="text-center">To</th>
    </thead>

    <tbody>

        <?php foreach($event_date->result() as $row):?>
        <tr class="<?=($row->approval == 'approved') ? "" : "danger";?>">
            <td>

                <?=$row->room?>
                <?php if( $row->approval !== 'approved' ):?>
                    <a href="/leader/index/eventConflict/<?=$row->id;?>/" data-toggle="modal" data-target="#eventConflict">
                      <small>(Not Available)</small>
                    </a>
                <?php endif;?>
            </td>
            <td class="text-left"><?=date("M j, Y", strtotime($row->date_from) )?></td>
            <td class="text-center"><?=date("h:i a", strtotime($row->date_from) )?></td>
            <td class="text-center"><?=date("h:i a", strtotime($row->date_to) )?></td>
        </tr>
        <?php endforeach;?>

    </tbody>

</table>

<style id="jsbin-css">
    @media (min-width: 768px) {
      .modal-xl {
        width: 90% !important;
       max-width:1200px !important;
      }
    }
</style>

<!-- Modal -->
<div class="modal fade" id="eventConflict" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#eventConflict').on('hidden.bs.modal', function (e) {
      //window.location.reload();
      $(e.target).removeData('bs.modal').find(".modal-content").html("");
  });
});
</script>