@extends('index')

@section('css_files')
  @include('css_Files')
@stop
@section('javascript_files')
  @include('javascript_files')  
  <script>
    $( document ).ready(function() {  
    	var values = {'all':1}; 
    	loadItems();
  	    
        $('#show_item_modal').on( 'click', function () {
	    	$('#myModal').modal('show'); 
	    });

        $("#name").keypress(function(event) {  
	        if (event.keyCode == 13) {
        		addItem(); 
	        }
	    });
	    $("#code").keypress(function(event) {  
	        if (event.keyCode == 13) {
        		addItem(); 
	        }
	    });

	    function loadItems() {
	    	var editor = new $.fn.dataTable.Editor( {
	    	ajax: "api/itemtypes/update/_id_", 
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
		            label: "Date Created:",
		            name: "created_at"
		        }
		    ]
			} );
	    	$('#dt').DataTable( {  
	    			destroy: true,
				    ajax: "/api/itemtypes/list",
				    type: "GET",
				    columns: [ 
				    	{ data: "id" },
				        { data: "name" },
				        { data: "code" },
				        { data: "created_at" }
				    ]
				} );	

	    	$('#dt').on( 'click', 'tbody td:not(:first-child)', function (e) {
		        editor.inline( this );
		    });
	    }

	    function addItem() {
	    	var name = document.getElementById('name').value;
	    	var code =  document.getElementById('code').value; 
	    	if (!name || !code) {
	    		alert('Name/Code cannot be empty');
	    		return;
	    	}
 
	    	var values = {
	            'name': name,
	            'code': code
		    }; 
	        $.ajax({
	          data: values,
	          type: "POST",
	          url: 'api/itemtypes/save',
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
	    	$("#code").val("1000"); 
	    }

 
    }); 
   </script>
@stop


@section('content')  
	<div class="card mb-3">
	    <div class="card-header">
	      <i class="fas fa-table">List of Item Types</i>
	      
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
	              <th>Date Created</th> 
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
          <h1 class="modal-title">Add Item Type</h1>
        </div>
        <div class="modal-body">  
			  <div class="form-group">
			    <label for="name">Name:</label>
			    <input type="text" class="form-control" id="name" placeholder="NAME">
			  </div> 
			  <div class="form-group">
			    <label for="code">Code:</label>
			    <input type="text" class="form-control" id="code"  placeholder="CODE">
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