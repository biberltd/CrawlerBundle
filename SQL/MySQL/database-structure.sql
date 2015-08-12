/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bod_core

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2015-08-12 09:56:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for crawler_link
-- ----------------------------
DROP TABLE IF EXISTS `crawler_link`;
CREATE TABLE `crawler_link` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT 'System given id.',
  `url` text COLLATE utf8_turkish_ci NOT NULL COMMENT 'This is the url to be crawled.',
  `section` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'This is the section that is being crawled in given url.',
  `hash` varchar(32) COLLATE utf8_turkish_ci NOT NULL COMMENT 'md5 hash of url + section.',
  `priority` smallint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Can have negative values. Can be used as a sort order mechanism or a priority access mechanism.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxUCrawlerLinkId` (`id`),
  UNIQUE KEY `idxUCrawlerLinkUrl` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- ----------------------------
-- Table structure for crawler_log
-- ----------------------------
DROP TABLE IF EXISTS `crawler_log`;
CREATE TABLE `crawler_log` (
  `id` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT 'This is the system given auto-increment id.',
  `timestamp` datetime NOT NULL COMMENT 'This is the date & time when the crawler ran and the action is logged.',
  `is_changed` char(1) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'n' COMMENT 'y:yes,n:no',
  `hash` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'Crawl hash. This is created using md5() on crawled content.',
  `status` smallint(3) unsigned NOT NULL COMMENT '200, 301, 404 etc. Indicates if the URL is fetched, not found, etc.',
  `link` bigint(15) unsigned DEFAULT NULL COMMENT 'This is field indicates which link is crawled.',
  `content` text COLLATE utf8_turkish_ci COMMENT 'Stored file''s name or crawled content.',
  `rule` int(10) unsigned DEFAULT NULL COMMENT 'Rule that is crawled.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxUCrawlerLogId` (`id`),
  UNIQUE KEY `idxUCrawlerLogHash` (`hash`),
  UNIQUE KEY `idxUCrawlerLog` (`timestamp`,`link`,`rule`) USING BTREE,
  KEY `idxFCrawledLink` (`link`),
  KEY `idxFXpathRuleOfLog` (`rule`),
  CONSTRAINT `idxFCrawledLink` FOREIGN KEY (`link`) REFERENCES `crawler_link` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idxFXpathRuleOfLog` FOREIGN KEY (`rule`) REFERENCES `xpath_rule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- ----------------------------
-- Table structure for xpath_rule
-- ----------------------------
DROP TABLE IF EXISTS `xpath_rule`;
CREATE TABLE `xpath_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'System given id.',
  `rule` text COLLATE utf8_turkish_ci NOT NULL COMMENT 'Xpath rule definition.',
  `parentRule` varchar(255) COLLATE utf8_turkish_ci DEFAULT NULL COMMENT 'Parent rule set.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- ----------------------------
-- Table structure for xpath_rules_of_crawler_link
-- ----------------------------
DROP TABLE IF EXISTS `xpath_rules_of_crawler_link`;
CREATE TABLE `xpath_rules_of_crawler_link` (
  `link` bigint(15) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Link that rule belongs to.',
  `rule` int(10) unsigned NOT NULL COMMENT 'Rule that link belongs to.',
  `code` varchar(155) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`link`,`rule`),
  UNIQUE KEY `idxUTitleOfXpathRuleOfCrawlerLink` (`code`) USING BTREE,
  KEY `idxFLinkOfXpathRule` (`rule`),
  CONSTRAINT `idxFLinkOfXpathRule` FOREIGN KEY (`rule`) REFERENCES `xpath_rule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idxFRuleOfCrawlerLink` FOREIGN KEY (`link`) REFERENCES `crawler_link` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
