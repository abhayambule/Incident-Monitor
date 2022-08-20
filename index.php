<!-- connect to database -->

<?php
// include('incident.php');
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "incidentmonitor";
  $conn = mysqli_connect($servername, $username, $password,$database);
  if(!$conn){
    die("Connection failed<br>" .mysqli_connect_error());
  }
  
?>


<!-- html file  -->

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Monitor</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>INCIDENT FINDER</h1>
    <div class="main">

        <!-- tabs -->
        <div id="tab">
            <button id="clickedList" class="tablinks" onclick="tabView(event, 'List')">List</button>
            <button class="tablinks" onclick="tabView(event, 'Keyword')">Keywords</button>          
            <!-- <button class="tablinks" onclick="tabView(event, 'OCR')">Text Converter</button> -->
        </div>
        
        <!-- List tab -->
        <div id="List" class="tabcontent">
            
            <!-- fetch data into a array -->
            <?php
            $sql = "SELECT * FROM incidents";
            
            $result = mysqli_query($conn,$sql);
            $data = array( ); 
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
                    $data[]=$row;
                }
            }
            ?>

        <!-- display data  -->
            <?php if (count($data) > 0): ?>
            <table class="table" cellpadding="4" cellspacing="10" >
                <thead class="thead">
                    <tr> 
                        <th><?php echo implode('</th><th>', array_keys(current($data))); ?></th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    <?php foreach ($data as $row): array_map('htmlentities', $row); ?>
                        <tr>
                            <td><?php echo implode('</td><td>', $row); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
            
        </div>
        <!-- Data Grid  -->
        
     <!-- Keyword tab -->

     <!-- fetch data into a array -->
      <?php
            $sql = "SELECT * FROM keywordtable";
            $rslt = mysqli_query($conn,$sql);
            $datas = array( ); 
            if(mysqli_num_rows($rslt)>0){
                while($row = mysqli_fetch_assoc($rslt)){
                    $datas[]=$row;
                }
            }
            ?> 
        <div id="Keyword" class="tabcontent">
            <p>Enter a Keywords</p>
            <form action="server.php"  method="POST" >
                <!-- <input type="text"> <br> -->
                <textarea type="text" name="keyword" id="keyword" cols="70" rows="8"></textarea>
                <input type="submit" name="submit">
            </form>
            
            <!-- Display Keyword  -->
            <div class="display_keyword">

                <h3>Keywords</h3>
                <?php if (count($datas) > 0): ?>
                    <table class="table" cellpadding="4" cellspacing="10" id="data_table">
                        <thead class="thead">
                            <tr>
                                <th><?php echo implode('</th><th>', array_keys(current($datas))); ?></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php foreach ($datas as $row): array_map   ('htmlentities', $row); ?>
                            <tr>
                                <td><?php echo implode('</td><td>', $row); ?></td>
                                <td> <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                    <?php
                // echo "$log_date";    
                ?>
            </div>
        </div>
    </div>
     <!-- javascript -->
     <script src="index.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="dist/jquery.tabledit.js"></script>
    <script type="text/javascript" src="custom_table_edit.js"></script>
    <script>
        
document.getElementById("data_table").onkeypress=function(e){
var e=window.event || e
var keyunicode=e.charCode || e.keyCode
//Allow alphabetical keys, plus BACKSPACE and SPACE
return (keyunicode>=65 && keyunicode<=122 || keyunicode==8 || keyunicode==32)? true : false
}
    </script>
</body>
</html>