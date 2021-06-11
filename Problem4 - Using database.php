<!DOCTYPE html>
<html lang="en">
<head>
  <title>Question4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
	p {
		margin-top: 0;
		margin-bottom: 1rem;
		font-size: 23px;
		font-weight: 500;
	}
	label{
		font-size: 20px;
		font-weight: 600;
	}
	select:invalid { color: gray; }
  </style>
</head>
<body>
	<div class="container">
		<h1 style = "margin-bottom:30px;margin-top:30px;" class = "text-center">Solution for Question4</h1>
		<?php
			/*
			PROBLEM #4:
			Hey Di Di Co ships 3 different products, a fiddle, a dish and a spoon. The shipping department needs an object-oriented PHP program written that allows them to get and set the weight and dimensions of each product as well as create new products as needed.

			They also need a user interface in HTML and JS to interact with the PHP program. It needs to be simple and intuitive to learn as their warehouse manager Mr. Dumpty has recently had a great fall.

			Item Measurements:
			Fiddle: 1 kg, 60cm x 20cm x 10cm
			Dish: 0.1 kg, 30cm 30cm x 5cm
			Spoon: 0.05kg, 15cm x 5cm x 2cm
			*/
			/*Solution for PROBLEM #4 by Indira Pandey*/
			//Creating a class called Products from which we get and set the dimensions of each products
			class Products {
				//The $name,$weight and $dimension are defined private because these variables cannot be accessed directly outside the class
				private $name;
				private $weight;
				private $dimension = array();
				//Constructor method
				public function __construct($name,$weight,array $dimension){
					$this->name = $name;
					$this->weight = $weight;
					$this->dimension = $dimension;
				}
				public function getName(){
					return $this->name;
				}
				public function setName(){
					$this->name = $name; 
				}
				
				public function getWeight(){
					return $this->weight;
				}
				
				public function setWeight($weight){
					$this->weight = $weight;
				}
				
				public function getDimension(){
					return $this->dimension;
				}
				
				public function setDimension($dimension){
					$this->dimension = $dimension;
				}
			}
			
			define("DB_SERVER", "localhost");
			define("DB_USER", "root");
			define("DB_PASSWORD", "");
			define("DB_DATABASE", "passionmedia");
			
			
			// Create database connection
			$connect = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
			// Check connection
			if ($connect->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}
			
			//Getting the input from the form and adding the new product into the database table 'products'
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$ProductName = $_POST['ProductName'];
				$Weight = $_POST['Weight'];
				$Length = $_POST['length'];
				$Width = $_POST['width'];
				$Height = $_POST['height'];
				
				$sql2 = "INSERT INTO products (name, weight, dimension1, dimension2,dimension3) VALUES
					('$ProductName', $Weight,$Length, $Width, $Height)";
				
				if ($connect->query($sql2) === TRUE) {
				  echo "New record created successfully";
				} else {
				  echo "Error: " . $sql2 . "<br>" . $connect->error;
				}	
			
			}
			
			$sql = "SELECT name, weight, dimension1,dimension2,dimension3 FROM products";
			$result = $connect->query($sql);
			if ($result->num_rows > 0) {
			  // output data of each row
				/*Adding(given) products name from the products table into HTML  selection option*/
				echo "
				<div class='row'>
					<div class='col-sm-12'>
						<form>
							<select class='form-control' name='mySelect' onchange='this.form.submit()' >
							<option value=' ' disabled selected>Please select a product from dropdown:</option>";
							while($row = $result->fetch_assoc()) {
									echo "<option value =" .$row['name'].">".$row['name']."</option>";	
							}
							echo '
							</select>
						</form>
					</div>
				</div>
				</br>';
			} else {
			   echo "Products table is empty.";
			}
			//Displaying the output in the DIV based on the selected product from the selection option
			$sql1 = "SELECT name, weight, dimension1,dimension2,dimension3 FROM products";
			$result1 = $connect->query($sql1);
			?><div class="col-sm-12" style = "display:block" id="myDIV">
			<?php			
			if(isset($_GET["mySelect"]) == " " || isset($_GET["mySelect"])){
				while($row = $result1->fetch_assoc()) {
					$product = new Products($row['name'],$row['weight'],array($row['dimension1'],$row['dimension2'],$row['dimension3']));
					if($row['name'] == $_GET["mySelect"] ){
					?>	
					<div>
						<p>Selected Product Name: <b><?php echo $product->getName()?><b></p>
						<p>Weight:   <b><?php echo $product->getWeight().' kg';?></b></p>
						<p for="Dimension">Dimension:   <b><?php echo $product->getDimension()[0].' cm '.' * '.$product->getDimension()[1].' cm '.' * '.$product->getDimension()[2].' cm ';?></b></p>	
					</div>
				<?php
					}
				}
			}
			?>
			</div>
			
			<!--Form for the new product entry-->
			<button type="button" class="btn btn-success" onclick="myFunction()" id = "button">Add Product</button>
			<div class="col-sm-12" id="myDIV1" style = "display:none">		
				<form method = "POST">
					<div class="form-group">
						<label for="ProductName">Product Name:</label>
						<input type="text" class="form-control" id="ProductName" name="ProductName" value="">
					</div>
					<div class="form-group">
						<label for="Weight">Weight (in kg)</label>
						<input type="text" class="form-control" id="Weight"  name="Weight" value="">
					</div>
					<label for="Dimension">Dimension:</label>
					<div class="row">
					<div class="col-sm-4">
						<label for="length">Length (in cm)</label>
						<input type="text" class="form-control" id="length" name="length" value="">
					</div>
					<div class="col-sm-4">
						<label for="width">Width (in cm)</label>
						<input type="text" class="form-control" id="width" name="width" value="">
					</div>
					<div class="col-sm-4">
						<label for="height">Height (in cm)</label>
						<input type="text" class="form-control" id="height" name="height" value="">
					</div>
					</div>
					<br>
					<button type="submit" class="btn btn-success">Submit Product</button>
				</form>
			</div>
			
	</div>
	<script>
	//Toggling the output display div and the form
	function myFunction() {
	  var x = document.getElementById("myDIV");
	  var y = document.getElementById("myDIV1");
	  if (x.style.display === "block" || y.style.display === "none") {
		x.style.display = "none";
		y.style.display = "block";
	  } else {
		x.style.display = "block";
		y.style.display = "none";
	  }
	}
	</script>
</body>
</html>
