/*
Navicat MySQL Data Transfer

Source Server         : MySQL56
Source Server Version : 50626
Source Host           : 127.0.0.1:3306
Source Database       : sharetolearn

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-07-25 12:11:19
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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES ('9', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 14:00:54', 'approved', 'comment', '0', 'Hello\n', null, 'pending');
INSERT INTO `comments` VALUES ('10', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 17:29:43', 'approved', 'comment', '9', 'Reply hello admin', null, 'pending');
INSERT INTO `comments` VALUES ('11', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 17:30:24', 'approved', 'comment', '9', 'REply hello amin 2', null, 'pending');
INSERT INTO `comments` VALUES ('13', '135', 'Admin', 'support@admin.com', '1', '2016-07-12 17:34:57', 'approved', 'comment', '9', 'sdfsdfsdf', null, 'pending');
INSERT INTO `comments` VALUES ('53', '135', 'Thanh', 'E-mail', '1', '2016-07-14 14:51:34', 'approved', 'comment', '13', 'adb', 'Website', 'pending');
INSERT INTO `comments` VALUES ('54', '135', 'asdfsdf', 'sdfsdf', '1', '2016-07-19 18:08:37', 'approved', 'comment', '11', 'sdfsdfsdfsdf', 'sdfsdf', 'pending');
INSERT INTO `comments` VALUES ('55', '0', 'LLLL', 'L@gmail.com', '1', '2016-07-19 18:13:29', 'approved', 'contact', '0', 'abcdefgh', null, 'pending');
INSERT INTO `comments` VALUES ('56', '0', 'LLLL', 'L@gmail.com', '1', '2016-07-19 18:14:00', 'approved', 'contact', '0', 'abcdefgh', null, 'pending');
INSERT INTO `comments` VALUES ('57', '0', 'Namesdfsdf', 'E-mailsdfsf', '1', '2016-07-20 08:34:46', 'approved', 'contact', '0', 'sdfsfsfsdf\n\n\n\n\n\n', null, 'pending');
INSERT INTO `comments` VALUES ('58', '0', 'Namesdfsdf', 'E-mailsdfsf', '1', '2016-07-20 08:35:02', 'approved', 'contact', '0', 'sdfsfsfsdf\n\n\n\n\n\n', null, 'pending');
INSERT INTO `comments` VALUES ('60', '131', 'sdfsdfsfsdf', '', '1', '2016-07-20 09:26:08', 'approved', 'comment', '0', 'sdfsdfsdf', 'Website', 'pending');
INSERT INTO `comments` VALUES ('61', '131', 'fsf', 'sdfsdfsdf@sfsdf.com', '1', '2016-07-20 09:28:17', 'approved', 'comment', '0', 'ssdfdfsdfsdf', 'sdfsfd', 'pending');
INSERT INTO `comments` VALUES ('63', '0', 'sfsdfdsf', 'sdfsdf@sdfs.dsdf', '1', '2016-07-20 09:51:04', 'approved', 'contact', '0', 'sdfsdfsdfdsf', '', 'pending');
INSERT INTO `comments` VALUES ('64', '131', 'sfsdf', 'sdfsdfs@sfd.sdfsdf', '1', '2016-07-20 10:09:25', 'approved', 'comment', '0', 'sdfsdfsdf', '', 'pending');
INSERT INTO `comments` VALUES ('65', '131', 'Admin', 'support@admin.com', '1', '2016-07-21 12:58:59', 'pending', 'comment', '64', '', '', 'pending');
INSERT INTO `comments` VALUES ('66', '131', 'BT', 'baotoan@gmail.com', '1', '2016-07-22 15:13:43', 'approved', 'comment', '60', 'Hello sir', 'website.com', 'pending');
INSERT INTO `comments` VALUES ('67', '131', 'LOL', 'ABC@gmail.com', '1', '2016-07-22 15:16:06', 'approved', 'comment', '66', 'adfsdfsf', 'LD', 'pending');
INSERT INTO `comments` VALUES ('68', '131', 'LOL', 'ABC@gmail.com', '1', '2016-07-22 15:16:44', 'approved', 'comment', '0', 'adfsdfsf', 'LD', 'pending');
INSERT INTO `comments` VALUES ('69', '131', 'LOL', 'ABC@gmail.com', '1', '2016-07-22 15:16:54', 'approved', 'comment', '0', 'adfsdfsf', 'LD', 'pending');
INSERT INTO `comments` VALUES ('70', '131', 'sdfs', 'sdfs@gmail.com', '1', '2016-07-22 15:17:27', 'approved', 'comment', '0', 'sdfsdfsdf', 'sadfsdf', 'pending');
INSERT INTO `comments` VALUES ('71', '131', 'sdfsf', 'sdf@gmail.com', '1', '2016-07-22 15:17:53', 'approved', 'comment', '0', 'asdfsfds', 'sdfsdf', 'pending');
INSERT INTO `comments` VALUES ('72', '131', 'asdfsdf', 'sdfs@gmail.com', '1', '2016-07-22 15:18:21', 'approved', 'comment', '0', 'adfsdf', 'asdfsdfsdf', 'pending');
INSERT INTO `comments` VALUES ('73', '131', 'asdfsdf', 'sdfsdf@gmail.com', '1', '2016-07-22 15:18:41', 'approved', 'comment', '0', 'dsfsdf', 'sdfsfs', 'pending');
INSERT INTO `comments` VALUES ('74', '131', 'asdfsdf', 'sdfsdf@sdfsdf.com', '1', '2016-07-22 15:43:47', 'approved', 'comment', '0', 'sdfsdfsdf', 'sdfsdf', 'pending');
INSERT INTO `comments` VALUES ('75', '0', 'asdfsdf', 'asdfs@gmail.com', '1', '2016-07-22 15:53:37', 'approved', 'contact', '0', 'sdfsf', 'sdfsdf', 'pending');
INSERT INTO `comments` VALUES ('76', '0', 'adsf', 'sdf@gamo.com', '1', '2016-07-22 15:55:08', 'approved', 'contact', '0', 'sadfsdf', 'sdafsdf', 'pending');
INSERT INTO `comments` VALUES ('77', '244', 'sdf', 'sdfsdf@asdfsdf.sdfsdf', '1', '2016-07-24 08:03:59', 'trash', 'comment', '0', 'sdfsdfsf', 'sdfsdf', 'approved');

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
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_guid` (`p_guid`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('131', 'Bài viết mới', '<p>N&agrave;y l&agrave; nội dung b&agrave;i viết, rất d&agrave;i v&agrave; rất hay, hữu &iacute;ch cho mọi người, n&ecirc;n đọc! :))</p>\r\n', '1', '6', '0', '<p>Đ&acirc;y l&agrave; tr&iacute;ch đoạn</p>\r\n', null, 'public', '2016-07-23 15:49:18', 'bai-viet-moi', '1', '0', 'post', '13439007_552355538305301_342366450246934188_n1.jpg', '', '0');
INSERT INTO `posts` VALUES ('132', 'Bài viết thứ 2', '                                                                                                ', '1', '0', '0', '                                                                                                ', null, 'draf', '2016-07-06 10:54:16', 'bai-viet-thu-2', '0', '0', 'post', '13439007_552355538305301_342366450246934188_n9.jpg', '', '0');
INSERT INTO `posts` VALUES ('134', 'Lập trình viên bạn là ai?', 'C&aacute;i cần n&oacute;i l&agrave;, lập tr&igrave;nh vi&ecirc;n họ cũng l&agrave; những con người, hoạt động theo bầy đ&agrave;n :3', '1', '3', '0', 'Lập tr&igrave;nh vi&ecirc;n c&aacute;i t&ecirc;n nghe rất thời thượng nhưng nhiều người vẫn c&ograve;n chưa r&otilde; cụ thể Lập tr&igrave;nh vi&ecirc;n c&ocirc;ng việc thường ng&agrave;y của họ l&agrave;m g&igrave; v&agrave;...', null, 'public', '2016-07-23 16:42:43', 'lap-trinh-vien-ban-la-ai', '0', '0', 'post', '10922542_401367413356838_4205009600434851352_n21.jpg', 'baotoan', '0');
INSERT INTO `posts` VALUES ('136', 'Tonight You belong to me', '<strong>Tonight you belong to me</strong><br />\r\n<br />\r\nI know you belong to somebody new<br />\r\nBut tonight you belong to me<br />\r\nAlthough you&#39;re apart<br />\r\nYou are a part of my heart<br />\r\nBut tonight you belong to me<br />\r\nWait down by the stream<br />\r\nHow sweet it will seem<br />\r\nOnce more, just to dream in the moonlight<br />\r\nMy honey I know<br />\r\nWith the draw, that you will be gone<br />\r\nAnd to night you belong to me<br />\r\nJust a little old me', '1', '1', '0', 'I know you belong to some body new<br />\r\nBut tonight you belong to me', null, 'public', '2016-07-23 16:12:57', 'tonight-you-belong-to-me', '1', '0', 'post', '13439007_552355538305301_342366450246934188_n3.jpg', '', '0');
INSERT INTO `posts` VALUES ('139', 'Trang thứ 11', 'Nội dung', '1', '0', '0', 'ABC', null, 'public', '2016-07-08 11:30:58', 'trang-thu-p11', '0', '0', 'page', '13439007_552355538305301_342366450246934188_n11.jpg', '', '0');
INSERT INTO `posts` VALUES ('140', 'Doremon', '<p style=\"text-align:center\"><span style=\"font-size:28px\"><strong>Doremon</strong></span></p>\r\n\r\n<p style=\"text-align:center\"><iframe frameborder=\"0\" height=\"315\" src=\"https://www.youtube.com/embed/n1dMnNUgCT8\" width=\"560\"></iframe></p>\r\n', '1', '3', '0', 'Phim doremon', null, 'public', '2016-07-15 11:45:49', 'doremon', '0', '0', 'post', '10922542_401367413356838_4205009600434851352_n.jpg', '', '0');
INSERT INTO `posts` VALUES ('238', 'sdfsdf', '', '0', '0', '0', '', '', 'public', '2016-07-21 18:31:18', 'sdfsdf', '0', '0', 'navigation', '', '', '0');
INSERT INTO `posts` VALUES ('239', 'sdfsdf', '', '0', '0', '0', '', '', 'public', '2016-07-21 19:01:46', 'sdfsdf-i1', '0', '0', 'navigation', '', '', '0');
INSERT INTO `posts` VALUES ('241', 'Liên hệ', 'BTIT95 lu&ocirc;n sẵn s&agrave;ng đ&oacute;n nhận mọi &yacute; kiến từ mọi người, nếu c&oacute; bất cứ thắc mắc hay g&oacute;p &yacute; vui l&ograve;ng điền v&agrave;o form b&ecirc;n dưới.&nbsp; Cảm ơn!', '1', '0', '0', '', null, 'public', '2016-07-23 11:38:52', 'lien-he', '1', '0', 'page', 'Koala.jpg', '', '0');
INSERT INTO `posts` VALUES ('242', 'Trang chủ', '', '0', '0', '0', '', '', 'public', '2016-07-23 11:41:23', 'http://localhost/ShareToLearn/', '0', '0', 'navigation', '', '', '0');
INSERT INTO `posts` VALUES ('244', 'Cách học lập trình hiệu quả', 'Học lập tr&igrave;nh cũng như bao m&ocirc;n học kh&aacute;c, nhưng c&oacute; một số điều m&agrave; mỗi người cần phải c&acirc;n nhắc v&agrave; n&ecirc;n biết trước khi chọn lập tr&igrave;nh l&agrave; m&ocirc;n ưa th&iacute;ch v&agrave; sẽ &quot;ăn nằm&quot; với n&oacute; c&oacute; thể n&oacute;i l&agrave; cả đời.<br />\r\n<br />\r\nLưu &yacute; thứ 1: Phải c&oacute; một ươc mơ<br />\r\nLưu &yacute; thứ 2: Phải c&oacute; đam m&ecirc;<br />\r\nLưu &yacute; thứ 3: Phải c&oacute; ki&ecirc;n tr&igrave;<br />\r\nLưu &yacute; thứ 4: Phải biết điều chỉnh thời gian<br />\r\n...', '1', '12', '1', 'Học lập tr&igrave;nh cũng như bao m&ocirc;n học kh&aacute;c, nhưng c&oacute; một số điều m&agrave; mỗi người cần phải c&acirc;n nhắc v&agrave; n&ecirc;n biết trước khi chọn lập tr&igrave;nh l&agrave; m&ocirc;n ưa th&iacute;ch v&agrave; sẽ &quot;ăn nằm&quot; với n&oacute; c&oacute; thể n&oacute;i l&agrave; cả đời.', null, 'public', '2016-07-24 07:22:59', 'cach-hoc-lap-trinh-hieu-qua', '1', '0', 'post', '13439007_552355538305301_342366450246934188_n22.jpg', '', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=418 DEFAULT CHARSET=utf8;

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
INSERT INTO `term_relationships` VALUES ('402', '140', '222', '0');
INSERT INTO `term_relationships` VALUES ('403', '140', '190', '0');
INSERT INTO `term_relationships` VALUES ('417', '244', '190', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=228 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `u_joined` datetime DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `unique_username` (`u_username`),
  KEY `u_username` (`u_username`),
  KEY `u_role` (`u_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'baotoan1142@gmail.com', 'baotoan', 'Bảo Toàn', '13439007_552355538305301_342366450246934188_n.jpg', 'Tham gia viết b&agrave;i từ năm 2014 với mục đ&iacute;ch chia sẻ v&agrave; học hỏi, rất mong nhận được sự ủng hộ của c&aacute;c bạn để m&igrave;nh c&oacute; thể viết nhiều b&agrave;i hữu &iacute;ch hơn.', '', 'dfsfsdf@gmail.com', '1234', 'facebook cuar toanf ddaay', '', '1234', '5dR32ZYOq2DMRabtozvS', 'writer', '\0', '', '2016-07-23 20:33:21');
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
INSERT INTO `user_online` VALUES ('::1', '1469422678');
