SELECT
	`year`,
	SUM(hours_worked * hours_price) suma_plata
FROM
	work_log
GROUP BY
	`year`
ORDER BY
	`year`;
