<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends AdminController
{
    private $course_type_list = array();
    function __construct() {
        parent::__construct();
        $this -> load -> model("Course_model");
        $this -> load -> model("CourseDetail_model");
        $this -> sidebar = "Course";
        $this->course_type_list = config_item("course_type");
    }

    public function Index() {
        $this -> load -> view('admin/courseList');
    }

    function getDatas($params = array(), $isExport = false) {
        $connar = array();
        if (!$isExport) {
            $params = $_POST;
            $connar = $this -> Course_model -> pickPages($connar, $params);
        }
        $connar['orderby'] = "create_time desc";
        $connar['where']="1=1";
        if (isset($params['param'])) {
            $connar['where'] .= $this->sqlLikeEscape(" and (title like '%??%' ",array($params['param']));
            $connar['where'] .= $this->sqlLikeEscape(" or subtitle like '%??%') ",array($params['param']));
        }
        if(isset($_POST['status']))
        {
            if($_POST['status']<2)
            {
                $connar['where'] .= $this->sqlLikeEscape(" and status=?? ",array($_POST['status']));
            }
        }
        else{
            $connar['where'] .=" and status=1";
        }
        if (!$isExport) {
            $data = $this -> Course_model -> get_page_list($connar);
        } else {
            $data["ret"] = $this -> Course_model -> get_list_full($connar);
        }
        foreach ($data["ret"] as $k => $v) {
            $data['ret'][$k]['img_input']='<img src="'.$v['article_image'].'" style="width:100px; height:50px;">';
            $data['ret'][$k]['typeStr']=$v["type"] == 1?'视频':'音频';
            $data['ret'][$k]['course_type_name']=$this->course_type_list[$v['course_type']];
            $data['ret'][$k]['ishot_str']=$v["ishot"] == 1?'<span style="color:red">是</span>':'否';
            $data['ret'][$k]['isjt_str']=$v["isjt"] == 1?'<span style="color:red">是</span>':'否';
        }

        $data["ret"]=array_values($data["ret"]);
        if (!$isExport) {
            echo json_encode($data);
        } else {
            return $data["ret"];
        }
    }

    //新增，修改
    function edit($id){
        if($id == 0){
            $data['title'] = "新增课程";
            $data['detail'] = $this -> Course_model -> get_single(array("id" => $id));
            $data['detail_list']  = array();
        }else{
            $data['title'] = "查看/编辑课程";
            $data['detail'] = $this -> Course_model -> get_single(array("id" => $id));

            $connar = array();
            $connar['where']="course_id = $id";
            $data['detail_list'] = $this -> CourseDetail_model -> get_list_full($connar);

            $zs_video = $this -> CourseDetail_model ->get_single(array('id'=>$data['detail']['zs_video_big']));
            $data['zs_video'] = $zs_video;
        }
        $data["course_type"] = $this->course_type_list;
        $this -> load -> view('admin/courseEdit',$data);
    }

    function upload(){
        set_time_limit(0);
        $ret = uploadCourseFile();
        if($ret["status"]){
            $detail = array();
            $detail["url"] = $ret["v"]["url"];
            if(isset($ret["v"]["seconds"]))
            $detail['times']  = $ret["v"]["seconds"];
            if(isset($ret["v"]["thumb"]))
            $detail['thumb']  = $ret["v"]["thumb"];
            $id = $this -> CourseDetail_model -> add($detail);
            exit(retJson("上传成功",true,$id));
        }else{
            exit(retJson("上传失败",false));
        }
    }

    function bigUpload(){

        $filename = $_POST['fileName'];
        $array = array();
        if ($filename) {
            $filename = iconv('UTF-8', 'GBK', $filename);
            /*$xmlstr =  $GLOBALS[HTTP_RAW_POST_DATA];//$_POST["data"];//
            if(empty($xmlstr)) $xmlstr = file_get_contents('php://input');
            $raw = $xmlstr;//得到post过来的二进制原始数据*/
            //file_put_contents('uploads/'.$filename,$_FILES["file"]["tmp_name"],FILE_APPEND);
            file_put_contents('upload/'.$filename,file_get_contents($_FILES["file"]["tmp_name"]),FILE_APPEND);
            $array['getsize'] = $_FILES['file']['size'];
            $array['file'] =  file_get_contents('php://input');
            $array['success'] = true;
            $array['size'] = filesize('upload/'.$filename);
            echo json_encode($array);
        }

    }

    function save(){
        $count = $this -> Course_model -> get_count(array("title"=>$_POST['title']));
        $images=$_POST['article_image'];
        $images = str_replace('[removed]','data:image/png;base64,',$images);
        $images1=$_POST['article_image_big'];
        $images1 = str_replace('[removed]','data:image/png;base64,',$images1);
        $images2=$_POST['logo'];
        $images2 = str_replace('[removed]','data:image/png;base64,',$images2);
        $goods = array();
        $userId = $_SESSION[SESS_USER]["id"];
        if(!isset($_POST['id']) || $_POST['id'] == ""){
            $goods = copyArray($_POST,array("title","tags","content","type","price","old_price","p_price","course_type","remark","max_coupon","fx_price","zs_video_big","logo"));
        }else{
            $goods = copyArray($_POST,array("title","tags","id","content","type","price","old_price","p_price","course_type","remark","max_coupon","fx_price","zs_video_big","logo"));
        }
        if(!$goods['zs_video_big'])$goods['zs_video_big'] = 0;
        if(checkStringIsBase64($images)){
            $checkRet = uploadImg($images,'article');
            if(!$checkRet['status']){
                exit(toRetJson($checkRet));
            }
            $goods['article_image'] = $checkRet["v"];
        }else{
            $goods['article_image'] = $_POST['article_image'];
        }
        if(checkStringIsBase64($images1)){
            $checkRet = uploadImg($images1,'article');
            if(!$checkRet['status']){
                exit(toRetJson($checkRet));
            }
            $goods['article_image_big'] = $checkRet["v"];
        }else{
            $goods['article_image_big'] = $_POST['article_image_big'];
        }
        if(checkStringIsBase64($images2)){
            $checkRet = uploadImg($images2,'article');
            if(!$checkRet['status']){
                exit(toRetJson($checkRet));
            }
            $goods['logo'] = $checkRet["v"];
        }else{
            $goods['logo'] = $_POST['logo'];
        }
        if(!isset($_POST['id']) || $_POST['id'] == ""){
            if($count)
            {
                exit(retJson("该课程已存在.", false));
            }
            $goods["created"] = $userId;
            $goods['create_time']=date("Y-m-d H:i:s");
            $id = $this -> Course_model -> add($goods);
            $isAdd = 1;

            $file_ids = explode(",",$_POST["file_ids"]);
            $file_titles = explode(",",$_POST["file_titles"]);
            if(count($file_ids) != count($file_titles)){
                exit(retJson("修改失败.", false,$isAdd));
            }else{
                for($i = 0;$i<count($file_ids);$i++){
                    $detail  = $this -> CourseDetail_model -> get_single(array("id" => $file_ids[$i]));
                    if($detail){
                        $detail["course_id"] = $id;
                        $detail["title"] = $file_titles[$i];
                        $this -> CourseDetail_model -> update($detail);
                    }
                }
            }

            exit(retJson("添加成功.", true,$isAdd));
        }else{
            $goods_data=$this->Course_model->get_single(array('id'=>$_POST['id']));
            if($goods_data['article_image']&&$goods_data['article_image']!=$goods['article_image'])
            {
                unlink($goods_data['article_image']);
            }
            if($goods_data['article_image_big']&&$goods_data['article_image_big']!=$goods['article_image_big'])
            {
                unlink($goods_data['article_image_big']);
            }
            if($goods_data['logo']&&$goods_data['logo']!=$goods['logo'])
            {
                unlink($goods_data['logo']);
            }
            $goods["updated"] = $userId;
            $goods['update_time']=date("Y-m-d H:i:s");
            $isAdd = 0;

            $file_ids = explode(",",$_POST["file_ids"]);
            $file_titles = explode(",",$_POST["file_titles"]);
            if(count($file_ids) != count($file_titles)){
                exit(retJson("修改失败.", false,$isAdd));
            }else{
                for($i = 0;$i<count($file_ids);$i++){
                    $detail  = $this -> CourseDetail_model -> get_single(array("id" => $file_ids[$i]));
                    if($detail){
                        $detail["course_id"] = $goods["id"];
                        $detail["title"] = $file_titles[$i];
                        $this -> CourseDetail_model -> update($detail);
                    }
                }
            }


            $this -> Course_model -> update($goods);
            exit(retJson("修改成功.", true,$isAdd));
        }
    }
    //改变启用状态
    function changeStatus($id, $status) {
        $admin = $this -> Course_model -> get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前课程不存在，请刷新后重试.", false));
        }
        // var_dump($admin);
        // exit();
        if ($admin['status']!=$status) {
            exit(retJson("当前课程状态不正确，请刷新后重试.", false));
        }

        $admin['status'] = 1 - $status;
        $this -> Course_model -> update($admin);
        $char=$status?'隐藏':'发布';
        exit(retJson("已" .$char.'课程【'.$admin["title"].'】', true));
    }

    function del($id){
        $this -> CourseDetail_model -> delete($id);
        exit(retJson("删除成功.", true));
    }
    function setHot($id, $status) {
        $admin = $this -> Course_model -> get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前课程不存在，请刷新后重试.", false));
        }

        $admin['ishot'] = 1 - $status;
        $this -> Course_model -> update($admin);
        exit(retJson("操作成功!", true));
    }
    function setJt($id, $status) {
        $admin = $this -> Course_model -> get_single(array("id" => $id));
        if (!$admin) {
            exit(retJson("当前课程不存在，请刷新后重试.", false));
        }

        $admin['isjt'] = 1 - $status;
        $this -> Course_model -> update($admin);
        exit(retJson("操作成功!", true));
    }
    function test(){
        $dir = "upload/video/20190929/1569726113diFGIJM3.mp4";
        $imgpath = "upload/video/20190929/b.jpg";
        $str = "D:\\ffmpeg\\bin\\ffmpeg -i {$dir} -y -f mjpeg -ss 3 -t 3 -s 300x200 {$imgpath}";
       echo $str;
        echo exec($str);exit;
    }
}