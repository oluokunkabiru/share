<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OIC SHARE</title>
    <link rel="stylesheet" href="bootsrap/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free/css/all.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="images/oic.png">
    <style>
      .container img{
        width: 40%;
        color: #ffa500;
      }
      @media screen and (max-width: 768px) {
        h1{
          font-size: 21px;
        }
        .container img{
            width: 40%;
            margin-left: 30%;
            margin-right: 30%;
           
        }

      }

      #snackbar {
  visibility: hidden;
  min-width: 250px;
  margin-left: -125px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 17px;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}
    </style>
</head>
<body>
    <div class="jumbotron bg-light text-dark">
          <div class="container">
            <div class="row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <img src="images/oic.png" class="float-left circle-rounded card-img"  alt="OIC LOGO">
              </div>
              <div class="col-md-4"></div>
          </div>
        </div>
        <h1 class="font-weight-bold text-center">OIC HUB FILE SHARE SOFTWARE</h1>
        
      
        <!-- upload files -->
        <div class="container mt-3">
            <h3 class="text-center">Upload Files</h3>
            
            <p class="error text-danger"></p>
            <form id="formupload" enctype="multipart/form-data"  >
                  <div class="form-group">
                    <label for="">Choose Your file</label><br>
                    <input type="file" id="file" multiple name="file[]">
                  </div>
                  <div class="form-group">
                    <input type="submit" id="submit" name="submit" value="Post" class="btn btn-primary">
                  </div>
                  <!-- progressinve bar for uploading status -->
                  <div class="progress" style="height: 25px;">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
      
                    </div>
                  </div>
                  <!-- show processing uploading -->
                  <div class="processing" style="display: none; margin-left: 45%; margin-right: 45%;">
                    
                  </div>
                  <!-- show percent uploading -->
                  <div class="text-center">
                     <h3 class="percent p-4 font-weight-bold"></h3>
                  </div>
            </form>
      
            </div>
    
        <!-- /upload files -->

        <!-- download files -->
        <div class="container">
            <h3 class="text-center">Download files </h3>
            
                <!-- <div class="card" style="width: 50%;" > -->
                  <div class="card-head mb-2">
                    <form>
                        <div class="input-group">
                            <input type="search" class="form-control-lg" placeholder="Seach for file" onkeyup="search(this.value)" style="width: 30%;">
                        </div>
                    </form> 
                
                <p id="result" class="mt-2"></p>
                </div>
                 
                <div class="card-columns">
                    <?php 
                     $dir = "uploads/";
                     if(is_dir($dir)){
                       $support = ["mp4", "mkv", "3gp", "mp3"];

                       $files = scandir($dir);
                       foreach($files as $file){
                         if(strlen($file)>2){
                           $ext = strtolower(pathinfo($file,PATHINFO_EXTENSION));
                          $link="";

                          $watch = "";
                          if(in_array($ext, $support)){
                            $watch = ' <a href="view-video.php?video='.$file.'" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Watch</a> ';
                            $link = ' <span class="text-warning" onclick="fileCopy(this.id)" id="http://'.$_SERVER['HTTP_HOST'].'/share/'.$dir.str_replace(" ", "%20",$file).'"><span class="fa fa-copy"></span></span> ';
                          }

                           $display = strlen($file) > 24 ? substr($file, 0, 24)." ...":$file;
                          echo' <div class="car">
                            <div class="card-body">
                              <a href="'.$dir.$file.'" class="btn btn-dark" download>'.$display.'</a>  '.$watch.' '.$link.'
                            </div>
                           </div>';
                         }
                       }
                     }else{
                           echo '<h3 class = "text-danger" >No file Available to Download</h3>';
                         }
                    ?>
                </div>
            
                
              
        </div>
        <!-- /download end -->

        <div id="snackbar"></div>

    </div>
    <!-- /jumbron end -->

    <!-- footer -->
    <footer>
        <div class="jumbotron-fluid bg-dark text-light p-4 text-center text-light ">
            <p class="text-light">Copyright &copy;2020  . All Rights Reserved | Designed by <b><a href="https://github.com/oluokunkabiru" 
                 class="text-light"> Oluokun Kabiru Adesina</a> and <a href="#" class="text-light">Ibikunle Johnson</a></b></p>
                 <input type="hidden" value="" id="copyit">
        </div>
    </footer>
</body>
</html>
<script src="bootsrap/jquery.js"></script>
<script src="bootsrap/popper.js"></script>
<script src="bootsrap/bootstrap.min.js"></script>
<script src="app.js"></script>
<script>   
    $(document).ready(function(){
    $('#formupload').submit(function(e){
        e.preventDefault();
        var datas = new FormData(this);
        $.ajax({
          xhr: function(){
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function(event){
                if(event.lengthComputable){
                  var percentage = Math.floor((event.loaded/event.total)*100);
                  $('.progress-bar').width(percentage+'%');
                  $('.progress-bar').html(percentage+'%');
                  $('.percent').html(percentage+'%');
                }

            }, false);
            return xhr;
          },
          type:'POST',
          url:'upload.php',
          data: datas,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend: function(){
            $('.progress-bar').width('0%');
            $('.processing').show();
            $('.processing').html('<button class="btn btn-warning" disabled><span class="spinner-border spinner-border-sm"></span>Loading...</button>')
          },
          error:function(){
            $('.processing').html("Fail to Upload");
          },
          success: function(response){
              $('.error').html(response);
               $('.processing').hide();
               $('.progress-bar').width('0%');
          },
          
        });
       
    })
     $('#file').change(function(){
          var file = this.files[0];
          var type  = file.type;

        })




  


  })

  function fileCopy(text) {
  // alert(text);
  var txt = $("<input>").val(text).appendTo("body").select();
 
  document.execCommand("copy");
  var x = document.getElementById("snackbar");
      $("#snackbar").text("Copied "+text);

  x.className = "show";
  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  txt.remove();
}

//   seach throught the files
  function search(str) {
    if (str.length == 0) {
        document.getElementById("result").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("result").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "upload.php?q=" + str, true);
        xmlhttp.send();
    }
}


             
</script>


