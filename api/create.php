<?php

/*
Debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

/*
Set the default time zone
*/
date_default_timezone_set("Europe/London");

/*
These are the required headers for JSON response
*/
include_once '../inc/headers.php';

/*
Functions
*/
include_once '../inc/functions.php';

/*
Open MySQL connection and create MySQLi instance with value $mysqli.
*/
include_once '../inc/db_open.php';

/*
Receive data.
*/
$data = json_decode(file_get_contents("php://input"));

//print_r( $data );

try {

  /*
  Assign data to variables.
  */

  $passport = $data->passport;
  $departure = $data->departure;
  $source = $data->source;
  $destination = $data->destination;

  /*
  Error handling - passport empty.
  */
  if($passport==0){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Passport is empty"
      ));
      exit();
  }

  /*
  Error handling - timestamp empty.
  */
  if($departure == ""){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Timestamp is empty"
      ));
      exit();
  }
  /*
  Error handling - timestamp is not valid.
  */
  if(isValidTimeStamp($departure) === false){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Timestamp is not valid"
      ));
      exit();
  }

  /*
  Error handling - source empty.
  */
  if($source == ""){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Source is empty"
      ));
      exit();
  }
  /*
  Error handling - source is not valid IATA.
  */
  if( (strlen(trim($source))) !== 3){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Source is not a valid IATA code"
      ));
      exit();
  }

  /*
  Error handling - destination empty.
  */
  if($destination == ""){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Destination is empty"
      ));
      exit();
  }
  /*
  Error handling - destination is not valid IATA.
  */
  if( (strlen(trim($destination))) !== 3){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Destination is not a valid IATA code"
      ));
      exit();
  }

  /*
  Check if flight full
  */
  $check_flight_status = 1;
  $sql_flight_capacity_check = "
    SELECT seat FROM `ticket`
    WHERE
    `departure` = ?
    AND
    `source` LIKE ?
    AND
    `destination` LIKE ?
    AND
    `status` = ?
    ";
  $stmt_flight_capacity_check = $mysqli->prepare($sql_flight_capacity_check) or trigger_error($mysqli->error, E_USER_ERROR);

  $stmt_flight_capacity_check->bind_param("sssi",
      $departure, $source, $destination, $check_flight_status
    );
  $stmt_flight_capacity_check->execute();
  $stmt_flight_capacity_check_result = $stmt_flight_capacity_check->get_result() or trigger_error($stmt_flight_capacity_check->error, E_USER_ERROR);

  if ($stmt_flight_capacity_check_result->num_rows>=32) {

        http_response_code(401);
        echo json_encode(array(
            "message" => "No seats left"
        ));
        exit();

  }

  if ($stmt_flight_capacity_check_result->num_rows>0) {

    /*
    If some seats are taken, generate the random seat number from those which remain
    */

    $available_seats = range(1, 32);

    while($row = $stmt_flight_capacity_check_result->fetch_array(MYSQLI_ASSOC)) {

      unset($available_seats[(int)$row['seat']]);

    }

    $seat = array_rand($available_seats);

  } else {

    $seat = rand(1,32);

  }

  /*
  Set status = 1 (seat is created and active; 0 means inactive or cancelled)
  */
  $status = 1;

  $sql_insert = "
    INSERT INTO ticket (
    passport, departure, source, destination, seat, status
    )
    VALUES (
      ?,?,?,?,?,?
    )";


  $stmt = $mysqli->prepare($sql_insert) or trigger_error($mysqli->error, E_USER_ERROR);

  $stmt->bind_param("ssssii",
    $passport, $departure, $source, $destination, $seat, $status
  );

  if ($stmt->execute()) {

    /*
    Success - ticket created, return ticket ID and seat
    */

    http_response_code(201);
    echo json_encode(array(
        "message" => "created",
        "ticket_id" => $stmt->insert_id,
        "seat" => $seat
    ));

  } else {

    /*
    Failed to execute - return error
    */

    http_response_code(401);
    echo json_encode(array(
        "message" => "Unable to create ticket"
    ));

  }

  $stmt->close();


}

catch (Exception $e){

  /*
  Something else went wrong
  */

  http_response_code(401);
  echo json_encode(array(
      "message" => "Error"
  ));
}


/*
Close MySQL connection
*/
include_once '../inc/db_close.php';

?>
