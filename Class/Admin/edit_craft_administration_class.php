<?php

require_once './Class/Admin/head_of_administration_class.php';

class EditCraftAdministration extends headOfAdministration {

    private $new_name;
    private $new_city;
    private $new_specialization;
    private $all_crafts_skills;
    private $new_skill;
    private $all_crafts_tel;
    private $new_tel;
    private $new_email;
    private $current_web;
    private $new_web;
    private $new_protocol;
    private $submit_edit;


    private function setEditAtributes () {
        $this->new_name = filter_input(INPUT_POST, 'new_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->new_city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->new_specialization = filter_input(INPUT_POST, 'specialization', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->new_skill = filter_input(INPUT_POST, 'new_skill', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->new_tel = filter_input(INPUT_POST, 'new_tel', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->new_email = filter_input(INPUT_POST, 'new_email', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->new_web = filter_input(INPUT_POST, 'new_web', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->new_protocol = filter_input(INPUT_POST, 'new_prefix', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->submit_edit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
    }


    private function setCurrentWeb ($name) {
        $pdo = new PDO(DB, NAME, PASSWORD);
        $stmt = $pdo->prepare('SELECT web FROM crafts WHERE name=?');
        $stmt->execute([$name]);
        $row = $stmt->fetch();
        $this->current_web = $row['web'];
        return $this->current_web;
    }


    private function setAllSkills () {
        $pdo = new PDO(DB, NAME, PASSWORD);
        $stmt = $pdo->prepare('SELECT skills FROM crafts WHERE name=?');
        $stmt->execute([$this->name]);
        while ($row = $stmt->fetch()) {
            $this->all_crafts_skills = $row['skills'];
        }
        $this->all_crafts_skills = explode(',', $this->all_crafts_skills);
        return $this->all_crafts_skills;
    }


    private function setNewSkills () {
        $this->setEditAtributes();
        $this->setAllSkills();
        $all_skills = '';
        foreach ($this->all_crafts_skills as $skill) {
            echo $skill;
            $all_skills = $all_skills.', '.$skill;
        }
        echo '<br>';
        $this->new_skill = $all_skills.', '.$this->new_skill;
        echo $this->new_skill;
        echo '<br>';
        return $this->new_skill;
    }

    private function setNewTel () {
        $this->setEditAtributes();
        $this->setAllCraftTel();
        $all_tel = '';
        foreach ($this->all_crafts_tel as $tel) {
            $all_tel = $all_tel.', '.$tel;
        }
        $this->new_skill = $all_tel.', '.$this->new_tel;
        return $this->new_tel;
    }


    private function setAllCraftTel () {
        $pdo = new PDO(DB, NAME, PASSWORD);
        $stmt = $pdo->prepare('SELECT tel FROM crafts WHERE name=?');
        $stmt->execute([$this->name]);
        while ($row = $stmt->fetch()) {
            $this->all_crafts_tel = $row['tel'];
        }
        $this->all_crafts_tel = explode(',', $this->all_crafts_tel);
        return $this->all_crafts_tel;
    }



    public function selectCity () {
        $this->setAllCitys();
        $this->setHeadAtributes();
        echo '<select name="city" id="" class="form-select mb-3" aria-label=".form-select-lg example" required>';
        echo '<option>Výběr města</option>';
        for ($i = 0; $i < count($this->all_citys); $i++) {
            $selected = '';
            if ($this->city === $this->all_citys[$i]) {
                $selected = 'selected';
            }
            echo '<option value="'.$this->all_citys[$i].'"'.$selected.'>'.$this->all_citys_desc[$i].'</option>';
        }
        echo '</select>';
    }


    public function selectSpecialization () {
        $this->setAllSpecializations();
        $this->setHeadAtributes();
        echo '<select name="specialization" id="" class="form-select mb-3" aria-label=".form-select-lg example" required>';
        echo '<option>Výběr specializace</option>';
        for ($i = 0; $i < count($this->all_specializations); $i++) {
            $selected = '';
            if ($this->specialization === $this->all_specializations[$i]) {
                $selected = 'selected';
            }
            echo '<option value="'.$this->all_specializations[$i].'" '.$selected.'>'.$this->all_specializations_desc[$i].'</option>';
        }
        echo '</select>';
    }


    public function selectName () {
        $this->setHeadAtributes();
        if ($this->city && $this->specialization) {
            $pdo = new PDO(DB, NAME, PASSWORD);
            $stmt = $pdo->prepare('SELECT * FROM crafts WHERE city=? AND specialization=?');
            $stmt->execute([$this->city, $this->specialization]);
            echo '<select name="name" id="" class="form-select mb-3" aria-label=".form-select-lg example" required>';
            while ($row = $stmt->fetch()) {
                $selected = '';
                if ($this->name === $row['name']) {
                    $selected = 'selected';
                }
                echo '<option value="'.$row['name'].'" '.$selected.'>'.$row['name'].'</option>';
            }
            echo '</select>';
        }
    }


    public function setNewDataForm () {
        $this->setHeadAtributes();
        $this->setEditAtributes();
        $this->setAllProtocols();
        $this->setEmail();
        if ($this->name && $this->city && $this->specialization) {
            $this->setCurrentWeb($this->name);
            echo '<label for="new_name" class="font-weight-bold mb-3 mt-3">Change name</label>';
            echo '<input type="text" name="new_name" value="'.$this->name.'" class="form-control mb-3" placeholder="New name" required>';
            echo '<label for="new_name" class="font-weight-bold mb-3 mt-3">Add/remove skills</label><br>';
            $this->skillsCheckbox();
            echo '<textarea name="new_skill" id="" cols="30" rows="3" class="form-control mb-3 mt-3" placeholder="New skills"></textarea>';
            echo '<label for="new_name" class="font-weight-bold mb-1 mt-1">Add/remove tel</label><br>';
            $this->tellsCheckbox();
            echo '<input type="text" name="new_tel" value="" class="form-control mb-3 mt-3" placeholder="New tel">';
            echo '<label for="new_name" class="font-weight-bold mb-3 mt-3">Change email</label>';
            echo '<input type="text" name="new_email" value="'.$this->email.'" class="form-control mb-3" placeholder="New email">';
            echo '<label for="new_name" class="font-weight-bold mb-3 mt-3">Change protocol</label>';
            $this->selectProtocol();
            echo '<label for="new_name" class="font-weight-bold mb-3 mt-3">Add/Change web</label>';
            echo '<input type="text" name="new_tel" value="'.$this->current_web.'" class="form-control mb-3" placeholder="New web">';
        }
    }


    private function skillsCheckbox () { // for setNewCraftData
        $this->setAllSkills();
        foreach ($this->all_crafts_skills as $skill) {
            echo '<input type="checkbox" class="form-check-input" name="current_skill[]" value="'.$skill.'" checked>';
            echo '<label for="current_skill" class="form-check-label ml-2">'.$skill.'</label><br>';
        }
    }


    private function tellsCheckbox () {  // for setNewCraftData
        $this->setAllCraftTel();
        foreach ($this->all_crafts_tel as $tel) {
            echo '<input type="checkbox" class="form-check-input" name="current_tel[]" value="'.$tel.'" checked>';
            echo '<label for="current_tel" class="form-check-label ml-2">'.$tel.'</label><br>';
        }
    }


    public function changeCraft () {
        $this->setEditAtributes();
        $this->setNewSkills();
        $this->setNewTel();
        echo 'submit je '.$this->new_skill;
        if ($this->submit_edit === '1') {
            $pdo = new PDO(DB, NAME, PASSWORD);
            $stmt = $pdo->prepare('UPDATE crafts SET name=?, city=?, specialization=?, skills=?, tel=?, email=?, web=?, protocol=? WHERE name=?');
            $stmt->execute([$this->new_name, $this->new_city, $this->new_specialization, $this->new_skill, $this->new_tel, $this->new_email, $this->new_web, $this->new_protocol, $this->name]);
        }
    }
}