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

        function new_html_table($table_data = []){

          $table_data['table_id']      = array_key_exists('table_id',$table_data) ? $table_data['table_id'] : 'nexus_table_'.rand();
          $table_data['rows']          = array_key_exists('rows',$table_data) ? count($table_data['rows']) : 10;
          $table_data['columns']       = array_key_exists('columns',$table_data) ? $table_data['columns'] : [];
          $table_data['row_template']  = array_key_exists('row_template',$table_data) ? $table_data['row_template'] : null;

          $cells = '';
          foreach($table_data['columns'] as $key=>$value){
            $cell_class_name = str_replace(' ', '_',strtolower($value));

            $cells .= '<th class="'.$cell_class_name.'"><span class="single_line">'.$value.'<button type=button class="plain fa fa-sort"></button></span></th>';
          }

          $table_menu = '
            <nav class="menu">
              <div class=item>
                <span class="fa fa-bars"></span>
                <div class="menu">
                  <button class="item plain" onclick="$(\'#(#table_id#)\')[0].add_row();">Add New Row</button>
                </div>
              </div>
            </nav>
          ';


          $table_menu  = $this->parse_template($table_menu,$table_data);
          $header_data = $this->parse_template('html_table_head_row.template',['cells'=>$cells,'menu'=>$table_menu]);
          $footer_data = $this->parse_template('html_table_foot_row.template',['cells'=>$cells]);

          $minimum_table_columns  = max(count($table_data['columns']),0);
          $body_data = '';
          for($i=0; $i<$table_data['rows']; $i++){
            $cells = '';
            if($table_data['row_template']){
                $cells .= $table_data['row_template'];
            }
            else{
              for($j=0; $j<$minimum_table_columns; $j++){
                $cells .= '<td></td>';
              }
            }

            $body_data .= $this->parse_template('html_table_body_row.template',['cells'=>$cells]);
          }

          $template_data = [
            'table_id'      => $table_data['table_id'],
            'column_count'  => count($table_data['columns'])+1,
            'header_data'   => $header_data,
            'body_data'     => $body_data,
            'footer_data'   => $footer_data,
            'row_template'  => $this->parse_template('html_table_body_row.template',['cells'=>$table_data['row_template']])
          ];

          return $this->parse_template('html_table.template',$template_data);
        }
    }
?>
