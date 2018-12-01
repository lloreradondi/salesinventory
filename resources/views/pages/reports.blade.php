@extends('index')
@section('css_files')
  @include('css_Files')
@stop
@section('javascript_files')
  @include('javascript_files')
  <script> 
  $( document ).ready(function() { 
    loadItems();

    

    function loadItems() { 
        var dt = $('#dt');
        var table = $('#dt').DataTable( { 
            dom: 'lBfrtip',
            rowReorder: {
                selector: 'td:nth-child(5)'
            },
            responsive: true,
            bAutoWidth: false, 
            buttons: [
                      {
                          extend: 'pdfHtml5',
                          download: 'open'
                      }
                  ], 
            destroy: true,
            ajax: "/api/reports/list",
            type: "GET",
            "aaSorting": [],
            columns: [ 
              { data: "id" },
              { data: "client_name"},
                { data: "item_name" },
                { data: "item_code" }, 
                { data: "selling_price" },
                { data: "item_quantity" },
                { data: "final_status" },
                { 
                  data: "facebook_link", 
                  width: "70px",
                  render: function(data, type, row, meta){
                      if(type === 'display'){
                        console.log(data);
                          data = '<a href="' + data + '" target="_blank">' + data + '</a>';
                      }

                      return data;
                   }
                },
                { data: "created_at" },
                { data: "date_difference",
                  render: function(data, type, row, meta){
                    console.log(row['final_status']);
                    if(data >= 2 && row['final_status'] == "PENDING" ){
                        data = '<strong><p style=color:red;>' + data + ' days</p></strong>';
                    } else if (data == 1  && row['final_status'] == "PENDING") {
                        data = '<strong><p style=color:yellow;>' + data + ' day</p></strong>';
                    } 
                    return data;
                  } 
                },
                { defaultContent: "<i id='approve' class='fas fa-check-circle' style='font-size: 22px;'></i><i id='reject' class='fas fa-times-circle' style=' font-size: 22px;'></i>"}
            ]
        } );  

        dt.on('click', '#approve', function (e) { 
            var data = table.row($(this).parents('tr')).data(); 
          approveOrder(data.id);
        });

        dt.on('click', '#reject', function () { 
            var data = table.row($(this).parents('tr')).data(); 
            disapproveOrder(data.id);
        });
 
      }

      function approveOrder(id) {
        var values = {
                'id': id
          }; 
          $.ajax({
              type: "POST",
              data: values,
              url: 'api/order/approve',
              context: document.body
            }).done(function(response) { 
              alert(response.response);   
              reloadAjaxTable();
            });
      }

      function disapproveOrder(id) {
        var values = {
                'id': id
          }; 
          $.ajax({
              type: "POST",
              data: values,
              url: 'api/order/disapprove',
              context: document.body
            }).done(function(response) { 
              alert(response.response.message);
              reloadAjaxTable();
            });
      }

      function reloadAjaxTable() {
        $('#dt').DataTable().ajax.reload();
      }
  })



  </script>
@stop
@section('content') 
        <!-- /.container-fluid -->
        <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table">List of Items</i>
        
         <i id="show_item_modal" class="fas fa-plus-circle" style="float: right; font-size: 24px;"></i>
      </div>
      <div class="card-body">
        <div class="table-responsive" style="word-break: break-word;">
          <table class="table table-bordered" id="dt" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Customer</th>
                <th>Item Name</th>
                <th>Code</th> 
                <th>Selling Price</th>
                <th>Quantity</th> 
                <th>Status</th> 
                <th>Facebook link</th> 
                <th>Date Ordered</th> 
                <th>Date diff.</th>
                <th>Actions</th>
              </tr>
            </thead>
             
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          @include('layouts.footer')
        </footer>

      </div>
      <!-- /.content-wrapper -->

       
@stop