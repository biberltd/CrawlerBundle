/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bod_core

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2015-05-05 12:00:24
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxUCrawlerLogId` (`id`),
  UNIQUE KEY `idxUCrawlerLog` (`timestamp`,`link`),
  UNIQUE KEY `idxUCrawlerLogHash` (`hash`),
  KEY `idxFCrawledLink` (`link`),
  CONSTRAINT `idxFCrawledLink` FOREIGN KEY (`link`) REFERENCES `crawler_link` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
