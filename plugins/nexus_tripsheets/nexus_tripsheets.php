<?php
require_once("core/nexus_spark_table/nexus_spark_table.php");

class nexus_tripsheets extends nexus_spark_table{

    var $columns = [
        'date'=>  [
          'spark_group' => true
        ],
        'team' => [
          'spark_group' => true
        ],
        'notes' => [
          'spark_group' => true
        ],
        'customer',
        'area',
        'description',
        'time_in',
        'time_out'
    ];

    function create_test($data = []){

            $table_data = [
              'columns' => [
                  'Customer',
                  'Area',
                  'Description',
                  'Time In',
                  'Time Out',
                  'Travel Time',
                  'Work Time'
                ],
              'row_template' => '
              <td contenteditable class=customer><input type="text" name="customer[]" /></td>
              <td contenteditable ><input type="text" name="area[]" /></td>
              <td>
                <select name="description[]">
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
              <td><input type=time class=nexus name="time_in[]"></td>
              <td><input type=time class=nexus name="time_out[]"></td>
              <td></td>
              <td></td>'
            ];

            $template_data = [
                'table' => $this->new_html_table($table_data)
            ];

      return parent::create(["content"=>$template_data['table']]);
    }
}

?>
