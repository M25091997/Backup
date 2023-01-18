<?php 

session_start();

include ("../../config.php");
$astro_id = $_GET['astro_id'];

?>

<!DOCTYPE html>

<html>

<head>

        <title>Add Blog</title>

        <!--Font-->

<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>



<!-- JQUERY-->

<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>



<!--Live Form-->

<script src="../../assets/js/liveform.js"></script>



<!--Drop Zone-->

<script src="../../assets/js/dropzone.js"></script> <script src="../../assets/js/dashboard.js"></script>

<link rel="stylesheet" href="../../assets/css/dropzone.css">



<!--Latest compiled and minified CSS-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css" crossorigin="anonymous">



<!--Latest compiled and minified JavaScript-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>



<!--FONT AWESOME-->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">



<!--VIEWPORT-->

<meta name="viewport" content="width=device-width, initial-scale=1">



<!--TINE MCE-->

<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5v5kn3p7q2v385g8mya78lovcvcm4okduo2x1wb1m1q92plc'></script>


<style type="text/css">

.img-box: hover{
        border: 1px solid #ccc;
}

        .media-gallery-button{
                color: #000000;
    background-color: #ffffff;
    border-color: #ababab;
        }

        .media-gallery-button:hover{
                color: #fff;
    background-color: #000;
    border-color: #ababab;
        }


        .preview-btn-right{
                color: #000000;
    background-color: #ffffff;
    border-color: #ababab;
    font-size: 14px !important;
        }

        .preview-btn-right:hover{
                color: #fff;
    background-color: #000;
    border-color: #ababab;
        }

</style>


<script type="text/javascript">

        tinymce.init({

        /* replace textarea having class .tinymce with tinymce editor */

        selector: "textarea",

        

        /* theme of the editor */

        theme: "modern",

        skin: "lightgray",

        

        /* width and height of the editor */

        width: "100%",

        height: 300,

        

        /* display statusbar */

        statubar: true,

        

        /* plugin */

        plugins: [

                "advlist autolink link image lists charmap print preview hr anchor pagebreak",

                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",

                "save table contextmenu directionality emoticons template paste textcolor",

                "powerpaste"

                //"tinydrive"

        ],



        /* toolbar */

        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | insertfile",

        

        /* style */

        style_formats: [

                {title: "Headers", items: [

                        {title: "Header 1", format: "h1"},

                        {title: "Header 2", format: "h2"},

                        {title: "Header 3", format: "h3"},

                        {title: "Header 4", format: "h4"},

                        {title: "Header 5", format: "h5"},

                        {title: "Header 6", format: "h6"}

                ]},

                {title: "Inline", items: [

                        {title: "Bold", icon: "bold", format: "bold"},

                        {title: "Italic", icon: "italic", format: "italic"},

                        {title: "Underline", icon: "underline", format: "underline"},

                        {title: "Strikethrough", icon: "strikethrough", format: "strikethrough"},

                        {title: "Superscript", icon: "superscript", format: "superscript"},

                        {title: "Subscript", icon: "subscript", format: "subscript"},

                        {title: "Code", icon: "code", format: "code"}

                ]},

                {title: "Blocks", items: [

                        {title: "Paragraph", format: "p"},

                        {title: "Blockquote", format: "blockquote"},

                        {title: "Div", format: "div"},

                        {title: "Pre", format: "pre"}

                ]},

                {title: "Alignment", items: [

                        {title: "Left", icon: "alignleft", format: "alignleft"},

                        {title: "Center", icon: "aligncenter", format: "aligncenter"},

                        {title: "Right", icon: "alignright", format: "alignright"},

                        {title: "Justify", icon: "alignjustify", format: "alignjustify"}

                ]}

        ]

});

</script>





</script>



<style type="text/css">

        body{

                background-color: #efefef;

        }

</style>


<style type="text/css">

                @keyframes placeHolderShimmer{
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}

.animated-background {
    animation-duration: 0.8s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f6f7f8;
    background: linear-gradient(to right, #eeeeee 8%, #dddddd 18%, #eeeeee 33%);
    background-size: 800px 104px;
    height: 50px;
    position: relative;
    border-radius:3px;
}


  .float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#000;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  box-shadow: 2px 2px 3px #999;
  z-index: 9999;
}

.my-float{
  margin-top:22px;
}
</style>



</head>

<body>




<!-- <a href="index.php" class="float">
<i class="fa fa-home my-float"></i>
</a> -->




<div class="container" style="background-color: #fff;">

<h2 style="border-bottom: 1px solid #efefef;">ADD BLOG Or</h2><a href="add-blog-pdf.php"><span class="btn btn-info">Upload Blog Pdf</span></a>





<div class="row">







        <div class="col-md-8" style="border-right: 1px solid #efefef; ">



        <form class="" action="save-blog.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" class="preview" name="preview" value="0">
        <input type="hidden" name="astro_id" value="<?php echo $astro_id; ?>">


        <input type="hidden" name="media-number" class="product_number_creator" value="<?php echo time().rand(); ?>"></input>

        <!-- <h3 class="text-left">Page Title <a href="javascript:(0)" class="btn btn-primary media-gallery-button" data-toggle="modal" data-target="#libModal" ><i class="fa fa-picture-o" aria-hidden="true"></i> Media Library</a> <button type="button" class="btn btn-primary preview-btn-right" style="font-size: 20px;"> <i class="fa fa-eye"></i> Preview</button> </h3> -->

        <input type="text" style="font-weight: 800;" class="form-control p-title" name="title" placeholder="Enter Blog Title" required></input>

        <textarea name="body"></textarea>

        <div class="row">

        <center>

                <button type="submit" class="btn btn-info save-btn " style="font-size: 20px; display: none;">Publish</button>

        </center>

        </div>

        </form>



        </div>







        <div class="col-md-4">

                <h3><b>FEATURED IMAGE</b></h3>

 <form action="parser-blog.php" class="dropzone col-md-12" style="background-color:#fff; border: none; border: 1px solid #efefef; border-radius: 3px;">



