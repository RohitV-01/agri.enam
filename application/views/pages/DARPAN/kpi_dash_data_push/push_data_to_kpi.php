<?php
//error_reporting(E_ERROR | E_PARSE);
include 'lib.php';
//include 'dbconfig.php';

//$url = 'http://localhost/csv/Key_1_10043_20200709.key'; //commented on 05-12-2023

$url = 'http://localhost/csv/Key_1_10043_20231204.key';  //added this line with new keyFile on 05-12-2023

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
//$kpi_data_file      = "https://enam.gov.in/web/csv_file/New_kpi_dashboard_data_06_2020.csv";
$kpi_data_file      = "http://localhost/csv/New_kpi_dashboard_data_12_11_2025.csv";

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
   // print_r($kpi_data_file);exit;
 $kpi_data         = array_map ('str_getcsv', file ( $kpi_data_file ));
 $kpi_data_header  = array_shift($kpi_data);

 //print_r($kpi_data);exit;
$data = array();
foreach($kpi_data as $row) {
    if(!isset($data[$row[0]])) 
    {
        $data[$row[0]] = $row;
    }
}

 // print_r($row);
//print_r($data);exit;
//Detail for data.gov.in project
$project_data = array
(
 "Instance_Code" => 1,
 "Sec_Code"      => 1,
 "Ministry_Code" => 1,
 "Dept_Code"     => 2,
 "Project_Code"  => 10043
);

