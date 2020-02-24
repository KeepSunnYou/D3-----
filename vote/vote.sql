/*
Navicat MySQL Data Transfer

Source Server         : 123
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : vote

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2020-02-24 15:29:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for vote
-- ----------------------------
DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titleid` int(10) DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  `count` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of vote
-- ----------------------------
INSERT INTO `vote` VALUES ('24', '1', '李现', '9');
INSERT INTO `vote` VALUES ('25', '1', '王一博', '12');
INSERT INTO `vote` VALUES ('26', '1', '肖战', '13');
INSERT INTO `vote` VALUES ('27', '1', '陆婷', '23');
INSERT INTO `vote` VALUES ('28', '1', '张艺兴', '4');
INSERT INTO `vote` VALUES ('29', '1', '林俊杰', '6');

-- ----------------------------
-- Table structure for votetitle
-- ----------------------------
DROP TABLE IF EXISTS `votetitle`;
CREATE TABLE `votetitle` (
  `titleid` int(10) NOT NULL,
  `votetitle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of votetitle
-- ----------------------------
INSERT INTO `votetitle` VALUES ('1', 'Privacy 101 C位，你pick谁？');
