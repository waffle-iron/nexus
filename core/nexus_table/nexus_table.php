<?php
    require_once("core/nexus_db/nexus_db.php");
    class nexus_table extends nexus_db{

        var $columns = ['_id','_deleted'];
        var $user_columns = [];

        var $default_column_data = [
          'name'          => null,
          'readable_name' => null,
          'spark_group'   => false,
          'datatype'      => 'text'
        ];

        //TODO the construct methods must use the server request info not a variable passed!!!!!

        function __construct($data){
          $this->columns = array_merge(get_class_vars(__CLASS__)['columns'],$this->columns);

          foreach($this->columns as $key=>$value){
            if(!is_array($value)){
              unset($this->columns[$key]);
              $this->columns[$value] = [];
            }
          }

          foreach ($this->columns as $key => $value) {
            if(strpos($key,'_') !== 0){
              $column_data = $this->default_column_data;
              $column_data ["name"]         = $key;
              $column_data["readable_name"] = $this->readable_string($column_data["name"]);
              $column_data                  = array_merge($column_data,$value);
              $this->user_columns[]         = $column_data;
            }
          }

          parent::__construct($data);
        }

        function create($data = []){
            $data['page_size'] = array_key_exists('page_size',$data) ? $data['page_size'] : 'a4';
            $data['page_orientation'] = array_key_exists('page_orientation',$data) ? $data['page_orientation'] : 'landscape';

            return $this->parse_template('letterhead.template',$data);
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
