<ul class="nav nav-tabs mt-4">

    <li class="nav-item">
      <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="{{ url('/profile') }}">
        Personla Info

      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->is('orders') ? 'active' : '' }}" href="{{ url('/orders') }}">
        Orders

      </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('change-password') ? 'active' : '' }}" href="{{ url('/change-password') }}">
          Change Password
  
        </a>
      </li>
    
</ul>

{{-- ERROR MESSAGES --}}
@if ($errors->any())
  <div class="alert alert-danger mt-2">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </div>
@endif


{{-- SESSION MESSAGES --}}
@if (session('success'))

  <div class="alert alert-success text-center mt-2" role="alert">
    {{session('success')}}
  </div>

@elseif (session('error'))

  <div class="alert alert-danger text-center mt-2" role="alert">
    {{session('error')}}
  </div>

@endif
