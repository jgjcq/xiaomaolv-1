<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html><html lang="en">
	<head>
		<!--加载header文件-->
		<?php
		include_once 'public/views/header.php';
		?>
		<link rel="stylesheet" href="public/css/edit.css" />
		<link href="public/css/uploadfile.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="cust/js/Huploadify/Huploadify.css"/>
        <link rel="stylesheet" href="cust/js/zyupload/skins/zyupload-1.0.0.min.css " type="text/css">
		<script src="public/js/jquery.uploadfile.min.js"></script>
		<script src="cust/js/courseEdit.js"></script>
		<script src="cust/js/goodsUpload.js"></script>
		<script src="public/js/cus_modal.js"></script>
		<script type="text/javascript" charset="utf-8" src="public/ueditor/ueditor.config.js"></script>
	    <script type="text/javascript" charset="utf-8" src="public/ueditor/ueditor.all.min.js"> </script>
	    <script type="text/javascript" charset="utf-8" src="public/ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript" src="cust/js/zyupload/zyupload.basic-1.0.0.js"></script>
        <script type="text/javascript" src="cust/js/Huploadify/jquery.Huploadify.js"></script>
		<style>
			.file_input{
				width:70px; height:30px; border:3px solid #6FB3E0; border-radius: 3px; background-color:white; color:#6FB3E0; font-size: 14px; font-weight: bold; line-height: 25px; text-align: center; cursor: pointer;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<input type="hidden" id="modal_title" value="<?=$title ?>" />
				<input type="hidden" id="modal_height" value="450" />
				<form id="editForm">
					<input type="hidden" id="id" name="id" value="<?=estr($detail, 'id') ?>" />
					<table class='edit_table table-condensed'>
						<tr>
							<th>标题</th>
							<td colspan="3" ><input  type="text" name="title" id="title" value="<?=estr($detail, 'title') ?>" dataType="*"/></td>
						</tr>
                        <tr>
                            <th>课程分类</th>
                            <td colspan="3" >
                                <select name="course_type" id="course_type">
                                    <?php
                                    foreach ($course_type as $k=>$v){
                                    ?>
                                    <option value="<?=$k?>" <?php if(estr($detail, 'course_type') == $k) {?>selected<?php }?>><?=$v?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>标签（用|隔开）</th>
                            <td colspan="3" >
                                <textarea name="tags" id="tags" cols="70" rows="5" ><?=estr($detail,'tags')?></textarea>
                            </td>
                        </tr>
						<tr>
							<th>展示图片（小图）</th>
							<td colspan="3">
							<input type="hidden" name="article_image" value="<?=estr($detail, 'article_image') ?>" id="article_image" dataType="*">
							<img src="<?php echo $detail['article_image']?$detail['article_image']:'cust/images/upload.png'; ?>" alt="" style="width:150px; height:70px; cursor: pointer;" onclick="$(this).next().click();" >
							<input type="file" style="display: none;" name="image_file" onchange="doImage(this);">
							</td>

						</tr>
                        <tr>
                            <th>展示图片（大图）</th>
                            <td colspan="3">
                                <input type="hidden" name="article_image_big" value="<?=estr($detail, 'article_image_big') ?>" id="article_image_big" >
                                <img src="<?php echo $detail['article_image_big']?$detail['article_image_big']:'cust/images/upload.png'; ?>" alt="" style="width:150px; height:70px; cursor: pointer;" onclick="$(this).next().click();" >
                                <input type="file" style="display: none;" name="image_file_big" onchange="doImage(this);">
                            </td>

                        </tr>
                        <tr>
                            <th>展示视频</th>
                            <td colspan="3">
                                <div>
                                    <?php
                                        if(isset($zs_video)){
                                            ?>
                                            <span><a href='<?=$zs_video["url"] ?>' target="_blank">展示视频</a> <a href="javascript:void(0);" onclick="courseDetailDel(<?=$zs_video["id"]?>,this)">删除</a></span>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <div id="zs_video" >
                                </div>
                                <input type="hidden" name="zs_video_big" value="<?=estr($detail, 'zs_video_big') ?>" id="zs_video_big" >
                            </td>

                        </tr>
						
						<tr>
							<th>课程详情</th>
							<td colspan="3">
								<script id="editor" type="text/plain" style="width:600px;height:250px;"></script>
								<textarea name="content" id="content" cols="30" rows="10" style="width:100%; display: none;"><?php echo $detail['content']; ?></textarea>
							</td>
							
						</tr>
                        <tr>
                            <th>购买须知</th>
                            <td colspan="3">
                                <script id="editorRemark" type="text/plain" style="width:600px;height:250px;"></script>
                                <textarea name="remark" id="remark" cols="30" rows="10" style="width:100%; display: none;"><?php echo $detail['remark']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>原价</th>
                            <td colspan="3" >
                                <input name="old_price" id="old_price"  value="<?=estr($detail, 'old_price') ?>"  datatype="/^-?[1-9]+(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]+[0-9]*(\.\d+)?$/">
                            </td>
                        </tr>
                        <tr>
                            <th>单人价格</th>
                            <td colspan="3" >
                                <input name="price" id="price"  value="<?=estr($detail, 'price') ?>"  datatype="/^-?[1-9]+(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]+[0-9]*(\.\d+)?$/">
                            </td>
                        </tr>
                        <tr>
                            <th>三人价格</th>
                            <td colspan="3" >
                                <input name="p_price" id="p_price"  value="<?=estr($detail, 'p_price') ?>"  datatype="/^-?[1-9]+(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]+[0-9]*(\.\d+)?$/">
                            </td>
                        </tr>
                        <tr>
                            <th>代金卷最大使用值（-1为不限制）</th>
                            <td colspan="3" >
                                <input name="max_coupon" id="max_coupon"  value="<?=estr($detail, 'max_coupon') ?>"  datatype="/^-?[1-9]+(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]+[0-9]*(\.\d+)?$/">
                            </td>
                        </tr>
                        <tr>
                            <th>分享获取代金卷</th>
                            <td colspan="3" >
                                <input name="fx_price" id="fx_price"  value="<?=estr($detail, 'fx_price') ?>"  datatype="/^-?[1-9]+(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]+[0-9]*(\.\d+)?$/">
                            </td>
                        </tr>
                        <tr>
                            <th>文件分类</th>
                            <td colspan="3" >
                                <select name="type" id="type">
                                    <option value="1" <?php if(estr($detail, 'type') == 1) {?>selected<?php }?>>视频</option>
                                    <option value="2"  <?php if(estr($detail, 'type') == 2) {?>selected<?php }?>>音频</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>文件</th>
                            <td colspan="3" >
                                <div>
                                    <ul>
                                        <?php
                                        if($detail_list){
                                        foreach ($detail_list as $d){ ?>
                                            <li><a href='<?=$d["url"] ?>'><?=$d["title"] ?></a> <a href="javascript:void(0);" onclick="courseDetailDel(<?=$d["id"]?>,this)">删除</a></li>
                                        <?php }}?>
                                    </ul>
                                </div>
                                <div id="zyupload" class="zyupload"></div>
                            </td>
                        </tr>
						
						
					</table>
				</form>
			</div>
		</div>
	</body>
	<script>
		var ue=UE.getEditor('editor');
        var ue1=UE.getEditor('editorRemark');
        $(function(){
            // 初始化插件
            $("#zyupload").zyUpload({
                width            :   "650px",                 // 宽度
                height           :   "400px",                 // 宽度
                itemWidth        :   "140px",                 // 文件项的宽度
                itemHeight       :   "115px",                 // 文件项的高度
                url              :   "Admin/Course/upload",  // 上传文件的路径
                fileType         :   ["swf","mp4","avi","mp3","mkv","mov","wmv","wma"],// 上传文件的类型
                fileSize         :   -1,                // 上传文件的大小
                multiple         :   false,                    // 是否可以多个文件上传
                dragDrop         :   false,                   // 是否可以拖动上传文件
                tailor           :   false,                   // 是否可以裁剪图片
                del              :   true,                    // 是否可以删除文件
                finishDel        :   false,  				  // 是否在上传文件完成后删除预览
                /* 外部获得的回调接口 */
                onSelect: function(selectFiles, allFiles){    // 选择文件的回调方法  selectFile:当前选中的文件  allFiles:还没上传的全部文件
                },
                onDelete: function(file, files){              // 删除一个文件的回调方法 file:当前删除的文件  files:删除之后的文件
                },
                onSuccess: function(file, response){          // 文件上传成功的回调方法
                    var ret = JSON.parse(response);
                    if(ret.status){
                        $('#file_ids_'+file.index).val(ret.v);
                    }else{
                        alert(ret.msg);
                    }

                    console.info(ret);
                },
                onFailure: function(file, response){          // 文件上传失败的回调方法
                    alert("上传文件失败");
                },
                onComplete: function(response){           	  // 上传完成的回调方法
                }
            });

        });

        var up = $('#zs_video').Huploadify({
            auto:false,
            fileTypeExts:'*.mp3;*.mp4;',
            multi:false,
            fileSizeLimit:99999999,
            breakPoints:false,
            saveInfoLocal:false,
            showUploadedPercent:true,//是否实时显示上传的百分比，如20%
            showUploadedSize:true,
            removeTimeout:9999999,
            uploader:'Admin/Course/upload',
            onUploadStart:function(file){
            },
            onUploadSuccess:function(file,data, response){
                var ret = JSON.parse(data);
                if(ret && ret.status){
                    $('#zs_video_big').val(ret.v);
                }else{
                    alert('上传失败');
                }
                //alert('上传成功');
            },
            onUploadComplete:function(){
                //alert('上传完成');
            },
            /*getUploadedSize:function(file){
                var data = {
                    data : {
                        fileName : file.name,
                        lastModifiedDate : file.lastModifiedDate.getTime()
                    }
                };
                var url = 'http://49.4.132.173:8080/admin/uploadfile/index/';
                var uploadedSize = 0;
                $.ajax({
                    url : url,
                    data : data,
                    async : false,
                    type : 'POST',
                    success : function(returnData){
                        returnData = JSON.parse(returnData);
                        uploadedSize = returnData.uploadedSize;
                    }
                });
                return uploadedSize;
            }	*/
        });

    </script>
</html>
