/*
 Navicat Premium Data Transfer

 Source Server         : ss
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : skote

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 03/04/2021 11:16:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for food
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food`  (
  `foods_id` int(11) NOT NULL AUTO_INCREMENT,
  `foods_name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foods_image` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foods_health_capacity` int(11) NOT NULL,
  `foods_status` int(11) NOT NULL COMMENT '0=No,1=Yes',
  `foods_created_date` datetime(0) NOT NULL,
  `foods_ip_address` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`foods_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 45 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of food
-- ----------------------------
INSERT INTO `food` VALUES (3, '', 'mushroom-1.png', 10, 1, '0000-00-00 00:00:00', '', NULL);
INSERT INTO `food` VALUES (4, '', 'mushroom-2.png', 20, 1, '0000-00-00 00:00:00', '', NULL);
INSERT INTO `food` VALUES (6, 'Coconut', 'mushroom-3.png', 30, 1, '2017-12-01 00:00:00', '60.254.125.26', '2021-01-07 13:08:44');
INSERT INTO `food` VALUES (7, 'Milk', 'mushroom-4.png', 40, 1, '2017-12-01 00:00:00', '60.254.125.26', NULL);
INSERT INTO `food` VALUES (8, '', 'Medkit.png', 50, 1, '0000-00-00 00:00:00', '', NULL);

SET FOREIGN_KEY_CHECKS = 1;
