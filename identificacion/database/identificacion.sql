-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2020 a las 06:18:00
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `identificacion`
--
CREATE DATABASE IF NOT EXISTS `identificacion` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `identificacion`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `analisis_correlacion`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `analisis_correlacion` (IN `p_columnax` VARCHAR(50), IN `p_columnay` VARCHAR(50))  BEGIN
	SET @str = 'select 
				((sum(?par1*?par2)/count(*))-(sum(?par1)/count(*))*(sum(?par2)/count(*)))/
                (sqrt((sum(?par1*?par1)/count(*))-((sum(?par1)/count(*))*(sum(?par1)/count(*))))
                *sqrt((sum(?par2*?par2)/count(*))-((sum(?par2)/count(*))*(sum(?par2)/count(*))))) r
				from identificacion.datosrandom';
	
    SET @str = REPLACE(@str,'?par1',p_columnax);
    SET @str = REPLACE(@str,'?par2',p_columnay);
	
    PREPARE stmt FROM @str;
    EXECUTE stmt;

END$$

DROP PROCEDURE IF EXISTS `corte_de_picos`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `corte_de_picos` (IN `p_nombre_columna` VARCHAR(50))  BEGIN
	DECLARE numreg INT;
    DECLARE i INT;
    DECLARE nom_sp VARCHAR(50);  
	SET i = 1;
    
	SET @str = 'select max(?col)*.7 into @amplitud from datosrandom';
    SET @str = REPLACE(@str,'?col',p_nombre_columna);
    
    PREPARE stmt FROM @str;
    EXECUTE stmt;
    
	SET numreg = (SELECT COUNT(*) FROM datosrandom);
    SET nom_sp = (SELECT sinpicos FROM t_control_columnas WHERE columna = p_nombre_columna);
    
    SET @vlrResta = @amplitud*.35;
    
	actualiza_col_sin_picos:LOOP
		IF i > numreg THEN
			LEAVE actualiza_col_sin_picos;
		END IF;
        
		SET @str2 = 'UPDATE datosrandom
					 SET ?colsp = CASE WHEN ?ncol > @amplitud THEN ?ncol - @vlrResta
								  ELSE ?ncol END
					 WHERE id = ?i ';
        
        SET @str2 = REPLACE(@str2,'?colsp',nom_sp);
        SET @str2 = REPLACE(@str2,'?ncol',p_nombre_columna);
        SET @str2 = REPLACE(@str2,'?i',i);
        
		PREPARE stmt2 FROM @str2;
		EXECUTE stmt2;
        
		SET i = i + 1;
		ITERATE actualiza_col_sin_picos;
        
	END LOOP;
    
END$$

