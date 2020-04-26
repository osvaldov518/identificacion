CREATE DEFINER=`root`@`localhost` PROCEDURE `generar_tendencia`(IN p_nombre_columna VARCHAR(50))
BEGIN
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
    
    actualiza_tendencia: LOOP
		IF i > numreg THEN
			LEAVE actualiza_tendencia;
		END IF;
        
		SET @str3 = 'UPDATE datosrandom
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
        
    
    
END