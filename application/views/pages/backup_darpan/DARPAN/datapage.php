<div class="container">
    <div class="row">
         <?php
        require_once 'dbconfig.php';
        //define("key256", 'ecPäUšÎjtÎ,ý@KÍŠº<™tg"sü+');
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // execute the stored procedure
            $p_flag = 'GD';
            $P_State_Code = 0;
            $P_Sec_Code = 44;
            $P_Dept_Code = 287;
            $P_Project_Code = 70043;
            $P_Datef = '2020-01-01';
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
            //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //$q->setFetchMode(PDO::FETCH_ASSOC);
            /*$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            print_r($result);*/

            $url="http://api.dashboard.nic.in/MDREST/api/DateRange";
                  $data = $result;
                  $ch = curl_init($url);
                  # Setup request to send json via POST.
                  $myObj = new \stdClass();
                  $myObj->mcode = 103;
                  $myObj->state_code = 0;
                  $myObj->dept_code = 287;
                  $myObj->project_code = 70043;
                  $myObj->sec_code = 44;

                  //$myObj1 = new \stdClass();
                  //$myObj1->RetDMDashCaption = array(array('DATE_DD_MM_YYYY' => $P_Datef , 'DATE_MM_DD_YYYY' => $P_Datet));
                  /*$myObj1->Records = array($data);*/
                  /*$result['logged_in'] = true;
                  $key = 'SuperSecretKeyss';
                  $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, 'I want to encrypt this', MCRYPT_MODE_ECB);
                  $result['payload'] = base64_encode($encrypted);
                  echo "<br>";
                  echo "<br>";
                  print_r($result);
                  echo "<br>";
                  echo "<br>";
                  echo 'authCallback(' . json_encode( $result, JSON_UNESCAPED_UNICODE ) . ')';*/
                 
                  $RetDMDashCaption = json_encode($myObj);
                  //$payload = md5(json_encode($myObj1->Records));
                  //$payload = json_encode("Records",array($data));
                  //$payload = json_encode("Records"=> $data);
                  echo "<br>";
                  echo "<br>";
                  echo $RetDMDashCaption;
                   echo "<br>";
                  echo "<br>";
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $RetDMDashCaption );
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                  # Return response instead of printing.
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                  # Send request.
                  $res = curl_exec($ch);
                  curl_close($ch);
                  # Print response.
                  echo "<pre>" . $res. "</pre>";

        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                 <th scope="col">State_Code</th>
                 <th scope="col">District_Code</th>
                 <!-- <th scope="col">Teh_Code</th>
                 <th scope="col">Blk_Code</th>
                 <th scope="col">Sector_Code</th>
                 <th scope="col">Gp_Code</th>
                 <th scope="col">Vill_Code</th>
                 <th scope="col">Dept_Code</th>
                 <th scope="col">Project_Code</th>
                 <th scope="col">Cnt1</th>
                 <th scope="col">Cnt2</th>
                 <th scope="col">Cnt3</th>
                 <th scope="col">Cnt4</th>
                 <th scope="col">Cnt5</th> -->
                 <th scope="col">Dataportmode</th>
                 <th scope="col">Modedesc</th>
                 <th scope="col">Data_Lvl_Code</th>
                 <th scope="col">Yr</th>
                 <th scope="col">Mnth</th>
                 <th scope="col">Datadt</th>
                 <th scope="col">msg</th>
                 <th scope="col">msg2</th>
            </tr>
          </thead>
            <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)):
                  //print_r($result);
                  /*$data = $result;
                  $ch = curl_init("http://api.dashboard.nic.in/MDREST/api/dashboard");
                  curl_setopt($ch, CURLOPT_POST,true);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                  $res = curl_exec($ch);
                  curl_close($ch);
                  echo "<script>alert($res)</script>";
                  echo "<pre>" . $res. "</pre>";*/
                  $url="http://api.dashboard.nic.in/MDREST/api/dashboard";
                  $data = $result;
                  $ch = curl_init($url);
                  # Setup request to send json via POST.
                  $myObj = new \stdClass();
                  $myObj->mcode = 103;
                  $myObj->state_code = 0;
                  $myObj->dept_code = 287;
                  $myObj->project_code = 70043;
                  $myObj->sec_code = 44;
                  $myObj1 = new \stdClass();
                  $myObj1->IP = $myObj;
                  $myObj1->Records = array($data);

                  // $result['logged_in'] = true;

                
                  // $keyFile = "Key_103_70043_20200318.key";
                  // $myfile = fopen($keyFile, "r");
                  // $key = fread($myfile, filesize($myfile));
                  // fclose($myfile);

                  // $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, 'I want to encrypt this', MCRYPT_MODE_ECB);
                  // $data['payload'] = base64_encode($encrypted);
                  // echo "<br>";
                  // echo "<br>";
                  // print_r($data);
                  // echo "<br>";
                  // echo "<br>";
                  // echo 'authCallback(' . json_encode( $data, JSON_UNESCAPED_UNICODE ) . ')';



                    $url = 'http://localhost/web/datapage/push_data_to_kpi/Key_103_70043_20200318.key';
                    $file_key = json_decode(file_get_contents($url));

                    $key_len    = strlen($file_key);

                    //Set the method
                    $method     = 'aes-128-cbc';
                    //get Requried Key length fo the Method
                    $ivlen  = openssl_cipher_iv_length($method);
                    $iv = substr($key, 0, $ivlen);
                    //Encrypt
                    $encrypted = base64_encode(openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv));
                    return $encrypted;




                  $payload = json_encode($myObj1);

                  //$payload = md5(json_encode($myObj1->Records));
                  //$payload = json_encode("Records",array($data));
                  //$payload = json_encode("Records"=> $data);
                  echo "<br>";
                  echo "<br>";
                  echo $payload;
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
                  # Return response instead of printing.
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                  # Send request.
                  $res = curl_exec($ch);
                  curl_close($ch);
                  # Print response.
                  echo "<pre>" . $res. "</pre>";

                  $myObjLog=(Object)NULL;
                  $myObjLog = json_decode($res);

                 try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    // execute the stored procedure
                    $p_flag = 'RQ';
                    $P_State_Code = 0;
                    $P_Sec_Code = 44;
                    $P_Dept_Code = 287;
                    $P_Project_Code = 70043;
                    $P_Datef = '2020-01-01';
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
                    print_r($results);

                } catch (PDOException $e) {
                    die("Error occurred:" . $e->getMessage());
                }
             ?>

            <tbody> 
               <tr>
                    <td><?php echo $result['State_Code'] ?></td>
                    <td><?php echo $result['District_Code'] ?></td>
                   <!--  <td><?php //echo $result['Teh_Code'] ?></td>
                    <td><?php //echo $result['Blk_Code'] ?></td>
                    <td><?php //echo $result['Sector_Code'] ?></td>
                    <td><?php //echo $result['Gp_Code'] ?></td>
                    <td><?php //echo $result['Vill_Code'] ?></td>
                    <td><?php //echo $result['Dept_Code'] ?></td>
                    <td><?php //echo $result['Project_Code'] ?></td>
                    <td><?php //echo $result['Cnt1'] ?></td>
                    <td><?php //echo $result['Cnt2'] ?></td>
                    <td><?php //echo $result['Cnt3'] ?></td> 
                    <td><?php //echo $result['Cnt4'] ?></td>
                    <td><?php //echo $result['Cnt5'] ?></td> -->
                    <td><?php echo $result['Dataportmode'] ?></td>
                    <td><?php echo $result['Modedesc'] ?></td>
                    <td><?php echo $result['Data_Lvl_Code'] ?></td>
                    <td><?php echo $result['Yr'] ?></td> 
                    <td><?php echo $result['Mnth'] ?></td>
                    <td><?php echo $result['Datadt'] ?></td>
                    <td><?php echo $P_Msg ?></td>
                    <td><?php echo $RetDMDashCaption ?></td>    
                </tr>
              </tbody>  
             <?php

        endwhile; ?>
        </table>
 </div>
</div>