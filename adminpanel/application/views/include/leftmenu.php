<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <!--<img src="<?= base_url(); ?>assets/img/avatar3.png" class="img-circle" alt="User Image" />-->
                    <!--<img src="<?= base_url(); ?>assets/img/avatar3.png" class="img-circle" alt="User Image" />-->
                </div>
                <div class="pull-left info">
                    <p><?php echo $this->session->userdata('FirstName') .' '. $this->session->userdata('LastName') ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <!--                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>-->
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="active">
<!--                    <a href="<?= base_url(); ?>index.php/test/index">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>-->
                </li>
                <!--                        <li>
                                            <a href="pages/widgets.html">
                                                <i class="fa fa-th"></i> <span>Widgets</span> <small class="badge pull-right bg-green">new</small>
                                            </a>
                                        </li>-->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart-o"></i>
                        <span>Inventory Panel</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/Projects/PremierTowels/yarnmodule/"><i class="fa fa-angle-double-right"></i>Inventory</a></li>
<!--                        <li><a href="<?= base_url() ?>index.php/countcreation/index"><i class="fa fa-angle-double-right"></i>Count</a></li>
                        <li><a href="<?= base_url() ?>index.php/partytype/index"><i class="fa fa-angle-double-right"></i>Party Type</a></li>
                        <li><a href="<?= base_url() ?>index.php/warehouse/index"><i class="fa fa-angle-double-right"></i>Warehouse</a></li>-->
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart-o"></i>
                        <span>Register User</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url() ?>index.php/registeruser/index"><i class="fa fa-angle-double-right"></i>Register User</a></li>
<!--                        <li><a href="<?= base_url() ?>index.php/countcreation/index"><i class="fa fa-angle-double-right"></i>Count</a></li>
                        <li><a href="<?= base_url() ?>index.php/partytype/index"><i class="fa fa-angle-double-right"></i>Party Type</a></li>
                        <li><a href="<?= base_url() ?>index.php/warehouse/index"><i class="fa fa-angle-double-right"></i>Warehouse</a></li>-->
                    </ul>
                </li>
                <!--                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-laptop"></i>
                                        <span>Operation</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="treeview">
                                            <a href="#">
                                                <i class="fa fa-bar-chart-o"></i>
                                                <span>Yarn</span>
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="<?= base_url() ?>index.php/purchasecontract/index"><i class="fa fa-angle-double-right"></i>Purchase Contract</a></li>
                                                <li><a href="<?= base_url() ?>index.php/yarngrn/index"><i class="fa fa-angle-double-right"></i>GRN</a></li>
                                                <li><a href="<?= base_url() ?>index.php/yarndelivery/index"><i class="fa fa-angle-double-right"></i>Yarn Delivery</a></li>
                                                <li><a href="<?= base_url() ?>index.php/yarnreturn/index"><i class="fa fa-angle-double-right"></i>Yarn Return</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="<?= base_url() ?>index.php/adddisease/index"><i class="fa fa-angle-double-right"></i>Add Disease</a></li>
                                        <li><a href="<?= base_url() ?>index.php/diseaseslist/index"><i class="fa fa-angle-double-right"></i>Disease List </a></li>
                                    </ul>
                                </li>-->
                <li class="">
                    <a href="http://localhost/Projects/PremierTowels/index.php/login/logout">
                        <i class="fa fa-dashboard"></i><span>Logout</span>
                    </a>
                </li>
                <!--                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-edit"></i> <span>Forms</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                        <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                        <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-table"></i> <span>Tables</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                        <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="pages/calendar.html">
                                        <i class="fa fa-calendar"></i> <span>Calendar</span>
                                        <small class="badge pull-right bg-red">3</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="pages/mailbox.html">
                                        <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                        <small class="badge pull-right bg-yellow">12</small>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="#">
                                        <i class="fa fa-folder"></i> <span>Examples</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                                        <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                                        <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                                        <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                                        <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                                        <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                                        <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                                    </ul>
                                </li>-->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>