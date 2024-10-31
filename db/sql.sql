-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           11.5.2-MariaDB-ubu2404 - mariadb.org binary distribution
-- SE du serveur:                debian-linux-gnu
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cv_db
CREATE DATABASE IF NOT EXISTS `cv_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;
USE `cv_db`;

    -- Listage de la structure de la table cv_db. users
CREATE TABLE IF NOT EXISTS `users` (
                                       `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(255) NOT NULL,
    `username` varchar(50) NOT NULL,
    `firstname` varchar(50) NOT NULL DEFAULT 'Prénom',
    `lastname` varchar(50) NOT NULL DEFAULT 'Nom',
    `password` varchar(255) NOT NULL,
    `role` enum('admin','user') DEFAULT 'user',
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table cv_db.users : ~2 rows (environ)
INSERT INTO `users` (`id`, `email`, `username`, `firstname`, `lastname`, `password`, `role`) VALUES
    (1, 'zabuz2005.zenvendark@gmail.com', 'LQuatre', 'Lucas', 'DIOT', '$2y$10$Fu1mIkzqGDAOd.NjOwpoGOaV8CHc.xLJ3f6KDuIEd5Z2Dh/4yVHWy', 'user');


-- Listage de la structure de la table cv_db. cvs
CREATE TABLE IF NOT EXISTS `cvs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `education` text NOT NULL,
  `experience` text NOT NULL,
  `skills` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
    CONSTRAINT `cvs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Listage des données de la table cv_db.cvs : ~0 rows (environ)
INSERT INTO `cvs` (`id`, `user_id`, `email`, `phone`, `address`, `education`, `experience`, `skills`) VALUES
	(1, 1, 'zabuz2005.zenvendark@gmail.com', '668768464', '113 Route de Bayonne', 'azeae', 'azeaeazr', 'azrazra');

-- Listage de la structure de la table cv_db. projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_favorite` tinyint(1) DEFAULT 0,
  `is_validated` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    activity VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Listage des données de la table cv_db.projects : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
