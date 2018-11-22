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
  </script>
@stop
@section('content') 
	<div class="accordion col-md-12">
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
			    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter first name"> 
			</div> 
			<div class="col-md-3"> 
			    <input type="text" class="form-control" id="exampleInputEmail1"  placeholder="Enter last name"> 
			</div> 
			<div class="col-md-2"> 
			    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter facebook link"> 
			</div> 
			<div class="col-md-2">  
			    <input type="number" class="form-control" id="exampleInputEmail1"  placeholder="100" value="1" > 
			</div> 
			<div class="col-md-2"> 
				<i class="fas fa-check-circle" style="font-size: 32px;"></i>
				<i class="fas fa-times-circle" style="font-size: 32px;"></i> 
			</div> 
		</div>
	</div>
@stop