<div class="container-fluid">


        <div class="row">
          <form action="/admin/leader/addLeader/" id="leader-form" class="form1" name="leader_form" method="post">
            <fieldset>
                <legend>Leader</legend>

                      <div class="col-md-6">

                              <div class="form-group col-md-6">
                                  <label for="exampleInputEmail1">First name</label>
                                  <input type="text" class="form-control" name="leader[firstname]" id="firstname" placeholder="Leader's First Name" required>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="exampleInputEmail1">Last name</label>
                                  <input type="text" class="form-control" name="leader[lastname]" id="lastname" placeholder="Leader's Last Name" required>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="exampleInputEmail1">Phone</label>
                                  <input type="text" class="form-control" name="leader[phone]" id="phone" placeholder="(xxx)-xxx-xxxx">
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" class="form-control" name="leader[email]" id="email" placeholder="example@email.com">
                              </div>

                      </div>

                      <div class="col-md-6">
                              <div class="form-group col-md-12">
                                  <label for="exampleInputEmail1">Area</label>
                                  <select multiple class="form-control" size="6" name="leader[area][]">
                                    <?php foreach($areas->result() as $row):?>
                                      <option value="<?=$row->area?>"><?=$row->title?></option>
                                    <?php endforeach;?>
                                  </select>
                              </div>
                      </div>

                      <div class="col-md-12">
                              <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" data-loading-text="Adding ..." id="add-btn">Add</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                              </div>
                      </div>


            </fieldset>
          </form>
        </div>


      <div class="row">
          <div class="col-md-12">

              <table id="leader-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                      <thead>
                          <tr>
                              <th width="50px">ID</th>
                              <th width="180px">Name</th>
                              <th width="200px">Email</th>
                              <th width="200px">Phone</th>
                              <th>Area</th>
                              <th width="100px"></th>
                          </tr>
                      </thead>

                      <tbody>
                      </tbody>
              </table>

          </div>
      </div>

</div>

<script type="text/javascript">

  $(document).ready(function() {

      var leader_table = $('#leader-table').DataTable({
          "responsive": true,
          "bProcessing": true,
          'bServerSide': true,
          'sAjaxSource': '/admin/leader/getList/',
          "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col col-sm-6'p>>",
          "iDisplayLength": 10,
          "aLengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
          "sPaginationType": "full_numbers",
          "aaSorting": [[ 0, "desc" ]],
          "aoColumnDefs": [
             {
              "bSortable": false, "aTargets": [1],
              "sClass": "text-center",
              "aTargets": [ 0, 1, 2, 3, 4, 5]
              }
          ],
          "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
          },
          "fnServerParams": function(aoData) {
          },
          "fnDrawCallback": function( oSettings ) {
          }
      });

      /* Edit */
      $(document).on("click", ".edit", function(e){
        e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");

      });

      /* ban */
      $(document).on("click", ".ban", function(e){
        e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");
          var result = confirm("Do you want to ban this leader?");
          if (result) {
              $.post( "/admin/leader/banLeader/", { id: id })
                .done(function( data ) {
                  var data = $.parseJSON(data);
                  addGrowlMessage(data.status, data.message);
                  leader_table.ajax.reload();
              });
          }
      });

      /* delete */
      $(document).on("click", ".delete", function(e){
        e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");
          var result = confirm("Do you want to delete this leader?");
          if (result) {
              $.post( "/admin/leader/deleteLeader/", { id: id })
                .done(function( data ) {
                  var data = $.parseJSON(data);
                  addGrowlMessage(data.status, data.message);
                  leader_table.ajax.reload();
              });
          }
      });

      /* unban */
      $(document).on("click", ".unban", function(e){
        e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");
          var result = confirm("Do you want to re-activate this leader?");
          if (result) {
              $.post( "/admin/leader/unbanLeader/", { id: id })
                .done(function( data ) {
                  var data = $.parseJSON(data);
                  addGrowlMessage(data.status, data.message);
                  leader_table.ajax.reload();
              });
          }
      });

      $("#add-btn").click(function(e){
          e.preventDefault();
          var frm = $("#leader-form");
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
                if( data.status == 0 ) {
                  leader_table.ajax.reload();
                  frm[0].reset();
                }
                addGrowlMessage(data.status, data.message);
                setTimeout(function(){ btn.button('reset'); }, 2000);
              },
              error: function( jqXHR, textStatus, errorThrown){
                addGrowlMessage(1, errorThrown);
                  setTimeout(function(){ btn.button('reset'); }, 500);
              }

          });

      });

  });

</script>