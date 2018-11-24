document.getElementById('try_this').addEventListener('change', readURL, true);
function readURL(){
   var file = document.getElementById("try_this").files[0];
   var reader = new FileReader();
   reader.onloadend = function(){
      document.getElementById('upload').style.backgroundImage = "url(" + reader.result + ")";        
   }
   if(file){
      reader.readAsDataURL(file);
    }else{
    }
}