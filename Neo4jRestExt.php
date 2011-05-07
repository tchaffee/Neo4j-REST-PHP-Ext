<?php

if (!function_exists('curl_init')) {
  throw new Exception('Neo4jRestExt needs the CURL PHP extension.');
}

require_once 'Neo4jRestExt/NodeIndexExt.php';