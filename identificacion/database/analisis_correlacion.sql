select sum(?par1) sum_x, sum(?par2) sum_y, sum(?par1*?par2) sum_xy, sum(?par1*?par1) sum_x2, sum(?par2*?par2) sum_y2,
count(*) N,
(sum(?par1)/count(*))*(sum(?par1)/count(*)) x_2,
(sum(?par2)/count(*))*(sum(?par2)/count(*)) y_2,
((sum(?par1*?par2)/count(*))-(sum(?par1)/count(*))*(sum(?par2)/count(*))) sxy,
sqrt((sum(?par1*?par1)/count(*))-((sum(?par1)/count(*))*(sum(?par1)/count(*)))) sx,
sqrt((sum(?par2*?par2)/count(*))-((sum(?par2)/count(*))*(sum(?par2)/count(*)))) sy,
((sum(?par1*?par2)/count(*))-(sum(?par1)/count(*))*(sum(?par2)/count(*)))/(sqrt((sum(?par1*?par1)/count(*))-((sum(?par1)/count(*))*(sum(?par1)/count(*))))*sqrt((sum(?par2*?par2)/count(*))-((sum(?par2)/count(*))*(sum(?par2)/count(*))))) r
from identificacion.datosrandom


------
--=================
-- SIMPLIFICADO
--=================
------

select 
((sum(?par1*?par2)/count(*))-(sum(?par1)/count(*))*(sum(?par2)/count(*)))/(sqrt((sum(?par1*?par1)/count(*))-((sum(?par1)/count(*))*(sum(?par1)/count(*))))*sqrt((sum(?par2*?par2)/count(*))-((sum(?par2)/count(*))*(sum(?par2)/count(*))))) r
from identificacion.datosrandom