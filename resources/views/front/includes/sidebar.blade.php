
<style>


.sidenav {
 background: #F8FAFB;
 box-shadow: 2px 5px 10px gray;
 border-radius: 20px;

}
/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: black;
  display: block;
  border: none;
  background: white;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: black;
}

.subnav:hover .dropdown-btn {
  display: block;
}


/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {

  color: black;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: white;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

</style>
   

<div class="sidenav position-fixed d-none d-xl-block ">
  @php
    $term_groups=DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->where('term_taxonomy.taxonomy','term_group')
        ->select('term_taxonomy.*','terms.name','terms.status')
        ->orderBy('term_taxonomy.term_taxonomy_id','desc')
        ->get(); 
  
  @endphp
 @foreach($term_groups as $group)
  <button class="dropdown-btn">{{$group->name}} 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
      @php 
        $child=DB::table('term_taxonomy')
        ->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
        ->where('term_taxonomy.taxonomy','product_cat')
        ->where('terms.term_group',$group->term_id)
        ->select('term_taxonomy.*','terms.name','terms.status')
        ->orderBy('term_taxonomy.term_taxonomy_id','desc')
        ->get();
         @endphp 
         @foreach($child as $ch)
            <a href="#">{{$ch->name}}</a>
         @endforeach    
  </div>
 @endforeach 
</div>

