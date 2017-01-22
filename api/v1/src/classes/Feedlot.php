<?php

    Class Feedlot {

        // use \PDO;
        private $conn;

        public function __construct($db){ // constructor with $db as database connection
            $this->conn = $db;
        }

        function get_feedlots() {
            $countrecords = "SELECT COUNT(*) AS totalcount FROM feedlot";
            $q = $this->conn->prepare($countrecords); // prepare query statement
            $q->execute(); // execute query
            $countrecords = $q->fetchAll(PDO::FETCH_ASSOC);

            $query = "SELECT lot_id, name_feedlot, GMT_Added FROM feedlot";

            $stmt = $this->conn->prepare($query); // prepare query statement

            $stmt->execute(); // execute query

            $main_data = $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all values

            $total = $countrecords[0]['totalcount'];
            for ($x = 0; $x <= $total-1; $x++)
            {
                $feedlot['record_number'] = $x+1;
                $feedlot['lot_id'] = $main_data[$x]['lot_id'];
                $feedlot['name_feedlot'] = $main_data[$x]['name_feedlot']; // Need to link to database
                $feedlot['animal_count'] = '12'; // Need to link to database
                $feedlot['date_created'] = $main_data[$x]['GMT_Added']; // NFix format of date
                $feedlot['name_feedlot'] = $main_data[$x]['name_feedlot']; // Need to link to database
                $feedlot['adg_feedlot'] = '2.1 kg'; // Need to link to database
                $feedlot['avg_weight'] = '312 kg'; // Need to link to database
                $feedlot['min_weight'] = '356 kg'; // Need to link to database
                $feedlot['max_weight'] = '542 kg'; // Need to link to database
                $feedlot['avg_age'] = '13.23 Months'; // Need to link to database
                $feedlot['estimated_value'] = '15949'; // Need to link to database
                // $feedlotrecords = [];
                $feedlotrecords[] = $feedlot;
            }

            $date = new DateTime();
            // $date->setTimezone();
            $date = $date->format('Y-m-d H:i:s');

            $arraydetails['date_retrieved'] = $date;
            $arraydetails['records'] = $countrecords[0]['totalcount'];
            $arraydetails['herd_number'] = 'mx3423235';
            $arraydetails['feedlots'] = $feedlotrecords;
            $basearray['feedlot_records'] = $arraydetails;

            return $basearray;

        }

    };
?>
