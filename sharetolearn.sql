/*
Navicat MySQL Data Transfer

Source Server         : MySQL56
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : sharetolearn

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-08-09 22:23:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_post_id` int(11) DEFAULT NULL,
  `cmt_author` varchar(50) NOT NULL,
  `cmt_email` varchar(50) DEFAULT NULL,
  `cmt_user` int(11) DEFAULT NULL,
  `cmt_date` datetime NOT NULL,
  `cmt_status` varchar(10) NOT NULL,
  `cmt_type` varchar(10) NOT NULL,
  `cmt_parent` int(11) DEFAULT NULL,
  `cmt_content` text NOT NULL,
  `cmt_website` varchar(255) DEFAULT NULL,
  `cmt_prev_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`cmt_id`),
  KEY `cmt_post_id` (`cmt_post_id`),
  KEY `cmt_user_id` (`cmt_user`),
  KEY `cmt_type` (`cmt_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('1', '1', 'fsdfsd', null, null, '0000-00-00 00:00:00', 'approved', '', null, '', null, null);
INSERT INTO `comments` VALUES ('2', '1', 'Admin', 'support@admin.com', null, '2016-07-25 20:33:03', 'approved', '', '1', 'fsdfsdf', null, '');
INSERT INTO `comments` VALUES ('3', '1', 'Admin', 'support@admin.com', null, '2016-07-25 20:41:08', 'approved', '', '1', 'ffsdfsdfdf', null, '');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `mn_id` int(11) NOT NULL AUTO_INCREMENT,
  `mn_name` varchar(200) DEFAULT NULL,
  `mn_slug` varchar(200) DEFAULT NULL,
  `mn_parent` int(11) DEFAULT NULL,
  `mn_meta_value` varchar(255) DEFAULT NULL,
  `mn_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`mn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=399 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('395', 'Trang chủ', 'http://localhost/ShareToLearn/', '0', '{\"id\":\"242\",\"type\":\"navigation\"}', '0');
INSERT INTO `menu` VALUES ('396', 'Giải trí', 'http://localhost/ShareToLearn/the-loai/Giai-tri', '0', '{\"id\":\"215\",\"type\":\"category\"}', '1');
INSERT INTO `menu` VALUES ('397', 'Doremon', 'http://localhost/ShareToLearn/doremon-140.html', '396', '{\"id\":\"140\",\"type\":\"post\"}', '0');
INSERT INTO `menu` VALUES ('398', 'Liên hệ', 'http://localhost/ShareToLearn/lien-he.html', '0', '{\"id\":\"241\",\"type\":\"page\"}', '2');

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `o_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `o_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `o_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `o_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`o_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('', null, null, '');
INSERT INTO `options` VALUES ('anyone_can_register', null, null, 'General');
INSERT INTO `options` VALUES ('black_words', null, 'black words', 'Discussion');
INSERT INTO `options` VALUES ('default_role', null, null, 'General');
INSERT INTO `options` VALUES ('introduction', null, 'introduction', 'General');
INSERT INTO `options` VALUES ('must_be_approval', null, 'comment must be wait for approval', 'Discussion');
INSERT INTO `options` VALUES ('must_be_registed', null, 'member must be registed to comment', 'Discussion');
INSERT INTO `options` VALUES ('name_email_required', null, 'fill name and email before send contact or comment', 'Discussion');
INSERT INTO `options` VALUES ('numb_segment', null, 'specifit segment comment', 'Discussion');
INSERT INTO `options` VALUES ('send_mail', null, 'send mail when have any contact or comment', 'Discussion');
INSERT INTO `options` VALUES ('site_title', null, null, 'General');
INSERT INTO `options` VALUES ('slogan', null, null, 'General');

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_content` text COLLATE utf8_unicode_ci NOT NULL,
  `p_author` int(11) NOT NULL,
  `p_view_count` int(11) NOT NULL,
  `p_comment_count` int(11) NOT NULL,
  `p_excerpt` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_catalogue` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `p_published` datetime NOT NULL,
  `p_guid` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `p_comment_allow` tinyint(50) NOT NULL,
  `p_menu_order` int(11) DEFAULT NULL,
  `p_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `p_banner` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_parent` int(11) DEFAULT NULL,
  `p_youtube_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_cue` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_guid` (`p_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', 'abc', 'abc', '1', '15', '0', 'abc', null, 'public', '2016-07-27 12:30:26', 'abc', '1', '0', 'post', '13265961_10157146785975105_5891515887297551622_n1.jpg', 'abc', '0', null, null);
INSERT INTO `posts` VALUES ('2', 'Dev song', '<p>Good song for dev</p>', '1', '8', '0', 'Good song for dev', null, 'public', '2016-08-09 16:30:55', 'dev-song', '1', '0', 'post', 'dsfsdfsdf1470666790.jpg', '', '0', 'https://www.youtube.com/watch?v=1QNy-_hGSxA', '[{\"time\":\"1.5\",\"en\":\"We are the one\",\"vi\":\"Chúng tôi là một\"}, {\"time\":\"3.2\",\"en\":\"Who start with a program\",\"vi\":\"Chúng tôi bắt đầu với một chương trình\"}, {\"time\":\"6.8\",\"en\":\"That say Hello World\",\"vi\":\"Chương trình \\\"Hello World\\\"\"},{\"time\":\"9.6\",\"en\":\"And we never stay\",\"vi\":\"Và chúng tôi chưa bao giờ nghỉ\"}, {\"time\":\"12.5\",\"en\":\"We put a wrong condition in an if else statement but compile it and run it anyway\", \"vi\":\"Chúng tôi đặt một điều kiện sai trong câu lệnh if else nhưng biên dịch và chạy nó bằng mọi cách\"}, {\"time\":\"23.8\",\"en\":\"Our only goal is to make Team leaders dream come true\", \"vi\":\"Mục tiêu duy nhất của chúng tôi là làm cho giấc mơ làm trưởng nhóm trở thành sự thật\"}, {\"time\":\"29\",\"en\":\"So we copy our code from Stackoverflow\",\"vi\":\"Chúng tôi copy mã từ Stackoverflow\"}, {\"time\":\"34.5\",\"en\":\"Our life is stuck in an infinete for loop till our kingdom come\",\"vi\":\"Cuộc sống của chúng tôi đang bị mắc kẹt trong một vòng lặp vô hạn cho đến khi thời cơ đến\"}, {\"time\":\"42.5\",\"en\":\"Till our kingdom come\",\"vi\":\"Cho đến khi thời cơ của chúng tôi đến\"},\r\n{\"time\":\"45.5\",\"en\":\"If you see someone with alonely life\",\"vi\":\"Nếu bạn thấy ai đó còn cô đơn trong cuộc sống\"},{\"time\":\"50.5\",\"en\":\"He is an Engineer\",\"vi\":\"Anh ấy chính là một kĩ sư\"},{\"time\":\"53.2\",\"en\":\"A Software Engineer\",\"vi\":\"Một kĩ sư phần mềm\"},\r\n{\"time\":\"56\",\"en\":\"Google infosys and intel inside\",\"vi\":\"Được làm việc trong Google và Intel\"},{\"time\":\"62\",\"en\":\"Are our dream companies\",\"vi\":\"Là những công ty mà chúng tôi mơ ước\"},\r\n{\"time\":\"66.5\",\"en\":\"System dot out dot print\",\"vi\":\"System.out.print\"},{\"time\":\"69.3\",\"en\":\"My life sucks so bad\",\"vi\":\"Cuộc sống của tôi rất nhàm chán\"},{\"time\":\"72\",\"en\":\"Give me a header file\",\"vi\":\"Cho tôi một tập tin\"},\r\n{\"time\":\"74.5\",\"en\":\"Import java dot life\",\"vi\":\"Nhập java.life\"},{\"time\":\"77.2\",\"en\":\"Your eyes they shine so bright\",\"vi\":\"Đôi mắt của bạn sáng quá\"},{\"time\":\"80\",\"en\":\"I think you\'ve got a life\",\"vi\":\"Tôi nghĩ rằng bạn đã có một cuộc sống tốt đẹp\"},\r\n{\"time\":\"82.5\",\"en\":\"If you want it to go\",\"vi\":\"Nếu bạn muốn có nó\"},{\"time\":\"85\",\"en\":\"Come with us Onboard\",\"vi\":\"Hay đến với chúng tôi\"}]');

-- ----------------------------
-- Table structure for statistic
-- ----------------------------
DROP TABLE IF EXISTS `statistic`;
CREATE TABLE `statistic` (
  `stt_date` date NOT NULL,
  `stt_count` int(255) NOT NULL,
  PRIMARY KEY (`stt_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of statistic
-- ----------------------------
INSERT INTO `statistic` VALUES ('2016-07-22', '4453');
INSERT INTO `statistic` VALUES ('2016-07-23', '23');
INSERT INTO `statistic` VALUES ('2016-07-26', '4');
INSERT INTO `statistic` VALUES ('2016-07-27', '2');
INSERT INTO `statistic` VALUES ('2016-08-01', '3');
INSERT INTO `statistic` VALUES ('2016-08-02', '4');
INSERT INTO `statistic` VALUES ('2016-08-03', '2');
INSERT INTO `statistic` VALUES ('2016-08-05', '2');
INSERT INTO `statistic` VALUES ('2016-08-07', '3');
INSERT INTO `statistic` VALUES ('2016-08-08', '12');
INSERT INTO `statistic` VALUES ('2016-08-09', '5');

-- ----------------------------
-- Table structure for terms
-- ----------------------------
DROP TABLE IF EXISTS `terms`;
CREATE TABLE `terms` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `t_slug` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `t_group` int(11) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of terms
-- ----------------------------
INSERT INTO `terms` VALUES ('215', 'Giải trí', 'Giai-tri', '0');
INSERT INTO `terms` VALUES ('216', 'Học tập', 'Hoc-tap', '0');
INSERT INTO `terms` VALUES ('217', 'Giải trí vui', 'Giai-tri-vui', '0');
INSERT INTO `terms` VALUES ('218', 'Hello', 'Hello', '0');
INSERT INTO `terms` VALUES ('219', 'BaoToan', 'BaoToan', '0');
INSERT INTO `terms` VALUES ('220', 'vui là chính', 'vui-la-chinh', '0');
INSERT INTO `terms` VALUES ('221', 'Tản mạn', 'Tan-man', '0');
INSERT INTO `terms` VALUES ('223', 'Bình thường thôi', 'Binh-thuong-thoi', '0');
INSERT INTO `terms` VALUES ('233', 'Bác Thành blc', 'Bac-Thanh-blc', '0');
INSERT INTO `terms` VALUES ('242', 'Văn hóa', 'Van-hoa', '0');
INSERT INTO `terms` VALUES ('244', 'Giải trí', 'Giai-tri', '0');
INSERT INTO `terms` VALUES ('245', 'học tập', 'hoc-tap', '0');
INSERT INTO `terms` VALUES ('246', 'văn hóa', 'van-hoa', '0');
INSERT INTO `terms` VALUES ('247', 'chính trị', 'chinh-tri', '0');
INSERT INTO `terms` VALUES ('248', 'vui', 'vui', '0');
INSERT INTO `terms` VALUES ('249', 'phim hoạt hình', 'phim-hoat-hinh', '0');
INSERT INTO `terms` VALUES ('251', 'Tào lao', 'tao-lao', '0');
INSERT INTO `terms` VALUES ('252', 'ádfsdf', 'sdfsdfsdf', '0');
INSERT INTO `terms` VALUES ('253', 'sdfsdf', 'sdfsdf', '0');
INSERT INTO `terms` VALUES ('254', 'nhạc anh', 'nhac-anh', '0');
INSERT INTO `terms` VALUES ('256', 'Hello', 'Hello', '0');
INSERT INTO `terms` VALUES ('257', 'Ngô bảo toàn', 'Ngô bảo toàn', '0');
INSERT INTO `terms` VALUES ('258', 'Lương Đan Quỳnh', 'luong-dan-quynh', '0');
INSERT INTO `terms` VALUES ('259', 'Tiếng Anh', 'tieng-anh', '0');

-- ----------------------------
-- Table structure for term_relationships
-- ----------------------------
DROP TABLE IF EXISTS `term_relationships`;
CREATE TABLE `term_relationships` (
  `tr_id` int(11) NOT NULL AUTO_INCREMENT,
  `tr_object_id` int(11) NOT NULL,
  `tr_term_taxonomy_id` int(11) NOT NULL,
  `tr_term_order` int(11) NOT NULL,
  PRIMARY KEY (`tr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=522 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of term_relationships
-- ----------------------------
INSERT INTO `term_relationships` VALUES ('198', '132', '191', '0');
INSERT INTO `term_relationships` VALUES ('228', '141', '196', '0');
INSERT INTO `term_relationships` VALUES ('372', '136', '227', '0');
INSERT INTO `term_relationships` VALUES ('373', '136', '190', '0');
INSERT INTO `term_relationships` VALUES ('394', '134', '192', '0');
INSERT INTO `term_relationships` VALUES ('395', '134', '195', '0');
INSERT INTO `term_relationships` VALUES ('396', '134', '190', '0');
INSERT INTO `term_relationships` VALUES ('397', '134', '196', '0');
INSERT INTO `term_relationships` VALUES ('398', '131', '192', '0');
INSERT INTO `term_relationships` VALUES ('399', '131', '194', '0');
INSERT INTO `term_relationships` VALUES ('400', '131', '190', '0');
INSERT INTO `term_relationships` VALUES ('401', '131', '191', '0');
INSERT INTO `term_relationships` VALUES ('430', '244', '190', '0');
INSERT INTO `term_relationships` VALUES ('433', '140', '222', '0');
INSERT INTO `term_relationships` VALUES ('434', '140', '190', '0');
INSERT INTO `term_relationships` VALUES ('519', '1', '190', '0');
INSERT INTO `term_relationships` VALUES ('521', '2', '231', '0');

-- ----------------------------
-- Table structure for term_taxonomy
-- ----------------------------
DROP TABLE IF EXISTS `term_taxonomy`;
CREATE TABLE `term_taxonomy` (
  `tt_id` int(11) NOT NULL AUTO_INCREMENT,
  `tt_term_id` int(11) NOT NULL,
  `tt_taxonomy_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tt_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tt_parent` int(11) NOT NULL,
  `tt_count` int(11) NOT NULL,
  PRIMARY KEY (`tt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of term_taxonomy
-- ----------------------------
INSERT INTO `term_taxonomy` VALUES ('190', '215', 'category', 'giải trí', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('191', '216', 'category', 'category', '0', '-1');
INSERT INTO `term_taxonomy` VALUES ('192', '217', 'tag', 'moo tar     ', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('193', '218', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('194', '219', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('195', '220', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('196', '221', 'category', 'category', '215', '0');
INSERT INTO `term_taxonomy` VALUES ('198', '223', 'tag', 'Bình thường lại bình thường\r\n                                                      ', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('208', '233', 'tag', 'Good job', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('215', '242', 'category', 'mô tả\n', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('217', '244', 'tag', 'Giải trí', '0', '-1');
INSERT INTO `term_taxonomy` VALUES ('218', '245', 'tag', 'học tập', '0', '-1');
INSERT INTO `term_taxonomy` VALUES ('219', '246', 'tag', 'văn hóa', '0', '-1');
INSERT INTO `term_taxonomy` VALUES ('220', '247', 'tag', 'chính trị', '0', '-1');
INSERT INTO `term_taxonomy` VALUES ('221', '248', 'tag', 'vui', '0', '-1');
INSERT INTO `term_taxonomy` VALUES ('222', '249', 'tag', 'phim hoạt hình', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('224', '251', 'category', 'abc', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('225', '252', 'category', 'adsfsdf', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('226', '253', 'category', 'sdfsdf', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('227', '254', 'tag', 'nhạc anh', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('228', '256', 'category', 'nothing', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('229', '257', 'category', 'nothing', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('230', '258', 'category', 'nothing', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('231', '259', 'category', 'nothing', '216', '0');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(30) NOT NULL,
  `u_password` varchar(32) NOT NULL,
  `u_fullname` varchar(50) NOT NULL,
  `u_avatar` varchar(200) DEFAULT NULL,
  `u_desc` varchar(500) DEFAULT NULL,
  `u_bio` text,
  `u_email` varchar(100) NOT NULL,
  `u_phone` varchar(20) DEFAULT NULL,
  `u_facebook` varchar(300) DEFAULT NULL,
  `u_skype` varchar(300) DEFAULT NULL,
  `u_google` varchar(300) DEFAULT NULL,
  `u_key` varchar(50) NOT NULL,
  `u_role` varchar(20) NOT NULL,
  `u_non_blocked` bit(1) NOT NULL,
  `u_actived` bit(1) NOT NULL,
  `u_joined` datetime DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `unique_username` (`u_username`),
  KEY `u_username` (`u_username`),
  KEY `u_role` (`u_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'baotoan1142@gmail.com', 'baotoan', 'Bảo Toàn', '13439007_552355538305301_342366450246934188_n.jpg', 'L&agrave; một sinh vi&ecirc;n lười biếng, c&oacute; khả năng ngồi &ocirc;m m&aacute;y t&iacute;nh cả ng&agrave;y m&agrave; kh&ocirc;ng thấy ch&aacute;n, th&iacute;ch viết l&aacute;ch v&agrave;&nbsp;chia sẻ những kiến thức đ&atilde; học được mặc d&ugrave; kh&ocirc;ng c&oacute; bao nhi&ecirc;u &nbsp;v&agrave; khả năng viết l&aacute;ch cũng kh&ocirc;ng bằng ai :3 Nhưng cũng muốn đ&oacute;ng g&oacute;p một ch&uacute;t g&igrave; đ&oacute; cho đời. Mong được sự ủng hộ của mọi người.', '', 'dfsfsdf@gmail.com', '1234', 'facebook cuar toanf ddaay', 'dsfsdf', '1234ssdfsdf', 'KQ@0cicuvP8vlJj9YTF0', 'writer', '\0', '', '2016-07-25 19:08:51');
INSERT INTO `users` VALUES ('2', 'tranlong', '1234', 'Trần Văn Long', '10922542_401367413356838_4205009600434851352_n.jpg', 'Tham gia viết bài từ năm 2014 với mục đích chia sẻ và học hỏi, rất mong nhận được sự ủng hộ của các bạn để mình có thể viết nhiều bài hữu ích hơn.', 'dfsdfsdfdf', 'tranlong@gmail.com', '12345', 'facebook cuar toanf ddaay', 'dsfsdfsdf', '12345', 'aM3iOuolIPcxJH8BcAfJ', 'admin', '', '', '2016-07-23 20:33:26');

-- ----------------------------
-- Table structure for user_online
-- ----------------------------
DROP TABLE IF EXISTS `user_online`;
CREATE TABLE `user_online` (
  `uol_user_ip` varchar(255) NOT NULL,
  `uol_time` int(11) DEFAULT '0',
  PRIMARY KEY (`uol_user_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_online
-- ----------------------------
INSERT INTO `user_online` VALUES ('::1', '1470755606');
