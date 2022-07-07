<?php

require_once './Class/Admin/head_of_administration_class.php';
require_once './Class/Admin/add_crafts_administration_class.php';
require_once './Class/Admin/city_administration_class.php';
require_once './Class/Admin/specialization_administration_class.php';

$admin = new headOfAdministration();
$add_craft = new AddcraftsAdministration();
$add_city = new cityAdministration();
$add_spec = new specializationAdministration();

?>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="administration.php">Administrace</a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link <?php echo $admin->textHighlight($admin->admin_craft) ?>" aria-current="page" href="administration.php?admin=<?php echo $admin->admin_craft ?>">Crafts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $admin->textHighlight($admin->admin_city) ?>" href="administration.php?admin=<?php echo $admin->admin_city ?>">Města</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo $admin->textHighlight($admin->admin_specialization) ?>" href="administration.php?admin=<?php echo $admin->admin_specialization ?>">Specializace</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link <?php echo $admin->textHighlight($admin->edit) ?>" aria-current="page" href="administration.php?admin=<?php echo $admin->getAdmin() ?>&opt=<?php echo $admin->edit ?>">Editovat</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link <?php echo $admin->textHighlight($admin->create) ?>" aria-current="page" href="administration.php?admin=<?php echo $admin->getAdmin() ?>&opt=<?php echo $admin->create ?>">Vytvořit</a>
                </li>
            </ul>
        </div>
    </div>
</nav>