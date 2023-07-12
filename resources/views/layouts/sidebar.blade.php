<div id="side-bar" class="ps-3 pt-3 bg-white overflow-auto" style="width: 180px;">
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#home-collapse" aria-expanded="true">
                Set Up
            </button>
            <div class="collapse  show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li class="@if ($activePage == 'periodeAudit') fw-bold @endif"><a href="{{route('admin.dashboard')}}" class="link-dark rounded">Periode Audit</a>
                    </li>
                    <li class="@if ($activePage == 'unitAudit') fw-bold @endif"><a href="{{route('daftarUnit')}}" class="link-dark rounded">Unit Audit</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#home-collapse" aria-expanded="true">
                User
            </button>
            <div class="collapse  show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li class="@if ($activePage == 'auditor') fw-bold @endif"><a href="{{route('admin.dashboardAuditor')}}" class="link-dark rounded">Data Auditor</a>
                    </li>
                    <li class="@if ($activePage == 'auditee') fw-bold @endif"><a href="{{route('admin.dashboardAuditee')}}" class="link-dark rounded">Data Auditee</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-- <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#dashboard-collapse" aria-expanded="false">
                Auditee
            </button>
            <div class="collapse" id="dashboard-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('admin.dashboardAuditee')}}" class="link-dark rounded">Data</a>
                    </li>
                    <li><a href="{{route('pageTambahAuditee')}}" class="link-dark rounded">Tambah
                            Auditee</a></li>
                </ul>
            </div>
        </li>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                    data-bs-target="#orders-collapse" aria-expanded="false">
                Auditor
            </button>
            <div class="collapse" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{route('admin.dashboardAuditor')}}" class="link-dark rounded">Data</a>
                    </li>
                    <li><a href="{{route('pageTambahAuditor')}}" class="link-dark rounded">Tambah
                            Auditor</a></li>
                </ul>
            </div>
        </li> --}}
    </ul>
</div>