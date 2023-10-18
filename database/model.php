<?php 
require_once './database/config.php';
class Model{
    protected $db;

    function __contruct() {
        $this->dbVerify();
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();    
    }
    function dbVerify() {
        $nombreDB = MYSQL_DB;
        $pdo = new PDO('mysql:host='.MYSQL_HOST.';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $query = "CREATE DATABASE IF NOT EXISTS $nombreDB";
        $pdo->exec($query);
    }
    private function deploy(){
        // Chequear si hay tablas
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
        if(count($tables)==0) { 
            $clave = '$2y$10$PqviKR8uINNSm/JhkC6KnuCBO73dU/DIdBh2dN3xVBgqoMrTSOk4y';
        $sql = <<<END
--
-- Estructura de tabla para la tabla `clubes`
--

CREATE TABLE `clubes` (
  `Club_ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Liga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clubes`
--

INSERT INTO `clubes` (`Club_ID`, `Nombre`, `Liga`) VALUES
(1, 'Barcelona', 'LaLiga'),
(2, 'Boca Juniors', 'LPF'),
(3, 'Real Madrid', 'LaLiga'),
(4, 'River Plate', 'LPF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `goleadores`
--

CREATE TABLE `goleadores` (
  `Jugador_ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Club` int(11) NOT NULL,
  `Goles` int(11) NOT NULL,
  `PJ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `goleadores`
--

INSERT INTO `goleadores` (`Jugador_ID`, `Nombre`, `Club`, `Goles`, `PJ`) VALUES
(1, 'Joao Felix', 1, 3, 5),
(2, 'Robert Lewandowski', 1, 6, 6),
(3, 'Edinson Cavani', 2, 1, 8),
(4, 'Salomon Rondon', 4, 1, 3),
(5, 'Jude Bellingham', 3, 5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_ID`, `username`, `password`) VALUES
(1, 'webadmin', '$clave');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clubes`
--
ALTER TABLE `clubes`
  ADD PRIMARY KEY (`Club_ID`);

--
-- Indices de la tabla `goleadores`
--
ALTER TABLE `goleadores`
  ADD PRIMARY KEY (`Jugador_ID`),
  ADD KEY `FK_goleadores_clubes` (`Club`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `goleadores`
--
ALTER TABLE `goleadores`
  ADD CONSTRAINT `FK_goleadores_clubes` FOREIGN KEY (`Club`) REFERENCES `clubes` (`Club_ID`);
COMMIT;
END;
$this->db->query($sql);
            }
        }
    }
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;