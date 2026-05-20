<div class="container">
	<div class="row">
		 <?php
        require_once 'dbconfig.php';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // execute the stored procedure
            $sql = 'CALL GetCustomers(@state_id)';

            // call the stored procedure
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
             ;
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

            	if ( $r['state_id'] == 296 ) {
             ?>
                <tr>
                	<td><?php echo $r['state_id'] ?></td>
                    <td><?php echo $r['description'] ?></td>
                </tr>
            <?php
            }

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
            $sql = 'CALL Save_Key_Demo(@P_Flag,@P_State_Code,@P_Sec_Code,@P_Dept_Code,@P_Project_Code,@P_Datef,@P_Datet,@P_Msg,@P_Mcode)';
            // call the stored procedure
            $q = $pdo->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
             ;
        } catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        ?>
        <table>
            <tr>
                <th>Mcode</th>
                <th>State_Code</th>
                <th>District_Code</th>
                <th>Teh_Code</th>
                <th>Blk_Code</th>
                <th>Sector_Code</th>
                <th>P_Flag</th>
            </tr>
            <?php while ($r = $q->fetch()):
                if ( $r['P_Flag'] == "GD" ) {
             ?>
                <tr>
                    <td><?php echo $r['Mcode'] ?></td>
                    <td><?php echo $r['State_Code'] ?></td>
                    <td><?php echo $r['District_Code'] ?></td>
                    <td><?php echo $r['Teh_Code'] ?></td>
                    <td><?php echo $r['Blk_Code'] ?></td>
                    <td><?php echo $r['Sector_Code'] ?></td>
                    <td><?php echo $r['P_Flag'] ?></td>
                </tr>
            <?php
            }

        endwhile; ?>
        </table>
 </div>
</div>