// print_r($project_data);exit;
$date_range = get_date_range($project_data);
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
			  // print_r($data[$date_row->datadate]);
 //print_r($date_row->datadate);exit();

            if(isset($date_row->datadate) && ($date_row->datadate !='')) 

             {

                // $cur_data = $data[$date_row->datadate];
                $cur_data = $date_row->datadate;
                   // print_r($cur_data[0]);exit;
                $date = DateTime::createFromFormat('m/d/Y', $cur_data[0]);
                // print_r($date);exit();
                $MM_DD_YYYY = $date;

               //print_r($MM_DD_YYYY);exit;
	/*		     $str = array(
                    "Instance_Code" => 1,
                    "Sec_Code"      => 1,
                    "Ministry_Code" => 1,
                    "Dept_Code"     => 2,
                    "Project_Code"  => 10043,
                    "Frequency_Id"  => 1,
                    "Group_Id"      => 1,
                    "Atmpt"         => 0,
                    "Lvl1_Code"     => 91,
                    "KPI1_Data"     => to_lakhs($cur_data[10]),
                    "KPI2_Data"     => to_lakhs($cur_data[11]),
                    "KPI3_Data"     => to_lakhs($cur_data[12]),
                    "Datadate"      => $cur_data[0],
                );*/

  //$file_handle = fopen("http://localhost/csv/New_kpi_dashboard_data_06_2020.csv", "r");
  //$csvFile = fopen('https://enam.gov.in/web/csv_file/New_kpi_dashboard_data_06_2020.csv', 'r');
                //$kpi_data_file
  // $csvFile = fopen('http://localhost/csv/New_kpi_dashboard_data_30_04_2016.csv', 'r');
  $csvFile = fopen($kpi_data_file, 'r');
  $data = array();
  while ($row = fgetcsv($csvFile)) 
  {
      $data[] = $row;   
        // print_r($row); //exit;
  }

$Kvalue_1 = [$data[1][2], $data[1][3], $data[1][4], $data[1][5], $data[1][6]]; $Lvalue_1 = [$data[ 1][7], $data[1][8], $data[1][9]];
//print_r($Kvalue_1);
$Kvalue_2 = [$data[2][2], $data[2][3], $data[2][4], $data[2][5], $data[2][6]]; $Lvalue_2 = [$data[ 2][7], $data[2][8], $data[2][9]];
$Kvalue_3 = [$data[3][2], $data[3][3], $data[3][4], $data[3][5], $data[3][6]]; $Lvalue_3 = [$data[ 3][7], $data[3][8], $data[3][9]];
$Kvalue_4 = [$data[4][2], $data[4][3], $data[4][4], $data[4][5], $data[4][6]]; $Lvalue_4 = [$data[ 4][7], $data[4][8], $data[4][9]];
$Kvalue_5 = [$data[5][2], $data[5][3], $data[5][4], $data[5][5], $data[5][6]]; $Lvalue_5 = [$data[ 5][7], $data[5][8], $data[5][9]];
$Kvalue_6 = [$data[6][2], $data[6][3], $data[6][4], $data[6][5], $data[6][6]]; $Lvalue_6 = [$data[ 6][7], $data[6][8], $data[6][9]];
$Kvalue_7 = [$data[7][2], $data[7][3], $data[7][4], $data[7][5], $data[7][6]]; $Lvalue_7 = [$data[ 7][7], $data[7][8], $data[7][9]];
$Kvalue_8 = [$data[8][2], $data[8][3], $data[8][4], $data[8][5], $data[8][6]]; $Lvalue_8 = [$data[ 8][7], $data[8][8], $data[8][9]];
$Kvalue_9 = [$data[9][2], $data[9][3], $data[9][4], $data[9][5], $data[9][6]]; $Lvalue_9 = [$data[ 9][7], $data[9][8], $data[9][9]];
$Kvalue_10 = [$data[10][2], $data[10][3], $data[10][4], $data[10][5], $data[10][6]]; $Lvalue_10 = [$data[ 10][7], $data[10][8], $data[10][9]];
$Kvalue_11 = [$data[11][2], $data[11][3], $data[11][4], $data[11][5], $data[11][6]]; $Lvalue_11 = [$data[ 11][7], $data[11][8], $data[11][9]];
$Kvalue_12 = [$data[12][2], $data[12][3], $data[12][4], $data[12][5], $data[12][6]]; $Lvalue_12 = [$data[ 12][7], $data[12][8], $data[12][9]];
$Kvalue_13 = [$data[13][2], $data[13][3], $data[13][4], $data[13][5], $data[13][6]]; $Lvalue_13 = [$data[ 13][7], $data[13][8], $data[13][9]];
$Kvalue_14 = [$data[14][2], $data[14][3], $data[14][4], $data[14][5], $data[14][6]]; $Lvalue_14 = [$data[ 14][7], $data[14][8], $data[14][9]];
$Kvalue_15 = [$data[15][2], $data[15][3], $data[15][4], $data[15][5], $data[15][6]]; $Lvalue_15 = [$data[ 15][7], $data[15][8], $data[15][9]];
$Kvalue_16 = [$data[16][2], $data[16][3], $data[16][4], $data[16][5], $data[16][6]]; $Lvalue_16 = [$data[ 16][7], $data[16][8], $data[16][9]];
$Kvalue_17 = [$data[17][2], $data[17][3], $data[17][4], $data[17][5], $data[17][6]]; $Lvalue_17 = [$data[ 17][7], $data[17][8], $data[17][9]];
$Kvalue_18 = [$data[18][2], $data[18][3], $data[18][4], $data[18][5], $data[18][6]]; $Lvalue_18 = [$data[ 18][7], $data[18][8], $data[18][9]];
$Kvalue_19 = [$data[19][2], $data[19][3], $data[19][4], $data[19][5], $data[19][6]]; $Lvalue_19 = [$data[ 19][7], $data[19][8], $data[19][9]];
$Kvalue_20 = [$data[20][2], $data[20][3], $data[20][4], $data[20][5], $data[20][6]]; $Lvalue_20 = [$data[ 20][7], $data[20][8], $data[20][9]];

$Kvalue_21 = [$data[21][2], $data[21][3], $data[21][4], $data[21][5], $data[21][6]]; 
$Lvalue_21 = [$data[ 21][7], $data[21][8], $data[21][9]];

$Kvalue_22 = [$data[22][2], $data[22][3], $data[22][4], $data[22][5], $data[22][6]]; 
$Lvalue_22 = [$data[ 22][7], $data[22][8], $data[22][9]];

$Kvalue_23 = [$data[23][2], $data[23][3], $data[23][4], $data[23][5], $data[23][6]]; $Lvalue_23 = [$data[ 23][7], $data[23][8], $data[23][9]];
$Kvalue_24 = [$data[24][2], $data[24][3], $data[24][4], $data[24][5], $data[24][6]]; $Lvalue_24 = [$data[ 24][7], $data[24][8], $data[24][9]];
$Kvalue_25 = [$data[25][2], $data[25][3], $data[25][4], $data[25][5], $data[25][6]]; $Lvalue_25 = [$data[ 25][7], $data[25][8], $data[25][9]];
$Kvalue_26 = [$data[26][2], $data[26][3], $data[26][4], $data[26][5], $data[26][6]]; $Lvalue_26 = [$data[ 26][7], $data[26][8], $data[26][9]];
$Kvalue_27 = [$data[27][2], $data[27][3], $data[27][4], $data[27][5], $data[27][6]]; $Lvalue_27 = [$data[ 27][7], $data[27][8], $data[27][9]];
$Kvalue_28 = [$data[28][2], $data[28][3], $data[28][4], $data[28][5], $data[28][6]]; $Lvalue_28 = [$data[ 28][7], $data[28][8], $data[28][9]];
$Kvalue_29 = [$data[29][2], $data[29][3], $data[29][4], $data[29][5], $data[29][6]]; $Lvalue_29 = [$data[ 29][7], $data[29][8], $data[29][9]];
$Kvalue_30 = [$data[30][2], $data[30][3], $data[30][4], $data[30][5], $data[30][6]]; $Lvalue_30 = [$data[ 30][7], $data[30][8], $data[30][9]];
$Kvalue_31 = [$data[31][2], $data[31][3], $data[31][4], $data[31][5], $data[31][6]]; $Lvalue_31 = [$data[ 31][7], $data[31][8], $data[31][9]];
$Kvalue_32 = [$data[32][2], $data[32][3], $data[32][4], $data[32][5], $data[32][6]]; $Lvalue_32 = [$data[ 32][7], $data[32][8], $data[32][9]];
$Kvalue_33 = [$data[33][2], $data[33][3], $data[33][4], $data[33][5], $data[33][6]]; $Lvalue_33 = [$data[ 33][7], $data[33][8], $data[33][9]];
$Kvalue_34 = [$data[34][2], $data[34][3], $data[34][4], $data[34][5], $data[34][6]]; $Lvalue_34 = [$data[ 34][7], $data[34][8], $data[34][9]];
$Kvalue_35 = [$data[35][2], $data[35][3], $data[35][4], $data[35][5], $data[35][6]]; $Lvalue_35 = [$data[ 35][7], $data[35][8], $data[35][9]];
$Kvalue_36 = [$data[36][2], $data[36][3], $data[36][4], $data[36][5], $data[36][6]]; $Lvalue_36 = [$data[ 36][7], $data[36][8], $data[36][9]];
$Kvalue_37 = [$data[37][2], $data[37][3], $data[37][4], $data[37][5], $data[37][6]]; $Lvalue_37 = [$data[ 37][7], $data[37][8], $data[37][9]];
$Kvalue_38 = [$data[38][2], $data[38][3], $data[38][4], $data[38][5], $data[38][6]]; $Lvalue_38 = [$data[ 38][7], $data[38][8], $data[38][9]];
$Kvalue_39 = [$data[39][2], $data[39][3], $data[39][4], $data[39][5], $data[39][6]]; $Lvalue_39 = [$data[ 39][7], $data[39][8], $data[39][9]];
$Kvalue_40 = [$data[40][2], $data[40][3], $data[40][4], $data[40][5], $data[40][6]]; $Lvalue_40 = [$data[ 40][7], $data[40][8], $data[40][9]];
$Kvalue_41 = [$data[41][2], $data[41][3], $data[41][4], $data[41][5], $data[41][6]]; $Lvalue_41 = [$data[ 41][7], $data[41][8], $data[41][9]];
$Kvalue_42 = [$data[42][2], $data[42][3], $data[42][4], $data[42][5], $data[42][6]]; $Lvalue_42 = [$data[ 42][7], $data[42][8], $data[42][9]];
$Kvalue_43 = [$data[43][2], $data[43][3], $data[43][4], $data[43][5], $data[43][6]]; $Lvalue_43 = [$data[ 43][7], $data[43][8], $data[43][9]];
$Kvalue_44 = [$data[44][2], $data[44][3], $data[44][4], $data[44][5], $data[44][6]]; $Lvalue_44 = [$data[ 44][7], $data[44][8], $data[44][9]];
$Kvalue_45 = [$data[45][2], $data[45][3], $data[45][4], $data[45][5], $data[45][6]]; $Lvalue_45 = [$data[ 45][7], $data[45][8], $data[45][9]];
$Kvalue_46 = [$data[46][2], $data[46][3], $data[46][4], $data[46][5], $data[46][6]]; $Lvalue_46 = [$data[ 46][7], $data[46][8], $data[46][9]];
$Kvalue_47 = [$data[47][2], $data[47][3], $data[47][4], $data[47][5], $data[47][6]]; $Lvalue_47 = [$data[ 47][7], $data[47][8], $data[47][9]];
$Kvalue_48 = [$data[48][2], $data[48][3], $data[48][4], $data[48][5], $data[48][6]]; $Lvalue_48 = [$data[ 48][7], $data[48][8], $data[48][9]];
$Kvalue_49 = [$data[49][2], $data[49][3], $data[49][4], $data[49][5], $data[49][6]]; $Lvalue_49 = [$data[ 49][7], $data[49][8], $data[49][9]];
$Kvalue_50 = [$data[50][2], $data[50][3], $data[50][4], $data[50][5], $data[50][6]]; $Lvalue_50 = [$data[ 50][7], $data[50][8], $data[50][9]];
$Kvalue_51 = [$data[51][2], $data[51][3], $data[51][4], $data[51][5], $data[51][6]]; $Lvalue_51 = [$data[ 51][7], $data[51][8], $data[51][9]];
$Kvalue_52 = [$data[52][2], $data[52][3], $data[52][4], $data[52][5], $data[52][6]]; $Lvalue_52 = [$data[ 52][7], $data[52][8], $data[52][9]];
$Kvalue_53 = [$data[53][2], $data[53][3], $data[53][4], $data[53][5], $data[53][6]]; $Lvalue_53 = [$data[ 53][7], $data[53][8], $data[53][9]];
$Kvalue_54 = [$data[54][2], $data[54][3], $data[54][4], $data[54][5], $data[54][6]]; $Lvalue_54 = [$data[ 54][7], $data[54][8], $data[54][9]];
$Kvalue_55 = [$data[55][2], $data[55][3], $data[55][4], $data[55][5], $data[55][6]]; $Lvalue_55 = [$data[ 55][7], $data[55][8], $data[55][9]];
$Kvalue_56 = [$data[56][2], $data[56][3], $data[56][4], $data[56][5], $data[56][6]]; $Lvalue_56 = [$data[ 56][7], $data[56][8], $data[56][9]];
$Kvalue_57 = [$data[57][2], $data[57][3], $data[57][4], $data[57][5], $data[57][6]]; $Lvalue_57 = [$data[ 57][7], $data[57][8], $data[57][9]];
$Kvalue_58 = [$data[58][2], $data[58][3], $data[58][4], $data[58][5], $data[58][6]]; $Lvalue_58 = [$data[ 58][7], $data[58][8], $data[58][9]];
$Kvalue_59 = [$data[59][2], $data[59][3], $data[59][4], $data[59][5], $data[59][6]]; $Lvalue_59 = [$data[ 59][7], $data[59][8], $data[59][9]];
$Kvalue_60 = [$data[60][2], $data[60][3], $data[60][4], $data[60][5], $data[60][6]]; $Lvalue_60 = [$data[ 60][7], $data[60][8], $data[60][9]];
$Kvalue_61 = [$data[61][2], $data[61][3], $data[61][4], $data[61][5], $data[61][6]]; $Lvalue_61 = [$data[ 61][7], $data[61][8], $data[61][9]];
$Kvalue_62 = [$data[62][2], $data[62][3], $data[62][4], $data[62][5], $data[62][6]]; $Lvalue_62 = [$data[ 62][7], $data[62][8], $data[62][9]];
$Kvalue_63 = [$data[63][2], $data[63][3], $data[63][4], $data[63][5], $data[63][6]]; $Lvalue_63 = [$data[ 63][7], $data[63][8], $data[63][9]];
$Kvalue_64 = [$data[64][2], $data[64][3], $data[64][4], $data[64][5], $data[64][6]]; $Lvalue_64 = [$data[ 64][7], $data[64][8], $data[64][9]];
$Kvalue_65 = [$data[65][2], $data[65][3], $data[65][4], $data[65][5], $data[65][6]]; $Lvalue_65 = [$data[ 65][7], $data[65][8], $data[65][9]];
$Kvalue_66 = [$data[66][2], $data[66][3], $data[66][4], $data[66][5], $data[66][6]]; $Lvalue_66 = [$data[ 66][7], $data[66][8], $data[66][9]];
$Kvalue_67 = [$data[67][2], $data[67][3], $data[67][4], $data[67][5], $data[67][6]]; $Lvalue_67 = [$data[ 67][7], $data[67][8], $data[67][9]];
$Kvalue_68 = [$data[68][2], $data[68][3], $data[68][4], $data[68][5], $data[68][6]]; $Lvalue_68 = [$data[ 68][7], $data[68][8], $data[68][9]];
$Kvalue_69 = [$data[69][2], $data[69][3], $data[69][4], $data[69][5], $data[69][6]]; $Lvalue_69 = [$data[ 69][7], $data[69][8], $data[69][9]];
$Kvalue_70 = [$data[70][2], $data[70][3], $data[70][4], $data[70][5], $data[70][6]]; $Lvalue_70 = [$data[ 70][7], $data[70][8], $data[70][9]];
$Kvalue_71 = [$data[71][2], $data[71][3], $data[71][4], $data[71][5], $data[71][6]]; $Lvalue_71 = [$data[ 71][7], $data[71][8], $data[71][9]];
$Kvalue_72 = [$data[72][2], $data[72][3], $data[72][4], $data[72][5], $data[72][6]]; $Lvalue_72 = [$data[ 72][7], $data[72][8], $data[72][9]];
$Kvalue_73 = [$data[73][2], $data[73][3], $data[73][4], $data[73][5], $data[73][6]]; $Lvalue_73 = [$data[ 73][7], $data[73][8], $data[73][9]];
$Kvalue_74 = [$data[74][2], $data[74][3], $data[74][4], $data[74][5], $data[74][6]]; $Lvalue_74 = [$data[ 74][7], $data[74][8], $data[74][9]];
$Kvalue_75 = [$data[75][2], $data[75][3], $data[75][4], $data[75][5], $data[75][6]]; $Lvalue_75 = [$data[ 75][7], $data[75][8], $data[75][9]];
$Kvalue_76 = [$data[76][2], $data[76][3], $data[76][4], $data[76][5], $data[76][6]]; $Lvalue_76 = [$data[ 76][7], $data[76][8], $data[76][9]];
$Kvalue_77 = [$data[77][2], $data[77][3], $data[77][4], $data[77][5], $data[77][6]]; $Lvalue_77 = [$data[ 77][7], $data[77][8], $data[77][9]];
$Kvalue_78 = [$data[78][2], $data[78][3], $data[78][4], $data[78][5], $data[78][6]]; $Lvalue_78 = [$data[ 78][7], $data[78][8], $data[78][9]];
$Kvalue_79 = [$data[79][2], $data[79][3], $data[79][4], $data[79][5], $data[79][6]]; $Lvalue_79 = [$data[ 79][7], $data[79][8], $data[79][9]];
$Kvalue_80 = [$data[80][2], $data[80][3], $data[80][4], $data[80][5], $data[80][6]]; $Lvalue_80 = [$data[ 80][7], $data[80][8], $data[80][9]];
$Kvalue_81 = [$data[81][2], $data[81][3], $data[81][4], $data[81][5], $data[81][6]]; $Lvalue_81 = [$data[ 81][7], $data[81][8], $data[81][9]];
$Kvalue_82 = [$data[82][2], $data[82][3], $data[82][4], $data[82][5], $data[82][6]]; $Lvalue_82 = [$data[ 82][7], $data[82][8], $data[82][9]];
$Kvalue_83 = [$data[83][2], $data[83][3], $data[83][4], $data[83][5], $data[83][6]]; $Lvalue_83 = [$data[ 83][7], $data[83][8], $data[83][9]];
$Kvalue_84 = [$data[84][2], $data[84][3], $data[84][4], $data[84][5], $data[84][6]]; $Lvalue_84 = [$data[ 84][7], $data[84][8], $data[84][9]];
$Kvalue_85 = [$data[85][2], $data[85][3], $data[85][4], $data[85][5], $data[85][6]]; $Lvalue_85 = [$data[ 85][7], $data[85][8], $data[85][9]];
$Kvalue_86 = [$data[86][2], $data[86][3], $data[86][4], $data[86][5], $data[86][6]]; $Lvalue_86 = [$data[ 86][7], $data[86][8], $data[86][9]];
$Kvalue_87 = [$data[87][2], $data[87][3], $data[87][4], $data[87][5], $data[87][6]]; $Lvalue_87 = [$data[ 87][7], $data[87][8], $data[87][9]];
$Kvalue_88 = [$data[88][2], $data[88][3], $data[88][4], $data[88][5], $data[88][6]]; $Lvalue_88 = [$data[ 88][7], $data[88][8], $data[88][9]];
$Kvalue_89 = [$data[89][2], $data[89][3], $data[89][4], $data[89][5], $data[89][6]]; $Lvalue_89 = [$data[ 89][7], $data[89][8], $data[89][9]];
$Kvalue_90 = [$data[90][2], $data[90][3], $data[90][4], $data[90][5], $data[90][6]]; $Lvalue_90 = [$data[ 90][7], $data[90][8], $data[90][9]];
$Kvalue_91 = [$data[91][2], $data[91][3], $data[91][4], $data[91][5], $data[91][6]]; $Lvalue_91 = [$data[ 91][7], $data[91][8], $data[91][9]];
$Kvalue_92 = [$data[92][2], $data[92][3], $data[92][4], $data[92][5], $data[92][6]]; $Lvalue_92 = [$data[ 92][7], $data[92][8], $data[92][9]];
$Kvalue_93 = [$data[93][2], $data[93][3], $data[93][4], $data[93][5], $data[93][6]]; $Lvalue_93 = [$data[ 93][7], $data[93][8], $data[93][9]];
$Kvalue_94 = [$data[94][2], $data[94][3], $data[94][4], $data[94][5], $data[94][6]]; $Lvalue_94 = [$data[ 94][7], $data[94][8], $data[94][9]];
$Kvalue_95 = [$data[95][2], $data[95][3], $data[95][4], $data[95][5], $data[95][6]]; $Lvalue_95 = [$data[ 95][7], $data[95][8], $data[95][9]];
$Kvalue_96 = [$data[96][2], $data[96][3], $data[96][4], $data[96][5], $data[96][6]]; $Lvalue_96 = [$data[ 96][7], $data[96][8], $data[96][9]];
$Kvalue_97 = [$data[97][2], $data[97][3], $data[97][4], $data[97][5], $data[97][6]]; $Lvalue_97 = [$data[ 97][7], $data[97][8], $data[97][9]];
$Kvalue_98 = [$data[98][2], $data[98][3], $data[98][4], $data[98][5], $data[98][6]]; $Lvalue_98 = [$data[ 98][7], $data[98][8], $data[98][9]];
$Kvalue_99 = [$data[99][2], $data[99][3], $data[99][4], $data[99][5], $data[99][6]]; $Lvalue_99 = [$data[ 99][7], $data[99][8], $data[99][9]];
$Kvalue_100 = [$data[100][2], $data[100][3], $data[100][4], $data[100][5], $data[100][6]]; $Lvalue_100 = [$data[ 100][7], $data[100][8], $data[100][9]];
$Kvalue_101 = [$data[101][2], $data[101][3], $data[101][4], $data[101][5], $data[101][6]]; $Lvalue_101 = [$data[ 101][7], $data[101][8], $data[101][9]];
$Kvalue_102 = [$data[102][2], $data[102][3], $data[102][4], $data[102][5], $data[102][6]]; $Lvalue_102 = [$data[ 102][7], $data[102][8], $data[102][9]];
$Kvalue_103 = [$data[103][2], $data[103][3], $data[103][4], $data[103][5], $data[103][6]]; $Lvalue_103 = [$data[ 103][7], $data[103][8], $data[103][9]];
$Kvalue_104 = [$data[104][2], $data[104][3], $data[104][4], $data[104][5], $data[104][6]]; $Lvalue_104 = [$data[ 104][7], $data[104][8], $data[104][9]];
$Kvalue_105 = [$data[105][2], $data[105][3], $data[105][4], $data[105][5], $data[105][6]]; $Lvalue_105 = [$data[ 105][7], $data[105][8], $data[105][9]];
$Kvalue_106 = [$data[106][2], $data[106][3], $data[106][4], $data[106][5], $data[106][6]]; $Lvalue_106 = [$data[ 106][7], $data[106][8], $data[106][9]];
$Kvalue_107 = [$data[107][2], $data[107][3], $data[107][4], $data[107][5], $data[107][6]]; $Lvalue_107 = [$data[ 107][7], $data[107][8], $data[107][9]];
$Kvalue_108 = [$data[108][2], $data[108][3], $data[108][4], $data[108][5], $data[108][6]]; $Lvalue_108 = [$data[ 108][7], $data[108][8], $data[108][9]];
$Kvalue_109 = [$data[109][2], $data[109][3], $data[109][4], $data[109][5], $data[109][6]]; $Lvalue_109 = [$data[ 109][7], $data[109][8], $data[109][9]];
$Kvalue_110 = [$data[110][2], $data[110][3], $data[110][4], $data[110][5], $data[110][6]]; $Lvalue_110 = [$data[ 110][7], $data[110][8], $data[110][9]];
$Kvalue_111 = [$data[111][2], $data[111][3], $data[111][4], $data[111][5], $data[111][6]]; $Lvalue_111 = [$data[ 111][7], $data[111][8], $data[111][9]];
$Kvalue_112 = [$data[112][2], $data[112][3], $data[112][4], $data[112][5], $data[112][6]]; $Lvalue_112 = [$data[ 112][7], $data[112][8], $data[112][9]];
$Kvalue_113 = [$data[113][2], $data[113][3], $data[113][4], $data[113][5], $data[113][6]]; $Lvalue_113 = [$data[ 113][7], $data[113][8], $data[113][9]];
$Kvalue_114 = [$data[114][2], $data[114][3], $data[114][4], $data[114][5], $data[114][6]]; $Lvalue_114 = [$data[ 114][7], $data[114][8], $data[114][9]];
$Kvalue_115 = [$data[115][2], $data[115][3], $data[115][4], $data[115][5], $data[115][6]]; $Lvalue_115 = [$data[ 115][7], $data[115][8], $data[115][9]];
$Kvalue_116 = [$data[116][2], $data[116][3], $data[116][4], $data[116][5], $data[116][6]]; $Lvalue_116 = [$data[ 116][7], $data[116][8], $data[116][9]];
$Kvalue_117 = [$data[117][2], $data[117][3], $data[117][4], $data[117][5], $data[117][6]]; $Lvalue_117 = [$data[ 117][7], $data[117][8], $data[117][9]];
$Kvalue_118 = [$data[118][2], $data[118][3], $data[118][4], $data[118][5], $data[118][6]]; $Lvalue_118 = [$data[ 118][7], $data[118][8], $data[118][9]];
$Kvalue_119 = [$data[119][2], $data[119][3], $data[119][4], $data[119][5], $data[119][6]]; $Lvalue_119 = [$data[ 119][7], $data[119][8], $data[119][9]];
$Kvalue_120 = [$data[120][2], $data[120][3], $data[120][4], $data[120][5], $data[120][6]]; $Lvalue_120 = [$data[ 120][7], $data[120][8], $data[120][9]];
$Kvalue_121 = [$data[121][2], $data[121][3], $data[121][4], $data[121][5], $data[121][6]]; $Lvalue_121 = [$data[ 121][7], $data[121][8], $data[121][9]];
$Kvalue_122 = [$data[122][2], $data[122][3], $data[122][4], $data[122][5], $data[122][6]]; $Lvalue_122 = [$data[ 122][7], $data[122][8], $data[122][9]];
$Kvalue_123 = [$data[123][2], $data[123][3], $data[123][4], $data[123][5], $data[123][6]]; $Lvalue_123 = [$data[ 123][7], $data[123][8], $data[123][9]];
$Kvalue_124 = [$data[124][2], $data[124][3], $data[124][4], $data[124][5], $data[124][6]]; $Lvalue_124 = [$data[ 124][7], $data[124][8], $data[124][9]];
$Kvalue_125 = [$data[125][2], $data[125][3], $data[125][4], $data[125][5], $data[125][6]]; $Lvalue_125 = [$data[ 125][7], $data[125][8], $data[125][9]];
$Kvalue_126 = [$data[126][2], $data[126][3], $data[126][4], $data[126][5], $data[126][6]]; $Lvalue_126 = [$data[ 126][7], $data[126][8], $data[126][9]];
$Kvalue_127 = [$data[127][2], $data[127][3], $data[127][4], $data[127][5], $data[127][6]]; $Lvalue_127 = [$data[ 127][7], $data[127][8], $data[127][9]];
$Kvalue_128 = [$data[128][2], $data[128][3], $data[128][4], $data[128][5], $data[128][6]]; $Lvalue_128 = [$data[ 128][7], $data[128][8], $data[128][9]];
$Kvalue_129 = [$data[129][2], $data[129][3], $data[129][4], $data[129][5], $data[129][6]]; $Lvalue_129 = [$data[ 129][7], $data[129][8], $data[129][9]];
$Kvalue_130 = [$data[130][2], $data[130][3], $data[130][4], $data[130][5], $data[130][6]]; $Lvalue_130 = [$data[ 130][7], $data[130][8], $data[130][9]];
$Kvalue_131 = [$data[131][2], $data[131][3], $data[131][4], $data[131][5], $data[131][6]]; $Lvalue_131 = [$data[ 131][7], $data[131][8], $data[131][9]];
$Kvalue_132 = [$data[132][2], $data[132][3], $data[132][4], $data[132][5], $data[132][6]]; $Lvalue_132 = [$data[ 132][7], $data[132][8], $data[132][9]];
$Kvalue_133 = [$data[133][2], $data[133][3], $data[133][4], $data[133][5], $data[133][6]]; $Lvalue_133 = [$data[ 133][7], $data[133][8], $data[133][9]];
$Kvalue_134 = [$data[134][2], $data[134][3], $data[134][4], $data[134][5], $data[134][6]]; $Lvalue_134 = [$data[ 134][7], $data[134][8], $data[134][9]];
$Kvalue_135 = [$data[135][2], $data[135][3], $data[135][4], $data[135][5], $data[135][6]]; $Lvalue_135 = [$data[ 135][7], $data[135][8], $data[135][9]];
$Kvalue_136 = [$data[136][2], $data[136][3], $data[136][4], $data[136][5], $data[136][6]]; $Lvalue_136 = [$data[ 136][7], $data[136][8], $data[136][9]];
$Kvalue_137 = [$data[137][2], $data[137][3], $data[137][4], $data[137][5], $data[137][6]]; $Lvalue_137 = [$data[ 137][7], $data[137][8], $data[137][9]];
$Kvalue_138 = [$data[138][2], $data[138][3], $data[138][4], $data[138][5], $data[138][6]]; $Lvalue_138 = [$data[ 138][7], $data[138][8], $data[138][9]];
$Kvalue_139 = [$data[139][2], $data[139][3], $data[139][4], $data[139][5], $data[139][6]]; $Lvalue_139 = [$data[ 139][7], $data[139][8], $data[139][9]];
$Kvalue_140 = [$data[140][2], $data[140][3], $data[140][4], $data[140][5], $data[140][6]]; $Lvalue_140 = [$data[ 140][7], $data[140][8], $data[140][9]];
$Kvalue_141 = [$data[141][2], $data[141][3], $data[141][4], $data[141][5], $data[141][6]]; $Lvalue_141 = [$data[ 141][7], $data[141][8], $data[141][9]];
$Kvalue_142 = [$data[142][2], $data[142][3], $data[142][4], $data[142][5], $data[142][6]]; $Lvalue_142 = [$data[ 142][7], $data[142][8], $data[142][9]];
$Kvalue_143 = [$data[143][2], $data[143][3], $data[143][4], $data[143][5], $data[143][6]]; $Lvalue_143 = [$data[ 143][7], $data[143][8], $data[143][9]];
$Kvalue_144 = [$data[144][2], $data[144][3], $data[144][4], $data[144][5], $data[144][6]]; $Lvalue_144 = [$data[ 144][7], $data[144][8], $data[144][9]];
$Kvalue_145 = [$data[145][2], $data[145][3], $data[145][4], $data[145][5], $data[145][6]]; $Lvalue_145 = [$data[ 145][7], $data[145][8], $data[145][9]];
$Kvalue_146 = [$data[146][2], $data[146][3], $data[146][4], $data[146][5], $data[146][6]]; $Lvalue_146 = [$data[ 146][7], $data[146][8], $data[146][9]];
$Kvalue_147 = [$data[147][2], $data[147][3], $data[147][4], $data[147][5], $data[147][6]]; $Lvalue_147 = [$data[ 147][7], $data[147][8], $data[147][9]];
$Kvalue_148 = [$data[148][2], $data[148][3], $data[148][4], $data[148][5], $data[148][6]]; $Lvalue_148 = [$data[ 148][7], $data[148][8], $data[148][9]];
$Kvalue_149 = [$data[149][2], $data[149][3], $data[149][4], $data[149][5], $data[149][6]]; $Lvalue_149 = [$data[ 149][7], $data[149][8], $data[149][9]];
$Kvalue_150 = [$data[150][2], $data[150][3], $data[150][4], $data[150][5], $data[150][6]]; $Lvalue_150 = [$data[ 150][7], $data[150][8], $data[150][9]];
$Kvalue_151 = [$data[151][2], $data[151][3], $data[151][4], $data[151][5], $data[151][6]]; $Lvalue_151 = [$data[ 151][7], $data[151][8], $data[151][9]];
$Kvalue_152 = [$data[152][2], $data[152][3], $data[152][4], $data[152][5], $data[152][6]]; $Lvalue_152 = [$data[ 152][7], $data[152][8], $data[152][9]];
$Kvalue_153 = [$data[153][2], $data[153][3], $data[153][4], $data[153][5], $data[153][6]]; $Lvalue_153 = [$data[ 153][7], $data[153][8], $data[153][9]];
$Kvalue_154 = [$data[154][2], $data[154][3], $data[154][4], $data[154][5], $data[154][6]]; $Lvalue_154 = [$data[ 154][7], $data[154][8], $data[154][9]];
$Kvalue_155 = [$data[155][2], $data[155][3], $data[155][4], $data[155][5], $data[155][6]]; $Lvalue_155 = [$data[ 155][7], $data[155][8], $data[155][9]];
$Kvalue_156 = [$data[156][2], $data[156][3], $data[156][4], $data[156][5], $data[156][6]]; $Lvalue_156 = [$data[ 156][7], $data[156][8], $data[156][9]];
$Kvalue_157 = [$data[157][2], $data[157][3], $data[157][4], $data[157][5], $data[157][6]]; $Lvalue_157 = [$data[ 157][7], $data[157][8], $data[157][9]];
$Kvalue_158 = [$data[158][2], $data[158][3], $data[158][4], $data[158][5], $data[158][6]]; $Lvalue_158 = [$data[ 158][7], $data[158][8], $data[158][9]];
$Kvalue_159 = [$data[159][2], $data[159][3], $data[159][4], $data[159][5], $data[159][6]]; $Lvalue_159 = [$data[ 159][7], $data[159][8], $data[159][9]];
$Kvalue_160 = [$data[160][2], $data[160][3], $data[160][4], $data[160][5], $data[160][6]]; $Lvalue_160 = [$data[ 160][7], $data[160][8], $data[160][9]];
$Kvalue_161 = [$data[161][2], $data[161][3], $data[161][4], $data[161][5], $data[161][6]]; $Lvalue_161 = [$data[ 161][7], $data[161][8], $data[161][9]];
$Kvalue_162 = [$data[162][2], $data[162][3], $data[162][4], $data[162][5], $data[162][6]]; $Lvalue_162 = [$data[ 162][7], $data[162][8], $data[162][9]];
$Kvalue_163 = [$data[163][2], $data[163][3], $data[163][4], $data[163][5], $data[163][6]]; $Lvalue_163 = [$data[ 163][7], $data[163][8], $data[163][9]];
$Kvalue_164 = [$data[164][2], $data[164][3], $data[164][4], $data[164][5], $data[164][6]]; $Lvalue_164 = [$data[ 164][7], $data[164][8], $data[164][9]];
$Kvalue_165 = [$data[165][2], $data[165][3], $data[165][4], $data[165][5], $data[165][6]]; $Lvalue_165 = [$data[ 165][7], $data[165][8], $data[165][9]];
$Kvalue_166 = [$data[166][2], $data[166][3], $data[166][4], $data[166][5], $data[166][6]]; $Lvalue_166 = [$data[ 166][7], $data[166][8], $data[166][9]];
$Kvalue_167 = [$data[167][2], $data[167][3], $data[167][4], $data[167][5], $data[167][6]]; $Lvalue_167 = [$data[ 167][7], $data[167][8], $data[167][9]];
$Kvalue_168 = [$data[168][2], $data[168][3], $data[168][4], $data[168][5], $data[168][6]]; $Lvalue_168 = [$data[ 168][7], $data[168][8], $data[168][9]];
$Kvalue_169 = [$data[169][2], $data[169][3], $data[169][4], $data[169][5], $data[169][6]]; $Lvalue_169 = [$data[ 169][7], $data[169][8], $data[169][9]];
$Kvalue_170 = [$data[170][2], $data[170][3], $data[170][4], $data[170][5], $data[170][6]]; $Lvalue_170 = [$data[ 170][7], $data[170][8], $data[170][9]];
$Kvalue_171 = [$data[171][2], $data[171][3], $data[171][4], $data[171][5], $data[171][6]]; $Lvalue_171 = [$data[ 171][7], $data[171][8], $data[171][9]];
$Kvalue_172 = [$data[172][2], $data[172][3], $data[172][4], $data[172][5], $data[172][6]]; $Lvalue_172 = [$data[ 172][7], $data[172][8], $data[172][9]];
$Kvalue_173 = [$data[173][2], $data[173][3], $data[173][4], $data[173][5], $data[173][6]]; $Lvalue_173 = [$data[ 173][7], $data[173][8], $data[173][9]];
$Kvalue_174 = [$data[174][2], $data[174][3], $data[174][4], $data[174][5], $data[174][6]]; $Lvalue_174 = [$data[ 174][7], $data[174][8], $data[174][9]];
$Kvalue_175 = [$data[175][2], $data[175][3], $data[175][4], $data[175][5], $data[175][6]]; $Lvalue_175 = [$data[ 175][7], $data[175][8], $data[175][9]];
$Kvalue_176 = [$data[176][2], $data[176][3], $data[176][4], $data[176][5], $data[176][6]]; $Lvalue_176 = [$data[ 176][7], $data[176][8], $data[176][9]];
$Kvalue_177 = [$data[177][2], $data[177][3], $data[177][4], $data[177][5], $data[177][6]]; $Lvalue_177 = [$data[ 177][7], $data[177][8], $data[177][9]];
$Kvalue_178 = [$data[178][2], $data[178][3], $data[178][4], $data[178][5], $data[178][6]]; $Lvalue_178 = [$data[ 178][7], $data[178][8], $data[178][9]];
$Kvalue_179 = [$data[179][2], $data[179][3], $data[179][4], $data[179][5], $data[179][6]]; $Lvalue_179 = [$data[ 179][7], $data[179][8], $data[179][9]];
$Kvalue_180 = [$data[180][2], $data[180][3], $data[180][4], $data[180][5], $data[180][6]]; $Lvalue_180 = [$data[ 180][7], $data[180][8], $data[180][9]];
$Kvalue_181 = [$data[181][2], $data[181][3], $data[181][4], $data[181][5], $data[181][6]]; $Lvalue_181 = [$data[ 181][7], $data[181][8], $data[181][9]];
$Kvalue_182 = [$data[182][2], $data[182][3], $data[182][4], $data[182][5], $data[182][6]]; $Lvalue_182 = [$data[ 182][7], $data[182][8], $data[182][9]];
$Kvalue_183 = [$data[183][2], $data[183][3], $data[183][4], $data[183][5], $data[183][6]]; $Lvalue_183 = [$data[ 183][7], $data[183][8], $data[183][9]];
$Kvalue_184 = [$data[184][2], $data[184][3], $data[184][4], $data[184][5], $data[184][6]]; $Lvalue_184 = [$data[ 184][7], $data[184][8], $data[184][9]];
$Kvalue_185 = [$data[185][2], $data[185][3], $data[185][4], $data[185][5], $data[185][6]]; $Lvalue_185 = [$data[ 185][7], $data[185][8], $data[185][9]];
$Kvalue_186 = [$data[186][2], $data[186][3], $data[186][4], $data[186][5], $data[186][6]]; $Lvalue_186 = [$data[ 186][7], $data[186][8], $data[186][9]];
$Kvalue_187 = [$data[187][2], $data[187][3], $data[187][4], $data[187][5], $data[187][6]]; $Lvalue_187 = [$data[ 187][7], $data[187][8], $data[187][9]];
$Kvalue_188 = [$data[188][2], $data[188][3], $data[188][4], $data[188][5], $data[188][6]]; $Lvalue_188 = [$data[ 188][7], $data[188][8], $data[188][9]];
$Kvalue_189 = [$data[189][2], $data[189][3], $data[189][4], $data[189][5], $data[189][6]]; $Lvalue_189 = [$data[ 189][7], $data[189][8], $data[189][9]];
$Kvalue_190 = [$data[190][2], $data[190][3], $data[190][4], $data[190][5], $data[190][6]]; $Lvalue_190 = [$data[ 190][7], $data[190][8], $data[190][9]];
$Kvalue_191 = [$data[191][2], $data[191][3], $data[191][4], $data[191][5], $data[191][6]]; $Lvalue_191 = [$data[ 191][7], $data[191][8], $data[191][9]];
$Kvalue_192 = [$data[192][2], $data[192][3], $data[192][4], $data[192][5], $data[192][6]]; $Lvalue_192 = [$data[ 192][7], $data[192][8], $data[192][9]];
$Kvalue_193 = [$data[193][2], $data[193][3], $data[193][4], $data[193][5], $data[193][6]]; $Lvalue_193 = [$data[ 193][7], $data[193][8], $data[193][9]];
$Kvalue_194 = [$data[194][2], $data[194][3], $data[194][4], $data[194][5], $data[194][6]]; $Lvalue_194 = [$data[ 194][7], $data[194][8], $data[194][9]];
$Kvalue_195 = [$data[195][2], $data[195][3], $data[195][4], $data[195][5], $data[195][6]]; $Lvalue_195 = [$data[ 195][7], $data[195][8], $data[195][9]];
$Kvalue_196 = [$data[196][2], $data[196][3], $data[196][4], $data[196][5], $data[196][6]]; $Lvalue_196 = [$data[ 196][7], $data[196][8], $data[196][9]];
$Kvalue_197 = [$data[197][2], $data[197][3], $data[197][4], $data[197][5], $data[197][6]]; $Lvalue_197 = [$data[ 197][7], $data[197][8], $data[197][9]];
$Kvalue_198 = [$data[198][2], $data[198][3], $data[198][4], $data[198][5], $data[198][6]]; $Lvalue_198 = [$data[ 198][7], $data[198][8], $data[198][9]];
$Kvalue_199 = [$data[199][2], $data[199][3], $data[199][4], $data[199][5], $data[199][6]]; $Lvalue_199 = [$data[ 199][7], $data[199][8], $data[199][9]];
$Kvalue_200 = [$data[200][2], $data[200][3], $data[200][4], $data[200][5], $data[200][6]]; $Lvalue_200 = [$data[ 200][7], $data[200][8], $data[200][9]];
$Kvalue_201 = [$data[201][2], $data[201][3], $data[201][4], $data[201][5], $data[201][6]]; $Lvalue_201 = [$data[ 201][7], $data[201][8], $data[201][9]];
$Kvalue_202 = [$data[202][2], $data[202][3], $data[202][4], $data[202][5], $data[202][6]]; $Lvalue_202 = [$data[ 202][7], $data[202][8], $data[202][9]];
$Kvalue_203 = [$data[203][2], $data[203][3], $data[203][4], $data[203][5], $data[203][6]]; $Lvalue_203 = [$data[ 203][7], $data[203][8], $data[203][9]];
$Kvalue_204 = [$data[204][2], $data[204][3], $data[204][4], $data[204][5], $data[204][6]]; $Lvalue_204 = [$data[ 204][7], $data[204][8], $data[204][9]];
$Kvalue_205 = [$data[205][2], $data[205][3], $data[205][4], $data[205][5], $data[205][6]]; $Lvalue_205 = [$data[ 205][7], $data[205][8], $data[205][9]];
$Kvalue_206 = [$data[206][2], $data[206][3], $data[206][4], $data[206][5], $data[206][6]]; $Lvalue_206 = [$data[ 206][7], $data[206][8], $data[206][9]];
$Kvalue_207 = [$data[207][2], $data[207][3], $data[207][4], $data[207][5], $data[207][6]]; $Lvalue_207 = [$data[ 207][7], $data[207][8], $data[207][9]];
$Kvalue_208 = [$data[208][2], $data[208][3], $data[208][4], $data[208][5], $data[208][6]]; $Lvalue_208 = [$data[ 208][7], $data[208][8], $data[208][9]];
$Kvalue_209 = [$data[209][2], $data[209][3], $data[209][4], $data[209][5], $data[209][6]]; $Lvalue_209 = [$data[ 209][7], $data[209][8], $data[209][9]];
$Kvalue_210 = [$data[210][2], $data[210][3], $data[210][4], $data[210][5], $data[210][6]]; $Lvalue_210 = [$data[ 210][7], $data[210][8], $data[210][9]];
$Kvalue_211 = [$data[211][2], $data[211][3], $data[211][4], $data[211][5], $data[211][6]]; $Lvalue_211 = [$data[ 211][7], $data[211][8], $data[211][9]];
$Kvalue_212 = [$data[212][2], $data[212][3], $data[212][4], $data[212][5], $data[212][6]]; $Lvalue_212 = [$data[ 212][7], $data[212][8], $data[212][9]];
$Kvalue_213 = [$data[213][2], $data[213][3], $data[213][4], $data[213][5], $data[213][6]]; $Lvalue_213 = [$data[ 213][7], $data[213][8], $data[213][9]];
$Kvalue_214 = [$data[214][2], $data[214][3], $data[214][4], $data[214][5], $data[214][6]]; $Lvalue_214 = [$data[ 214][7], $data[214][8], $data[214][9]];
$Kvalue_215 = [$data[215][2], $data[215][3], $data[215][4], $data[215][5], $data[215][6]]; $Lvalue_215 = [$data[ 215][7], $data[215][8], $data[215][9]];
$Kvalue_216 = [$data[216][2], $data[216][3], $data[216][4], $data[216][5], $data[216][6]]; $Lvalue_216 = [$data[ 216][7], $data[216][8], $data[216][9]];
$Kvalue_217 = [$data[217][2], $data[217][3], $data[217][4], $data[217][5], $data[217][6]]; $Lvalue_217 = [$data[ 217][7], $data[217][8], $data[217][9]];
$Kvalue_218 = [$data[218][2], $data[218][3], $data[218][4], $data[218][5], $data[218][6]]; $Lvalue_218 = [$data[ 218][7], $data[218][8], $data[218][9]];
$Kvalue_219 = [$data[219][2], $data[219][3], $data[219][4], $data[219][5], $data[219][6]]; $Lvalue_219 = [$data[ 219][7], $data[219][8], $data[219][9]];
$Kvalue_220 = [$data[220][2], $data[220][3], $data[220][4], $data[220][5], $data[220][6]]; $Lvalue_220 = [$data[ 220][7], $data[220][8], $data[220][9]];
$Kvalue_221 = [$data[221][2], $data[221][3], $data[221][4], $data[221][5], $data[221][6]]; $Lvalue_221 = [$data[ 221][7], $data[221][8], $data[221][9]];
$Kvalue_222 = [$data[222][2], $data[222][3], $data[222][4], $data[222][5], $data[222][6]]; $Lvalue_222 = [$data[ 222][7], $data[222][8], $data[222][9]];
$Kvalue_223 = [$data[223][2], $data[223][3], $data[223][4], $data[223][5], $data[223][6]]; $Lvalue_223 = [$data[ 223][7], $data[223][8], $data[223][9]];
$Kvalue_224 = [$data[224][2], $data[224][3], $data[224][4], $data[224][5], $data[224][6]]; $Lvalue_224 = [$data[ 224][7], $data[224][8], $data[224][9]];
$Kvalue_225 = [$data[225][2], $data[225][3], $data[225][4], $data[225][5], $data[225][6]]; $Lvalue_225 = [$data[ 225][7], $data[225][8], $data[225][9]];
$Kvalue_226 = [$data[226][2], $data[226][3], $data[226][4], $data[226][5], $data[226][6]]; $Lvalue_226 = [$data[ 226][7], $data[226][8], $data[226][9]];
$Kvalue_227 = [$data[227][2], $data[227][3], $data[227][4], $data[227][5], $data[227][6]]; $Lvalue_227 = [$data[ 227][7], $data[227][8], $data[227][9]];
$Kvalue_228 = [$data[228][2], $data[228][3], $data[228][4], $data[228][5], $data[228][6]]; $Lvalue_228 = [$data[ 228][7], $data[228][8], $data[228][9]];
$Kvalue_229 = [$data[229][2], $data[229][3], $data[229][4], $data[229][5], $data[229][6]]; $Lvalue_229 = [$data[ 229][7], $data[229][8], $data[229][9]];
$Kvalue_230 = [$data[230][2], $data[230][3], $data[230][4], $data[230][5], $data[230][6]]; $Lvalue_230 = [$data[ 230][7], $data[230][8], $data[230][9]];
$Kvalue_231 = [$data[231][2], $data[231][3], $data[231][4], $data[231][5], $data[231][6]]; $Lvalue_231 = [$data[ 231][7], $data[231][8], $data[231][9]];
$Kvalue_232 = [$data[232][2], $data[232][3], $data[232][4], $data[232][5], $data[232][6]]; $Lvalue_232 = [$data[ 232][7], $data[232][8], $data[232][9]];
$Kvalue_233 = [$data[233][2], $data[233][3], $data[233][4], $data[233][5], $data[233][6]]; $Lvalue_233 = [$data[ 233][7], $data[233][8], $data[233][9]];
$Kvalue_234 = [$data[234][2], $data[234][3], $data[234][4], $data[234][5], $data[234][6]]; $Lvalue_234 = [$data[ 234][7], $data[234][8], $data[234][9]];
$Kvalue_235 = [$data[235][2], $data[235][3], $data[235][4], $data[235][5], $data[235][6]]; $Lvalue_235 = [$data[ 235][7], $data[235][8], $data[235][9]];
$Kvalue_236 = [$data[236][2], $data[236][3], $data[236][4], $data[236][5], $data[236][6]]; $Lvalue_236 = [$data[ 236][7], $data[236][8], $data[236][9]];
$Kvalue_237 = [$data[237][2], $data[237][3], $data[237][4], $data[237][5], $data[237][6]]; $Lvalue_237 = [$data[ 237][7], $data[237][8], $data[237][9]];
$Kvalue_238 = [$data[238][2], $data[238][3], $data[238][4], $data[238][5], $data[238][6]]; $Lvalue_238 = [$data[ 238][7], $data[238][8], $data[238][9]];
$Kvalue_239 = [$data[239][2], $data[239][3], $data[239][4], $data[239][5], $data[239][6]]; $Lvalue_239 = [$data[ 239][7], $data[239][8], $data[239][9]];
$Kvalue_240 = [$data[240][2], $data[240][3], $data[240][4], $data[240][5], $data[240][6]]; $Lvalue_240 = [$data[ 240][7], $data[240][8], $data[240][9]];
$Kvalue_241 = [$data[241][2], $data[241][3], $data[241][4], $data[241][5], $data[241][6]]; $Lvalue_241 = [$data[ 241][7], $data[241][8], $data[241][9]];
$Kvalue_242 = [$data[242][2], $data[242][3], $data[242][4], $data[242][5], $data[242][6]]; $Lvalue_242 = [$data[ 242][7], $data[242][8], $data[242][9]];
$Kvalue_243 = [$data[243][2], $data[243][3], $data[243][4], $data[243][5], $data[243][6]]; $Lvalue_243 = [$data[ 243][7], $data[243][8], $data[243][9]];
$Kvalue_244 = [$data[244][2], $data[244][3], $data[244][4], $data[244][5], $data[244][6]]; $Lvalue_244 = [$data[ 244][7], $data[244][8], $data[244][9]];
$Kvalue_245 = [$data[245][2], $data[245][3], $data[245][4], $data[245][5], $data[245][6]]; $Lvalue_245 = [$data[ 245][7], $data[245][8], $data[245][9]];
$Kvalue_246 = [$data[246][2], $data[246][3], $data[246][4], $data[246][5], $data[246][6]]; $Lvalue_246 = [$data[ 246][7], $data[246][8], $data[246][9]];
$Kvalue_247 = [$data[247][2], $data[247][3], $data[247][4], $data[247][5], $data[247][6]]; $Lvalue_247 = [$data[ 247][7], $data[247][8], $data[247][9]];
$Kvalue_248 = [$data[248][2], $data[248][3], $data[248][4], $data[248][5], $data[248][6]]; $Lvalue_248 = [$data[ 248][7], $data[248][8], $data[248][9]];
$Kvalue_249 = [$data[249][2], $data[249][3], $data[249][4], $data[249][5], $data[249][6]]; $Lvalue_249 = [$data[ 249][7], $data[249][8], $data[249][9]];
$Kvalue_250 = [$data[250][2], $data[250][3], $data[250][4], $data[250][5], $data[250][6]]; $Lvalue_250 = [$data[ 250][7], $data[250][8], $data[250][9]];
$Kvalue_251 = [$data[251][2], $data[251][3], $data[251][4], $data[251][5], $data[251][6]]; $Lvalue_251 = [$data[ 251][7], $data[251][8], $data[251][9]];
$Kvalue_252 = [$data[252][2], $data[252][3], $data[252][4], $data[252][5], $data[252][6]]; $Lvalue_252 = [$data[ 252][7], $data[252][8], $data[252][9]];
$Kvalue_253 = [$data[253][2], $data[253][3], $data[253][4], $data[253][5], $data[253][6]]; $Lvalue_253 = [$data[ 253][7], $data[253][8], $data[253][9]];
$Kvalue_254 = [$data[254][2], $data[254][3], $data[254][4], $data[254][5], $data[254][6]]; $Lvalue_254 = [$data[ 254][7], $data[254][8], $data[254][9]];
$Kvalue_255 = [$data[255][2], $data[255][3], $data[255][4], $data[255][5], $data[255][6]]; $Lvalue_255 = [$data[ 255][7], $data[255][8], $data[255][9]];
$Kvalue_256 = [$data[256][2], $data[256][3], $data[256][4], $data[256][5], $data[256][6]]; $Lvalue_256 = [$data[ 256][7], $data[256][8], $data[256][9]];
$Kvalue_257 = [$data[257][2], $data[257][3], $data[257][4], $data[257][5], $data[257][6]]; $Lvalue_257 = [$data[ 257][7], $data[257][8], $data[257][9]];
$Kvalue_258 = [$data[258][2], $data[258][3], $data[258][4], $data[258][5], $data[258][6]]; $Lvalue_258 = [$data[ 258][7], $data[258][8], $data[258][9]];
$Kvalue_259 = [$data[259][2], $data[259][3], $data[259][4], $data[259][5], $data[259][6]]; $Lvalue_259 = [$data[ 259][7], $data[259][8], $data[259][9]];
$Kvalue_260 = [$data[260][2], $data[260][3], $data[260][4], $data[260][5], $data[260][6]]; $Lvalue_260 = [$data[ 260][7], $data[260][8], $data[260][9]];
$Kvalue_261 = [$data[261][2], $data[261][3], $data[261][4], $data[261][5], $data[261][6]]; $Lvalue_261 = [$data[ 261][7], $data[261][8], $data[261][9]];
$Kvalue_262 = [$data[262][2], $data[262][3], $data[262][4], $data[262][5], $data[262][6]]; $Lvalue_262 = [$data[ 262][7], $data[262][8], $data[262][9]];
$Kvalue_263 = [$data[263][2], $data[263][3], $data[263][4], $data[263][5], $data[263][6]]; $Lvalue_263 = [$data[ 263][7], $data[263][8], $data[263][9]];
$Kvalue_264 = [$data[264][2], $data[264][3], $data[264][4], $data[264][5], $data[264][6]]; $Lvalue_264 = [$data[ 264][7], $data[264][8], $data[264][9]];
$Kvalue_265 = [$data[265][2], $data[265][3], $data[265][4], $data[265][5], $data[265][6]]; $Lvalue_265 = [$data[ 265][7], $data[265][8], $data[265][9]];
$Kvalue_266 = [$data[266][2], $data[266][3], $data[266][4], $data[266][5], $data[266][6]]; $Lvalue_266 = [$data[ 266][7], $data[266][8], $data[266][9]];
$Kvalue_267 = [$data[267][2], $data[267][3], $data[267][4], $data[267][5], $data[267][6]]; $Lvalue_267 = [$data[ 267][7], $data[267][8], $data[267][9]];
$Kvalue_268 = [$data[268][2], $data[268][3], $data[268][4], $data[268][5], $data[268][6]]; $Lvalue_268 = [$data[ 268][7], $data[268][8], $data[268][9]];
$Kvalue_269 = [$data[269][2], $data[269][3], $data[269][4], $data[269][5], $data[269][6]]; $Lvalue_269 = [$data[ 269][7], $data[269][8], $data[269][9]];
$Kvalue_270 = [$data[270][2], $data[270][3], $data[270][4], $data[270][5], $data[270][6]]; $Lvalue_270 = [$data[ 270][7], $data[270][8], $data[270][9]];
$Kvalue_271 = [$data[271][2], $data[271][3], $data[271][4], $data[271][5], $data[271][6]]; $Lvalue_271 = [$data[ 271][7], $data[271][8], $data[271][9]];
$Kvalue_272 = [$data[272][2], $data[272][3], $data[272][4], $data[272][5], $data[272][6]]; $Lvalue_272 = [$data[ 272][7], $data[272][8], $data[272][9]];
$Kvalue_273 = [$data[273][2], $data[273][3], $data[273][4], $data[273][5], $data[273][6]]; $Lvalue_273 = [$data[ 273][7], $data[273][8], $data[273][9]];
$Kvalue_274 = [$data[274][2], $data[274][3], $data[274][4], $data[274][5], $data[274][6]]; $Lvalue_274 = [$data[ 274][7], $data[274][8], $data[274][9]];
$Kvalue_275 = [$data[275][2], $data[275][3], $data[275][4], $data[275][5], $data[275][6]]; $Lvalue_275 = [$data[ 275][7], $data[275][8], $data[275][9]];
$Kvalue_276 = [$data[276][2], $data[276][3], $data[276][4], $data[276][5], $data[276][6]]; $Lvalue_276 = [$data[ 276][7], $data[276][8], $data[276][9]];
$Kvalue_277 = [$data[277][2], $data[277][3], $data[277][4], $data[277][5], $data[277][6]]; $Lvalue_277 = [$data[ 277][7], $data[277][8], $data[277][9]];
$Kvalue_278 = [$data[278][2], $data[278][3], $data[278][4], $data[278][5], $data[278][6]]; $Lvalue_278 = [$data[ 278][7], $data[278][8], $data[278][9]];
$Kvalue_279 = [$data[279][2], $data[279][3], $data[279][4], $data[279][5], $data[279][6]]; $Lvalue_279 = [$data[ 279][7], $data[279][8], $data[279][9]];
$Kvalue_280 = [$data[280][2], $data[280][3], $data[280][4], $data[280][5], $data[280][6]]; $Lvalue_280 = [$data[ 280][7], $data[280][8], $data[280][9]];
$Kvalue_281 = [$data[281][2], $data[281][3], $data[281][4], $data[281][5], $data[281][6]]; $Lvalue_281 = [$data[ 281][7], $data[281][8], $data[281][9]];
$Kvalue_282 = [$data[282][2], $data[282][3], $data[282][4], $data[282][5], $data[282][6]]; $Lvalue_282 = [$data[ 282][7], $data[282][8], $data[282][9]];
$Kvalue_283 = [$data[283][2], $data[283][3], $data[283][4], $data[283][5], $data[283][6]]; $Lvalue_283 = [$data[ 283][7], $data[283][8], $data[283][9]];
$Kvalue_284 = [$data[284][2], $data[284][3], $data[284][4], $data[284][5], $data[284][6]]; $Lvalue_284 = [$data[ 284][7], $data[284][8], $data[284][9]];
$Kvalue_285 = [$data[285][2], $data[285][3], $data[285][4], $data[285][5], $data[285][6]]; $Lvalue_285 = [$data[ 285][7], $data[285][8], $data[285][9]];
$Kvalue_286 = [$data[286][2], $data[286][3], $data[286][4], $data[286][5], $data[286][6]]; $Lvalue_286 = [$data[ 286][7], $data[286][8], $data[286][9]];
$Kvalue_287 = [$data[287][2], $data[287][3], $data[287][4], $data[287][5], $data[287][6]]; $Lvalue_287 = [$data[ 287][7], $data[287][8], $data[287][9]];
$Kvalue_288 = [$data[288][2], $data[288][3], $data[288][4], $data[288][5], $data[288][6]]; $Lvalue_288 = [$data[ 288][7], $data[288][8], $data[288][9]];
$Kvalue_289 = [$data[289][2], $data[289][3], $data[289][4], $data[289][5], $data[289][6]]; $Lvalue_289 = [$data[ 289][7], $data[289][8], $data[289][9]];
$Kvalue_290 = [$data[290][2], $data[290][3], $data[290][4], $data[290][5], $data[290][6]]; $Lvalue_290 = [$data[ 290][7], $data[290][8], $data[290][9]];
$Kvalue_291 = [$data[291][2], $data[291][3], $data[291][4], $data[291][5], $data[291][6]]; $Lvalue_291 = [$data[ 291][7], $data[291][8], $data[291][9]];
$Kvalue_292 = [$data[292][2], $data[292][3], $data[292][4], $data[292][5], $data[292][6]]; $Lvalue_292 = [$data[ 292][7], $data[292][8], $data[292][9]];
$Kvalue_293 = [$data[293][2], $data[293][3], $data[293][4], $data[293][5], $data[293][6]]; $Lvalue_293 = [$data[ 293][7], $data[293][8], $data[293][9]];
$Kvalue_294 = [$data[294][2], $data[294][3], $data[294][4], $data[294][5], $data[294][6]]; $Lvalue_294 = [$data[ 294][7], $data[294][8], $data[294][9]];
$Kvalue_295 = [$data[295][2], $data[295][3], $data[295][4], $data[295][5], $data[295][6]]; $Lvalue_295 = [$data[ 295][7], $data[295][8], $data[295][9]];
$Kvalue_296 = [$data[296][2], $data[296][3], $data[296][4], $data[296][5], $data[296][6]]; $Lvalue_296 = [$data[ 296][7], $data[296][8], $data[296][9]];
$Kvalue_297 = [$data[297][2], $data[297][3], $data[297][4], $data[297][5], $data[297][6]]; $Lvalue_297 = [$data[ 297][7], $data[297][8], $data[297][9]];
$Kvalue_298 = [$data[298][2], $data[298][3], $data[298][4], $data[298][5], $data[298][6]]; $Lvalue_298 = [$data[ 298][7], $data[298][8], $data[298][9]];
$Kvalue_299 = [$data[299][2], $data[299][3], $data[299][4], $data[299][5], $data[299][6]]; $Lvalue_299 = [$data[ 299][7], $data[299][8], $data[299][9]];
$Kvalue_300 = [$data[300][2], $data[300][3], $data[300][4], $data[300][5], $data[300][6]]; $Lvalue_300 = [$data[ 300][7], $data[300][8], $data[300][9]];
$Kvalue_301 = [$data[301][2], $data[301][3], $data[301][4], $data[301][5], $data[301][6]]; $Lvalue_301 = [$data[ 301][7], $data[301][8], $data[301][9]];
$Kvalue_302 = [$data[302][2], $data[302][3], $data[302][4], $data[302][5], $data[302][6]]; $Lvalue_302 = [$data[ 302][7], $data[302][8], $data[302][9]];
$Kvalue_303 = [$data[303][2], $data[303][3], $data[303][4], $data[303][5], $data[303][6]]; $Lvalue_303 = [$data[ 303][7], $data[303][8], $data[303][9]];
$Kvalue_304 = [$data[304][2], $data[304][3], $data[304][4], $data[304][5], $data[304][6]]; $Lvalue_304 = [$data[ 304][7], $data[304][8], $data[304][9]];
$Kvalue_305 = [$data[305][2], $data[305][3], $data[305][4], $data[305][5], $data[305][6]]; $Lvalue_305 = [$data[ 305][7], $data[305][8], $data[305][9]];
$Kvalue_306 = [$data[306][2], $data[306][3], $data[306][4], $data[306][5], $data[306][6]]; $Lvalue_306 = [$data[ 306][7], $data[306][8], $data[306][9]];
$Kvalue_307 = [$data[307][2], $data[307][3], $data[307][4], $data[307][5], $data[307][6]]; $Lvalue_307 = [$data[ 307][7], $data[307][8], $data[307][9]];
$Kvalue_308 = [$data[308][2], $data[308][3], $data[308][4], $data[308][5], $data[308][6]]; $Lvalue_308 = [$data[ 308][7], $data[308][8], $data[308][9]];
$Kvalue_309 = [$data[309][2], $data[309][3], $data[309][4], $data[309][5], $data[309][6]]; $Lvalue_309 = [$data[ 309][7], $data[309][8], $data[309][9]];
$Kvalue_310 = [$data[310][2], $data[310][3], $data[310][4], $data[310][5], $data[310][6]]; $Lvalue_310 = [$data[ 310][7], $data[310][8], $data[310][9]];
$Kvalue_311 = [$data[311][2], $data[311][3], $data[311][4], $data[311][5], $data[311][6]]; $Lvalue_311 = [$data[ 311][7], $data[311][8], $data[311][9]];
$Kvalue_312 = [$data[312][2], $data[312][3], $data[312][4], $data[312][5], $data[312][6]]; $Lvalue_312 = [$data[ 312][7], $data[312][8], $data[312][9]];
$Kvalue_313 = [$data[313][2], $data[313][3], $data[313][4], $data[313][5], $data[313][6]]; $Lvalue_313 = [$data[ 313][7], $data[313][8], $data[313][9]];
$Kvalue_314 = [$data[314][2], $data[314][3], $data[314][4], $data[314][5], $data[314][6]]; $Lvalue_314 = [$data[ 314][7], $data[314][8], $data[314][9]];
$Kvalue_315 = [$data[315][2], $data[315][3], $data[315][4], $data[315][5], $data[315][6]]; $Lvalue_315 = [$data[ 315][7], $data[315][8], $data[315][9]];
$Kvalue_316 = [$data[316][2], $data[316][3], $data[316][4], $data[316][5], $data[316][6]]; $Lvalue_316 = [$data[ 316][7], $data[316][8], $data[316][9]];
$Kvalue_317 = [$data[317][2], $data[317][3], $data[317][4], $data[317][5], $data[317][6]]; $Lvalue_317 = [$data[ 317][7], $data[317][8], $data[317][9]];
$Kvalue_318 = [$data[318][2], $data[318][3], $data[318][4], $data[318][5], $data[318][6]]; $Lvalue_318 = [$data[ 318][7], $data[318][8], $data[318][9]];
$Kvalue_319 = [$data[319][2], $data[319][3], $data[319][4], $data[319][5], $data[319][6]]; $Lvalue_319 = [$data[ 319][7], $data[319][8], $data[319][9]];
$Kvalue_320 = [$data[320][2], $data[320][3], $data[320][4], $data[320][5], $data[320][6]]; $Lvalue_320 = [$data[ 320][7], $data[320][8], $data[320][9]];
$Kvalue_321 = [$data[321][2], $data[321][3], $data[321][4], $data[321][5], $data[321][6]]; $Lvalue_321 = [$data[ 321][7], $data[321][8], $data[321][9]];
$Kvalue_322 = [$data[322][2], $data[322][3], $data[322][4], $data[322][5], $data[322][6]]; $Lvalue_322 = [$data[ 322][7], $data[322][8], $data[322][9]];
$Kvalue_323 = [$data[323][2], $data[323][3], $data[323][4], $data[323][5], $data[323][6]]; $Lvalue_323 = [$data[ 323][7], $data[323][8], $data[323][9]];
$Kvalue_324 = [$data[324][2], $data[324][3], $data[324][4], $data[324][5], $data[324][6]]; $Lvalue_324 = [$data[ 324][7], $data[324][8], $data[324][9]];
$Kvalue_325 = [$data[325][2], $data[325][3], $data[325][4], $data[325][5], $data[325][6]]; $Lvalue_325 = [$data[ 325][7], $data[325][8], $data[325][9]];
$Kvalue_326 = [$data[326][2], $data[326][3], $data[326][4], $data[326][5], $data[326][6]]; $Lvalue_326 = [$data[ 326][7], $data[326][8], $data[326][9]];
$Kvalue_327 = [$data[327][2], $data[327][3], $data[327][4], $data[327][5], $data[327][6]]; $Lvalue_327 = [$data[ 327][7], $data[327][8], $data[327][9]];
$Kvalue_328 = [$data[328][2], $data[328][3], $data[328][4], $data[328][5], $data[328][6]]; $Lvalue_328 = [$data[ 328][7], $data[328][8], $data[328][9]];
$Kvalue_329 = [$data[329][2], $data[329][3], $data[329][4], $data[329][5], $data[329][6]]; $Lvalue_329 = [$data[ 329][7], $data[329][8], $data[329][9]];
$Kvalue_330 = [$data[330][2], $data[330][3], $data[330][4], $data[330][5], $data[330][6]]; $Lvalue_330 = [$data[ 330][7], $data[330][8], $data[330][9]];
$Kvalue_331 = [$data[331][2], $data[331][3], $data[331][4], $data[331][5], $data[331][6]]; $Lvalue_331 = [$data[ 331][7], $data[331][8], $data[331][9]];
$Kvalue_332 = [$data[332][2], $data[332][3], $data[332][4], $data[332][5], $data[332][6]]; $Lvalue_332 = [$data[ 332][7], $data[332][8], $data[332][9]];
$Kvalue_333 = [$data[333][2], $data[333][3], $data[333][4], $data[333][5], $data[333][6]]; $Lvalue_333 = [$data[ 333][7], $data[333][8], $data[333][9]];
$Kvalue_334 = [$data[334][2], $data[334][3], $data[334][4], $data[334][5], $data[334][6]]; $Lvalue_334 = [$data[ 334][7], $data[334][8], $data[334][9]];
$Kvalue_335 = [$data[335][2], $data[335][3], $data[335][4], $data[335][5], $data[335][6]]; $Lvalue_335 = [$data[ 335][7], $data[335][8], $data[335][9]];
$Kvalue_336 = [$data[336][2], $data[336][3], $data[336][4], $data[336][5], $data[336][6]]; $Lvalue_336 = [$data[ 336][7], $data[336][8], $data[336][9]];
$Kvalue_337 = [$data[337][2], $data[337][3], $data[337][4], $data[337][5], $data[337][6]]; $Lvalue_337 = [$data[ 337][7], $data[337][8], $data[337][9]];
$Kvalue_338 = [$data[338][2], $data[338][3], $data[338][4], $data[338][5], $data[338][6]]; $Lvalue_338 = [$data[ 338][7], $data[338][8], $data[338][9]];
$Kvalue_339 = [$data[339][2], $data[339][3], $data[339][4], $data[339][5], $data[339][6]]; $Lvalue_339 = [$data[ 339][7], $data[339][8], $data[339][9]];
$Kvalue_340 = [$data[340][2], $data[340][3], $data[340][4], $data[340][5], $data[340][6]]; $Lvalue_340 = [$data[ 340][7], $data[340][8], $data[340][9]];
$Kvalue_341 = [$data[341][2], $data[341][3], $data[341][4], $data[341][5], $data[341][6]]; $Lvalue_341 = [$data[ 341][7], $data[341][8], $data[341][9]];
$Kvalue_342 = [$data[342][2], $data[342][3], $data[342][4], $data[342][5], $data[342][6]]; $Lvalue_342 = [$data[ 342][7], $data[342][8], $data[342][9]];
$Kvalue_343 = [$data[343][2], $data[343][3], $data[343][4], $data[343][5], $data[343][6]]; $Lvalue_343 = [$data[ 343][7], $data[343][8], $data[343][9]];
$Kvalue_344 = [$data[344][2], $data[344][3], $data[344][4], $data[344][5], $data[344][6]]; $Lvalue_344 = [$data[ 344][7], $data[344][8], $data[344][9]];
$Kvalue_345 = [$data[345][2], $data[345][3], $data[345][4], $data[345][5], $data[345][6]]; $Lvalue_345 = [$data[ 345][7], $data[345][8], $data[345][9]];
$Kvalue_346 = [$data[346][2], $data[346][3], $data[346][4], $data[346][5], $data[346][6]]; $Lvalue_346 = [$data[ 346][7], $data[346][8], $data[346][9]];
$Kvalue_347 = [$data[347][2], $data[347][3], $data[347][4], $data[347][5], $data[347][6]]; $Lvalue_347 = [$data[ 347][7], $data[347][8], $data[347][9]];
$Kvalue_348 = [$data[348][2], $data[348][3], $data[348][4], $data[348][5], $data[348][6]]; $Lvalue_348 = [$data[ 348][7], $data[348][8], $data[348][9]];
$Kvalue_349 = [$data[349][2], $data[349][3], $data[349][4], $data[349][5], $data[349][6]]; $Lvalue_349 = [$data[ 349][7], $data[349][8], $data[349][9]];
$Kvalue_350 = [$data[350][2], $data[350][3], $data[350][4], $data[350][5], $data[350][6]]; $Lvalue_350 = [$data[ 350][7], $data[350][8], $data[350][9]];
$Kvalue_351 = [$data[351][2], $data[351][3], $data[351][4], $data[351][5], $data[351][6]]; $Lvalue_351 = [$data[ 351][7], $data[351][8], $data[351][9]];
$Kvalue_352 = [$data[352][2], $data[352][3], $data[352][4], $data[352][5], $data[352][6]]; $Lvalue_352 = [$data[ 352][7], $data[352][8], $data[352][9]];
$Kvalue_353 = [$data[353][2], $data[353][3], $data[353][4], $data[353][5], $data[353][6]]; $Lvalue_353 = [$data[ 353][7], $data[353][8], $data[353][9]];
$Kvalue_354 = [$data[354][2], $data[354][3], $data[354][4], $data[354][5], $data[354][6]]; $Lvalue_354 = [$data[ 354][7], $data[354][8], $data[354][9]];
$Kvalue_355 = [$data[355][2], $data[355][3], $data[355][4], $data[355][5], $data[355][6]]; $Lvalue_355 = [$data[ 355][7], $data[355][8], $data[355][9]];
$Kvalue_356 = [$data[356][2], $data[356][3], $data[356][4], $data[356][5], $data[356][6]]; $Lvalue_356 = [$data[ 356][7], $data[356][8], $data[356][9]];
$Kvalue_357 = [$data[357][2], $data[357][3], $data[357][4], $data[357][5], $data[357][6]]; $Lvalue_357 = [$data[ 357][7], $data[357][8], $data[357][9]];
$Kvalue_358 = [$data[358][2], $data[358][3], $data[358][4], $data[358][5], $data[358][6]]; $Lvalue_358 = [$data[ 358][7], $data[358][8], $data[358][9]];
$Kvalue_359 = [$data[359][2], $data[359][3], $data[359][4], $data[359][5], $data[359][6]]; $Lvalue_359 = [$data[ 359][7], $data[359][8], $data[359][9]];
$Kvalue_360 = [$data[360][2], $data[360][3], $data[360][4], $data[360][5], $data[360][6]]; $Lvalue_360 = [$data[ 360][7], $data[360][8], $data[360][9]];
$Kvalue_361 = [$data[361][2], $data[361][3], $data[361][4], $data[361][5], $data[361][6]]; $Lvalue_361 = [$data[ 361][7], $data[361][8], $data[361][9]];
$Kvalue_362 = [$data[362][2], $data[362][3], $data[362][4], $data[362][5], $data[362][6]]; $Lvalue_362 = [$data[ 362][7], $data[362][8], $data[362][9]];
$Kvalue_363 = [$data[363][2], $data[363][3], $data[363][4], $data[363][5], $data[363][6]]; $Lvalue_363 = [$data[ 363][7], $data[363][8], $data[363][9]];
$Kvalue_364 = [$data[364][2], $data[364][3], $data[364][4], $data[364][5], $data[364][6]]; $Lvalue_364 = [$data[ 364][7], $data[364][8], $data[364][9]];
$Kvalue_365 = [$data[365][2], $data[365][3], $data[365][4], $data[365][5], $data[365][6]]; $Lvalue_365 = [$data[ 365][7], $data[365][8], $data[365][9]];
$Kvalue_366 = [$data[366][2], $data[366][3], $data[366][4], $data[366][5], $data[366][6]]; $Lvalue_366 = [$data[ 366][7], $data[366][8], $data[366][9]];
$Kvalue_367 = [$data[367][2], $data[367][3], $data[367][4], $data[367][5], $data[367][6]]; $Lvalue_367 = [$data[ 367][7], $data[367][8], $data[367][9]];
$Kvalue_368 = [$data[368][2], $data[368][3], $data[368][4], $data[368][5], $data[368][6]]; $Lvalue_368 = [$data[ 368][7], $data[368][8], $data[368][9]];
$Kvalue_369 = [$data[369][2], $data[369][3], $data[369][4], $data[369][5], $data[369][6]]; $Lvalue_369 = [$data[ 369][7], $data[369][8], $data[369][9]];
$Kvalue_370 = [$data[370][2], $data[370][3], $data[370][4], $data[370][5], $data[370][6]]; $Lvalue_370 = [$data[ 370][7], $data[370][8], $data[370][9]];
$Kvalue_371 = [$data[371][2], $data[371][3], $data[371][4], $data[371][5], $data[371][6]]; $Lvalue_371 = [$data[ 371][7], $data[371][8], $data[371][9]];
$Kvalue_372 = [$data[372][2], $data[372][3], $data[372][4], $data[372][5], $data[372][6]]; $Lvalue_372 = [$data[ 372][7], $data[372][8], $data[372][9]];
$Kvalue_373 = [$data[373][2], $data[373][3], $data[373][4], $data[373][5], $data[373][6]]; $Lvalue_373 = [$data[ 373][7], $data[373][8], $data[373][9]];
$Kvalue_374 = [$data[374][2], $data[374][3], $data[374][4], $data[374][5], $data[374][6]]; $Lvalue_374 = [$data[ 374][7], $data[374][8], $data[374][9]];
$Kvalue_375 = [$data[375][2], $data[375][3], $data[375][4], $data[375][5], $data[375][6]]; $Lvalue_375 = [$data[ 375][7], $data[375][8], $data[375][9]];
$Kvalue_376 = [$data[376][2], $data[376][3], $data[376][4], $data[376][5], $data[376][6]]; $Lvalue_376 = [$data[ 376][7], $data[376][8], $data[376][9]];
$Kvalue_377 = [$data[377][2], $data[377][3], $data[377][4], $data[377][5], $data[377][6]]; $Lvalue_377 = [$data[ 377][7], $data[377][8], $data[377][9]];
$Kvalue_378 = [$data[378][2], $data[378][3], $data[378][4], $data[378][5], $data[378][6]]; $Lvalue_378 = [$data[ 378][7], $data[378][8], $data[378][9]];
$Kvalue_379 = [$data[379][2], $data[379][3], $data[379][4], $data[379][5], $data[379][6]]; $Lvalue_379 = [$data[ 379][7], $data[379][8], $data[379][9]];
$Kvalue_380 = [$data[380][2], $data[380][3], $data[380][4], $data[380][5], $data[380][6]]; $Lvalue_380 = [$data[ 380][7], $data[380][8], $data[380][9]];
$Kvalue_381 = [$data[381][2], $data[381][3], $data[381][4], $data[381][5], $data[381][6]]; $Lvalue_381 = [$data[ 381][7], $data[381][8], $data[381][9]];
$Kvalue_382 = [$data[382][2], $data[382][3], $data[382][4], $data[382][5], $data[382][6]]; $Lvalue_382 = [$data[ 382][7], $data[382][8], $data[382][9]];
$Kvalue_383 = [$data[383][2], $data[383][3], $data[383][4], $data[383][5], $data[383][6]]; $Lvalue_383 = [$data[ 383][7], $data[383][8], $data[383][9]];
$Kvalue_384 = [$data[384][2], $data[384][3], $data[384][4], $data[384][5], $data[384][6]]; $Lvalue_384 = [$data[ 384][7], $data[384][8], $data[384][9]];
$Kvalue_385 = [$data[385][2], $data[385][3], $data[385][4], $data[385][5], $data[385][6]]; $Lvalue_385 = [$data[ 385][7], $data[385][8], $data[385][9]];
$Kvalue_386 = [$data[386][2], $data[386][3], $data[386][4], $data[386][5], $data[386][6]]; $Lvalue_386 = [$data[ 386][7], $data[386][8], $data[386][9]];
$Kvalue_387 = [$data[387][2], $data[387][3], $data[387][4], $data[387][5], $data[387][6]]; $Lvalue_387 = [$data[ 387][7], $data[387][8], $data[387][9]];
$Kvalue_388 = [$data[388][2], $data[388][3], $data[388][4], $data[388][5], $data[388][6]]; $Lvalue_388 = [$data[ 388][7], $data[388][8], $data[388][9]];
$Kvalue_389 = [$data[389][2], $data[389][3], $data[389][4], $data[389][5], $data[389][6]]; $Lvalue_389 = [$data[ 389][7], $data[389][8], $data[389][9]];
$Kvalue_390 = [$data[390][2], $data[390][3], $data[390][4], $data[390][5], $data[390][6]]; $Lvalue_390 = [$data[ 390][7], $data[390][8], $data[390][9]];
$Kvalue_391 = [$data[391][2], $data[391][3], $data[391][4], $data[391][5], $data[391][6]]; $Lvalue_391 = [$data[ 391][7], $data[391][8], $data[391][9]];
$Kvalue_392 = [$data[392][2], $data[392][3], $data[392][4], $data[392][5], $data[392][6]]; $Lvalue_392 = [$data[ 392][7], $data[392][8], $data[392][9]];
$Kvalue_393 = [$data[393][2], $data[393][3], $data[393][4], $data[393][5], $data[393][6]]; $Lvalue_393 = [$data[ 393][7], $data[393][8], $data[393][9]];
$Kvalue_394 = [$data[394][2], $data[394][3], $data[394][4], $data[394][5], $data[394][6]]; $Lvalue_394 = [$data[ 394][7], $data[394][8], $data[394][9]];
$Kvalue_395 = [$data[395][2], $data[395][3], $data[395][4], $data[395][5], $data[395][6]]; $Lvalue_395 = [$data[ 395][7], $data[395][8], $data[395][9]];
$Kvalue_396 = [$data[396][2], $data[396][3], $data[396][4], $data[396][5], $data[396][6]]; $Lvalue_396 = [$data[ 396][7], $data[396][8], $data[396][9]];
$Kvalue_397 = [$data[397][2], $data[397][3], $data[397][4], $data[397][5], $data[397][6]]; $Lvalue_397 = [$data[ 397][7], $data[397][8], $data[397][9]];
$Kvalue_398 = [$data[398][2], $data[398][3], $data[398][4], $data[398][5], $data[398][6]]; $Lvalue_398 = [$data[ 398][7], $data[398][8], $data[398][9]];
$Kvalue_399 = [$data[399][2], $data[399][3], $data[399][4], $data[399][5], $data[399][6]]; $Lvalue_399 = [$data[ 399][7], $data[399][8], $data[399][9]];
$Kvalue_400 = [$data[400][2], $data[400][3], $data[400][4], $data[400][5], $data[400][6]]; $Lvalue_400 = [$data[ 400][7], $data[400][8], $data[400][9]];
$Kvalue_401 = [$data[401][2], $data[401][3], $data[401][4], $data[401][5], $data[401][6]]; $Lvalue_401 = [$data[ 401][7], $data[401][8], $data[401][9]];
$Kvalue_402 = [$data[402][2], $data[402][3], $data[402][4], $data[402][5], $data[402][6]]; $Lvalue_402 = [$data[ 402][7], $data[402][8], $data[402][9]];
$Kvalue_403 = [$data[403][2], $data[403][3], $data[403][4], $data[403][5], $data[403][6]]; $Lvalue_403 = [$data[ 403][7], $data[403][8], $data[403][9]];
$Kvalue_404 = [$data[404][2], $data[404][3], $data[404][4], $data[404][5], $data[404][6]]; $Lvalue_404 = [$data[ 404][7], $data[404][8], $data[404][9]];
$Kvalue_405 = [$data[405][2], $data[405][3], $data[405][4], $data[405][5], $data[405][6]]; $Lvalue_405 = [$data[ 405][7], $data[405][8], $data[405][9]];
$Kvalue_406 = [$data[406][2], $data[406][3], $data[406][4], $data[406][5], $data[406][6]]; $Lvalue_406 = [$data[ 406][7], $data[406][8], $data[406][9]];
$Kvalue_407 = [$data[407][2], $data[407][3], $data[407][4], $data[407][5], $data[407][6]]; $Lvalue_407 = [$data[ 407][7], $data[407][8], $data[407][9]];
$Kvalue_408 = [$data[408][2], $data[408][3], $data[408][4], $data[408][5], $data[408][6]]; $Lvalue_408 = [$data[ 408][7], $data[408][8], $data[408][9]];
$Kvalue_409 = [$data[409][2], $data[409][3], $data[409][4], $data[409][5], $data[409][6]]; $Lvalue_409 = [$data[ 409][7], $data[409][8], $data[409][9]];
$Kvalue_410 = [$data[410][2], $data[410][3], $data[410][4], $data[410][5], $data[410][6]]; $Lvalue_410 = [$data[ 410][7], $data[410][8], $data[410][9]];
$Kvalue_411 = [$data[411][2], $data[411][3], $data[411][4], $data[411][5], $data[411][6]]; $Lvalue_411 = [$data[ 411][7], $data[411][8], $data[411][9]];
$Kvalue_412 = [$data[412][2], $data[412][3], $data[412][4], $data[412][5], $data[412][6]]; $Lvalue_412 = [$data[ 412][7], $data[412][8], $data[412][9]];
$Kvalue_413 = [$data[413][2], $data[413][3], $data[413][4], $data[413][5], $data[413][6]]; $Lvalue_413 = [$data[ 413][7], $data[413][8], $data[413][9]];
$Kvalue_414 = [$data[414][2], $data[414][3], $data[414][4], $data[414][5], $data[414][6]]; $Lvalue_414 = [$data[ 414][7], $data[414][8], $data[414][9]];
$Kvalue_415 = [$data[415][2], $data[415][3], $data[415][4], $data[415][5], $data[415][6]]; $Lvalue_415 = [$data[ 415][7], $data[415][8], $data[415][9]];
$Kvalue_416 = [$data[416][2], $data[416][3], $data[416][4], $data[416][5], $data[416][6]]; $Lvalue_416 = [$data[ 416][7], $data[416][8], $data[416][9]];
$Kvalue_417 = [$data[417][2], $data[417][3], $data[417][4], $data[417][5], $data[417][6]]; $Lvalue_417 = [$data[ 417][7], $data[417][8], $data[417][9]];
$Kvalue_418 = [$data[418][2], $data[418][3], $data[418][4], $data[418][5], $data[418][6]]; $Lvalue_418 = [$data[ 418][7], $data[418][8], $data[418][9]];
$Kvalue_419 = [$data[419][2], $data[419][3], $data[419][4], $data[419][5], $data[419][6]]; $Lvalue_419 = [$data[ 419][7], $data[419][8], $data[419][9]];
$Kvalue_420 = [$data[420][2], $data[420][3], $data[420][4], $data[420][5], $data[420][6]]; $Lvalue_420 = [$data[ 420][7], $data[420][8], $data[420][9]];
$Kvalue_421 = [$data[421][2], $data[421][3], $data[421][4], $data[421][5], $data[421][6]]; $Lvalue_421 = [$data[ 421][7], $data[421][8], $data[421][9]];
$Kvalue_422 = [$data[422][2], $data[422][3], $data[422][4], $data[422][5], $data[422][6]]; $Lvalue_422 = [$data[ 422][7], $data[422][8], $data[422][9]];
$Kvalue_423 = [$data[423][2], $data[423][3], $data[423][4], $data[423][5], $data[423][6]]; $Lvalue_423 = [$data[ 423][7], $data[423][8], $data[423][9]];
$Kvalue_424 = [$data[424][2], $data[424][3], $data[424][4], $data[424][5], $data[424][6]]; $Lvalue_424 = [$data[ 424][7], $data[424][8], $data[424][9]];
$Kvalue_425 = [$data[425][2], $data[425][3], $data[425][4], $data[425][5], $data[425][6]]; $Lvalue_425 = [$data[ 425][7], $data[425][8], $data[425][9]];
$Kvalue_426 = [$data[426][2], $data[426][3], $data[426][4], $data[426][5], $data[426][6]]; $Lvalue_426 = [$data[ 426][7], $data[426][8], $data[426][9]];
$Kvalue_427 = [$data[427][2], $data[427][3], $data[427][4], $data[427][5], $data[427][6]]; $Lvalue_427 = [$data[ 427][7], $data[427][8], $data[427][9]];
$Kvalue_428 = [$data[428][2], $data[428][3], $data[428][4], $data[428][5], $data[428][6]]; $Lvalue_428 = [$data[ 428][7], $data[428][8], $data[428][9]];
$Kvalue_429 = [$data[429][2], $data[429][3], $data[429][4], $data[429][5], $data[429][6]]; $Lvalue_429 = [$data[ 429][7], $data[429][8], $data[429][9]];
$Kvalue_430 = [$data[430][2], $data[430][3], $data[430][4], $data[430][5], $data[430][6]]; $Lvalue_430 = [$data[ 430][7], $data[430][8], $data[430][9]];
$Kvalue_431 = [$data[431][2], $data[431][3], $data[431][4], $data[431][5], $data[431][6]]; $Lvalue_431 = [$data[ 431][7], $data[431][8], $data[431][9]];
$Kvalue_432 = [$data[432][2], $data[432][3], $data[432][4], $data[432][5], $data[432][6]]; $Lvalue_432 = [$data[ 432][7], $data[432][8], $data[432][9]];
$Kvalue_433 = [$data[433][2], $data[433][3], $data[433][4], $data[433][5], $data[433][6]]; $Lvalue_433 = [$data[ 433][7], $data[433][8], $data[433][9]];
$Kvalue_434 = [$data[434][2], $data[434][3], $data[434][4], $data[434][5], $data[434][6]]; $Lvalue_434 = [$data[ 434][7], $data[434][8], $data[434][9]];
$Kvalue_435 = [$data[435][2], $data[435][3], $data[435][4], $data[435][5], $data[435][6]]; $Lvalue_435 = [$data[ 435][7], $data[435][8], $data[435][9]];
$Kvalue_436 = [$data[436][2], $data[436][3], $data[436][4], $data[436][5], $data[436][6]]; $Lvalue_436 = [$data[ 436][7], $data[436][8], $data[436][9]];
$Kvalue_437 = [$data[437][2], $data[437][3], $data[437][4], $data[437][5], $data[437][6]]; $Lvalue_437 = [$data[ 437][7], $data[437][8], $data[437][9]];
$Kvalue_438 = [$data[438][2], $data[438][3], $data[438][4], $data[438][5], $data[438][6]]; $Lvalue_438 = [$data[ 438][7], $data[438][8], $data[438][9]];
$Kvalue_439 = [$data[439][2], $data[439][3], $data[439][4], $data[439][5], $data[439][6]]; $Lvalue_439 = [$data[ 439][7], $data[439][8], $data[439][9]];
$Kvalue_440 = [$data[440][2], $data[440][3], $data[440][4], $data[440][5], $data[440][6]]; $Lvalue_440 = [$data[ 440][7], $data[440][8], $data[440][9]];
$Kvalue_441 = [$data[441][2], $data[441][3], $data[441][4], $data[441][5], $data[441][6]]; $Lvalue_441 = [$data[ 441][7], $data[441][8], $data[441][9]];
$Kvalue_442 = [$data[442][2], $data[442][3], $data[442][4], $data[442][5], $data[442][6]]; $Lvalue_442 = [$data[ 442][7], $data[442][8], $data[442][9]];
$Kvalue_443 = [$data[443][2], $data[443][3], $data[443][4], $data[443][5], $data[443][6]]; $Lvalue_443 = [$data[ 443][7], $data[443][8], $data[443][9]];
$Kvalue_444 = [$data[444][2], $data[444][3], $data[444][4], $data[444][5], $data[444][6]]; $Lvalue_444 = [$data[ 444][7], $data[444][8], $data[444][9]];
$Kvalue_445 = [$data[445][2], $data[445][3], $data[445][4], $data[445][5], $data[445][6]]; $Lvalue_445 = [$data[ 445][7], $data[445][8], $data[445][9]];
$Kvalue_446 = [$data[446][2], $data[446][3], $data[446][4], $data[446][5], $data[446][6]]; $Lvalue_446 = [$data[ 446][7], $data[446][8], $data[446][9]];
$Kvalue_447 = [$data[447][2], $data[447][3], $data[447][4], $data[447][5], $data[447][6]]; $Lvalue_447 = [$data[ 447][7], $data[447][8], $data[447][9]];
$Kvalue_448 = [$data[448][2], $data[448][3], $data[448][4], $data[448][5], $data[448][6]]; $Lvalue_448 = [$data[ 448][7], $data[448][8], $data[448][9]];
$Kvalue_449 = [$data[449][2], $data[449][3], $data[449][4], $data[449][5], $data[449][6]]; $Lvalue_449 = [$data[ 449][7], $data[449][8], $data[449][9]];
$Kvalue_450 = [$data[450][2], $data[450][3], $data[450][4], $data[450][5], $data[450][6]]; $Lvalue_450 = [$data[ 450][7], $data[450][8], $data[450][9]];
$Kvalue_451 = [$data[451][2], $data[451][3], $data[451][4], $data[451][5], $data[451][6]]; $Lvalue_451 = [$data[ 451][7], $data[451][8], $data[451][9]];
$Kvalue_452 = [$data[452][2], $data[452][3], $data[452][4], $data[452][5], $data[452][6]]; $Lvalue_452 = [$data[ 452][7], $data[452][8], $data[452][9]];
$Kvalue_453 = [$data[453][2], $data[453][3], $data[453][4], $data[453][5], $data[453][6]]; $Lvalue_453 = [$data[ 453][7], $data[453][8], $data[453][9]];
$Kvalue_454 = [$data[454][2], $data[454][3], $data[454][4], $data[454][5], $data[454][6]]; $Lvalue_454 = [$data[ 454][7], $data[454][8], $data[454][9]];
$Kvalue_455 = [$data[455][2], $data[455][3], $data[455][4], $data[455][5], $data[455][6]]; $Lvalue_455 = [$data[ 455][7], $data[455][8], $data[455][9]];
$Kvalue_456 = [$data[456][2], $data[456][3], $data[456][4], $data[456][5], $data[456][6]]; $Lvalue_456 = [$data[ 456][7], $data[456][8], $data[456][9]];
$Kvalue_457 = [$data[457][2], $data[457][3], $data[457][4], $data[457][5], $data[457][6]]; $Lvalue_457 = [$data[ 457][7], $data[457][8], $data[457][9]];
$Kvalue_458 = [$data[458][2], $data[458][3], $data[458][4], $data[458][5], $data[458][6]]; $Lvalue_458 = [$data[ 458][7], $data[458][8], $data[458][9]];
$Kvalue_459 = [$data[459][2], $data[459][3], $data[459][4], $data[459][5], $data[459][6]]; $Lvalue_459 = [$data[ 459][7], $data[459][8], $data[459][9]];
$Kvalue_460 = [$data[460][2], $data[460][3], $data[460][4], $data[460][5], $data[460][6]]; $Lvalue_460 = [$data[ 460][7], $data[460][8], $data[460][9]];
$Kvalue_461 = [$data[461][2], $data[461][3], $data[461][4], $data[461][5], $data[461][6]]; $Lvalue_461 = [$data[ 461][7], $data[461][8], $data[461][9]];
$Kvalue_462 = [$data[462][2], $data[462][3], $data[462][4], $data[462][5], $data[462][6]]; $Lvalue_462 = [$data[ 462][7], $data[462][8], $data[462][9]];
$Kvalue_463 = [$data[463][2], $data[463][3], $data[463][4], $data[463][5], $data[463][6]]; $Lvalue_463 = [$data[ 463][7], $data[463][8], $data[463][9]];
$Kvalue_464 = [$data[464][2], $data[464][3], $data[464][4], $data[464][5], $data[464][6]]; $Lvalue_464 = [$data[ 464][7], $data[464][8], $data[464][9]];
$Kvalue_465 = [$data[465][2], $data[465][3], $data[465][4], $data[465][5], $data[465][6]]; $Lvalue_465 = [$data[ 465][7], $data[465][8], $data[465][9]];
$Kvalue_466 = [$data[466][2], $data[466][3], $data[466][4], $data[466][5], $data[466][6]]; $Lvalue_466 = [$data[ 466][7], $data[466][8], $data[466][9]];
$Kvalue_467 = [$data[467][2], $data[467][3], $data[467][4], $data[467][5], $data[467][6]]; $Lvalue_467 = [$data[ 467][7], $data[467][8], $data[467][9]];
$Kvalue_468 = [$data[468][2], $data[468][3], $data[468][4], $data[468][5], $data[468][6]]; $Lvalue_468 = [$data[ 468][7], $data[468][8], $data[468][9]];

$Kvalue_469 = [$data[469][2], $data[469][3], $data[469][4], $data[469][5], $data[469][6]]; $Lvalue_469 = [$data[ 469][7], $data[469][8], $data[469][9]];
$Kvalue_470 = [$data[470][2], $data[470][3], $data[470][4], $data[470][5], $data[470][6]]; $Lvalue_470 = [$data[ 470][7], $data[470][8], $data[470][9]];
$Kvalue_471 = [$data[471][2], $data[471][3], $data[471][4], $data[471][5], $data[471][6]]; $Lvalue_471 = [$data[ 471][7], $data[471][8], $data[471][9]];
$Kvalue_472 = [$data[472][2], $data[472][3], $data[472][4], $data[472][5], $data[472][6]]; $Lvalue_472 = [$data[ 472][7], $data[472][8], $data[472][9]];
$Kvalue_473 = [$data[473][2], $data[473][3], $data[473][4], $data[473][5], $data[473][6]]; $Lvalue_473 = [$data[ 473][7], $data[473][8], $data[473][9]];
$Kvalue_474 = [$data[474][2], $data[474][3], $data[474][4], $data[474][5], $data[474][6]]; $Lvalue_474 = [$data[ 474][7], $data[474][8], $data[474][9]];
$Kvalue_475 = [$data[475][2], $data[475][3], $data[475][4], $data[475][5], $data[475][6]]; $Lvalue_475 = [$data[ 475][7], $data[475][8], $data[475][9]];
$Kvalue_476 = [$data[476][2], $data[476][3], $data[476][4], $data[476][5], $data[476][6]]; $Lvalue_476 = [$data[ 476][7], $data[476][8], $data[476][9]];
$Kvalue_477 = [$data[477][2], $data[477][3], $data[477][4], $data[477][5], $data[477][6]]; $Lvalue_477 = [$data[ 477][7], $data[477][8], $data[477][9]];
$Kvalue_478 = [$data[478][2], $data[478][3], $data[478][4], $data[478][5], $data[478][6]]; $Lvalue_478 = [$data[ 478][7], $data[478][8], $data[478][9]];
$Kvalue_479 = [$data[479][2], $data[479][3], $data[479][4], $data[479][5], $data[479][6]]; $Lvalue_479 = [$data[ 479][7], $data[479][8], $data[479][9]];
$Kvalue_480 = [$data[480][2], $data[480][3], $data[480][4], $data[480][5], $data[480][6]]; $Lvalue_480 = [$data[ 480][7], $data[480][8], $data[480][9]];
$Kvalue_481 = [$data[481][2], $data[481][3], $data[481][4], $data[481][5], $data[481][6]]; $Lvalue_481 = [$data[ 481][7], $data[481][8], $data[481][9]];
$Kvalue_482 = [$data[482][2], $data[482][3], $data[482][4], $data[482][5], $data[482][6]]; $Lvalue_482 = [$data[ 482][7], $data[482][8], $data[482][9]];
$Kvalue_483 = [$data[483][2], $data[483][3], $data[483][4], $data[483][5], $data[483][6]]; $Lvalue_483 = [$data[ 483][7], $data[483][8], $data[483][9]];
$Kvalue_484 = [$data[484][2], $data[484][3], $data[484][4], $data[484][5], $data[484][6]]; $Lvalue_484 = [$data[ 484][7], $data[484][8], $data[484][9]];
$Kvalue_485 = [$data[485][2], $data[485][3], $data[485][4], $data[485][5], $data[485][6]]; $Lvalue_485 = [$data[ 485][7], $data[485][8], $data[485][9]];
$Kvalue_486 = [$data[486][2], $data[486][3], $data[486][4], $data[486][5], $data[486][6]]; $Lvalue_486 = [$data[ 486][7], $data[486][8], $data[486][9]];
$Kvalue_487 = [$data[487][2], $data[487][3], $data[487][4], $data[487][5], $data[487][6]]; $Lvalue_487 = [$data[ 487][7], $data[487][8], $data[487][9]];
 $Kvalue_488 = [$data[488][2], $data[488][3], $data[488][4], $data[488][5], $data[488][6]]; $Lvalue_488 = [$data[ 488][7], $data[488][8], $data[488][9]];
$Kvalue_489 = [$data[489][2], $data[489][3], $data[489][4], $data[489][5], $data[489][6]]; $Lvalue_489 = [$data[ 489][7], $data[489][8], $data[489][9]];
 $Kvalue_490 = [$data[490][2], $data[490][3], $data[490][4], $data[490][5], $data[490][6]]; $Lvalue_490 = [$data[ 490][7], $data[490][8], $data[490][9]];
 $Kvalue_491 = [$data[491][2], $data[491][3], $data[491][4], $data[491][5], $data[491][6]]; $Lvalue_491 = [$data[ 491][7], $data[491][8], $data[491][9]];
 $Kvalue_492 = [$data[492][2], $data[492][3], $data[492][4], $data[492][5], $data[492][6]]; $Lvalue_492 = [$data[ 492][7], $data[492][8], $data[492][9]];
 $Kvalue_493 = [$data[493][2], $data[493][3], $data[493][4], $data[493][5], $data[493][6]]; $Lvalue_493 = [$data[ 493][7], $data[493][8], $data[493][9]];
 $Kvalue_494 = [$data[494][2], $data[494][3], $data[494][4], $data[494][5], $data[494][6]]; $Lvalue_494 = [$data[ 494][7], $data[494][8], $data[494][9]];

 // $Kvalue_495 = [$data[495][2], $data[495][3], $data[495][4], $data[495][5], $data[495][6]]; $Lvalue_495 = [$data[ 495][7], $data[495][8], $data[495][9]];














           					$str = 
                               [[
                                     "Instance_Code" => 1,
                                     "Sec_Code"      => 1,
                                     "Ministry_Code" => 1,
                                     "Dept_Code"     => 2,
                                     "Project_Code"  => 10043,
                                     "Frequency_Id"  => 1,
                                     "atmpt"         => 0, 
                                     "ListKpidata"   => 
                                     [
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_1),
                                            "LValue"    => implode(', ' ,$Lvalue_1),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[2][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_2),
                                            "LValue"    => implode(', ' ,$Lvalue_2),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[3][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_3),
                                            "LValue"    => implode(', ' ,$Lvalue_3),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[4][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_4),
                                            "LValue"    => implode(', ' ,$Lvalue_4),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[5][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_5),
                                            "LValue"    => implode(', ' ,$Lvalue_5),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[6][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_6),
                                            "LValue"    => implode(', ' ,$Lvalue_6),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[7][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_7),
                                            "LValue"    => implode(', ' ,$Lvalue_7),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[8][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_8),
                                            "LValue"    => implode(', ' ,$Lvalue_8),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[9][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_9),
                                            "LValue"    => implode(', ' ,$Lvalue_9),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[10][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_10),
                                            "LValue"    => implode(', ' ,$Lvalue_10),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[11][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_11),
                                            "LValue"    => implode(', ' ,$Lvalue_11),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[12][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_12),
                                            "LValue"    => implode(', ' ,$Lvalue_12),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[13][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_13),
                                            "LValue"    => implode(', ' ,$Lvalue_13),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[14][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_14),
                                            "LValue"    => implode(', ' ,$Lvalue_14),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[15][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_15),
                                            "LValue"    => implode(', ' ,$Lvalue_15),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[16][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_16),
                                            "LValue"    => implode(', ' ,$Lvalue_16),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[17][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_17),
                                            "LValue"    => implode(', ' ,$Lvalue_17),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[18][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_18),
                                            "LValue"    => implode(', ' ,$Lvalue_18),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[19][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_19),
                                            "LValue"    => implode(', ' ,$Lvalue_19),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[20][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_20),
                                            "LValue"    => implode(', ' ,$Lvalue_20),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[21][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_21),
                                            "LValue"    => implode(', ' ,$Lvalue_21),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[22][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_22),
                                            "LValue"    => implode(', ' ,$Lvalue_22),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[23][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_23),
                                            "LValue"    => implode(', ' ,$Lvalue_23),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[24][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_24),
                                            "LValue"    => implode(', ' ,$Lvalue_24),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[25][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_25),
                                            "LValue"    => implode(', ' ,$Lvalue_25),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[26][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_26),
                                            "LValue"    => implode(', ' ,$Lvalue_26),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[27][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_27),
                                            "LValue"    => implode(', ' ,$Lvalue_27),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[28][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_28),
                                            "LValue"    => implode(', ' ,$Lvalue_28),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[29][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_29),
                                            "LValue"    => implode(', ' ,$Lvalue_29),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[30][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_30),
                                            "LValue"    => implode(', ' ,$Lvalue_30),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[31][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_31),
                                            "LValue"    => implode(', ' ,$Lvalue_31),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[32][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_32),
                                            "LValue"    => implode(', ' ,$Lvalue_32),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_33),
                                            "LValue"    => implode(', ' ,$Lvalue_33),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_34),
                                            "LValue"    => implode(', ' ,$Lvalue_34),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_35),
                                            "LValue"    => implode(', ' ,$Lvalue_35),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_36),
                                            "LValue"    => implode(', ' ,$Lvalue_36),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_37),
                                            "LValue"    => implode(', ' ,$Lvalue_37),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_38),
                                            "LValue"    => implode(', ' ,$Lvalue_38),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_39),
                                            "LValue"    => implode(', ' ,$Lvalue_39),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_40),
                                            "LValue"    => implode(', ' ,$Lvalue_40),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_41),
                                            "LValue"    => implode(', ' ,$Lvalue_41),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_42),
                                            "LValue"    => implode(', ' ,$Lvalue_42),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_43),
                                            "LValue"    => implode(', ' ,$Lvalue_43),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_44),
                                            "LValue"    => implode(', ' ,$Lvalue_44),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_45),
                                            "LValue"    => implode(', ' ,$Lvalue_45),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_46),
                                            "LValue"    => implode(', ' ,$Lvalue_46),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_47),
                                            "LValue"    => implode(', ' ,$Lvalue_47),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_48),
                                            "LValue"    => implode(', ' ,$Lvalue_48),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_49),
                                            "LValue"    => implode(', ' ,$Lvalue_49),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_50),
                                            "LValue"    => implode(', ' ,$Lvalue_50),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_51),
                                            "LValue"    => implode(', ' ,$Lvalue_51),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_52),
                                            "LValue"    => implode(', ' ,$Lvalue_52),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_53),
                                            "LValue"    => implode(', ' ,$Lvalue_53),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_54),
                                            "LValue"    => implode(', ' ,$Lvalue_54),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_55),
                                            "LValue"    => implode(', ' ,$Lvalue_55),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_56),
                                            "LValue"    => implode(', ' ,$Lvalue_56),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_57),
                                            "LValue"    => implode(', ' ,$Lvalue_57),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_58),
                                            "LValue"    => implode(', ' ,$Lvalue_58),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_59),
                                            "LValue"    => implode(', ' ,$Lvalue_59),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_60),
                                            "LValue"    => implode(', ' ,$Lvalue_60),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_61),
                                            "LValue"    => implode(', ' ,$Lvalue_61),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_62),
                                            "LValue"    => implode(', ' ,$Lvalue_62),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_63),
                                            "LValue"    => implode(', ' ,$Lvalue_63),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_64),
                                            "LValue"    => implode(', ' ,$Lvalue_64),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_65),
                                            "LValue"    => implode(', ' ,$Lvalue_65),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_66),
                                            "LValue"    => implode(', ' ,$Lvalue_66),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_67),
                                            "LValue"    => implode(', ' ,$Lvalue_67),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_68),
                                            "LValue"    => implode(', ' ,$Lvalue_68),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_69),
                                            "LValue"    => implode(', ' ,$Lvalue_69),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_70),
                                            "LValue"    => implode(', ' ,$Lvalue_70),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_71),
                                            "LValue"    => implode(', ' ,$Lvalue_71),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_72),
                                            "LValue"    => implode(', ' ,$Lvalue_72),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_73),
                                            "LValue"    => implode(', ' ,$Lvalue_73),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_74),
                                            "LValue"    => implode(', ' ,$Lvalue_74),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_75),
                                            "LValue"    => implode(', ' ,$Lvalue_75),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_76),
                                            "LValue"    => implode(', ' ,$Lvalue_76),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_77),
                                            "LValue"    => implode(', ' ,$Lvalue_77),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_78),
                                            "LValue"    => implode(', ' ,$Lvalue_78),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_79),
                                            "LValue"    => implode(', ' ,$Lvalue_79),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_80),
                                            "LValue"    => implode(', ' ,$Lvalue_80),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_81),
                                            "LValue"    => implode(', ' ,$Lvalue_81),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_82),
                                            "LValue"    => implode(', ' ,$Lvalue_82),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_83),
                                            "LValue"    => implode(', ' ,$Lvalue_83),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_84),
                                            "LValue"    => implode(', ' ,$Lvalue_84),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_85),
                                            "LValue"    => implode(', ' ,$Lvalue_85),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_86),
                                            "LValue"    => implode(', ' ,$Lvalue_86),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_87),
                                            "LValue"    => implode(', ' ,$Lvalue_87),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_88),
                                            "LValue"    => implode(', ' ,$Lvalue_88),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_89),
                                            "LValue"    => implode(', ' ,$Lvalue_89),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_90),
                                            "LValue"    => implode(', ' ,$Lvalue_90),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_91),
                                            "LValue"    => implode(', ' ,$Lvalue_91),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_92),
                                            "LValue"    => implode(', ' ,$Lvalue_92),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_93),
                                            "LValue"    => implode(', ' ,$Lvalue_93),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_94),
                                            "LValue"    => implode(', ' ,$Lvalue_94),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_95),
                                            "LValue"    => implode(', ' ,$Lvalue_95),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_96),
                                            "LValue"    => implode(', ' ,$Lvalue_96),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_97),
                                            "LValue"    => implode(', ' ,$Lvalue_97),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_98),
                                            "LValue"    => implode(', ' ,$Lvalue_98),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_99),
                                            "LValue"    => implode(', ' ,$Lvalue_99),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_100),
                                            "LValue"    => implode(', ' ,$Lvalue_100),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_101),
                                            "LValue"    => implode(', ' ,$Lvalue_101),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_102),
                                            "LValue"    => implode(', ' ,$Lvalue_102),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_103),
                                            "LValue"    => implode(', ' ,$Lvalue_103),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_104),
                                            "LValue"    => implode(', ' ,$Lvalue_104),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_105),
                                            "LValue"    => implode(', ' ,$Lvalue_105),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_106),
                                            "LValue"    => implode(', ' ,$Lvalue_106),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_107),
                                            "LValue"    => implode(', ' ,$Lvalue_107),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_108),
                                            "LValue"    => implode(', ' ,$Lvalue_108),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_109),
                                            "LValue"    => implode(', ' ,$Lvalue_109),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_110),
                                            "LValue"    => implode(', ' ,$Lvalue_110),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_111),
                                            "LValue"    => implode(', ' ,$Lvalue_111),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_112),
                                            "LValue"    => implode(', ' ,$Lvalue_112),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_113),
                                            "LValue"    => implode(', ' ,$Lvalue_113),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_114),
                                            "LValue"    => implode(', ' ,$Lvalue_114),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_115),
                                            "LValue"    => implode(', ' ,$Lvalue_115),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_116),
                                            "LValue"    => implode(', ' ,$Lvalue_116),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_117),
                                            "LValue"    => implode(', ' ,$Lvalue_117),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_118),
                                            "LValue"    => implode(', ' ,$Lvalue_118),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_119),
                                            "LValue"    => implode(', ' ,$Lvalue_119),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_120),
                                            "LValue"    => implode(', ' ,$Lvalue_120),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_121),
                                            "LValue"    => implode(', ' ,$Lvalue_121),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_122),
                                            "LValue"    => implode(', ' ,$Lvalue_122),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_123),
                                            "LValue"    => implode(', ' ,$Lvalue_123),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_124),
                                            "LValue"    => implode(', ' ,$Lvalue_124),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_125),
                                            "LValue"    => implode(', ' ,$Lvalue_125),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_126),
                                            "LValue"    => implode(', ' ,$Lvalue_126),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_127),
                                            "LValue"    => implode(', ' ,$Lvalue_127),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_128),
                                            "LValue"    => implode(', ' ,$Lvalue_128),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_129),
                                            "LValue"    => implode(', ' ,$Lvalue_129),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_130),
                                            "LValue"    => implode(', ' ,$Lvalue_130),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_131),
                                            "LValue"    => implode(', ' ,$Lvalue_131),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_132),
                                            "LValue"    => implode(', ' ,$Lvalue_132),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_133),
                                            "LValue"    => implode(', ' ,$Lvalue_133),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_134),
                                            "LValue"    => implode(', ' ,$Lvalue_134),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_135),
                                            "LValue"    => implode(', ' ,$Lvalue_135),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_136),
                                            "LValue"    => implode(', ' ,$Lvalue_136),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_137),
                                            "LValue"    => implode(', ' ,$Lvalue_137),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_138),
                                            "LValue"    => implode(', ' ,$Lvalue_138),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_139),
                                            "LValue"    => implode(', ' ,$Lvalue_139),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_140),
                                            "LValue"    => implode(', ' ,$Lvalue_140),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_141),
                                            "LValue"    => implode(', ' ,$Lvalue_141),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_142),
                                            "LValue"    => implode(', ' ,$Lvalue_142),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_143),
                                            "LValue"    => implode(', ' ,$Lvalue_143),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_144),
                                            "LValue"    => implode(', ' ,$Lvalue_144),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_145),
                                            "LValue"    => implode(', ' ,$Lvalue_145),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_146),
                                            "LValue"    => implode(', ' ,$Lvalue_146),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_147),
                                            "LValue"    => implode(', ' ,$Lvalue_147),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_148),
                                            "LValue"    => implode(', ' ,$Lvalue_148),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_149),
                                            "LValue"    => implode(', ' ,$Lvalue_149),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_150),
                                            "LValue"    => implode(', ' ,$Lvalue_150),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_151),
                                            "LValue"    => implode(', ' ,$Lvalue_151),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_152),
                                            "LValue"    => implode(', ' ,$Lvalue_152),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_153),
                                            "LValue"    => implode(', ' ,$Lvalue_153),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_154),
                                            "LValue"    => implode(', ' ,$Lvalue_154),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_155),
                                            "LValue"    => implode(', ' ,$Lvalue_155),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_156),
                                            "LValue"    => implode(', ' ,$Lvalue_156),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_157),
                                            "LValue"    => implode(', ' ,$Lvalue_157),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_158),
                                            "LValue"    => implode(', ' ,$Lvalue_158),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_159),
                                            "LValue"    => implode(', ' ,$Lvalue_159),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_160),
                                            "LValue"    => implode(', ' ,$Lvalue_160),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_161),
                                            "LValue"    => implode(', ' ,$Lvalue_161),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_162),
                                            "LValue"    => implode(', ' ,$Lvalue_162),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_163),
                                            "LValue"    => implode(', ' ,$Lvalue_163),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_164),
                                            "LValue"    => implode(', ' ,$Lvalue_164),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_165),
                                            "LValue"    => implode(', ' ,$Lvalue_165),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_166),
                                            "LValue"    => implode(', ' ,$Lvalue_166),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_167),
                                            "LValue"    => implode(', ' ,$Lvalue_167),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_168),
                                            "LValue"    => implode(', ' ,$Lvalue_168),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_169),
                                            "LValue"    => implode(', ' ,$Lvalue_169),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_170),
                                            "LValue"    => implode(', ' ,$Lvalue_170),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_171),
                                            "LValue"    => implode(', ' ,$Lvalue_171),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_172),
                                            "LValue"    => implode(', ' ,$Lvalue_172),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_173),
                                            "LValue"    => implode(', ' ,$Lvalue_173),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_174),
                                            "LValue"    => implode(', ' ,$Lvalue_174),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_175),
                                            "LValue"    => implode(', ' ,$Lvalue_175),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_176),
                                            "LValue"    => implode(', ' ,$Lvalue_176),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_177),
                                            "LValue"    => implode(', ' ,$Lvalue_177),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_178),
                                            "LValue"    => implode(', ' ,$Lvalue_178),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_179),
                                            "LValue"    => implode(', ' ,$Lvalue_179),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_180),
                                            "LValue"    => implode(', ' ,$Lvalue_180),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_181),
                                            "LValue"    => implode(', ' ,$Lvalue_181),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_182),
                                            "LValue"    => implode(', ' ,$Lvalue_182),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_183),
                                            "LValue"    => implode(', ' ,$Lvalue_183),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_184),
                                            "LValue"    => implode(', ' ,$Lvalue_184),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_185),
                                            "LValue"    => implode(', ' ,$Lvalue_185),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_186),
                                            "LValue"    => implode(', ' ,$Lvalue_186),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_187),
                                            "LValue"    => implode(', ' ,$Lvalue_187),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_188),
                                            "LValue"    => implode(', ' ,$Lvalue_188),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_189),
                                            "LValue"    => implode(', ' ,$Lvalue_189),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_190),
                                            "LValue"    => implode(', ' ,$Lvalue_190),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_191),
                                            "LValue"    => implode(', ' ,$Lvalue_191),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_192),
                                            "LValue"    => implode(', ' ,$Lvalue_192),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_193),
                                            "LValue"    => implode(', ' ,$Lvalue_193),
                                         ],
                                           [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_194),
                                            "LValue"    => implode(', ' ,$Lvalue_194),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_195),
                                            "LValue"    => implode(', ' ,$Lvalue_195),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_196),
                                            "LValue"    => implode(', ' ,$Lvalue_196),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_197),
                                            "LValue"    => implode(', ' ,$Lvalue_197),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_198),
                                            "LValue"    => implode(', ' ,$Lvalue_198),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_199),
                                            "LValue"    => implode(', ' ,$Lvalue_199),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_200),
                                            "LValue"    => implode(', ' ,$Lvalue_200),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_201),
                                            "LValue"    => implode(', ' ,$Lvalue_201),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_202),
                                            "LValue"    => implode(', ' ,$Lvalue_202),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_203),
                                            "LValue"    => implode(', ' ,$Lvalue_203),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_204),
                                            "LValue"    => implode(', ' ,$Lvalue_204),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_205),
                                            "LValue"    => implode(', ' ,$Lvalue_205),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_206),
                                            "LValue"    => implode(', ' ,$Lvalue_206),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_207),
                                            "LValue"    => implode(', ' ,$Lvalue_207),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_208),
                                            "LValue"    => implode(', ' ,$Lvalue_208),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_209),
                                            "LValue"    => implode(', ' ,$Lvalue_209),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_210),
                                            "LValue"    => implode(', ' ,$Lvalue_210),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_211),
                                            "LValue"    => implode(', ' ,$Lvalue_211),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_212),
                                            "LValue"    => implode(', ' ,$Lvalue_212),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_213),
                                            "LValue"    => implode(', ' ,$Lvalue_213),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_214),
                                            "LValue"    => implode(', ' ,$Lvalue_214),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_215),
                                            "LValue"    => implode(', ' ,$Lvalue_215),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_216),
                                            "LValue"    => implode(', ' ,$Lvalue_216),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_217),
                                            "LValue"    => implode(', ' ,$Lvalue_217),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_218),
                                            "LValue"    => implode(', ' ,$Lvalue_218),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_219),
                                            "LValue"    => implode(', ' ,$Lvalue_219),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_220),
                                            "LValue"    => implode(', ' ,$Lvalue_220),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_221),
                                            "LValue"    => implode(', ' ,$Lvalue_221),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_222),
                                            "LValue"    => implode(', ' ,$Lvalue_222),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_223),
                                            "LValue"    => implode(', ' ,$Lvalue_223),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_224),
                                            "LValue"    => implode(', ' ,$Lvalue_224),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_225),
                                            "LValue"    => implode(', ' ,$Lvalue_225),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_226),
                                            "LValue"    => implode(', ' ,$Lvalue_226),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_227),
                                            "LValue"    => implode(', ' ,$Lvalue_227),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_228),
                                            "LValue"    => implode(', ' ,$Lvalue_228),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_229),
                                            "LValue"    => implode(', ' ,$Lvalue_229),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_230),
                                            "LValue"    => implode(', ' ,$Lvalue_230),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_231),
                                            "LValue"    => implode(', ' ,$Lvalue_231),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_232),
                                            "LValue"    => implode(', ' ,$Lvalue_232),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_233),
                                            "LValue"    => implode(', ' ,$Lvalue_233),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_234),
                                            "LValue"    => implode(', ' ,$Lvalue_234),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_235),
                                            "LValue"    => implode(', ' ,$Lvalue_235),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_236),
                                            "LValue"    => implode(', ' ,$Lvalue_236),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_237),
                                            "LValue"    => implode(', ' ,$Lvalue_237),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_238),
                                            "LValue"    => implode(', ' ,$Lvalue_238),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_239),
                                            "LValue"    => implode(', ' ,$Lvalue_239),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_240),
                                            "LValue"    => implode(', ' ,$Lvalue_240),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_241),
                                            "LValue"    => implode(', ' ,$Lvalue_241),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_242),
                                            "LValue"    => implode(', ' ,$Lvalue_242),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_243),
                                            "LValue"    => implode(', ' ,$Lvalue_243),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_244),
                                            "LValue"    => implode(', ' ,$Lvalue_244),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_245),
                                            "LValue"    => implode(', ' ,$Lvalue_245),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_246),
                                            "LValue"    => implode(', ' ,$Lvalue_246),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_247),
                                            "LValue"    => implode(', ' ,$Lvalue_247),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_248),
                                            "LValue"    => implode(', ' ,$Lvalue_248),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_249),
                                            "LValue"    => implode(', ' ,$Lvalue_249),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_250),
                                            "LValue"    => implode(', ' ,$Lvalue_250),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_251),
                                            "LValue"    => implode(', ' ,$Lvalue_251),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_252),
                                            "LValue"    => implode(', ' ,$Lvalue_252),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_253),
                                            "LValue"    => implode(', ' ,$Lvalue_253),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_254),
                                            "LValue"    => implode(', ' ,$Lvalue_254),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_255),
                                            "LValue"    => implode(', ' ,$Lvalue_255),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_256),
                                            "LValue"    => implode(', ' ,$Lvalue_256),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_257),
                                            "LValue"    => implode(', ' ,$Lvalue_257),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_258),
                                            "LValue"    => implode(', ' ,$Lvalue_258),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_259),
                                            "LValue"    => implode(', ' ,$Lvalue_259),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_260),
                                            "LValue"    => implode(', ' ,$Lvalue_260),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_261),
                                            "LValue"    => implode(', ' ,$Lvalue_261),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_262),
                                            "LValue"    => implode(', ' ,$Lvalue_262),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_263),
                                            "LValue"    => implode(', ' ,$Lvalue_263),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_264),
                                            "LValue"    => implode(', ' ,$Lvalue_264),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_265),
                                            "LValue"    => implode(', ' ,$Lvalue_265),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_266),
                                            "LValue"    => implode(', ' ,$Lvalue_266),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_267),
                                            "LValue"    => implode(', ' ,$Lvalue_267),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_268),
                                            "LValue"    => implode(', ' ,$Lvalue_268),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_269),
                                            "LValue"    => implode(', ' ,$Lvalue_269),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_270),
                                            "LValue"    => implode(', ' ,$Lvalue_270),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_271),
                                            "LValue"    => implode(', ' ,$Lvalue_271),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_272),
                                            "LValue"    => implode(', ' ,$Lvalue_272),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_273),
                                            "LValue"    => implode(', ' ,$Lvalue_273),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_274),
                                            "LValue"    => implode(', ' ,$Lvalue_274),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_275),
                                            "LValue"    => implode(', ' ,$Lvalue_275),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_276),
                                            "LValue"    => implode(', ' ,$Lvalue_276),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_277),
                                            "LValue"    => implode(', ' ,$Lvalue_277),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_278),
                                            "LValue"    => implode(', ' ,$Lvalue_278),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_279),
                                            "LValue"    => implode(', ' ,$Lvalue_279),
                                         ],
                                        [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_280),
                                            "LValue"    => implode(', ' ,$Lvalue_280),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_281),
                                            "LValue"    => implode(', ' ,$Lvalue_281),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_282),
                                            "LValue"    => implode(', ' ,$Lvalue_282),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_283),
                                            "LValue"    => implode(', ' ,$Lvalue_283),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_284),
                                            "LValue"    => implode(', ' ,$Lvalue_284),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_285),
                                            "LValue"    => implode(', ' ,$Lvalue_285),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_286),
                                            "LValue"    => implode(', ' ,$Lvalue_286),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_287),
                                            "LValue"    => implode(', ' ,$Lvalue_287),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_288),
                                            "LValue"    => implode(', ' ,$Lvalue_288),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_289),
                                            "LValue"    => implode(', ' ,$Lvalue_289),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_290),
                                            "LValue"    => implode(', ' ,$Lvalue_290),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_291),
                                            "LValue"    => implode(', ' ,$Lvalue_291),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_292),
                                            "LValue"    => implode(', ' ,$Lvalue_292),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_293),
                                            "LValue"    => implode(', ' ,$Lvalue_293),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_294),
                                            "LValue"    => implode(', ' ,$Lvalue_294),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_295),
                                            "LValue"    => implode(', ' ,$Lvalue_295),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_296),
                                            "LValue"    => implode(', ' ,$Lvalue_296),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_297),
                                            "LValue"    => implode(', ' ,$Lvalue_297),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_298),
                                            "LValue"    => implode(', ' ,$Lvalue_298),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_299),
                                            "LValue"    => implode(', ' ,$Lvalue_299),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_300),
                                            "LValue"    => implode(', ' ,$Lvalue_300),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_301),
                                            "LValue"    => implode(', ' ,$Lvalue_301),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_302),
                                            "LValue"    => implode(', ' ,$Lvalue_302),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_303),
                                            "LValue"    => implode(', ' ,$Lvalue_303),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_304),
                                            "LValue"    => implode(', ' ,$Lvalue_304),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_305),
                                            "LValue"    => implode(', ' ,$Lvalue_305),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_306),
                                            "LValue"    => implode(', ' ,$Lvalue_306),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_307),
                                            "LValue"    => implode(', ' ,$Lvalue_307),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_308),
                                            "LValue"    => implode(', ' ,$Lvalue_308),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_309),
                                            "LValue"    => implode(', ' ,$Lvalue_309),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_310),
                                            "LValue"    => implode(', ' ,$Lvalue_310),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_311),
                                            "LValue"    => implode(', ' ,$Lvalue_311),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_312),
                                            "LValue"    => implode(', ' ,$Lvalue_312),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_313),
                                            "LValue"    => implode(', ' ,$Lvalue_313),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_314),
                                            "LValue"    => implode(', ' ,$Lvalue_314),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_315),
                                            "LValue"    => implode(', ' ,$Lvalue_315),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_316),
                                            "LValue"    => implode(', ' ,$Lvalue_316),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_317),
                                            "LValue"    => implode(', ' ,$Lvalue_317),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_318),
                                            "LValue"    => implode(', ' ,$Lvalue_318),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_319),
                                            "LValue"    => implode(', ' ,$Lvalue_319),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_320),
                                            "LValue"    => implode(', ' ,$Lvalue_320),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_321),
                                            "LValue"    => implode(', ' ,$Lvalue_321),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_322),
                                            "LValue"    => implode(', ' ,$Lvalue_322),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_323),
                                            "LValue"    => implode(', ' ,$Lvalue_323),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_324),
                                            "LValue"    => implode(', ' ,$Lvalue_324),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_325),
                                            "LValue"    => implode(', ' ,$Lvalue_325),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_326),
                                            "LValue"    => implode(', ' ,$Lvalue_326),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_327),
                                            "LValue"    => implode(', ' ,$Lvalue_327),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_328),
                                            "LValue"    => implode(', ' ,$Lvalue_328),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_329),
                                            "LValue"    => implode(', ' ,$Lvalue_329),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_330),
                                            "LValue"    => implode(', ' ,$Lvalue_330),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_331),
                                            "LValue"    => implode(', ' ,$Lvalue_331),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_332),
                                            "LValue"    => implode(', ' ,$Lvalue_332),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_333),
                                            "LValue"    => implode(', ' ,$Lvalue_333),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_334),
                                            "LValue"    => implode(', ' ,$Lvalue_334),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_335),
                                            "LValue"    => implode(', ' ,$Lvalue_335),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_336),
                                            "LValue"    => implode(', ' ,$Lvalue_336),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_337),
                                            "LValue"    => implode(', ' ,$Lvalue_337),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_338),
                                            "LValue"    => implode(', ' ,$Lvalue_338),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_339),
                                            "LValue"    => implode(', ' ,$Lvalue_339),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_340),
                                            "LValue"    => implode(', ' ,$Lvalue_340),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_341),
                                            "LValue"    => implode(', ' ,$Lvalue_341),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_342),
                                            "LValue"    => implode(', ' ,$Lvalue_342),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_343),
                                            "LValue"    => implode(', ' ,$Lvalue_343),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_344),
                                            "LValue"    => implode(', ' ,$Lvalue_344),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_345),
                                            "LValue"    => implode(', ' ,$Lvalue_345),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_346),
                                            "LValue"    => implode(', ' ,$Lvalue_346),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_347),
                                            "LValue"    => implode(', ' ,$Lvalue_347),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_348),
                                            "LValue"    => implode(', ' ,$Lvalue_348),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_349),
                                            "LValue"    => implode(', ' ,$Lvalue_349),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_350),
                                            "LValue"    => implode(', ' ,$Lvalue_350),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_351),
                                            "LValue"    => implode(', ' ,$Lvalue_351),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_352),
                                            "LValue"    => implode(', ' ,$Lvalue_352),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_353),
                                            "LValue"    => implode(', ' ,$Lvalue_353),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_354),
                                            "LValue"    => implode(', ' ,$Lvalue_354),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_355),
                                            "LValue"    => implode(', ' ,$Lvalue_355),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_356),
                                            "LValue"    => implode(', ' ,$Lvalue_356),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_357),
                                            "LValue"    => implode(', ' ,$Lvalue_357),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_358),
                                            "LValue"    => implode(', ' ,$Lvalue_358),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_359),
                                            "LValue"    => implode(', ' ,$Lvalue_359),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_360),
                                            "LValue"    => implode(', ' ,$Lvalue_360),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_361),
                                            "LValue"    => implode(', ' ,$Lvalue_361),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_362),
                                            "LValue"    => implode(', ' ,$Lvalue_362),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_363),
                                            "LValue"    => implode(', ' ,$Lvalue_363),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_364),
                                            "LValue"    => implode(', ' ,$Lvalue_364),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_365),
                                            "LValue"    => implode(', ' ,$Lvalue_365),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_366),
                                            "LValue"    => implode(', ' ,$Lvalue_366),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_367),
                                            "LValue"    => implode(', ' ,$Lvalue_367),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_368),
                                            "LValue"    => implode(', ' ,$Lvalue_368),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_369),
                                            "LValue"    => implode(', ' ,$Lvalue_369),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_370),
                                            "LValue"    => implode(', ' ,$Lvalue_370),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_371),
                                            "LValue"    => implode(', ' ,$Lvalue_371),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_372),
                                            "LValue"    => implode(', ' ,$Lvalue_372),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_373),
                                            "LValue"    => implode(', ' ,$Lvalue_373),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_374),
                                            "LValue"    => implode(', ' ,$Lvalue_374),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_375),
                                            "LValue"    => implode(', ' ,$Lvalue_375),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_376),
                                            "LValue"    => implode(', ' ,$Lvalue_376),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_377),
                                            "LValue"    => implode(', ' ,$Lvalue_377),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_378),
                                            "LValue"    => implode(', ' ,$Lvalue_378),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_379),
                                            "LValue"    => implode(', ' ,$Lvalue_379),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_380),
                                            "LValue"    => implode(', ' ,$Lvalue_380),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_381),
                                            "LValue"    => implode(', ' ,$Lvalue_381),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_382),
                                            "LValue"    => implode(', ' ,$Lvalue_382),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_383),
                                            "LValue"    => implode(', ' ,$Lvalue_383),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_384),
                                            "LValue"    => implode(', ' ,$Lvalue_384),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_385),
                                            "LValue"    => implode(', ' ,$Lvalue_385),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_386),
                                            "LValue"    => implode(', ' ,$Lvalue_386),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_387),
                                            "LValue"    => implode(', ' ,$Lvalue_387),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_388),
                                            "LValue"    => implode(', ' ,$Lvalue_388),
                                         ],

                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_389),
                                            "LValue"    => implode(', ' ,$Lvalue_389),
                                         ],
                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_390),
                                            "LValue"    => implode(', ' ,$Lvalue_390),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_391),
                                            "LValue"    => implode(', ' ,$Lvalue_391),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_392),
                                            "LValue"    => implode(', ' ,$Lvalue_392),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_393),
                                            "LValue"    => implode(', ' ,$Lvalue_393),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_394),
                                            "LValue"    => implode(', ' ,$Lvalue_394),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_395),
                                            "LValue"    => implode(', ' ,$Lvalue_395),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_396),
                                            "LValue"    => implode(', ' ,$Lvalue_396),
                                         ],
                                              [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_397),
                                            "LValue"    => implode(', ' ,$Lvalue_397),
                                         ],
                                         [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_398),
                                            "LValue"    => implode(', ' ,$Lvalue_398),
                                         ],

                                          [
                                            "Group_Id"  => (int)$data[1][1],  
                                            "datadate"  => $data[1][0], 
                                            "KValue"    => implode(', ' ,$Kvalue_399),
                                            "LValue"    => implode(', ' ,$Lvalue_399),
                                         ],

                                         [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_400),
                                          "LValue"    => implode(', ' ,$Lvalue_400),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_401),
                                          "LValue"    => implode(', ' ,$Lvalue_401),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_402),
                                          "LValue"    => implode(', ' ,$Lvalue_402),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_403),
                                          "LValue"    => implode(', ' ,$Lvalue_403),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_404),
                                          "LValue"    => implode(', ' ,$Lvalue_404),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_405),
                                          "LValue"    => implode(', ' ,$Lvalue_405),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_406),
                                          "LValue"    => implode(', ' ,$Lvalue_406),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_407),
                                          "LValue"    => implode(', ' ,$Lvalue_407),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_408),
                                          "LValue"    => implode(', ' ,$Lvalue_408),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_409),
                                          "LValue"    => implode(', ' ,$Lvalue_409),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_410),
                                          "LValue"    => implode(', ' ,$Lvalue_410),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_411),
                                          "LValue"    => implode(', ' ,$Lvalue_411),
                                           ],

                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_412),
                                          "LValue"    => implode(', ' ,$Lvalue_412),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_413),
                                          "LValue"    => implode(', ' ,$Lvalue_413),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_414),
                                          "LValue"    => implode(', ' ,$Lvalue_414),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_415),
                                          "LValue"    => implode(', ' ,$Lvalue_415),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_416),
                                          "LValue"    => implode(', ' ,$Lvalue_416),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_417),
                                          "LValue"    => implode(', ' ,$Lvalue_417),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_418),
                                          "LValue"    => implode(', ' ,$Lvalue_418),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_419),
                                          "LValue"    => implode(', ' ,$Lvalue_419),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_420),
                                          "LValue"    => implode(', ' ,$Lvalue_420),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_421),
                                          "LValue"    => implode(', ' ,$Lvalue_421),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_422),
                                          "LValue"    => implode(', ' ,$Lvalue_422),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_423),
                                          "LValue"    => implode(', ' ,$Lvalue_423),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_424),
                                          "LValue"    => implode(', ' ,$Lvalue_424),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_425),
                                          "LValue"    => implode(', ' ,$Lvalue_425),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_426),
                                          "LValue"    => implode(', ' ,$Lvalue_426),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_427),
                                          "LValue"    => implode(', ' ,$Lvalue_427),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_428),
                                          "LValue"    => implode(', ' ,$Lvalue_428),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_429),
                                          "LValue"    => implode(', ' ,$Lvalue_429),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_430),
                                          "LValue"    => implode(', ' ,$Lvalue_430),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_431),
                                          "LValue"    => implode(', ' ,$Lvalue_431),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_432),
                                          "LValue"    => implode(', ' ,$Lvalue_432),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_433),
                                          "LValue"    => implode(', ' ,$Lvalue_433),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_434),
                                          "LValue"    => implode(', ' ,$Lvalue_434),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_435),
                                          "LValue"    => implode(', ' ,$Lvalue_435),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_436),
                                          "LValue"    => implode(', ' ,$Lvalue_436),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_437),
                                          "LValue"    => implode(', ' ,$Lvalue_437),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_438),
                                          "LValue"    => implode(', ' ,$Lvalue_438),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_439),
                                          "LValue"    => implode(', ' ,$Lvalue_439),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_440),
                                          "LValue"    => implode(', ' ,$Lvalue_440),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_441),
                                          "LValue"    => implode(', ' ,$Lvalue_441),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_442),
                                          "LValue"    => implode(', ' ,$Lvalue_442),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_443),
                                          "LValue"    => implode(', ' ,$Lvalue_443),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_444),
                                          "LValue"    => implode(', ' ,$Lvalue_444),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_445),
                                          "LValue"    => implode(', ' ,$Lvalue_445),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_446),
                                          "LValue"    => implode(', ' ,$Lvalue_446),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_447),
                                          "LValue"    => implode(', ' ,$Lvalue_447),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_448),
                                          "LValue"    => implode(', ' ,$Lvalue_448),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_449),
                                          "LValue"    => implode(', ' ,$Lvalue_449),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_450),
                                          "LValue"    => implode(', ' ,$Lvalue_450),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_451),
                                          "LValue"    => implode(', ' ,$Lvalue_451),
                                           ],
                                             [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_452),
                                          "LValue"    => implode(', ' ,$Lvalue_452),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_453),
                                          "LValue"    => implode(', ' ,$Lvalue_453),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_454),
                                          "LValue"    => implode(', ' ,$Lvalue_454),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_455),
                                          "LValue"    => implode(', ' ,$Lvalue_455),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_456),
                                          "LValue"    => implode(', ' ,$Lvalue_456),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_457),
                                          "LValue"    => implode(', ' ,$Lvalue_457),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_458),
                                          "LValue"    => implode(', ' ,$Lvalue_458),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_459),
                                          "LValue"    => implode(', ' ,$Lvalue_459),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_460),
                                          "LValue"    => implode(', ' ,$Lvalue_460),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_461),
                                          "LValue"    => implode(', ' ,$Lvalue_461),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_462),
                                          "LValue"    => implode(', ' ,$Lvalue_462),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_463),
                                          "LValue"    => implode(', ' ,$Lvalue_463),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_464),
                                          "LValue"    => implode(', ' ,$Lvalue_464),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_465),
                                          "LValue"    => implode(', ' ,$Lvalue_465),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_466),
                                          "LValue"    => implode(', ' ,$Lvalue_466),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_467),
                                          "LValue"    => implode(', ' ,$Lvalue_467),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_468),
                                          "LValue"    => implode(', ' ,$Lvalue_468),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_469),
                                          "LValue"    => implode(', ' ,$Lvalue_469),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_470),
                                          "LValue"    => implode(', ' ,$Lvalue_470),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_471),
                                          "LValue"    => implode(', ' ,$Lvalue_471),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_472),
                                          "LValue"    => implode(', ' ,$Lvalue_472),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_473),
                                          "LValue"    => implode(', ' ,$Lvalue_473),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_474),
                                          "LValue"    => implode(', ' ,$Lvalue_474),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_475),
                                          "LValue"    => implode(', ' ,$Lvalue_475),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_476),
                                          "LValue"    => implode(', ' ,$Lvalue_476),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_477),
                                          "LValue"    => implode(', ' ,$Lvalue_477),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_478),
                                          "LValue"    => implode(', ' ,$Lvalue_478),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_479),
                                          "LValue"    => implode(', ' ,$Lvalue_479),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_480),
                                          "LValue"    => implode(', ' ,$Lvalue_480),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_481),
                                          "LValue"    => implode(', ' ,$Lvalue_481),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_482),
                                          "LValue"    => implode(', ' ,$Lvalue_482),
                                           ],
                                          [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_483),
                                          "LValue"    => implode(', ' ,$Lvalue_483),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_484),
                                          "LValue"    => implode(', ' ,$Lvalue_484),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_485),
                                          "LValue"    => implode(', ' ,$Lvalue_485),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_486),
                                          "LValue"    => implode(', ' ,$Lvalue_486),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_487),
                                          "LValue"    => implode(', ' ,$Lvalue_487),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_488),
                                          "LValue"    => implode(', ' ,$Lvalue_488),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_489),
                                          "LValue"    => implode(', ' ,$Lvalue_489),
                                           ],
                                            [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_490),
                                          "LValue"    => implode(', ' ,$Lvalue_490),
                                           ],
