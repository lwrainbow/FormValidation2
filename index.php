<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Personnal Information</title>
<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
    <?php
    $firstName=$lastName=$age=$street=$postalCode=$province="";
    $firstNameErr=$lastNameErr=$ageErr=$streetErr=$postalCodeErr=$provinceErr="";
    $hasError=false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["firstName"])){
            $firstName = test_input($_POST["firstName"]);
            // check if name only contains two character letter or whitespace
            if (!preg_match("/^[a-zA-Z ][a-zA-Z ]+$/", $firstName)){
                $firstNameErr = "At least two character!";
                $hasError = true;
            }    
        }
        
        if (isset($_POST["lastName"])){
            $lastName = test_input($_POST["lastName"]);
            // check if name only contains two character letter or whitespace
            if (!preg_match("/^[a-zA-Z ][a-zA-Z ]+$/", $lastName)){
                $lastNameErr = "At least two character!"; 
                $hasError = true;
            }
        }
        
        if (isset($_POST["age"])){
            $age = test_input($_POST["age"]);
            // check if age is a positive number
            if (!is_numeric($_POST["age"]) || !preg_match("/\A[0-9]+\Z/", $age)){
                $ageErr = "Must enter a positive number!";
                $hasError = true;
            }   
        }
        
        if (isset($_POST["street"])){
            $street = test_input($_POST["street"]);
            // check if street have a number plus a street name
            if (!preg_match("/^[\d]+[ ](?:[A-Za-z]+[ ]?)+$/", $street)){
                $streetErr = "Must have a number plus a street name!";
                $hasError = true;
            }
        }
        
        if (isset($_POST["postalCode"])){
            $postalCode = test_input($_POST["postalCode"]);
            // check if street have a number plus a street name
            if (!preg_match("/^[A-Za-z]\d[A-Za-z][ ]\d[A-Za-z]\d$/", $postalCode)){
                $postalCodeErr = "Postal Codes are in the format ‘A1A 1A1’!";
                $hasError = true;
            }
        }
        
        if (isset($_POST["province"])){
            $province = test_input($_POST["province"]);
            if (preg_match("/no/", $province)){
                $provinceErr = "Must choice a province!";
                $hasError = true;
            }
        }
    }
    
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <h1>Personal Information</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <table>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="firstName" /></td>
                <td class="error"><?php echo $firstNameErr;?></td>
            </tr>
            <tr>
				<td>Last Name: </td>
				<td><input type="text" name="lastName" /></td>
                <td class="error"><?php echo $lastNameErr;?></td>
			</tr>
            <tr>
				<td>Age: </td>
				<td><input type="text" name="age" /></td>
				<td class="error"><?php echo $ageErr;?></td>
			</tr>
			<tr>
				<td>Street: </td>
				<td><input type="text" name="street" /></td>
				<td class="error"><?php echo $streetErr;?></td>
			</tr>
            <tr>
				<td>Postal code: </td>
				<td><input type="text" name="postalCode" /></td>
				<td class="error"><?php echo $postalCodeErr;?></td>
			</tr>
			<tr>
				<td>Province: </td>
				<td><select name="province">
					<option value="no">--</option>
					<option value="AB">AB</option>
					<option value="BC">BC</option>
					<option value="MB">MB</option>
					<option value="NB">NB</option>
					<option value="NL">NL</option>
					<option value="NT">NT</option>
					<option value="NS">NS</option>
					<option value="NU">NU</option>
					<option value="ON">ON</option>
					<option value="PE">PE</option>
					<option value="QC">QC</option>
					<option value="SK">SK</option>
					<option value="YT">YT</option>
				</select></td>
				<td class="error"><?php echo $provinceErr;?></td>
			</tr>
            <tr>
                <td colspan="3"><input type="submit" id="submit" value="Submit"></td>
            </tr>
        </table>
        
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($hasError == false){
            echo "<h1>Your input</h1>";
            echo "<table>";
            echo "<tr>";
            echo "<td>First Name:</td>";
            echo "<td>$firstName</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Last Name:</td>";
            echo "<td>$lastName</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Age:</td>";
            echo "<td>$age</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Street:</td>";
            echo "<td>$street</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Postal code:</td>";
            echo "<td>$postalCode</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Province: </td>";
            echo "<td>$province</td>";
            echo "</tr>";
            echo "</table>";
        }        
    }
    ?>
</body>
</html>