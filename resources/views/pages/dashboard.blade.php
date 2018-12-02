@extends('index')
@section('css_files')
  @include('css_Files')
@stop
@section('javascript_files')
  @include('javascript_files') 
  <script type="text/javascript">
    $( document ).ready(function() { 
      loadData();
      loadItems();
      function loadData() {
        $.ajax({ 
          type: "GET",
          url: 'api/reports/dashboard',
          context: document.body
        }).done(function(response) {  
          var earnings = "";
          var onHold = "";
          $.each(response.data, function(i, item) {  
            if (item.final_status == "CANCELLED") {
              $('#cancelled').text(item.total + " CANCELLED ORDER/S");
            } else if (item.final_status == "PENDING") {
              $('#pending').text(item.total + " PENDING ORDER/S");
              onHold = "CAPITAL : " + item.capital + "<br>" +  "SELLING : " + item.earnings + "<br>" + "PROFIT : " + (item.earnings - item.capital);
              $('#onhold').html(onHold);
              $('#onhold_subtitle').text('ESTIMATED EARNINGS FROM ' + item.total + " ORDER/S")

            } else if (item.final_status == "COMPLETED") {
              $('#completed').text(item.total + " PAID ORDER/S");
              earnings = "CAPITAL : " + item.capital + "<br>" +  "SELLING : " + item.earnings + "<br>" + "PROFIT : " + (item.earnings - item.capital)
              $('#earnings').html(earnings);
              $('#earning_subtitle').text('EARNINGS FROM ' + item.total + " ORDER/S")
            }
          })
         

        });
      }
 

      function loadItems() { 
          var dt = $('#dt');
          var table = $('#dt').DataTable( { 
              dom: 'lBfrtip',
              responsive: true,
              bAutoWidth: false, 
              buttons: [
                        {
                            extend: 'pdfHtml5',
                            download: 'open'
                        }
                    ], 
              destroy: true,
              ajax: "/api/reports/remainingItems",
              type: "GET",
              "aaSorting": [],
              columns: [ 
                { data: "name" },
                { data: "item_type"},
                  { data: "selling_price" },
                  { data: "beginning_price" }, 
                  { data: "quantity" } 
              ],
              initComplete: function(settings, json){ 
                   var info = this.api().page.info();
                   if (info.recordsTotal < 1) {
                      if (confirm("It seems like you have no items yet. Would you like to add?!")) {
                        $(location).attr('href', 'items');
                      } 
                   } 
               }
          } );  
        }
    });

    
  </script>
  
@stop
@section('content')
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5" id="completed">N/A!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5" id="pending">N/A!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div> 
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5" id="cancelled">N/A!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>

          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-6 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5" id="earnings">N/A!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left" id="earning_subtitle">EARNINGS!</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-6 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5" id="onhold">N/A!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <span class="float-left" id="onhold_subtitle">PENDING!</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>  
          </div>


 

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              STOCKS</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dt" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Item Type</th>
                      <th>Beginning Price</th>
                      <th>Selling Price</th>
                      <th>Remaining Stock</th> 
                    </tr>
                  </thead>  
                </table>
              </div>
            </div> 
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          @include('layouts.footer')
        </footer>

      </div>
      <!-- /.content-wrapper -->

       
@stop