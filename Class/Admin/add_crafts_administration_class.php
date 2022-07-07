<?php

require_once './Class/Admin/head_of_administration_class.php';

class AddcraftsAdministration extends headOfAdministration {

    private $skills;
    private $tel;
    private $web;


    private function setAddAtributes () {
        $this->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->skills = filter_input(INPUT_POST, 'skills', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->specialization = filter_input(INPUT_POST, 'specialization', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->web = filter_input(INPUT_POST, 'web', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->protocol = filter_input(INPUT_POST, 'protocol', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
    }

    
    public function addCraft () {
        $this->setAddAtributes();
        if ($this->submit === '1') {
            $pdo = new PDO(DB, NAME, PASSWORD);
            $stmt = $pdo->prepare('INSERT INTO crafts (name, city, specialization, skills, tel, email, web, protocol) VALUES (?,?,?,?,?,?,?,?)');
            $stmt->execute([$this->name, $this->city, $this->specialization, $this->skills, $this->tel, $this->email, $this->web, $this->protocol]);
            return header('location: ./administration.php?admin=crafts&opt=create');
        }
    }


    public function selectCity () {
        $this->setAllCitys();
       echo '<select name="city" id="" class="form-select mb-3" aria-label=".form-select-lg example" required>';
       echo '<option selected>Vybrat město</option>';
       for ($i = 0; $i < count($this->all_citys); $i++) {
        echo '<option value="'.$this->all_citys[$i].'">'.$this->all_citys_desc[$i].'</option>';
       }
       echo '</select>';
    }


    public function selectSpecialization () {
        $this->setAllSpecializations();
        echo '<select name="specialization" id="" class="form-select mb-3" aria-label=".form-select-lg example" required>';
        echo '<option selected>Vybrat specializaci</option>';
        for ($i = 0; $i < count($this->all_specializations); $i++) {
            echo '<option value="'.$this->all_specializations[$i].'">'.$this->all_specializations_desc[$i].'</option>';
        }
        echo '</select>';
    }

}