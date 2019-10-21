<?php
include_once "BaseModel.php";

class Share_detail_model extends BaseModel
{
    function __construct()
    {
        parent::__construct();
        $this->table = 'share_detail';
    }

    public function isVist($share_id, $uid)
    {
        $count = $this->get_count(array('share_id' => $share_id, 'vist_id' => $uid));
        if ($count > 0) {
            return true;
        }
        return false;
    }

    public function getListByUid($uid)
    {
        $sql = "select sd.create_time as visit_time,c.*,u.head_img,u.username from db_share_detail sd LEFT JOIN db_share s ON sd.share_id = s.id LEFT JOIN db_course c".
                " ON c.id = s.course_id LEFT JOIN db_user u ON u.id = sd.vist_id where sd.share_id in (select id from db_share where user_id = $uid)";
        return $this->query($sql);
    }
}

?>