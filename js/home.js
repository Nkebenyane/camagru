// Global Vars
let width = 481,
    height = 0,
    filter = 'none',
    streaming = false;

// Document Object Model Elements
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photos = document.getElementById('photos');
const photoButton = document.getElementById('photo-button');
const gallary = document.getElementById('gallary');
const saveButton = document.getElementById('save');
var imgUrl;

// Get media stream
navigator.mediaDevices.getUserMedia({video: true, audio: false})
.then(function(stream) {
    //Link to the video source
    video.srcObject = stream;
    // Play video
    video.play();
})
.catch(function(err) {
    console.log(`Error: ${err}`);
});

// Play when ready
video.addEventListener('canplay', function(e) {
    if (!streaming) {
        //Set video / canvas height
        height = video.videoHeight / (video.videoWidth / width);

        video.setAttribute('width', width);
        video.setAttribute('Height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('Height', height);

        streaming = true;
    }
}, false);

// Photo button event
photoButton.addEventListener('click', function(e) {
    takePicture();

    e.preventDefault();
}, false);



// Take picture from canvas
function takePicture() {
    // Create canvas
    const context = canvas.getContext('2d');
    if (width && height) {
        // set canvas props
        canvas.width = width;
        canvas.height = height;
        // Draw an image of the video on the canvas
        context.drawImage(video, 0, 0, width, height);

        // Create an image from the canvas
        imgUrl = canvas.toDataURL('image/png');

        // Create img element
        const img = document.createElement('img');

        // Set img src
        img.setAttribute('src', imgUrl);

        // Set image filter
        img.style.filter = filter;

        // Add image to photos
        photos.appendChild(img);
        
    }
}

saveButton.addEventListener('click',
   function(e)
   {
       // var x = document.createElement("IMG");
       // console.log(x);
       //var x = canvas.toDataURL("image/png"); // this will generate base64 data
       console.log(imgUrl);
      // document.getElementById("img_dispplay").innerHTML = "<img src='"+x.src+"' width='400' height='300' class='img-responsive'>";
       // document.body.appendChild(x);
       //console.log(img.src);
       //window.location.href = "save.php?value=" + imgUrl;

       var xhttp = new XMLHttpRequest(); //AJAX to communicate js to php
       xhttp.open('POST', 'save_pic.php', true);
       xhttp.setRequestHeader('Content-type', 'Application/x-www-form-urlencoded');
       xhttp.send('key='+encodeURIComponent(imgUrl));
   });