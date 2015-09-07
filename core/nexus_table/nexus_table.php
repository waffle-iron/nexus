<?php
    require_once("core/nexus_db/nexus_db.php");
    class nexus_table extends nexus_db{

        var $columns = ['_id','_deleted'];
        var $user_columns = [];

        var $supported_datatypes = [
          'date','time','contact','contact_group'
        ];

        var $default_column_data = [
          'name'          => null,
          'readable_name' => null,
          'spark_group'   => false,
          'datatype'      => 'text'
        ];

        //TODO the construct methods must use the server request info not a variable passed!!!!!

        function __construct($data){
          //adding in the system columns: _id, _deleted
          $this->columns = array_merge(get_class_vars(__CLASS__)['columns'],$this->columns);

          //converting the class column data into the proper array structure
          foreach($this->columns as $key=>$value){
            if(!is_array($value)){
              unset($this->columns[$key]);
              $this->columns[$value] = [];
            }
          }

          //assigning default values
          foreach ($this->columns as $column_name => &$column_data) {
            if(strpos($column_name,'_') !== 0){
              $column_data['name']          = $column_name;
              $column_data['readable_name'] = $this->readable_string($column_data['name']);

              if(in_array($column_data['name'],$this->supported_datatypes) && !array_key_exists('datatype',$column_data)){
                $column_data['datatype'] = $column_data['name'];
              }

              //just to make sure it has all the necessary columns
              $column_data          = array_merge($this->default_column_data,$column_data);
              $this->user_columns[] = $column_data;
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

        function get_form_field($form_field_data = []){

          $form_field_data['id']    = array_key_exists('id',$form_field_data) ? $form_field_data['id'] : 'form_field_'.$form_field_data['name'].'_'.rand(1,100);
          $form_field_data['label'] = array_key_exists('label',$form_field_data) ? $form_field_data['label'] : $form_field_data['readable_name'];

          $form_field = '<div class="form_field '.$form_field_data['datatype'].' '.$form_field_data['name'].'">';

          if($form_field_data['label'] != null){
            $form_field .= '<label for="'.$form_field_data['id'].'" >'.$form_field_data['readable_name'].'</label>';
          }

          switch($form_field_data['datatype']){

            case 'contact_group':
            case 'contact':
            $form_field .= '<select id="'.$form_field_data['id'].'" ><option>Select contact...</option></select>';
            break;

            case 'location':
            $form_field .= '<input type=button id="'.$form_field_data['id'].'" value="Click to choose..." />';
            break;
            //contact lookup can be ajaxed
            //map field must bring a popup map selection and then the value must be sent to the input box

            default:
            $form_field .= '<input id="'.$form_field_data['id'].'" type="'.$form_field_data['datatype'].'" />';
          }

          $form_field .= '</div>';
          return $form_field;
        }
    }
?>
