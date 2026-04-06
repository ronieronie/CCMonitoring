<nav id="sidebar" class="d-flex flex-column">
    <div class="logo">
        CC Monitoring 
    </div>

    <div class="sidebar-section" style="font-size: 10px; color: black;" >Main</div>
    <a href="{{ route('show_dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'show_dashboard' ? 'active' : '' }}" style="font-weight: normal;">
        <i class="bi bi-house-fill"></i>
        Dashboard
    </a>

    <div class="sidebar-section" style="font-size: 10px; color: black;" >general</div>
    <a href="{{ route('show_card_manager') }}" class="nav-link {{ Route::currentRouteName() == 'show_card_manager' ? 'active' : '' }}" style="font-weight: normal;">
        <i class="bi bi-credit-card"></i>
        Card Manager
    </a>

    <a href="{{ route('show_expenses') }}" class="nav-link {{ Route::currentRouteName() == 'show_expenses' ? 'active' : '' }}"  style="font-weight: normal;">
        <i class="bi bi-cash-coin"></i>
        Expenses
    </a>
</nav>