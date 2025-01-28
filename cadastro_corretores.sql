DROP TABLE IF EXISTS `corretores`;
CREATE TABLE `corretores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` char(11) NOT NULL,
  `creci` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `creci` (`creci`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
