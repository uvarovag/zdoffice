<?php

if (isset($_GET['alert_massage']))
{
$tmpLayoutData['alertMassage'] = $_GET['alert_massage'];
}
else if (isset($_GET['error_massage']))
{
$tmpLayoutData['errorMassage'] = $_GET['error_massage'];
}