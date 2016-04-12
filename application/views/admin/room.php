<style type="text/css">
.ui-sortable-helper {
    display: table;
}
</style>
<div class="container-fluid">

      <div class="row">
          <div class="col-md-12">

              <table id="room-table" class="table table-bordered ui-sortable-helper" cellspacing="0" width="100%">

                      <form action="/admin/room/addRoom/" method="POST" id="add-frm" name="add-frm">
                      <thead>
                          <tr>
                              <th width="50px" class="hide">ID</th>
                              <th>Room</th>
                              <th width="120px">OnSite</th>
                              <th width="10px">Sorting</th>
                              <th width="75px"></th>
                              <th width="75px"></th>

                          </tr>

                          <tr>
                            <td class="hide"></td>
                            <td><input type="text" class="form-control" name="room[room]" value="" placeholder="Ex: Sanctuary"></td>
                            <td>
                              <select name="room[onsite]" class="form-control">
                                <option value="onsite">On Site</option>
                                <option value="offsite">Off Site</option>
                              </select>
                            </td>
                            <td colspan="3" class="text-center"><button type="submit" class="btn btn-primary" id="save-btn" data-loading-text="Saving ..." >Save</button></td>
                          </tr>

                      </thead>
                      </form>

                      <tbody>

                        <?php foreach($rooms->result() as $k => $r):?>
                        <tr id="<?=$r->id?>" class="<?=($r->onsite == 'onsite') ? "success" : "default";?>">
                          <td class="hide text-center"><?=$r->id?></td>
                          <td><input type="text" class="form-control" name="room"  id="room-<?=$r->id?>" value="<?=$r->room?>" placeholder="Ex: Sanctuary"></td>
                          <td>
                            <select name="onsite_<?=$r->id?>" class="form-control" id="onsite-<?=$r->id?>">
                              <option value="onsite" <?=($r->onsite == 'onsite') ? "selected" : "";?> >On Site</option>
                              <option value="offsite" <?=($r->onsite == 'offsite') ? "selected" : "";?>>Off Site</option>
                            </select>
                          </td>
                          <td class="text-center"><a data-id="<?=$r->id?>" class="btn btn-default move"><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span></a></td>
                          <td class="text-center"><a data-id="<?=$r->id?>" class="btn btn-success edit"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></a></td>
                          <td class="text-center"><a data-id="<?=$r->id?>" data-name="<?=$r->room?>" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                        </tr>
                      <?php endforeach;?>

                      </tbody>

              </table>

          </div>
      </div>

</div>

<script type="text/javascript">

  $(document).ready(function() {

    //Rows Reordering
    $("#room-table tbody").rowsReOrdering({
        sOrderURL: "/admin/room/orderRoom/"
    });

    $("#save-btn").click(function(e){

          e.preventDefault();
          var frm = $("#add-frm");
          var btn = $(this);

          //set to loading before send to server
          btn.button('loading');
          $.ajax({
              type: "POST",
              dataType: "json",
              url: frm.attr("action"),
              data: frm.serialize(), // serializes the form's elements.
              success: function(data)
              {
                console.log(data);
                addGrowlMessage(data.status, data.message);
                if( data.status == 0 ) {
                  setTimeout(function(){ window.location.reload(); }, 2000);
                }
              },
              error: function( jqXHR, textStatus, errorThrown){
                addGrowlMessage(1, errorThrown);
                  setTimeout(function(){ btn.button('reset'); }, 500);
              }

          });

    });

    $(".delete").click(function(e){
      e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");
        var name = obj.attr("data-name");
          var result = confirm("Do you want to delete " +name+ "?");
          if (result) {
              $.post( "/admin/room/deleteRoom/", { id: id })
                .done(function( data ) {
                  var data = $.parseJSON(data);
                  addGrowlMessage(data.status, data.message);
                  setTimeout(function(){ window.location.reload(); }, 2000);
              });
          }
    });

    $(".edit").click(function(e){
      e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");
        var room = $("#room-" + id).val();
        var onsite = $("#onsite-" + id).val();

        $.post( "/admin/room/updateRoom/", { id: id,room: room,onsite: onsite })
          .done(function( data ) {
            var data = $.parseJSON(data);
            addGrowlMessage(data.status, data.message);
            if( 0 == data.status) {
              setTimeout(function(){ window.location.reload(); }, 2000);
            }
        });

    });

  });

</script>