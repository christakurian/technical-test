 
-- Task 5 - Data Manipulation - MySQL 


SELECT 
    u.username, 
    u.email, 
    SUM(o.amount) AS total
FROM 
	users u
INNER JOIN 
	orders o ON u.id = o.user_id
GROUP BY 
    u.id
ORDER BY 
    total DESC;