[
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_491),
                                          "LValue"    => implode(', ' ,$Lvalue_491),
                                           ],
[
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_492),
                                          "LValue"    => implode(', ' ,$Lvalue_492),
                                           ],                                           
[
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_493),
                                          "LValue"    => implode(', ' ,$Lvalue_493),
                                           ],
                                           [
                                           "Group_Id"  => (int)$data[1][1],  
                                          "datadate"  => $data[1][0], 
                                          "KValue"    => implode(', ' ,$Kvalue_494),
                                          "LValue"    => implode(', ' ,$Lvalue_494),
                                           ],
// [
//                                            "Group_Id"  => (int)$data[1][1],  
//                                           "datadate"  => $data[1][0], 
//                                           "KValue"    => implode(', ' ,$Kvalue_495),
//                                           "LValue"    => implode(', ' ,$Lvalue_495),
//                                            ],
                                      ]
                                ]];


                 // print_r($str);exit;
				  $str = json_encode($str);
                 // print_r(count($str));exit();
          
                    /* $str = [];
					array_walk_recursive($json_compress_data, function($v) use (&$str) {
					    $str[] = $v;
					});

					$str = implode(',', $str);*/

                  //$str = implode(",",$str);

                  //print_r($str);exit;

                 //$str="Hello World";
             $buffer=unpack("C*",$str);

		         $compressedData =gzencode($str);

		         $compressedData_array = unpack('C*', $compressedData);

		         $buffer = unpack("C*", pack("L", sizeof($buffer)));

		        $gZipBuffer=array_merge($buffer,$compressedData_array);

		        $str = call_user_func_array("pack", array_merge(array("C*"), $gZipBuffer));

		        $str = base64_encode($str);
              
 			    //print_r($jayParsedAry);exit;
                
                //$push_compress_data = base64_encode(gzcompress($json_compress_data, 9)); 
                //$uncompressed = gzuncompress($push_compress_data);

                //print_r($uncompressed);exit;
                print 'DATA: ' . print_r($str, true);

                print '
