<?php
    $db = mysqli_connect('localhost', 'root', '', 'incidentmonitor');
    $sql = "SELECT * FROM keywordtable";
    $rslt = mysqli_query($db,$sql);
    $datas = array( ); 
    if(mysqli_num_rows($rslt)>0){
        while($row = mysqli_fetch_assoc($rslt)){
        $datas[]=$row;
        }
    }
    $searchkey = array_column($datas, 'keyword');
?> 

<?php
//database

//check all variable/data is set or not 
if(isset($_FILES['image_name'])  && isset($_POST['log_date'])){

//name
$date = $_POST['log_date'];
$file_name = $_FILES['image_name']['name'];
$file_tmp =$_FILES['image_name']['tmp_name'];

//file move 
move_uploaded_file($file_tmp,"../../images/".$file_name);

shell_exec('"C:\\Program Files\\Tesseract-OCR\\tesseract" "C:\\xampp\\htdocs\\images\\'.$file_name.'" out');

$myfile = fopen("out.txt", "r") or die("Unable to open file!");
fclose($myfile);

// searching inside textfile
$filename = 'out.txt';
$file = file_get_contents($filename);
$computer=gethostname();
foreach ($searchkey as $value) {
    if(strpos($file, $value)) 
    {
        mysqli_query($db, "INSERT INTO incidents (image_name,computer_name,log_date) VALUES ('$file_name','$computer','$date')"); 
        $_SESSION['message'] = "keyword Added"; 

        $res = array(
            'status' => 'success',
            'msg' => 'Image Upload Successfully'
        );
        break;
    }
    else{
        $res = array(
            'status' => 'failure',
            'msg' => 'No match found'
        );
    }

}
echo json_encode($res);
}
?>