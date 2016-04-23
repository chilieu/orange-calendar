<div class="row">
  <div class="col-md-12 col-sm-12">
    <div class="form-group">
      <input name="event" class="form-control" value="<?=$event->result()[0]->event;?>" type="text">
    </div>

    <div class="form-group">
      <textarea name="description" class="form-control"><?=$event->result()[0]->description;?></textarea>
    </div>

    <div class="form-group">
      <button class="btn btn-primary">Update</button>
    </div>

  </div>
</div>
<div class="col-md-12 col-sm-12">
<table class="table table-hover table-striped" id="event-table">
    <thead>
        <th class="text-center">Room</th>
        <th width="120px" class="text-center">Day</th>
        <th width="75px" class="text-center">From</th>
        <th width="50px" class="text-center">To</th>
        <th width="100px" class="text-center"></th>
    </thead>

    <tbody>
        <?php $month = "";?>
        <?php foreach($event_date->result() as $row):?>

        <?php if( $month != date("M", strtotime($row->date_from) ) ):?>
        <tr class="info"><td colspan="5" class="text-center"><b><?=date("M, Y", strtotime($row->date_from) );?></b></td></tr>
        <?php endif;?>
        <?php $month = date("M", strtotime($row->date_from) );?>

        <tr class="event-date-row <?=($row->approval == 'approved') ? "" : "danger";?>">
            <td>
                <select class="form-control">

                  <optgroup label="At Church">
                    <?php foreach($rooms->result() as $k => $r):?>
                      <option value="<?=$r->id?>" <?=($row->room_id == $r->id) ? "selected" : "";?> ><?=$r->room?></option>
                    <?php endforeach;?>
                  </optgroup>

                  <optgroup label="OffSite">
                    <?php foreach($offsite_rooms->result() as $k => $r):?>
                      <option value="<?=$r->id?>" <?=($row->room_id == $r->id) ? "selected" : "";?> ><?=$r->room?></option>
                    <?php endforeach;?>
                  </optgroup>

                </select>
                <?php if( $row->approval !== 'approved' ):?>
                    <a href="/admin/index/eventConflict/<?=$row->id;?>/" data-toggle="modal" data-target="#eventConflict">
                      <small>(Not Available)</small>
                    </a>
                <?php endif;?>
            </td>
            <td class="text-left"><input class="form-control form_datetime2" value="<?=date("M j, Y", strtotime($row->date_from) )?>"></td>
            <td class="text-center"><input class="form-control form_datetime21" value="<?=date("h:i a", strtotime($row->date_from) )?>"></td>
            <td class="text-center"><input class="form-control form_datetime21" value="<?=date("h:i a", strtotime($row->date_to) )?>"></td>
            <td class="text-center"><a href="#" class="btn btn-success">Update</a></td>
        </tr>
        <?php endforeach;?>

    </tbody>

</table>
</div>

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

  $('.form_datetime2').datetimepicker1({
    format: 'MMM DD, YYYY',
    showTodayButton: true
  });

  $('.form_datetime21').datetimepicker1({
    format: 'LT'
  });

  $(".form_datetime1").datetimepicker({
      format: 'M dd, yyyy',
      forceParse: true,
      autoclose: true,
      todayBtn: true,
      startDate: "<?=date("Y-m-d h:i");?>",
  });

  $(".form_datetime12").datetimepicker({
    format: "HH:ii P",
    autoclose: true,
    forceParse: true,
    todayBtn: true,
    startDate: "<?=date("Y-m-d h:i A");?>",
    showMeridian: true
  });

  $('#eventConflict').on('hidden.bs.modal', function (e) {
      //window.location.reload();
      $(e.target).removeData('bs.modal').find(".modal-content").html("");
  });


});
</script>