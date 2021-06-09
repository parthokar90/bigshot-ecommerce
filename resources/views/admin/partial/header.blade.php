<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('admin.home')}}" class="brand-link text-center" style="background: #e7e7e7;">
                <img src="{{asset('assets/common/images/logo.png')}}" alt="Bigshot Logo" class=""
                    style="opacity: .8;height: 60px;width: 100px;">
                {{-- <span class="brand-text font-weight-light">BigShot</span> --}}
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('assets/admin/default/admin-icon.png')}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            @if(Auth::guard('admin')->check())
                            {{Auth::guard('admin')->user()->name}}
                               @php 
                                $role=auth()->user()->role_id; 
                                $user=Auth::guard('admin')->user();
                               @endphp
                            @endif
                        </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                   <!-- role for admin and route  -->
                       @if($user->can('manage-dashboard'))
                        <li class="nav-item">
                            <a href="{{route('admin.home')}}"
                                class="nav-link {{isset($page) && $page=='home'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @endif 

                       @if($user->can('create-category'))
                        <li class="nav-item">
                            <a href="{{route('category.index')}}"
                                class="nav-link {{isset($page) && $page=='category'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                         </li> 
                        @endif

                        @if($user->can('manage-tag'))
                        <!-- <li class="nav-item">
                            <a href="{{route('tag.index')}}"
                                class="nav-link {{isset($page) && $page=='tag'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Tag
                                </p>
                            </a>
                        </li> -->
                        @endif
                        <!-- <li class="nav-item">
                         <a href="{{route('brand.index')}}" class="nav-link {{isset($page) && $page=='brand'?'active':''}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                        Brand                
                       </p>
                       </a>
                       </li> -->
                        @if($user->can('manage-attribute'))
                        <li class="nav-item">
                            <a href="{{route('attribute.index')}}"
                                class="nav-link {{isset($page) && $page=='attribute'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Attributes
                                </p>
                            </a>
                        </li>
                        @endif

                        @if($user->can('manage-product'))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{isset($page) && $page=='product'?'active':''}}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('product.index')}}"
                                        class="nav-link {{isset($page) && $page=='product'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('product.create')}}"
                                        class="nav-link {{isset($page) && $page=='products'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Product</p>
                                    </a>
                                </li>
                                  <!-- <li class="nav-item">
                                    <a href="{{route('attribute_stock')}}"
                                        class="nav-link {{isset($page) && $page=='products'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stock Update</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        @endif

                        @if($user->can('quick-report'))
                        <li class="nav-item">
                            <a href="{{route('quickReport')}}"
                                class="nav-link {{isset($page) && $page=='quickReport'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Quick Report
                                </p>
                            </a>
                        </li>
                        @endif
                        <!-- <li class="nav-item">
                         <a href="{{route('order.pendingOrder')}}" class="nav-link {{isset($page) && $page=='pendingOrder'?'active':''}}">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                         Pending Order
                        </p>
                        </a>
                      </li> -->
                        @if($user->can('order-history'))
                        <li class="nav-item">
                            <a href="{{route('order.allStatus')}}"
                                class="nav-link {{isset($page) && $page=='order'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Order History
                                </p>
                            </a>
                        </li>
                        @endif

                        @if($user->can('send-parcel'))
                        <li class="nav-item">
                            <a href="{{route('order.sendParcel')}}"
                                class="nav-link {{isset($page) && $page=='sendParcel'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Send Parcel
                                </p>
                            </a>
                        </li>
                        @endif

                        @if($user->can('manage-reject'))
                        <li class="nav-item">
                            <a href="{{route('order.reject')}}"
                                class="nav-link {{isset($page) && $page=='reject'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Reject
                                </p>
                            </a>
                        </li>
                        @endif

                        @if($user->can('manage-stock'))
                        <li class="nav-item">
                            <a href="{{route('order.stock')}}"
                                class="nav-link {{isset($page) && $page=='stock'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Stock
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('order.stock.lower')}}"
                                class="nav-link {{isset($page) && $page=='lowerstock'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Lower Stock
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('order.stock.old')}}"
                                class="nav-link {{isset($page) && $page=='oldstock'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Sold Out Stock List
                                </p>
                            </a>
                        </li>
                        @endif

                        @if($user->can('manage-customer'))
                        <li class="nav-item">
                            <a href="{{route('customer.index')}}"
                                class="nav-link {{isset($page) && $page=='customer'?'active':''}}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Customer List
                                </p>
                            </a>
                        </li>
                        @endif

                        @if($user->can('manage-settings'))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{isset($page) && $page=='settings'?'active':''}}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Settings
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('banner.index')}}"
                                        class="nav-link {{isset($page) && $page=='banner_images'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Banner Image</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('district.thana.postcode')}}"
                                        class="nav-link {{isset($page) && $page=='banner_images'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>District</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('customer.customerQuery')}}"
                                        class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Customer Query</p>
                                    </a>
                                </li>

                                  <li class="nav-item">
                                    <a href="{{route('role.index')}}"
                                        class="nav-link {{isset($page) && $page=='banner_images'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Role Management</p>
                                    </a>
                                </li>

                                  <li class="nav-item">
                                    <a href="{{route('user.index')}}"
                                        class="nav-link {{isset($page) && $page=='banner_images'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User Management</p>
                                    </a>
                                </li>

                               <!-- <li class="nav-item">
                                    <a href="{{route('database_backup')}}"
                                        class="nav-link {{isset($page) && $page=='banner_images'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Database Backup</p>
                                    </a>
                                </li> -->

                               <li class="nav-item">
                                    <a href="{{route('coupon.index')}}"
                                        class="nav-link {{isset($page) && $page=='banner_images'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Coupon</p>
                                    </a>
                                </li>

                                  <li class="nav-item">
                                    <a href="{{route('deliver_option')}}"
                                        class="nav-link {{isset($page) && $page=='banner_images'?'active':''}}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delivery Option</p>
                                    </a>
                                </li>



                            </ul>
                        </li>
                       @endif

                       @if($user->can('manage-report'))
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link {{isset($page) && $page=='Report'?'active':''}}">
                                <i class="nav-icon fas fa-circle"></i>
                                <p>
                                    Report
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('women.stock')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category Stock</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('sales.report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales Report</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('delivery.report')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delivery Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('reject.item')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reject Item</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('best.selling')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Best selling items</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                <a href="{{route('cancellation.items')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cancellation Items</p>
                                </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="{{route('sold.stock')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sold out stock</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="{{route('best.customer')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Best Customer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('gross.profit')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gross Profit</p>
                                    </a>
                                </li>
                                 <!-- <li class="nav-item">
                                <a href="{{route('grossSummary')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gross Profit Summary</p>
                                </a>
                                </li> -->
                            </ul>
                        </li>
                      @endif
                        <li class="nav-item">
                            <a href="{{route('logout')}}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();" class="nav-link">
                                <i class="fas fa-check nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>