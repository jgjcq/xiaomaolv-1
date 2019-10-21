<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*************自定义常量*************************************************************/

defined('INIT_PWD')			   OR define('INIT_PWD', '123456');

/*************session类*****************************/
defined('SESS_USER')		   OR define('SESS_USER', 'session_h_demo');
defined('SESS_USER_HOME')		   OR define('SESS_USER_HOME', 'session_park_management_home');
defined('SESS_USER_WX')		   OR define('SESS_USER_WX', 'session_park_management_wx');
defined('SESS_DIC')		   OR define('SESS_DIC', 'session_tongbaoadmin_dictionary');
defined('SESS_USER_LASTTIME_DIF')		   OR define('SESS_USER_LASTTIME_DIF', 36000);
defined('SESS_IS_WX_CLIENT')		   OR define('SESS_IS_WX_CLIENT', 'session_tongbaoadmin_is_wx_client');
defined('SESS_PRE_LOGIN_PAGE')		   OR define('SESS_PRE_LOGIN_PAGE', 'session_tongbaoadmin_pre_login_page');
defined('SESS_OPENID')		   OR define('SESS_OPENID', 'session_tongbaoadmin_weixin_openid');

/*************cookie类*****************************/
defined('COOK_USER_NAME')		   OR define('COOK_USER_NAME', 'cookie_tongbaoadmin_username');
defined('COOK_USER_PWD')		   OR define('COOK_USER_PWD', 'cookie_tongbaoadmin_userpwd');




/**********easyar********************************/
defined('EASYAR_CLOUDKEY')		   OR define('EASYAR_CLOUDKEY', '1029934a80708d3cc25ae41ec8957389');
defined('EASYAR_CLOUDSECRET')		   OR define('EASYAR_CLOUDSECRET', '3aOIZN06pi1O3Ikgb6ALbbFx7geljg9Lmy12tLuQjCynpVbaOWjfJSi20mmZpLwwqRUrwkZaMXanfjmAgABC5CtSix8dBPLvN5SWHhnkWyq18JYk4a6P7yO0veoCCXpK');
defined('EASYAR_CLOUDURL')		   OR define('EASYAR_CLOUDURL', 'http://0894165621276c51d04471b83f501b97.cn1.crs.easyar.com:8080/search');
defined('EASYAR_SEVER_END')		   OR define('EASYAR_SEVER_END', '0894165621276c51d04471b83f501b97.cn1.crs.easyar.com:8888');


/**********七牛********************************/
defined('QINIU_ACCESS_KEY')		   OR define('QINIU_ACCESS_KEY', '6ok7V_LIWCu3QQLnvIp-53Ai4mHqjHOxdioGnv1D');
defined('QINIU_SECRET_KEY')		   OR define('QINIU_SECRET_KEY', 'Ko6jt5rUZpvn-KzFQu_97iMmMXk9xtj9B-Nj8vbq');
defined('QINIU_BUCKET')		   OR define('QINIU_BUCKET', 'tuku-video');
defined('QINIU_URL')		   OR define('QINIU_URL', 'http://pgba56yhk.bkt.clouddn.com/');













//阿里短信
defined('ALI_MSG_APPKEY')		   OR define('ALI_MSG_APPKEY', 'LTAITjNFiTDS5qWt');
defined('ALI_MSG_APPSECRET')		   OR define('ALI_MSG_APPSECRET', 'qppVglsJ8sRpUgpdn3qotWAFuw7Apg');
defined('ALI_MSG_SIGN')		   OR define('ALI_MSG_SIGN', '欣卓云');

//微信
defined("WX_APP_ID")		   OR define("WX_APP_ID", "wxb9683d953c243b43");
defined("WX_APP_SECRET")		   OR define("WX_APP_SECRET", "1a3631550363b5701a76841ef12a5d8f");
defined("WX_MCH_ID")		   OR define("WX_MCH_ID", "1521353501");
defined("WX_MCH_KEY")		   OR define("WX_MCH_KEY", "libangchangxianglianmeng12345678");


