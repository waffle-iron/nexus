<?php

require_once("core/nexus_table/nexus_table.php");

class nexus_infinity_table extends nexus_table{

  function create($data = []){
      print_r('Infinity Tables use a different table structure<br/>');
      print_r('create a table that is selectable, and dynamic, with all columns<br/>');
      //$data['content'] = $this->generate_html_table($this->columns);
      $html_table = '
        <table>
          <thead>
            <tr>';

      foreach($this->user_columns as $column => $info){
        if(array_key_exists('group',$info) ){
          $html_table .= '<th>';
          $html_table .= $column;
          $html_table .= '</th>';
        }
      }

      $html_table .= '</tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      ';
      $data['content'] = $html_table;
      return parent::create($data);
  }

}

 ?>
