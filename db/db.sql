/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 10.0.38-MariaDB : Database - anketa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`anketa` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `anketa`;

/*Table structure for table `answers` */

DROP TABLE IF EXISTS `answers`;

CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_id` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT '1',
  `type` int(2) DEFAULT NULL,
  `option_text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `answers` */

/*Table structure for table `options` */

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(500) NOT NULL,
  `status` int(2) DEFAULT '1',
  `question_id` int(11) DEFAULT NULL,
  `option_text` text,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

/*Data for the table `options` */

insert  into `options`(`id`,`key`,`value`,`status`,`question_id`,`option_text`) values 
(1,'age_and_education','неполное среднее (9классов);',1,1,NULL),
(2,'age_and_education','cреднее общее (11 классов);',1,1,NULL),
(3,'age_and_education','среднее профессиональное (училище);',1,1,NULL),
(4,'age_and_education','среднее специальное (техникум);',1,1,NULL),
(5,'age_and_education','высшее образование;',1,1,NULL),
(6,'age_and_education','другое;',1,1,NULL),
(7,'main_occupation','квалифицированный рабочий;',1,3,NULL),
(8,'main_occupation','неквалифицированный рабочий;',1,3,NULL),
(9,'main_occupation','бизнесмен, предприниматель;',1,3,NULL),
(10,'main_occupation','безработный;',1,3,NULL),
(11,'main_occupation','учащийся, студент;',1,3,NULL),
(12,'main_occupation','неработающий пенсионер;',1,3,NULL),
(13,'main_occupation','занят (а) домашним хозяйством, нахожусь в отпуске по уходу за ребенком;',1,3,NULL),
(14,'main_occupation','другое;',1,3,NULL),
(15,'knowledge_level','достаточно полученных знаний;',1,4,NULL),
(16,'knowledge_level','нужно пройти дополнительные курсы;',1,4,NULL),
(17,'knowledge_level','недостаточно;',1,4,NULL),
(18,'knowledge_level','нет необходимости получать образование в учебном заведении; ',1,4,NULL),
(19,'course_to_like_attend','изучение языка;',1,16,NULL),
(20,'course_to_like_attend','швейные;',1,16,NULL),
(21,'course_to_like_attend','бухгалтера;',1,16,NULL),
(22,'course_to_like_attend','компьютерные курсы;',1,16,NULL),
(23,'course_to_like_attend','кулинарные курсы; ',1,16,NULL),
(24,'course_to_like_attend','курсы для социальных работников;',1,16,NULL),
(25,'course_to_like_attend','повар;',1,16,NULL),
(26,'course_to_like_attend','массажа;',1,16,NULL),
(27,'course_to_like_attend','электрика;',1,16,NULL),
(28,'course_to_like_attend','другое;',1,16,NULL),
(29,'go_to_take_course','Центр Образования Взрослых',1,17,NULL),
(30,'go_to_take_course','Центр Образования Взрослых',1,17,NULL),
(31,'go_to_take_course','Частные',1,17,NULL),
(32,'most_important_for_checking_course','территориальная близость к дому;',1,18,NULL),
(33,'most_important_for_checking_course','стоимость обучения;',1,18,NULL),
(34,'most_important_for_checking_course','стоимость обучения;',1,18,NULL),
(35,'most_important_for_checking_course','гибкое расписание занятий;',1,18,NULL),
(36,'most_important_for_checking_course','количество человек в группе;',1,18,NULL),
(37,'most_important_for_checking_course','использование новых технологий в процессе обучения;',1,18,NULL),
(38,'most_important_for_checking_course','широкий спектр предлагаемых курсов;',1,18,NULL),
(39,'most_important_for_checking_course','другое;',1,18,NULL),
(40,'time_attend_courses','утром;',1,20,NULL),
(41,'time_attend_courses','днем;',1,20,NULL),
(42,'time_attend_courses','вечером;',1,20,NULL),
(43,'time_attend_courses','другое;',1,20,NULL),
(44,'type_search_courses','в интернете;',1,21,NULL),
(45,'type_search_courses','по рекламе в печатной прессе;',1,21,NULL),
(46,'type_search_courses','по рекомендации знакомых;',1,21,NULL),
(47,'type_search_courses','в джамоате;',1,21,NULL),
(48,'type_search_courses','другое;',1,21,NULL),
(49,'cv_skills','да;',1,5,NULL),
(50,'cv_skills','нет;',1,5,NULL),
(51,'cv_skills','не знаю, что это такое;',1,5,NULL),
(52,'life_skills','лидерство;',1,13,NULL),
(53,'life_skills','принятие решений;',1,13,NULL),
(54,'life_skills','коммуникация;',1,13,NULL);

/*Table structure for table `question` */

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lable` varchar(500) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `question` */

insert  into `question`(`id`,`lable`,`status`,`sort`,`type`) values 
(1,'Ваш возраст и Ваше образование:',1,1,2),
(2,'Место проживания? (город, район, джамоат)',1,2,3),
(3,'Каково Ваше основное занятие в настоящий момент? (выберите один ответ)',1,3,2),
(4,'Достаточно ли ваших знаний для выполнения качественной профессиональной деятельности? ',1,999999999,2),
(5,'Есть ли у Вас навыки по написанию CV (Резюме)?',1,999999999,2),
(6,'Имеете ли Вы навыки работы на компьютере?',1,999999999,1),
(7,'Как часто Вы обращаетесь к врачам?',1,999999999,3),
(8,'Занимаетесь ли Вы спортом?',1,999999999,1),
(9,'Хотите ли Вы повысить свою квалификацию?',1,999999999,1),
(10,'Хотели бы Вы изменить свою профессию?',1,999999999,1),
(11,'Занимались ли Вы поиском обучаемых курсов?',1,999999999,1),
(12,'Занимались ли Вы поиском обучаемых курсов?',1,999999999,1),
(13,'Какие жизненные навыки Вами востребованы в Вашей работе?',1,999999999,2),
(14,'Созданы ли в семье условия для Вашей нормальной работы?',1,999999999,1),
(15,'Как Вы думаете, от чего зависит благополучие семьи?',1,999999999,4),
(16,'Какие курсы хотели бы Вы посещать?',1,999999999,2),
(17,'Какие курсы хотели бы Вы посещать?',1,999999999,2),
(18,'Что наиболее важно для Вас при выборе обучения?',1,999999999,2),
(19,'Имеете ли Вы возможность посещать платные курсы? ',1,999999999,1),
(20,'В какое время Вы можете посещать курсы? ',1,999999999,2),
(21,'Как Вы будете искать курсы для посещения?',1,999999999,2),
(22,'Ваши пожелания и предложения:',1,999999999,4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
