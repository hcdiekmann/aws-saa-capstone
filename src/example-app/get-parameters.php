<?php
  # Retrieve settings from Parameter Store
  error_log('Retrieving settings');
  require 'aws.phar';
  session_start();

  $az = file_get_contents('http://169.254.169.254/latest/meta-data/placement/availability-zone');
  $region = substr($az, 0, -1);
  $ssm_client = new Aws\Ssm\SsmClient([
     'version' => 'latest',
     'region'  => $region
  ]);

  try {
    # Retrieve settings from Parameter Store
    $result = $ssm_client->GetParametersByPath(['Path' => '/example/', 'WithDecryption' => true]);

    # Extract individual parameters
    foreach($result['Parameters'] as $p) {
        $values[$p['Name']] = $p['Value'];
    }

    $_SESSION['ep'] = $values['/example/endpoint'];
    $_SESSION['un'] = $values['/example/username'];
    $_SESSION['pw'] = $values['/example/password'];
    $_SESSION['db'] = $values['/example/database'];
  }
  catch (Exception $e) {
    $_SESSION['ep'] = '';
    $_SESSION['un'] = '';
    $_SESSION['pw'] = '';
    $_SESSION['db'] = '';
  }

?>
