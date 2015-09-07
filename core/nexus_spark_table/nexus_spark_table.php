<?php

require_once("core/nexus_table/nexus_table.php");

class nexus_spark_table extends nexus_table{

  var $min_new_rows = 5;

  function create($data = []){
      print_r('Infinity Tables use a different table structure<br/>');
      print_r('create a table that is selectable, and dynamic, with all columns<br/>');

      $spark_group_fields = '<fieldset class="fieldset spark_group">';
      foreach($this->user_columns as $column => $info){
        if($info['spark_group'] == true){
          $spark_group_fields .= $this->get_form_field($info);
        }
      }
      $spark_group_fields .= '</fieldset>';

      $html_table = '
        <table>
          <thead>
            <tr>';
      $html_table .= '<th class=row_number></th>';

      foreach($this->user_columns as $column => $info){
        if($info['spark_group'] == false){
          $html_table .= '<th>';
          $html_table .= $info['readable_name'];
          $html_table .= '</th>';
        }
      }

      $html_table .= '</tr>
          </thead>
          <tbody>
      ';

      for($i=0; $i<$this->min_new_rows; $i++){
        $html_table .='<tr><td class=row_number></td>';

        foreach($this->user_columns as $column => $info){
          if($info['spark_group'] == false){
            $html_table .= '<td class="'.$info['name'].'">';
            $info['label'] = null;
            $html_table .= $this->get_form_field($info);
            $html_table .= '</td>';
          }
        }

        $html_table .= '</tr>';
      }

      $html_table .= '
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      ';
      $data['content'] = $spark_group_fields . $html_table;
      return parent::create($data);
  }

}

 ?>
