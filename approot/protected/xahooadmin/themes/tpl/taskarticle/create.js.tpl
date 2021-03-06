<!--编辑器-->
<script src="{$resourcePath}/js/Ueditor/ueditor.config.js"></script>
<script src="{$resourcePath}/js/Ueditor/ueditor.all.js"></script>
<!--引入JS-->
<script type="text/javascript" src="{$resourcePath}/js/webuploader.js"></script>
<script type="text/javascript">
    var editor = new baidu.editor.ui.Editor({});
    editor.render("TaskArticle_task_detail");
</script>
<script type="text/javascript" src="{$resourcePath}/js/webuploader.js"></script>
{literal}
    <script>
        // 图片上传demo
        jQuery(function () {
            var $ = jQuery,
                    $list = $('#fileList'),
                    $btn = $('#ctlBtn'),
                    $filePicker = $("#filePicker"),
                    $hiddenInput = $("#TaskArticle_task_img"),
            // 优化retina, 在retina下这个值是2
                    ratio = window.devicePixelRatio || 1,
            // 缩略图大小
                    thumbnailWidth = 100 * ratio,
                    thumbnailHeight = 100 * ratio,
                    state = 'pending',
            // Web Uploader实例
                    uploader;
            $btn.hide();
            $list.hide();
            // 初始化Web Uploader
            uploader = WebUploader.create({
                formData: {
                    source:'articletask'
                },
                fileVal: 'upfile', //上传的文件域 name
                // 自动上传。
                auto: false,
                // swf文件路径
                swf: './Uploader.swf',
                // 文件接收服务端。
                server: 'backend.php?r=Upload/post',
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {
                    id: '#filePicker',
                    innerHTML: '选择文件'
                },

                // 只允许选择文件，可选。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            // 当有文件添加进来的时候
            uploader.on('fileQueued', function (file) {
                $list.show();
                $list.html("");
                var $li = $(
                                '<div id="' + file.id + '" class="file-item thumbnail">' +
                                '<img>' +
                                '</div>'
                        ),
                        $img = $li.find('img');

                $list.append($li);

                // 创建缩略图
                uploader.makeThumb(file, function (error, src) {
                    if (error) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }

                    $img.attr('src', src);
                }, thumbnailWidth, thumbnailHeight);
                $btn.show();

                $filePicker.hide();
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = $('#' + file.id),
                        $percent = $li.find('.progress span');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = $('<p class="progress"><span></span></p>')
                            .appendTo($li)
                            .find('span');
                }

                $percent.css('width', percentage * 100 + '%');
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on('uploadSuccess', function (file, response) {
                $('#' + file.id).addClass('upload-state-done');
                $hiddenInput.val(response.url);
                $btn.hide();
                $filePicker.show();
            });

            // 文件上传失败，现实上传出错。
            uploader.on('uploadError', function (file) {
                var $li = $('#' + file.id),
                        $error = $li.find('div.error');

                // 避免重复创建
                if (!$error.length) {
                    $error = $('<div class="error"></div>').appendTo($li);
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress').remove();
            });
            uploader.on('all', function (type) {
                if (type === 'startUpload') {
                    state = 'uploading';
                } else if (type === 'stopUpload') {
                    state = 'paused';
                } else if (type === 'uploadFinished') {
                    state = 'done';
                }

                if (state === 'uploading') {
                    $btn.text('暂停上传');
                } else {
                    $btn.text('开始上传');
                }
            });
            $btn.on('click', function () {
                if (state === 'uploading') {
                    uploader.stop();
                } else {
                    uploader.upload();
                }
            });
        });
    </script>
{/literal}