<style type="text/css">
.ui-sortable-helper {
    display: table;
}
</style>
<div class="container-fluid">

      <div class="row">
          <div class="col-md-12">

              <table id="room-table" class="table table-striped table-bordered ui-sortable-helper" cellspacing="0" width="100%">

                      <form action="/admin/area/addArea/" method="POST" id="add-frm" name="add-frm">
                      <thead>
                          <tr>
                              <th width="50px" class="hide">ID</th>
                              <th>Group/Area</th>
                              <th width="75px"></th>
                              <th width="75px"></th>

                          </tr>

                          <tr>
                            <td class="hide"></td>
                            <td><input type="text" class="form-control" name="area[title]" value="" placeholder="Ex: MSQN"></td>
                            <td colspan="2" class="text-center"><button class="btn btn-primary" id="save-btn" data-loading-text="Saving ..." >Save</button></td>
                          </tr>

                      </thead>
                      </form>

                      <tbody>

                        <?php foreach($area->result() as $k => $r):?>
                        <tr id="<?=$r->id?>">
                          <td class="hide text-center"><?=$r->id?></td>
                          <td><input type="text" class="form-control" name="title"  id="title-<?=$r->id?>" value="<?=$r->title?>" placeholder="Ex: MSQN"></td>
                          <td class="text-center"><a data-id="<?=$r->id?>" class="btn btn-success edit"><span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span></a></td>
                          <td class="text-center"><a data-id="<?=$r->id?>" data-name="<?=$r->title?>" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                        </tr>
                      <?php endforeach;?>

                      </tbody>

              </table>

          </div>
      </div>

</div>

<script type="text/javascript">

  $(document).ready(function() {


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
              $.post( "/admin/area/deleteArea/", { id: id })
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
        var title = $("#title-" + id).val();

        $.post( "/admin/area/updateArea/", { id: id, title: title })
          .done(function( data ) {
            var data = $.parseJSON(data);
            addGrowlMessage(data.status, data.message);
            setTimeout(function(){ window.location.reload(); }, 2000);
        });

    });

  });

</script>