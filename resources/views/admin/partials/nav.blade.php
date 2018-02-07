
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">@lang('admin.layout.header')</li>
    <!-- Optionally, you can add icons to the links -->
    <li {{ request()->is('admin') ? 'class=active' : ''  }}><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>
    <!--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
    <li class="treeview {{ request()->is('admin/posts') ? 'active' : ''  }}">
        <a href="#"><i class="fa fa-link"></i> <span>Blog</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li {{ request()->is('admin/posts') ? 'class=active' : ''  }}><a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i><span>Ver todos los post</span></a></li>
            <li><a href="#"><i class="fa fa-pencil"></i><span>Crear un nuevo post</span></a></li>
        </ul>
    </li>
</ul>
