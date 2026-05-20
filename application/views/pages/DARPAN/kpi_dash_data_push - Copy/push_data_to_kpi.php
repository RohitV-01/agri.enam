<?php
include 'lib.php';
include 'dbconfig.php';

$url = 'http://train.enam.gov.in/web/key_download/Key_103_70043_20200318.key';
$file_key = file_get_contents($url);

function file_get_contents_curl($url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
curl_setopt($ch, CURLOPT_URL, $url);
$file_key = curl_exec($ch);
curl_close($ch);
return $file_key;
}

//print_r($file_key);
//Get all KPI data
$kpi_data_file      = "http://localhost/csv/kpi_dashboard_data_01_2017_to_06_2019.csv";

/* function file_get_contents_curl($kpi_data_file) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
curl_setopt($ch, CURLOPT_URL, $kpi_data_file);
$kpi_data = curl_exec($ch);
curl_close($ch);
return $kpi_data;
}
*/
 //print_r($kpi_data_file);
 $kpi_data         = array_map ('str_getcsv', file ( $kpi_data_file ));
 $kpi_data_header  = array_shift($kpi_data);

//print_r($kpi_data);exit;
$data = array();
foreach($kpi_data as $row) {
    if(!isset($data[$row[0]])) {
        $data[$row[0]] = $row;
    }
}

//print_r($row);
//print_r($data);
//Detail for data.gov.in project
$project_data = array
(
 "Instance_Code" => 0,
 "Sec_Code"      => 44,
 "Ministry_Code" => 103,
 "Dept_Code"     => 287,
 "Project_Code"  => 70043
);

//print_r($project_data);exit;
$date_range = get_date_range($project_data);
//print_r($date_range);exit;
// print_r($date_range);exit;

//Check for any error message
if(isset($date_range->Status) && $date_range->Status == 0) {
    print 'Error: ' . $date_range->Message;
} else {
    //Check for date range
    if(isset($date_range->RetDMDashCaption)) {
        $i = 1;
        //Process all the
        foreach($date_range->RetDMDashCaption as $date_row) {
            print $i . ':
';
            if(isset($date_row->DATE_DD_MM_YYYY) && isset($data[$date_row->DATE_DD_MM_YYYY])) {
                $cur_data = $data[$date_row->DATE_DD_MM_YYYY];
                $date = DateTime::createFromFormat('mm/dd/yyyy', $cur_data[0]);
               //print_r($date);exit;
                $push_data = array(
                    "mcode" 		=> 103,
                    "State_Code" 	=> 0,
                    "District_Code" => 0,
                    "teh_code"      => 0,
                    "blk_code"      => 0,
                    "sector_code"   => 44,
                    "gp_code"       => 0,
                    "vill_code"     => 0,
                    "dept_code"     => 287,
                    "Project_Code"  => 70043,
                    "cnt1"          => $cur_data[11],
                    "cnt2"          => $cur_data[12],
                    "cnt3"          => $cur_data[13],
                    "cnt4"          => $cur_data[14],
                    "cnt5"          => 0,
                    "Dataportmode"  => 1,
                    "modedesc"      => 0,
                    "data_lvl_code" => 1,
                    "Yr"            => $date->format('Y'),
                    "Mnth"          => $date->format('n'),
                    "datadt"        => $cur_data[0]
                );
                $json_push_data = json_encode($push_data);

                //print_r($json_push_data);exit;
                print 'DATA: ' . print_r($push_data, true);

                print '
';
                $ecrypted_data = kpi_dash_api_encrypt($json_push_data, $file_key);

                //print_r($ecrypted_data);exit;
                $paylod = array(
                    "IP" => array(
                     "Instance_Code" => 0,
					 "Sec_Code"      => 44,
					 "Ministry_Code" => 103,
					 "Dept_Code"     => 287,
					 "Project_Code"  => 70043
                    ),
                    "Records" => array($ecrypted_data)
                );
                
                print 'PAYLOAD: ' . print_r($paylod, true);

                $response = push_to_kpi_dashboard($paylod);

                print 'RESPONSE: ' . print_r($response, true);
                print '
';
            } else {
                print $date_row->DATE_DD_MM_YYYY . 'Error: Data not found.';
                die();
            }

            	//$msg = json_decode($response,true);
                 try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    // execute the stored procedure
                    $p_flag = 'RQ';
                    $P_State_Code = 0;
                    $P_Sec_Code = 44;
                    $P_Dept_Code = 287;
                    $P_Project_Code = 70043;
                    $P_Datef = '2016-04-30';
                    $P_Datet = '2020-03-31';
                    $P_Msg =	'';
                    $P_Mcode = 103;
                    //$sql = 'CALL Save_Key_Demo("'.$p_flag.'","'.$P_State_Code.'","'.$P_Sec_Code.'","'.$P_Dept_Code.'","'.$P_Project_Code.'","'.$P_Datef.'", "'.$P_Datet.'", "'.$P_Msg.'", "'.$P_Mcode.'")';
                    //$sql = 'CALL Save_Key_Demo("'.$p_flag.'", 0, 44, 287, 70043, "'.$P_Datef.'" , "'.$P_Datet.'", "'.$P_Msg.'", 103)';
                    $stmt = $pdo->prepare("CALL Save_Key_Demo(?,?,?,?,?,?,?,?,?)");
                    $stmt->bindParam(1, $p_flag, PDO::PARAM_STR);
                    $stmt->bindValue(2, $P_State_Code, PDO::PARAM_INT);
                    $stmt->bindValue(3, $P_Sec_Code, PDO::PARAM_INT);
                    $stmt->bindValue(4, $P_Dept_Code, PDO::PARAM_INT);
                    $stmt->bindValue(5, $P_Project_Code, PDO::PARAM_INT);
                    $stmt->bindValue(6, $P_Datef, PDO::PARAM_STR);
                    $stmt->bindValue(7, $P_Datet, PDO::PARAM_STR);
                    $stmt->bindParam(8, $P_Msg, PDO::PARAM_STR);
                    $stmt->bindValue(9, $P_Mcode, PDO::PARAM_INT);
                    // call the stored procedure
                    // $q = $pdo->query($sql);
                    $results = $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    //$q->setFetchMode(PDO::FETCH_ASSOC);
                    //$results = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    echo "<br>";
                    echo "<br>";
                    echo($P_Msg);
                    echo "<br>";
                    echo "<br>";
                    //print_r($results);

                } catch (PDOException $e) {
                    die("Error occurred:" . $e->getMessage());
                }

            print '
';
            $i ++;
        }
    }
}

