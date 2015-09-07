<?php
require_once("core/nexus_spark_table/nexus_spark_table.php");

class nexus_tripsheets extends nexus_spark_table{

    var $columns = [
        'date'=>  [
          'spark_group' => true
        ],
        'team' => [
          'datatype'    => 'contact_group',
          'spark_group' => true
        ],
        'notes' => [
          'spark_group' => true
        ],
        'customer'=>[
          'datatype' => 'contact'
        ],
        'area' =>[
          'datatype' => 'location'
        ],
        'description',
        'time_in' => [
          'datatype' => 'time'
        ],
        'time_out' =>[
          'datatype' => 'time'
        ]
    ];
}

?>
