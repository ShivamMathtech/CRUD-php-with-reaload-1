<?php
// Check for the incomming data
// Open the DB connection 
$msg ='';
$conn = mysqli_connect("localhost","root","","crud_db") or die(mysqli_error($conn));
if(isset($_GET['datauploaded'])){
    // Get the data and filiter and sanitize it
    
$name = mysqli_real_escape_string($conn, $_GET['name']);
$surname = mysqli_real_escape_string($conn, $_GET['surname']);
$addr = mysqli_real_escape_string($conn, $_GET['addr']);
$mobno = mysqli_real_escape_string($conn, $_GET['mobno']);
    // Build the query
    $sql ="INSERT INTO data_tbl(`name`,`surname`,`address`,`modno`) VALUES ('$name','$surname','$addr','$mobno') ";

    // execute the query
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Display the results
    $msg ="<div class='alert alert-success' role='alert'>
            A simple success alert—check it out!
           </div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD in PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form class="w-50 offset-3 mt-3" action="<?php
      echo $_SERVER['PHP_SELF'] ?>" method="GET">
        <h1 class="text-center">This is CRUD operation in php</h1>
        <?php
        echo $msg;
        ?>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>

        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">surname</label>
            <input type="text" class="form-control" id="surname" name="surname" required>
        </div>
        <div class="mb-3">
            <label for="addr" class="form-label">Address</label>
            <input type="text" class="form-control" id="addr" name="addr" required>
        </div>
        <div class="mb-3">
            <label for="mobnp" class="form-label">Mobile No</label>
            <input type="text" class="form-control" id="mobno" name="mobno" required>
        </div>

        <button type="submit" class="btn btn-primary" name="datauploaded">Submit</button>
    </form>

    <div class="container mt-4">
        <?php
        //build the query 
        $sql ="SELECT * FROM data_tbl";

        // execute the query
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        // Check the number of rows 
        $rowcont = mysqli_num_rows($result);
        $row = '';
        if($rowcont>0){
            // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            while($row2 = mysqli_fetch_assoc($result)){// Assoicative array there is value is stored in the form of the key value pair
                // echo "<pre>";
                //     var_dump($row);
                // echo "</pre>"; 
              $row = $row.'
                         <tr>
                             <td> '.$row2['id'].'</td>
                             <td>'.$row2['name'].'</</td>
                             <td>'.$row2['surname'].'</</td>
                             <td>'.$row2['address'].'</</td>
                             <td>'.$row2['modno'].'</</td>
                             <td>
                                 <button class="btn btn-success">View</button>
                                 <button class="btn btn-warning">Edit</button>
                                 <button class="btn btn-danger">Delete</button>
                             </td>
                          </tr>
                          '  ;
            }
            // 
        }else{

        }
        // display the results

        ?>
        <div class="row m-0">
            <div class="col-md-12 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Address</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            echo $row
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        // alert("data is loaded successfully")
    })
    </script>
</body>

</html>
<?php
// CLose the database connection
mysqli_close($conn);
?>