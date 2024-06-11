<div class="dashboard_sidebar">
  <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
  </span>

  @php
  $settings = \App\Models\FooterInfo::first();
  @endphp
<a href="{{ route('home') }}" class="dash_logo">
        <img src="{{ optional($settings)->logo ? asset($settings->logo) : '' }}" alt="logo" class="img-fluid logo-image" style="max-height: 150px; width: auto;">
    </a>

  <ul class="dashboard_link">
      <li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
      <li><a class="active" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      <li><a href="{{ route('user.dashboard.orders.index') }}"><i class="fas fa-list-ul"></i> Orders</a></li>
      <li><a href="{{ route('user.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
      <li><a href="{{ route('user.address.index') }}"><i class="fal fa-gift-card"></i> Addresses</a></li>
      <form action="{{ route('logout') }}" method="POST">
          @csrf
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="far fa-sign-out-alt"></i> Log out</a></li>
      </form>
  </ul>
</div>

