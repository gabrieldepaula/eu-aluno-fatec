<aside class="main-sidebar sidebar-dark-danger elevation-4">
    <a href="{{ route('student.home.index') }}" class="brand-link bg-danger" style="text-align: center;">
        <span class="brand-text font-weight-light" style="font-family: 'Fugaz One';">EuAlunoFatec</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <span class="d-block text-white">{{ $student->name }}</span>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if($student->complete)
                    <li class="nav-item">
                        <a href="../gallery.html" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="../gallery.html" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Configurações</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>