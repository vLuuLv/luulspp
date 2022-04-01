
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Laundry.LuuL</div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
        
        <?php if(auth()->user()->level === 'officer' || auth()->user()->level === 'admin'): ?>
        <li onclick="show()">
            <a class="a <?php echo e(($active === "on") ? 'open1' : ''); ?>" >
                <i class='bx bxs-user-account <?php echo e(($active === "on") ? 'open1' : ''); ?>'></i>
                <span class="text-capitalize links_name <?php echo e(($active === "on") ? 'open1' : ''); ?>"><?php echo e(auth()->user()->level); ?></span>
                <i id="icon" class='bx bxs-chevron-down ms-auto <?php echo e(($active === "on") ? 'open1' : ''); ?>'></i>
            </a>
            <span class="text-capitalize tooltip <?php echo e(($active === "on") ? 'open1' : ''); ?>"><?php echo e(auth()->user()->level); ?></span>
        </li>
        <div class="dropdown pt-1 ps-4 pe-4 pb-1" id="dropdown">
            <?php if(auth()->user()->level === 'admin'): ?>
            <li>
                <a href="/officer" class="a <?php echo e(($title === "Officer | LaundryLuuL") ? 'open1' : ''); ?>">
                    <i class='bx bx-user  <?php echo e(($title === "Officer | LaundryLuuL") ? 'open1' : ''); ?>'></i>
                    <span class="links_name  <?php echo e(($title === "Officer | LaundryLuuL") ? 'open1' : ''); ?>">Officer</span>
                </a>
                <span class="tooltip  <?php echo e(($title === "Member | LaundryLuuL") ? 'open1' : ''); ?>">Officer</span>
            </li>
            <li>
                <a href="/outlet" class="a <?php echo e(($title === "Outlets | LaundryLuuL") ? 'open1' : ''); ?>">
                    <i class='bx bx-store-alt <?php echo e(($title === "Outlets | LaundryLuuL") ? 'open1' : ''); ?>'></i>
                    <span class="links_name <?php echo e(($title === "Outlets | LaundryLuuL") ? 'open1' : ''); ?>">Outlet</span>
                </a>
                <span class="tooltip <?php echo e(($title === "Outlets | LaundryLuuL") ? 'open1' : ''); ?>">Outlet</span>
            </li>
            <li>
                <a href="/package" class="a <?php echo e(($title === "Product | LaundryLuuL") ? 'open1' : ''); ?>">
                    <i class='bx bxs-user-badge <?php echo e(($title === "Product | LaundryLuuL") ? 'open1' : ''); ?>'></i>
                    <span class="links_name <?php echo e(($title === "Product | LaundryLuuL") ? 'open1' : ''); ?>">Product</span>
                </a>
                <span class="tooltip <?php echo e(($title === "Product | LaundryLuuL") ? 'open1' : ''); ?>">Product</span>
            </li>
            <?php endif; ?>
            <?php if(auth()->user()->level === 'officer' || auth()->user()->level === 'admin'): ?>    
            <li>
                <a href="/member" class="a <?php echo e(($title === "Member | LaundryLuuL") ? 'open1' : ''); ?>">
                    <i class='bx bx-user  <?php echo e(($title === "Member | LaundryLuuL") ? 'open1' : ''); ?>'></i>
                    <span class="links_name  <?php echo e(($title === "Member | LaundryLuuL") ? 'open1' : ''); ?>">Member</span>
                </a>
                <span class="tooltip  <?php echo e(($title === "Member | LaundryLuuL") ? 'open1' : ''); ?>">Member</span>
            </li>
            <li>
                <a href="/transaction" class="a <?php echo e(($title === "Transaction | LaundryLuuL") ? 'open1' : ''); ?>">
                    <i class='bx bx-transfer-alt <?php echo e(($title === "Transaction | LaundryLuuL") ? 'open1' : ''); ?>'></i>
                    <span class="links_name <?php echo e(($title === "Transaction | LaundryLuuL") ? 'open1' : ''); ?>">Transaction</span>
                </a>
                <span class="tooltip <?php echo e(($title === "Transaction | LaundryLuuL") ? 'open1' : ''); ?>">Transaction</span>
            </li>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <li>
            <a href="/order" class="a <?php echo e(($title === "Order | LaundryLuuL") ? 'open1' : ''); ?>">
                <i class='bx bx-transfer-alt <?php echo e(($title === "Order | LaundryLuuL") ? 'open1' : ''); ?>'></i>
                <span class="links_name <?php echo e(($title === "Order | LaundryLuuL") ? 'open1' : ''); ?>">Transaction</span>
            </a>
            <span class="tooltip <?php echo e(($title === "Order | LaundryLuuL") ? 'open1' : ''); ?>">Transaction</span>
        </li>
        
        <li>
            <a href="/outlets" class="a <?php echo e(($title === "Outlet | LaundryLuuL") ? 'open1' : ''); ?>">
                <i class='bx bx-store-alt <?php echo e(($title === "Outlet | LaundryLuuL") ? 'open1' : ''); ?>'></i>
                <span class="links_name <?php echo e(($title === "Outlet | LaundryLuuL") ? 'open1' : ''); ?>">Outlet</span>
            </a>
            <span class="tooltip <?php echo e(($title === "Outlet | LaundryLuuL") ? 'open1' : ''); ?>">Outlet</span>
        </li>
        
        
        <?php if(auth()->guard()->check()): ?>
        <li class="profile">
            <form action="/logout" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn" type="submit">
                    <div class="profile-details">
                        <div class="name_job">
                            <div class="name"></div>
                        </div>
                    </div>
                    <div class="name"><p class="text-end me-3 mt-1">Logout<p></div>
                        <i class='bx bx-log-out' id="log_out" href="/logout"></i>
                </button>
            </form>
        </li>
            <?php else: ?>
        <li class="profile">
            <form action="/login" method="GET">
                <?php echo csrf_field(); ?>
                <button class="btn" type="submit">
                    <div class="profile-details">
                        <div class="name_job">
                            <div class="name"></div>
                        </div>
                    </div>
                    <div class="name"><p class="text-end me-3 mt-1">Login<p></div>
                        <i class='bx bx-log-in' id="log_out" href="/login"></i>
                </button>
            </form>
        </li>
        <?php endif; ?>
    </ul>
</div><?php /**PATH F:\laravel8\laundry\resources\views/sidenav/main.blade.php ENDPATH**/ ?>