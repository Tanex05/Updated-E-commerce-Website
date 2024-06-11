<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">TechnoBlast</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">TB</a>
        </div>
        <ul class="sidebar-menu">
            <!-- Dashboard Header -->
            <li class="menu-header">Dashboard</li>
            <!-- Dashboard -->
            <li class="dropdown">
                <a href="{{ route('home') }}" class="nav-link"><i class="fa fa-home"></i><span>Home</span></a>
            </li>
            <li class="dropdown active">
                <a href="{{ route('staff.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <!-- Starter -->
            <li class="menu-header">Manage Website</li>
            <!-- Category Dropdown -->
            <li class="dropdown {{ setActive(['category.*','sub-category.*','child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Manage Category</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['category.*']) }}"><a class="nav-link" href="{{ route('category.index') }}">Category</a></li>
                    <li class="{{ setActive(['sub-category.*']) }}"><a class="nav-link" href="{{ route('sub-category.index') }}">Sub Category</a></li>
                    <li class="{{ setActive(['child-category.*']) }}"><a class="nav-link" href="{{ route('child-category.index') }}">Child Category</a></li>
                </ul>
            </li>

            @if (Auth::user()->role == 'admin')
                <!-- API  -->
                <li class="{{ setActive(['Admin-Api.*']) }}"><a class="nav-link" href="{{ route('Admin-Api.index') }}"><i class="fas fa-cog"></i><span>Manage API</span></a></li>
            @endif





            <!-- Product Dropdown -->
            <li class="dropdown {{ setActive(['product.*','coupons.*','shipping-rule.*','reviews.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i> <span>Manage Product</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['product.*']) }}"><a class="nav-link" href="{{ route('product.index') }}">Products</a></li>
                    <li class="{{ setActive(['coupons.*']) }}"><a class="nav-link" href="{{ route('coupons.index') }}">Coupons</a></li>
                    <li class="{{ setActive(['shipping-rule.*']) }}"><a class="nav-link" href="{{ route('shipping-rule.index') }}">Shipping Rule</a></li>
                    <li class="{{ setActive(['reviews.*']) }}"><a class="nav-link" href="{{ route('reviews.index') }}">Product Review</a></li>
                </ul>
            </li>
            <!-- Brand Dropdown -->
            <li class="{{ setActive(['brand.*']) }}"><a class="nav-link" href="{{ route('brand.index') }}"><i class="fas fa-box"></i><span>Manage Brand</span></a></li>

            <!-- Product Layout -->
            <li class="dropdown {{ setActive(['slider.*','flash-sale.*','product-slider-one.*','product-slider-two.*','home-page-setting','background-images.*','flash-out.*','background-images-flashsale.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-cog"></i> <span>Product Layout</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['slider.index']) }}"><a class="nav-link" href="{{ route('slider.index') }}">Slider</a></li>
                    <li class="{{ setActive(['product-slider-one']) }}"><a class="nav-link" href="{{ route('product-slider-one') }}">Product Slider One</a></li>
                    <li class="{{ setActive(['product-slider-two']) }}"><a class="nav-link" href="{{ route('product-slider-two') }}">Product Slider Two</a></li>
                    <li class="{{ setActive(['flash-sale.*']) }}"><a class="nav-link" href="{{ route('flash-sale.index') }}">Flash-Sale Products</a></li>
                    <li class="{{ setActive(['flash-out.*']) }}"><a class="nav-link" href="{{ route('flash-out.index') }}">Flash-Out Products</a></li>
                    <li class="{{ setActive(['background-images.*']) }}"><a class="nav-link" href="{{ route('background-images.index') }}">BackgroundImage</a></li>
                    <li class="{{ setActive(['background-images-flashsale.*']) }}"><a class="nav-link" href="{{ route('background-images-flashsale.index') }}">FlashSale Background</a></li>
                    <li class="{{ setActive(['background-images-flashout.*']) }}"><a class="nav-link" href="{{ route('background-images-flashout.index') }}">Flashout Background</a></li>
                </ul>
            </li>
            <!-- Order Dropdown -->
            <li class="dropdown {{ setActive(['order.*','pending-orders.*','processed-orders.*','shipped-orders.*','delivered-orders.*','canceled-orders.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-cart-plus"></i>
                    <span>Orders</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['order.*']) }}"><a class="nav-link" href="{{ route('order.index') }}">All Orders</a></li>
                    <li class="{{ setActive(['pending-orders.*']) }}"><a class="nav-link" href="{{ route('pending-orders') }}">All Pending Orders</a></li>
                    <li class="{{ setActive(['processed-orders.*']) }}"><a class="nav-link" href="{{ route('processed-orders') }}">All Processed Orders</a></li>
                    <li class="{{ setActive(['shipped-orders.*']) }}"><a class="nav-link" href="{{ route('shipped-orders') }}">All Shipped Orders</a></li>
                    <li class="{{ setActive(['delivered-orders.*']) }}"><a class="nav-link" href="{{ route('delivered-orders') }}">All Delivered Orders</a></li>
                    <li class="{{ setActive(['canceled-orders.*']) }}"><a class="nav-link" href="{{ route('canceled-orders') }}">All Canceled Orders</a></li>
                </ul>
            </li>
            <!-- Transaction Dropdown -->
            <li class="{{ setActive(['transaction']) }}"><a class="nav-link" href="{{ route('transaction') }}"><i class="fas fa-money-bill-alt"></i><span>Transactions</span></a></li>
            <!-- Advertisement Dropdown -->
            <li><a class="nav-link {{ setActive(['advertisement.*']) }}" href="{{ route('advertisement.index') }}"><i class="fas fa-ad"></i><span>Advertisement</span></a></li>

            <!-- Manage Dropdown -->
            <li class="dropdown {{ setActive(['faq.*','about.*','terms-and-conditions.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i><span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['faq.*']) }}"><a class="nav-link" href="{{ route('faq.index') }}">FAQ</a></li>
                    <li class="{{ setActive(['about.*']) }}"><a class="nav-link" href="{{ route('about.index') }}">About page</a></li>
                    <li class="{{ setActive(['terms-and-conditions.*']) }}"><a class="nav-link" href="{{ route('terms-and-conditions.index') }}">Terms Page</a></li>
                </ul>
            </li>
            <li
                class="dropdown {{ setActive([
                    'customer.index',
                    'manage-user.index',
                    'employee-list.index',
                    'admin-list.index',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['customer.index']) }}"><a class="nav-link" href="{{ route('customer.index') }}">Customer list</a></li>
                        @if (Auth::user()->role == 'admin')
                            <li class="{{ setActive(['employee-list.index']) }}"><a class="nav-link" href="{{ route('employee-list.index') }}">Employee Lists</a></li>
                            <li class="{{ setActive(['admin-list.index']) }}"><a class="nav-link" href="{{ route('admin-list.index') }}">Admin Lists</a></li>
                            <li class="{{ setActive(['manage-user.index']) }}"><a class="nav-link" href="{{ route('manage-user.index') }}">Manage user</a></li>
                        @endif
                </ul>
            </li>
            <!-- Footer Dropdown -->
            <li class="dropdown {{ setActive(['footer-info.index','footer-socials.*','footer-grid-two.*','footer-grid-three.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i><span>Footer</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['footer-info.index']) }}"><a class="nav-link" href="{{ route('footer-info.index') }}">Footer Info</a></li>
                    <li class="{{ setActive(['footer-socials.*']) }}"><a class="nav-link" href="{{ route('footer-socials.index') }}">Footer Socials</a></li>
                    <li class="{{ setActive(['footer-grid-two.*']) }}"><a class="nav-link" href="{{ route('footer-grid-two.index') }}">Footer Grid Two</a></li>
                    <li class="{{ setActive(['footer-grid-three.*']) }}"><a class="nav-link" href="{{ route('footer-grid-three.index') }}">Footer Grid Three</a></li>
                </ul>
            </li>


        </ul>
    </aside>
</div>
