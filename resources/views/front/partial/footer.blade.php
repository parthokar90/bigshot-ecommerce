<section class="footer">

  <div id="target" class="d-flex justify-content-center">
    <ul class="footNavUL">
      <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
      <li><a href="{{route('terms.conditions')}}">Terms & Conditions</a></li>
      <li><a href="{{route('return.policy')}}">Return Policy</a></li>
      <!-- <li><a href="#">Contact</a></li> -->
      <li><a href="#">Follow us &nbsp; <i class="fab fa-facebook"></i></a></li>

      <li><a href="#">Payment option: </a></li>
      <li><a href="#"><button class="btn btn-link">Cash</button></li>
      <li><a href="#"><button class="btn btn-link">Bkash</button></li>
      <li><a href="#"><button class="btn btn-link">Visa</button></li>
      <li><a href="#"><button class="btn btn-link">Master</button></li>
    </ul>
  </div>

</section>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{asset('assets/front/js/popper.js')}}"></script>
<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/front/js/main.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.steps.js')}}"></script>
<script type="text/javascript">
  (function($) {
    $(".wrapper .more").click(function(show) {
      var showMe = $(this)
        .closest(".product")
        .find(".container-prod");
      $(this)
        .closest(".wrapper")
        .find(".container-prod")
        .not(showMe)
        .removeClass("information");
      $(".container-prod").removeClass("social-sharing");
      showMe
        .stop(false, true)
        .toggleClass("information")
        .removeClass("social-sharing");
      show.preventDefault();
    });

    $(".wrapper .share").click(function(share) {
      var showMe = $(this)
        .closest(".product")
        .find(".container-prod");
      $(this)
        .closest(".wrapper")
        .find(".container-prod")
        .not(showMe)
        .removeClass("social-sharing");
      $(".container-prod").removeClass("information");
      showMe
        .stop(false, true)
        .toggleClass("social-sharing")
        .removeClass("information");
      share.preventDefault();
    });

    $(".wrapper .add").click(function(share) {
      var showMe = $(this)
        .closest(".product")
        .find(".cart");
      showMe.stop(false, true).addClass("added");
      var showMe = $(this)
        .closest(".product")
        .find(".container-prod");
      showMe
        .stop(false, true)
        .removeClass("social-sharing")
        .removeClass("information");
      share.preventDefault();
    });
  })(jQuery);


  // $(document).ready(function() {
  //   $('input[type="radio"]').click(function() {
  //     var inputValue = $(this).attr("value");
  //     var targetBox = $("." + inputValue);
  //     $(".box").not(targetBox).hide();
  //     $(targetBox).show();
  //   });
  // });

  $(document).ready(function() {
    $("input[name='colorRadio']").on('change', function() {
      var value = $(this).val();
      if (value == 'full') {
        $('#skuDiv').hide();
      } else {
        $('#skuDiv').show();
      }
    });
  });
  // $("#f_cancel").click(function() {
  //   $(this).is(":checked");
  //     // $("#dvPassport").show();

  // });
</script>
<script type="text/javascript">
  $(function() {
    $("#cash").click(function() {
      if ($(this).is(":checked")) {
        // $("#dvPassport").show();
        $("#hnf").hide();
        $("#hnf1").hide();
        $("#cc-name").hide();
        $("#cc-numbe").hide();
        $("#cc-expiration").hide();
        $("#cc-cvv").hide();
        $("#bks_num").hide();
      } else {
        // $("#dvPassport").hide();
        $("#hnf").show("slow");
        $("#hnf1").show("slow");
      }
    });
  });
  $(function() {
    $("#credit").click(function() {
      if ($(this).is(":checked")) {
        // $("#dvPassport").show();
        $("#hnf").show("slow");
        $("#hnf1").show("slow");
        $("#bks_num").hide();
      } else {

      }
    });
  });
  $(function() {
    $("#debit").click(function() {
      if ($(this).is(":checked")) {
        // $("#dvPassport").show();
        $("#hnf").show("slow");
        $("#hnf1").show("slow");
        $("#bks_num").hide();
      } else {

      }
    });
  });
  $(function() {
    $("#Bkash").click(function() {
      if ($(this).is(":checked")) {
        // $("#dvPassport").show();
        $("#bks_num").show("slow");
        $("#hnf").hide();
        $("#hnf1").hide();
      } else {
        $("#bks_num").hide();
        $("#bks_num").hide();
      }
    });
  });
  $('#quantity').change(function() {
    $('#quantity').onchange();
  })
  $(function() {
    setTimeout(function() {
      $("#alert").hide();
    }, 2000);
  });
</script>
<script>
  $(document).ready(function() {
    $(".nav-tabs a").click(function() {
      $(this).tab('show');
    });
  });
  $('.nav-tabs a[href="#description"]').tab('show')

  // Select first tab
  $('.nav-tabs a:first').tab('show')

  // Select last tab
  $('.nav-tabs a:last').tab('show')

  // Select fourth tab (zero-based)
  $('.nav-tabs li:eq(3) a').tab('show')
</script>
</body>

</html>