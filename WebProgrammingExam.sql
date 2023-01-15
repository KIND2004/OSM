-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.29 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table webprogrammingexam.academicofficer
CREATE TABLE IF NOT EXISTS `academicofficer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `verification_code` varchar(45) DEFAULT NULL,
  `verification_status_id` int NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_academicofficer_verification_status1_idx` (`verification_status_id`),
  KEY `fk_academicofficer_status1_idx` (`status_id`),
  CONSTRAINT `fk_academicofficer_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_academicofficer_verification_status1` FOREIGN KEY (`verification_status_id`) REFERENCES `verification_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.academicofficerimage
CREATE TABLE IF NOT EXISTS `academicofficerimage` (
  `path` varchar(150) NOT NULL,
  `academicofficer_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_academicofficerimage_academicofficer1_idx` (`academicofficer_id`),
  CONSTRAINT `fk_academicofficerimage_academicofficer1` FOREIGN KEY (`academicofficer_id`) REFERENCES `academicofficer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.adminimage
CREATE TABLE IF NOT EXISTS `adminimage` (
  `path` varchar(150) NOT NULL,
  `admin_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_adminimage_admin1_idx` (`admin_id`),
  CONSTRAINT `fk_adminimage_admin1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.assignments
CREATE TABLE IF NOT EXISTS `assignments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `teacher_has_subject_id` int NOT NULL,
  `path` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notes_teacher_has_subject1_idx` (`teacher_has_subject_id`),
  CONSTRAINT `fk_notes_teacher_has_subject10` FOREIGN KEY (`teacher_has_subject_id`) REFERENCES `teacher_has_subject` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.assignment_marks
CREATE TABLE IF NOT EXISTS `assignment_marks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `assignments_id` int NOT NULL,
  `student_id` int NOT NULL,
  `path` varchar(150) DEFAULT NULL,
  `marks` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_assignment_marks_assignments1_idx` (`assignments_id`),
  KEY `fk_assignment_marks_student1_idx` (`student_id`),
  CONSTRAINT `fk_assignment_marks_assignments1` FOREIGN KEY (`assignments_id`) REFERENCES `assignments` (`id`),
  CONSTRAINT `fk_assignment_marks_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.grade
CREATE TABLE IF NOT EXISTS `grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.notes
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `teacher_has_subject_id` int NOT NULL,
  `path` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notes_teacher_has_subject1_idx` (`teacher_has_subject_id`),
  CONSTRAINT `fk_notes_teacher_has_subject1` FOREIGN KEY (`teacher_has_subject_id`) REFERENCES `teacher_has_subject` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.released_marks
CREATE TABLE IF NOT EXISTS `released_marks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `assignment_marks_id` int NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_released_marks_assignment_marks1_idx` (`assignment_marks_id`),
  CONSTRAINT `fk_released_marks_assignment_marks1` FOREIGN KEY (`assignment_marks_id`) REFERENCES `assignment_marks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.student
CREATE TABLE IF NOT EXISTS `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `verification_code` varchar(45) DEFAULT NULL,
  `verification_status_id` int NOT NULL,
  `status_id` int NOT NULL,
  `grade_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_student_verification_status1_idx` (`verification_status_id`),
  KEY `fk_student_status1_idx` (`status_id`),
  KEY `fk_student_grade1_idx` (`grade_id`),
  CONSTRAINT `fk_student_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_student_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_student_verification_status1` FOREIGN KEY (`verification_status_id`) REFERENCES `verification_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.studentimage
CREATE TABLE IF NOT EXISTS `studentimage` (
  `path` varchar(150) NOT NULL,
  `student_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_studentimage_student1_idx` (`student_id`),
  CONSTRAINT `fk_studentimage_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.subject
CREATE TABLE IF NOT EXISTS `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.teacher
CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `verification_code` varchar(45) DEFAULT NULL,
  `verification_status_id` int NOT NULL,
  `status_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher_verification_status1_idx` (`verification_status_id`),
  KEY `fk_teacher_status1_idx` (`status_id`),
  CONSTRAINT `fk_teacher_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_teacher_verification_status1` FOREIGN KEY (`verification_status_id`) REFERENCES `verification_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.teacherimage
CREATE TABLE IF NOT EXISTS `teacherimage` (
  `path` varchar(150) NOT NULL,
  `teacher_id` int NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_teacherimage_teacher1_idx` (`teacher_id`),
  CONSTRAINT `fk_teacherimage_teacher1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.teacher_has_subject
CREATE TABLE IF NOT EXISTS `teacher_has_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `teacher_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `grade_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher_has_subject_subject1_idx` (`subject_id`),
  KEY `fk_teacher_has_subject_teacher1_idx` (`teacher_id`),
  KEY `fk_teacher_has_subject_grade1_idx` (`grade_id`),
  CONSTRAINT `fk_teacher_has_subject_grade1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`),
  CONSTRAINT `fk_teacher_has_subject_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `fk_teacher_has_subject_teacher1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

-- Dumping structure for table webprogrammingexam.verification_status
CREATE TABLE IF NOT EXISTS `verification_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
