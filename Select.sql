        SELECT
                `CUSTOMER_ID`, 
                `STREET`, `TOWN`, 
                `POSTCODE`, 
                `COUNTRY`, 
                `TYPE`,
                FROM 'addressess'
                INNER JOIN 'customers'
                ON addresses.CUSTOMERS.ID = customers.id
                WHERE 'CUSTOMERS_ID' = 1