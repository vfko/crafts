<?php

include_once "config/config.php";
require_once './Class/Admin/head_of_administration_class.php';
require_once './Class/Admin/add_crafts_administration_class.php';


//
// Instance
//
$head_admin = new headOfAdministration();
$craft_admin = new AddcraftsAdministration();


?>



<form action="" class="container" method="POST">
    <div class="form-group mt-5 align-items-center justify-content-center">
        <input type="text" name="name" placeholder="Jméno a Příjmení" class="form-control mb-3" required>
        <textarea name="skills" id="" cols="30" rows="10" placeholder="skills" class="form-control mb-3" required></textarea>
        <input type="text" name="tel" placeholder="tel" class="form-control mb-3" required>
        <input type="text" name="email" placeholder="email" class="form-control mb-3">
        <input type="text" name="web" placeholder="web" class="form-control mb-3">
        
        <?php

        $craft_admin->selectProtocol();

        $craft_admin->selectCity();

        $craft_admin->selectSpecialization();

        ?>

        <button type="submit" name="submit" value="1" class="btn btn-success">Odeslat</button>
    </div>

</form>