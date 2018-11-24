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
		var values = {
            'first_name': document.getElementById('first_name'+i).value,
            'last_name': document.getElementById('last_name'+i).value,
            'facebook_link': document.getElementById('facebook_link'+i).value,
            'item_quantity': document.getElementById('quantity'+i).value,
            'item_name': response.data[i].name,
            'item_code': response.data[i].code, 
            'beginning_price': response.data[i].beginning_price,
            'selling_price': response.data[i].selling_price,
	    }; 
    	$.ajax({
          type: "POST",
          data: values,
          url: 'api/orders/save',
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
				var myAccordion = "<div class='accordion col-md-12 active'><div class='row'><div class='col-md-3'>"+response.data[i].name+"</div><div class='col-md-3' id='header_quantity"+i+"'>"+response.data[i].quantity+" REMAINING</div><div class='col-md-3'>"+response.data[i].code+"</div><div class='col-md-3'>PHP "+response.data[i].selling_price+"</div></div></div>";
				var myInputs = "<div class='panel'><div class='row'><div class='col-md-3'><input type='text' class='form-control' id='first_name"+i+"' placeholder='Enter first name'></div> <div class='col-md-3'><input type='text' class='form-control' id='last_name"+i+"'placeholder='Enter last name'></div><div class='col-md-3'><input type='text' class='form-control' id='facebook_link"+i+"'placeholder='Enter facebook link'></div> <div class='col-md-3'> <input type='number' class='form-control' id='quantity"+i+"'placeholder='100' value='1' > </div> </div> </div>"

	        	$('#myBody').append(myAccordion + myInputs);

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

  	$( document ).ready(function() {  
         loadItems();
    }); 

  // 	$( document ).ready(function() {  
  //       $.ajax({
  //         type: "POST",
  //         url: 'api/items/list',
  //         context: document.body
  //       }).done(function(response) { 
		// 	$.each(response.response, function(i, item) {  
  //           })  
  //       });

  //       //load accordion
  //       var acc = document.getElementsByClassName("accordion");
		// var i;

		// for (i = 0; i < acc.length; i++) {
		//   acc[i].addEventListener("click", function() {
		//     this.classList.toggle("active");
		//     var panel = this.nextElementSibling;
		//     if (panel.style.maxHeight){
		//       panel.style.maxHeight = null;
		//     } else {
		//       panel.style.maxHeight = panel.scrollHeight + "px";
		//     } 
		//   });
		// }
		// $('#first_name, #last_name, #facebook_link, #quantity').keypress(function(event) {
	 //        if (event.keyCode == 13) {
  //       		var values = {
		//             'first_name': document.getElementById('first_name').value,
		//             'last_name': document.getElementById('last_name').value,
		//             'facebook_link': document.getElementById('facebook_link').value,
		//             'quantity': document.getElementById('quantity').value,
		//             'item_name': "name",
		//             'item_code': "name",
		//             'item_quantity': 51,
		//             'beginning_price': 123321,
		//             'selling_price': 432543, 
		// 	    }; 
	 //        	$.ajax({
		//           type: "POST",
		//           data: values,
		//           url: 'api/orders/save',
		//           context: document.body
		//         }).done(function(response) { 
		//         	if (response.error.error_message.length > 0) {
		//         		alert('error');
		//         	} else {
		//         		alert(response.response);
		//         	}
					
		//         });
	 //            $('#first_name, #last_name, #facebook_link').val("");
	 //        }
	 //    });


    // }); 

  	


  </script>
@stop
@section('content') 

	<div id="myBody"></div>
	<!-- <div class="accordion col-md-12">
		<div class="row">
			<div class="col-md-3">ITEM 1</div>
			<div class="col-md-3">3 PCS REMAINING</div>
			<div class="col-md-3">CODE12121</div>
			<div class="col-md-3">PHP 1,350.00</div>
		</div>
		
	</div>
	<div class="panel">
		<div class="row"> 
			<div class="col-md-3"> 
			    <input type="text" class="form-control" id="first_name" placeholder="Enter first name" required> 
			</div> 
			<div class="col-md-3"> 
			    <input type="text" class="form-control" id="last_name"  placeholder="Enter last name" required> 
			</div> 
			<div class="col-md-3"> 
			    <input type="text" class="form-control" id="facebook_link" placeholder="Enter facebook link"> 
			</div> 
			<div class="col-md-3">  
			    <input type="number" class="form-control" id="quantity"  placeholder="100" value="1" required> 
			</div> 
		</div> 
	</div> -->

@stop