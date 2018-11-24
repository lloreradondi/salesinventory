@extends('index')

@section('css_files')
  @include('css_Files')
@stop
@section('javascript_files')
  @include('javascript_files')  
  <script>
    $( document ).ready(function() {  
    	var values = {'all':1}; 
    	var itemArray;
    	loadItems();
  	    
   //      $.ajax({
   //        data: values,
   //        type: "GET",
   //        url: 'api/items/list',
   //        context: document.body
   //      }).done(function(response) {   
   //      	itemArray = response.response; 

   //  	    var editor = new $.fn.dataTable.Editor( {
   //  	    	ajax: "api/items/update/_id_",
			//     data: itemArray,
			//     table: "#dt", 
			//     idSrc:  'id',
			//     fields: [ {
			//             label: "Name:",
			//             name: "name"
			//         }, {
			//             label: "Last name:",
			//             name: "code"
			//         }, {
			//             label: "Last name:",
			//             name: "beginning_price"
			//         }, {
			//             label: "Last name:",
			//             name: "selling_price"
			//         }, {
			//             label: "Last name:",
			//             name: "quantity"
			//         }
			//     ]
			// } );

        	

			// $('#dt').on( 'click', 'tbody td:not(:first-child)', function (e) {
		 //        editor.inline( this );
		 //    } );
   //        // var mytable = $('#dt').DataTable({
   //        //     "dom": 'lBfrtip',
   //        //     "buttons": [
   //        //         {
   //        //             extend: 'pdfHtml5',
   //        //             download: 'open'
   //        //         }
   //        //     ],
   //        //     "paging": true, 
   //        //     "searching": true,
   //        //     "ordering": true,
   //        //     "info": true, 
   //        // });

   //        // $.each(response.response, function(i, item) { 
   //        //     mytable.row.add([response.response[i].name, response.response[i].code, response.response[i].beginning_price,
   //        //                      response.response[i].selling_price, response.response[i].quantity
   //        //                     ]);
   //        // }) 
   //        // mytable.draw(); 

   //        // $('#dt tbody').on( 'click', 'p', function () {
   //        //     var data = mytable.row($(this).parents('tr')).data();
   //        //     alert(data[0]);
   //        // } );
   //      });

    
		 
		




        $('#show_item_modal').on( 'click', function () {
	    	$('#myModal').modal('show'); 
	    });

        $("#name").keypress(function(event) {  
	        if (event.keyCode == 13) {
        		addItem(); 
	        }
	    });
	    $("#beginning_price").keypress(function(event) {  
	        if (event.keyCode == 13) {
        		addItem(); 
	        }
	    });
	    $("#selling_price").keypress(function(event) {  
	        if (event.keyCode == 13) {
        		addItem(); 
	        }
	    });
	    $("#quantity").keypress(function(event) {  
	        if (event.keyCode == 13) {
        		addItem(); 
	        }
	    }); 

	    function loadItems() {
	    	var editor = new $.fn.dataTable.Editor( {
	    	ajax: "api/items/update/_id_", 
		    table: "#dt", 
		    idSrc:  'id',
		    fields: [
		    	{
		            label: "Id:",
		            name: "Id"
		        },
		    	{
		            label: "Name:",
		            name: "name"
		        }, {
		            label: "Code:",
		            name: "code"
		        }, {
		            label: "Beginning Price:",
		            name: "beginning_price"
		        }, {
		            label: "Selling Price:",
		            name: "selling_price"
		        }, {
		            label: "Quantity:",
		            name: "quantity"
		        }
		    ]
			} );
	    	$('#dt').DataTable( {  
	    			destroy: true,
				    ajax: "/api/items/list/0",
				    type: "GET",
				    columns: [ 
				    	{ data: "id" },
				        { data: "name" },
				        { data: "code" },
				        { data: "beginning_price" },
				        { data: "selling_price" },
				        { data: "quantity" }
				    ]
				} );	

	    	$('#dt').on( 'click', 'tbody td:not(:first-child)', function (e) {
		        editor.inline( this );
		    });
	    }

	    function addItem() {
	    	var name = document.getElementById('name').value;
	    	var beginning_price =  document.getElementById('beginning_price').value;
	    	var selling_price = document.getElementById('selling_price').value;
	    	var quantity = document.getElementById('quantity').value;
	    	if (!name) {
	    		alert('Name cannot be empty');
	    		return;
	    	}

	    	if (beginning_price < 0 || selling_price <0 || quantity < 0) {
	    		alert('Number inputs cannot be negative');
	    		return;
	    	}
	    	var values = {
	            'name': name,
	            'beginning_price': beginning_price,
	            'selling_price': selling_price,
	            'quantity': quantity
		    }; 
	        $.ajax({
	          data: values,
	          type: "POST",
	          url: 'api/items/save',
	          context: document.body
	        }).done(function(response) {
	        	alert(response.response);
	        	loadItems();
           		$('#myModal').modal('hide');
           		defaults();	
	        });
	    }

	    function defaults() {
	    	$("#name").val(""); 
	    	$("#beginning_price").val("1000");
	    	$("#selling_price").val("1000");
	    	$("#quantity").val("10");
	    }

 
    }); 
   </script>
@stop


@section('content')  
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
	              <th>Name</th>
	              <th>Code</th>
	              <th>Beginning Price</th>
	              <th>Selling Price</th>
	              <th>Quantity</th> 
	            </tr>
	          </thead>
	           
	        </table>
	      </div>
	    </div>
	    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	  </div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"></button>
          <h1 class="modal-title">Add Item</h1>
        </div>
        <div class="modal-body">  
			  <div class="form-group">
			    <label for="name">Name:</label>
			    <input type="text" class="form-control" id="name">
			  </div> 
			  <div class="form-group">
			    <label for="beginning_price">Beginning Price:</label>
			    <input type="number" class="form-control" id="beginning_price"  value="1000">
			  </div> 
			  <div class="form-group">
			    <label for="selling_price">Selling Price:</label>
			    <input type="number" class="form-control" id="selling_price" value="1000">
			  </div> 
			  <div class="form-group">
			    <label for="quantity">Quantity:</label>
			    <input type="number" class="form-control" id="quantity" value="10">
			  </div> 
			  <!-- <button id="add_item" type="submit" class="btn btn-default">Submit</button>  -->
        </div>
        <div class="modal-footer">
          <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div> 
    </div>
  </div>
@stop