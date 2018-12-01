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
        $('#dt').DataTable( { 
            dom: 'lBfrtip',
            buttons: [
                      {
                          extend: 'pdfHtml5',
                          download: 'open'
                      }
                  ], 
            destroy: true,
            ajax: "/api/reports/list",
            type: "GET",
            columns: [ 
              { data: "id" },
              { data: "client_name"},
                { data: "item_name" },
                { data: "item_code" }, 
                { data: "selling_price" },
                { data: "item_quantity" },
                { data: "final_status" }
            ]
        } );  
 
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
        <div class="table-responsive">
          <table class="table table-bordered" id="dt" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Customer</th>
                <th>Item Name</th>
                <th>Code</th> 
                <th>Selling Price</th>
                <th>Quantity</th> 
                <th>Status</th> 
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