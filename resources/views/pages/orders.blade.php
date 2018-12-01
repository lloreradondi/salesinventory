@extends('index')
@section('css_files')
  @include('css_Files')
  <style type="text/css" >
  	/* Style the buttons that are used to open and close the accordion panel */
	.accordion {
		margin: 5px;
	    background-color: #eee;
	    color: #444;
	    cursor: pointer;
	    padding: 18px;
	    width: 100%;
	    text-align: left;
	    border: none;
	    outline: none;
	    transition: 0.4s;
	}

	/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
	.active, .accordion:hover {
	    background-color: #ccc;
	}

	/* Style the accordion panel. Note: hidden by default */
	.panel { 
	    padding: 0 18px;
	    background-color: white;
	    max-height: 0;
	    overflow: hidden;
	    transition: max-height 0.2s ease-out;
	}
 
 
  </style>
@stop
@section('javascript_files')
  @include('javascript_files') 
  <script type="text/javascript">



  	function submit(response, i) {
  		var itemCode = response.data[i].code;
		var values = {
            'first_name': document.getElementById('first_name'+i).value,
            'last_name': document.getElementById('last_name'+i).value,
            'facebook_link': document.getElementById('facebook_link'+i).value,
            'item_quantity': document.getElementById('quantity'+i).value,
            'item_id': response.data[i].id,
            'item_name': response.data[i].name,
            'item_code': itemCode, 
            'beginning_price': response.data[i].beginning_price,
            'selling_price': response.data[i].selling_price,
	    }; 
    	$.ajax({
          type: "POST",
          data: values,
          url: 'api/order/save',
          context: document.body
        }).done(function(response) { 
        	if (response.error.error_message.length > 0) {
        		alert('error');
        	} else {
        		if (response.response.quantity_left <= 0) {
        			loadItems();
        		} else {
        			$("#header_quantity"+i).text(response.response.quantity_left + " REMAINING");  
        		}
    			$("#first_name"+i).val(""); 
	        	$("#last_name"+i).val(""); 
	        	$("#facebook_link"+i).val("");
	        	$("#quantity"+i).val("1");
        		alert(response.response.message); 
        		reloadAjaxTable(i, itemCode);
        		resizeAccordion(i);
        		
        	}
        	  
			
        });
  	}

  	function loadItems() {
  		$.ajax({
          type: "GET",
          url: 'api/items/list/1',
          context: document.body
        }).done(function(response) { 
        	$('#myBody').html(""); 
			$.each(response.data, function(i, item) { 
				var myAccordion = "<div id='acc"+i+"' class='accordion col-md-12 active'><div class='row'><div class='col-md-3'>"+response.data[i].name+"</div><div class='col-md-3' id='header_quantity"+i+"'>"+response.data[i].quantity+" REMAINING</div><div class='col-md-3'>"+response.data[i].code+"</div><div class='col-md-3'>PHP "+response.data[i].selling_price+"</div></div></div>";
				var myInputs = "<div id='ppp"+i+"' class='panel'><div class='row'><div class='col-md-3'><input type='text' class='form-control' id='first_name"+i+"' placeholder='Enter first name'></div> <div class='col-md-3'><input type='text' class='form-control' id='last_name"+i+"'placeholder='Enter last name'></div><div class='col-md-3'><input type='text' class='form-control' id='facebook_link"+i+"'placeholder='Enter facebook link'></div> <div class='col-md-3'> <input type='number' class='form-control' id='quantity"+i+"'placeholder='100' value='1' > </div> </div>" +
				"<div class='card-body' id='mycardbody"+i+"'>" +
			      "<div class='table-responsive'>" +
			        "<table class='table table-bordered' id='dt"+i+"' width='100%' cellspacing='0'>" +
			          "<thead>" +
			            "<tr>" +
			              "<th>Id</th>" +
			              "<th>First Name</th>" +
			              "<th>Last Name</th>" +
			              "<th>Selling Price</th>" +
			              "<th>Quantity</th>" +
			              "<th>Date Ordered</th>" +
			              "<th>Actions</th>" +
			            "</tr>" +
			          "</thead>" +
			        "</table>" +
			      "</div>" +
			    "</div> </div>";
	        	$('#myBody').append(myAccordion + myInputs);


        		$(document).on('change', '[name="dt'+i+'_length"]', function(){
			  		resizeAccordion(i);
			  	});
        		loadDataTable(i, response.data[i].code);
	        	$("#first_name"+i).keypress(function(event) {  
			        if (event.keyCode == 13) {
		        		submit(response, i); 
			        }
			    });

			    $("#last_name"+i).keypress(function(event) {  
			        if (event.keyCode == 13) {
		        		submit(response, i); 
			        }
			    });

			    $("#facebook_link"+i).keypress(function(event) {  
			        if (event.keyCode == 13) {
		        		submit(response, i); 
			        }
			    });

			    $("#quantity"+i).keypress(function(event) {  
			        if (event.keyCode == 13) {
		        		submit(response, i);
			            
			        }
			    });
            })   

            var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
			  acc[i].addEventListener("click", function() {
			    this.classList.toggle("active");
			    var panel = this.nextElementSibling;
			    if (panel.style.maxHeight){
			      panel.style.maxHeight = null;
			    } else {
			      panel.style.maxHeight = panel.scrollHeight + "px";
			    } 
			  });
			}
        });
  	}

  	function resizeAccordion(id) {
		document.getElementById("ppp"+id).style.maxHeight = 100000 +"px";
	}
 

	function reloadAjaxTable(i, code) {
		$('#dt' + i).DataTable().ajax.reload();
	}

  	function loadDataTable(i, code) {
  		var dt = $('#dt'+i);
  		
  		var table = $("#dt"+ i).dataTable();
  		table = dt.DataTable({  
			destroy: true,
			"aaSorting": [],
		    ajax: "/api/orders/list/"+code,
		    type: "GET",
		    columns: [ 
		    	{ data: "id" },
		        { data: "first_name" },
		        { data: "last_name" },
		        { data: "selling_price" },
		        { data: "item_quantity" },
		        { data: "created_at" },
		        { defaultContent: "<i id='approve' class='fas fa-check-circle' style='font-size: 22px; display:none;'></i><i id='reject' class='fas fa-times-circle' style=' font-size: 22px;'></i>"}
		    ]
		} );

		dt.on('click', '#approve', function (e) {
            var data = table.row($(this).parents('tr')).data();
      		approveOrder(i, data.id, data.item_code);
        });

        dt.on('click', '#reject', function () {
            var data = table.row($(this).parents('tr')).data();
          	disapproveOrder(i, data.id, data.item_code);
        });
	}

	function approveOrder(i, id, code) {
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
        	reloadAjaxTable(i, code);
        	resizeAccordion(i);
        	console.log(i);
        });
	}

	function disapproveOrder(i, id, code) {
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
        	if (response.response.message != "Order already disapproved") {
        		
        		$("#header_quantity"+i).text(response.response.quantity_left + " REMAINING");  
        	}

        	reloadAjaxTable(i, code);
        	resizeAccordion(i); 
        });
	}

	function regenerateItemCodes() {
		$.ajax({
          type: "POST", 
          url: 'api/items/update/codes',
          context: document.body
        }).done(function(response) { 
        	alert(response.response);
        	loadItems();  
        });
	}
 
  	$( document ).ready(function() {  
         loadItems();

     	$('#newSession').click(function(){
     		regenerateItemCodes();	
     	});



    });  
  </script>
@stop
@section('content')  
	<div class="col-md-12">
		<button id="newSession" class="btn btn-primary">START NEW SESSION</button>
	</div>
	<div id="myBody"></div>
@stop