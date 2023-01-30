var dropArea = document.getElementById('dropArea');
var fileInput = document.getElementById('document');
var uploadBtn = document.getElementById('uploadBtn');

// Event listeners
dropArea.addEventListener('dragenter', onDragEnter, false);
dropArea.addEventListener('dragover', onDragOver, false);
dropArea.addEventListener('dragleave', onDragLeave, false);
dropArea.addEventListener('drop', onDrop, false);
fileInput.addEventListener('change', onFileInputChange, false);
uploadBtn.addEventListener('click', onUploadBtnClick, false);

function onDragEnter(e) {
e.stopPropagation();
e.preventDefault();
dropArea.classList.add('drag-over');
}

function onDragOver(e) {
e.stopPropagation();
e.preventDefault();
}

function onDragLeave(e) {
e.stopPropagation();
e.preventDefault();
dropArea.classList.remove('drag-over');
}

function onDrop(e) {
e.stopPropagation();
e.preventDefault();
dropArea.classList.remove('drag-over');
onFilesDrop(e.dataTransfer.files);
}

function onFileInputChange() {
onFilesDrop(fileInput.files);
}

function onFilesDrop(files) {
var validFiles = [];
for (var i = 0; i < files.length; i++) {
var fileExt = files[i].name.substr(files[i].name.lastIndexOf('.') + 1);
if (fileExt === 'pdf' || fileExt === 'doc' || fileExt === 'docx' || fileExt === 'jpeg' || fileExt === 'jpg' || fileExt === 'png') {
validFiles.push(files[i]);
}
}
if (validFiles.length > 0) {
fileInput.files = validFiles;
} else {
alert('Invalid file type. Please select a PDF or Word or PNG or JPG file only.');
}
}

function onUploadBtnClick(e) {
e.preventDefault();
if (fileInput.files.length > 0) {
document.getElementById('uploadForm').submit();
} else {
alert('Please select a file to upload.');
}
}
