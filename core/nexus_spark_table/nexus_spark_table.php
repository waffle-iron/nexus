<?php

require_once("core/nexus_table/nexus_table.php");

class nexus_spark_table extends nexus_table{

  function create($data = []){
      print_r('Spark Tables use a different table structure<br/>');
      print_r('create a table that is selectable, and dynamic, with all columns<br/>');
      //$data['content'] = $this->generate_html_table($this->columns);
      $html_table = '
        <table>
          <thead>
            <tr>';

      $grid_columns = 1;
      $html_table .= '<th class="row_number">#</th>';
      $spark_group_fields = [];
      foreach($this->user_columns as $key => $column){
        if($column["spark_group"] != true){
          $html_table .= '<th class="'.$column["name"].'">';
          $html_table .= $column["readable_name"];
          $html_table .= '</th>';
          $grid_columns++;
        }
        else{
          $spark_group_fields[] = $column;
        }
      }

      $html_table .= '</tr>
          </thead>
          <tbody>';

      $min_rows = 5;
      for($i=0; $i<$min_rows; $i++){
        $html_table .= '<tr>';
        $html_table .= '<td class="row_number"></td>';
        foreach($this->user_columns as $key=>$column){
          if($column["spark_group"] != true){
            $html_table .= '<td class="'.$column["name"].'"><input /></td>';
          }
        }
        $html_table .= '</tr>';
      }

      $html_table .='
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      ';
      $data['content']  = '';
      $data['content'] .= $html_table;
      return parent::create($data);
  }

}

 ?>