<input type="hidden" value="none" class="product_number" name="product_number"></input>

</form>

<script type="text/javascript">

  $(".dropzone").dropzone({

    maxFiles: 5,

    dictDefaultMessage: '<img src="drop.png"></img> <br><br><span style="font-size:12px;"> Drag And Drop Or Click here to upload Post Featured Image <br> Image Size Should Be 750*400 or more</span>',

    /*acceptedFiles: 'image/*',*/
    acceptedFiles: '.jpg, .jpeg, .png',
    maxFilesize: 1, // MB

    init: function() {

    this.on('success', function( file, resp ){      

    });

  },    

})

</script>


<div class="row">


<div class="col-md-4">

<br>

        <button type="submit" class="btn btn-info save-btn-right" style="font-size: 20px;"> Publish</button>

</div>

<div class="col-md-8 text-left pull-left status-holder" style="line-height: 6;"> Publish this Page now</div>

</div>

        </div>

</div>

</form>



</div>


<!-- Library Modal -->
<div class="modal media-library-modal" style="z-index: 9999999;" id="libModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="width: 85%; z-index: 999999999999999999;">
    <div class="modal-content" style="border-radius: 2px;">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel"><b>Image Library</b></h4>
        <button type="button" class="close" style="    margin-top: -28px;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="row">

          <div class="col-md-8">
                        
                <div class="row lib-holder" style="height: 370px !important;  overflow-y: scroll;">
                        </div>

          </div>

        <div class="col-md-4">                
<div class="upload_img">
        <h4><b>UPLOAD IMAGE</b></h4>

 <form action="parser-media-lib.php" class="dropzone dropzone-mu col-md-12" style="background-color:#fff; border: none; border: 1px solid #efefef; border-radius: 3px;">

<input type="hidden" value="none" class="product_number" name="product_number"></input>

</form>

<script type="text/javascript">

  $(".dropzone-mu").dropzone({

    maxFiles: 4,

    dictDefaultMessage: '<img src="drop.png"></img> <br><br><span style="font-size:12px;"> Drag And Drop Or Click here to upload media to media gallery',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      load_media();

    });

  },    

})

</script>
</div>


<div class="playback"></div>

</div>


        </div>


      </div>
      <div class="modal-footer">
        <div style="float: left; width: 67%"><span style="float: left;"><b>Media Link:</b></span> <input type="text" class="img-link-selected" id="copyTarget" style="width: 100%;" disabled></div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="copyButton" title="Image Link will be copied to Clipboard. Press CTRL + v to paste it to desirable area.">Insert / Copy Link</button>
      </div>
    </div>
  </div>
</div>


</body>

</html>

<script type="text/javascript"> 
$(".float").click(function(){ window.close(); });
</script>

<script type="text/javascript">

$(document).ready(function(){

        $(".product_number").val($(".product_number_creator").val());

        $(".save-btn-right").click(function(){

                $(".save-btn").click();

        });


        $(".preview-btn-right").click(function(){

                $(".preview").val("1");
                $(".save-btn").click();

        });



        $(".p-title").focus();

});


$(".category").change(function(){

$(".sub-category").html("<option value='0'><i>Please Wait...</i></option>");

var data_to_pass = 'id='+$(".category").val();


$.ajax({


type: "POST",

url: "get-sub-category.php",

data: data_to_pass,

cache: false,

success: function(sub_category)


{

$(".sub-category").html(sub_category);



}



});



});


</script>

<style type="text/css">

        .save-btn-right{

                border-radius: 2px;

        }

        body .form-control{

                border-radius: 1px !important;

        }

</style>

<script type="text/javascript">

$('#libModal').on('shown.bs.modal', function () {

load_media();

});

</script>

<script type="text/javascript">
        function load_media () {
                $(".lib-holder").html("<div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div><div class='col-md-3'><div class='animated-background' style='width: 100px; height:100px; margin: 7px;'></div></div>");

var none = "";
$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/admin/panel/get-media-library.php', dataType: 'json', data: none, success: function(lib_json) {  

$(".lib-holder").html(" ");

jQuery(lib_json).each(function(i, object){

$(".lib-holder").append("<div class='col-md-3'><a class='img-box' href='javascript:(0)' onclick='select_media(this);' data-string='"+ object.image +"'><div class='' style='border-radius:3px; width: 100px; height:100px; margin: 7px; background: url(<?php echo $site_url; ?>/images/post-image/"+ object.image.replace(/\s/g,"%20") +");  background-repeat: no-repeat; background-size: 180px;'></div></a></div>");

});
}
});
        }


function select_media(element) {
    var mystring = $(element).data("string");
    $(".img-link-selected").val("<?php echo $site_url; ?>/images/post-image/" + mystring);

    $(".upload_img").hide();

    $(".playback").html('<h4><b>PREVIEW <button onclick="new_img(this);" class="btn btn-warning new-img" style="float:right; margin-top: -12px;">+ Upload New</button> </b></h4><div><center><img src="' + "<?php echo $site_url; ?>/images/post-image/" + mystring + '" class="img-responsive" ></img></center></div>');
    $(".playback").show();

}




</script>


<script>
function new_img() {

$(".playback").hide();
$(".upload_img").show();

}

$("#copyButton").click(function(){

        $( "#copyTarget" ).prop( "disabled", false );

        var copyText = document.getElementById("copyTarget");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");

  $( "#copyTarget" ).prop( "disabled", true );

  $("#libModal").modal("hide");

});
</script>