';
                $ecrypted_data = kpi_dash_api_encrypt($str, $file_key);

                //print_r($ecrypted_data);exit;
                $paylod = [array(
	                    "IP" => array(
	                     "Instance_Code" => 1,
						           "Sec_Code"      => 1,
						           "Ministry_Code" => 1,
						           "Dept_Code"     => 2,
						           "Project_Code"  => 10043
	                    ),
	                    "EncyptedData" => $ecrypted_data
                )];

                //$paylod = json_encode($paylod);

                //print_r($paylod);exit;
                
                print 'PAYLOAD: ' . print_r($paylod, true);

                // print_r($paylod);exit;

                $response = push_to_kpi_dashboard($paylod);

                print 'RESPONSE: ' . print_r($response, true);

                  //$res= json_encode($response->Message);
                  // $res= json_encode($response);
                  // // $res_1 = 'RESPONSE: ' . print_r($response, true);
                  // $link = mysqli_connect("localhost", "root", "", "enam");
                  // if($link === false){
                  //     die("ERROR: Could not connect. " . mysqli_connect_error());
                  // }
                  // $sql = "INSERT INTO darpan_dash (responce) VALUES ('$res')";
                  // if(mysqli_query($link, $sql)){
                  //   echo('<br>');     echo('<br>');
                  //     echo "Response added successfully!.";
                  // } else{
                  //       echo('<br>');
                  //       echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                  // }
                  // mysqli_close($link);


                print '
