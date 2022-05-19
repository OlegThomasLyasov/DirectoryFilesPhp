$('.choose').click(function(){
    var _this = this;
    document.getElementById("name_file").style.display = "block";
    document.getElementById("name_file").value = _this['id'];
    document.getElementById('name_file').dispatchEvent(new Event('change'));
});
$('.chooseFile').click(function(){
    var _this = this;
    document.getElementById("name_file_delete").style.display = "block";
    document.getElementById("name_file_delete").value = _this['id'];
    document.getElementById('name_file_delete').dispatchEvent(new Event('change'));
});
$('.chooseFileDownload').click(function(){
    var _this = this;
    document.getElementById("name_file_download").style.display = "block";
    document.getElementById("name_file_download").value = _this['id'];
    document.getElementById('name_file_download').dispatchEvent(new Event('change'));
});
$('.chooseFolder').click(function(){
    var _this = this;
    document.getElementById("name_folder_delete").style.display = "block";
    document.getElementById("name_folder_delete").value = _this['id'];
    document.getElementById('name_folder_delete').dispatchEvent(new Event('change'));
});
$('.chooseFolderCreate').click(function(){
    var _this = this;
    document.getElementById("name_folder_create").style.display = "block";
    document.getElementById("name_folder_create").value = _this['id'];
    document.getElementById('name_folder_create').dispatchEvent(new Event('change'));
});
$('.chooseReFile').click(function(){
    var _this = this;
    document.getElementById("name_file_rename").style.display = "block";
    document.getElementById("name_file_rename").value = _this['id'];
    document.getElementById('name_file_rename').dispatchEvent(new Event('change'));
});
$('.chooseReFolder').click(function(){
    var _this = this;
    document.getElementById("name_folder_rename").style.display = "block";
    document.getElementById("name_folder_rename").value = _this['id'];
    document.getElementById('name_folder_rename').dispatchEvent(new Event('change'));
});