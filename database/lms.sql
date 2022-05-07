/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - lms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lms` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `lms`;

/*Table structure for table `due_payment` */

DROP TABLE IF EXISTS `due_payment`;

CREATE TABLE `due_payment` (
  `idDuePayment` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `idStudent` int(11) DEFAULT NULL,
  `idSubject` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDuePayment`),
  KEY `fk_due_payment_id_student_1` (`idStudent`),
  KEY `fk_due_payment_id_subject_1` (`idSubject`),
  CONSTRAINT `fk_due_payment_id_student_1` FOREIGN KEY (`idStudent`) REFERENCES `student` (`idstudent`),
  CONSTRAINT `fk_due_payment_id_subject_1` FOREIGN KEY (`idSubject`) REFERENCES `subject` (`idsubject`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `due_payment` */

insert  into `due_payment`(`idDuePayment`,`amount`,`idStudent`,`idSubject`) values 
(1,700,2,1),
(2,700,1,1),
(3,100,1,2);

/*Table structure for table `exam` */

DROP TABLE IF EXISTS `exam`;

CREATE TABLE `exam` (
  `idexam` int(11) NOT NULL AUTO_INCREMENT,
  `idsubject` int(11) DEFAULT NULL,
  `exam_title` text DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `start` varchar(45) DEFAULT NULL,
  `end` varchar(45) DEFAULT NULL,
  `examstatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idexam`),
  KEY `fk_exam_subject1` (`idsubject`),
  CONSTRAINT `fk_exam_subject1` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `exam` */

insert  into `exam`(`idexam`,`idsubject`,`exam_title`,`date`,`start`,`end`,`examstatus`) values 
(1,1,'HTML and CSS','2021-12-01','10:00','13:00','done');

/*Table structure for table `exam_result` */

DROP TABLE IF EXISTS `exam_result`;

CREATE TABLE `exam_result` (
  `idresult` int(11) NOT NULL AUTO_INCREMENT,
  `idexam` int(11) DEFAULT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `marks` double DEFAULT NULL,
  PRIMARY KEY (`idresult`),
  KEY `fk_exam_result_exam1` (`idexam`),
  KEY `fk_exam_result_student1` (`idstudent`),
  CONSTRAINT `fk_exam_result_exam1` FOREIGN KEY (`idexam`) REFERENCES `exam` (`idexam`),
  CONSTRAINT `fk_exam_result_student1` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `exam_result` */

insert  into `exam_result`(`idresult`,`idexam`,`idstudent`,`marks`) values 
(1,1,1,12),
(2,1,2,56);

/*Table structure for table `lecturer` */

DROP TABLE IF EXISTS `lecturer`;

CREATE TABLE `lecturer` (
  `idlecturer` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `idsubject` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlecturer`),
  KEY `fk_lecturer_idsubject1_idx` (`idsubject`),
  KEY `fk_lecturer_iduser1_idx` (`iduser`),
  CONSTRAINT `fk_lecturer_idsubject1_idx` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`) ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecturer_iduser1_idx` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `lecturer` */

insert  into `lecturer`(`idlecturer`,`iduser`,`idsubject`) values 
(1,1,1),
(2,4,1),
(3,5,2);

/*Table structure for table `notification` */

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `idnotification` int(11) NOT NULL AUTO_INCREMENT,
  `notif` text DEFAULT NULL,
  PRIMARY KEY (`idnotification`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `notification` */

insert  into `notification`(`idnotification`,`notif`) values 
(1,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');

/*Table structure for table `payroll` */

DROP TABLE IF EXISTS `payroll`;

CREATE TABLE `payroll` (
  `idPayroll` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `idStudent` int(11) DEFAULT NULL,
  `idSubject` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPayroll`),
  KEY `fk_payroll_id_student_1` (`idStudent`),
  KEY `fk_payroll_id_subject_1` (`idSubject`),
  CONSTRAINT `fk_payroll_id_student_1` FOREIGN KEY (`idStudent`) REFERENCES `student` (`idstudent`),
  CONSTRAINT `fk_payroll_id_subject_1` FOREIGN KEY (`idSubject`) REFERENCES `subject` (`idsubject`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `payroll` */

insert  into `payroll`(`idPayroll`,`amount`,`idStudent`,`idSubject`) values 
(1,200,1,1),
(2,200,1,1),
(3,100,1,1);

/*Table structure for table `recording` */

DROP TABLE IF EXISTS `recording`;

CREATE TABLE `recording` (
  `idrecording` int(11) NOT NULL AUTO_INCREMENT,
  `urlstring` text DEFAULT NULL,
  `idsubject` int(11) DEFAULT NULL,
  PRIMARY KEY (`idrecording`),
  KEY `fk_recording_student_subjects_1` (`idsubject`),
  CONSTRAINT `fk_recording_student_subjects_1` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `recording` */

/*Table structure for table `scheduled_event` */

DROP TABLE IF EXISTS `scheduled_event`;

CREATE TABLE `scheduled_event` (
  `idscheduled_event` int(11) NOT NULL AUTO_INCREMENT,
  `idlecturer` int(11) DEFAULT NULL,
  `idsubject` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `join_url` text DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `start` varchar(45) DEFAULT NULL,
  `end` varchar(45) DEFAULT NULL,
  `eventstatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idscheduled_event`),
  KEY `fk_scheduled_event_idsubject1_idx` (`idsubject`),
  KEY `fk_scheduled_event_idlecturer1_idx` (`idlecturer`),
  CONSTRAINT `fk_scheduled_event_idlecturer1_idx` FOREIGN KEY (`idlecturer`) REFERENCES `lecturer` (`idlecturer`),
  CONSTRAINT `fk_scheduled_event_idsubject1_idx` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `scheduled_event` */

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `idstudent` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`idstudent`),
  KEY `fk_user_iduser1_idx` (`iduser`),
  CONSTRAINT `fk_user_iduser1_idx` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `student` */

insert  into `student`(`idstudent`,`iduser`) values 
(1,2),
(2,3);

/*Table structure for table `student_subjects` */

DROP TABLE IF EXISTS `student_subjects`;

CREATE TABLE `student_subjects` (
  `idstudent_subjects` int(11) NOT NULL AUTO_INCREMENT,
  `idstudent` int(11) DEFAULT NULL,
  `idsubject` int(11) DEFAULT NULL,
  PRIMARY KEY (`idstudent_subjects`),
  KEY `fk_student_subjects_idstudent1_idx` (`idstudent`),
  KEY `fk_student_subjects_idsubject1_idx` (`idsubject`),
  CONSTRAINT `fk_student_subjects_idstudent1_idx` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`),
  CONSTRAINT `fk_student_subjects_idsubject1_idx` FOREIGN KEY (`idsubject`) REFERENCES `subject` (`idsubject`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `student_subjects` */

insert  into `student_subjects`(`idstudent_subjects`,`idstudent`,`idsubject`) values 
(2,2,1),
(4,1,1),
(5,1,2);

/*Table structure for table `subject` */

DROP TABLE IF EXISTS `subject`;

CREATE TABLE `subject` (
  `idsubject` int(11) NOT NULL AUTO_INCREMENT,
  `subjectname` varchar(60) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idsubject`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `subject` */

insert  into `subject`(`idsubject`,`subjectname`,`status`) values 
(1,'PHP 2022','active'),
(2,'HTML 2022','active');

/*Table structure for table `unread_notification` */

DROP TABLE IF EXISTS `unread_notification`;

CREATE TABLE `unread_notification` (
  `idunreadnotification` int(11) NOT NULL AUTO_INCREMENT,
  `idnotification` int(11) DEFAULT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idunreadnotification`),
  KEY `fk_unread_notification_notif_1` (`idnotification`),
  KEY `fk_unread_notification_student_1` (`idstudent`),
  CONSTRAINT `fk_unread_notification_notif_1` FOREIGN KEY (`idnotification`) REFERENCES `notification` (`idnotification`),
  CONSTRAINT `fk_unread_notification_student_1` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `unread_notification` */

insert  into `unread_notification`(`idunreadnotification`,`idnotification`,`idstudent`,`status`) values 
(3,1,2,'active'),
(4,1,1,'read');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`iduser`,`email`,`password`,`name`,`type`,`status`) values 
(1,'admin@mail.com','123','Super Admin','superadmin','active'),
(2,'test1@gmail.com','123','test1@gmail.com','student','active'),
(3,'test2@gmail.com','123','test2@gmail.com','student','active'),
(4,'kosala@gmail.com','1234','Kosala','lecturer','active'),
(5,'janith@gmail.com','123','Janith','lecturer','active');

/*Table structure for table `viewed_event` */

DROP TABLE IF EXISTS `viewed_event`;

CREATE TABLE `viewed_event` (
  `idviewed_event` int(11) NOT NULL AUTO_INCREMENT,
  `idscheduled_event` int(11) DEFAULT NULL,
  `idstudent` int(11) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idviewed_event`),
  KEY `fk_viewed_event_idstudent1_idx` (`idstudent`),
  KEY `fk_viewed_event_idscheduled_event1_idx` (`idscheduled_event`),
  CONSTRAINT `fk_viewed_event_idscheduled_event1_idx` FOREIGN KEY (`idscheduled_event`) REFERENCES `scheduled_event` (`idscheduled_event`),
  CONSTRAINT `fk_viewed_event_idstudent1_idx` FOREIGN KEY (`idstudent`) REFERENCES `student` (`idstudent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `viewed_event` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
