<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.js"></script>

</head>
<body>


<?php

require_once 'index.html';
require_once 'config.php';
require_once 'fetch.php';
require_once 'update.php';

$conn = connect();
$arr = select($conn);



if(!empty($_POST)){
$userID = $_POST['id'];   
$userName = $_POST['name'];
$userEmail = $_POST['email'];
$userComment = $_POST['comment'];
$userFile = $_FILES['file']; 
// echo '<pre>';
// print_r($_FILES['file']);
move_uploaded_file ($_FILES['file']['tmp_name'], 'add_files/'.$_FILES['file']['name']);
$sql = "INSERT INTO userName (name, comment, email, file)
VALUES ('".$userName."', '".$userComment."', '".$userEmail."', '".$userFile."')";
//var_dump($sql);die;
if (mysqli_query($conn, $sql)) {
        // echo "New record created successfully";
        header('Location: /');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
close($conn);
}
function select($conn){
    $sql = "SELECT * FROM userName";
    $result = mysqli_query($conn, $sql);

    $arr = array();
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
        }
        return $arr;
        }
    }


// echo '<pre>';
//     print_r ($arr);
// echo '</pre>';  "
$out = '<table class="table table-bordered table-striped"><thead>';
$out .='<tr><th>ID</th><th>Name</th><th>E-mail</th><th>Comment</th><th>File</th></tr></thead>';
foreach($arr as $table){
    $out .='<tr><td>'.$table['id'].'</td><td>'.$table['name'].'</td><td>'.$table['email'].'</td><td>'.$table['comment'].'</td><td><a href="/add_files/'.$table['file'].'">Link</a><br><a href="/add_files/'.$table['file'].'">Delete</a></td></tr>';
}
$out .='<tbody id="employee_data"></tbody></table>';  
echo ($out);
function close($conn){
    mysqli_close($conn);   
}
?>
<script type="text/javascript" language="javascript">
$(document).ready(function()){
function fetch_employee_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   dataType:"json",
   success:function(data)
   {
    for(var count=0; count<data.length; count++)
    {
     var html_data = '<tr><td>'+data[count].id+'</td>';
     html_data += '<td data-name="name" class="name" data-type="text" data-pk="'+data[count].id+'">'+data[count].name+'</td>';
     html_data += '<td data-name="email" class="email" data-type="select" data-pk="'+data[count].id+'">'+data[count].email+'</td>';
     html_data += '<td data-name="comment" class="comment" data-type="text" data-pk="'+data[count].id+'">'+data[count].comment+'</td>';
     html_data += '<td data-name="file" class="file" data-type="text" data-pk="'+data[count].id+'">'+data[count].file+'</td></tr>';
     $('#employee_data').append(html_data);
    }
   }
  });
 }
 //fetch_employee_data()

 $('#employee_data').editable({
  container: 'body',
  selector: 'td.name',
  url: "update.php",
  title: 'Employee Name',
  type: "POST",
  //dataType: 'json',
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'This field is required';
   }
  }
 });
 
 $('#employee_data').editable({
  container: 'body',
  selector: 'td.email',
  url: "update.php",
  title: 'Email',
  type: "POST",
  dataType: 'json',
//   source: [{value: "Male", text: "Male"}, {value: "Female", text: "Female"}],
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'This field is required';
   }
  }
 });
 
 $('#employee_data').editable({
  container: 'body',
  selector: 'td.comment',
  url: "update.php",
  title: 'Comment',
  type: "POST",
  dataType: 'json',
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'This field is required';
   }
  }
 });
 
 $('#employee_data').editable({
  container: 'body',
  selector: 'td.file',
  url: "update.php",
  title: 'File',
  type: "POST",
  dataType: 'json',
  validate: function(value){
   if($.trim(value) == '')
   {
    return 'This field is required';
   }
  }
 });

});
</script>

<?php

