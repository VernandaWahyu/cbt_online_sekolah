 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Navbar -->
<div class="d-sm-inline-block form-inline">
    <h5 id="datetime"></h5>
</div>

<ul class="navbar-nav ml-auto">

    <!-- <a href="{{ url('/logout') }}" class="btn btn-danger btn-sm" style="height: 30px; margin-top: 5px;">Logout</a> -->
    <a href="{{ url('/logout') }}" class="btn btn-danger btn-icon-split btn-sm" style="height: 30px;">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-right"></i>
        </span>
        <span class="text">Logout</span>
    </a>

</ul>

</nav>
<!-- End of Topbar -->