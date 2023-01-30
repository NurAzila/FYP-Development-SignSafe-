import Dropzone from "dropzone";

var myDropzone = new Dropzone("#myDropzone", {
  url: "/file/upload", // specify the URL where the files will be uploaded
  acceptedFiles: ".pdf",".doc",".docx",".jpeg",".jpg",".png",
  maxFilesize: 30, 
});

myDropzone.on("success", function(file, response) {
  // handle successful upload
});

myDropzone.on("error", function(file, response) {
  // handle upload error
});

myDropzone.on("complete", function(file) {
  // handle completed upload
});

myDropzone.on("addedfile", function(file) {
  // handle added file
});