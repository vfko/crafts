<?php


require_once './Class/Admin/edit_craft_administration_class.php';


$edit_craft_admin = new EditCraftAdministration();

?>


<form action="" class="container" method="POST">
    <div class="form-group mt-5 align-items-center justify-content-center">

    <?php

    $edit_craft_admin->selectCity();

    $edit_craft_admin->selectSpecialization();

    $edit_craft_admin->selectName();

    $edit_craft_admin->setNewDataForm();

    $edit_craft_admin->changeCraft();
    ?>

    <button type="submit" class="btn btn-success" value="1">Potvrdit</button>

    </div>
</form>