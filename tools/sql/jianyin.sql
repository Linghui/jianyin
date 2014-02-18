-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 07 月 31 日 13:43
-- 服务器版本: 5.5.29
-- PHP 版本: 5.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `jianyin`
--
CREATE DATABASE IF NOT EXISTS `jianyin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jianyin`;

-- --------------------------------------------------------

--
-- 表的结构 `A`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `A`;
CREATE TABLE IF NOT EXISTS `A` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `B`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `B`;
CREATE TABLE IF NOT EXISTS `B` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- 表的结构 `C`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `C`;
CREATE TABLE IF NOT EXISTS `C` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `call`
--
-- 创建时间: 2013 年 07 月 31 日 11:39
--

DROP TABLE IF EXISTS `call`;
CREATE TABLE IF NOT EXISTS `call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  `api` varchar(50) NOT NULL,
  `para` varchar(10000) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `D`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `D`;
CREATE TABLE IF NOT EXISTS `D` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `E`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `E`;
CREATE TABLE IF NOT EXISTS `E` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `F`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `F`;
CREATE TABLE IF NOT EXISTS `F` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `G`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `G`;
CREATE TABLE IF NOT EXISTS `G` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `H`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `H`;
CREATE TABLE IF NOT EXISTS `H` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `I`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `I`;
CREATE TABLE IF NOT EXISTS `I` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `J`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `J`;
CREATE TABLE IF NOT EXISTS `J` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `K`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `K`;
CREATE TABLE IF NOT EXISTS `K` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `L`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `L`;
CREATE TABLE IF NOT EXISTS `L` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `M`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `M`;
CREATE TABLE IF NOT EXISTS `M` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `N`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `N`;
CREATE TABLE IF NOT EXISTS `N` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `new_pinyin`
--
-- 创建时间: 2013 年 07 月 26 日 19:50
--

DROP TABLE IF EXISTS `new_pinyin`;
CREATE TABLE IF NOT EXISTS `new_pinyin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `O`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `O`;
CREATE TABLE IF NOT EXISTS `O` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `P`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `P`;
CREATE TABLE IF NOT EXISTS `P` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `Q`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `Q`;
CREATE TABLE IF NOT EXISTS `Q` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `R`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `R`;
CREATE TABLE IF NOT EXISTS `R` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `S`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `S`;
CREATE TABLE IF NOT EXISTS `S` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `T`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `T`;
CREATE TABLE IF NOT EXISTS `T` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `U`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `U`;
CREATE TABLE IF NOT EXISTS `U` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `V`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `V`;
CREATE TABLE IF NOT EXISTS `V` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `W`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `W`;
CREATE TABLE IF NOT EXISTS `W` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `word_pinyin`
--
-- 创建时间: 2013 年 07 月 31 日 11:42
--

DROP TABLE IF EXISTS `word_pinyin`;
CREATE TABLE IF NOT EXISTS `word_pinyin` (
  `word` varbinary(10) NOT NULL,
  `pinyin` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `X`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `X`;
CREATE TABLE IF NOT EXISTS `X` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `Y`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `Y`;
CREATE TABLE IF NOT EXISTS `Y` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `Z`
--
-- 创建时间: 2013 年 07 月 26 日 16:10
--

DROP TABLE IF EXISTS `Z`;
CREATE TABLE IF NOT EXISTS `Z` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `words` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `pinyin` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `priority` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `is_new` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `words` (`words`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
