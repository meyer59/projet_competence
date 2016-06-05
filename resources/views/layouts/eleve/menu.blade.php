 <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item start {{(Request::segment(2) == 'index') ? 'active' : '' }}  ">
            <a href="{{ url("eleve/index") }}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Acceuil</span>
            </a>
        </li>
         <li class="heading">
            <h3 class="uppercase">Menu</h3>
        </li>
        <li class="nav-item start {{(Request::segment(2) == 'evaluation') ? 'active' : '' }}  ">
            <a href="{{ url("eleve/evaluation") }}" class="nav-link nav-toggle">
                <i class="icon-note"></i>
                <span class="title">M'auto-evaluer</span>
            </a>
        </li>
        <li class="nav-item start {{(Request::segment(2) == 'visualisation') ? 'active' : '' }}  ">
            <a href="{{ url("eleve/visualisation") }}" class="nav-link nav-toggle">
                <i class="icon-notebook"></i>
                <span class="title">Mes resultats</span>
            </a>
        </li>
        <li class="nav-item start {{(Request::segment(2) == 'diplome') ? 'active' : '' }}  " >
            <a href="{{ url("eleve/diplome") }}" class="nav-link nav-toggle">
                <i class="icon-envelope"></i>
                <span class="title">Mes diplomes</span>
            </a>
        </li>
        <!--<li class="nav-item start ">
            <a href="" class="nav-link nav-toggle">
                <i class="icon-wrench"></i>
                <span class="title">Parametre</span>
            </a>
        </li>-->
    <!-- END SIDEBAR MENU -->
</div>