DROP PROCEDURE IF EXISTS `generar_tendencia`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `generar_tendencia` (IN `p_nombre_columna` VARCHAR(50))  BEGIN
    DECLARE vlr_m DECIMAL(15,2);
    DECLARE vlr_b DECIMAL(15,2);
    DECLARE numreg INT;
    DECLARE i INT;
    DECLARE nom_tend VARCHAR(50);
    SET i = 1;

	SET @str = '
		CREATE TEMPORARY TABLE temporal1 AS
		SELECT id as `x`, ?parametro_columna as `y`,
		(id*?parametro_columna) as `xy`, (id*id) as `x^2`,
		(select count(*) from identificacion.datosrandom) as conteo
		from identificacion.datosrandom';

	SET @str2='	CREATE TEMPORARY TABLE temporal2 AS
		select sum(x) as sum_x,	sum(y) sum_y, sum(xy) sum_xy,
		sum(`x^2`) `sum_x^2`, conteo 
		from temporal1
		group by conteo
    ';
    
    SET @str = REPLACE(@str, '?parametro_columna', p_nombre_columna);
    
    PREPARE stmt FROM @str;
	EXECUTE stmt;
    
    PREPARE stmt2 FROM @str2;
    EXECUTE stmt2;
    
    SET vlr_m = (select ((sum_xy)-((sum_x*sum_y)/conteo))/((`sum_x^2`)-((sum_x*sum_x)/conteo)) as m from temporal2);
    SET vlr_b = (select (sum_y/conteo) - (((sum_xy)-((sum_x*sum_y)/conteo))/((`sum_x^2`)-((sum_x*sum_x)/conteo))) * (sum_x/conteo)
				from temporal2);
                
	SET numreg = (SELECT COUNT(*) FROM datosrandom);
    SET nom_tend = (SELECT tendencias FROM t_control_columnas WHERE columna = p_nombre_columna);
    
    actualiza_tendencia:LOOP
		IF i > numreg THEN
			LEAVE actualiza_tendencia;
		END IF;
        
		SET @str3 = 'UPDATE identificacion.datosrandom
                SET ?tendencia = ( ?vlr_m * id + ?vlr_b )
                WHERE id = ?i ';
        
        SET @str3 = REPLACE(@str3,'?tendencia',nom_tend);
        SET @str3 = REPLACE(@str3,'?vlr_m',vlr_m);
        SET @str3 = REPLACE(@str3,'?vlr_b',vlr_b);
        SET @str3 = REPLACE(@str3,'?i',i);
        
        INSERT INTO log_update VALUES (@str3);
        
		PREPARE stmt3 FROM @str3;
		EXECUTE stmt3;
        
		SET i = i + 1;
		ITERATE actualiza_tendencia;
        
	END LOOP;
        
    
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosrandom`
--
-- Creación: 27-04-2020 a las 02:17:53
-- Última actualización: 27-04-2020 a las 04:13:01
--

DROP TABLE IF EXISTS `datosrandom`;
CREATE TABLE `datosrandom` (
  `id` int(11) NOT NULL,
  `col1` float DEFAULT NULL,
  `col2` float DEFAULT NULL,
  `col3` float DEFAULT NULL,
  `col4` float DEFAULT NULL,
  `col5` float DEFAULT NULL,
  `col6` float DEFAULT NULL,
  `tendencia1` float DEFAULT NULL,
  `tendencia2` float DEFAULT NULL,
  `tendencia3` float DEFAULT NULL,
  `tendencia4` float DEFAULT NULL,
  `tendencia5` float DEFAULT NULL,
  `tendencia6` float DEFAULT NULL,
  `colsp1` float DEFAULT NULL,
  `colsp2` float DEFAULT NULL,
  `colsp3` float DEFAULT NULL,
  `colsp4` float DEFAULT NULL,
  `colsp5` float DEFAULT NULL,
  `colsp6` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_update`
--
-- Creación: 26-04-2020 a las 23:02:53
-- Última actualización: 27-04-2020 a las 04:13:00
--

DROP TABLE IF EXISTS `log_update`;
CREATE TABLE `log_update` (
  `log` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `new_table`
--
-- Creación: 26-04-2020 a las 22:39:56
-- Última actualización: 27-04-2020 a las 02:45:04
--

DROP TABLE IF EXISTS `new_table`;
CREATE TABLE `new_table` (
  `dato` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_control_columnas`
--
-- Creación: 27-04-2020 a las 02:51:26
-- Última actualización: 27-04-2020 a las 02:57:20
--

DROP TABLE IF EXISTS `t_control_columnas`;
CREATE TABLE `t_control_columnas` (
  `columna` varchar(100) DEFAULT NULL,
  `tendencias` varchar(100) DEFAULT NULL,
  `sinpicos` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `t_control_columnas`
--

TRUNCATE TABLE `t_control_columnas`;
--
-- Volcado de datos para la tabla `t_control_columnas`
--

INSERT INTO `t_control_columnas` (`columna`, `tendencias`, `sinpicos`) VALUES
('col1', 'tendencia1', 'colsp1'),
('col2', 'tendencia2', 'colsp2'),
('col3', 'tendencia3', 'colsp3'),
('col4', 'tendencia4', 'colsp4'),
('col5', 'tendencia5', 'colsp5'),
('col6', 'tendencia6', 'colsp6');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `new_table`
--
ALTER TABLE `new_table`
  ADD PRIMARY KEY (`dato`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
