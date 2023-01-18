<!DOCTYPE html>
<html>
<head>
	<title></title>
<!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

	<style type="text/css">

body{
	    font-family: 'Merriweather', serif;
}

.rating {
  unicode-bidi: bidi-override;
  direction: rtl;
  text-align: center;
}
.rating > span:hover:before,
.rating > span:hover ~ span:before {
   content: "\2605";
   position: absolute;
   left: 0;
   color: gold;
}
.rating > span {
  display: inline-block;
  position: relative;
  width: 1.1em;
}
.rating > span:hover,
.rating > span:hover ~ span {
  color: transparent;
}



.star-cb-group {
  /* remove inline-block whitespace */
  font-size: 0;
  /* flip the order so we can use the + and ~ combinators */
  unicode-bidi: bidi-override;
  direction: rtl;
  /* the hidden clearer */
}
.star-cb-group * {
  font-size: 2rem;
}
.star-cb-group > input {
  display: none;
}
.star-cb-group > input + label {
  /* only enough room for the star */
  display: inline-block;
  overflow: hidden;
  text-indent: 9999px;
  width: 1em;
  white-space: nowrap;
  cursor: pointer;
}
.star-cb-group > input + label:before {
  display: inline-block;
  text-indent: -9999px;
  content: "☆";
  color: #888;
}
.star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
  content: "★";
  color: #e52;
  text-shadow: 0 0 1px #333;
}
.star-cb-group > .star-cb-clear + label {
  text-indent: -9999px;
  width: .5em;
  margin-left: -.5em;
}
.star-cb-group > .star-cb-clear + label:before {
  width: .5em;
}
.star-cb-group:hover > input + label:before {
  content: "☆";
  color: #888;
  text-shadow: none;
}
.star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
  content: "★";
  color: #e52;
  text-shadow: 0 0 1px #333;
}

textarea:hover{
	border: 1px solid #000;
}
	</style>
</head>
<body>

<form action="save-rating.php" method="POST">

	<input type="hidden" name="item-id" value="<?php echo $_GET['pid']; ?>">
  <input type="hidden" name="account-id" value="<?php echo $_GET['account']; ?>">

  <fieldset style="width: 15%; border: none; border-right: 1px solid #767676; display: inline;">
    <span class="star-cb-group">
      <input type="radio" id="rating-5" name="rating" value="5" />
      <label for="rating-5">5</label>
      <input type="radio" id="rating-4" name="rating" value="4" checked="checked" />
      <label for="rating-4">4</label>
      <input type="radio" id="rating-3" name="rating" value="3" />
      <label for="rating-3">3</label>
      <input type="radio" id="rating-2" name="rating" value="2" />
      <label for="rating-2">2</label>
      <input type="radio" id="rating-1" name="rating" value="1" />
      <label for="rating-1">1</label>
      <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" />
      <label for="rating-0">0</label>
    </span>
  </fieldset>

<textarea name="review" style="width: 35%; height: 32px; border: none; resize: none; padding: 16px; border-left:1px solid #767676; position: absolute; top: 8.1%; left: 18%;" placeholder="Write your full Review here...."></textarea>

<button type="submit" class="submit-btn" value="Submit" style="position: absolute; left: 57%; position: absolute;
    left: 57%;  border-radius: 6px;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    width: 8%;
    height: 38px;
    cursor: pointer;">Submit</button>

</form>



</body>
</html>

<script src="https://cityindia.in/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript">
	$("[name=rating]").click(function(){
            var radioValue = $("[name=rating]:checked").val();
            if(radioValue){
                //alert("Your are a - " + radioValue);
            }
        });
</script>