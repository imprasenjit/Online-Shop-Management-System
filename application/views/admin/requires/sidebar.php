                    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                        <!-- Sidebar - Brand -->
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("admin/dashboard"); ?>">
                            <div class="sidebar-brand-text mx-3"> <img src="<?= base_url("assets/images/supply_logo.png"); ?>" width="150px"></div>
                            <img src="<?= base_url("assets/images/supply_logo.png"); ?>" width="50px">
                        </a>
                        <hr class="sidebar-divider my-0">
                        <?php if ($this->session->isadmin) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url("admin/dashboard/events"); ?>">
                                    <i class="fas fa-fw fa-chart-area"></i>
                                    <span>Events</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminUser" aria-expanded="true" aria-controls="collapseAdminUser">
                                    <i class="fas fa-users"></i>
                                    <span>Admin Users</span>
                                </a>
                                <div id="collapseAdminUser" <?php if($this->router->class=="users" OR $this->router->class=="roles"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?>  aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->class=="users" AND  $this->router->method=="index" OR $this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>   href="<?= base_url("admin/users") ?>">Users List</a>
                                        <a <?php if($this->router->class=="roles" AND $this->router->method=="index" OR $this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>   href="<?= base_url("admin/roles") ?>">Users Role</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-users"></i>
                                    <span>Customers</span>
                                </a>
                                <div id="collapse2" <?php if($this->router->class=="customers"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?>  aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>   href="<?= base_url("admin/customers") ?>">All Customers</a>
                                        <a <?php if( $this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>  href="<?= base_url("admin/customers/create") ?>">Add Customer</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-box-open"></i>
                                    <span>Suppliers</span>
                                </a>
                                <div id="collapse1" <?php if($this->router->class=="suppliers"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?> aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/suppliers") ?>">All Suppliers</a>
                                        <a <?php if($this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/suppliers/create") ?>">Add Suppliers</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-warehouse"></i>
                                    <span>Warehouse</span>
                                </a>
                                <div id="collapse3" <?php if($this->router->class=="warehouse"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?> aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/warehouse") ?>">All Warehouse Users</a>
                                        <a <?php if($this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/warehouse/create") ?>">Add Warehouse user</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse44" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-stream"></i>
                                    <span>Transactions</span>
                                </a>
                                <div id="collapse44" <?php if($this->router->class=="enquires" OR $this->router->class=="quotation" OR $this->router->class=="purchase_orders" OR $this->router->class=="proforma_invoice" ){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?> aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->class=="enquires" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/enquires") ?>">All Enquiries</a>
                                        <a <?php if($this->router->class=="quotation" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/quotation") ?>">Quotation to Customer</a>
                                        <a <?php if($this->router->class=="purchase_orders" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/purchase_orders") ?>">Purchase orders From Customer</a>
                                        <a <?php if($this->router->class=="proforma_invoice" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/proforma_invoice") ?>">Proforma invoice to customer</a>
                                        <a <?php if($this->router->class=="purchase_orders" AND $this->router->method=="purchase_order_to_supplier_list"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/purchase_orders/purchase_order_to_supplier_list") ?>">Purchase orders to suppliers</a>
                                  </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-list"></i>
                                    <span>Products</span>
                                </a>
                                <div id="collapse4" <?php if($this->router->class=="category" OR $this->router->class=="sub_category" OR $this->router->class=="products" OR $this->router->class=="attribute"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?> aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->class=="category" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?> href="<?= base_url("admin/category") ?>">Category</a>
                                        <a <?php if($this->router->class=="sub_category" AND $this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>  href="<?= base_url("admin/sub_category/") ?>">Sub-Category</a>
                                        <a <?php if($this->router->class=="products" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>  href="<?= base_url("admin/products") ?>">All Products</a>
                                        <a <?php if($this->router->class=="products" AND $this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>  href="<?= base_url("admin/products/create") ?>">Add Products</a>
                                        <a <?php if($this->router->class=="attribute" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';} ?>  href="<?= base_url("admin/attribute") ?>">Attributes</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-inbox"></i>
                                    <span>Mailbox</span>
                                </a>
                                <div id="collapse7" <?php if($this->router->class=="message"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?> aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/message") ?>">Message</a>
                                        <a <?php if($this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/message/create") ?>">Compose Mail</a>
                                    </div>
                                </div>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="<?= base_url("admin/associated_brands"); ?>">
                                    <i class="fas fa-fw fa-chart-area"></i>
                                    <span>Associated Brands</span></a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transporters" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-bus"></i>
                                    <span>Transporters</span>
                                </a>
                                <div id="transporters" <?php if($this->router->class=="transporters"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?>  aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/transporters") ?>">All Transporters</a>
                                        <a <?php if($this->router->method=="create"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/transporters/create") ?>">Add Transporter</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#webManagment" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-tasks"></i>
                                    <span>Website Management</span>
                                </a>
                                <div id="webManagment" <?php if($this->router->class=="settings" OR $this->router->class=="home_page_slider" OR $this->router->class=="associated_brands" OR $this->router->class=="aboutus" OR $this->router->class=="downloads"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?>  aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->class=="home_page_slider" AND $this->router->method=="index" OR $this->router->method=="create" ){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/home_page_slider") ?>">Home Page Slider</a>
                                        <a <?php if($this->router->class=="associated_brands" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/associated_brands"); ?>">Associated Brands</a>
                                        <a <?php if($this->router->class=="testimonials" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/testimonials"); ?>">Testimonials</a>
                                        <a <?php if($this->router->class=="aboutus" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/aboutus"); ?>">About Us</a>
                                        <a <?php if($this->router->class=="downloads" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/downloads"); ?>">Downloads</a>
                                        <a <?php if($this->router->class=="settings" AND $this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/settings"); ?>">Settings</a>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blogs" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-bus"></i>
                                    <span>Blogs</span>
                                </a>
                                <div id="blogs" <?php if($this->router->class=="blogs"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?>  aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/blogs") ?>">Blogs</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#roles" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas fa-bus"></i>
                                    <span>Admin Roles</span>
                                </a>
                                <div id="roles" <?php if($this->router->class=="roles"){ echo 'class="collapse show"';}else{ echo 'class="collapse"';} ?>  aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-primary py-2 collapse-inner">
                                        <a <?php if($this->router->method=="index"){ echo 'class="collapse-item active"';}else{ echo 'class="collapse-item"';}?> href="<?= base_url("admin/roles") ?>">Roles</a>
                                    </div>
                                </div>
                            </li>
                        <?php } else if ($this->session->issupplier) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url("admin/suppliers/dashboard"); ?>">
                                    <i class="fas fa-fw fa-chart-area"></i>
                                    <span>Dashboard</span></a>
                            </li>
                        <?php } else if ($this->session->iswarehouse) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url("admin/warehouse/dashboard"); ?>">
                                    <i class="fas fa-fw fa-chart-area"></i>
                                    <span>Dashboard</span></a>
                            </li>
                        <?php } ?>
                        <div class="text-center d-none d-md-inline">
                            <button class="rounded-circle border-0" id="sidebarToggle"></button>
                        </div>
                    </ul>
