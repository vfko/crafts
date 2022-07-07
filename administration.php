<?php

require_once './config/config.php';
require_once './Class/Admin/head_of_administration_class.php';
require_once './Class/Admin/add_crafts_administration_class.php';
require_once './Class/Admin/edit_craft_administration_class.php';
require_once './Class/Admin/city_administration_class.php';
require_once './Class/Admin/specialization_administration_class.php';


//
// Instance
//
$head_admin = new headOfAdministration();
$add_craft_admin = new AddcraftsAdministration();
$edit_craft_admin = new EditCraftAdministration();
$city_admin = new cityAdministration();
$spec_admin = new specializationAdministration();


//
// Methods
//
$add_craft_admin->addCraft();


require_once "./include/head.php";
require_once "./nav/nav_administration.php";


$head_admin->includeAdminBody();


include_once "./include/footer.php";