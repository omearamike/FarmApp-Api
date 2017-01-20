<?php

/**
  * @desc This controller will be used to display animal records
  * @function: __construct(), create(), readAll(), createUsingCsv(), readOne(), update().
  * @param $scope: is the scope used to bring data which is with in the animalCtrl Controller scope from client(website)
  * @param $http: Used to create a http request to server
*/

class Animal    {

    // use \PDO;
    private $conn;

    public function __construct($db){ // constructor with $db as database connection
        $this->conn = $db;
    }

    function get_animals(){ // read all animals
        $countrecords = "SELECT COUNT(*) AS totalcount FROM animal";
        $q = $this->conn->prepare($countrecords); // prepare query statement
        $q->execute(); // execute query
        $countrecords = $q->fetchAll(PDO::FETCH_ASSOC);

        $main = "SELECT a.tag_id as tag_id, b.breed_name as breed_name, a.dob as dob, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, dob) ), '%y' )
        AS year, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, dob) ), '%m') - 1
        AS month, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, dob) ), '%d' )
        AS days, s.sex_type as sex_type, a.notes as notes FROM animal a
        JOIN breed b on a.breed_id = b.breed_id
        JOIN sex s on a.sex = s.sex_id
        ORDER BY `a`.`dob` ASC";

        $stmt = $this->conn->prepare($main); // prepare query statement
        $stmt->execute(); // execute query
        $main_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $date = new DateTime();
        $date->setTimezone(date_default_timezone_get());
        $date = $date->format('Y-m-d H:i:s');

        $total = $countrecords[0]['totalcount'];

            for ($x = 0; $x <= $total-1; $x++)
            {
                $animal['record_number'] = $x+1;
                $animal['status'] = 'active'; // Need to link to database
                $animal['tag_id'] =  $main_data[$x]['tag_id'];
                $animal['dateofbirth'] =  $main_data[$x]['dob'];
                $animal['breed_name'] =  $main_data[$x]['breed_name'];
                $animal['sex_type'] =  $main_data[$x]['sex_type'];
                $animal['feedlot'] =  $main_data[$x]['location']; // Need to link to database

                $weightarray = [];
                for ($z = 0; $z <= 2; $z++) {
                    $weight['weight_no'] = $z+1;
                    $weight['weight'] = '24kg';
                    $weight['date'] = '2015-12-12';
                    $weightarray[] = $weight;
                }

                $animal['allweights'] =  $weightarray; // Need to link to database
                $animal['notes'] =  $main_data[$x]['notes'];

                $animalrecords[] = $animal;
            }

                $arraydetails['date_retrieved'] = $date;
                $arraydetails['records'] = $countrecords[0]['totalcount'];
                $arraydetails['herd_number'] = 'mx3423235';
                $arraydetails['animals'] = $animalrecords;
                $basearray['animal_records'] = $arraydetails;

                return $basearray;
    }
};

?>
