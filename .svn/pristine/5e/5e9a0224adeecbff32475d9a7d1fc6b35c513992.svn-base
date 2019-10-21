<?php

class XPHEnum
{
    const Value = 0;
    const Caption = 1;
    const Remark = 2;
    const Alternate = 3;
    public $EnumTypes = array();
    //通过值获取内容
    function show($v){
        $CurCaption = "";
        foreach($this->EnumTypes as $temp){
            if($temp[self::Value] == $v){
                $CurCaption = $temp[self::Caption];
                break;
            }
        }
        return $CurCaption;
    }
    function showByIndex($v,$index){
        $CurCaption = "";
        foreach($this->EnumTypes as $temp){
            if($temp[self::Value] == $v){
                $CurCaption = $temp[$index];
                break;
            }
        }
        return $CurCaption;
    }
    function getAll(){
        return $this->EnumTypes;
    }
    function getAllOneD(){
        $new_array=array();
        foreach($this->EnumTypes as $k=>$v){
            $new_array[]=$v[self::Caption];
        }
        return $new_array;
    }

}

// 公共是否
class CommonWhether extends XPHEnum
{
	Const Whether = array("1",'是');
	Const Not = array("0",'否');
    
    function __construct(){
    	$this->EnumTypes = array(self::Whether,self::Not);
    }
}

// 公共删除
class CommonStatus extends XPHEnum
{
    Const UnDeleted = array("1",'未删除');
    Const Deleted = array("0",'已删除');
    
    function __construct(){
        $this->EnumTypes = array(self::UnDeleted,self::Deleted);
    }
}

// 公共文件后缀类型
class CommonDocument extends XPHEnum
{
    Const Excel = array("1",array('xls','xlsx'),'excel.png');
    Const Pdf = array("2",array('pdf'),'pdf.png');
    Const Word = array("3",array('docx','doc'),'word.png');
    Const Img = array("4",array('png','jpg','jpeg','gif'),'img.png');
    Const Ppt = array("5",array('ppt','pptx'),'ppt.png');
    Const Text = array("6",array('txt'),'text.png');
    
    function __construct(){
        $this->EnumTypes = array(self::Excel,self::Pdf,self::Word,self::Img,self::Ppt,self::Text);
    }
}

// 项目类型
class ProjectType extends XPHEnum
{
	Const Transverse = array("1",'横向');
	Const Longitudinal = array("2",'纵向');
    
    function __construct(){
    	$this->EnumTypes = array(self::Transverse,self::Longitudinal);
    }
}

// 项目公开类型
class ProjectPublicType extends XPHEnum
{
	Const UnPublished = array("0",'未公开');
	Const SetUp = array("1",'立项公开');
    Const Process = array("2",'过程公开');
    Const Conclusion  = array("3",'结题公开');
    
    function __construct(){
    	$this->EnumTypes = array(self::UnPublished,self::SetUp,self::Process,self::Conclusion);
    }
}


//项目审核状态
class ProjectAuditStatus extends XPHEnum
{
	Const DefaultStatus = array("0",'初始');
	Const SecretaryRefused = array("1",'秘书拒绝');
    Const SecretaryPass = array("2",'秘书通过');
    Const ResearchRefused  = array("3",'研究拒绝');
    Const ResearchPass  = array("4",'研究通过');
    
    function __construct(){
    	$this->EnumTypes = array(self::DefaultStatus,self::SecretaryRefused,self::SecretaryPass,self::ResearchRefused,self::ResearchPass);
    }
}


//项目发布状态
class ProjectReleaseStatus extends XPHEnum
{
	Const NotStart = array("0",'未开始');
	Const NotRelease = array("1",'未发布');
    Const HaveRelease = array("2",'已发布');

    function __construct(){
    	$this->EnumTypes = array(self::NotStart,self::NotRelease,self::HaveRelease);
    }
}



//项目操作记录类型
class ProjectRecordType extends XPHEnum
{
	Const Refused = array("1",'拒绝');
	Const Pass = array("2",'通过');

    function __construct(){
    	$this->EnumTypes = array(self::Refused,self::Pass);
    }
}

//项目操作记录阅读状态
class ProjectRecordRead extends XPHEnum
{
	Const UnRead = array("0",'未读');
	Const HaveRead = array("1",'已读');

    function __construct(){
    	$this->EnumTypes = array(self::UnRead,self::HaveRead);
    }
}


//配置类型
class DicType extends XPHEnum
{
	Const ProjectDept = array("1",'project_dept');
	Const AppropriationBudget = array("2",'appropriation_budget');
	Const BudgetSpend = array("3",'budget_spend');
	Const SpecialSpend = array("4",'special_spend');
	Const SuccessType = array("5",'success_type');

    function __construct(){
    	$this->EnumTypes = array(self::ProjectDept,self::AppropriationBudget,self::BudgetSpend,self::SpecialSpend,self::SuccessType);
    }
}


 