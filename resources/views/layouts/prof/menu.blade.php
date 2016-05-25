 <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <li class="nav-item start {{(Request::segment(3) == 'index') ? 'active' : '' }}  ">
            <a href="{{ url("prof/".Session::get('id_prof')."/index") }}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">Acceuil</span>
            </a>
        </li>
        <li class="nav-item {{(Request::segment(3) == 'eval') ? 'active' : '' }}  ">
            <a href="{{url("prof/".Session::get('id_prof')."/eval")}}" class="nav-link nav-toggle">
                <i class=" icon-bar-chart"></i>
                <span class="title">Évaluation</span>
                <span class="arrow"></span>
            </a>
        </li>
        <li class="nav-item {{(Request::segment(3) == 'Rapport') ? 'active' : '' }}  ">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-graph"></i>
                <span class="title">Rapport</span>
                <span class="arrow"></span>
            </a>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>