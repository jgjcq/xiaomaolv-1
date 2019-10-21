/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ci_demo

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-06-12 08:55:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for db_admin
-- ----------------------------
DROP TABLE IF EXISTS `db_admin`;
CREATE TABLE `db_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usercode` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `head_img` varchar(255) DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `passsalt` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `role_id` tinyint(1) unsigned DEFAULT NULL,
  `sub_role_id` text CHARACTER SET utf8mb4,
  `phone` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `openid` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `updated` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_admin
-- ----------------------------
INSERT INTO `db_admin` VALUES ('1', 'admin', '系统管理员', 'upload/head/20190314/1552527093hlvzCHXY.jpeg', '2bdc66f25b844b335d737df020e29a62', 'f6443923b35892f9d375c86f2e423ea9', '1', null, null, null, '1519794967', '1559026152', '::1', '1');
INSERT INTO `db_admin` VALUES ('2', 'haha', '大声道111', null, '1e5af5daa92e23ff1e0ce32b797922f4', 'c1bde2d7a988337cfdcaef1ce00464ee', '2', '', null, null, null, '1545723719', '::1', '1');
INSERT INTO `db_admin` VALUES ('3', 'ge', '胜多负少', null, '2e3c4ff336ce4d6b593527ebea371a96', '33cfd4e355659555911dff4870b38530', '3', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('4', '1', '1', null, '114bd50e6e662372ef421c0d8baf7d54', '532363d5c16eaa421cdb6cfbfd30434d', '2', '', null, null, null, '1557723938', '::1', '1');
INSERT INTO `db_admin` VALUES ('5', '2', '2', null, '5087ec6af65e0f320141eda12da09523', 'd848bc5d1f1a9298ef9bd0ced2ec77fd', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('6', '3', '3', null, '45081afa0465c0c24b8d0722d6911d1f', '30c3e3fd0d0e5e45e169c9f90cb46f96', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('7', '4', '4', null, '2f21b34ce283899c6dfee223793eb50f', 'ddeb3351214e7963f46821b1dd0313bb', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('8', '5', '5', null, 'b3f91e519df0bc3c83474e447a760e9e', '63f7f615b0c90286623c0431a7168180', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('9', '6', '6', null, 'ca39502857213b907d568938495e0d29', 'c6130a9b8042c59e5933d4dd94214ae6', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('10', '7', '7', null, '726e7e7ccdca3e7c2ffa529cec8ea391', '7b3bc2e80a6bbe041e3f464f63b655fe', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('11', '8', '8', null, '8b9ecc46a0bca92d1b4453fbc696326f', '8788d2a62f781429218720bcbfb7c42e', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('12', '9', '9', null, 'eebdcda96863b30207daef64968771bc', '879e1083770bac3b04c043ef1721f141', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('13', '10', '10', null, '20806160f41d3155f29bc0e8aa1cb897', '14d43931db04eb839ae19b2988996752', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('14', '11', '11', null, '4720ab8d6d462602c767598e7251776b', '87c0d7adc19f3f7f9b0b60e73fa1dc29', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('15', '12', '12', null, 'e510f51372f1241c3b7f9e86593a240f', 'dc80eb6629489cfcdfa71b4efc6f16ec', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('16', '13', '13', null, 'b3649cc24a2679c8bf4f948ee61970a8', 'a06b9c1e223bcce597496f63f88738fa', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('17', '14', '14', null, 'e434decdf882e6edea29de642334b0e0', '493c324092854f991a4c8c9bd1e6b3c0', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('18', '15', '15', null, 'fbaf2ec9db61616cfb4ae11f8bfe21d2', 'b73e77c64902e6524dd773b7636faa75', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('19', '16', '16', null, 'fb2aebd07ac14ac0153893e6ecd9910d', '4fb30309ffb07cb760edfb7bd089f728', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('20', '17', '17', null, '30a62b44a511dd5979e8dc53b8a45897', 'e8ef91efa36a1864c56c733cebeb41f9', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('21', '18', '18', null, '2f52e57904457ae3e5d8be3532089bdb', 'a2712ccb4e6ac438e1595fe6ed0d64f1', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('22', '19', '19', null, '8e4d5a3a4212416500015eec4ddded7a', '392ac06970c4281c7d24b2eb60ac9a12', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('23', '20', '201', null, 'cecbe5add75964232305652980a37649', '44a83fece70804a0e43d7b04ce826c40', '2', '', null, null, null, '1544521241', null, '1');
INSERT INTO `db_admin` VALUES ('24', '21', 'sdfsfxiugai', null, '4f7509a77a6f22834d71a49b36ed6748', '3befbf82ba651351e59c103b911ce0da', '2', '', null, null, null, '1544521249', null, '1');
INSERT INTO `db_admin` VALUES ('25', '', '', null, '8c53191ae00c5a3b3c4126272938653e', 'f37ef4c791c32401c1620954c6744eb9', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('26', '66', '6644', null, 'bb64794306e4b2e5dcea9bc053576a7e', '0efa35385ee6c4678a23d7a282d16c62', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('27', '蛋糕', '地方', null, '23f7f8b06f81c3271cd62bf5f52cb1cc', '57650c1e3eb78f708e5e61d90c775476', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('28', '你是', '水电费', null, '96d4adf4a3d818c94873bfd023978f79', '5c7b1284168f41cdf565dd38abd8d9e3', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('29', '你是水电费是否s', '谁鼎飞丹砂', null, '218683ce3bf1a6b7049b5986a2292a5b', '8f2e778c3d82189b2539365d00f75ee7', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('30', 'v发v', '撒旦', null, '4ca12bba90e6d32869659b2b712345c6', 'c10ef8d9c76a7caa9b5bafc799df6bb1', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('31', '能不能 ', '风光好', null, '0b0f7b9f644ba7592025a5ed3b96a9ba', '6fc040230ac34d3e239bda8f9ed461ad', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('32', '梦境红就快了', '发光', null, '16f21ec1c81ed6f2a467332be46659bf', 'd9db34564c042791bd36a0a7332f926e', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('33', 'v刹', '11111', null, 'a8a2c71d640d77722610e0e0d63a5434', '30af440dbcdf24824025293410de9483', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('34', '啊啊啊啊', '阿斯顿', null, '7f662bb19f78101403c39c6f140787f1', '407ce06ca3f8c8b8d1eb3d707314b828', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('35', '打四大', '水电费', null, '72d6ac32a3ba6fa735cb690236c1fe09', '1fb2020ed2478ea7303e2e6f981e7f09', '2', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('36', '阿斯顿发送到', '阿斯顿', null, 'a6e5babbf99b9d03579db5277429850b', '3213fb36d44a918fd5eb1444e5bdb725', '2', '3', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('37', '水电费', '水电费1', null, 'cb9ee6ca3d25ba2c2c2b389607891112', 'b150d9fa3b31fae35d3adb100e92c2c9', '2', '3', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('38', '111', '11111', null, '28884ca45122035bda17ccac702ad307', '8c603da1bf8287bec9e2bdd232202ef3', '3', '', null, null, null, '1546591526', '::1', '1');
INSERT INTO `db_admin` VALUES ('39', '1111111111', '1', null, '8c866bb7e65f8ac664a6790ed308e99d', '877ab26db115695aa718acdbb1d76f9f', '2', '3,5,4', null, null, null, '1546933332', '::1', '1');
INSERT INTO `db_admin` VALUES ('40', '阿斯达', '阿斯达', null, '7f3c7a1b7d1e1def85293408426d33bf', 'fd083da9c621cf1d684f9f6ff0014ff0', '3', '', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('43', '[removed]alert&#40;11&#41;;[removed]', 'sadfasf', null, 'f2f734d2f4a301c1021b4963cbc4cc3c', 'de7b4f01e3331d4ecae6e8e0e091adcc', '4', '5', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('44', 'select username from db_admin where id=1', '111', null, '82292b0da13b314842cbe4f8a9d4af08', '5f9c8706fcb6a7aa764029f72da9e621', '3', '4', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('45', '(insert into db_user (usercode) values (\'asdasd))', '111', null, '5a27e2250658c0520ac9c1e80a2c5af2', 'c2f71efd23c253cc3b6f241452c7d473', '2', '3', null, null, null, null, null, '1');
INSERT INTO `db_admin` VALUES ('46', '(insert into db_user (usercode) values (\'asdasd\'))', 'asd', null, '42bbdede4d85ef661eb59877fc6f0ee1', '4f629df9f52fffa2703d00b338e5243e', '2', '', null, null, null, null, null, '1');

-- ----------------------------
-- Table structure for db_article
-- ----------------------------
DROP TABLE IF EXISTS `db_article`;
CREATE TABLE `db_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_image` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `subtitle` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4,
  `status` tinyint(1) unsigned DEFAULT '0',
  `created` int(11) unsigned DEFAULT NULL,
  `updated` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_article
-- ----------------------------
INSERT INTO `db_article` VALUES ('1', 'upload/article/20181211/1544511939gjzFIL06.jpeg', '测试', '测绘', '<p>啊实打实的</p>', '0', '1544511939', null);
INSERT INTO `db_article` VALUES ('2', 'upload/article/20181224/1545627014ilwAELMR.jpeg', '1', '1修改再修改', '<p>渡水复渡水放松放松</p>', '0', '1545627014', '1545902228');
INSERT INTO `db_article` VALUES ('3', 'upload/article/20181227/1545896606eqvxyUZ3.jpeg', '自行车自行车', '打四大', '<p>啊实打实的</p>', '0', '1545896606', null);
INSERT INTO `db_article` VALUES ('4', 'upload/article/20181227/1545896854EIJKST18.jpeg', '说的发送到', '水电费', '<p>水电费的是否</p>', '0', '1545896854', null);
INSERT INTO `db_article` VALUES ('5', 'upload/article/20181227/1545896868lrtwxFN6.jpeg', '1111', '2222', '<p><span style=\"background-color: rgb(84, 141, 212); color: rgb(255, 255, 255);\">水电费的是否</span></p>', '1', '1545896868', '1547012655');

-- ----------------------------
-- Table structure for db_banner
-- ----------------------------
DROP TABLE IF EXISTS `db_banner`;
CREATE TABLE `db_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_image` varchar(80) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cust_url` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `type` tinyint(1) unsigned DEFAULT '1',
  `created` int(11) unsigned DEFAULT NULL,
  `sort` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_banner
-- ----------------------------
INSERT INTO `db_banner` VALUES ('27', 'upload/banner/20181227/1545899816uvxBFHRY.jpeg', 'http://www.baidu.com', '1', '1557725794', '0');
INSERT INTO `db_banner` VALUES ('28', 'upload/banner/20181227/1545901374fmtuxRV9.jpeg', '', '1', '1557725794', '60');
INSERT INTO `db_banner` VALUES ('29', 'upload/banner/20181227/1545901374eAHKMN68.jpeg', '', '1', '1557725794', '60');

-- ----------------------------
-- Table structure for db_code
-- ----------------------------
DROP TABLE IF EXISTS `db_code`;
CREATE TABLE `db_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `code` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created` int(11) unsigned DEFAULT NULL,
  `type` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_code
-- ----------------------------

-- ----------------------------
-- Table structure for db_dic
-- ----------------------------
DROP TABLE IF EXISTS `db_dic`;
CREATE TABLE `db_dic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `dic_key` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `dic_value` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `caption` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `z_index` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_dic
-- ----------------------------
INSERT INTO `db_dic` VALUES ('1', 'webInfo', 'webtitle', '小破孩ERP后台系统', null, '0');
INSERT INTO `db_dic` VALUES ('2', 'webInfo', 'keywords', '小破孩ERP后台系统', null, '0');
INSERT INTO `db_dic` VALUES ('3', 'webInfo', 'description', '小破孩ERP后台系统', null, '0');
INSERT INTO `db_dic` VALUES ('4', 'webInfo', 'company', '小破孩', null, null);

-- ----------------------------
-- Table structure for db_module
-- ----------------------------
DROP TABLE IF EXISTS `db_module`;
CREATE TABLE `db_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `cname` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ename` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `level` tinyint(1) unsigned DEFAULT NULL,
  `pid` int(10) unsigned DEFAULT NULL,
  `is_show` tinyint(1) unsigned DEFAULT '1',
  `created` int(11) unsigned DEFAULT NULL,
  `updated` int(11) unsigned DEFAULT NULL,
  `order` tinyint(3) unsigned DEFAULT '60',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_module
-- ----------------------------
INSERT INTO `db_module` VALUES ('1', 'fa fa-newspaper-o', '内容管理', 'Content', '1', '0', '1', '1530774645', '1546829367', '2');
INSERT INTO `db_module` VALUES ('2', 'fa fa-tachometer', '网站概览', 'Overview', '1', '0', '1', '1530775055', '1546842177', '1');
INSERT INTO `db_module` VALUES ('3', 'fa icon-picture', '广告横幅', 'AppContent/Index', '2', '1', '1', '1530775144', '1546916079', '30');
INSERT INTO `db_module` VALUES ('4', 'fa icon-paste', '文章管理', 'Article/Index', '2', '1', '1', '1530776393', '1546932450', '60');
INSERT INTO `db_module` VALUES ('5', 'fa icon-signal', '控制台', 'Home/Index', '2', '2', '1', '1530776451', '1546932432', '60');
INSERT INTO `db_module` VALUES ('6', 'fa icon-github-alt', '会员管理', 'Member', '1', '0', '1', '1530776592', '1546829417', '20');
INSERT INTO `db_module` VALUES ('7', '', '用户查询', 'User/Index', '2', '6', '1', '1530776654', null, '60');
INSERT INTO `db_module` VALUES ('8', 'fa icon-user-md', '账户管理', 'Account', '1', '0', '1', '1530777656', '1546829444', '60');
INSERT INTO `db_module` VALUES ('9', '', '账户管理', 'Admin/Index', '2', '8', '1', '1530776827', '1546916894', '60');
INSERT INTO `db_module` VALUES ('10', 'fa icon-group', '权限管理', 'Permissions', '1', '0', '1', '1530776887', '1546829450', '65');
INSERT INTO `db_module` VALUES ('14', 'fa icon-user', '角色管理', 'Role/Index', '2', '10', '1', '1530777706', '1546932567', '60');
INSERT INTO `db_module` VALUES ('15', 'fa icon-tags', '网站模块管理', 'Module/Index', '2', '10', '1', '1530777730', '1546932526', '60');
INSERT INTO `db_module` VALUES ('16', '', '账号添加/修改', 'Admin/edit', '3', '9', '1', '1546911397', '1546915445', '60');
INSERT INTO `db_module` VALUES ('17', '', '模块添加/修改', 'Module/edit', '3', '15', '1', '1546915796', '1546915854', '60');
INSERT INTO `db_module` VALUES ('18', '', '角色添加/修改', 'Role/edit', '3', '14', '1', '1546915829', null, '60');
INSERT INTO `db_module` VALUES ('19', '', '轮播图保存', 'AppContent/save', '3', '3', '1', '1546917200', '1546917497', '60');
INSERT INTO `db_module` VALUES ('20', '', '会员状态修改', 'User/changeStatus', '3', '7', '1', '1546917236', '1546917575', '60');
INSERT INTO `db_module` VALUES ('21', '', '会员密码初始化', 'User/initPassword', '3', '7', '1', '1546917302', '1546917700', '60');
INSERT INTO `db_module` VALUES ('22', '', '文章列表', 'Article/getDatas', '3', '4', '1', '1546917384', null, '60');
INSERT INTO `db_module` VALUES ('23', '', '文章添加/修改', 'Article/edit', '3', '4', '1', '1546917415', '1546930055', '60');
INSERT INTO `db_module` VALUES ('24', '', '文章保存', 'Article/save', '3', '4', '1', '1546917435', null, '60');
INSERT INTO `db_module` VALUES ('25', '', '文章状态修改', 'Article/changeStatus', '3', '4', '1', '1546917460', '1546917564', '60');
INSERT INTO `db_module` VALUES ('26', '', '会员列表', 'User/getDatas', '3', '7', '1', '1546917539', null, '60');
INSERT INTO `db_module` VALUES ('27', '', '账户列表', 'Admin/getDatas', '3', '9', '1', '1546917637', null, '60');
INSERT INTO `db_module` VALUES ('28', '', '账户状态修改', 'Admin/changeStatus', '3', '9', '1', '1546917675', null, '60');
INSERT INTO `db_module` VALUES ('29', '', '账户密码初始化', 'Admin/initPassword', '3', '9', '1', '1546917719', null, '60');
INSERT INTO `db_module` VALUES ('30', '', '账户保存', 'Admin/save', '3', '9', '1', '1546917788', null, '60');
INSERT INTO `db_module` VALUES ('31', '', '角色列表', 'Role/getDatas', '3', '14', '1', '1546917832', null, '60');
INSERT INTO `db_module` VALUES ('32', '', '角色保存', 'Role/save', '3', '14', '1', '1546917865', null, '60');
INSERT INTO `db_module` VALUES ('33', '', '角色删除', 'Role/delete', '3', '14', '1', '1546917897', null, '60');
INSERT INTO `db_module` VALUES ('34', '', '角色权限设置', 'Role/roleModule', '3', '14', '1', '1546917920', null, '60');
INSERT INTO `db_module` VALUES ('35', '', '角色权限保存', 'Role/saveRoleModule', '3', '14', '1', '1546917942', null, '60');
INSERT INTO `db_module` VALUES ('36', '', '模块列表', 'Module/getDatas', '3', '15', '1', '1546917995', null, '60');
INSERT INTO `db_module` VALUES ('37', '', '模块保存', 'Module/save', '3', '15', '1', '1546918035', null, '60');
INSERT INTO `db_module` VALUES ('38', '', '模块删除', 'Module/delete', '3', '15', '1', '1546918058', null, '60');
INSERT INTO `db_module` VALUES ('39', '', '模块状态修改', 'Module/changeStatus', '3', '15', '1', '1546918076', null, '60');
INSERT INTO `db_module` VALUES ('40', 'fa icon-cogs', '网站配置', 'Config', '1', '0', '0', '1552021108', null, '60');

-- ----------------------------
-- Table structure for db_quick_entry
-- ----------------------------
DROP TABLE IF EXISTS `db_quick_entry`;
CREATE TABLE `db_quick_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `module_id` int(10) unsigned DEFAULT NULL,
  `created` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of db_quick_entry
-- ----------------------------
INSERT INTO `db_quick_entry` VALUES ('40', '1', '2', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('41', '1', '5', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('42', '1', '1', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('43', '1', '3', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('44', '1', '4', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('45', '1', '6', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('46', '1', '7', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('47', '1', '8', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('48', '1', '9', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('49', '1', '10', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('50', '1', '14', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('51', '1', '15', '1544520661');
INSERT INTO `db_quick_entry` VALUES ('52', '24', '2', '1544521202');
INSERT INTO `db_quick_entry` VALUES ('53', '24', '5', '1544521202');
INSERT INTO `db_quick_entry` VALUES ('54', '24', '1', '1544521202');
INSERT INTO `db_quick_entry` VALUES ('55', '24', '3', '1544521202');

-- ----------------------------
-- Table structure for db_role
-- ----------------------------
DROP TABLE IF EXISTS `db_role`;
CREATE TABLE `db_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `updated` int(11) unsigned DEFAULT NULL,
  `created` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role
-- ----------------------------
INSERT INTO `db_role` VALUES ('1', '超级管理员', null, null);
INSERT INTO `db_role` VALUES ('2', '运营', '1546999843', '1544427042');
INSERT INTO `db_role` VALUES ('3', '业务员', '1545894686', '1544427361');
INSERT INTO `db_role` VALUES ('4', 'sdasd', null, '1551787114');
INSERT INTO `db_role` VALUES ('5', '12312', null, '1551787119');

-- ----------------------------
-- Table structure for db_role_module
-- ----------------------------
DROP TABLE IF EXISTS `db_role_module`;
CREATE TABLE `db_role_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned DEFAULT NULL,
  `module_id` int(10) unsigned DEFAULT NULL,
  `created` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=438 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_role_module
-- ----------------------------
INSERT INTO `db_role_module` VALUES ('263', '3', '1', '1557724114');
INSERT INTO `db_role_module` VALUES ('264', '3', '3', '1557724114');
INSERT INTO `db_role_module` VALUES ('265', '3', '19', '1557724114');
INSERT INTO `db_role_module` VALUES ('266', '3', '4', '1557724114');
INSERT INTO `db_role_module` VALUES ('267', '3', '22', '1557724114');
INSERT INTO `db_role_module` VALUES ('268', '3', '23', '1557724114');
INSERT INTO `db_role_module` VALUES ('269', '3', '24', '1557724114');
INSERT INTO `db_role_module` VALUES ('270', '3', '25', '1557724114');
INSERT INTO `db_role_module` VALUES ('271', '3', '2', '1557724114');
INSERT INTO `db_role_module` VALUES ('272', '3', '5', '1557724114');
INSERT INTO `db_role_module` VALUES ('273', '3', '6', '1557724114');
INSERT INTO `db_role_module` VALUES ('274', '3', '7', '1557724114');
INSERT INTO `db_role_module` VALUES ('275', '3', '20', '1557724114');
INSERT INTO `db_role_module` VALUES ('276', '3', '21', '1557724114');
INSERT INTO `db_role_module` VALUES ('277', '3', '26', '1557724114');
INSERT INTO `db_role_module` VALUES ('278', '3', '8', '1557724114');
INSERT INTO `db_role_module` VALUES ('279', '3', '9', '1557724114');
INSERT INTO `db_role_module` VALUES ('280', '3', '16', '1557724114');
INSERT INTO `db_role_module` VALUES ('281', '3', '27', '1557724114');
INSERT INTO `db_role_module` VALUES ('282', '3', '28', '1557724114');
INSERT INTO `db_role_module` VALUES ('283', '3', '29', '1557724114');
INSERT INTO `db_role_module` VALUES ('284', '3', '30', '1557724114');
INSERT INTO `db_role_module` VALUES ('285', '3', '10', '1557724114');
INSERT INTO `db_role_module` VALUES ('286', '3', '14', '1557724114');
INSERT INTO `db_role_module` VALUES ('287', '3', '18', '1557724114');
INSERT INTO `db_role_module` VALUES ('288', '3', '31', '1557724114');
INSERT INTO `db_role_module` VALUES ('289', '3', '32', '1557724114');
INSERT INTO `db_role_module` VALUES ('290', '3', '33', '1557724114');
INSERT INTO `db_role_module` VALUES ('291', '3', '34', '1557724114');
INSERT INTO `db_role_module` VALUES ('292', '3', '35', '1557724114');
INSERT INTO `db_role_module` VALUES ('293', '3', '15', '1557724114');
INSERT INTO `db_role_module` VALUES ('294', '3', '17', '1557724114');
INSERT INTO `db_role_module` VALUES ('295', '3', '36', '1557724114');
INSERT INTO `db_role_module` VALUES ('296', '3', '37', '1557724114');
INSERT INTO `db_role_module` VALUES ('297', '3', '38', '1557724114');
INSERT INTO `db_role_module` VALUES ('298', '3', '39', '1557724114');
INSERT INTO `db_role_module` VALUES ('299', '3', '40', '1557724114');
INSERT INTO `db_role_module` VALUES ('331', '4', '1', '1557724144');
INSERT INTO `db_role_module` VALUES ('332', '4', '3', '1557724144');
INSERT INTO `db_role_module` VALUES ('333', '4', '19', '1557724144');
INSERT INTO `db_role_module` VALUES ('334', '4', '4', '1557724144');
INSERT INTO `db_role_module` VALUES ('335', '4', '22', '1557724144');
INSERT INTO `db_role_module` VALUES ('336', '4', '23', '1557724144');
INSERT INTO `db_role_module` VALUES ('337', '4', '24', '1557724144');
INSERT INTO `db_role_module` VALUES ('338', '4', '25', '1557724144');
INSERT INTO `db_role_module` VALUES ('339', '4', '2', '1557724144');
INSERT INTO `db_role_module` VALUES ('340', '4', '5', '1557724144');
INSERT INTO `db_role_module` VALUES ('341', '4', '6', '1557724144');
INSERT INTO `db_role_module` VALUES ('342', '4', '7', '1557724144');
INSERT INTO `db_role_module` VALUES ('343', '4', '20', '1557724144');
INSERT INTO `db_role_module` VALUES ('344', '4', '21', '1557724144');
INSERT INTO `db_role_module` VALUES ('345', '4', '26', '1557724144');
INSERT INTO `db_role_module` VALUES ('346', '4', '8', '1557724144');
INSERT INTO `db_role_module` VALUES ('347', '4', '9', '1557724144');
INSERT INTO `db_role_module` VALUES ('348', '4', '16', '1557724144');
INSERT INTO `db_role_module` VALUES ('349', '4', '27', '1557724144');
INSERT INTO `db_role_module` VALUES ('350', '4', '28', '1557724144');
INSERT INTO `db_role_module` VALUES ('351', '4', '29', '1557724144');
INSERT INTO `db_role_module` VALUES ('352', '4', '30', '1557724144');
INSERT INTO `db_role_module` VALUES ('353', '4', '10', '1557724144');
INSERT INTO `db_role_module` VALUES ('354', '4', '14', '1557724144');
INSERT INTO `db_role_module` VALUES ('355', '4', '18', '1557724144');
INSERT INTO `db_role_module` VALUES ('356', '4', '31', '1557724144');
INSERT INTO `db_role_module` VALUES ('357', '4', '32', '1557724144');
INSERT INTO `db_role_module` VALUES ('358', '4', '33', '1557724144');
INSERT INTO `db_role_module` VALUES ('359', '4', '34', '1557724144');
INSERT INTO `db_role_module` VALUES ('360', '4', '35', '1557724144');
INSERT INTO `db_role_module` VALUES ('361', '4', '15', '1557724144');
INSERT INTO `db_role_module` VALUES ('362', '4', '17', '1557724144');
INSERT INTO `db_role_module` VALUES ('363', '4', '36', '1557724144');
INSERT INTO `db_role_module` VALUES ('364', '4', '37', '1557724144');
INSERT INTO `db_role_module` VALUES ('365', '4', '38', '1557724144');
INSERT INTO `db_role_module` VALUES ('366', '4', '39', '1557724144');
INSERT INTO `db_role_module` VALUES ('367', '4', '40', '1557724144');
INSERT INTO `db_role_module` VALUES ('368', '5', '1', '1557724151');
INSERT INTO `db_role_module` VALUES ('369', '5', '3', '1557724151');
INSERT INTO `db_role_module` VALUES ('370', '5', '19', '1557724151');
INSERT INTO `db_role_module` VALUES ('371', '5', '4', '1557724151');
INSERT INTO `db_role_module` VALUES ('372', '5', '22', '1557724151');
INSERT INTO `db_role_module` VALUES ('373', '5', '23', '1557724151');
INSERT INTO `db_role_module` VALUES ('374', '5', '24', '1557724151');
INSERT INTO `db_role_module` VALUES ('375', '5', '25', '1557724151');
INSERT INTO `db_role_module` VALUES ('376', '5', '2', '1557724151');
INSERT INTO `db_role_module` VALUES ('377', '5', '5', '1557724151');
INSERT INTO `db_role_module` VALUES ('378', '5', '6', '1557724151');
INSERT INTO `db_role_module` VALUES ('379', '5', '7', '1557724151');
INSERT INTO `db_role_module` VALUES ('380', '5', '20', '1557724151');
INSERT INTO `db_role_module` VALUES ('381', '5', '21', '1557724151');
INSERT INTO `db_role_module` VALUES ('382', '5', '26', '1557724151');
INSERT INTO `db_role_module` VALUES ('383', '5', '8', '1557724151');
INSERT INTO `db_role_module` VALUES ('384', '5', '9', '1557724151');
INSERT INTO `db_role_module` VALUES ('385', '5', '16', '1557724151');
INSERT INTO `db_role_module` VALUES ('386', '5', '27', '1557724151');
INSERT INTO `db_role_module` VALUES ('387', '5', '28', '1557724151');
INSERT INTO `db_role_module` VALUES ('388', '5', '29', '1557724151');
INSERT INTO `db_role_module` VALUES ('389', '5', '30', '1557724151');
INSERT INTO `db_role_module` VALUES ('390', '5', '10', '1557724151');
INSERT INTO `db_role_module` VALUES ('391', '5', '14', '1557724151');
INSERT INTO `db_role_module` VALUES ('392', '5', '18', '1557724151');
INSERT INTO `db_role_module` VALUES ('393', '5', '31', '1557724151');
INSERT INTO `db_role_module` VALUES ('394', '5', '32', '1557724151');
INSERT INTO `db_role_module` VALUES ('395', '5', '33', '1557724151');
INSERT INTO `db_role_module` VALUES ('396', '5', '34', '1557724151');
INSERT INTO `db_role_module` VALUES ('397', '5', '35', '1557724151');
INSERT INTO `db_role_module` VALUES ('398', '5', '15', '1557724151');
INSERT INTO `db_role_module` VALUES ('399', '5', '17', '1557724151');
INSERT INTO `db_role_module` VALUES ('400', '5', '36', '1557724151');
INSERT INTO `db_role_module` VALUES ('401', '5', '37', '1557724151');
INSERT INTO `db_role_module` VALUES ('402', '5', '38', '1557724151');
INSERT INTO `db_role_module` VALUES ('403', '5', '39', '1557724151');
INSERT INTO `db_role_module` VALUES ('404', '5', '40', '1557724151');
INSERT INTO `db_role_module` VALUES ('405', '2', '1', '1557725876');
INSERT INTO `db_role_module` VALUES ('406', '2', '3', '1557725876');
INSERT INTO `db_role_module` VALUES ('407', '2', '19', '1557725876');
INSERT INTO `db_role_module` VALUES ('408', '2', '4', '1557725876');
INSERT INTO `db_role_module` VALUES ('409', '2', '22', '1557725876');
INSERT INTO `db_role_module` VALUES ('410', '2', '23', '1557725876');
INSERT INTO `db_role_module` VALUES ('411', '2', '24', '1557725876');
INSERT INTO `db_role_module` VALUES ('412', '2', '25', '1557725876');
INSERT INTO `db_role_module` VALUES ('413', '2', '2', '1557725876');
INSERT INTO `db_role_module` VALUES ('414', '2', '5', '1557725876');
INSERT INTO `db_role_module` VALUES ('415', '2', '6', '1557725876');
INSERT INTO `db_role_module` VALUES ('416', '2', '7', '1557725876');
INSERT INTO `db_role_module` VALUES ('417', '2', '20', '1557725876');
INSERT INTO `db_role_module` VALUES ('418', '2', '21', '1557725876');
INSERT INTO `db_role_module` VALUES ('419', '2', '26', '1557725876');
INSERT INTO `db_role_module` VALUES ('420', '2', '8', '1557725876');
INSERT INTO `db_role_module` VALUES ('421', '2', '9', '1557725876');
INSERT INTO `db_role_module` VALUES ('422', '2', '27', '1557725876');
INSERT INTO `db_role_module` VALUES ('423', '2', '29', '1557725876');
INSERT INTO `db_role_module` VALUES ('424', '2', '10', '1557725876');
INSERT INTO `db_role_module` VALUES ('425', '2', '14', '1557725876');
INSERT INTO `db_role_module` VALUES ('426', '2', '31', '1557725876');
INSERT INTO `db_role_module` VALUES ('427', '2', '32', '1557725876');
INSERT INTO `db_role_module` VALUES ('428', '2', '33', '1557725876');
INSERT INTO `db_role_module` VALUES ('429', '2', '34', '1557725876');
INSERT INTO `db_role_module` VALUES ('430', '2', '35', '1557725876');
INSERT INTO `db_role_module` VALUES ('431', '2', '15', '1557725876');
INSERT INTO `db_role_module` VALUES ('432', '2', '17', '1557725876');
INSERT INTO `db_role_module` VALUES ('433', '2', '36', '1557725876');
INSERT INTO `db_role_module` VALUES ('434', '2', '37', '1557725876');
INSERT INTO `db_role_module` VALUES ('435', '2', '38', '1557725876');
INSERT INTO `db_role_module` VALUES ('436', '2', '39', '1557725876');
INSERT INTO `db_role_module` VALUES ('437', '2', '40', '1557725876');

-- ----------------------------
-- Table structure for db_user
-- ----------------------------
DROP TABLE IF EXISTS `db_user`;
CREATE TABLE `db_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usercode` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `gender` tinyint(1) unsigned DEFAULT NULL,
  `head_img` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `passsalt` varchar(32) CHARACTER SET utf8mb4 DEFAULT NULL,
  `created` int(11) unsigned DEFAULT NULL,
  `updated` int(11) unsigned DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '1',
  `single_login` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of db_user
-- ----------------------------
