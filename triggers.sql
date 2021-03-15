DELIMITER |
CREATE TRIGGER actualizaCarteraMonto AFTER INSERT UPDATE ON transaccions
FOR EACH ROW BEGIN  
UPDATE carteras 
SET cartera_monto = cartera_monto + (NEW.transaccion_monto)    
WHERE carteras.id = NEW.cartera_id; 
END|;
