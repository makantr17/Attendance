 <table>
                            <!-- Headers -->
                            <tr>
                                <th>Days</th>
                                <th>Date</th>                            
                                <th>Week</th>
                                <th>CourseName</th>
                                <th>Status</th>
                                <th>Converted</th>
                            </tr>

                            <!-- Data in it -->
                            <script>
                                    var newArr = [];
                                    var secondArr = [];    
                                    var course = [];
                                    var presenceCourse = {}; 
                            </script>

                            <?php
                            $counterPresent = 0;
                            $counterAbsent = 0;
                            $grow = 0;
 
                            $myarr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
                            foreach ($resultCheck as $resultValue) { 
                                                                                        
                                foreach ($myarr as $nameDay) {  
                                    
                                $explodeValue = explode(',', $resultValue["$nameDay"]);
                                for ($d=0; $d < sizeof($explodeValue) ; $d++) { 

                                    $simpleSliced = explode('/', $explodeValue[$d]);
                    
                                ?>      
                            <tr>      
                                <td><?php echo $nameDay; ?></td>
                            
                                <?php for ($i=0; $i < sizeof($simpleSliced) ; $i++) {    ?>
                                    <td><?php echo  $simpleSliced[$i]; ?></td>
                                
                                    <!-- Fill the array that contains the dates -->
                                    <script>
                                        secondArr[<?php echo $grow; ?>] = <?php echo date("d",strtotime($simpleSliced[0])) ; ?>
                                    </script>

                                    <?php } ?>
                                    
                                    <!-- Update all the informations Concerning user presence -->
                                    <script>
                                        var nameOfCourse =  '<?php echo $simpleSliced[2]; ?>';
                                        if ("" != nameOfCourse ) {
                                            if(presenceCourse.hasOwnProperty(nameOfCourse)){
                                                if(presenceCourse[nameOfCourse].hasOwnProperty('<?php echo $simpleSliced[3]; ?>')){ 
                                                    var mon =presenceCourse[nameOfCourse]; 
                                                    mon['<?php echo $simpleSliced[3]; ?>'] = mon['<?php echo $simpleSliced[3]; ?>'] + 1 ;
                                                }
                                            }else{
                                                    presenceCourse[nameOfCourse] = {"Present": 0, "Absent":0};
                                                    var takeit = presenceCourse[nameOfCourse];
                                                    if (takeit.hasOwnProperty('<?php echo $simpleSliced[3]; ?>')) {
                                                        takeit['<?php echo $simpleSliced[3]; ?>'] =  takeit['<?php echo $simpleSliced[3]; ?>'] + 1;
                                                    }
                                            }         
                                            }
                                    </script>

                                    <!-- Find out the numb -->
                                    <?php         
                                    // Count the number of time the student is present
                                    $index = 0;
                                    if ($simpleSliced[sizeof($simpleSliced) -1] == "Present") {
                                        $index = 1;
                                        $counterPresent = $counterPresent + 1;  ?>
                                        <!-- Fill the the array that contains Indexes -->
                                        <script> newArr[<?php echo $grow; ?>] = <?php echo $index; ?> </script>
                                    
                                    <!-- Count the number of time the Student is absent  -->
                                    <?php
                                    // Increment the index grow
                                    $grow = $grow + 1;
                                    }if ($simpleSliced[sizeof($simpleSliced) -1] == "Absent") {
                                        $index = 0;
                                        $counterAbsent = $counterAbsent + 1;
                                    ?>
                                    <script> newArr[<?php echo $grow; ?>] = <?php echo $index; ?>   </script>
 
                                    <!-- Increment the index grow -->
                                    <?php $grow = $grow + 1;  } ?>

                                    <td><?php echo $index; ?></td>
                                    
                                 </tr>
                            <?php  } } } ?>
                        </table>