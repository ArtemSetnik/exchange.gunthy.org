<nav class="mb-1 navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav navbar-dark bg-dark-1 lighten-1">
    <a class="navbar-brand pt-0 pb-0  mr-5" href="{{ Route('home') }}">
        <img src="/img/logo.png" class="rounded-circle z-depth-0" alt="logo image">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555"
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ Route('exchange.show') }}">Exchange</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            @if (Auth::user())

            <li class="nav-item">
                <a class="nav-link" href="{{ Route('trades.historyShow') }}">Trades</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ Route('orders.historyShow') }}">Orders</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Balances</a>
                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
                    <a class="dropdown-item" href="{{ Route('accounts.fundsShow') }}">Deposit & Withdraw</a>
                    <a class="dropdown-item" href="{{ Route('accounts.transactions') }}">Transactions</a>
                    <a class="dropdown-item" href="{{ Route('accounts.wallets') }}">Wallets</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
                    <a class="dropdown-item" href="{{ url('google2fa') }}">Google 2FA</a>
                    <a class="dropdown-item" href="{{ url('apikeys') }}">API Keys</a>
                </div>
            </li>

            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle nav-avatar" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0" alt="avatar image">
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
                    <a class="dropdown-item" href="{{ Route('profile') }}">Profile</a>
                    <a class="dropdown-item" href="{{ Route('logout') }}">Logout</a>
                </div>
            </li>

            @else

            <li class="nav-item">
                <a class="nav-link" href="{{ Route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ Route('register') }}">Register</a>
            </li>

            @endif



        </ul>
    </div>
</nav>