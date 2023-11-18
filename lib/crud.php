<?php
    include_once 'config/koneksi.php';

    class crud{
        public $db;

        public function __construct() {
            $this->db = new database();
        }

        public function insert($querry){
            $result = mysqli_query($this->db->koneksi, $querry);

            if ($result) {
                return $result;
            }
        }

        public function select($querry){
            $result = mysqli_query($this->db->koneksi, $querry);
            
            // $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($result) {
                return $result;
            }
        }

        public function update($querry){
            $result = mysqli_query($this->db->koneksi, $querry);

            if ($result) {
                return $result;
            }
        }

        public function delete($querry){
            $result = mysqli_query($this->db->koneksi, $querry);

            if ($result){
                return $result;
            }
        }
    }
?>