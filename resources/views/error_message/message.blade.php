<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<style>
.toast-top-center {
top: 2%;
margin: 0 auto;
left: 0%;
right: 50%;
}
</style>

@if(Session()->has('success'))
<script>
toastr.options = {
positionClass : "toast-top-center"
};
   toastr.success("{!!Session::get('success')!!}");
</script>
@endif
@if(Session()->has('error'))
 <script>
 toastr.options = {
positionClass : "toast-top-center"
};
   toastr.error("{!!Session::get('error')!!}");
 </script>
@endif

