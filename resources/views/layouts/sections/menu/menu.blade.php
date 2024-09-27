<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"> <a class="nav-link " href="{{ auth()->user()->user_type == \App\Models\User::USER_TYPE_ADMIN ? route('admin.dashboard') : route('customer.dashboard') }}"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a>
        </li>
        @if (auth()->user()->user_type == \App\Models\User::USER_TYPE_ADMIN)
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#admin-ticket-nav" data-bs-toggle="collapse" href="#"> <i
                    class="bi bi-menu-button-wide"></i><span>Ticket</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="admin-ticket-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li> 
                    <a href="{{ route('admin.ticket.index') }}"> <i class="bi bi-circle"></i><span>List</span> </a>
                </li>
            </ul>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="#"> <i
                    class="bi bi-menu-button-wide"></i><span>Ticket</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li> 
                    <a href="{{ route('ticket.index') }}"> <i class="bi bi-circle"></i><span>List</span> </a>
                </li>
                <li> 
                    <a href="{{ route('ticket.create') }}"> <i class="bi bi-circle"></i><span>Create</span> </a>
                </li>
            </ul>
        </li>
        @endif
        
        
        {{-- <li class="nav-heading">Pages</li> --}}
    </ul>
</aside>
