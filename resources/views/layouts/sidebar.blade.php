<li class="nav-item active">
  <a class="nav-link" href="/">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span>
  </a>
</li> 
<li class="nav-item">
  <a class="nav-link" href="items">
    <i class="fas fa-fw fa-table"></i>
    <span>Items</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="orders">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Orders</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="clients">
    <i class="fas fa-fw fa-table"></i>
    <span>Clients</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="reports">
    <i class="fas fa-fw fa-table"></i>
    <span>Reports</span></a>
</li>
<li class="nav-item">
  <a class="nav-link" href="itemtype">
    <i class="fas fa-fw fa-table"></i>
    <span>Item Type</span></a>
</li>

<script>
function loadPage(page) { 
  $.ajax({
    url: 'api/page/'+page,
    context: document.body
  }).done(function(response) { 
    $("#content_body").html(response); 
  });
};


</script>