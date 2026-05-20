<?php
include 'lib.php';
include 'dbconfig.php';

$url = 'http://localhost/csv/Key_1_10043_20200709.key';
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
$kpi_data_file      = "http://localhost/csv/New_kpi_dashboard_data_06_2020.csv";

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
    if(!isset($data[$row[0]])) 
    {
        $data[$row[0]] = $row;

    }
}

//print_r($row);
//print_r($data);
//Detail for data.gov.in project
$project_data = array
(
 "Instance_Code" => 1,
 "Sec_Code"      => 1,
 "Ministry_Code" => 1,
 "Dept_Code"     => 2,
 "Project_Code"  => 10043
);

//print_r($project_data);exit;
$date_range = get_date_range($project_data);
//print_r($date_range);exit;
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
			//print_r($data[$date_row->datadate]);

            if(isset($date_row->datadate) && isset($data[$date_row->datadate]) )

             {
                $cur_data = $data[$date_row->datadate];
                //print_r($cur_data[0]);exit;
                $date = DateTime::createFromFormat('m/d/Y', $cur_data[0]);

                $MM_DD_YYYY = $date->format('m/d/Y');

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
  $csvFile = fopen('http://localhost/csv/New_kpi_dashboard_data_06_2020.csv', 'r');
  $data = array();
  while ($row = fgetcsv($csvFile)) 
  {
      $data[] = $row;
      //print_r($data[1][1]);
  }

$Kvalue_1 = [$data[1][2], $data[1][3], $data[1][4]]; $Lvalue_1 = [$data[1][5], $data[1][6], $data[1][7]]; 
$Kvalue_2 = [$data[2][2], $data[2][3], $data[2][4]]; $Lvalue_2 = [$data[2][5], $data[2][6], $data[2][7]];
$Kvalue_3 = [$data[3][2], $data[3][3], $data[3][4]]; $Lvalue_3 = [$data[3][5], $data[3][6], $data[3][7]];
$Kvalue_4 = [$data[4][2], $data[4][3], $data[4][4]]; $Lvalue_4 = [$data[4][5], $data[4][6], $data[4][7]]; 
$Kvalue_5 = [$data[5][2], $data[5][3], $data[5][4]]; $Lvalue_5 = [$data[5][5], $data[5][6], $data[5][7]];
$Kvalue_6 = [$data[6][2], $data[6][3], $data[6][4]]; $Lvalue_6 = [$data[6][5], $data[6][6], $data[6][7]];
$Kvalue_7 = [$data[7][2], $data[7][3], $data[7][4]]; $Lvalue_7 = [$data[7][5], $data[7][6], $data[7][7]]; 
$Kvalue_8 = [$data[8][2], $data[8][3], $data[8][4]]; $Lvalue_8 = [$data[8][5], $data[8][6], $data[8][7]];
$Kvalue_9 = [$data[9][2], $data[9][3], $data[9][4]]; $Lvalue_9 = [$data[9][5], $data[9][6], $data[9][7]];
$Kvalue_10 = [$data[10][2], $data[10][3], $data[10][4]]; $Lvalue_10 = [$data[10][5], $data[10][6], $data[10][7]];
$Kvalue_11 = [$data[11][2], $data[11][3], $data[11][4]]; $Lvalue_11 = [$data[11][5], $data[11][6], $data[11][7]]; 
$Kvalue_12 = [$data[12][2], $data[12][3], $data[12][4]]; $Lvalue_12 = [$data[12][5], $data[12][6], $data[12][7]];
$Kvalue_13 = [$data[13][2], $data[13][3], $data[13][4]]; $Lvalue_13 = [$data[13][5], $data[13][6], $data[13][7]];
$Kvalue_14 = [$data[14][2], $data[14][3], $data[14][4]]; $Lvalue_14 = [$data[14][5], $data[14][6], $data[14][7]]; 
$Kvalue_15 = [$data[15][2], $data[15][3], $data[15][4]]; $Lvalue_15 = [$data[15][5], $data[15][6], $data[15][7]];
$Kvalue_16 = [$data[16][2], $data[16][3], $data[16][4]]; $Lvalue_16 = [$data[16][5], $data[16][6], $data[16][7]];
$Kvalue_17 = [$data[17][2], $data[17][3], $data[17][4]]; $Lvalue_17 = [$data[17][5], $data[17][6], $data[17][7]]; 
$Kvalue_18 = [$data[18][2], $data[18][3], $data[18][4]]; $Lvalue_18 = [$data[18][5], $data[18][6], $data[18][7]];
$Kvalue_19 = [$data[19][2], $data[19][3], $data[19][4]]; $Lvalue_19 = [$data[19][5], $data[19][6], $data[19][7]];
$Kvalue_20 = [$data[20][2], $data[20][3], $data[20][4]]; $Lvalue_20 = [$data[20][5], $data[20][6], $data[20][7]];
$Kvalue_21 = [$data[21][2], $data[21][3], $data[21][4]]; $Lvalue_21 = [$data[21][5], $data[21][6], $data[21][7]]; 
$Kvalue_22 = [$data[22][2], $data[22][3], $data[22][4]]; $Lvalue_22 = [$data[22][5], $data[22][6], $data[22][7]];
$Kvalue_23 = [$data[23][2], $data[23][3], $data[23][4]]; $Lvalue_23 = [$data[23][5], $data[23][6], $data[23][7]];
$Kvalue_24 = [$data[24][2], $data[24][3], $data[24][4]]; $Lvalue_24 = [$data[24][5], $data[24][6], $data[24][7]]; 
$Kvalue_25 = [$data[25][2], $data[25][3], $data[25][4]]; $Lvalue_25 = [$data[25][5], $data[25][6], $data[25][7]];
$Kvalue_26 = [$data[26][2], $data[26][3], $data[26][4]]; $Lvalue_26 = [$data[26][5], $data[26][6], $data[26][7]];
$Kvalue_27 = [$data[27][2], $data[27][3], $data[27][4]]; $Lvalue_27 = [$data[27][5], $data[27][6], $data[27][7]]; 
$Kvalue_28 = [$data[28][2], $data[28][3], $data[28][4]]; $Lvalue_28 = [$data[28][5], $data[28][6], $data[28][7]];
$Kvalue_29 = [$data[29][2], $data[29][3], $data[29][4]]; $Lvalue_29 = [$data[29][5], $data[29][6], $data[29][7]];
$Kvalue_30 = [$data[30][2], $data[30][3], $data[30][4]]; $Lvalue_30 = [$data[30][5], $data[30][6], $data[30][7]];
$Kvalue_31 = [$data[31][2], $data[31][3], $data[31][4]]; $Lvalue_31 = [$data[31][5], $data[31][6], $data[31][7]]; 
$Kvalue_32 = [$data[32][2], $data[32][3], $data[32][4]]; $Lvalue_32 = [$data[32][5], $data[32][6], $data[32][7]];
$Kvalue_33 = [$data[33][2], $data[33][3], $data[33][4]]; $Lvalue_33 = [$data[33][5], $data[33][6], $data[33][7]];
$Kvalue_34 = [$data[34][2], $data[34][3], $data[34][4]]; $Lvalue_34 = [$data[34][5], $data[34][6], $data[34][7]]; 
$Kvalue_35 = [$data[35][2], $data[35][3], $data[35][4]]; $Lvalue_35 = [$data[35][5], $data[35][6], $data[35][7]];
$Kvalue_36 = [$data[36][2], $data[36][3], $data[36][4]]; $Lvalue_36 = [$data[36][5], $data[36][6], $data[36][7]];
$Kvalue_37 = [$data[37][2], $data[37][3], $data[37][4]]; $Lvalue_37 = [$data[37][5], $data[37][6], $data[37][7]]; 
$Kvalue_38 = [$data[38][2], $data[38][3], $data[38][4]]; $Lvalue_38 = [$data[38][5], $data[38][6], $data[38][7]];
$Kvalue_39 = [$data[39][2], $data[39][3], $data[39][4]]; $Lvalue_39 = [$data[39][5], $data[39][6], $data[39][7]];
$Kvalue_40 = [$data[40][2], $data[40][3], $data[40][4]]; $Lvalue_40 = [$data[40][5], $data[40][6], $data[40][7]];
$Kvalue_41 = [$data[41][2], $data[41][3], $data[41][4]]; $Lvalue_41 = [$data[41][5], $data[41][6], $data[41][7]]; 
$Kvalue_42 = [$data[42][2], $data[42][3], $data[42][4]]; $Lvalue_42 = [$data[42][5], $data[42][6], $data[42][7]];
$Kvalue_43 = [$data[43][2], $data[43][3], $data[43][4]]; $Lvalue_43 = [$data[43][5], $data[43][6], $data[43][7]];
$Kvalue_44 = [$data[44][2], $data[44][3], $data[44][4]]; $Lvalue_44 = [$data[44][5], $data[44][6], $data[44][7]]; 
$Kvalue_45 = [$data[45][2], $data[45][3], $data[45][4]]; $Lvalue_45 = [$data[45][5], $data[45][6], $data[45][7]];
$Kvalue_46 = [$data[46][2], $data[46][3], $data[46][4]]; $Lvalue_46 = [$data[46][5], $data[46][6], $data[46][7]];
$Kvalue_47 = [$data[47][2], $data[47][3], $data[47][4]]; $Lvalue_47 = [$data[47][5], $data[47][6], $data[47][7]]; 
$Kvalue_48 = [$data[48][2], $data[48][3], $data[48][4]]; $Lvalue_48 = [$data[48][5], $data[48][6], $data[48][7]];
$Kvalue_49 = [$data[49][2], $data[49][3], $data[49][4]]; $Lvalue_49 = [$data[49][5], $data[49][6], $data[49][7]];
$Kvalue_50 = [$data[50][2], $data[50][3], $data[50][4]]; $Lvalue_50 = [$data[50][5], $data[50][6], $data[50][7]];
$Kvalue_51 = [$data[51][2], $data[51][3], $data[51][4]]; $Lvalue_51 = [$data[51][5], $data[51][6], $data[51][7]]; 
$Kvalue_52 = [$data[52][2], $data[52][3], $data[52][4]]; $Lvalue_52 = [$data[52][5], $data[52][6], $data[52][7]];
$Kvalue_53 = [$data[53][2], $data[53][3], $data[53][4]]; $Lvalue_53 = [$data[53][5], $data[53][6], $data[53][7]];
$Kvalue_54 = [$data[54][2], $data[54][3], $data[54][4]]; $Lvalue_54 = [$data[54][5], $data[54][6], $data[54][7]]; 
$Kvalue_55 = [$data[55][2], $data[55][3], $data[55][4]]; $Lvalue_55 = [$data[55][5], $data[55][6], $data[55][7]];
$Kvalue_56 = [$data[56][2], $data[56][3], $data[56][4]]; $Lvalue_56 = [$data[56][5], $data[56][6], $data[56][7]];
$Kvalue_57 = [$data[57][2], $data[57][3], $data[57][4]]; $Lvalue_57 = [$data[57][5], $data[57][6], $data[57][7]]; 
$Kvalue_58 = [$data[58][2], $data[58][3], $data[58][4]]; $Lvalue_58 = [$data[58][5], $data[58][6], $data[58][7]];
$Kvalue_59 = [$data[59][2], $data[59][3], $data[59][4]]; $Lvalue_59 = [$data[59][5], $data[59][6], $data[59][7]];
$Kvalue_60 = [$data[60][2], $data[60][3], $data[60][4]]; $Lvalue_60 = [$data[60][5], $data[60][6], $data[60][7]];

$Kvalue_61 = [$data[61][2], $data[61][3], $data[61][4]]; $Lvalue_61 = [$data[61][5], $data[61][6], $data[61][7]]; 
$Kvalue_62 = [$data[62][2], $data[62][3], $data[62][4]]; $Lvalue_62 = [$data[62][5], $data[62][6], $data[62][7]];
$Kvalue_63 = [$data[63][2], $data[63][3], $data[63][4]]; $Lvalue_63 = [$data[63][5], $data[63][6], $data[63][7]];
$Kvalue_64 = [$data[64][2], $data[64][3], $data[64][4]]; $Lvalue_64 = [$data[64][5], $data[64][6], $data[64][7]]; 
$Kvalue_65 = [$data[65][2], $data[65][3], $data[65][4]]; $Lvalue_65 = [$data[65][5], $data[65][6], $data[65][7]];
$Kvalue_66 = [$data[66][2], $data[66][3], $data[66][4]]; $Lvalue_66 = [$data[66][5], $data[66][6], $data[66][7]];
$Kvalue_67 = [$data[67][2], $data[67][3], $data[67][4]]; $Lvalue_67 = [$data[67][5], $data[67][6], $data[67][7]]; 
$Kvalue_68 = [$data[68][2], $data[68][3], $data[68][4]]; $Lvalue_68 = [$data[68][5], $data[68][6], $data[68][7]];
$Kvalue_69 = [$data[69][2], $data[69][3], $data[69][4]]; $Lvalue_69 = [$data[69][5], $data[69][6], $data[69][7]];
$Kvalue_70 = [$data[70][2], $data[70][3], $data[70][4]]; $Lvalue_70 = [$data[70][5], $data[70][6], $data[70][7]];
$Kvalue_71 = [$data[71][2], $data[71][3], $data[71][4]]; $Lvalue_71 = [$data[71][5], $data[71][6], $data[71][7]]; 
$Kvalue_72 = [$data[72][2], $data[72][3], $data[72][4]]; $Lvalue_72 = [$data[72][5], $data[72][6], $data[72][7]];
$Kvalue_73 = [$data[73][2], $data[73][3], $data[73][4]]; $Lvalue_73 = [$data[73][5], $data[73][6], $data[73][7]];
$Kvalue_74 = [$data[74][2], $data[74][3], $data[74][4]]; $Lvalue_74 = [$data[74][5], $data[74][6], $data[74][7]]; 
$Kvalue_75 = [$data[75][2], $data[75][3], $data[75][4]]; $Lvalue_75 = [$data[75][5], $data[75][6], $data[75][7]];
$Kvalue_76 = [$data[76][2], $data[76][3], $data[76][4]]; $Lvalue_76 = [$data[76][5], $data[76][6], $data[76][7]];
$Kvalue_77 = [$data[77][2], $data[77][3], $data[77][4]]; $Lvalue_77 = [$data[77][5], $data[77][6], $data[77][7]]; 
$Kvalue_78 = [$data[78][2], $data[78][3], $data[78][4]]; $Lvalue_78 = [$data[78][5], $data[78][6], $data[78][7]];
$Kvalue_79 = [$data[79][2], $data[79][3], $data[79][4]]; $Lvalue_79 = [$data[79][5], $data[79][6], $data[79][7]];
$Kvalue_80 = [$data[80][2], $data[80][3], $data[80][4]]; $Lvalue_80 = [$data[80][5], $data[80][6], $data[80][7]];
$Kvalue_81 = [$data[81][2], $data[81][3], $data[81][4]]; $Lvalue_81 = [$data[81][5], $data[81][6], $data[81][7]]; 
$Kvalue_82 = [$data[82][2], $data[82][3], $data[82][4]]; $Lvalue_82 = [$data[82][5], $data[82][6], $data[82][7]];
$Kvalue_83 = [$data[83][2], $data[83][3], $data[83][4]]; $Lvalue_83 = [$data[83][5], $data[83][6], $data[83][7]];
$Kvalue_84 = [$data[84][2], $data[84][3], $data[84][4]]; $Lvalue_84 = [$data[84][5], $data[84][6], $data[84][7]]; 
$Kvalue_85 = [$data[85][2], $data[85][3], $data[85][4]]; $Lvalue_85 = [$data[85][5], $data[85][6], $data[85][7]];
$Kvalue_86 = [$data[86][2], $data[86][3], $data[86][4]]; $Lvalue_86 = [$data[86][5], $data[86][6], $data[86][7]];
$Kvalue_87 = [$data[87][2], $data[87][3], $data[87][4]]; $Lvalue_87 = [$data[87][5], $data[87][6], $data[87][7]]; 
$Kvalue_88 = [$data[88][2], $data[88][3], $data[88][4]]; $Lvalue_88 = [$data[88][5], $data[88][6], $data[88][7]];
$Kvalue_89 = [$data[89][2], $data[89][3], $data[89][4]]; $Lvalue_89 = [$data[89][5], $data[89][6], $data[89][7]];
$Kvalue_90 = [$data[90][2], $data[90][3], $data[90][4]]; $Lvalue_90 = [$data[90][5], $data[90][6], $data[90][7]];
$Kvalue_91 = [$data[91][2], $data[91][3], $data[91][4]]; $Lvalue_91 = [$data[91][5], $data[91][6], $data[91][7]]; 
$Kvalue_92 = [$data[92][2], $data[92][3], $data[92][4]]; $Lvalue_92 = [$data[92][5], $data[92][6], $data[92][7]];
$Kvalue_93 = [$data[93][2], $data[93][3], $data[93][4]]; $Lvalue_93 = [$data[93][5], $data[93][6], $data[93][7]];
$Kvalue_94 = [$data[94][2], $data[94][3], $data[94][4]]; $Lvalue_94 = [$data[94][5], $data[94][6], $data[94][7]]; 
$Kvalue_95 = [$data[95][2], $data[95][3], $data[95][4]]; $Lvalue_95 = [$data[95][5], $data[95][6], $data[95][7]];
$Kvalue_96 = [$data[96][2], $data[96][3], $data[96][4]]; $Lvalue_96 = [$data[96][5], $data[96][6], $data[96][7]];
$Kvalue_97 = [$data[97][2], $data[97][3], $data[97][4]]; $Lvalue_97 = [$data[97][5], $data[97][6], $data[97][7]]; 
$Kvalue_98 = [$data[98][2], $data[98][3], $data[98][4]]; $Lvalue_98 = [$data[98][5], $data[98][6], $data[98][7]];
$Kvalue_99 = [$data[99][2], $data[99][3], $data[99][4]]; $Lvalue_99 = [$data[99][5], $data[99][6], $data[99][7]];
$Kvalue_100 = [$data[100][2], $data[100][3], $data[100][4]]; $Lvalue_100 = [$data[100][5], $data[100][6], $data[100][7]];
$Kvalue_101 = [$data[101][2], $data[101][3], $data[101][4]]; $Lvalue_101 = [$data[101][5], $data[101][6], $data[101][7]]; 
$Kvalue_102 = [$data[102][2], $data[102][3], $data[102][4]]; $Lvalue_102 = [$data[102][5], $data[102][6], $data[102][7]];
$Kvalue_103 = [$data[103][2], $data[103][3], $data[103][4]]; $Lvalue_103 = [$data[103][5], $data[103][6], $data[103][7]];
$Kvalue_104 = [$data[104][2], $data[104][3], $data[104][4]]; $Lvalue_104 = [$data[104][5], $data[104][6], $data[104][7]]; 
$Kvalue_105 = [$data[105][2], $data[105][3], $data[105][4]]; $Lvalue_105 = [$data[105][5], $data[105][6], $data[105][7]];
$Kvalue_106 = [$data[106][2], $data[106][3], $data[106][4]]; $Lvalue_106 = [$data[106][5], $data[106][6], $data[106][7]];
$Kvalue_107 = [$data[107][2], $data[107][3], $data[107][4]]; $Lvalue_107 = [$data[107][5], $data[107][6], $data[107][7]]; 
$Kvalue_108 = [$data[108][2], $data[108][3], $data[108][4]]; $Lvalue_108 = [$data[108][5], $data[108][6], $data[108][7]];
$Kvalue_109 = [$data[109][2], $data[109][3], $data[109][4]]; $Lvalue_109 = [$data[109][5], $data[109][6], $data[109][7]];
$Kvalue_110 = [$data[110][2], $data[110][3], $data[110][4]]; $Lvalue_110 = [$data[110][5], $data[110][6], $data[110][7]];
$Kvalue_111 = [$data[111][2], $data[111][3], $data[111][4]]; $Lvalue_111 = [$data[111][5], $data[111][6], $data[111][7]]; 
$Kvalue_112 = [$data[112][2], $data[112][3], $data[112][4]]; $Lvalue_112 = [$data[112][5], $data[112][6], $data[112][7]];
$Kvalue_113 = [$data[113][2], $data[113][3], $data[113][4]]; $Lvalue_113 = [$data[113][5], $data[113][6], $data[113][7]];
$Kvalue_114 = [$data[114][2], $data[114][3], $data[114][4]]; $Lvalue_114 = [$data[114][5], $data[114][6], $data[114][7]]; 
$Kvalue_115 = [$data[115][2], $data[115][3], $data[115][4]]; $Lvalue_115 = [$data[115][5], $data[115][6], $data[115][7]];
$Kvalue_116 = [$data[116][2], $data[116][3], $data[116][4]]; $Lvalue_116 = [$data[116][5], $data[116][6], $data[116][7]];
$Kvalue_117 = [$data[117][2], $data[117][3], $data[117][4]]; $Lvalue_117 = [$data[117][5], $data[117][6], $data[117][7]]; 
$Kvalue_118 = [$data[118][2], $data[118][3], $data[118][4]]; $Lvalue_118 = [$data[118][5], $data[118][6], $data[118][7]];
$Kvalue_119 = [$data[119][2], $data[119][3], $data[119][4]]; $Lvalue_119 = [$data[119][5], $data[119][6], $data[119][7]];
$Kvalue_120 = [$data[120][2], $data[120][3], $data[120][4]]; $Lvalue_120 = [$data[120][5], $data[120][6], $data[120][7]];
$Kvalue_121 = [$data[121][2], $data[121][3], $data[121][4]]; $Lvalue_121 = [$data[121][5], $data[121][6], $data[121][7]]; 
$Kvalue_122 = [$data[122][2], $data[122][3], $data[122][4]]; $Lvalue_122 = [$data[122][5], $data[122][6], $data[122][7]];
$Kvalue_123 = [$data[123][2], $data[123][3], $data[123][4]]; $Lvalue_123 = [$data[123][5], $data[123][6], $data[123][7]];
$Kvalue_124 = [$data[124][2], $data[124][3], $data[124][4]]; $Lvalue_124 = [$data[124][5], $data[124][6], $data[124][7]]; 
$Kvalue_125 = [$data[125][2], $data[125][3], $data[125][4]]; $Lvalue_125 = [$data[125][5], $data[125][6], $data[125][7]];
$Kvalue_126 = [$data[126][2], $data[126][3], $data[126][4]]; $Lvalue_126 = [$data[126][5], $data[126][6], $data[126][7]];
$Kvalue_127 = [$data[127][2], $data[127][3], $data[127][4]]; $Lvalue_127 = [$data[127][5], $data[127][6], $data[127][7]]; 
$Kvalue_128 = [$data[128][2], $data[128][3], $data[128][4]]; $Lvalue_128 = [$data[128][5], $data[128][6], $data[128][7]];
$Kvalue_129 = [$data[129][2], $data[129][3], $data[129][4]]; $Lvalue_129 = [$data[129][5], $data[129][6], $data[129][7]];
$Kvalue_130 = [$data[130][2], $data[130][3], $data[130][4]]; $Lvalue_130 = [$data[130][5], $data[130][6], $data[130][7]];
$Kvalue_131 = [$data[131][2], $data[131][3], $data[131][4]]; $Lvalue_131 = [$data[131][5], $data[131][6], $data[131][7]]; 
$Kvalue_132 = [$data[132][2], $data[132][3], $data[132][4]]; $Lvalue_132 = [$data[132][5], $data[132][6], $data[132][7]];
$Kvalue_133 = [$data[133][2], $data[133][3], $data[133][4]]; $Lvalue_133 = [$data[133][5], $data[133][6], $data[133][7]];
$Kvalue_134 = [$data[134][2], $data[134][3], $data[134][4]]; $Lvalue_134 = [$data[134][5], $data[134][6], $data[134][7]]; 
$Kvalue_135 = [$data[135][2], $data[135][3], $data[135][4]]; $Lvalue_135 = [$data[135][5], $data[135][6], $data[135][7]];
$Kvalue_136 = [$data[136][2], $data[136][3], $data[136][4]]; $Lvalue_136 = [$data[136][5], $data[136][6], $data[136][7]];
$Kvalue_137 = [$data[137][2], $data[137][3], $data[137][4]]; $Lvalue_137 = [$data[137][5], $data[137][6], $data[137][7]]; 
$Kvalue_138 = [$data[138][2], $data[138][3], $data[138][4]]; $Lvalue_138 = [$data[138][5], $data[138][6], $data[138][7]];
$Kvalue_139 = [$data[139][2], $data[139][3], $data[139][4]]; $Lvalue_139 = [$data[139][5], $data[139][6], $data[139][7]];
$Kvalue_140 = [$data[140][2], $data[140][3], $data[140][4]]; $Lvalue_140 = [$data[140][5], $data[140][6], $data[140][7]];
$Kvalue_141 = [$data[141][2], $data[141][3], $data[141][4]]; $Lvalue_141 = [$data[141][5], $data[141][6], $data[141][7]]; 
$Kvalue_142 = [$data[142][2], $data[142][3], $data[142][4]]; $Lvalue_142 = [$data[142][5], $data[142][6], $data[142][7]];
$Kvalue_143 = [$data[143][2], $data[143][3], $data[143][4]]; $Lvalue_143 = [$data[143][5], $data[143][6], $data[143][7]];
$Kvalue_144 = [$data[144][2], $data[144][3], $data[144][4]]; $Lvalue_144 = [$data[144][5], $data[144][6], $data[144][7]]; 
$Kvalue_145 = [$data[145][2], $data[145][3], $data[145][4]]; $Lvalue_145 = [$data[145][5], $data[145][6], $data[145][7]];
$Kvalue_146 = [$data[146][2], $data[146][3], $data[146][4]]; $Lvalue_146 = [$data[146][5], $data[146][6], $data[146][7]];
$Kvalue_147 = [$data[147][2], $data[147][3], $data[147][4]]; $Lvalue_147 = [$data[147][5], $data[147][6], $data[147][7]]; 
$Kvalue_148 = [$data[148][2], $data[148][3], $data[148][4]]; $Lvalue_148 = [$data[148][5], $data[148][6], $data[148][7]];
$Kvalue_149 = [$data[149][2], $data[149][3], $data[149][4]]; $Lvalue_149 = [$data[149][5], $data[149][6], $data[149][7]];
$Kvalue_150 = [$data[150][2], $data[150][3], $data[150][4]]; $Lvalue_150 = [$data[150][5], $data[150][6], $data[150][7]];
$Kvalue_151 = [$data[151][2], $data[151][3], $data[151][4]]; $Lvalue_151 = [$data[151][5], $data[151][6], $data[151][7]]; 
$Kvalue_152 = [$data[152][2], $data[152][3], $data[152][4]]; $Lvalue_152 = [$data[152][5], $data[152][6], $data[152][7]];
$Kvalue_153 = [$data[153][2], $data[153][3], $data[153][4]]; $Lvalue_153 = [$data[153][5], $data[153][6], $data[153][7]];
$Kvalue_154 = [$data[154][2], $data[154][3], $data[154][4]]; $Lvalue_154 = [$data[154][5], $data[154][6], $data[154][7]]; 
$Kvalue_155 = [$data[155][2], $data[155][3], $data[155][4]]; $Lvalue_155 = [$data[155][5], $data[155][6], $data[155][7]];
$Kvalue_156 = [$data[156][2], $data[156][3], $data[156][4]]; $Lvalue_156 = [$data[156][5], $data[156][6], $data[156][7]];
$Kvalue_157 = [$data[157][2], $data[157][3], $data[157][4]]; $Lvalue_157 = [$data[157][5], $data[157][6], $data[157][7]]; 
$Kvalue_158 = [$data[158][2], $data[158][3], $data[158][4]]; $Lvalue_158 = [$data[158][5], $data[158][6], $data[158][7]];
$Kvalue_159 = [$data[159][2], $data[159][3], $data[159][4]]; $Lvalue_159 = [$data[159][5], $data[159][6], $data[159][7]];
$Kvalue_160 = [$data[160][2], $data[160][3], $data[160][4]]; $Lvalue_160 = [$data[160][5], $data[160][6], $data[160][7]];
$Kvalue_161 = [$data[161][2], $data[161][3], $data[161][4]]; $Lvalue_161 = [$data[161][5], $data[161][6], $data[161][7]]; 
$Kvalue_162 = [$data[162][2], $data[162][3], $data[162][4]]; $Lvalue_162 = [$data[162][5], $data[162][6], $data[162][7]];
$Kvalue_163 = [$data[163][2], $data[163][3], $data[163][4]]; $Lvalue_163 = [$data[163][5], $data[163][6], $data[163][7]];
$Kvalue_164 = [$data[164][2], $data[164][3], $data[164][4]]; $Lvalue_164 = [$data[164][5], $data[164][6], $data[164][7]]; 
$Kvalue_165 = [$data[165][2], $data[165][3], $data[165][4]]; $Lvalue_165 = [$data[165][5], $data[165][6], $data[165][7]];
$Kvalue_166 = [$data[166][2], $data[166][3], $data[166][4]]; $Lvalue_166 = [$data[166][5], $data[166][6], $data[166][7]];
$Kvalue_167 = [$data[167][2], $data[167][3], $data[167][4]]; $Lvalue_167 = [$data[167][5], $data[167][6], $data[167][7]]; 
$Kvalue_168 = [$data[168][2], $data[168][3], $data[168][4]]; $Lvalue_168 = [$data[168][5], $data[168][6], $data[168][7]];
$Kvalue_169 = [$data[169][2], $data[169][3], $data[169][4]]; $Lvalue_169 = [$data[169][5], $data[169][6], $data[169][7]];
$Kvalue_170 = [$data[170][2], $data[170][3], $data[170][4]]; $Lvalue_170 = [$data[170][5], $data[170][6], $data[170][7]];
$Kvalue_171 = [$data[171][2], $data[171][3], $data[171][4]]; $Lvalue_171 = [$data[171][5], $data[171][6], $data[171][7]]; 
$Kvalue_172 = [$data[172][2], $data[172][3], $data[172][4]]; $Lvalue_172 = [$data[172][5], $data[172][6], $data[172][7]];
$Kvalue_173 = [$data[173][2], $data[173][3], $data[173][4]]; $Lvalue_173 = [$data[173][5], $data[173][6], $data[173][7]];
$Kvalue_174 = [$data[174][2], $data[174][3], $data[174][4]]; $Lvalue_174 = [$data[174][5], $data[174][6], $data[174][7]]; 
$Kvalue_175 = [$data[175][2], $data[175][3], $data[175][4]]; $Lvalue_175 = [$data[175][5], $data[175][6], $data[175][7]];
$Kvalue_176 = [$data[176][2], $data[176][3], $data[176][4]]; $Lvalue_176 = [$data[176][5], $data[176][6], $data[176][7]];
$Kvalue_177 = [$data[177][2], $data[177][3], $data[177][4]]; $Lvalue_177 = [$data[177][5], $data[177][6], $data[177][7]]; 
$Kvalue_178 = [$data[178][2], $data[178][3], $data[178][4]]; $Lvalue_178 = [$data[178][5], $data[178][6], $data[178][7]];
$Kvalue_179 = [$data[179][2], $data[179][3], $data[179][4]]; $Lvalue_179 = [$data[179][5], $data[179][6], $data[179][7]];
$Kvalue_180 = [$data[180][2], $data[180][3], $data[180][4]]; $Lvalue_180 = [$data[180][5], $data[180][6], $data[180][7]];
$Kvalue_181 = [$data[181][2], $data[181][3], $data[181][4]]; $Lvalue_181 = [$data[181][5], $data[181][6], $data[181][7]]; 
$Kvalue_182 = [$data[182][2], $data[182][3], $data[182][4]]; $Lvalue_182 = [$data[182][5], $data[182][6], $data[182][7]];
$Kvalue_183 = [$data[183][2], $data[183][3], $data[183][4]]; $Lvalue_183 = [$data[183][5], $data[183][6], $data[183][7]];
$Kvalue_184 = [$data[184][2], $data[184][3], $data[184][4]]; $Lvalue_184 = [$data[184][5], $data[184][6], $data[184][7]]; 
$Kvalue_185 = [$data[185][2], $data[185][3], $data[185][4]]; $Lvalue_185 = [$data[185][5], $data[185][6], $data[185][7]];
$Kvalue_186 = [$data[186][2], $data[186][3], $data[186][4]]; $Lvalue_186 = [$data[186][5], $data[186][6], $data[186][7]];
$Kvalue_187 = [$data[187][2], $data[187][3], $data[187][4]]; $Lvalue_187 = [$data[187][5], $data[187][6], $data[187][7]]; 
$Kvalue_188 = [$data[188][2], $data[188][3], $data[188][4]]; $Lvalue_188 = [$data[188][5], $data[188][6], $data[188][7]];
$Kvalue_189 = [$data[189][2], $data[189][3], $data[189][4]]; $Lvalue_189 = [$data[189][5], $data[189][6], $data[189][7]];
$Kvalue_190 = [$data[190][2], $data[190][3], $data[190][4]]; $Lvalue_190 = [$data[190][5], $data[190][6], $data[190][7]];
$Kvalue_191 = [$data[191][2], $data[191][3], $data[191][4]]; $Lvalue_191 = [$data[191][5], $data[191][6], $data[191][7]]; 
$Kvalue_192 = [$data[192][2], $data[192][3], $data[192][4]]; $Lvalue_192 = [$data[192][5], $data[192][6], $data[192][7]];
$Kvalue_193 = [$data[193][2], $data[193][3], $data[193][4]]; $Lvalue_193 = [$data[193][5], $data[193][6], $data[193][7]];
$Kvalue_194 = [$data[194][2], $data[194][3], $data[194][4]]; $Lvalue_194 = [$data[194][5], $data[194][6], $data[194][7]]; 
$Kvalue_195 = [$data[195][2], $data[195][3], $data[195][4]]; $Lvalue_195 = [$data[195][5], $data[195][6], $data[195][7]];
$Kvalue_196 = [$data[196][2], $data[196][3], $data[196][4]]; $Lvalue_196 = [$data[196][5], $data[196][6], $data[196][7]];
$Kvalue_197 = [$data[197][2], $data[197][3], $data[197][4]]; $Lvalue_197 = [$data[197][5], $data[197][6], $data[197][7]]; 
$Kvalue_198 = [$data[198][2], $data[198][3], $data[198][4]]; $Lvalue_198 = [$data[198][5], $data[198][6], $data[198][7]];
$Kvalue_199 = [$data[199][2], $data[199][3], $data[199][4]]; $Lvalue_199 = [$data[199][5], $data[199][6], $data[199][7]];
$Kvalue_200 = [$data[200][2], $data[200][3], $data[200][4]]; $Lvalue_200 = [$data[200][5], $data[200][6], $data[200][7]];
$Kvalue_201 = [$data[201][2], $data[201][3], $data[201][4]]; $Lvalue_201 = [$data[201][5], $data[201][6], $data[201][7]]; 
$Kvalue_202 = [$data[202][2], $data[202][3], $data[202][4]]; $Lvalue_202 = [$data[202][5], $data[202][6], $data[202][7]];
$Kvalue_203 = [$data[203][2], $data[203][3], $data[203][4]]; $Lvalue_203 = [$data[203][5], $data[203][6], $data[203][7]];
$Kvalue_204 = [$data[204][2], $data[204][3], $data[204][4]]; $Lvalue_204 = [$data[204][5], $data[204][6], $data[204][7]]; 
$Kvalue_205 = [$data[205][2], $data[205][3], $data[205][4]]; $Lvalue_205 = [$data[205][5], $data[205][6], $data[205][7]];
$Kvalue_206 = [$data[206][2], $data[206][3], $data[206][4]]; $Lvalue_206 = [$data[206][5], $data[206][6], $data[206][7]];
$Kvalue_207 = [$data[207][2], $data[207][3], $data[207][4]]; $Lvalue_207 = [$data[207][5], $data[207][6], $data[207][7]]; 
$Kvalue_208 = [$data[208][2], $data[208][3], $data[208][4]]; $Lvalue_208 = [$data[208][5], $data[208][6], $data[208][7]];
$Kvalue_209 = [$data[209][2], $data[209][3], $data[209][4]]; $Lvalue_209 = [$data[209][5], $data[209][6], $data[209][7]];
$Kvalue_210 = [$data[210][2], $data[210][3], $data[210][4]]; $Lvalue_210 = [$data[210][5], $data[210][6], $data[210][7]];
$Kvalue_211 = [$data[211][2], $data[211][3], $data[211][4]]; $Lvalue_211 = [$data[211][5], $data[211][6], $data[211][7]]; 
$Kvalue_212 = [$data[212][2], $data[212][3], $data[212][4]]; $Lvalue_212 = [$data[212][5], $data[212][6], $data[212][7]];
$Kvalue_213 = [$data[213][2], $data[213][3], $data[213][4]]; $Lvalue_213 = [$data[213][5], $data[213][6], $data[213][7]];
$Kvalue_214 = [$data[214][2], $data[214][3], $data[214][4]]; $Lvalue_214 = [$data[214][5], $data[214][6], $data[214][7]]; 
$Kvalue_215 = [$data[215][2], $data[215][3], $data[215][4]]; $Lvalue_215 = [$data[215][5], $data[215][6], $data[215][7]];
$Kvalue_216 = [$data[216][2], $data[216][3], $data[216][4]]; $Lvalue_216 = [$data[216][5], $data[216][6], $data[216][7]];
$Kvalue_217 = [$data[217][2], $data[217][3], $data[217][4]]; $Lvalue_217 = [$data[217][5], $data[217][6], $data[217][7]]; 
$Kvalue_218 = [$data[218][2], $data[218][3], $data[218][4]]; $Lvalue_218 = [$data[218][5], $data[218][6], $data[218][7]];
$Kvalue_219 = [$data[219][2], $data[219][3], $data[219][4]]; $Lvalue_219 = [$data[219][5], $data[219][6], $data[219][7]];
$Kvalue_220 = [$data[220][2], $data[220][3], $data[220][4]]; $Lvalue_220 = [$data[220][5], $data[220][6], $data[220][7]];
$Kvalue_221 = [$data[221][2], $data[221][3], $data[221][4]]; $Lvalue_221 = [$data[221][5], $data[221][6], $data[221][7]]; 
$Kvalue_222 = [$data[222][2], $data[222][3], $data[222][4]]; $Lvalue_222 = [$data[222][5], $data[222][6], $data[222][7]];
$Kvalue_223 = [$data[223][2], $data[223][3], $data[223][4]]; $Lvalue_223 = [$data[223][5], $data[223][6], $data[223][7]];
$Kvalue_224 = [$data[224][2], $data[224][3], $data[224][4]]; $Lvalue_224 = [$data[224][5], $data[224][6], $data[224][7]]; 
$Kvalue_225 = [$data[225][2], $data[225][3], $data[225][4]]; $Lvalue_225 = [$data[225][5], $data[225][6], $data[225][7]];
$Kvalue_226 = [$data[226][2], $data[226][3], $data[226][4]]; $Lvalue_226 = [$data[226][5], $data[226][6], $data[226][7]];
$Kvalue_227 = [$data[227][2], $data[227][3], $data[227][4]]; $Lvalue_227 = [$data[227][5], $data[227][6], $data[227][7]]; 
$Kvalue_228 = [$data[228][2], $data[228][3], $data[228][4]]; $Lvalue_228 = [$data[228][5], $data[228][6], $data[228][7]];
$Kvalue_229 = [$data[229][2], $data[229][3], $data[229][4]]; $Lvalue_229 = [$data[229][5], $data[229][6], $data[229][7]];
$Kvalue_230 = [$data[230][2], $data[230][3], $data[230][4]]; $Lvalue_230 = [$data[230][5], $data[230][6], $data[230][7]];
$Kvalue_231 = [$data[231][2], $data[231][3], $data[231][4]]; $Lvalue_231 = [$data[231][5], $data[231][6], $data[231][7]]; 
$Kvalue_232 = [$data[232][2], $data[232][3], $data[232][4]]; $Lvalue_232 = [$data[232][5], $data[232][6], $data[232][7]];
$Kvalue_233 = [$data[233][2], $data[233][3], $data[233][4]]; $Lvalue_233 = [$data[233][5], $data[233][6], $data[233][7]];
$Kvalue_234 = [$data[234][2], $data[234][3], $data[234][4]]; $Lvalue_234 = [$data[234][5], $data[234][6], $data[234][7]]; 
$Kvalue_235 = [$data[235][2], $data[235][3], $data[235][4]]; $Lvalue_235 = [$data[235][5], $data[235][6], $data[235][7]];
$Kvalue_236 = [$data[236][2], $data[236][3], $data[236][4]]; $Lvalue_236 = [$data[236][5], $data[236][6], $data[236][7]];
$Kvalue_237 = [$data[237][2], $data[237][3], $data[237][4]]; $Lvalue_237 = [$data[237][5], $data[237][6], $data[237][7]]; 
$Kvalue_238 = [$data[238][2], $data[238][3], $data[238][4]]; $Lvalue_238 = [$data[238][5], $data[238][6], $data[238][7]];
$Kvalue_239 = [$data[239][2], $data[239][3], $data[239][4]]; $Lvalue_239 = [$data[239][5], $data[239][6], $data[239][7]];
$Kvalue_240 = [$data[240][2], $data[240][3], $data[240][4]]; $Lvalue_240 = [$data[240][5], $data[240][6], $data[240][7]];
$Kvalue_241 = [$data[241][2], $data[241][3], $data[241][4]]; $Lvalue_241 = [$data[241][5], $data[241][6], $data[241][7]]; 
$Kvalue_242 = [$data[242][2], $data[242][3], $data[242][4]]; $Lvalue_242 = [$data[242][5], $data[242][6], $data[242][7]];
$Kvalue_243 = [$data[243][2], $data[243][3], $data[243][4]]; $Lvalue_243 = [$data[243][5], $data[243][6], $data[243][7]];
$Kvalue_244 = [$data[244][2], $data[244][3], $data[244][4]]; $Lvalue_244 = [$data[244][5], $data[244][6], $data[244][7]]; 
$Kvalue_245 = [$data[245][2], $data[245][3], $data[245][4]]; $Lvalue_245 = [$data[245][5], $data[245][6], $data[245][7]];
$Kvalue_246 = [$data[246][2], $data[246][3], $data[246][4]]; $Lvalue_246 = [$data[246][5], $data[246][6], $data[246][7]];
$Kvalue_247 = [$data[247][2], $data[247][3], $data[247][4]]; $Lvalue_247 = [$data[247][5], $data[247][6], $data[247][7]]; 
$Kvalue_248 = [$data[248][2], $data[248][3], $data[248][4]]; $Lvalue_248 = [$data[248][5], $data[248][6], $data[248][7]];
$Kvalue_249 = [$data[249][2], $data[249][3], $data[249][4]]; $Lvalue_249 = [$data[249][5], $data[249][6], $data[249][7]];
$Kvalue_250 = [$data[250][2], $data[250][3], $data[250][4]]; $Lvalue_250 = [$data[250][5], $data[250][6], $data[250][7]];
$Kvalue_251 = [$data[251][2], $data[251][3], $data[251][4]]; $Lvalue_251 = [$data[251][5], $data[251][6], $data[251][7]]; 
$Kvalue_252 = [$data[252][2], $data[252][3], $data[252][4]]; $Lvalue_252 = [$data[252][5], $data[252][6], $data[252][7]];
$Kvalue_253 = [$data[253][2], $data[253][3], $data[253][4]]; $Lvalue_253 = [$data[253][5], $data[253][6], $data[253][7]];
$Kvalue_254 = [$data[254][2], $data[254][3], $data[254][4]]; $Lvalue_254 = [$data[254][5], $data[254][6], $data[254][7]]; 
$Kvalue_255 = [$data[255][2], $data[255][3], $data[255][4]]; $Lvalue_255 = [$data[255][5], $data[255][6], $data[255][7]];
$Kvalue_256 = [$data[256][2], $data[256][3], $data[256][4]]; $Lvalue_256 = [$data[256][5], $data[256][6], $data[256][7]];
$Kvalue_257 = [$data[257][2], $data[257][3], $data[257][4]]; $Lvalue_257 = [$data[257][5], $data[257][6], $data[257][7]]; 
$Kvalue_258 = [$data[258][2], $data[258][3], $data[258][4]]; $Lvalue_258 = [$data[258][5], $data[258][6], $data[258][7]];
$Kvalue_259 = [$data[259][2], $data[259][3], $data[259][4]]; $Lvalue_259 = [$data[259][5], $data[259][6], $data[259][7]];
$Kvalue_260 = [$data[260][2], $data[260][3], $data[260][4]]; $Lvalue_260 = [$data[260][5], $data[260][6], $data[260][7]];
$Kvalue_261 = [$data[261][2], $data[261][3], $data[261][4]]; $Lvalue_261 = [$data[261][5], $data[261][6], $data[261][7]]; 
$Kvalue_262 = [$data[262][2], $data[262][3], $data[262][4]]; $Lvalue_262 = [$data[262][5], $data[262][6], $data[262][7]];
$Kvalue_263 = [$data[263][2], $data[263][3], $data[263][4]]; $Lvalue_263 = [$data[263][5], $data[263][6], $data[263][7]];
$Kvalue_264 = [$data[264][2], $data[264][3], $data[264][4]]; $Lvalue_264 = [$data[264][5], $data[264][6], $data[264][7]]; 
$Kvalue_265 = [$data[265][2], $data[265][3], $data[265][4]]; $Lvalue_265 = [$data[265][5], $data[265][6], $data[265][7]];
$Kvalue_266 = [$data[266][2], $data[266][3], $data[266][4]]; $Lvalue_266 = [$data[266][5], $data[266][6], $data[266][7]];
$Kvalue_267 = [$data[267][2], $data[267][3], $data[267][4]]; $Lvalue_267 = [$data[267][5], $data[267][6], $data[267][7]]; 
$Kvalue_268 = [$data[268][2], $data[268][3], $data[268][4]]; $Lvalue_268 = [$data[268][5], $data[268][6], $data[268][7]];
$Kvalue_269 = [$data[269][2], $data[269][3], $data[269][4]]; $Lvalue_269 = [$data[269][5], $data[269][6], $data[269][7]];
$Kvalue_270 = [$data[270][2], $data[270][3], $data[270][4]]; $Lvalue_270 = [$data[270][5], $data[270][6], $data[270][7]];
$Kvalue_271 = [$data[271][2], $data[271][3], $data[271][4]]; $Lvalue_271 = [$data[271][5], $data[271][6], $data[271][7]]; 
$Kvalue_272 = [$data[272][2], $data[272][3], $data[272][4]]; $Lvalue_272 = [$data[272][5], $data[272][6], $data[272][7]];
$Kvalue_273 = [$data[273][2], $data[273][3], $data[273][4]]; $Lvalue_273 = [$data[273][5], $data[273][6], $data[273][7]];
$Kvalue_274 = [$data[274][2], $data[274][3], $data[274][4]]; $Lvalue_274 = [$data[274][5], $data[274][6], $data[274][7]]; 
$Kvalue_275 = [$data[275][2], $data[275][3], $data[275][4]]; $Lvalue_275 = [$data[275][5], $data[275][6], $data[275][7]];
$Kvalue_276 = [$data[276][2], $data[276][3], $data[276][4]]; $Lvalue_276 = [$data[276][5], $data[276][6], $data[276][7]];
$Kvalue_277 = [$data[277][2], $data[277][3], $data[277][4]]; $Lvalue_277 = [$data[277][5], $data[277][6], $data[277][7]]; 
$Kvalue_278 = [$data[278][2], $data[278][3], $data[278][4]]; $Lvalue_278 = [$data[278][5], $data[278][6], $data[278][7]];
$Kvalue_279 = [$data[279][2], $data[279][3], $data[279][4]]; $Lvalue_279 = [$data[279][5], $data[279][6], $data[279][7]];
$Kvalue_280 = [$data[280][2], $data[280][3], $data[280][4]]; $Lvalue_280 = [$data[280][5], $data[280][6], $data[280][7]];
$Kvalue_281 = [$data[281][2], $data[281][3], $data[281][4]]; $Lvalue_281 = [$data[281][5], $data[281][6], $data[281][7]]; 
$Kvalue_282 = [$data[282][2], $data[282][3], $data[282][4]]; $Lvalue_282 = [$data[282][5], $data[282][6], $data[282][7]];
$Kvalue_283 = [$data[283][2], $data[283][3], $data[283][4]]; $Lvalue_283 = [$data[283][5], $data[283][6], $data[283][7]];
$Kvalue_284 = [$data[284][2], $data[284][3], $data[284][4]]; $Lvalue_284 = [$data[284][5], $data[284][6], $data[284][7]]; 
$Kvalue_285 = [$data[285][2], $data[285][3], $data[285][4]]; $Lvalue_285 = [$data[285][5], $data[285][6], $data[285][7]];
$Kvalue_286 = [$data[286][2], $data[286][3], $data[286][4]]; $Lvalue_286 = [$data[286][5], $data[286][6], $data[286][7]];
$Kvalue_287 = [$data[287][2], $data[287][3], $data[287][4]]; $Lvalue_287 = [$data[287][5], $data[287][6], $data[287][7]]; 
$Kvalue_288 = [$data[288][2], $data[288][3], $data[288][4]]; $Lvalue_288 = [$data[288][5], $data[288][6], $data[288][7]];
$Kvalue_289 = [$data[289][2], $data[289][3], $data[289][4]]; $Lvalue_289 = [$data[289][5], $data[289][6], $data[289][7]];
$Kvalue_290 = [$data[290][2], $data[290][3], $data[290][4]]; $Lvalue_290 = [$data[290][5], $data[290][6], $data[290][7]];
$Kvalue_291 = [$data[291][2], $data[291][3], $data[291][4]]; $Lvalue_291 = [$data[291][5], $data[291][6], $data[291][7]]; 
$Kvalue_292 = [$data[292][2], $data[292][3], $data[292][4]]; $Lvalue_292 = [$data[292][5], $data[292][6], $data[292][7]];
$Kvalue_293 = [$data[293][2], $data[293][3], $data[293][4]]; $Lvalue_293 = [$data[293][5], $data[293][6], $data[293][7]];
$Kvalue_294 = [$data[294][2], $data[294][3], $data[294][4]]; $Lvalue_294 = [$data[294][5], $data[294][6], $data[294][7]]; 
$Kvalue_295 = [$data[295][2], $data[295][3], $data[295][4]]; $Lvalue_295 = [$data[295][5], $data[295][6], $data[295][7]];
$Kvalue_296 = [$data[296][2], $data[296][3], $data[296][4]]; $Lvalue_296 = [$data[296][5], $data[296][6], $data[296][7]];
$Kvalue_297 = [$data[297][2], $data[297][3], $data[297][4]]; $Lvalue_297 = [$data[297][5], $data[297][6], $data[297][7]]; 
$Kvalue_298 = [$data[298][2], $data[298][3], $data[298][4]]; $Lvalue_298 = [$data[298][5], $data[298][6], $data[298][7]];
$Kvalue_299 = [$data[299][2], $data[299][3], $data[299][4]]; $Lvalue_299 = [$data[299][5], $data[299][6], $data[299][7]];
$Kvalue_300 = [$data[300][2], $data[300][3], $data[300][4]]; $Lvalue_300 = [$data[300][5], $data[300][6], $data[300][7]];
$Kvalue_301 = [$data[301][2], $data[301][3], $data[301][4]]; $Lvalue_301 = [$data[301][5], $data[301][6], $data[301][7]]; 
$Kvalue_302 = [$data[302][2], $data[302][3], $data[302][4]]; $Lvalue_302 = [$data[302][5], $data[302][6], $data[302][7]];
$Kvalue_303 = [$data[303][2], $data[303][3], $data[303][4]]; $Lvalue_303 = [$data[303][5], $data[303][6], $data[303][7]];
$Kvalue_304 = [$data[304][2], $data[304][3], $data[304][4]]; $Lvalue_304 = [$data[304][5], $data[304][6], $data[304][7]]; 
$Kvalue_305 = [$data[305][2], $data[305][3], $data[305][4]]; $Lvalue_305 = [$data[305][5], $data[305][6], $data[305][7]];
$Kvalue_306 = [$data[306][2], $data[306][3], $data[306][4]]; $Lvalue_306 = [$data[306][5], $data[306][6], $data[306][7]];
$Kvalue_307 = [$data[307][2], $data[307][3], $data[307][4]]; $Lvalue_307 = [$data[307][5], $data[307][6], $data[307][7]]; 
$Kvalue_308 = [$data[308][2], $data[308][3], $data[308][4]]; $Lvalue_308 = [$data[308][5], $data[308][6], $data[308][7]];
$Kvalue_309 = [$data[309][2], $data[309][3], $data[309][4]]; $Lvalue_309 = [$data[309][5], $data[309][6], $data[309][7]];
$Kvalue_310 = [$data[310][2], $data[310][3], $data[310][4]]; $Lvalue_310 = [$data[310][5], $data[310][6], $data[310][7]];
$Kvalue_311 = [$data[311][2], $data[311][3], $data[311][4]]; $Lvalue_311 = [$data[311][5], $data[311][6], $data[311][7]]; 
$Kvalue_312 = [$data[312][2], $data[312][3], $data[312][4]]; $Lvalue_312 = [$data[312][5], $data[312][6], $data[312][7]];
$Kvalue_313 = [$data[313][2], $data[313][3], $data[313][4]]; $Lvalue_313 = [$data[313][5], $data[313][6], $data[313][7]];
$Kvalue_314 = [$data[314][2], $data[314][3], $data[314][4]]; $Lvalue_314 = [$data[314][5], $data[314][6], $data[314][7]]; 
$Kvalue_315 = [$data[315][2], $data[315][3], $data[315][4]]; $Lvalue_315 = [$data[315][5], $data[315][6], $data[315][7]];
$Kvalue_316 = [$data[316][2], $data[316][3], $data[316][4]]; $Lvalue_316 = [$data[316][5], $data[316][6], $data[316][7]];
$Kvalue_317 = [$data[317][2], $data[317][3], $data[317][4]]; $Lvalue_317 = [$data[317][5], $data[317][6], $data[317][7]]; 
$Kvalue_318 = [$data[318][2], $data[318][3], $data[318][4]]; $Lvalue_318 = [$data[318][5], $data[318][6], $data[318][7]];
$Kvalue_319 = [$data[319][2], $data[319][3], $data[319][4]]; $Lvalue_319 = [$data[319][5], $data[319][6], $data[319][7]];
$Kvalue_320 = [$data[320][2], $data[320][3], $data[320][4]]; $Lvalue_320 = [$data[320][5], $data[320][6], $data[320][7]];
$Kvalue_321 = [$data[321][2], $data[321][3], $data[321][4]]; $Lvalue_321 = [$data[321][5], $data[321][6], $data[321][7]]; 
$Kvalue_322 = [$data[322][2], $data[322][3], $data[322][4]]; $Lvalue_322 = [$data[322][5], $data[322][6], $data[322][7]];
$Kvalue_323 = [$data[323][2], $data[323][3], $data[323][4]]; $Lvalue_323 = [$data[323][5], $data[323][6], $data[323][7]];
$Kvalue_324 = [$data[324][2], $data[324][3], $data[324][4]]; $Lvalue_324 = [$data[324][5], $data[324][6], $data[324][7]]; 
$Kvalue_325 = [$data[325][2], $data[325][3], $data[325][4]]; $Lvalue_325 = [$data[325][5], $data[325][6], $data[325][7]];
$Kvalue_326 = [$data[326][2], $data[326][3], $data[326][4]]; $Lvalue_326 = [$data[326][5], $data[326][6], $data[326][7]];
$Kvalue_327 = [$data[327][2], $data[327][3], $data[327][4]]; $Lvalue_327 = [$data[327][5], $data[327][6], $data[327][7]]; 
$Kvalue_328 = [$data[328][2], $data[328][3], $data[328][4]]; $Lvalue_328 = [$data[328][5], $data[328][6], $data[328][7]];
$Kvalue_329 = [$data[329][2], $data[329][3], $data[329][4]]; $Lvalue_329 = [$data[329][5], $data[329][6], $data[329][7]];
$Kvalue_330 = [$data[330][2], $data[330][3], $data[330][4]]; $Lvalue_330 = [$data[330][5], $data[330][6], $data[330][7]];
$Kvalue_331 = [$data[331][2], $data[331][3], $data[331][4]]; $Lvalue_331 = [$data[331][5], $data[331][6], $data[331][7]]; 
$Kvalue_332 = [$data[332][2], $data[332][3], $data[332][4]]; $Lvalue_332 = [$data[332][5], $data[332][6], $data[332][7]];
$Kvalue_333 = [$data[333][2], $data[333][3], $data[333][4]]; $Lvalue_333 = [$data[333][5], $data[333][6], $data[333][7]];
$Kvalue_334 = [$data[334][2], $data[334][3], $data[334][4]]; $Lvalue_334 = [$data[334][5], $data[334][6], $data[334][7]]; 
$Kvalue_335 = [$data[335][2], $data[335][3], $data[335][4]]; $Lvalue_335 = [$data[335][5], $data[335][6], $data[335][7]];
$Kvalue_336 = [$data[336][2], $data[336][3], $data[336][4]]; $Lvalue_336 = [$data[336][5], $data[336][6], $data[336][7]];
$Kvalue_337 = [$data[337][2], $data[337][3], $data[337][4]]; $Lvalue_337 = [$data[337][5], $data[337][6], $data[337][7]]; 
$Kvalue_338 = [$data[338][2], $data[338][3], $data[338][4]]; $Lvalue_338 = [$data[338][5], $data[338][6], $data[338][7]];
$Kvalue_339 = [$data[339][2], $data[339][3], $data[339][4]]; $Lvalue_339 = [$data[339][5], $data[339][6], $data[339][7]];
$Kvalue_340 = [$data[340][2], $data[340][3], $data[340][4]]; $Lvalue_340 = [$data[340][5], $data[340][6], $data[340][7]];
$Kvalue_341 = [$data[341][2], $data[341][3], $data[341][4]]; $Lvalue_341 = [$data[341][5], $data[341][6], $data[341][7]]; 
$Kvalue_342 = [$data[342][2], $data[342][3], $data[342][4]]; $Lvalue_342 = [$data[342][5], $data[342][6], $data[342][7]];
$Kvalue_343 = [$data[343][2], $data[343][3], $data[343][4]]; $Lvalue_343 = [$data[343][5], $data[343][6], $data[343][7]];
$Kvalue_344 = [$data[344][2], $data[344][3], $data[344][4]]; $Lvalue_344 = [$data[344][5], $data[344][6], $data[344][7]]; 
$Kvalue_345 = [$data[345][2], $data[345][3], $data[345][4]]; $Lvalue_345 = [$data[345][5], $data[345][6], $data[345][7]];
$Kvalue_346 = [$data[346][2], $data[346][3], $data[346][4]]; $Lvalue_346 = [$data[346][5], $data[346][6], $data[346][7]];
$Kvalue_347 = [$data[347][2], $data[347][3], $data[347][4]]; $Lvalue_347 = [$data[347][5], $data[347][6], $data[347][7]]; 
$Kvalue_348 = [$data[348][2], $data[348][3], $data[348][4]]; $Lvalue_348 = [$data[348][5], $data[348][6], $data[348][7]];
$Kvalue_349 = [$data[349][2], $data[349][3], $data[349][4]]; $Lvalue_349 = [$data[349][5], $data[349][6], $data[349][7]];
$Kvalue_350 = [$data[350][2], $data[350][3], $data[350][4]]; $Lvalue_350 = [$data[350][5], $data[350][6], $data[350][7]];
$Kvalue_351 = [$data[351][2], $data[351][3], $data[351][4]]; $Lvalue_351 = [$data[351][5], $data[351][6], $data[351][7]]; 
$Kvalue_352 = [$data[352][2], $data[352][3], $data[352][4]]; $Lvalue_352 = [$data[352][5], $data[352][6], $data[352][7]];
$Kvalue_353 = [$data[353][2], $data[353][3], $data[353][4]]; $Lvalue_353 = [$data[353][5], $data[353][6], $data[353][7]];
$Kvalue_354 = [$data[354][2], $data[354][3], $data[354][4]]; $Lvalue_354 = [$data[354][5], $data[354][6], $data[354][7]]; 
$Kvalue_355 = [$data[355][2], $data[355][3], $data[355][4]]; $Lvalue_355 = [$data[355][5], $data[355][6], $data[355][7]];
$Kvalue_356 = [$data[356][2], $data[356][3], $data[356][4]]; $Lvalue_356 = [$data[356][5], $data[356][6], $data[356][7]];
$Kvalue_357 = [$data[357][2], $data[357][3], $data[357][4]]; $Lvalue_357 = [$data[357][5], $data[357][6], $data[357][7]]; 
$Kvalue_358 = [$data[358][2], $data[358][3], $data[358][4]]; $Lvalue_358 = [$data[358][5], $data[358][6], $data[358][7]];
$Kvalue_359 = [$data[359][2], $data[359][3], $data[359][4]]; $Lvalue_359 = [$data[359][5], $data[359][6], $data[359][7]];
$Kvalue_360 = [$data[360][2], $data[360][3], $data[360][4]]; $Lvalue_360 = [$data[360][5], $data[360][6], $data[360][7]];
$Kvalue_361 = [$data[361][2], $data[361][3], $data[361][4]]; $Lvalue_361 = [$data[361][5], $data[361][6], $data[361][7]]; 
$Kvalue_362 = [$data[362][2], $data[362][3], $data[362][4]]; $Lvalue_362 = [$data[362][5], $data[362][6], $data[362][7]];
$Kvalue_363 = [$data[363][2], $data[363][3], $data[363][4]]; $Lvalue_363 = [$data[363][5], $data[363][6], $data[363][7]];
$Kvalue_364 = [$data[364][2], $data[364][3], $data[364][4]]; $Lvalue_364 = [$data[364][5], $data[364][6], $data[364][7]]; 
$Kvalue_365 = [$data[365][2], $data[365][3], $data[365][4]]; $Lvalue_365 = [$data[365][5], $data[365][6], $data[365][7]];
$Kvalue_366 = [$data[366][2], $data[366][3], $data[366][4]]; $Lvalue_366 = [$data[366][5], $data[366][6], $data[366][7]];
$Kvalue_367 = [$data[367][2], $data[367][3], $data[367][4]]; $Lvalue_367 = [$data[367][5], $data[367][6], $data[367][7]]; 
$Kvalue_368 = [$data[368][2], $data[368][3], $data[368][4]]; $Lvalue_368 = [$data[368][5], $data[368][6], $data[368][7]];
$Kvalue_369 = [$data[369][2], $data[369][3], $data[369][4]]; $Lvalue_369 = [$data[369][5], $data[369][6], $data[369][7]];
$Kvalue_370 = [$data[370][2], $data[370][3], $data[370][4]]; $Lvalue_370 = [$data[370][5], $data[370][6], $data[370][7]];
$Kvalue_371 = [$data[371][2], $data[371][3], $data[371][4]]; $Lvalue_371 = [$data[371][5], $data[371][6], $data[371][7]]; 
$Kvalue_372 = [$data[372][2], $data[372][3], $data[372][4]]; $Lvalue_372 = [$data[372][5], $data[372][6], $data[372][7]];
$Kvalue_373 = [$data[373][2], $data[373][3], $data[373][4]]; $Lvalue_373 = [$data[373][5], $data[373][6], $data[373][7]];
$Kvalue_374 = [$data[374][2], $data[374][3], $data[374][4]]; $Lvalue_374 = [$data[374][5], $data[374][6], $data[374][7]]; 
$Kvalue_375 = [$data[375][2], $data[375][3], $data[375][4]]; $Lvalue_375 = [$data[375][5], $data[375][6], $data[375][7]];
$Kvalue_376 = [$data[376][2], $data[376][3], $data[376][4]]; $Lvalue_376 = [$data[376][5], $data[376][6], $data[376][7]];
$Kvalue_377 = [$data[377][2], $data[377][3], $data[377][4]]; $Lvalue_377 = [$data[377][5], $data[377][6], $data[377][7]]; 
$Kvalue_378 = [$data[378][2], $data[378][3], $data[378][4]]; $Lvalue_378 = [$data[378][5], $data[378][6], $data[378][7]];
$Kvalue_379 = [$data[379][2], $data[379][3], $data[379][4]]; $Lvalue_379 = [$data[379][5], $data[379][6], $data[379][7]];
$Kvalue_380 = [$data[380][2], $data[380][3], $data[380][4]]; $Lvalue_380 = [$data[380][5], $data[380][6], $data[380][7]];
$Kvalue_381 = [$data[381][2], $data[381][3], $data[381][4]]; $Lvalue_381 = [$data[381][5], $data[381][6], $data[381][7]]; 
$Kvalue_382 = [$data[382][2], $data[382][3], $data[382][4]]; $Lvalue_382 = [$data[382][5], $data[382][6], $data[382][7]];
$Kvalue_383 = [$data[383][2], $data[383][3], $data[383][4]]; $Lvalue_383 = [$data[383][5], $data[383][6], $data[383][7]];
$Kvalue_384 = [$data[384][2], $data[384][3], $data[384][4]]; $Lvalue_384 = [$data[384][5], $data[384][6], $data[384][7]]; 
$Kvalue_385 = [$data[385][2], $data[385][3], $data[385][4]]; $Lvalue_385 = [$data[385][5], $data[385][6], $data[385][7]];
$Kvalue_386 = [$data[386][2], $data[386][3], $data[386][4]]; $Lvalue_386 = [$data[386][5], $data[386][6], $data[386][7]];
$Kvalue_387 = [$data[387][2], $data[387][3], $data[387][4]]; $Lvalue_387 = [$data[387][5], $data[387][6], $data[387][7]]; 
$Kvalue_388 = [$data[388][2], $data[388][3], $data[388][4]]; $Lvalue_388 = [$data[388][5], $data[388][6], $data[388][7]];
$Kvalue_389 = [$data[389][2], $data[389][3], $data[389][4]]; $Lvalue_389 = [$data[389][5], $data[389][6], $data[389][7]];
$Kvalue_390 = [$data[390][2], $data[390][3], $data[390][4]]; $Lvalue_390 = [$data[390][5], $data[390][6], $data[390][7]];
$Kvalue_391 = [$data[391][2], $data[391][3], $data[391][4]]; $Lvalue_391 = [$data[391][5], $data[391][6], $data[391][7]]; 
$Kvalue_392 = [$data[392][2], $data[392][3], $data[392][4]]; $Lvalue_392 = [$data[392][5], $data[392][6], $data[392][7]];
$Kvalue_393 = [$data[393][2], $data[393][3], $data[393][4]]; $Lvalue_393 = [$data[393][5], $data[393][6], $data[393][7]];
$Kvalue_394 = [$data[394][2], $data[394][3], $data[394][4]]; $Lvalue_394 = [$data[394][5], $data[394][6], $data[394][7]]; 
$Kvalue_395 = [$data[395][2], $data[395][3], $data[395][4]]; $Lvalue_395 = [$data[395][5], $data[395][6], $data[395][7]];
$Kvalue_396 = [$data[396][2], $data[396][3], $data[396][4]]; $Lvalue_396 = [$data[396][5], $data[396][6], $data[396][7]];
$Kvalue_397 = [$data[397][2], $data[397][3], $data[397][4]]; $Lvalue_397 = [$data[397][5], $data[397][6], $data[397][7]]; 
$Kvalue_398 = [$data[398][2], $data[398][3], $data[398][4]]; $Lvalue_398 = [$data[398][5], $data[398][6], $data[398][7]];
$Kvalue_399 = [$data[399][2], $data[399][3], $data[399][4]]; $Lvalue_399 = [$data[399][5], $data[399][6], $data[399][7]];


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
                                         
                                      ]
                                ]];


                //print_r($str);exit;
				  $str = json_encode($str);
                  //print_r($str);exit();
          
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

                //print_r($paylod);exit;

                $response = push_to_kpi_dashboard($paylod);

                print 'RESPONSE: ' . print_r($response, true);
                print '
';
            } else {
                print $date_row->datadate . 'Error: Data not found.';
                die();
            }

            	//$msg = json_decode($response,true);
      /*           try {
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
*/
            print '
';
            $i ++;
        }
    }
}

