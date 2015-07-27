<?php
require_once("core/nexus_forms/nexus_forms.php");

class nexus_tripsheets extends nexus_forms{
    var $columns = ['_id','date'];

    function create(){

      $table_data = [
        'columns' => [
            'Customer','Area','Description','Time In','Time Out','Sign','Travel Time','Work Time'
          ],
        'row_template' => '
        <td contenteditable></td>
        <td contenteditable></td>
        <td>
          <select>
            <option>...</option>
            <option>Inspection</option>
            <option>Call out fee</option>
            <option>Repair</option>
            <option>Replacement</option>
            <option>Delay</option>
            <option>Stuck in traffic</option>
            <option>Incorrect address</option>
            <option>Client unavailable</option>
          </select>
        </td>
        <td><input type=time class=nexus></td>
        <td><input type=time class=nexus></td>
        <td></td>
        <td></td>
        <td></td>'
      ];

      $template_data = [
          'table' => $this->new_html_table($table_data)
      ];
      return $this->parse_template('create.template',$template_data);
    }
}

?>
