<?
  include("db.php");
  $db = new db;
  if($posted = $db->posted_data($_POST['signup'])){
    if($db->insert($posted,"people")) echo "inserted sucessfully";
  }
?>
<form action="" method="post">
  <div><label>Name</label><input type="text" name="signup[first_name]" /></div>
  <div><label>surname</label><input type="text" name="signup[surname]" /></div>
  <div><label>email</label><input type="text" name="signup[email]" /></div>
  <div><input type="submit" value="submit" /></div>
</form>


