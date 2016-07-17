/*
Navicat MySQL Data Transfer

Source Server         : MySQL56
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : sharetolearn

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-07-17 21:48:28
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
  `cmt_user_id` int(11) DEFAULT NULL,
  `cmt_date` datetime NOT NULL,
  `cmt_status` varchar(10) NOT NULL,
  `cmt_type` varchar(10) NOT NULL,
  `cmt_parent` int(11) DEFAULT NULL,
  `cmt_content` text NOT NULL,
  `cmt_website` varchar(255) DEFAULT NULL,
  `cmt_prev_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`cmt_id`),
  KEY `cmt_post_id` (`cmt_post_id`),
  KEY `cmt_user_id` (`cmt_user_id`),
  KEY `cmt_type` (`cmt_type`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('9', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 14:00:54', 'pending', 'comment', '0', 'Hello\n', null, 'pending');
INSERT INTO `comments` VALUES ('10', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 17:29:43', 'pending', 'comment', '9', 'Reply hello admin', null, 'pending');
INSERT INTO `comments` VALUES ('11', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 17:30:24', 'pending', 'comment', '9', 'REply hello amin 2', null, 'pending');
INSERT INTO `comments` VALUES ('13', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 17:34:57', 'approved', 'comment', '9', 'sdfsdfsdf', null, 'pending');
INSERT INTO `comments` VALUES ('53', '135', 'Thanh', 'E-mail', '1', '2016-07-14 14:51:34', 'approved', 'comment', '13', 'adb', 'Website', 'pending');
INSERT INTO `comments` VALUES ('54', '141', 'Toan', 'E-mail', '1', '2016-07-14 15:31:53', 'pending', 'comment', '0', 'Bài viết hay quá <3', 'Website', 'pending');
INSERT INTO `comments` VALUES ('55', '141', 'Admin', 'E-mail', '1', '2016-07-14 15:32:13', 'pending', 'comment', '54', 'Thanks!', 'Website', 'pending');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `mn_id` int(11) NOT NULL AUTO_INCREMENT,
  `mn_name` varchar(200) DEFAULT NULL,
  `mn_slug` varchar(200) DEFAULT NULL,
  `mn_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`mn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('48', 'A', 'addsf', '0');
INSERT INTO `menu` VALUES ('49', 'Giải trí', 'Giai-tri', '48');
INSERT INTO `menu` VALUES ('50', 'Trang thứ 11', 'trang-thu-11', '49');
INSERT INTO `menu` VALUES ('51', 'Ngô Bảo Toàn', 'ngo-bao-toan', '0');

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
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_guid` (`p_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('131', 'Bài viết mới', '<p>N&agrave;y l&agrave; nội dung b&agrave;i viết, rất d&agrave;i v&agrave; rất hay, hữu &iacute;ch cho mọi người, n&ecirc;n đọc! :))</p>\r\n', '1', '0', '0', '<p>Đ&acirc;y l&agrave; tr&iacute;ch đoạn</p>\r\n', null, 'public', '2016-07-14 06:26:15', 'bai-viet-moi', '1', '0', 'post', '13439007_552355538305301_342366450246934188_n1.jpg', '', '0');
INSERT INTO `posts` VALUES ('132', 'Bài viết thứ 2', '                                                                                                ', '1', '0', '0', '                                                                                                ', null, 'draf', '2016-07-06 10:54:16', 'bai-viet-thu-2', '0', '0', 'post', '13439007_552355538305301_342366450246934188_n9.jpg', '', '0');
INSERT INTO `posts` VALUES ('133', 'Bài viết thứ 31', '', '1', '0', '0', '', null, 'private', '2016-07-14 06:26:33', 'bai-viet-thu-31', '0', '0', 'post', '13439007_552355538305301_342366450246934188_n2.jpg', '', '0');
INSERT INTO `posts` VALUES ('134', 'Lập trình viên bạn là ai?', '                                                                                                                                                                        ', '1', '0', '0', '                                                                                                                                                                        ', null, 'pending', '2016-07-06 10:55:34', 'lap-trinh-vien-ban-la-ai', '0', '0', 'post', '10922542_401367413356838_4205009600434851352_n21.jpg', '', '0');
INSERT INTO `posts` VALUES ('135', 'Ngô Bảo Toàn', '<p>It is handsome</p>\r\n', '1', '0', '0', '', null, 'public', '2016-07-14 09:02:35', 'ngo-bao-toan', '1', '0', 'post', '13439007_552355538305301_342366450246934188_n.jpg', '', '0');
INSERT INTO `posts` VALUES ('136', 'Bài viết 1001', '', '1', '0', '0', '', null, 'public', '2016-07-14 08:52:22', 'bai-viet-1001', '0', '0', 'post', '13439007_552355538305301_342366450246934188_n3.jpg', '', '0');
INSERT INTO `posts` VALUES ('139', 'Trang thứ 11', 'Nội dung', '1', '0', '0', 'ABC', null, 'public', '2016-07-08 11:30:58', 'trang-thu-11', '0', '0', 'page', '13439007_552355538305301_342366450246934188_n11.jpg', '', '0');
INSERT INTO `posts` VALUES ('140', 'Doremon', '<p style=\"text-align:center\"><span style=\"font-size:28px\"><strong>Doremon</strong></span></p>\r\n\r\n<p style=\"text-align:center\"><iframe frameborder=\"0\" height=\"315\" src=\"https://www.youtube.com/embed/n1dMnNUgCT8\" width=\"560\"></iframe></p>\r\n', '1', '0', '0', 'Phim doremon', null, 'public', '2016-07-15 11:45:49', 'doremon', '0', '0', 'post', '10922542_401367413356838_4205009600434851352_n.jpg', '', '0');
INSERT INTO `posts` VALUES ('219', '$name', '', '0', '0', '0', '', '', 'public', '2016-07-17 15:39:39', '$linddk', '0', '0', 'navigation', '', '', '0');
INSERT INTO `posts` VALUES ('220', '$name', '', '0', '0', '0', '', '', 'public', '2016-07-17 15:39:41', '$linddk-1', '0', '0', 'navigation', '', '', '0');
INSERT INTO `posts` VALUES ('221', '$name', '', '0', '0', '0', '', '', 'public', '2016-07-17 15:39:45', '$linddk-2', '0', '0', 'navigation', '', '', '0');
INSERT INTO `posts` VALUES ('222', 'A', '', '0', '0', '0', '', '', 'public', '2016-07-17 15:42:18', 'addsf', '0', '0', 'navigation', '', '', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
INSERT INTO `terms` VALUES ('243', 'Thể thao', 'the_thao.html', '0');
INSERT INTO `terms` VALUES ('244', 'Giải trí', 'Giai-tri', '0');
INSERT INTO `terms` VALUES ('245', 'học tập', 'hoc-tap', '0');
INSERT INTO `terms` VALUES ('246', 'văn hóa', 'van-hoa', '0');
INSERT INTO `terms` VALUES ('247', 'chính trị', 'chinh-tri', '0');
INSERT INTO `terms` VALUES ('248', 'vui', 'vui', '0');
INSERT INTO `terms` VALUES ('249', 'phim hoạt hình', 'phim-hoat-hinh', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of term_relationships
-- ----------------------------
INSERT INTO `term_relationships` VALUES ('198', '132', '191', '0');
INSERT INTO `term_relationships` VALUES ('199', '134', '192', '0');
INSERT INTO `term_relationships` VALUES ('200', '134', '195', '0');
INSERT INTO `term_relationships` VALUES ('201', '134', '190', '0');
INSERT INTO `term_relationships` VALUES ('202', '134', '196', '0');
INSERT INTO `term_relationships` VALUES ('211', '131', '192', '0');
INSERT INTO `term_relationships` VALUES ('212', '131', '194', '0');
INSERT INTO `term_relationships` VALUES ('213', '131', '190', '0');
INSERT INTO `term_relationships` VALUES ('214', '131', '191', '0');
INSERT INTO `term_relationships` VALUES ('215', '135', '217', '0');
INSERT INTO `term_relationships` VALUES ('216', '135', '218', '0');
INSERT INTO `term_relationships` VALUES ('217', '135', '219', '0');
INSERT INTO `term_relationships` VALUES ('218', '135', '220', '0');
INSERT INTO `term_relationships` VALUES ('219', '135', '221', '0');
INSERT INTO `term_relationships` VALUES ('220', '135', '190', '0');
INSERT INTO `term_relationships` VALUES ('221', '135', '191', '0');
INSERT INTO `term_relationships` VALUES ('228', '141', '196', '0');
INSERT INTO `term_relationships` VALUES ('229', '140', '222', '0');
INSERT INTO `term_relationships` VALUES ('230', '140', '190', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of term_taxonomy
-- ----------------------------
INSERT INTO `term_taxonomy` VALUES ('190', '215', 'category', 'giải trí', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('191', '216', 'category', 'category', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('192', '217', 'tag', 'moo tar     ', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('193', '218', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('194', '219', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('195', '220', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('196', '221', 'category', 'category', '215', '0');
INSERT INTO `term_taxonomy` VALUES ('198', '223', 'tag', 'Bình thường lại bình thường\r\n                                                      ', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('208', '233', 'tag', 'Good job', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('215', '242', 'category', 'mô tả\n', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('216', '243', 'category', '                            111                        ', '215', '0');
INSERT INTO `term_taxonomy` VALUES ('217', '244', 'tag', 'Giải trí', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('218', '245', 'tag', 'học tập', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('219', '246', 'tag', 'văn hóa', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('220', '247', 'tag', 'chính trị', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('221', '248', 'tag', 'vui', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('222', '249', 'tag', 'phim hoạt hình', '0', '0');

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
  `u_desc` varchar(300) DEFAULT NULL,
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
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `unique_username` (`u_username`),
  KEY `u_username` (`u_username`),
  KEY `u_role` (`u_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'baotoan1142@gmail.com', 'baotoan', 'Bảo Toàn', '13439007_552355538305301_342366450246934188_n.jpg', 'Tham gia viết b&agrave;i từ năm 2014 với mục đ&iacute;ch chia sẻ v&agrave; học hỏi, rất mong nhận được sự ủng hộ của c&aacute;c bạn để m&igrave;nh c&oacute; thể viết nhiều b&agrave;i hữu &iacute;ch hơn.', '', 'dfsfsdf@gmail.com', '1234', 'facebook cuar toanf ddaay', '', '1234', '5dR32ZYOq2DMRabtozvS', 'writer', '\0', '');
INSERT INTO `users` VALUES ('2', 'tranlong', '1234', 'Trần Văn Long', '10922542_401367413356838_4205009600434851352_n.jpg', 'Tham gia viết bài từ năm 2014 với mục đích chia sẻ và học hỏi, rất mong nhận được sự ủng hộ của các bạn để mình có thể viết nhiều bài hữu ích hơn.', 'dfsdfsdfdf', 'tranlong@gmail.com', '12345', 'facebook cuar toanf ddaay', 'dsfsdfsdf', '12345', 'aM3iOuolIPcxJH8BcAfJ', 'admin', '', '');
