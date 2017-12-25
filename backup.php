<?php
// define variables and set to empty values
$nameErr = $ageErr = $genderErr = $favColorErr = "";
$name = $age = $gender = $comment = $favoriteColor = "";
$dogOwned = $catOwned = $birdOwned = "";
 
//Check to see if superglobals are set and put them in local variables
if(isset($_GET["name"])){
  $name = $_GET["name"];
}

if(isset($_GET["age"])){
$age = $_GET["age"];
}

if(isset($_GET["gender"])){
$gender = $_GET["gender"];
}
  
if(isset($_GET["comment"])){
$comment = $_GET["comment"];
}
  
if(isset($_GET["favoriteColor"])){
$favoriteColor = $_GET["favoriteColor"];
}

if(isset($_GET["dogOwned"])){
$dogOwned = $_GET["dogOwned"];
}
  
if(isset($_GET["catOwned"])){
$catOwned = $_GET["catOwned"];
}
  
if(isset($_GET["birdOwned"])){
$birdOwned = $_GET["birdOwned"];
}
?>
<?php 
//Validate inputs and put the cleaned global variables into local variables
// request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (empty($name)) {
    $nameErr = "Name is required";
  } else {
    $name = cleanInput($name);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($age)) {
    $ageErr = "Age is required";
  } else {
    $age = cleanInput($age);
    // check if age is an integer
    if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 0 || $age > 120) {
      $ageErr = "Invalid age format"; 
    }
  }
    
  if (empty($dogOwned)) {
    $dogOwned = false;
  } else {
    $dogOwned = cleanInput($dogOwned);
  }
  
  if (empty($catOwned)) {
    $catOwned = false;
  } else {
    $catOwned = cleanInput($catOwned);
  }
  
  if (empty($birdOwned)) {
    $birdOwned = false;
  } else {
    $birdOwned = cleanInput($birdOwned);
  }

  if (empty($comment)) {
    $comment = "";
  } else {
    $comment = cleanInput($comment);
  }

  if (empty($gender)) {
    $genderErr = "Gender is required";
  } else {
    $gender = cleanInput($gender);
    // check to see if gender is valid
    if (!($gender == "male" || $gender == "female")) {
      $genderErr = "Invalid gender"; 
    }
  }
  
  if (empty($favoriteColor)) {
    $favColorErr = "Favorite Color is required";
  } else {
    $favoriteColor = cleanInput($favoriteColor);
    //check to see if favoriteColor is valid
     if (!($favoriteColor == "blue" || $favoriteColor == "red" || $favoriteColor == "green" || $favoriteColor == "orange")) {
      $favColorErr = "Invalid Color"; 
    }
  }
} //end Server GET "if"

//function to clean the inputs - Got help from W3 Schools
function cleanInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  



<!-- name, comment, and gender html from W3 Schools -->
<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Age: <input type="text" name="age" value="<?php echo $age;?>">
  <span class="error">* <?php echo $ageErr;?></span>
  <br><br>
  Favorite Color: 
  <select name="favoriteColor">
        <option value="" ></option>
        <option <?php if (isset($favoriteColor) && $favoriteColor=="blue") echo "selected";?> value="blue">Blue</option>
        <option <?php if (isset($favoriteColor) && $favoriteColor=="red") echo "selected";?> value="red">Red</option>
        <option <?php if (isset($favoriteColor) && $favoriteColor=="green") echo "selected";?> value="green">Green</option>
        <option <?php if (isset($favoriteColor) && $favoriteColor=="orange") echo "selected";?> value="orange">Orange</option>
  </select>
    <span class="error">* <?php echo $favColorErr;?></span>
    <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  
  Pets Owned:
    Dog<input type="checkbox" name="dogOwned" value="Dog" <?php if (isset($dogOwned) && $dogOwned) echo "checked";?> >
    Cat<input type="checkbox" name="catOwned" value="Cat" <?php if (isset($catOwned) && $catOwned) echo "checked";?> >
    Bird<input type="checkbox" name="birdOwned" value="Bird" <?php if (isset($birdOwned) && $birdOwned) echo "checked";?> >
  <br><br>
  
  Comments: <br><textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

<?php
//If all required fields have been input, output the information. Otherwise, display the errors
if(empty($nameErr) && empty($ageErr) && empty($genderErr) && empty($favColorErr)){
  echo "Hello, {$name}.";
  echo "<br>\n";
  echo "You are $age years old.";
  echo "<br>\n";
  echo "Your favorite color is {$favoriteColor}.";
  echo "<br>\n";
  echo "Your gender is {$gender}.";
  echo "<br>\n";

  if($dogOwned){
    echo "You do own a dog.";
  }
  else{
    echo "You do not own a dog.";
  }
  echo "<br>\n";

  if($catOwned){
    echo "You do own a cat.";
  }
  else{
    echo "You do not own a cat.";
  }
  echo "<br>\n";

  if($birdOwned){
    echo "You do own a bird.";
  }
  else{
    echo "You do not own a bird.";
  }
  echo "<br>\n";

  if(empty($comment)){
    echo "You did not leave a comment.";
  }
  else{
    echo "You left the following comment: $comment";
  }
}
?>

</body>
</html>