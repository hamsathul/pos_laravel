

<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ url('/dashboard')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                @if(Auth::user()->can('pos.menu'))
                <li>
                    <a href="{{ route('pos')}}">
                        <span class="badge bg-pink float-end">Hot</span>
                        <i class="mdi mdi-view-dashboard-outline"></i>
                         <span> POS </span>
                    </a>
                </li>
                @endif


                @if(Auth::user()->can('employee.menu'))
                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-group"></i>
                        <span>Employee</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            @if(Auth::user()->can('employee.all'))
                            <li>
                                <a href="{{ route('all.employee')}}">All Employee</a>
                            </li>
                            @endif
                            @if(Auth::user()->can('employee.add'))
                            <li>
                                <a href="{{ route('add.employee')}}">Add Employee</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('customer.menu'))
                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Customer </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            @if(Auth::user()->can('customer.all'))
                            <li>
                                <a href="{{ route('all.customer')}}">All Customer</a>
                            </li>
                            @endif
                            @if(Auth::user()->can('customer.add'))
                            <li>
                                <a href="{{ route ('add.customer')}}">Add customer</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                @if(Auth::user()->can('supplier.menu'))
                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Supplier </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            @if(Auth::user()->can('supplier.all'))
                            <li>
                                <a href="{{ route('all.supplier')}}">All Supplier</a>
                            </li>
                            @endif
                            @if(Auth::user()->can('supplier.add'))
                            <li>
                                <a href="{{ route ('add.supplier')}}">Add Supplier</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('salary.menu'))
                <li>
                    <a href="#salary" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Employee Salary </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="salary">
                        <ul class="nav-second-level">
                            @if(Auth::user()->can('salary.advance.all'))
                            <li>
                                <a href="{{ route('all.advance.salary')}}">All Advance Salary</a>
                            </li>
                            @endif
                            @if(Auth::user()->can('salary.advance.add'))
                            <li>
                                <a href="{{ route ('add.advance.salary')}}">Add Advance Salary</a>
                            </li>
                            @endif
                            @if(Auth::user()->can('salary.pay'))
                            <li>
                                <a href="{{ route ('pay.salary')}}">Pay Salary</a>
                            </li>
                            @endif
                            @if(Auth::user()->can('salary.paid'))
                            <li>
                                <a href="{{ route ('month.salary')}}">Last Month Salary</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                <li>
                    <a href="#category" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.category')}}">All Category</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#category" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Products </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.product')}}">All Products</a>
                            </li>
                            <li>
                                <a href="{{ route('add.product')}}">Add Products</a>
                            </li>
                            <li>
                                <a href="{{ route('import.product')}}">Import Products</a>
                            </li>
                        </ul>
                    </div>
                </li>



                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Expense </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.expense')}}">Add Expense</a>
                            </li>
                            <li>
                                <a href="{{ route('today.expense')}}">Todays Expense</a>
                            </li>
                            <li>
                                <a href="{{route('month.expense')}}">Monthly Expense</a>
                            </li>
                            <li>
                                <a href="{{route('year.expense')}}">Yearly Expense</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#backup" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Database Backup </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="backup">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('database.backup')}}">Backup Database</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#orders" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Orders </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="orders">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('pending.order')}}">Pending Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('complete.order')}}">Complete Orders</a>
                            </li>
                            <li>
                                <a href="{{ route('pending.due')}}">Pending Due</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#stock" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Stock Manage </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('stock.manage')}}">Stock</a>
                            </li>


                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#role" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Roles & Permissions </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="role">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.permission')}}">All Permissions</a>
                            </li>
                            <li>
                                <a href="{{ route('all.roles')}}">All Roles</a>
                            </li>
                            <li>
                                <a href="{{ route('add.roles.permission')}}">Roles in Permission</a>
                            </li>
                            <li>
                                <a href="{{ route('all.roles.permission')}}">All Roles in Permission</a>
                            </li>

                         </ul>
                    </div>
                </li>

                <li>
                    <a href="#admin" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span> Admin Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.admin')}}">All Admin</a>
                            </li>
                            <li>
                                <a href="{{ route('add.admin')}}">Add Admin</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
