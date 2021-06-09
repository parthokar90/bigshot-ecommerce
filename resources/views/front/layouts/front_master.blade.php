<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{asset('assets/common/images/logo.png')}}"/>
  <link rel="icon" type="image/png" href="{{asset('assets/common/images/logo.png')}}"/>

    <title>@yield('title',isset($title) ? $title : 'Home')</title>
    <!-- css start here -->
    @include('front.includes.css')
     <!-- css end here -->

     
</head>
<body>
	<div class="container-fluid">

		<!-- header part start -->
	      @include('front.includes.header')        
		<!-- header part end -->



		<!-- body part start -->	
          @yield('content')
        <!-- body part end -->
        
		<!-- footer part start -->
	    @include('front.includes.footer')
		<!-- footer part end -->
    </div>
    
		<!-- js start here -->
        @include('front.includes.js')
	   <!--  js end here  -->
		
	   
<!-- Modal for mobile device -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <div class="d-flex flex-row">
                                    <form method="get" action="{{url('/search/item')}}">
                                    <div class=" has-search ">
                                        <span class="fa fa-search form-control-feedback"></span>
                                        <input type="text" name="search" class="form-control homeSearchInput" style="width: 75%;float: left" placeholder="What do you want to find?">
                                        <button class="btn btn-primary homeSearchButton" type="submit">
                                            Search
                                        </button>
                                    </div>
                                   </form>
                                </div>
      </div>
    </div>
  </div>
</div>


<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}


$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = $(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });


  return false;
});

</script>



</body>
</html>