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
                <?=$row->room?> <?=($row->approval == 'approved') ? "" : "<a href='#' data-id='{$row->id}'><small>(Not Available)</small></a>";?> </td>
            <td class="text-left"><?=date("M j, Y", strtotime($row->date_from) )?></td>
            <td class="text-center"><?=date("h:i a", strtotime($row->date_from) )?></td>
            <td class="text-center"><?=date("h:i a", strtotime($row->date_to) )?></td>
        </tr>
        <?php endforeach;?>

    </tbody>

</table>