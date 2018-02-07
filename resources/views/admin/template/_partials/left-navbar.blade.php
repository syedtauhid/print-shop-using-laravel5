<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img src="{{asset('images/user.png')}}" alt="user-img" class="img-circle"></div>Steave Gection
                <!-- <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span></a> -->
                <!-- <ul class="dropdown-menu animated">
                  <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                  <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                  <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="login.html"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul> -->
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li> <a href="#" class="waves-effect"><i class="fa fa-bars fa-fw" data-icon="v"></i> <span class="hide-menu"> Order <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('admin.order.status','new')}}">New Order
                            <span class="label label-rouded label-custom pull-right">{{!empty($orderCount['new'])?$orderCount['new']:0}}
                            </span>
                        </a>
                    </li>
                    <li> <a href="{{route('admin.order.status','prog-upload')}}">Uploaded For Review Order
                            <span class="label label-rouded label-purple pull-right">{{!empty($orderCount['prog-upload'])?$orderCount['prog-upload']:0}}
                            </span>
                        </a>
                    </li>
                    <li> <a href="{{route('admin.order.status','prog-review')}}">Reviewed Order
                            <span class="label label-rouded label-success pull-right">{{!empty($orderCount['prog-review'])?$orderCount['prog-review']:0}}
                            </span>
                        </a>
                    </li>
                    <li> <a href="{{route('admin.order.status','approved')}}">Approved Order
                            <span class="label label-rouded label-info pull-right">{{!empty($orderCount['approved'])?$orderCount['approved']:0}}
                            </span>
                        </a>
                    </li>
                    <li> <a href="{{route('admin.order.status','production')}}">Production Order
                            <span class="label label-rouded label-primary pull-right">{{!empty($orderCount['production'])?$orderCount['production']:0}}
                            </span>
                        </a>
                    </li>
                    <li> <a href="{{route('admin.order.status','pick')}}">Ready For Pick
                            <span class="label label-rouded label-warning pull-right">{{!empty($orderCount['pick'])?$orderCount['pick']:0}}
                            </span>
                        </a>
                    </li>
                    <li> <a href="{{route('admin.order.status','ship')}}">In Shipment
                            <span class="label label-rouded label-custom pull-right">{{!empty($orderCount['ship'])?$orderCount['ship']:0}}
                            </span>
                        </a>
                    </li>
                    <li> <a href="{{route('admin.order.status','completed')}}">Completed Order
                            <span class="label label-rouded label-danger pull-right">{{!empty($orderCount['completed'])?$orderCount['completed']:0}}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li> <a href="#" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu">Templates <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('admin.template.index')}}">List</a> </li>
                    <li> <a href="{{route('admin.template.create')}}">Add New</a> </li>
                </ul>
            </li>

            <li> <a href="#" class="waves-effect"><i class="fa fa-tags fa-fw" data-icon="v"></i> <span class="hide-menu"> Category <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('admin.category.index')}}">Category List</a> </li>
                    <li> <a href="{{route('admin.category.create')}}">Add Category</a> </li>
                </ul>
            </li>

            <li> <a href="#" class="waves-effect"><i class="fa fa-certificate fa-fw" data-icon="v"></i> <span class="hide-menu">Special Category <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('admin.special.category.index')}}">List</a> </li>
                    <li> <a href="{{route('admin.special.category.create')}}">Add New</a> </li>
                </ul>
            </li>

            <li> <a href="#" class="waves-effect"><i class="fa fa-percent fa-fw" data-icon="v"></i> <span class="hide-menu"> Tax Exempt <span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li> <a href="{{route('admin.tax-exempt')}}">Upload Form</a> </li>
                    <li> <a href="{{route('admin.tax-exempt.accepted')}}">Accepted Certificates</a> </li>
                    <li> <a href="{{route('admin.tax-exempt.pending')}}">Pending Certificates</a> </li>
                </ul>
            </li>
        </ul>
    </div>
</div>