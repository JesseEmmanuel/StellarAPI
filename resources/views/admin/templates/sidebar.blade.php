@php
	$activePage = basename($_SERVER['PHP_SELF']);
@endphp
<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="dropdown active"><a href="#"><i class="icon-home mr-1"></i> Home</a>
                <ul>
                    <li class="<?= ($activePage == 'dashboard') ? 'active':'' ?>"><a href="{{ url('dashboard') }}"><i class="icon-grid"></i> Dashboard</a></li>
                    <li class="<?= ($activePage == 'notifications') ? 'active':'' ?>"><a href="{{ url('notifications') }}"><i class="mdi mdi-alarm-light-outline fa-lg"></i>Notifications
                        <span class="ml-auto badge badge-danger">
                            @php
                                echo (App\Models\Notifications::countUnread());
                            @endphp
                            </span> </a></li>
                    <li class="<?= ($activePage == 'activationCodes') ? 'active':'' ?>"><a href="{{ url('activationCodes') }}"><i class="fas fa-code"></i> Activation Codes</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#"><i class="icon-organization mr-1"></i> Accounts</a>
                <ul>
                    <li class="<?= ($activePage == 'startupsavings') ? 'active':'' ?>"><a href="{{ url('startupsavings') }}"><i class="mdi mdi-account-star-outline fa-lg"></i> Start-up Savings</a></li>
                    <li class="<?= ($activePage == 'greatsavings') ? 'active':'' ?>"><a href="{{ url('greatsavings') }}"><i class="mdi mdi-account-heart-outline fa-lg"></i> Great Savings</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#"><i class="icon-layers mr-1"></i> Logs</a>
                <ul>
                    <li class="<?= ($activePage == 'users') ? 'active':'' ?>"><a href="{{ url('users') }}"><i class="mdi mdi-account-key-outline fa-lg"></i> Users</a></li>
                    <li class="<?= ($activePage == 'encashment') ? 'active':'' ?>"><a href="{{ url('encashment') }}"><i class="mdi mdi-cash-multiple fa-lg"></i> Encashment</a></li>
                    <li class="<?= ($activePage == 'rewards') ? 'active':'' ?>"><a href="{{ url('rewards') }}" ><i class="mdi mdi-wallet-giftcard fa-lg"></i> Rewards Redemption</a></li>
                </ul>
            </li>
        </ul>
        <!-- END: Menu-->
    </div>
</div>
<!-- END: Main Menu-->
