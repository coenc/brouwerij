CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `voorraadgrondstoffen` AS
    SELECT 
        `b`.`datum` AS `datum`,
        `g`.`naam` AS `id`,
        ((`r`.`hoeveelheid` * `b`.`liters`) * -(1)) AS `hoeveelheidkg`
    FROM
        (((`brouwsels` `b`
        JOIN `recepten` `r`)
        JOIN `beersorts` `bs`)
        JOIN `grondstoffen` `g`)
    WHERE
        ((`b`.`biersoort_id` = `r`.`biersoort_id`)
            AND (`b`.`biersoort_id` = `bs`.`id`)
            AND (`r`.`grondstof_id` = `g`.`id`)) 
    UNION SELECT 
        `inkoopgrondstof`.`datum` AS `datum`,
        `inkoopgrondstof`.`grondstof_id` AS `grondstof_id`,
        `inkoopgrondstof`.`hoeveelheidkg` AS `hoeveelheidkg`
    FROM
        `inkoopgrondstof`
    ORDER BY `datum` DESC