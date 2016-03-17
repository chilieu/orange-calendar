<div class="container-fluid">


        <div class="row">

            <fieldset>
                <legend>Leader <a href="#" class="btn btn-success pull-right" id="add-action">add</a></legend>
                  <div id="add-leader-contain" class="hide">
                    <?php $this->load->view('admin/partials/add-leader', array("leader" => $leader )); ?>
                  </div>
            </fieldset>
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

      $("#add-action").click(function(){

          $.post( "/admin/leader/newLeader/")
            .done(function( data ) {
              $("#add-leader-contain").removeClass("hide");
              $("#add-leader-contain").html(data);
          });
          $("#add-leader-contain").toggleClass("hide");

      });

      /* Edit */
      $(document).on("click", ".edit", function(e){
        e.preventDefault();
        var obj = $(this);
        var id = obj.attr("data-id");

          $.post( "/admin/leader/detailLeader/", { id: id })
            .done(function( data ) {
              $("#add-leader-contain").removeClass("hide");
              $("#add-leader-contain").html(data);
          });

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

      $(document).on("click", "#add-btn", function(e){
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
                console.log(data);
                if( data.status == 0 ) {
                  leader_table.ajax.reload();
                  frm[0].reset();
                  $("input.form-control").removeAttr("value");
                  $("select.form-control").val([]);
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