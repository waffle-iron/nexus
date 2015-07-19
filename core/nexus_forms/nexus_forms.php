<?php
    require_once("core/nexus_db/nexus_db.php");
    class nexus_forms extends nexus_db{

        function create(){
            return $this->parse_template(__FUNCTION__.'.template');
        }

        function view(){
            return $this->parse_template(__FUNCTION__.'.template');
        }

        function edit(){
            return $this->parse_template(__FUNCTION__.'.template');
        }

        function viewlist(){
            return $this->parse_template(__FUNCTION__.'.template');
        }

        function remove(){
            return $this->parse_template(__FUNCTION__.'.template');
        }
    }
?>
