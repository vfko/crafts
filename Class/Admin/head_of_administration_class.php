<?php


class headOfAdministration {

    protected $name;
    protected $city;
    protected $city_desc;
    protected $specialization;
    protected $protocol;
    protected $email;
    protected $opt;
    protected $submit;
    protected $all_names = array(); // by city and specialization
    protected $all_citys = array();
    protected $all_citys_desc = array();
    protected $all_specializations = array();
    protected $all_specializations_desc = array();
    protected $all_protocols_prefix = array();
    protected $all_protocols_name = array();
    protected $get_admin;
    public $admin_craft = 'crafts';
    public $admin_city = 'city';
    public $admin_specialization = 'specialization';
    public $edit = 'edit';
    public $create = 'create';



    protected function setHeadAtributes () {
        $this->city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->specialization = filter_input(INPUT_POST, 'specialization', FILTER_SANITIZE_SPECIAL_CHARS);
        $this->name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    }


    protected function setSubmit() {
        $this->submit = filter_input(INPUT_GET, 'submit', FILTER_SANITIZE_SPECIAL_CHARS);
        return $this->submit;
    }


    protected function setOpt () {
        $this->opt = filter_input(INPUT_GET, 'opt', FILTER_SANITIZE_SPECIAL_CHARS);
        return $this->opt;
    }


    protected function setAllNames () {
        $pdo = new PDO(DB, NAME, PASSWORD);
        $stmt = $pdo->prepare('SELECT name FROM crafts');
        $stmt->execute();
        while ($name = $stmt->fetch()) {
            array_push($this->all_names, $name['name']);
        }
        return $this->all_names;
    }


    protected function setAllCitys () {
        $pdo = new PDO(DB, NAME, PASSWORD);
        $stmt = $pdo->prepare('SELECT * FROM city');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            array_push($this->all_citys, $row['city_name']);
            array_push($this->all_citys_desc, $row['city_description']);
        }
        return;
    }


    protected function setAllSpecializations () {
        $pdo = new PDO(DB, NAME, PASSWORD);
        $stmt = $pdo->prepare('SELECT * FROM specializations');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            array_push($this->all_specializations, $row['specialization_name']);
            array_push($this->all_specializations_desc, $row['specialization_description']);
        }
        return;
    }


    protected function setAllProtocols () {
        $pdo = new PDO(DB, NAME, PASSWORD);
        $stmt = $pdo->prepare('SELECT * FROM protocols');
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            array_push($this->all_protocols_prefix, $row['url_prefix']);
            array_push($this->all_protocols_name, $row['protocol_name']);
        }
    }


    protected function setEmail () {
        $this->setHeadAtributes();
        $pdo = new PDO(DB, NAME, PASSWORD);
        if ($this->name && $this->city && $this->specialization) {
            $stmt = $pdo->prepare('SELECT * FROM crafts WHERE name=? AND city=? AND specialization=?');
            $stmt->execute([$this->name, $this->city, $this->specialization]);
            $row = $stmt->fetch();
            $this->email = $row['email'];
            return $this->email;
        }
    }

    protected function setCraftProtocol () {
        $this->setHeadAtributes();
        $pdo = new PDO(DB, NAME, PASSWORD);
        if ($this->name && $this->city && $this->specialization) {
            $stmt = $pdo->prepare('SELECT * FROM crafts WHERE name=? AND city=? AND specialization=?');
            $stmt->execute([$this->name, $this->city, $this->specialization]);
            $row = $stmt->fetch();
            $this->protocol = $row['protocol'];
            return $this->protocol;
        }
    }


    public function selectProtocol () {
        if (!$this->all_protocols_prefix) {
            $this->setAllProtocols();
        }
        $this->setCraftProtocol();
        echo '<select name="protocol" id="" class="form-select mb-3" aria-label=".form-select-lg example">';
        $selected = '';
        if (!$this->protocol) {
            $selected = 'selected';
        }
        echo '<option '.$selected.'>Vybrat protokol</option>';
        for ($i = 0; $i < count($this->all_protocols_name); $i++) {
            $selected = '';
            if (isset($this->protocol) && in_array($this->protocol, $this->all_protocols_prefix)) {
                $selected = 'selected';
            }
            echo '<option value="'.$this->all_protocols_prefix[$i].'" '.$selected.'>'.$this->all_protocols_name[$i].'</option>';
        }
        echo '</select>';
    }


    public function getAdmin () {
        $this->get_admin = filter_input(INPUT_GET, 'admin', FILTER_SANITIZE_SPECIAL_CHARS);
        return $this->get_admin;
    }


    public function includeAdminBody () {
        $this->getAdmin();
        $this->setOpt();
        $include = [
            $this->admin_craft => [
                'main' => 'administration/craft_administration.php',
                $this->edit => 'administration/craft_administration_edit.php',
                $this->create => 'administration/craft_administration_create.php'
            ],
            $this->admin_city => [
                'main' => 'administration/city_administration.php',
                $this->edit => 'administration/city_administration_edit.php',
                $this->create => 'administration/city_administration_create.php'
            ],
            $this->admin_specialization => [
                'main' => 'administration/specialization_administration.php',
                $this->edit => 'administration/specialization_administration_edit.php',
                $this->create => 'administration/specialization_administration_create.php'
            ]
            ];
        if($this->get_admin) {
            if ($this->opt) {
                require_once $include[$this->get_admin][$this->opt];
            } else {
                require_once $include[$this->get_admin]['main'];
            }
        } else {
            require_once 'administration.php';
        }
    }


    public function textHighlight ($choice) {
        $this->getAdmin();
        $this->setOpt();
        if ($this->get_admin === $choice) {
            return "text-white";
        }

        if ($this->opt === $choice) {
            return "text-white";
        }
    }


}