';
            } else {

                print_r( $date_row->datadate . 'Error: Data not found.<br><br>') ;
                //print_r(json_encode($date_row->Result));
                //$res =  'RESPONSE: ' . $date_row->datadate . 'Error: Data not found.';
    /*             $res= json_encode($date_row->Result);
          				$link = mysqli_connect("localhost", "root", "", "enam_test");
          				if($link === false){
          				    die("ERROR: Could not connect. " . mysqli_connect_error());
          				}
          				$sql = "INSERT INTO darpan_dash (responce) VALUES ('$res')";
          				if(mysqli_query($link, $sql)){
                    echo('<br>');     echo('<br>');
          				    echo "Responce added successfully.";
          				} else{
                         echo('<br>');
          				    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          				}
          				mysqli_close($link);*/
           
                die();
            }

            	//$msg = json_encode($response);
             /*    try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    // execute the stored procedure
                    $p_flag = 'RQ';
                    $P_State_Code = 0;
                    $P_Sec_Code = 44;
                    $P_Dept_Code = 287;
                    $P_Project_Code = 70043;
                    $P_Datef = '2016-04-30';
                    $P_Datet = '2020-03-31';
                    $P_Msg =	$msg;
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
                }*/

            print '
';
            $i ++;
            exit();
        }
    }
}

?>

<script type="text/javascript">
    // $(document).ready(function(){
    //     html2canvas(document.body).then(canvas => {  
    //         document.body.appendChild(canvas);  
    //         console.log('===',canvas.toDataURL());  
    //         dataURL = canvas.toDataURL();  
    //         console.log('-----to check',dataURL);  
    //     }); 
    // });

      
</script>




