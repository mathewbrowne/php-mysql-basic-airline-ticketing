<?php

function isValidTimeStamp($timestamp)
{

  if (DateTime::createFromFormat('Y-m-d H:i:s', $timestamp) !== false) {
    return true;
  } else {
    return false;
  }

}

?>
