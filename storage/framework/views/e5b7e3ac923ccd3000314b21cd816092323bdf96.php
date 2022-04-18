<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm justify-content-center">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            Accessibility
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                
                
                <?php if(1===1): ?>
                    <ul class="navbar-nav me-auto">
                    </ul>
            <?php endif; ?>
            <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    
                            Test
                        </a>
                        
                        <ul class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                            <li class="nav-item">
                                <a class="dropdown-item text-white" href=""
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Uitloggen
                                </a>
                            </li>
                        </ul>





                    </li>
                </ul>
        </div>
    </div>
</nav>
<?php /**PATH D:\xampp-school\htdocs\web-portal\resources\views/components/nav-bar.blade.php ENDPATH**/ ?>