<div class="l-navbar show" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="/user" class="nav_logo" desc="test"><span class="nav_logo-name">HM News</span> </a>
            <div class="nav_list"> 
                <a href="/user" title="User Profile" class="nav_link {{ Request::is('user*') ? 'active' : '' }}"> <i class='bx bx-home-smile'></i> <span class="nav_name">User Profile</span> </a> 
                <a href="/dashboard/posts" title="My Posts" class="nav_link {{ Request::is('dashboard/posts*') ? 'active' : '' }}"> <i class='bx bx-file'></i> <span class="nav_name">My Posts</span></a> 
                <a href="/dashboard/traffic" title="Traffic Views" class="nav_link {{ Request::is('dashboard/traffic*') ? 'active' : '' }}"> <i class='bx bx-file'></i> <span class="nav_name">Traffic</span></a> 
            </div>
            @can('admin')    
            <div class="nav_list mt-5">
                <span class="mx-2 my-3 d-block text-white"><i class='bx bx-user'></i>  <span id="adm">Administrator</span></span>
                <a href="/dashboard/categories" title="Post Categories" class="nav_link {{ Request::is('dashboard/categories*') ? 'active' : '' }}"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Categories</span> </a> 
            </div>
            @endcan
        </div>
        <form action="/logout" method="post">
            @csrf
            <a href="/" class="nav_link"><i class='bx bx-home-alt-2'></i> HM News Site</a>
            <button type="submit" title="Logout" class="nav_link bg-transparent border-0">
                <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span>
            </button>
        </form>
    </nav>
</div>
{{-- reff https://bbbootstrap.com/snippets/bootstrap-5-sidebar-menu-toggle-button-34132202# --}}