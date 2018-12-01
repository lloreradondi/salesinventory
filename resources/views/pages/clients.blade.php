@extends('index')

@section('css_files')
  @include('css_Files')
@stop
@section('javascript_files')
  @include('javascript_files') 
  <script>
    $( document ).ready(function() {  
        $.ajax({
          type: "POST",
          url: 'api/client/list',
          context: document.body
        }).done(function(response) { 

          var mytable = $('#dt').DataTable({
              "dom": 'lBfrtip',
              "buttons": [
                  {
                      extend: 'pdfHtml5',
                      download: 'open'
                  }
              ],
              "paging": true, 
              "searching": true,
              "ordering": true,
              "info": true,
              "columnDefs": [{
                  "targets": -1,
                  "data": null,
                  "defaultContent": "<p><i class='fas fa-fw fa-table'></i>rr</p>"
              }]
          });

          $.each(response.response, function(i, item) { 
              mytable.row.add([response.response[i].last_name, response.response[i].first_name, response.response[i].middle_name,
                               response.response[i].cellphone_number, response.response[i].telephone_number, 
                               response.response[i].facebook_link
                              ]);
          }) 
          mytable.draw(); 

          $('#dt tbody').on( 'click', 'p', function () {
              var data = mytable.row($(this).parents('tr')).data();
              alert(data[0]);
          } );
        });
    }); 
   </script>
@stop


@section('content')  
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      List of Clients</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dt" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Last Name</th>
              <th>First Name</th>
              <th>Middle Name</th>
              <th>Cellphone Number</th>
              <th>Telephone Number</th>
              <th>Facebook Link</th>
              <th>Actions</th>
            </tr>
          </thead>
           
        </table>
      </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
  </div>
@stop