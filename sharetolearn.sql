/*
Navicat MySQL Data Transfer

Source Server         : MySQL56
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : sharetolearn

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-07-05 19:35:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for commnets
-- ----------------------------
DROP TABLE IF EXISTS `commnets`;
CREATE TABLE `commnets` (
  `cmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmt_post_id` int(11) NOT NULL,
  `cmt_author` varchar(50) NOT NULL,
  `cmt_email` varchar(50) NOT NULL,
  `cmt_user_id` int(11) NOT NULL,
  `cmt_date` datetime NOT NULL,
  `cmt_status` tinyint(1) NOT NULL,
  `cmt_type` tinyint(1) NOT NULL,
  `cmt_parent` int(11) NOT NULL,
  `cmt_content` text NOT NULL,
  PRIMARY KEY (`cmt_id`),
  KEY `cmt_post_id` (`cmt_post_id`),
  KEY `cmt_user_id` (`cmt_user_id`),
  KEY `cmt_type` (`cmt_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of commnets
-- ----------------------------

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
INSERT INTO `options` VALUES ('allow_comment', null, null, 'Discussion');
INSERT INTO `options` VALUES ('any_register', null, null, 'User');
INSERT INTO `options` VALUES ('author_pending_approve_comment', null, null, 'Discussion');
INSERT INTO `options` VALUES ('avatar_user_default', null, null, 'Discussion');
INSERT INTO `options` VALUES ('cmt_block_list', null, null, 'Discussion');
INSERT INTO `options` VALUES ('comment_protected', null, null, 'Discussion');
INSERT INTO `options` VALUES ('default_email_password', null, null, 'Email');
INSERT INTO `options` VALUES ('default_email_username', null, null, 'Email');
INSERT INTO `options` VALUES ('introduction', null, null, 'General');
INSERT INTO `options` VALUES ('num_show_comments', null, null, 'Discussion');
INSERT INTO `options` VALUES ('role_default', null, null, 'User');
INSERT INTO `options` VALUES ('send_email_new_status', null, null, 'Discussion');
INSERT INTO `options` VALUES ('sologan', 'Chia Sẻ Để Học', null, 'General');
INSERT INTO `options` VALUES ('website_title', 'ShareToLearn', null, 'General');

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
  `p_type` tinyint(1) NOT NULL,
  `p_banner` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_guid` (`p_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('131', 'Bài viết mới', '                                                                                                                                                                                                                        ', '1', '0', '0', '                                                                                                                                                                                                                        ', null, 'public', '2016-07-05 12:02:50', 'bai-viet-moi', '1', '0', '0', '10922542_401367413356838_4205009600434851352_n19.jpg', '', '0');
INSERT INTO `posts` VALUES ('132', 'Bài viết thứ 2', '                                                ', '1', '0', '0', '                                                ', null, 'public', '2016-07-05 11:15:51', 'bai-viet-thu-2', '0', '0', '0', '13439007_552355538305301_342366450246934188_n9.jpg', '', '0');
INSERT INTO `posts` VALUES ('133', 'Bài viết thứ 3', '                                                ', '1', '0', '0', '                                                ', null, 'private', '2016-07-05 14:27:03', 'bai-viet-thu-3', '0', '0', '0', '10922542_401367413356838_4205009600434851352_n20.jpg', '', '0');
INSERT INTO `posts` VALUES ('134', 'Lập trình viên bạn là ai?', '                                                ', '1', '0', '0', '                                                ', null, 'public', '2016-07-05 12:19:02', 'lap-trinh-vien-ban-la-ai', '0', '0', '0', '10922542_401367413356838_4205009600434851352_n21.jpg', '', '0');
INSERT INTO `posts` VALUES ('135', 'Ngô Bảo Toàn', 'It is handsome\r\n                                                ', '1', '0', '0', '                                                                                                                        ', null, 'private', '2016-07-05 11:57:33', 'ngo-bao-toan', '1', '0', '0', '10922542_401367413356838_4205009600434851352_n22.jpg', '', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of terms
-- ----------------------------
INSERT INTO `terms` VALUES ('215', 'Giải trí', 'Giai-tri', '0');
INSERT INTO `terms` VALUES ('216', 'Học tập', 'Hoc-tap', '0');
INSERT INTO `terms` VALUES ('217', 'Giải trí vui', 'Giai-tri-vui', '0');
INSERT INTO `terms` VALUES ('218', 'Hello', 'Hello', '0');
INSERT INTO `terms` VALUES ('219', 'BaoToan', 'BaoToan', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of term_relationships
-- ----------------------------
INSERT INTO `term_relationships` VALUES ('179', '135', '190', '0');
INSERT INTO `term_relationships` VALUES ('180', '135', '191', '0');
INSERT INTO `term_relationships` VALUES ('181', '131', '192', '0');
INSERT INTO `term_relationships` VALUES ('182', '131', '194', '0');
INSERT INTO `term_relationships` VALUES ('183', '131', '190', '0');
INSERT INTO `term_relationships` VALUES ('184', '131', '191', '0');
INSERT INTO `term_relationships` VALUES ('185', '134', '191', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of term_taxonomy
-- ----------------------------
INSERT INTO `term_taxonomy` VALUES ('190', '215', 'category', 'category', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('191', '216', 'category', 'category', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('192', '217', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('193', '218', 'tag', 'tag', '0', '0');
INSERT INTO `term_taxonomy` VALUES ('194', '219', 'tag', 'tag', '0', '0');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(30) NOT NULL,
  `u_password` varchar(32) NOT NULL,
  `u_fullname` varchar(50) NOT NULL,
  `u_avatar` int(11) NOT NULL,
  `u_desc` int(11) NOT NULL,
  `u_bio` int(11) NOT NULL,
  `u_email` int(11) NOT NULL,
  `u_phone` int(11) NOT NULL,
  `u_facebook` int(11) NOT NULL,
  `u_skype` int(11) NOT NULL,
  `u_google` int(11) NOT NULL,
  `u_key` int(11) NOT NULL,
  `u_role` int(11) NOT NULL,
  `u_non_blocked` int(11) NOT NULL,
  PRIMARY KEY (`u_id`),
  KEY `u_username` (`u_username`),
  KEY `u_role` (`u_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
