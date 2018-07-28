<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
        </form>
        <ul class="sidebar-menu">
            <li class="active">
            </li>
            <?php if ($this->session->userdata('Role_name') == "Admin") { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bar-chart-o"></i>
                        <span>Admin Panel</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="http://localhost/Projects/PremierTowels/adminpanel"><i class="fa fa-angle-double-right"></i>Admin Panel</a></li>
                    </ul>
                </li>
                <?php
            } else {
//            include 'include/leftmenu.php';
            }
            ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Setups</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>index.php/partycreation/index"><i class="fa fa-angle-double-right"></i>Party</a></li>
                    <li><a href="<?= base_url() ?>index.php/countcreation/index"><i class="fa fa-angle-double-right"></i>Count</a></li>
                    <li><a href="<?= base_url() ?>index.php/partytype/index"><i class="fa fa-angle-double-right"></i>Party Type</a></li>
                    <li><a href="<?= base_url() ?>index.php/warehouse/index"><i class="fa fa-angle-double-right"></i>Warehouse</a></li>
                </ul>
            </li>
            <li class="treeview">
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
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bar-chart-o"></i>
                            <span>Weaving</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url() ?>index.php/itemspecification/index"><i class="fa fa-angle-double-right"></i>Item Specification</a></li>
                            <li><a href="<?= base_url() ?>index.php/weavingcontract/index"><i class="fa fa-angle-double-right"></i>Weaving Contract</a></li>
                            <li><a href="<?= base_url() ?>index.php/customerorder/index"><i class="fa fa-angle-double-right"></i>Customer Order</a></li>
                            <li><a href="<?= base_url() ?>index.php/greighfabricreceiving/index"><i class="fa fa-angle-double-right"></i>Greigh Fabric Receiving</a></li>
                            <li><a href="<?= base_url() ?>index.php/greighfabricdelivery/index"><i class="fa fa-angle-double-right"></i>Greigh Fabric Delivery</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bar-chart-o"></i>
                            <span>Dying Main Menu</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url() ?>index.php/processedfabricreceiving/index"><i class="fa fa-angle-double-right"></i>Processed Fabric Receiving</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Reports</span>
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
                            <li><a href="<?= base_url() ?>index.php/rpt_yarnreceivinginward/index"><i class="fa fa-angle-double-right"></i>Yarn Receiving (Inward)</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_yarnreceivingoutward/index"><i class="fa fa-angle-double-right"></i>Yarn Delivery (Outward)</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_yarnreceivingoutwardall/index"><i class="fa fa-angle-double-right"></i>Yarn Delivery (Outward) All</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_purchasecontractsall/index"><i class="fa fa-angle-double-right"></i>Purchase Contracts All</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_purchasecontractsopened/index"><i class="fa fa-angle-double-right"></i>Purchase Contracts Opened</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_purchasecontractsclosed/index"><i class="fa fa-angle-double-right"></i>Purchase Contracts Closed</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_yarninwardpcwise/index"><i class="fa fa-angle-double-right"></i>Yarn Inward (PC Wise)</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_yarninwardpcwiseall/index"><i class="fa fa-angle-double-right"></i>Yarn Inward (PC Wise) All</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_stockposition/index"><i class="fa fa-angle-double-right"></i>Stock Position</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_stockpositiongodowns/index"><i class="fa fa-angle-double-right"></i>Stock Position Godowns</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_yarndoublingledger/index"><i class="fa fa-angle-double-right"></i>Party Wise Ledger</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_yarngodownledger/index"><i class="fa fa-angle-double-right"></i>Godown Ledger</a></li>
                            <li><a href="<?= base_url() ?>index.php/rpt_yarnledger/index"><i class="fa fa-angle-double-right"></i>Yarn Ledger</a></li>
                        </ul>
                    </li>

                </ul>
            </li>
            <li class="">
                <a href="http://localhost/Projects/PremierTowels/index.php/login/logout">
                    <i class="fa fa-dashboard"></i><span>Logout</span>
                </a>
            </li>

        </ul>
    </section>
</aside>
