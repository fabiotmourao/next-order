<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-md-5">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                            <x-feathericon-home width="24" height="24" />
                            <span class="ml-2">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/orders') }}">
                            <x-sui-paper-folded width="25" height="25" />
                            <span class="ml-2">Pedidos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/configuracoes">
                            <x-iconpark-config width="24" height="24" />
                            <span class="ml-2">Configurações</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
