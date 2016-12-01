<?php
    
    require 'dbHandler.php';
    $col = $database->ResourcesTest;
    $GLOBALS['col']=$col;
    $GLOBALS['database']=$database;

    function makeFileList($user, $butname) {
        
        if($butname == "Audio" OR $butname == "AudioP") {                                           //Whenever the Make File List is
           $cursor = $GLOBALS['col']->find(array('Username' => $user, "Resource Type" => "mp3"));  // called it has an identifying 
            $num1 = $cursor->count();                                                               //parameter which allows me to 
                                                          //differentiate the pages.
           
            
            if($butname == "AudioP" AND $num1!=0){
                echo "<h1 style='margin-left:6%;'> You have ".$num1." mp3s. </h1>";
                $count = 0;
                echo "<table style='width: 88%; margin-left:6%;' >";
                    echo "<form name='playForm' method='POST' action='../MultiLevelPushMenu/player.php' enctype='multipart/form-data'>" ; 
                foreach ($cursor as $obj) {                   // iterate through the results
                    $filename = $obj['Resource Name'];
                    if(!isset($obj["Packaged"])){
                        echo "<tr>";
                        echo "<td class='check'><div class='checkbox checkbox-success'>
                        <input type='checkbox' class='styled' name='ckb' id='ckb".$count."' value='".$filename."' onclick= 'chkcontrol(".$count.")'>
                        <label></label>
                        </div>
                        </td>";
                        echo "<td class='name'><label class='name2' style='padding-top:10px;'>".$filename."</lable></td>";
                        $count++;
                    
                    }
                
                }
                
                 echo     "</table>
                            <input type='hidden' name='src' id='src'>
                             <button class='btn btn-block btn-primary' type='submit' name='Aplay'  style='margin-top:10px; width:88%; margin-left: 6%;'>
                                    <i class='glyphicon glyphicon-headphones'></i> Select Audio
                            </button>
                           
                            </form>"; 
                
                echo "</div>"; // closing w3-twothirds div 
                
                
                echo    "<script type='text/javascript'>
                            function chkcontrol(j) {
                                var total=0;
                                var textbox = document.getElementById('src');
                                var name = '';
                                var str = 'ckb';
                                var trial = '';
                                if(document.playForm.ckb.length === undefined){
                                    name = document.getElementById('ckb0');
                                }
                                else{
                                    trial = document.playForm.ckb.length;
                                
                                
                                
                                for(var i=0; i < trial; i++){
                                  
                                    if(document.playForm.ckb[i].checked){
                                            total =total +1;
                                            name = document.getElementById(str.concat(i));
                                
                                    }
                                    if(total > 1){
                                        alert('Please Select only one') 
                                        document.playForm.ckb[j].checked = false ;
                                        return false;
                                    }            
                                }
                                }
                                
                                var p2 = name.getAttribute('value');
                                textbox.value = p2;
                                
                                
                            } </script>";
                
                echo '<div class="col-sm-6">';
               
                if(isset($_POST["src"])){
                    
                    $src = $_POST["src"];
                
                    $song =  $GLOBALS['col']->findOne(array("Username" => $_SESSION['name'], "Resource Name" => $src));
                    $path = $song["Resource Path"];
                // echo $path;
                    echo '<div class="audio-player">
                        <h2>Now Playing: '.$src.'</h2>
                            <audio id="audio-player" src="'.$path.'" type="audio/mp3" style="width:85%;" controls="controls"></audio>
                        </div>';
                
                }
                
                        
                if(!isset($_POST['src'])){
                 $path2 = "../FileHandler/sample/pleaseSel.mp3";
                    // echo $path2;
                    echo '<div class="audio-player">
                        <h2>Choose mp3</h2>
                            <audio id="audio-player" src="'.$path2.'" type="audio/mp3" style="width:85%;" controls="controls"></audio>
                        </div>';
                
                }
                echo '</div>';
                
                
                
                
                
                
                
                
                
            }
            
            
        elseif($butname == "Audio" AND $num1 != 0){ 
            echo "<h1 style='margin-left:3%;'> You have ".$num1." mp3s. </h1>";// this next section of code is aimed at the organization of the sequencer
            $egval = $num1+1;                             // finds the value of the place holders in the table and it also uses some
                                                  // java script for hidden inputs, which might be like a little cheat, but
                                                    //when things get gloomy it are these nuances that keep me happy. also 
            $row = 1;                               //egval means example value.
             echo "<form name='hope' method='POST' action='../FileHandler/download.php' enctype='multipart/form-data'>" ; 
            
            echo "<table border=1 style='width: 94%; margin-left: 3%;'>";
            echo "<tr><td class='check2'> X </td><td class='name3'><label class='name5'>Name of Song (check if wanted)</label></td>
            <td align='center' class='name4'><label class='name5'>Appearance Order Index separated by '-' STARTING FROM 1 </label></td></tr>";                         // the Heading of the sequencing table.
        
            foreach ($cursor as $obj) {                   // iterate through the results
            
                $filename = $obj['Resource Name'];
        
                if(!isset($obj["Packaged"]) AND $egval ){
                                                            //only the firs row of the table were privileged enough to get two place
                    echo "<tr>";                            //holders instead of one.
                    echo "<td class='check2'><div class='checkbox checkbox-success'><input type='checkbox' name='filename[]' id='".$row."_1' value='".$filename."' class='styled' onclick='updatebox1(".$num1.")'><label></label></div></td>
                    <td class='name3'><label class='name5' style='padding-top:10px;'> ".$filename."</label></td>";
                    echo "<td class='name4' align='center'><input type='text' name='".$row."_2' id='".$row."_2' placeholder='".$row."-".$egval."'></td>";
                    echo "</tr>";                           // was thinking of having multiple columns one per repetiton of the 
                    $egval = null;                         // resource, but it didnt look or feel great. At least its a little                                               // better that how it would have looked had we decided to go offline
                }                                           // and use java.
            
                elseif(!isset($obj["Packaged"]) AND (!$egval) ){
                    echo "<tr>";                            //holders instead of one.
                    echo "<td class='check2'><div class='checkbox checkbox-success'><input type='checkbox' name='filename[]' id='".$row."_1' value='".$filename."' class='styled' onclick='updatebox1(".$num1.")'><label></label></div></td>
                    <td class='name3'><label class='name4' style='padding-top:10px;'> ".$filename."</label></td>";
                    echo "<td class='name4' align='center'><input type='text' name='".$row."_2' id='".$row."_2' placeholder='".$row."'></td>";
                    echo "</tr>";  
                }
                                                            // iterate the row values and spot irrelevant variables that could be
                                                            // removed.
                $row++;
            }
            echo "</table>";      // Dont forget to close the table element, spent ages wondering why the table was at the bottom
                                    // of the webpage the whole time.
            echo "<div class='row'>";
            echo "<div class='col-sm-6 input'>";
            echo "<div style='width: 88%; margin-left: 6%;'>";
            echo "<label for='seqMp3Title'>Insert Name for sequenced MP3 &nbsp;</label>";
            echo "<input type='text' name='seqMp3Title' id='seqMp3Title' required>";
            echo "</div>";
            echo "</div>";
            
            echo "<input type='hidden' name='map' id='map'>";    // this is really like a hidden map, without this I wouldnt find the 
                                                                //treasure.
            
            echo "<script>               
                    var textbox2 = document.getElementById('map');
                            // document.write(textbox);                                           
                    function updatebox1(x2){
                        var amount2 = x2;
                       //  window.alert(x2);
                        var str2 = '';
                        var i2;
                        for ( i2 = 1; i2 <= amount2; i2++){
                            var rowNu2 = i2.toString();
                           
                            var id2 = rowNu2.concat('_1');
                            var reps2 = rowNu2.concat('_2');
                            if (document.getElementById(id2).checked){
                           
                                var name2 = document.getElementById(id2).getAttribute('value');
                        
                               str2+=name2;
                           
                               str2+='|';
                                str2+= document.getElementById(reps2).getAttribute('id').toString();
                                str2+='|';
                                document.getElementById(reps2).disabled = false ;
                                document.getElementById(reps2).required = true;
    
                            }
                                
                            else{
                                document.getElementById(reps2).value = '';
                                document.getElementById(reps2).disabled = true;
                                document.getElementById(reps2).required = false;
                            }

                        }
                        // window.alert(x2);
        
                    textbox2.value = str2;
                    
    
                    }
                    
                                   
                  </script>";  //this javascript was to esure the updating of my treasuremap whenever a different resource was
                               //chose to be sequenced. And to validate the ordered fields to ensure that the users fill in all
                                // the correct information.
                   echo     "
                             <div class='col-sm-2 input'>
                                <button class='btn btn-block btn-primary' type='submit' name='ADsequence'>
                                    <i class='glyphicon glyphicon-download-alt'></i> Download Audio
                                </button>
                            </div>
                            <div class='col-sm-2 input'>
                              <button class='btn btn-block btn-primary' type='submit' name='ASsequence'>
                                    <i class='glyphicon glyphicon-floppy-disk'></i> Save Audio
                                </button>
                            </form>";
            echo "</div>";
            echo "</div>";
            
               echo     '<script>
                    $("input#seqMp3Title").on({
                        keydown: function(e) {
                            if (e.which === 32 || e.which === 222 || e.which === 220 || e.shiftKey && e.which === 222){
                                alert("Please do not use spaces, quotations and backslashes");
                                return false;
                                }
                        },
                                change: function() {
                                        this.value = this.value.replace(/\s/g, "");
                                    }
                            });</script>';
            }
            
            else{
              echo "<h2>Please upload some files</h2>"; 
            }//Whenever the Make File List is
            
        }
        
        
        // now it is time to focus on the none audio resources and ensure that they are in  good order.
       
        
        elseif($butname == "Sequence"){
            
            $cursor = $GLOBALS['col']->find(array('Username' => $user, "Packaged" => array('$ne' => "Yes"), "Orchestrated" =>                   array('$ne' => "yes")));        
            $num = $cursor->count();
             
            
            $cursor2 = $GLOBALS['col']->find(array('Username' => $user, "Packaged" => array('$ne' => 'yes'), "Orchestrated" =>                  'yes')); 
            $num1 = $cursor2->count();
            
            
            if($num != 0 OR $num1 !=0){
                echo  '<div class="col-sm-6">';
            echo "<h1 style='text-align: center'> You have ".$num." Raw files. </h1>";
                echo "<form name='seq' method='POST' action='../FileHandler/download.php' enctype='multipart/form-data'>" ;  
                echo "<table style='width: 92%; margin-left: 5%;'>";
                foreach ($cursor as $obj) {                   // iterate through the results
                    $filename = $obj['Resource Name'];
                    if(!isset($obj["Packaged"]) AND !isset($obj["Orchestrated"])){
                        echo "<tr>";
                        echo "<td class='check'><div class='checkbox checkbox-success'><input type='checkbox' name='filename[]' clss='styled' value='".$filename."'><label></label><div></td>";
                        echo "<td class='name'><label class='name2' style='padding-top:10px;'> ".$filename."</label></td>";
                        echo "</tr>";
                    
                    }
                
                }
                echo "</table>";
                echo "</div>";
                echo "<div class='col-sm-6'>";
                echo "<h1 style='text-align: center;'> You have ".$num1." Orchestrated files. </h1>";
                 echo "<table style='width: 92%; margin-left: 3%;'>";
                foreach ($cursor2 as $obj) {                   // iterate through the results
                    $filename = $obj['Resource Name'];
        
                    if(isset($obj["Orchestrated"])){

                       echo "<tr>";
                        echo "<td class='check'><div class='checkbox checkbox-success'><input type='checkbox' class='styled' name='filename[]' value='".$filename."'><label></label></div></td>";
                        echo "<td class='name'><label class='name2' style='padding-top:10px;'>".$filename."</label></td>";
                        echo "</tr>";
                    }
                }
                 echo "</table>";
                echo "</div>";
                echo "</div>";
               // echo "</div>";
                echo "<div class='row input'>";
                echo "<div class='col-sm-3'>";
                echo "</div>";
                echo "<div class='col-sm-2'>";
                $conf = '"Are you sure you want to delete these file(s)?"';
                echo "  <button class='btn btn-block btn-primary' type='submit' name='download'>
                        <i class='glyphicon glyphicon-download-alt'></i> Download
                        </button>
                        </div>
                        <div class='col-sm-2'>
                        <button class='btn btn-block btn-primary' type='submit' name='package'>
                        <i class='glyphicon glyphicon-paperclip'></i> Package
                        </button>
                        </div>
                        <div class='col-sm-2'>
                        <button class='btn btn-block btn-primary' type='submit' name='delete' onclick='return confirm(".$conf.");'>
                            <i class='glyphicon glyphicon-trash'></i> Delete
                            </button>
                        </form>";
                echo "</div>";
                echo "<div class='col-sm-3'>";
                echo "</div>";
            }
            
            else{
                echo  '<div class="col-sm-12">';
            echo "<h1 style='text-align: center'> You have ".$num." Raw files. </h1>";
                
             echo '<h2 class="input" style="margin-left: 15px">Please upload some files</h2>';
                echo '</div>';
            }
            
            
        }       
        
    
        
               elseif($butname == "Video" OR $butname == "VideoP") {                                           //Whenever the Make File List is
           $cursor = $GLOBALS['col']->find(array('Username' => $user, "Resource Type" => "mp4"));  // called it has an identifying 
            $num = $cursor->count();                                                               //parameter which allows me to 
                                                        //differentiate the pages.
           
            
         
            
        if($butname == "Video" AND $num != 0){
             echo "<h1 style='margin-left:3%'> You have ".$num." mp4s. </h1>"; // this next section of code is aimed at the organization of the sequencer
            $egval = $num+1;                             // finds the value of the place holders in the table and it also uses some
                                                  // java script for hidden inputs, which might be like a little cheat, but
                                                    //when things get gloomy it are these nuances that keep me happy. also 
            $row = 1;                               //egval means example value.
             echo "<form name='hope' method='POST' action='../FileHandler/download.php' enctype='multipart/form-data'>" ; 
            
            echo "<table border=1 style='width: 94%; margin-left: 3%'>";
            echo "<tr><td class='check2'>X</td><td class='name3'><label class='name5'>Name of Video (check if wanted)</label></td>
            <td align='center' class='name4'><label class='name5' style='padding-top:10px;'>Appearance Order Index separated by '-' STARTING FROM 1 </label></td></tr>";                         // the Heading of the sequencing table.
        
            foreach ($cursor as $obj) {                   // iterate through the results
            
                $filename = $obj['Resource Name'];
        
                if(!isset($obj["Packaged"]) AND $egval ){
                                                            //only the firs row of the table were privileged enough to get two place
                    echo "<tr>";                            //holders instead of one.
                    echo "<td class='check2'><div class='checkbox checkbox-success'><input type='checkbox' class='styled' name='filename2[]' id='".$row."_12' value='".$filename."' onclick='updatebox(".$num.")'/><label></label></div></td>
                    <td class='name3'><label class='name5' style='padding-top:10px;'>".$filename."</label></td>";
                    echo "<td align='center' class='name4'><input type='text' name='".$row."_22' id='".$row."_22' placeholder='".$row."-".$egval."'></td>";
                    echo "</tr>";                           // was thinking of having multiple columns one per repetiton of the 
                    $egval = null;                         // resource, but it didnt look or feel great. At least its a little                                               // better that how it would have looked had we decided to go offline
                }                                           // and use java.
            
                elseif(!isset($obj["Packaged"]) AND (!$egval) ){
                    echo "<tr>";
                    echo "<td class='check2'><div class='checkbox checkbox-success'><input type='checkbox' class='styled' name='filename2[]' id='".$row."_12' value='".$filename."' onclick='updatebox(".$num.")'/><label></label></div></td>
                    <td class='name3'><label class='name5' style='padding-top:10px;'>".$filename."</label></td>";
                    echo "<td align='center' class='name4'><input type='text' name='".$row."_22' id='".$row."_22' placeholder='".$row."'></td>";
                    echo "</tr>";
                }
                                                            // iterate the row values and spot irrelevant variables that could be
                                                            // removed.
                $row++;
            }
            echo "</table>";      // Dont forget to close the table element, spent ages wondering why the table was at the bottom
                                    // of the webpage the whole time.
            
            echo "<div class='row'>";
            echo "<div class='col-sm-6'>";
            echo "<div style='width: 88%; margin-left: 6%;'>";
            echo "<label class='input' for='seqMp4Title'>Insert Name for sequenced MP4 &nbsp;</label>";
            echo "<input type='text' name='seqMp4Title' id='seqMp4Title' required><br>";
            echo "</div>";
            echo "</div>";
            echo "<input type='hidden' name='map2' id='map2'>";    // this is really like a hidden map, without this I wouldnt find the 
                                                                //treasure.
            echo "<script>               
                    var textbox = document.getElementById('map2');
                                                                        
                    function updatebox(x){
              
                        var amount = x;
                        var str = '';
                        var i;
                        for ( i = 1; i <= amount; i++){
                            var rowNu = i.toString();
                            var id = rowNu.concat('_12');
                            var reps = rowNu.concat('_22');
                            if (document.getElementById(id).checked){
                           
                                var name = document.getElementById(id).getAttribute('value');
                        
                                str+=name;
                           
                                str+='|';
                                str+= document.getElementById(reps).getAttribute('id').toString();
                                str+='|';
                                document.getElementById(reps).disabled = false ;
                                document.getElementById(reps).required = true;
    
                            }
                                
                            else{
                                document.getElementById(reps).value = '';
                                document.getElementById(reps).disabled = true;
                                document.getElementById(reps).required = false;
                            }

                        }
        
                    textbox.value = str;
                    
    
                    }
                    
                                   
                  </script>";  //this javascript was to esure the updating of my treasuremap whenever a different resource was
                               //chose to be sequenced. And to validate the ordered fields to ensure that the users fill in all
                                // the correct information.
                   echo     "
                                <div class='col-sm-2 input'>
                                <button class='btn btn-block btn-primary' type='submit' name='VDsequence'>
                                    <i class='glyphicon glyphicon-download-alt'></i> Download Video
                                </button>
                                </div>
                                <div class='col-sm-2 input'>
                                <button class='btn btn-block btn-primary' type='submit' name='VSsequence'>
                                    <i class='glyphicon glyphicon-floppy-disk'></i> Save Video
                                </button>
                            </form>";
            echo "</div>";
                       
                    echo     '<script>
                    $("input#seqMp4Title").on({
                        keydown: function(e) {
                            if (e.which === 32 || e.which === 222 || e.which == 220 || e.shiftKey && e.which === 222){
                                alert("Please do not use spaces, quotations and backslashes");
                                return false;
                                }
                        },
                                change: function() {
                                        this.value = this.value.replace(/\s/g, "");
                                    }
                            });
                    $(".name4").on({
                        keydown: function(e) {
                            if (e.which !== 48 && e.which !== 49 && e.which !== 50 && e.which !== 51 && e.which !== 52 && e.which !== 53 && e.which !== 54 && e.which !== 55 && e.which !== 56 && e.which !== 57 && e.which !== 45 && e.which !== 8 && e.which !== 46 && e.which !== 43 && e.which !== 189){
                                alert("Please only use numbers and hyphens.");
                                return false;
                                }
                        },
                                change: function() {
                                        this.value = this.value.replace(/\s/g, "");
                                    }
                            });</script>'; 
            
            }
            
                     elseif($butname == "VideoP" AND $num!=0){
                          echo "<h1 style='margin-left:6%'> You have ".$num." mp4s. </h1>"; 
                $count = 0;
                         echo "<table style='width: 88%; margin-left: 6%;'>";
                                echo "<form name='playForm1' method='POST' action='../MultiLevelPushMenu/player.php#bottom' enctype='multipart/form-data'>" ; 
                foreach ($cursor as $obj) {                   // iterate through the results
                    $filename = $obj['Resource Name'];
                    if(!isset($obj["Packaged"])){
                      
                        echo "<tr>";
                        echo "<td class='check'><div class='checkbox checkbox-success'><input type='checkbox' class='styled' name='ckb1' id='ckb1".$count."' value='".$filename."' onclick= 'chkcontrol1(".$count.")'><label></label></div></td>
                        <td class='name'><label class='name2' style='padding-top:10px;'>".$filename."</label></td>";
                        echo "<tr>";
                        $count++;
                    
                    }
                
                }
                    echo "</table>";
                 echo     " <input type='hidden' name='src1' id='src1'>
                            <button class='btn btn-block btn-primary' type='submit' name='Vplay'  style='margin-top:10px; width:88%; margin-left: 6%;'>
                                    <i class='glyphicon glyphicon-film'></i> Select Video
                                </button>
                            </form>
                            </div>";  
                
                
            echo    "<script type='text/javascript'>
                            function chkcontrol1(j1) {
                                
                                var total1=0;
                                var textbox1 = document.getElementById('src1');
                                var name1 = '';
                                var str1 = 'ckb1';
                                var trial1 = '';
                                if(document.playForm1.ckb1.length === undefined){
                                    name1 = document.getElementById('ckb10');
                                }
                                else{
                                    trial1 = document.playForm1.ckb1.length;
                                
                                
                                
                                for(var i1=0; i1 < trial1; i1++){
                                  
                                    if(document.playForm1.ckb1[i1].checked){
                                            total1 =total1 +1;
                                            name1 = document.getElementById(str1.concat(i1));
                                
                                    }
                                    if(total1 > 1){
                                        alert('Please Select only one') 
                                        document.playForm1.ckb1[j1].checked = false ;
                                        return false;
                                    }            
                                }
                                }
                                
                                var p21 = name1.getAttribute('value');
                                textbox1.value = p21;
                                
                                
                            } </script>";
                         
               echo "<div class='col-sm-6'>";
                if(isset($_POST['src1'])){
                    
                    $src1 = $_POST['src1'];
            
                
                
                    $video =  $GLOBALS['col']->findOne(array("Username" => $_SESSION['name'], "Resource Name" => $src1));
                    $path3 = $video["Resource Path"];
                 
                    
                  echo  '<h3>Now Playing: '.$src1.'<h3>
                        <video width="100%" height="auto" controls>
                        <source src="'.$path3.'" type="video/mp4">
                                Your browser does not support the video tag.
                        </video>';
                
                }
                         
                elseif(!isset($_POST['src1'])){
                 
                    
                  echo  '<video width="100%" height="auto" controls>
                        <source src="" type="video/mp4">
                                Your browser does not support the video tag.
                        </video>';
                
                }
                echo "</div>";
                
                
                
                
                
                
                
                
                
                
            }
         
            
            
            if($num == 0){
            echo '<h2>Please upload some files</h2>';
                
        }
               }
        
    }



    function makePackageFileList($user) {
        $cursor = $GLOBALS['col']->find(array('Username' => $user, "Packaged" => "Yes")); 
        $num = $cursor->count();
        echo "<div class='col-sm-6' >";
        echo "<h1 style='text-align: center;'> You have ".$num." Packaged files. </h1>";  

        echo "<form method='POST' action='../FileHandler/download.php' enctype='multipart/form-data'>" ;  
        echo "<table>";
        foreach ($cursor as $obj) {                   // iterate through the results
            $filename = $obj['Resource Name'];

            if(isset($obj["Packaged"])){
                 echo "<tr>";
                echo "<td class='check'><div class='checkbox checkbox-success'><input type='checkbox' class='styled' name='filename[]' value='".$filename."'><label></label></div></td>";
                echo "<td class='name'><label class='name2' style='padding-top:10px;'>".$filename."</label></td>";
                echo "</tr>";
            }

        }   
        echo "</table>";
        echo "</div>";
        echo "</div>";
        if($num != 0){
            echo "<div class='row input'>";
            echo "<div class='col-sm-3'>";
            echo "</div>";
                echo "<div class='col-sm-2'>";
            $conf2 = '"Are you sure you want to delete these Package(s)?"';
            echo  "  <button class='btn btn-block btn-primary' type='submit' name='download'>
                        <i class='glyphicon glyphicon-download-alt'></i> Download
                        </button>
                </div>
                <div class='col-sm-2'>
                <button class='btn btn-block btn-primary' type='submit' name='share'>
                        <i class='glyphicon glyphicon-eye-open'></i> Share
                        </button>
                </div>
                <div class='col-sm-2'>
                <button class='btn btn-block btn-primary' type='submit' name='packDelete' onclick='return confirm(".$conf2.");'>
                        <i class='glyphicon glyphicon-trash'></i> Delete
                        </button>
                </div>
                </form>
                </div>
                <div class='row'>
                <div class='col-sm-3'></div>
                <div class='col-sm-6'>
                <a href='../index.php' style='text-decoration: none;'><button class='btn btn-block btn-primary' style='margin-bottom: 15px; margin-top: -5px;' name='ReVO' ;'>
                        <i class='glyphicon glyphicon-search'></i> Search Shared Packages on ReVO
                        </button></a>
                </div>";  

        }
        else{
            echo '</form><br>
                <h2>Please package some files</h2>';

        }
    }
        


   ?>  
        
        
     
   