<?php

/*
Debugging
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
Set the default time zone
*/
date_default_timezone_set("Europe/London");

/*
These are the required headers for JSON response
*/
include_once '../inc/headers.php';

/*
Open MySQL connection and create MySQLi instance with value $mysqli.
*/
include_once '../inc/db_open.php';

/*
Receive data.
*/
$data = json_decode(file_get_contents("php://input"));

//print_r( $data );



  /*
  Assign data to variables.
  */

  $passport = $data->passport;
  $departure = $data->departure;
  $source = $data->source;
  $destination = $data->destination;
  $seat = $data->seat;

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
  Error handling - seat empty.
  */
  if($seat==0){
      http_response_code(401);
      echo json_encode(array(
          "message" => "Seat number is empty"
      ));
      exit();
  }

  /*
  Generate new seat
  */
  $new_seat = rand(1,32);

  /*
  Set status = 1 (seat is created and active; 0 means inactive or cancelled)
  */
  $status = 1;

  $sql_update = "
    UPDATE ticket
    SET seat = ?
    WHERE passport = ?
    AND departure = ?
    AND source = ?
    AND destination = ?
    AND seat = ?
    AND status = ?
    ";


  $stmt = $mysqli->prepare($sql_update) or trigger_error($mysqli->error, E_USER_ERROR);

  $stmt->bind_param("issssii",
    $new_seat, $passport, $departure, $source, $destination, $seat, $status
  );

  if ($stmt->execute()) {

    /*
    Success - ticket created, return ticket ID and seat
    */

    http_response_code(201);
    echo json_encode(array(
        "message" => "changed",
        "ticket_id" => $stmt->insert_id,
        "seat" => $new_seat
    ));

  } else {

    /*
    Failed to execute - return error
    */

    http_response_code(401);
    echo json_encode(array(
        "message" => "Unable to change seat"
    ));

  }

  $stmt->close();





/*
Close MySQL connection
*/
include_once '../inc/db_close.php';

?>
