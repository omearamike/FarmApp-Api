<?php

    Class Feedlot {

        // use \PDO;
        private $conn;

        public function __construct($db){ // constructor with $db as database connection
            $this->conn = $db;
        }

        function feedlots() {
            $countrecords = "SELECT COUNT(*) AS totalcount FROM feedlot";
            $q = $this->conn->prepare($countrecords); // prepare query statement
            $q->execute(); // execute query
            $countrecords = $q->fetchAll(PDO::FETCH_ASSOC);


            $date = new DateTime();
            $date->setTimezone(date_default_timezone_get());
            $date = $date->format('Y-m-d H:i:s');

            $arraydetails['date_retrieved'] = $date;
            $arraydetails['records'] = $countrecords[0]['totalcount'];
            $arraydetails['herd_number'] = 'mx3423235';
            $arraydetails['feedlots'] = $animalrecords;
            $basearray['feedlot_records'] = $arraydetails;

            return $basearray;
            // return $countrecords;

        }

    };
?>
