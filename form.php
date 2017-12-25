<?php
// define variables and set to empty values
$nameErr = $ageErr = $genderErr = $favColorErr = "";
$name = $age = $gender = $comment = $favoriteColor = "";
$dogOwned = $catOwned = $birdOwned = "";
 
//Check to see if superglobals are set and put them in local variables
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
  //clean Name input and put the global name into local name variable
  if(isset($_GET["name"]) && strlen($_GET["name"]) > 0){
    $name = cleanInput($_GET["name"]);
    // check if name only contains letters and whitespace - regular expression from W3Schools
    if(!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  } else {
      if(isset($_GET["submit"]) && !empty($_GET["submit"]))
      {
        $nameErr = "Name is required";
      }
  }
  
  //clean Age input and put the global age into local age variable
  if(isset($_GET["age"]) && strlen($_GET["age"]) > 0){
      $age = cleanInput($_GET["age"]);
      // check if age is an integer
      if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 0 || $age > 120) {
        $ageErr = "Invalid age format"; 
      } 
    } else{
    if(isset($_GET["submit"]) && !empty($_GET["submit"]))
      {
        $ageErr = "Age is required";      
      }
    }
  
  //clean Gender input and put the global gender into local gender variable
  if(isset($_GET["gender"])){
    $gender = cleanInput($_GET["gender"]);
    // check to see if gender is valid
    if (!($gender == "male" || $gender == "female")) {
      $genderErr = "Invalid gender"; 
    }
  } 
  else {
    if(isset($_GET["submit"]) && !empty($_GET["submit"]))
      {
        $genderErr = "Gender is required";
      }
  }
  //clean Comment input and put the global comment into local comment variable
  if(isset($_GET["comment"])){
    $comment = cleanInput($_GET["comment"]);
  }
  else{
    $comment = "";
  }
  //clean Favorite Color input and put the global favoriteColor into local favoriteColor variable
  if(isset($_GET["favoriteColor"]) && !empty($_GET["favoriteColor"])){
    $favoriteColor = cleanInput($_GET["favoriteColor"]);
    //check to see if favoriteColor is valid
     if (!($favoriteColor == "blue" || $favoriteColor == "red" || $favoriteColor == "green" || $favoriteColor == "orange")) {
      $favColorErr = "Invalid Color";   
     }
  }
  else{
    if(isset($_GET["submit"]) && !empty($_GET["submit"]))
      {
         $favColorErr = "Favorite Color is required";
      }
  }
 
  //clean Dog Owned input and put the global dogOwned into local dogOwned variable
  if(isset($_GET["dogOwned"])){
    $dogOwned = cleanInput($_GET["dogOwned"]);
  }
  else{
    $dogOwned = false;
  }
  
  //clean Cat Owned input and put the global catOwned into local catOwned variable
  if(isset($_GET["catOwned"])){
    $catOwned = cleanInput($_GET["catOwned"]);
  }
  else{
    $catOwned = false;
  }
  
  //clean Bird Owned input and put the global birdOwned into local birdOwned variable
  if(isset($_GET["birdOwned"])){
    $birdOwned = cleanInput($_GET["birdOwned"]);
  }
  else{
    $birdOwned = false;
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
  if(empty($nameErr) && empty($ageErr) && empty($genderErr) && empty($favColorErr) && !empty($_GET["submit"])){
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