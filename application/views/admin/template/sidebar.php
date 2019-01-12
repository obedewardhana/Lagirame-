<br><br><br>
        <ul class="nav menu">
            <li class="<?php if($this->uri->uri_string() == 'admin/home') { echo 'active'; } ?>"><a href="<?php echo site_url('admin/home')?>"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> DASHBOARD</a></li>

            <li class="parent">
                        <a class="" href="" >
                    <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> USERS
                </a>
                <ul class="children collapse" id="sub-item-1">
                    <li class="<?php if($this->uri->uri_string() == 'admin/users/all_user_umum') { echo 'active'; } ?>">
                        <a class="" href="<?php echo site_url('admin/users/all_user_umum')?>">
                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> User Umum
                        </a>
                    </li>
                    <li class="<?php if($this->uri->uri_string() == 'admin/users/all_event_creators') { echo 'active'; } ?>">
                        <a class="" href="<?php echo site_url('admin/users/all_event_creators')?>">
                            <svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Event Creator
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($this->uri->uri_string() == 'admin/events/all_events') { echo 'active'; } ?>"><a href="<?php echo site_url('admin/events/all_events')?>"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> EVENTS</a></li>
            <li class="<?php if($this->uri->uri_string() == 'admin/orders/all_orders') { echo 'active'; } ?>"><a href="<?php echo site_url('admin/orders/all_orders')?>"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> ORDERS</a></li>
            <li class="<?php if($this->uri->uri_string() == 'admin/categories/all_categories') { echo 'active'; } ?>"><a href="<?php echo site_url('admin/categories/all_categories')?>"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>CATEGORIES</a></li>
            <li role="presentation" class="divider"></li>
            <li><a target="_blank" href="<?php echo site_url('home')?>">Visit Lagirame</a></li>
        </ul>