<?php require_once 'classes/middlewares.php'; ?>
<?php require_once 'classes/crud.php'; ?>
<?php middleware::session(["id"], "admin/index.php", false); ?>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand p-2" href="index.php">
        <b>DMS</b>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                <a class="nav-link" href="users.php">
                    <i class="fa fa-fw fa-users"></i>
                    <span class="nav-link-text">Users</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Topics">
                <a class="nav-link" href="topics.php">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">Topics</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Slides">
                <a class="nav-link" href="slides.php">
                    <i class="fa fa-fw fa-clone"></i>
                    <span class="nav-link-text">Slides</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Credentials">
                <a class="nav-link" href="credentials.php">
                    <i class="fa fa-fw fa-lock"></i>
                    <span class="nav-link-text">Credentials</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-white" data-toggle="modal" data-target="#logout">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- /Navigation-->