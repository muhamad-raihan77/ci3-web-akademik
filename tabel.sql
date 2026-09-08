CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `mahasiswa` (
  `npm` varchar(17) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(256) NOT NULL,
  PRIMARY KEY (`npm`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `buku` (
  `kode_buku` varchar(6) NOT NULL,
  `judul` text NOT NULL,
  `penulis` varchar(25) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  PRIMARY KEY (`kode_buku`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
