<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/digitalForm/logics/db_conn.php');

$dbconn = test_db();
$dbConnPalioLite = dbConnPalioLite();

// if(isset($_REQUEST['user_id'])){
//     $user_id = $_REQUEST['user_id'];
// }
$company_id = getSession('id_company');

$fpin_query = $dbConnPalioLite->prepare("SELECT gr.CREATED_BY 
    FROM BUSINESS_ENTITY be, GROUPS gr 
    WHERE be.COMPANY_ID = ?
    AND gr.BUSINESS_ENTITY = be.ID
    AND gr.IS_ORGANIZATION = 1");
$fpin_query->bind_param("i", (int) $company_id);
$fpin_query->execute();
$query_result = $fpin_query->get_result()->fetch_assoc();
$survey_fpin = $query_result['CREATED_BY'];
$fpin_query->close();

setSession('survey_fpin', $survey_fpin);

$user_id = $survey_fpin;

$forms_query = "SELECT * FROM `form` WHERE `CREATED_BY`='".$user_id."' ORDER BY SQ_NO";
$query = $dbconn->prepare($forms_query);
$query->execute();
$groups  = $query->get_result();
$query->close();

$rows = array();
while ($group = $groups->fetch_assoc()) {
    $rows[] = $group;
};

return $rows;

?>