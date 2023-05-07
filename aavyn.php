 <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "DBProject";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // // Check connection
    // if ($conn->connect_error) 
    //     die("Connection failed: " . $conn->connect_error);
    // else
    //     echo "Connected successfully";

    $sql = "Create DATABASE DBProject";

    //mysqli_query($conn,$sql);

    $customer="create table customer
    (
        Customer_ID INT NOT NULL,
	    CustomerName varchar(20),
        customerphone BIGINT,
        VehicleType varchar(10),
        Primary key(customer_ID)
    )"; 
    //mysqli_query($conn,$customer);

    $CarSeller="create table CarSeller
    (
        CarRegistration_No varchar(30),
        Cseller_ID INT,
	    CSellerName varchar(20),
        Csellerphone BIGINT,
        primary key(CarRegistration_No)
    )";
    //mysqli_query($conn,$CarSeller);

    $Car="create table Car
    (
        ModelYear int,
        Registration_No varchar(30),
        CarType varchar(30),
        Brand varchar(30),
        color varchar(10),
        Location varchar(10),
        Adress varchar(50),
        Car_Price INT,
        FuelType varchar(20),
        EngineCapacity int,
        transmission varchar(20),
        FOREIGN key(Registration_No) REFERENCES CarSeller(CarRegistration_No),
        Primary key(Registration_No)
    )";
    //mysqli_query($conn,$Car);

    $RentCars="create table RentCars
    (
        CarType varchar(30),
        Registration_No varchar(30) primary key,
        color varchar(10),
        ModelYear int,
        PricePerDay int,
        Location varchar(10),
        Adress varchar(50),
        OwnerName varchar(30),
        OwnerPhoneNO BIGINT
    )";
    //mysqli_query($conn,$RentCars);

    $RentserviceGetter="create table RentserviceGetter  
    (
        Customer_ID INT NOT NULL,
	    CustomerName varchar(20),
        customerphone BIGINT,
        Registration_No varchar(30),
        Primary key(customer_ID),
        FOREIGN key(Registration_No) REFERENCES RentCars(Registration_No)
    )";
    //mysqli_query($conn,$RentserviceGetter);

    $sales_invoice="create table sales_invoice
    (
        InvoiceID int primary key,
        seller_ID INT NOT NULL,
        customer_ID INT NOT NULL,
        Total_payment int NOT NULL,
        Registration_No varchar(30),
        VehicleType varchar(10)
    )";
    //mysqli_query($conn,$sales_invoice);

    $BikeSeller="create table BikeSeller
    (
        Bseller_ID INT ,
	    BSellerName varchar(20),
        Bsellerphone BIGINT,
        Registration_No varchar(30),
        Primary key(Registration_No)
    )";
    //mysqli_query($conn,$BikeSeller);

    $Bikes="create table Bikes 
    (
        Registration_No varchar(30) primary key,
        BikeType varchar(20),
        Comapany varchar(20),
        Bike_Price INT,
        color varchar(10),
	    Engin_CCs int not NULL,
        Location varchar(10),
        Adress varchar(50),
        FOREIGN key(Registration_No) REFERENCES BikeSeller(Registration_No)
    )";

   $ModelYear=$_POST["ModelYear"];    
   $RegistrationNO=$_POST["RegistrationNO"];   
   $Color=$_POST["color"];       
   $Cartype=$_POST["CarType"];       
   $Carprice=$_POST["Car_Price"];       
   $fueltype=$_POST["FuelType"];
   $enginecapacity=$_POST["EngineCapacity"];       
   $transmission=$_POST["transmission"];       
   $location=$_POST["Location"];       
   $Adress=$_POST["Adress"];              
   $SellerName=$_POST["SellerNAme"];       
   $phone=$_POST["phoneNo"];   


    //$sellerid=0;
    // $sellerid++;


    // Check if the sellerid has already been set in the session
    // if (!isset($_SESSION['sellerid'])) 
    // {
    //     // If not, initialize it to 0
    //     $_SESSION['sellerid'] = 0;
    // }

    // // Increment the sellerid
    // $_SESSION['sellerid']++;

    // // Output the current value of the sellerid
    // echo "The current sellerid is: " . $_SESSION['sellerid'];
    // echo "<br>";
   
   $seller="insert into carseller (Cseller_ID,CSellerName,Csellerphone,CarRegistration_No) 
    values ('$sellerid','$SellerName','$phone','$RegistrationNO')";
    
   // mysqli_query($conn,$seller);

   $carinsertdata="insert into car ( ModelYear ,Registration_No ,color ,CarType 
   ,Car_Price ,FuelType ,EngineCapacity ,transmission ,Location ,Adress) 
    values ('$ModelYear','$RegistrationNO','$Color','$Cartype','$Carprice',
    '$fueltype','$enginecapacity','$transmission','$location','$Adress')";
   
    //mysqli_query($conn,$carinsertdata);
    
   

    //1-
    $phpcarprice=0;
    $caronpriceget="CREATE PROCEDURE price (IN price1 INT)
                    BEGIN      
                    SELECT * 
                    FROM Car 
                    WHERE Car.Car_Price = price1 
                    ORDER BY Car.Car_Price ASC;
                    END;";

    $exexcutecarprocedure="CALL price('$phpcarprice')";
    
    $Result=mysqli_query($conn, $exexcutecarprocedure);
  
    $numofrows=mysqli_num_rows($Result);

    $myArray = array();
    $i=0;
    $s=$numofrows;
    while($numofrows!=0)
    {
        $row=mysqli_fetch_assoc($Result);
        $myArray[$i][0]=$row['ModelYear'];
        $myArray[$i][1]=$row['Registration_No'];
        $myArray[$i][2]=$row['CarType'];
        $myArray[$i][3]=$row['color'];

        $i++;
        $numofrows--;
    }
    $i=0;
    while($s!=0)
    {
        echo "                 " . $myArray[$i][0];
        echo "                 " . $myArray[$i][1];
        echo "                 " . $myArray[$i][2];
        echo "                 " . $myArray[$i][3];

        echo "<br><br>";
        $i++;
        $s--;
    }

?>