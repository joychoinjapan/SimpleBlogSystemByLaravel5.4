var editor = new wangEditor('content');
if(editor.config){
editor.config.uploadImgUrl='/posts/image/upload';
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};
editor.create();
}

//头像预览的功能
$(".preview_input").change(function (event) {
    var file=event.currentTarget.files[0];
    var url=window.URL.createObjectURL(file);
    $(event.target).next('.preview_img').attr('src',url);
});