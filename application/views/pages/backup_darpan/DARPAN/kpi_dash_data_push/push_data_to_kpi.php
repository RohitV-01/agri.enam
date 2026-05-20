<div class="container">
    <div class="row">
        <?php
include 'lib.php';
require_once 'dbconfig.php';
/*$this->load->library('csvreader');
$file_path = "assets/text/kpi_dashboard_data_01_2017_to_06_2019.csv";
$csv_data = $this->csvreader->parse_file($file_path); 
$csv_fields = $this->csvreader->get_fields();

print_r($csv_fields );exit;*/
 //require_once 'dbconfig.php';
//require_once 'dbconfig.php';
//Get key from file
//$file_key   = curl_get_contents('Key_103_70043_20200318.key');

//$file_key = json_decode(file_get_contents('Key_103_70043_20200318.key'));

/*//Get all KPI data
$kpi_data_file = "http://localhost/web/datapage/push_data_to_kpi/kpi_dashboard_data_01_2017_to_06_2019.csv";
            //print_r($kpi_data_file);
            $kpi_data           = array_map ('str_getcsv', file ( $kpi_data_file ));
            //print_r($kpi_data); 
            $kpi_data_header    = array_shift($kpi_data);
            //print_r($kpi_data);
            //$kpi_data = $result;
            //print_r($kpi_data_header);
            //print_r($kpi_data);

            $data = array();
            foreach($kpi_data as $row) {
           // print_r($row); exit;
                if(!isset($data[$row[0]])) {
                    $data[$row[0]] = $row;
                }
            }*/
            require_once 'dbconfig.php';
       
            try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // execute the stored procedure
            $p_flag = 'GD';
            $P_State_Code = 0;
            $P_Sec_Code = 44;
            $P_Dept_Code = 287;
            $P_Project_Code = 70043;
            $P_Datef = '2016-04-30';
            $P_Datet = '2020-02-29';
            $P_Msg = '';
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
            $result = $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result);

            //$payload = json_encode($result);

           } catch (PDOException $e) {
                    die("Error occurred:" . $e->getMessage());
                }

        //$sFile = file_get_contents("http://www.php.net");

        $url = 'http://train.enam.gov.in/web/key_download/Key_103_70043_20200318.key';
        $file_key = file_get_contents($url);



          $data = array();
            foreach($result as $row) {
                $row['Datadt'] = date('d/m/Y',strtotime($row['Datadt']));
                $data[$row['Datadt']][] = $row;

                print_r( $row['Datadt']);


            }

                $myObjLog=(Object)NULL;
                $myObjLog = json_decode($result);
                 
                 try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    // execute the stored procedure
                    $p_flag = 'RQ';
                    $P_State_Code = 0;
                    $P_Sec_Code = 44;
                    $P_Dept_Code = 287;
                    $P_Project_Code = 70043;
                    $P_Datef = '2016-01-01';
                    $P_Datet = '2020-01-31';
                    $P_Msg = $myObjLog->Message;
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

        //print_r($data);
        //Detail for data.gov.in project
        $project_data = array(
            "mcode"         => 103,
            "state_code"    => 0,
            "dept_code"     => 287,
            "project_code"  => 70043,
            "sec_code"      => 44
        );
        //print_r($project_data);

$date_range = get_date_range($project_data);

//Check for any error message
if(isset($date_range->Status) && $date_range->Status == 0) 
{
    print 'Error: ' . $date_range->Message;
}
 else {
    //Check for date range
    if(isset($date_range->RetDMDashCaption)) {
        $i = 1;
        //Process all the
        foreach($date_range->RetDMDashCaption as $date_row) {
            print $i . ':
';
          
            if(isset($date_row->DATE_DD_MM_YYYY) && isset($data[$date_row->DATE_DD_MM_YYYY])) {
              
                foreach ($data[$date_row->DATE_DD_MM_YYYY] as $rowData) {
                    $push_data = $rowData;

                    //$cur_data = $rowData;

                    //$date = DateTime::createFromFormat('d/m/Y', $cur_data['datadt']);
                    /*$push_data = array(
                        "mcode" => 103,
                        "State_Code" => 0,
                        "District_Code" => 0,
                        "teh_code"      => 0,
                        "blk_code"      => 0,
                        "sector_code"   => 44,
                        "gp_code"       => 0,
                        "vill_code"     => 0,
                        "dept_code"     => 287,
                        "project_code"  => 70043,
                        "cnt1"          => to_lakhs($cur_data['cnt1']),
                        "cnt2"          => to_lakhs($cur_data['cnt2']),
                        "cnt3"          => to_lakhs($cur_data['cnt3']),
                        "cnt4"          => $cur_data[4],
                        "cnt5"          => 0,
                        "Dataportmode"  => 1,
                        "modedesc"      => 0,
                        "data_lvl_code" => 1,
                        "Yr"            => $date->format('Y'),
                        "Mnth"          => $date->format('n'),
                        "datadt"        => $cur_data['datadt']
                    );*/

                    $json_push_data = json_encode($push_data);

                    print 'DATA: ' . print_r($push_data, true);

                    print '';
                    $ecrypted_data = kpi_dash_api_encrypt($json_push_data, $file_key);
                    print_r($ecrypted_data);

                    $paylod = array(
                        "IP" => array(
                             "mcode"         => 103,
                             "state_code"    => 0,
                             "dept_code"     => 287,
                             "project_code"  => 70043,
                             "sec_code"      => 44
                        ),
                        "Records" => array($ecrypted_data)
                    );
                    
                    print 'PAYLOAD: ' . print_r($paylod, true);

                    $response = push_to_kpi_dashboard($paylod);

                    print 'RESPONSE: ' . print_r($response, true);
                    print '';
                }
            } else {
               // print $date_row->DATE_DD_MM_YYYY . 'Error: Data not found.';
                //die();
            }
            print '';
            $i ++;
        }
    }
}





