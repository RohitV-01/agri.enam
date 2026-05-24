<div class="container">
	<div class="row">
		 <?php
        require_once 'dbconfig.php';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // execute the stored procedure
            $email = "sachinbhute15@gmail.com"; 

            $sql = 'CALL GetOrderCountByStatus("'.$email.'",@email)';

            // call the stored procedure
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <table>
            <tr>
                <th>Customer Name</th>
                <th>Customer Name</th>
            </tr>
            <?php while ($r = $q->fetch()):

             ?>
                <tr>
                    <td><?php echo $r['email'] ?></td>
                </tr>
            <?php


        endwhile; ?>
        </table>
 </div>
</div>

<div class="container">
    <div class="row">
         <?php
        require_once 'dbconfig.php';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // execute the stored procedure

            $p_flag = 'GD';
            $P_State_Code = 0;
            $P_Sec_Code = 44;
            $P_Dept_Code = 287;
            $P_Project_Code = 70043;
            $P_Datef = '2020-01-01';
            $P_Datet = '2020-01-31';
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
            $rs = $stmt->execute();
            //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //$q->setFetchMode(PDO::FETCH_ASSOC);
            //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            //print_r($result);

        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <table>
            <tr>
                 <th>State_Code</th>
                 <th>District_Code</th>
                 <th>Teh_Code</th>
                 <th>Blk_Code</th>
                 <th>Sector_Code</th>
                 <th>Gp_Code</th>
                 <th>Vill_Code</th>
                 <th>Dept_Code</th>
                 <th>Project_Code</th>
                 <th>Cnt1</th>
                 <th>Cnt2</th>
                 <th>Cnt3</th>
                 <th>Cnt4</th>
                 <th>Cnt5</th>
                 <th>Dataportmode</th>
                 <th>Modedesc</th>
                 <th>Data_Lvl_Code</th>
                 <th>Yr</th>
                 <th>Mnth</th>
                 <th>Datadt</th>
            </tr>
            <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)):
            	/*$data = $result;
				  $ch = curl_init("http://api.dashboard.nic.in/MDREST/api/dashboard");
				  curl_setopt($ch, CURLOPT_POST,true);
				  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);*/
				/*curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));*/
				/*$res = curl_exec($ch);
				  curl_close($ch);
            	  echo "<pre>" . $res. "</pre>";*/
				  //API URL
				  $url="http://api.dashboard.nic.in/MDREST/api/dashboard";
				  $data = $result;
				  $ch = curl_init($url);
				  # Setup request to send json via POST.
				  $payload = json_encode(array( "Records"=> $data ));

				  /*$payload = md5($data);*/

				  echo "<br>";
				  echo "<br>";
				  print_r($payload);
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
             ?>
               <tr>
                    <td><?php echo $result['State_Code'] ?></td>
                    <td><?php echo $result['District_Code'] ?></td>
                    <td><?php echo $result['Teh_Code'] ?></td>
                    <td><?php echo $result['Blk_Code'] ?></td>
                    <td><?php echo $result['Sector_Code'] ?></td>
                    <td><?php echo $result['Gp_Code'] ?></td>
                    <td><?php echo $result['Vill_Code'] ?></td>
                    <td><?php echo $result['Dept_Code'] ?></td>
                    <td><?php echo $result['Project_Code'] ?></td>
                    <td><?php echo $result['Cnt1'] ?></td>
                    <td><?php echo $result['Cnt2'] ?></td>
                    <td><?php echo $result['Cnt3'] ?></td> 
                    <td><?php echo $result['Cnt4'] ?></td>
                    <td><?php echo $result['Cnt5'] ?></td>
                    <td><?php echo $result['Dataportmode'] ?></td>
                    <td><?php echo $result['Modedesc'] ?></td>
                    <td><?php echo $result['Data_Lvl_Code'] ?></td>
                    <td><?php echo $result['Yr'] ?></td> 
                    <td><?php echo $result['Mnth'] ?></td>
                    <td><?php echo $result['Datadt'] ?></td>  
                </tr>
             <?php
        endwhile; ?>
        </table>

        <table class="table table-bordered">
          <thead>
            <tr>
               	 <th scope="col">State_Code</th>
                 <th scope="col">District_Code</th>
                 <th scope="col">Teh_Code</th>
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
                 <th scope="col">Cnt5</th>
                 <th scope="col">Dataportmode</th>
                 <th scope="col">Modedesc</th>
                 <th scope="col">Data_Lvl_Code</th>
                 <th scope="col">Yr</th>
                 <th scope="col">Mnth</th>
                 <th scope="col">Datadt</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                  <td><?php echo $result['State_Code'] ?></td>
                  <td><?php echo $result['District_Code'] ?></td>
                  <td><?php echo $result['Teh_Code'] ?></td>
                  <td><?php echo $result['Blk_Code'] ?></td>
                  <td><?php echo $result['Sector_Code'] ?></td>
                  <td><?php echo $result['Gp_Code'] ?></td>
                  <td><?php echo $result['Vill_Code'] ?></td>
                  <td><?php echo $result['Dept_Code'] ?></td>
                  <td><?php echo $result['Project_Code'] ?></td>
                  <td><?php echo $result['Cnt1'] ?></td>
                  <td><?php echo $result['Cnt2'] ?></td>
                  <td><?php echo $result['Cnt3'] ?></td> 
                  <td><?php echo $result['Cnt4'] ?></td>
                  <td><?php echo $result['Cnt5'] ?></td>
                  <td><?php echo $result['Dataportmode'] ?></td>
                  <td><?php echo $result['Modedesc'] ?></td>
                  <td><?php echo $result['Data_Lvl_Code'] ?></td>
                  <td><?php echo $result['Yr'] ?></td> 
                  <td><?php echo $result['Mnth'] ?></td>
                  <td><?php echo $result['Datadt'] ?></td>
            </tr>
          </tbody>
        </table>

        
 </div>
</div>