SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `answers` (
  `id` int NOT NULL,
  `idQuestion` int NOT NULL,
  `name` varchar(3000) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `questions` (
  `id` int NOT NULL,
  `idTest` int NOT NULL,
  `name` varchar(3000) NOT NULL,
  `idCorrectAnswer` int DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `results` (
  `id` int NOT NULL,
  `idUser` int NOT NULL,
  `idTest` int NOT NULL,
  `correctAnswersCount` int NOT NULL,
  `incorrectAnswersCount` int NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `tests` (
  `id` int NOT NULL,
  `idAuthor` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(40) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('User','Moderator','Admin') NOT NULL DEFAULT 'User',
  `isEmailConfirmed` tinyint(1) NOT NULL DEFAULT '0',
  `emailConfirmationHash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `emailConfirmedAt` timestamp NULL DEFAULT NULL,
  `lastLoginAt` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`,`idQuestion`),
  ADD KEY `idQuestion` (`idQuestion`);

ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`,`idTest`),
  ADD KEY `idTest` (`idTest`),
  ADD KEY `idCorrectAnswer` (`idCorrectAnswer`);

ALTER TABLE `results`
  ADD PRIMARY KEY (`id`,`idUser`,`idTest`),
  ADD KEY `idTest` (`idTest`),
  ADD KEY `idUser` (`idUser`);

ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idAuthor` (`idAuthor`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`email`,`nickname`) USING BTREE,
  ADD UNIQUE KEY `emailConfirmationHash` (`emailConfirmationHash`);



ALTER TABLE `answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `questions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `results`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `tests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;



ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`idQuestion`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`idTest`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`idCorrectAnswer`) REFERENCES `answers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`idTest`) REFERENCES `tests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`idAuthor`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
