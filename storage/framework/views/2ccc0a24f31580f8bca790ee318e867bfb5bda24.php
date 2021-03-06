
<link href="https://cdn.bootcss.com/webuploader/0.1.1/webuploader.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.staticfile.org/webuploader/0.1.0/webuploader.js"></script>


<link href="https://cdn.bootcss.com/cropper/4.0.0/cropper.css" rel="stylesheet">
<script src="https://cdn.bootcss.com/cropper/4.0.0/cropper.js"></script>
<script>
    var jquery = jQuery.noConflict(true);
    /**
     * server 上传地址
     * pick 调用ID名称
     * fileNumLimit 文件上传个数
     * fileSizeLimit 文件大小 默认 1M=1024*1024
     * filetype 文件类型
     * mimeTypes MIME类型
     * */
    var uploader;

    function uploadImg(server, pick, width=1600, height=1600, fileNumLimit= 1, fileSizeLimit=1024 * 1024, filetype='jpg,jpeg,png', mimeTypes='image/jpg,image/jpeg,image/png') {
        jquery(function () {
            // 初始化Web Uploader
            uploader = WebUploader.create({
                // 选完文件后，是否自动上传。
                auto: false,
                //验证文件总大小是否超出限制
                fileSizeLimit: fileSizeLimit,
                //文件上传请求的参数表
                formData: {
                    _token: '<?php echo e(csrf_token()); ?>',
                },
                // swf文件路径
                swf: 'https://cdn.bootcss.com/webuploader/0.1.0/Uploader.swf',
                // 文件接收服务端。
                server: server,
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#' + pick,
                accept: {
                    title: 'upload',//文字描述
                    extensions: filetype,//允许的文件后缀，不带点，多个用逗号分割 String
                    mimeTypes: mimeTypes,//多个用逗号分割 String
                },
                duplicate: false,//支持再次上传
                fileNumLimit: fileNumLimit,//上传单张
                multiple: false,//是否开起同时选择多个文件能力
                //配置压缩的图片
                compress: {
                    width: width,
                    height: height,
                    // 图片质量，只有type为`image/jpeg`的时候才有效。
                    quality: 90,
                    // 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
                    allowMagnify: false,
                    // 是否允许裁剪。
                    crop: true,
                    // 是否保留头部meta信息。
                    preserveHeaders: true,
                    // 如果发现压缩后文件大小比原来还大，则使用原来图片
                    // 此属性可能会影响图片自动纠正功能
                    noCompressIfLarger: false,
                    // 单位字节，如果图片大小小于此值，不会采用压缩。
                    compressSize: 10
                },
                duplicate: true,
            });
            /**
             * 验证文件格式以及文件大小
             */
            uploader.on("error", function (handler) {
                if (handler == "Q_TYPE_DENIED") {
                    alerterror('请上传' + filetype + '格式文件');
                } else if (handler == "Q_EXCEED_SIZE_LIMIT") {
                    alerterror('文件大小不能超过' + fileSizeLimit / 1024 / 1024 + 'M');
                } else if (handler == "Q_EXCEED_NUM_LIMIT") {
                    alerterror('文件个数超过上限');
                }
                else {
                    alerterror('上传出错！请检查后重新上传！错误代码' + handler);
                }
            });

            // 当有文件被添加进队列的时候(预览)
            uploader.on('fileQueued', function (file) {
                var $li = jquery(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<i class="icon-remove" style="cursor: pointer" onclick="removeUpload(this)" ></i>' +
                    '<img id="thumb">' +
                    '<a href="javascript:;" class="btn btn-success" onclick="upload()">上传</a>' +
                    '</div>'
                    ),
                    $img = $li.find('img');

                jquery("#" + pick).append($li);
                // 创建缩略图
                // 如果为非图片文件，可以不用调用此方法。
                uploader.makeThumb(file, function (error, ret) {
                    if (error) {
                        jquery(".icon-remove").append('<span>无法预览</span>');
                    } else {
                        $img.attr('src', ret);
                    }
                }, width, height);

            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = jquery('#' + file.id),
                    $percent = $li.find('.progress .progress-bar');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = jquery('<div class="progress progress-striped active">' +
                        '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                        '</div>' +
                        '</div>').appendTo($li).find('.progress-bar');
                }
                $li.find('p.state').text('上传中');
                $percent.css('width', percentage * 100 + '%');
            });
            //上传成功
            uploader.on('uploadSuccess', function (file, response) {
                jquery("#" + pick).find("input").remove();
                jquery("#" + pick).append('<input type="hidden" name=' + pick + ' value=' + response._raw + '/>');
                jquery('#' + file.id).find('a.btn-success').text('已上传');
            });
            //上传失败
            uploader.on('uploadError', function (file) {
                $('#' + file.id).find('p.state').text('上传出错');
            });

            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress').fadeOut();
            });
            // 所有文件上传成功后调用
            uploader.on('uploadFinished', function () {
                //清空队列
                uploader.reset();
            });

        });

    }

    //上传图片
    function upload() {
        uploader.upload();
    }

    //取消上传
    function removeUpload(obj) {
        var pid = jquery(obj).parent().attr('id');
        uploader.removeFile(pid, true);
        jquery("#" + pid).remove();
    }
</script>
